<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DokterJadwalController extends Controller
{
    public function edit(Request $request)
    {
        /* ── ambil user ── */
        $user = $request->user();          // <─ tambahkan baris ini

        /* ── konversi jadwal JSON → array ── */
        $jadwalRaw = json_decode($user->jadwal_praktek ?: '[]', true);
        $jadwal    = [];
        foreach ($jadwalRaw as $row) {
            $jadwal[] = [
                'hari'        => $row['hari']        ?? '',
                'jam_mulai'   => str_replace('.', ':', $row['jam_mulai']   ?? ''),
                'jam_selesai' => str_replace('.', ':', $row['jam_selesai'] ?? ''),
            ];
        }
        if (!$jadwal) {
            $jadwal = [['hari'=>'','jam_mulai'=>'','jam_selesai'=>'']];
        }

        $hariList = ['senin','selasa','rabu','kamis','jumat','sabtu','minggu'];

        /* ── kirim $user juga ── */
        return view('components.dokter.jadwal-edit',
            compact('user', 'jadwal', 'hariList'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'hari'           => 'array|min:1',
            'hari.*'         => 'required_with:jam_mulai.*|in:senin,selasa,rabu,kamis,jumat,sabtu,minggu',
            'jam_mulai.*'    => 'required_with:hari.*|date_format:H:i',
            'jam_selesai.*'  => 'required_with:hari.*|date_format:H:i',
        ]);

        $items = [];
        foreach ($request->hari as $i => $h) {
            if ($h) {
                $items[] = [
                    'hari'        => $h,
                    'jam_mulai'   => $request->jam_mulai[$i]   ?? '',
                    'jam_selesai' => $request->jam_selesai[$i] ?? '',
                ];
            }
        }

        $request->user()->update([
            'jadwal_praktek' => json_encode($items),
        ]);

        return back()->with('status', 'Jadwal praktik berhasil diperbarui!');
    }
}

