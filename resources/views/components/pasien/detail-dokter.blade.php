@extends('layouts.pasien')

@section('title', 'Detail Dokter')

@section('content')
<div class="bg-gradient-to-b from-white to-teal-50 min-h-screen py-12 px-6 md:px-20 max-w-6xl mx-auto">

  {{-- Header Dokter --}}
  <div class="flex flex-col md:flex-row items-center md:items-start gap-6 mb-10">
    <div class="w-32 h-32 rounded-full shadow-xl overflow-hidden ring-4 ring-white">
      @if($dokter->foto)
        <img src="{{ asset('storage/' . $dokter->foto) }}" alt="Foto Dokter" class="w-full h-full object-cover">
      @else
        <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-500">Foto</div>
      @endif
    </div>
    <div class="text-center md:text-left">
      <h2 class="text-3xl font-bold text-gray-800">dr. {{ $dokter->name }}</h2>
      <p class="text-lg text-teal-600 mt-1 font-medium">Spesialis {{ $dokter->spesialis }}</p>
    </div>
  </div>

  {{-- Deskripsi Dokter --}}
  <div class="bg-white p-6 rounded-2xl shadow-md mb-10" x-data="{ expanded: false }">
    <h3 class="text-xl font-semibold mb-3 text-gray-800">🩺 Profil Dokter</h3>
    <p class="text-gray-700 leading-relaxed text-justify">
        <span x-text="expanded ? @js($dokter->deskripsi) : @js(Str::limit($dokter->deskripsi, 180))"></span>
    </p>
    @if(Str::length($dokter->deskripsi) > 180)
      <button class="mt-3 text-teal-600 hover:underline text-sm font-medium" x-on:click="expanded = !expanded" x-text="expanded ? 'Tutup' : 'Baca Selengkapnya'"></button>
    @endif
  </div>

  {{-- Informasi Singkat --}}
  <div class="grid md:grid-cols-3 gap-6 mb-10">
    @php
        $info = [
            ['icon' => '👤', 'label' => 'Jenis Kelamin', 'value' => $dokter->gender],
            ['icon' => '🎓', 'label' => 'Pendidikan', 'value' => $dokter->pendidikan],
            ['icon' => '📞', 'label' => 'Telepon', 'value' => $dokter->no_hp],
            ['icon' => '📍', 'label' => 'Klinik', 'value' => $dokter->alamat_klinik],
            ['icon' => '🧾', 'label' => 'No Lisensi', 'value' => $dokter->no_lisensi],
            ['icon' => '🧰', 'label' => 'Pengalaman', 'value' => $dokter->pengalaman . ' tahun'],
        ];
    @endphp

    @foreach ($info as $i)
    <div class="bg-white p-5 rounded-xl shadow hover:shadow-md transition">
        <p class="text-sm text-gray-500 mb-1">{{ $i['icon'] }} <strong>{{ $i['label'] }}</strong></p>
        <p class="text-gray-800 font-medium">{{ $i['value'] }}</p>
    </div>
    @endforeach
  </div>

  {{-- Jadwal Praktik --}}
  <div class="bg-white p-6 rounded-2xl shadow-md mb-10">
    <h3 class="text-xl font-semibold mb-4 text-gray-800">🗓️ Jadwal Praktik</h3>
    @php
      $jadwal = json_decode($dokter->jadwal_praktek ?? '[]', true);
    @endphp

    @if($jadwal)
      <div class="grid md:grid-cols-2 gap-4">
        @foreach($jadwal as $j)
          <div class="bg-teal-50 border border-teal-200 rounded-lg p-4">
            <p class="font-semibold text-gray-800">{{ ucfirst($j['hari']) }}</p>
            <p class="text-sm text-teal-700">Jam: {{ $j['jam_mulai'] }} - {{ $j['jam_selesai'] }}</p>
          </div>
        @endforeach
      </div>
    @else
      <p class="text-gray-500">Belum ada jadwal praktik.</p>
    @endif
  </div>

  {{-- Tombol Booking --}}
    <div class="flex justify-end mt-8">
      <a href="{{ route('booking.form', $dokter->id) }}"
      class="fixed bottom-4 right-4 z-50 bg-teal-600 hover:bg-teal-700 text-white px-6 py-3 rounded-full shadow-lg text-sm md:text-base font-medium transition">
      Booking Sekarang
    </a>
  </div>
</div>

<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endsection
