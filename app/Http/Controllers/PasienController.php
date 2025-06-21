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

        $query = User::where('role', 'dokter');

        if ($keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%")
                ->orWhere('spesialis', 'like', "%{$keyword}%")
                ->orWhere('city', 'like', "%{$keyword}%")
                ->orWhere('gender', 'like', "%{$keyword}%")
                ->orWhere('alamat_klinik', 'like', "%{$keyword}%");
            });
        }

        if ($lokasi) {
            $query->where('city', 'like', "%{$lokasi}%");
        }

        $dokters = $query->get();

        return view('components.pasien.hasil-cari', compact('dokters'));
    }

}
