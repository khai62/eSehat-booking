<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DokterController extends Controller
{
    public function edit(Request $request)
    {
        return view('components.dokter.profile-edit', [
            'user' => $request->user(),
        ]);
    }

  public function update(Request $request)
{
    $user = $request->user();

    $validated = $request->validate([
        'no_hp'         => 'required|string',
        'gender'        => 'required|in:Laki-laki,Perempuan',
        'spesialis'     => 'required|string',
        'no_lisensi'    => 'required|string',
        'pengalaman'    => 'required|integer|min:0',
        'alamat_klinik' => 'required|string',
        'pendidikan'    => 'required|string',
        'deskripsi'     => 'required|string',
        'foto'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    if ($request->hasFile('foto')) {
    if ($user->foto) {
        $oldPath = $_SERVER['DOCUMENT_ROOT'] . '/storage/' . $user->foto;
        if (file_exists($oldPath)) {
            unlink($oldPath);
        }
    }

    $file = $request->file('foto');
    $namaFile = uniqid() . '.' . $file->getClientOriginalExtension();
    $targetPath = $_SERVER['DOCUMENT_ROOT'] . '/storage/dokter_profiles';

    if (!file_exists($targetPath)) {
        mkdir($targetPath, 0755, true);
    }

    $file->move($targetPath, $namaFile);
    $validated['foto'] = 'dokter_profiles/' . $namaFile;
}


    $user->update($validated);

    return back()->with('status', 'Profil berhasil diperbarui!');
}

}
