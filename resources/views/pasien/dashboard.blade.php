@extends('layouts.pasien')

@section('title', 'Dashboard Pasien')

@section('hero')
  @include('components.pasien.hero')
@endsection

@section('content')
  <div class="max-w-7xl mx-auto py-10 px-6">
    <h2 class="text-2xl font-bold mb-4">Selamat Datang, {{ Auth::user()->name }}!</h2>
    <p class="text-gray-600">Gunakan layanan kami untuk booking dokter dan melihat informasi kesehatan.</p>
  </div>
@endsection
