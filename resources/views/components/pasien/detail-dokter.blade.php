@extends('layouts.pasien')

@section('title', 'Profil Dokter')

@section('content')
<div class="min-h-screen bg-gray-100 py-10 px-4">
  <div class="max-w-5xl mx-auto bg-white p-8 rounded-lg shadow-md">
    
    {{-- HEADER --}}
    <div class="text-center mb-8">
      <h1 class="text-3xl font-bold text-green-700">Profil Dokter</h1>
      <p class="text-gray-500">Informasi lengkap mengenai dokter pilihan Anda</p>
    </div>

    {{-- TOP SECTION --}}
    <div class="flex flex-col md:flex-row items-center md:items-start gap-6 mb-10">
      {{-- FOTO DOKTER --}}
      <div class="shrink-0">
        @if($dokter->foto)
          <img src="{{ asset('storage/' . $dokter->foto) }}" alt="Foto Dokter" class="w-40 h-40 rounded-lg object-cover shadow-md bg-white border">
        @else
          <div class="w-40 h-40 bg-gray-200 rounded-lg flex items-center justify-center text-gray-500">Foto</div>
        @endif
      </div>

      {{-- INFO UMUM --}}
      <div class="flex-1">
        <h2 class="text-2xl font-bold text-gray-800">{{ $dokter->name }}</h2>
        <p class="text-green-700 text-lg font-medium">Spesialis {{ $dokter->spesialis }}</p>
        <p class="text-gray-600 mt-1">👤 {{ ucfirst($dokter->gender) }}</p>
        <p class="text-gray-600">🎓 {{ $dokter->pendidikan_terakhir }}</p>
        <p class="text-gray-600">📞 {{ $dokter->no_hp }}</p>
        <p class="text-gray-600">📍 {{ $dokter->alamat_klinik }}</p>
      </div>
    </div>

    {{-- PROFIL DAN PENGALAMAN --}}
    <div class="grid md:grid-cols-2 gap-6 mb-8">
      <div>
        <h3 class="text-lg font-semibold text-gray-700 mb-2">Tentang Dokter</h3>
        <p class="text-gray-600 leading-relaxed">
          {{ $dokter->deskripsi ?? 'Belum ada deskripsi tersedia untuk dokter ini.' }}
        </p>
      </div>
      <div>
        <h3 class="text-lg font-semibold text-gray-700 mb-2">Pengalaman</h3>
        <p class="text-gray-600">{{ $dokter->pengalaman ?? '0' }} tahun pengalaman praktik</p>
      </div>
    </div>

   {{-- JADWAL PRAKTIK --}}
    <div class="mb-6">
    <h3 class="text-lg font-semibold mb-2 text-gray-700">Jadwal Praktik</h3>

        @php
            $jadwalList = json_decode($dokter->jadwal_praktek ?? '[]', true);
        @endphp

        @if (!empty($jadwalList) && is_array($jadwalList))
            <ul class="list-disc list-inside space-y-1 text-gray-700">
            @foreach ($jadwalList as $item)
                <li>🗓️ {{ $item['hari'] ?? '?' }} - {{ $item['jam_mulai'] ?? '?' }} s/d {{ $item['jam_selesai'] ?? '?' }}</li>
            @endforeach
            </ul>
        @else
            <p class="text-gray-500">Belum ada jadwal praktik.</p>
        @endif
    </div>



    <form action="{{ route('booking.store') }}" method="POST">
      @csrf
      <input type="hidden" name="dokter_id" value="{{ $dokter->id }}">

      {{-- Tanggal --}}
      <label class="block mb-1">Tanggal</label>
      <input type="date" name="tanggal" class="w-full p-2 border rounded mb-3" required>

      {{-- Jam Mulai --}}
      <label class="block mb-1">Jam Mulai</label>
      <input type="time" name="jam_mulai" class="w-full p-2 border rounded mb-3" required>

      {{-- Jam Selesai --}}
      <label class="block mb-1">Jam Selesai</label>
      <input type="time" name="jam_selesai" class="w-full p-2 border rounded mb-3" required>

      {{-- Keluhan --}}
      <label class="block mb-1">Keluhan</label>
      <textarea name="keluhan" rows="3" class="w-full p-2 border rounded mb-3"></textarea>

      <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Booking</button>
    </form>

  </div>
</div>
@endsection
