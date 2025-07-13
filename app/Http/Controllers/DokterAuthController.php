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
        'deskripsi' => 'required|string',
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
    // Cek dan hapus file lama jika ada (meskipun biasanya belum ada saat register)
    if ($user->foto) {
        $oldPath = $_SERVER['DOCUMENT_ROOT'] . '/storage/' . $user->foto;
        if (file_exists($oldPath)) {
            unlink($oldPath);
        }
    }

    $file = $request->file('foto');
    $namaFile = uniqid('dokter_') . '.' . $file->getClientOriginalExtension();
    $targetPath = $_SERVER['DOCUMENT_ROOT'] . '/storage/dokter_profiles';

    // Pastikan folder target ada
    if (!file_exists($targetPath)) {
        mkdir($targetPath, 0755, true);
    }

    // Pindahkan file ke folder dokter_profiles
    $file->move($targetPath, $namaFile);

    // Simpan path relatif untuk <img src="/storage/dokter_profiles/...">
    $user->foto = 'dokter_profiles/' . $namaFile;
}



    $user->no_lisensi = $request->no_lisensi;
    $user->spesialis = $request->spesialis;
    $user->pengalaman = $request->pengalaman;
    $user->alamat_klinik = $request->alamat_klinik;
    $user->deskripsi = $request->deskripsi;
    $user->role = 'dokter';

    // Proses jadwal_praktek sebagai array terstruktur
    $jadwal = [];
    $hariList = $request->input('hari_praktek', []);
    $jamMulaiList = $request->input('jam_mulai', []);
    $jamSelesaiList = $request->input('jam_selesai', []);

    for ($i = 0; $i < count($hariList); $i++) {
        if (!empty($hariList[$i]) && !empty($jamMulaiList[$i]) && !empty($jamSelesaiList[$i])) {
            $jadwal[] = [
                'hari' => $hariList[$i],
                'jam_mulai' => $jamMulaiList[$i],
                'jam_selesai' => $jamSelesaiList[$i],
            ];
        }
    }

    $user->jadwal_praktek = json_encode($jadwal); // Simpan sebagai JSON

    $user->save();

    return redirect()->route('dashboard.dokter')->with('success', 'Pendaftaran dokter berhasil! Silakan login.');
}


    
}
