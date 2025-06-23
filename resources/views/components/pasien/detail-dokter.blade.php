@extends('layouts.pasien')

@section('title', 'Detail Dokter')

@section('content')
<div class="bg-gray-50 py-12 px-6 md:px-20 max-w-6xl mx-auto">

  {{-- Header Dokter --}}
  <div class="flex flex-col md:flex-row items-center md:items-start gap-6 mb-8">
    <div class="w-28 h-28 rounded-full shadow-lg overflow-hidden border-4 border-white">
      @if($dokter->foto)
        <img src="{{ asset('storage/' . $dokter->foto) }}" alt="Foto Dokter" class="w-full h-full object-cover">
      @else
        <div class="w-full h-full bg-gray-300 flex items-center justify-center text-gray-500">Foto</div>
      @endif
    </div>
    <div class="text-center md:text-left">
      <h2 class="text-3xl font-bold text-gray-900">{{ $dokter->name }}</h2>
      <p class="text-lg text-green-700 mt-1 font-medium">Spesialis {{ $dokter->spesialis }}</p>
    </div>
  </div>

  {{-- Deskripsi Dokter --}}
  <div class="bg-white p-6 rounded-lg shadow-sm mb-8" x-data="{ expanded: false }">
    <h3 class="text-xl font-semibold mb-3">Profil Dokter</h3>
    <p class="text-gray-700 leading-relaxed text-justify">
        <span x-text="expanded ? @js($dokter->deskripsi) : @js(Str::limit($dokter->deskripsi, 180))"></span>
    </p>
    @if(Str::length($dokter->deskripsi) > 180)
      <button class="mt-3 text-blue-600 hover:underline text-sm" x-on:click="expanded = !expanded" x-text="expanded ? 'Tutup' : 'Baca Selengkapnya'"></button>
    @endif
  </div>

  {{-- Info Singkat Dokter --}}
  <div class="grid md:grid-cols-3 gap-4 mb-8">
    @php
        $info = [
            ['icon' => '👤', 'label' => 'Gender', 'value' => $dokter->gender],
            ['icon' => '🎓', 'label' => 'Pendidikan', 'value' => $dokter->pendidikan],
            ['icon' => '📞', 'label' => 'Telepon', 'value' => $dokter->no_hp],
            ['icon' => '📍', 'label' => 'Klinik', 'value' => $dokter->alamat_klinik],
            ['icon' => '🧾', 'label' => 'No Lisensi', 'value' => $dokter->no_lisensi],
            ['icon' => '🧰', 'label' => 'Pengalaman', 'value' => $dokter->pengalaman . ' tahun'],
        ];
    @endphp

    @foreach ($info as $i)
    <div class="bg-white p-5 rounded-lg shadow-sm hover:shadow-md transition">
        <p class="text-sm text-gray-500 mb-1">{{ $i['icon'] }} <strong>{{ $i['label'] }}</strong></p>
        <p class="text-gray-800 font-medium">{{ $i['value'] }}</p>
    </div>
    @endforeach
  </div>

  {{-- Jadwal Praktik --}}
  <div class="bg-white p-6 rounded-lg shadow-sm mb-8">
    <h3 class="text-xl font-semibold mb-4">Jadwal Praktik</h3>
    @php
      $jadwal = json_decode($dokter->jadwal_praktek ?? '[]', true);
    @endphp

    @if($jadwal)
      <div class="grid md:grid-cols-2 gap-4">
        @foreach($jadwal as $j)
          <div class="bg-gray-50 border border-gray-200 rounded-md p-4 flex justify-between items-center">
            <div>
              <p class="font-semibold text-gray-800">{{ ucfirst($j['hari']) }}</p>
              <p class="text-sm text-gray-600">Jam: {{ $j['jam_mulai'] }} - {{ $j['jam_selesai'] }}</p>
            </div>
          </div>
        @endforeach
      </div>
    @else
      <p class="text-gray-500">Belum ada jadwal praktik.</p>
    @endif
  </div>

  {{-- Tombol Booking --}}
  <div class="text-center mt-6">
    <a href="{{ route('booking.form', $dokter->id) }}"
       class="bg-green-600 hover:bg-green-700 text-white px-8 py-3 rounded-lg shadow transition text-lg font-medium">
      Lanjutkan Booking
    </a>
  </div>
</div>

<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endsection
