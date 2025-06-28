<?php

namespace App\Http\Controllers;
use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class PasienController extends Controller
{
    /* ─────────────────────────── PROFIL ─────────────────────────── */

    /** halaman /pasien/profil (tampilan) */
    public function profil()
    {
        return view('dashboard.pasien-profil', ['user' => Auth::user()]);
    }

    /** halaman /pasien/profil/edit (form edit) */
    public function edit(Request $request)
    {
        $user = $request->user();
        return view('components.pasien.profil-edit', compact('user'));
    }

    /** proses simpan */
    public function update(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'birthdate' => 'nullable|date',
            'gender'    => 'nullable|in:Laki-laki,Perempuan',
            'city'      => 'nullable|string|max:255',
            'foto'      => 'nullable|image|max:2048',   // tambahkan jika perlu
        ]);

        /* upload foto baru */
        if ($request->hasFile('foto')) {
            if ($user->foto) {
                Storage::disk('public')->delete($user->foto);
            }
            $validated['foto'] = $request->file('foto')
                                         ->store('pasien_profiles', 'public');
        }

        $user->update($validated);

        return redirect()->route('pasien.profil.edit')
                         ->with('status', 'Profil berhasil diperbarui!');
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

            // ✅ Ambil artikel terbaru
            $articles = Article::latest()->take(5)->get();

            return view('pasien.dashboard', compact('spesialisList', 'dokters', 'unggulan', 'articles'));
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
