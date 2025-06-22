@extends('layouts.pasien')

@section('title', 'Detail Dokter')

@section('content')
<div class="min-h-screen bg-gray-100 py-10 px-4">
  <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">

    {{-- Header --}}
    <div class="flex items-center gap-4 mb-6">
      <div class="w-24 h-24 bg-gray-200 rounded-full overflow-hidden">
        @if($dokter->foto)
          <img src="{{ asset('storage/' . $dokter->foto) }}" alt="Foto Dokter" class="w-full h-full object-cover">
        @endif
      </div>
      <div>
        <h2 class="text-2xl font-bold">{{ $dokter->name }}</h2>
        <p class="text-gray-600">Spesialis {{ $dokter->spesialis }}</p>
      </div>
    </div>

    {{-- Deskripsi --}}
    <div class="mb-4">
      <h3 class="text-lg font-semibold">Tentang Dokter</h3>
      <p class="text-gray-600">{{ $dokter->deskripsi ?? '-' }}</p>
    </div>

    {{-- Info Tambahan --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-gray-700 text-sm">
      <p><strong>👤 Gender:</strong> {{ $dokter->gender }}</p>
      <p><strong>🎓 Pendidikan:</strong> {{ $dokter->pendidikan }}</p>
      <p><strong>📞 Telepon:</strong> {{ $dokter->no_hp }}</p>
      <p><strong>📍 Klinik:</strong> {{ $dokter->alamat_klinik }}</p>
      <p><strong>🧾 No Lisensi:</strong> {{ $dokter->no_lisensi }}</p>
      <p><strong>🧰 Pengalaman:</strong> {{ $dokter->pengalaman ?? 0 }} tahun</p>
    </div>

    {{-- Jadwal --}}
    <div class="mt-6">
      <h3 class="text-lg font-semibold mb-2">Jadwal Praktik</h3>
      @php
          $jadwal = json_decode($dokter->jadwal_praktek ?? '[]', true);
      @endphp
      @if($jadwal)
        <ul class="list-disc list-inside">
          @foreach($jadwal as $j)
            <li>{{ ucfirst($j['hari']) }}: {{ $j['jam_mulai'] }} - {{ $j['jam_selesai'] }}</li>
          @endforeach
        </ul>
      @else
        <p class="text-gray-500">Belum ada jadwal praktik.</p>
      @endif
    </div>

    {{-- Tombol Booking --}}
    <div class="mt-6 text-right">
      <a href="{{ route('booking.form', $dokter->id) }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
        Lanjutkan Booking
      </a>
    </div>

  </div>
</div>
@endsection
