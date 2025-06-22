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
            return back()->withErrors(['jam_selesai' => 'Durasi minimal 1 jam'])->withInput();
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

        // 4. Cek apakah waktu itu sudah dibooking pasien lain
        $jamBooking = $jamMulai . ' - ' . $jamSelesai;
        $cekJadwalSama = Booking::where('dokter_id', $request->dokter_id)
            ->where('tanggal', $request->tanggal)
            ->where('jam', $jamBooking)
            ->whereIn('status', ['pending', 'terima'])
            ->exists();

        if ($cekJadwalSama) {
            return back()->withErrors(['jam' => 'Jam ini sudah dibooking pasien lain. Silakan pilih waktu lain.'])->withInput();
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



        return redirect()->back()->with('success', 'Booking berhasil dikirim.');
    }
}
