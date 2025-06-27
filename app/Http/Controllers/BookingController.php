<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        // dd($request->all()); // Bisa dikomentari kalau sudah tidak dipakai

        $request->validate([
            'dokter_id'   => 'required|exists:users,id',
            'tanggal'     => 'required|date|after_or_equal:today',
            'jam_mulai'   => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);

        // 1. Validasi durasi minimal 1 jam
        $mulai = strtotime($request->jam_mulai);
        $selesai = strtotime($request->jam_selesai);
        $durasi = ($selesai - $mulai) / 3600;
        if ($durasi < 1) {
            return back()->withErrors(['jam_selesai' => 'Durasi minimal booking 1 jam'])->withInput();
        }

        // 2. Ambil data dokter & jadwal praktik
        $dokter = User::findOrFail($request->dokter_id);
        $jadwalPraktek = json_decode($dokter->jadwal_praktek, true);
        $hariBooking = Carbon::parse($request->tanggal)->locale('id')->isoFormat('dddd');
        $jamMulai = $request->jam_mulai;
        $jamSelesai = $request->jam_selesai;

        // 3. Cek apakah booking sesuai jadwal praktik
        $jadwalValid = false;
        foreach ($jadwalPraktek as $jadwal) {
            if (strtolower($jadwal['hari']) === strtolower($hariBooking)) {
                if (
                    $jamMulai >= $jadwal['jam_mulai'] &&
                    $jamSelesai <= $jadwal['jam_selesai']
                ) {
                    $jadwalValid = true;
                    break;
                }
            }
        }

        if (!$jadwalValid) {
            return back()->withErrors(['tanggal' => 'Waktu booking tidak sesuai dengan jadwal praktik dokter.'])->withInput();
        }

        // 4. Cek apakah waktu itu bentrok dengan pasien lain (CARA BARU - PAKAI INI)
        $cekJadwalBentrok = Booking::where('dokter_id', $request->dokter_id)
            ->where('tanggal', $request->tanggal)
            ->whereIn('status', ['pending', 'terima'])
            ->where(function ($query) use ($jamMulai, $jamSelesai) {
                $query->where('jam_mulai', '<', $jamSelesai)
                    ->where('jam_selesai', '>', $jamMulai);
            })
            ->exists();

        if ($cekJadwalBentrok) {
            return back()->withErrors(['jam' => 'Waktu ini sudah dibooking pasien lain. Silakan pilih waktu lain.'])->withInput();
        }


        // 5. Simpan booking
    Booking::create([
        'dokter_id'   => $request->dokter_id,
        'pasien_id'   => Auth::id(),
        'tanggal'     => $request->tanggal,
        'jam'         => $request->jam_mulai . ' - ' . $request->jam_selesai,
        'jam_mulai'   => $request->jam_mulai,
        'jam_selesai' => $request->jam_selesai,
        'keluhan'     => $request->keluhan,
        'status'      => 'pending',
    ]);



        return redirect()->route('pesanan.pasien')->with('success', 'Booking berhasil dikirim.');
    }

    public function form($id)
    {
        $dokter = User::findOrFail($id);
        return view('components.pasien.booking_form', compact('dokter'));
    }

    public function index(Request $request)
    {
        $filter = $request->query('status', 'all');   // all | aktif | selesai | batal

        $query = Booking::with('dokter')
                ->where('pasien_id', Auth::id());

        switch ($filter) {
            case 'aktif':
                $query->whereIn('status', ['pending','terima']);
                break;
            case 'selesai':
                $query->where('status', 'selesai');
                break;
            case 'batal':
                $query->whereIn('status', ['tolak','no-show']);
                break;
            default: /* all */;
        }

        $bookings = $query->latest()->paginate(10);

        return view('components.pasien.pesanan', compact('bookings','filter'));
    }

   public function dokterDashboard()
    {
        $dokterId = Auth::id();
         $hariIni = \Carbon\Carbon::today()->toDateString();

        // 1. Cek dan ubah otomatis jadi no-show jika jam selesai sudah lewat dan belum selesai
        Booking::where('dokter_id', $dokterId)
            ->where('status', 'terima')
            ->whereDate('tanggal', '<=', now()->toDateString())
            ->where(function ($query) {
                $query->where(function ($q) {
                    $q->where('tanggal', now()->toDateString())
                        ->where('jam_selesai', '<', now()->format('H:i'));
                })
                ->orWhere('tanggal', '<', now()->toDateString());
            })
            ->update(['status' => 'no-show']);

          // Total booking hari ini
    $totalBookingHariIni = Booking::where('dokter_id', $dokterId)
        ->whereDate('tanggal', $hariIni)
        ->count();

    // Jadwal hari ini
    $jadwalHariIni = Booking::where('dokter_id', $dokterId)
        ->whereDate('tanggal', $hariIni)
        ->get();

    // Pasien minggu ini
    $startOfWeek = \Carbon\Carbon::now()->startOfWeek();
    $endOfWeek = \Carbon\Carbon::now()->endOfWeek();
    $pasienMingguIni = Booking::where('dokter_id', $dokterId)
        ->whereBetween('tanggal', [$startOfWeek, $endOfWeek])
        ->distinct('pasien_id')
        ->count('pasien_id');

        // 2. Ambil data booking
        $bookings = Booking::with('pasien')
            ->where('dokter_id', $dokterId)
            ->orderBy('tanggal')
            ->orderBy('jam_mulai')
            ->get();

        // Statistik
        $totalBookingHariIni = $bookings->where('tanggal', now()->toDateString())->count();
        $jadwalHariIni = $bookings->where('tanggal', now()->toDateString());
        $pasienMingguIni = $bookings->whereBetween('tanggal', [
            now()->startOfWeek(), now()->endOfWeek()
        ])->pluck('pasien_id')->unique()->count();



        $riwayat = Booking::with('pasien')
            ->where('dokter_id', $dokterId)
            ->whereIn('status', ['selesai', 'no-show']) // Riwayat = pasien yang sudah selesai atau tidak hadir
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('dokter.dashboard', compact('bookings', 'totalBookingHariIni', 'jadwalHariIni', 'pasienMingguIni'));
    }


    public function updateStatus($id, Request $request)
    {
        $request->validate([
            'status' => 'required|in:terima,tolak,selesai'
        ]);

        $booking = Booking::findOrFail($id);
        $booking->status = $request->status;
        $booking->save();

        return back()->with('success', 'Status booking diperbarui.');
    }

    public function riwayatKunjungan()
    {
        $riwayat = Booking::where('dokter_id', Auth::id())
            ->with('pasien')
            ->whereIn('status', ['selesai', 'no-show'])
            ->get();

        return view('components.dokter.riwayat', compact('riwayat'));
    }



}
