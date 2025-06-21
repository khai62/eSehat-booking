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

        <div class="flex flex-wrap gap-3">
            <button class="bg-gray-200 px-4 py-2 rounded-full font-medium">Semua</button>
            <button class="bg-gray-200 px-4 py-2 rounded-full font-medium">Aktif</button>
            <button class="bg-gray-200 px-4 py-2 rounded-full font-medium">Selesai</button>
            <button class="bg-gray-200 px-4 py-2 rounded-full font-medium">Batal</button>
        </div>

        <div class="flex gap-4">
            <div class="w-32 h-32 bg-gray-300 rounded-md"></div>
            <div>
                <h3 class="font-semibold">Lorem ipsum dolor sit amet,</h3>
                <p class="text-gray-600 text-sm mt-1">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed euismod sapien nec ipsum porta,
                    at suscipit urna fermentum. Suspendisse potenti. Nullam ac tortor at nunc consequat semper.
                </p>
            </div>
        </div>
    </section>
</div>
@endsection
