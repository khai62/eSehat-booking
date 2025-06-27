{{-- resources/views/pasien/hasil-cari.blade.php --}}
@extends('layouts.pasien')

@section('title', 'Hasil Pencarian Dokter')

@section('content')
  <div class="max-w-6xl mx-auto px-4 py-8">
    <h2 class="text-2xl font-bold mb-4">Pilih Dokter Spesialis</h2>

    
    @if($dokters->isEmpty())
      <p class="text-gray-500">Tidak ada dokter ditemukan.</p>
    @else
    
      @foreach ($dokters as $dokter)
      <a href="{{ route('dokter.detail', $dokter->id) }}" class="block">
        <div class="bg-gray-200 rounded-lg p-4 flex flex-col md:flex-row justify-between items-start md:items-center mb-4">
          
          {{-- Info Kiri --}}
          <div class="flex items-start gap-4">
            {{-- Foto --}}
            @if($dokter->foto)
              <img src="{{ asset('storage/' . $dokter->foto) }}" alt="Foto Dokter" class="w-16 h-16 rounded-md object-cover">
            @else
              <div class="w-16 h-16 bg-white rounded-md flex items-center justify-center text-gray-500">Foto</div>
            @endif

            {{-- Detail --}}
            <div>
              <h3 class="font-bold text-lg">Dr.{{ $dokter->name }}</h3>
              <p class="text-sm text-gray-700">⚕️ Dokter {{ $dokter->spesialis }}</p>
              <p class="text-sm text-gray-700">🏥 {{ $dokter->alamat_klinik }}</p>
              <p class="text-sm mt-2">📅 Jadwal Selanjutnya: <strong>Besok, 10.30 Pagi</strong></p>
            </div>
          </div>

          {{-- Info Kanan --}}
          <div class="flex flex-col items-end mt-4 md:mt-0">
           
            <p class="mt-2 bg-green-600 text-white px-4 py-1 rounded hover:bg-green-700 transition">Booking</p>
          </div>
        </div>
        </a>
      @endforeach
      
    @endif
  </div>

@endsection
