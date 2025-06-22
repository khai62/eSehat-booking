@extends('layouts.pasien')

@section('title', 'Pesanan Saya')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8 flex flex-col md:flex-row gap-8">

    {{-- Sidebar --}}
    <aside class="w-full md:w-1/4">
        @include('components.pasien.sidebar')
    </aside>

    {{-- Konten utama --}}
    <section class="w-full md:w-3/4 space-y-6">
        <h2 class="text-2xl font-bold">Pesanan Saya</h2>

        @if (session('success'))
        <div class="p-4 bg-green-100 text-green-800 rounded mb-4">
            {{ session('success') }}
        </div>
        @endif
        
        <div class="flex flex-wrap gap-3">
            <button class="bg-gray-200 px-4 py-2 rounded-full font-medium">Semua</button>
            <button class="bg-gray-200 px-4 py-2 rounded-full font-medium">Aktif</button>
            <button class="bg-gray-200 px-4 py-2 rounded-full font-medium">Selesai</button>
            <button class="bg-gray-200 px-4 py-2 rounded-full font-medium">Batal</button>
        </div>

        @forelse ($bookings as $booking)
    <div class="flex gap-4 p-4 bg-white shadow rounded-md">
        {{-- Foto dokter --}}
        @if($booking->dokter->foto)
            <img src="{{ asset('storage/' . $booking->dokter->foto) }}" alt="Foto Dokter" class="w-28 h-28 rounded-md object-cover">
        @else
            <div class="w-28 h-28 bg-gray-200 rounded-md flex items-center justify-center text-gray-500">
                Foto
            </div>
        @endif

        {{-- Info --}}
        <div class="flex-1">
            <h3 class="text-lg font-semibold text-gray-800">{{ $booking->dokter->name }}</h3>
            <p class="text-gray-600 text-sm">📅 {{ \Carbon\Carbon::parse($booking->tanggal)->translatedFormat('l, d F Y') }}</p>
            <p class="text-gray-600 text-sm">⏰ {{ $booking->jam }}</p>
            <p class="text-gray-600 text-sm">📝 {{ $booking->keluhan ?? '-' }}</p>
            <p class="mt-2 text-sm">
                <span class="px-2 py-1 rounded-full 
                    {{ 
                        $booking->status === 'pending' ? 'bg-yellow-100 text-yellow-800' :
                        ($booking->status === 'terima' ? 'bg-green-100 text-green-800' :
                        ($booking->status === 'tolak' ? 'bg-red-100 text-red-800' :
                        'bg-gray-100 text-gray-800')) 
                    }}">
                    {{ ucfirst($booking->status) }}
                </span>
            </p>
        </div>
    </div>
@empty
    <p class="text-gray-500">Belum ada pesanan booking.</p>
@endforelse

    </section>
</div>
@endsection
