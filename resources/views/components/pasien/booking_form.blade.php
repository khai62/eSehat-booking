@extends('layouts.pasien')

@section('title', 'Booking Dokter')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-teal-50 to-white py-12 px-4">
  <div class="max-w-lg mx-auto bg-white p-8 rounded-2xl shadow-xl border border-gray-100">

    <div class="text-center mb-6">
      <h2 class="text-3xl font-bold text-teal-700">Booking Jadwal</h2>
      <p class="text-sm text-gray-500">Isi formulir di bawah untuk melakukan pemesanan</p>
    </div>

    {{-- Error Handling --}}
    @if($errors->any())
    <div class="mb-4 bg-red-50 border border-red-200 text-red-800 p-4 rounded-lg">
        <p class="font-semibold mb-2">Periksa kembali data Anda:</p>
        <ul class="list-disc pl-5 space-y-1 text-sm">
            @foreach ($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
@endif


    <form action="{{ route('booking.store') }}" method="POST" class="space-y-4">
      @csrf
      <input type="hidden" name="dokter_id" value="{{ $dokter->id }}">

      {{-- Tanggal --}}
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
        <input type="date" name="tanggal" class="w-full rounded-lg border-gray-300 focus:border-teal-600 focus:ring-teal-600" required>
      </div>

      {{-- Jam Mulai --}}
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Jam Mulai</label>
        <input type="time" name="jam_mulai" class="w-full rounded-lg border-gray-300 focus:border-teal-600 focus:ring-teal-600" required>
      </div>

      {{-- Jam Selesai --}}
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Jam Selesai</label>
        <input type="time" name="jam_selesai" class="w-full rounded-lg border-gray-300 focus:border-teal-600 focus:ring-teal-600" required>
      </div>

      {{-- Keluhan --}}
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Keluhan</label>
        <textarea name="keluhan" rows="4" class="w-full rounded-lg border-gray-300 focus:border-teal-600 focus:ring-teal-600" placeholder="Contoh: Sakit kepala berkelanjutan..."></textarea>
      </div>

      {{-- Submit Button --}}
      <div class="pt-4">
        <button type="submit" class="w-full bg-teal-600 hover:bg-teal-700 text-white font-medium py-3 rounded-lg shadow transition">
          Booking Sekarang
        </button>
      </div>
    </form>

  </div>
</div>
@endsection
