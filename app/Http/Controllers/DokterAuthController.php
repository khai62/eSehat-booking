<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User; 

class DokterAuthController extends Controller
{
    public function showRegister()
    {
        return view('daftar.daftar-dokter');
    }

  public function register(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|confirmed|min:6',
        'gender' => 'required',
        'city' => 'required',
        'birthdate' => 'required|date',
        'alamat_rumah' => 'required',
        'no_hp' => 'required',
        'pendidikan' => 'required',
        'foto' => 'nullable|image|max:2048',
        'no_lisensi' => 'required',
        'spesialis' => 'required',
        'pengalaman' => 'required|numeric',
        'alamat_klinik' => 'required',
    ]);

    $user = new User();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = Hash::make($request->password);
    $user->gender = $request->gender;
    $user->city = $request->city;
    $user->birthdate = $request->birthdate;
    $user->alamat_rumah = $request->alamat_rumah;
    $user->no_hp = $request->no_hp;
    $user->pendidikan = $request->pendidikan;

    if ($request->hasFile('foto')) {
        $user->foto = $request->file('foto')->store('dokter_foto', 'public');
    }

    $user->no_lisensi = $request->no_lisensi;
    $user->spesialis = $request->spesialis;
    $user->pengalaman = $request->pengalaman;
    $user->alamat_klinik = $request->alamat_klinik;

    $jadwal = [];
    $hari_praktek = $request->hari_praktek;
    $jam_mulai = $request->jam_mulai;
    $jam_selesai = $request->jam_selesai;

    for ($i = 0; $i < count($hari_praktek); $i++) {
        if (!empty($hari_praktek[$i]) && !empty($jam_mulai[$i]) && !empty($jam_selesai[$i])) {
            $jadwal[] = $hari_praktek[$i] . ' - ' . $jam_mulai[$i] . ' s/d ' . $jam_selesai[$i];
        }
    }


    $user->jadwal_praktek = json_encode($jadwal);
    $user->deskripsi = $request->deskripsi;

    $user->role = 'dokter'; // Penting: tandai ini sebagai role dokter

    $user->save();

    return redirect()->route('login')->with('success', 'Pendaftaran dokter berhasil!, silahkan login');
    }

    
}
