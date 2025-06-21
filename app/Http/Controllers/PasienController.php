<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PasienController extends Controller
{
    public function profil()
    {
        return view('dashboard.pasien-profil', [
            'user' => Auth::user()
        ]);
    }

    public function cari(Request $request)
    {
        $keyword = $request->input('keyword');
        $lokasi = $request->input('lokasi');
        $spesialis = $request->input('spesialis');

        $query = User::where('role', 'dokter');

        if ($keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%")
                ->orWhere('spesialis', 'like', "%{$keyword}%")
                ->orWhere('city', 'like', "%{$keyword}%")
                ->orWhere('alamat_klinik', 'like', "%{$keyword}%");
            });
        }

        if ($lokasi) {
            $query->where('city', 'like', "%{$lokasi}%");
        }

        if ($spesialis) {
            $query->where('spesialis', 'like', "%{$spesialis}%");
        }

        $dokters = $query->get();

        return view('components.pasien.hasil-cari', compact('dokters'));
    }

   public function dashboard(Request $request)
    {
        $spesialisList = User::where('role', 'dokter')
                            ->whereNotNull('spesialis')
                            ->distinct()
                            ->pluck('spesialis');

        // Dokter unggulan (contohnya berdasarkan pengalaman >= 5 tahun)
        $unggulan = User::where('role', 'dokter')
                        ->where('pengalaman', '>=', 5)
                        ->take(10)
                        ->get();

        $dokters = collect();

        if ($request->has('spesialis')) {
            $dokters = User::where('role', 'dokter')
                        ->where('spesialis', $request->spesialis)
                        ->get();
        }

        return view('pasien.dashboard', compact('spesialisList', 'dokters', 'unggulan'));
    }

    public function detailDokter($id)
    {
        $dokter = User::where('role', 'dokter')->findOrFail($id);
        return view('components.pasien.detail-dokter', compact('dokter'));
    }


   public function detail($id)
{
    $dokter = User::findOrFail($id);

    // Ubah jadwal_praktek JSON jadi array
    $jadwal = json_decode($dokter->jadwal_praktek, true); 

    return view('pasien.detail-dokter', compact('dokter', 'jadwal'));
}





}
