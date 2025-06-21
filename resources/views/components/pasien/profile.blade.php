@extends('layouts.pasien')

@section('title', 'Profil Pasien')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8 flex flex-col md:flex-row gap-8">


     <aside class="w-1/4">
        @include('components.pasien.sidebar')
    </aside>

    {{-- Konten utama --}}
    <section class="w-full md:w-3/4 space-y-6">
        {{-- Judul --}}
        <h2 class="text-2xl font-bold">Profil Saya</h2>

        {{-- Informasi utama --}}
        <div class="bg-white shadow rounded-lg p-6 flex flex-col md:flex-row justify-between gap-6">
            <div class="flex items-center gap-4">
                {{-- Foto --}}
                @if(Auth::user()?->foto)
                    <img src="{{ asset('storage/' . Auth::user()->foto) }}" class="w-20 h-20 rounded-full object-cover" alt="Foto Profil">
                @else
                    <div class="w-20 h-20 bg-gray-300 rounded-full flex items-center justify-center text-white text-2xl">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                @endif

                {{-- Nama dan email --}}
                <div>
                    <h3 class="font-semibold text-lg">{{ Auth::user()->name }}</h3>
                    <p class="text-gray-600">{{ Auth::user()->email }}</p>
                </div>
            </div>

            {{-- Tombol Edit --}}
            <div class="self-start md:self-center">
                <a href="#" class="text-sm text-blue-600 hover:underline">Edit</a>
            </div>
        </div>

        {{-- Info tambahan --}}
        <div class="bg-white shadow rounded-lg p-6 space-y-4">
            <div class="flex justify-between border-b pb-2">
                <span class="text-gray-600">Tanggal Lahir</span>
                <span>
                    @if(Auth::user()?->birthdate)
                        {{ \Carbon\Carbon::parse(Auth::user()->birthdate)->translatedFormat('d F Y') }}
                    @else
                        <span class="text-gray-400">Belum diisi</span>
                    @endif
                </span>
            </div>

            <div class="flex justify-between border-b pb-2">
                <span class="text-gray-600">Jenis Kelamin</span>
                <span>{{ Auth::user()->gender ?? '-' }}</span>
            </div>

            <div class="flex justify-between">
                <span class="text-gray-600">Kota/Kabupaten</span>
                <span>{{ Auth::user()->city ?? '-' }}</span>
            </div>
        </div>
    </section>
</div>
@endsection
