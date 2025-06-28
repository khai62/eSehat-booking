@extends('layouts.pasien')

@section('title', 'Dashboard Pasien')

@section('hero')
  @include('components.pasien.hero')
@endsection

@section('content')
  <div class="max-w-7xl mx-auto py-10 px-6">
    <h2 class="text-xl font-bold mb-4">Pilih Spesialis</h2>

    {{-- Komponen Tab Spesialis --}}
    @include('components.pasien.spesialis-tab', ['spesialisList' => $spesialisList])
    {{-- Komponen doktor unggulan --}}
    @include('components.pasien.dokter-unggulan', ['unggulan' => $unggulan])

    
    {{-- Hasil pencarian --}}
    @if(request()->has('spesialis'))
      @include('components.pasien.hasil-cari', ['dokters' => $dokters ?? collect()])
    @endif
  </div>

  <x-artikel :articles="$articles" />

@endsection
