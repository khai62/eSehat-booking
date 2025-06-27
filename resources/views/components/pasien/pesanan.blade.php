@extends('layouts.pasien')

@section('title', 'Pesanan Saya')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-10 flex flex-col md:flex-row gap-8">

    {{-- Sidebar --}}
    <aside class="w-full md:w-1/4">
        @include('components.pasien.sidebar')
    </aside>

    {{-- Konten Utama --}}
    <section class="w-full md:w-3/4 space-y-6">
        <h2 class="text-3xl font-bold text-teal-700">Pesanan Saya</h2>

        @if (session('success'))
        <div class="p-4 bg-green-100 text-green-800 rounded-lg shadow-sm text-sm">
            {{ session('success') }}
        </div>
        @endif

        {{-- Tab Status --}}
        @php
            $tabs = [
                'all'     => 'Semua',
                'aktif'   => 'Aktif',
                'selesai' => 'Selesai',
                'batal'   => 'Batal',
            ];
        @endphp

        <div class="flex flex-wrap gap-3 mt-2 mb-4">
            @foreach($tabs as $key => $label)
                <a href="{{ route('pesanan.pasien', ['status' => $key]) }}"
                   class="px-4 py-2 rounded-full text-sm font-medium transition 
                   {{ $filter === $key ? 'bg-teal-600 text-white shadow' : 'bg-gray-100 hover:bg-gray-200 text-gray-700' }}">
                    {{ $label }}
                </a>
            @endforeach
        </div>

        {{-- Daftar Booking --}}
        @forelse ($bookings as $booking)
        <div class="flex gap-4 p-4 bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition">
            
            {{-- Foto Dokter --}}
            @if($booking->dokter->foto)
                <img src="{{ asset('storage/' . $booking->dokter->foto) }}" alt="Foto Dokter"
                     class="w-24 h-24 rounded-lg object-cover border border-gray-200">
            @else
                <div class="w-24 h-24 bg-gray-200 rounded-lg flex items-center justify-center text-gray-500">Foto</div>
            @endif

            {{-- Informasi Booking --}}
            <div class="flex-1">
                <h3 class="text-lg font-semibold text-gray-800">Dr. {{ $booking->dokter->name }}</h3>
                <p class="text-gray-600 text-sm">📅 {{ \Carbon\Carbon::parse($booking->tanggal)->translatedFormat('l, d F Y') }}</p>
                <p class="text-gray-600 text-sm">⏰ {{ $booking->jam }}</p>
                <p class="text-gray-600 text-sm">💬 {{ $booking->keluhan ?? '-' }}</p>

                {{-- Status --}}
                @php
                    $statusLabel = match($booking->status) {
                        'pending' => 'Menunggu Konfirmasi',
                        'terima' => 'Diterima',
                        'tolak' => 'Ditolak',
                        'selesai' => 'Selesai',
                        'no-show' => 'Tidak Hadir',
                        default => ucfirst($booking->status),
                    };

                    $statusClass = match($booking->status) {
                        'pending' => 'bg-yellow-100 text-yellow-800',
                        'terima' => 'bg-green-100 text-green-800',
                        'tolak' => 'bg-red-100 text-red-800',
                        'selesai' => 'bg-gray-100 text-gray-800',
                        'no-show' => 'bg-orange-100 text-orange-800',
                        default => 'bg-gray-100 text-gray-800',
                    };
                @endphp

                <span class="inline-block mt-3 px-3 py-1 rounded-full text-xs font-medium {{ $statusClass }}">
                    {{ $statusLabel }}
                </span>
            </div>
        </div>
        @empty
        <div class="bg-white p-6 rounded-xl shadow-sm border text-gray-500 text-center">
            Belum ada pesanan booking.
        </div>
        @endforelse
    </section>
</div>
@endsection
