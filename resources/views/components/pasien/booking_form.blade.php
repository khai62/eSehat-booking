@extends('layouts.pasien')

@section('title', 'Booking Dokter')

@section('content')
<div class="min-h-screen bg-gray-100 py-10 px-4">
  <div class="max-w-lg mx-auto bg-white p-6 rounded shadow">


    <h2 class="text-2xl font-bold mb-4 text-center">Booking Jadwal</h2>
    @error('jam')
    <p class="text-red-600 text-sm mb-2">{{ $message }}</p>
    @enderror

    @error('tanggal')
        <p class="text-red-600 text-sm mb-2">{{ $message }}</p>
    @enderror

    @error('jam_selesai')
    <p class="text-red-600 text-sm mb-2">{{ $message }}</p>
    @enderror



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
