@extends('layouts.pasien')

@section('title', 'Hasil Pencarian Dokter')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-10">

  <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-6">Temukan Dokter Pilihan Anda</h2>

  @if($dokters->isEmpty())
    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-md">
      Tidak ada dokter ditemukan sesuai pencarian Anda.
    </div>
  @else
    <div class="space-y-6">
      @foreach ($dokters as $dokter)
      <a href="{{ route('dokter.detail', $dokter->id) }}" class="block group">
        <div class="bg-white border border-gray-100 shadow-md rounded-2xl p-6 flex flex-col md:flex-row md:justify-between md:items-center gap-6 transition hover:shadow-lg">

          {{-- Kiri: Info Dokter --}}
          <div class="flex items-start gap-4">
            {{-- Foto --}}
            @if($dokter->foto)
              <img src="{{ asset('storage/' . $dokter->foto) }}" alt="Foto Dokter" class="w-20 h-20 rounded-full object-cover border-2 border-teal-500 shadow-sm">
            @else
              <div class="w-20 h-20 bg-gray-200 rounded-full flex items-center justify-center text-gray-500">Foto</div>
            @endif

            {{-- Detail --}}
            <div>
              <h3 class="text-xl font-semibold text-gray-800 group-hover:text-teal-600 transition">dr. {{ $dokter->name }}</h3>
              <p class="text-sm text-gray-600">⚕️ Spesialis {{ $dokter->spesialis }}</p>
              <p class="text-sm text-gray-600">🏥 {{ $dokter->alamat_klinik }}</p>
              <p class="text-xs text-gray-500 mt-2">📅 Jadwal Selanjutnya: <strong>Besok, 10.30 WIB</strong></p>
            </div>
          </div>

          {{-- Kanan: Tombol --}}
          <div class="md:mt-0 mt-4">
            <span class="inline-block bg-teal-600 hover:bg-teal-700 text-white text-sm px-5 py-2 rounded-full shadow transition">Booking</span>
          </div>

        </div>
      </a>
      @endforeach
    </div>
  @endif

</div>
@endsection
