@extends('layouts.dokter')

@section('title', 'Dashboard Dokter')

@section('content')
<div class="p-6 space-y-6">

    {{-- Judul --}}
    <h2 class="text-2xl font-bold text-teal-700 mb-4">Selamat Datang, Dr. {{ Auth::user()->name }}</h2>

    {{-- Kartu Statistik --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-white p-5 rounded-lg shadow border-l-4 border-teal-500">
            <p class="text-sm text-gray-500 mb-1">📅 Total Booking Hari Ini</p>
            <h3 class="text-2xl font-bold text-teal-600">{{ $totalBookingHariIni }}</h3>
        </div>
        <div class="bg-white p-5 rounded-lg shadow border-l-4 border-green-500">
            <p class="text-sm text-gray-500 mb-1">🗓️ Jadwal Hari Ini</p>
            <h3 class="text-2xl font-bold text-green-600">{{ $jadwalHariIni->count() }}</h3>
        </div>
        <div class="bg-white p-5 rounded-lg shadow border-l-4 border-purple-500">
            <p class="text-sm text-gray-500 mb-1">👥 Pasien Minggu Ini</p>
            <h3 class="text-2xl font-bold text-purple-600">{{ $pasienMingguIni }}</h3>
        </div>
    </div>

    {{-- Daftar Booking --}}
    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-lg font-semibold text-teal-700 mb-4">📄 Daftar Booking</h3>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-gray-600 border-b">
                        <th class="py-2 px-2 text-left">Nama Pasien</th>
                        <th class="py-2 px-2 text-left">Tanggal</th>
                        <th class="py-2 px-2 text-left">Jam</th>
                        <th class="py-2 px-2 text-left">Keluhan</th>
                        <th class="py-2 px-2 text-left">Status</th>
                        <th class="py-2 px-2 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($bookings as $b)
                        <tr class="border-t hover:bg-teal-50">
                            <td class="py-2 px-2">{{ $b->pasien->name ?? 'Pasien' }}</td>
                            <td class="py-2 px-2">{{ \Carbon\Carbon::parse($b->tanggal)->format('d M Y') }}</td>
                            <td class="py-2 px-2">{{ $b->jam }}</td>
                            <td class="py-2 px-2">{{ $b->keluhan ?? '-' }}</td>
                            <td class="py-2 px-2">
                                <span class="px-2 py-1 rounded-full text-xs font-semibold
                                    @if ($b->status === 'pending') bg-yellow-100 text-yellow-700
                                    @elseif ($b->status === 'terima') bg-green-100 text-green-700
                                    @elseif ($b->status === 'selesai') bg-gray-200 text-gray-700
                                    @else bg-red-100 text-red-700 @endif">
                                    {{ ucfirst($b->status) }}
                                </span>
                            </td>
                            <td class="py-2 px-2 space-x-1">
                                <form action="{{ route('booking.updateStatus', $b->id) }}" method="POST" class="inline">
                                    @csrf
                                    <input type="hidden" name="status" value="terima">
                                    <button class="px-3 py-1 bg-green-500 text-white rounded text-xs hover:bg-green-600"
                                            onclick="return confirm('Terima booking ini?')">Terima</button>
                                </form>

                                <form action="{{ route('booking.updateStatus', $b->id) }}" method="POST" class="inline">
                                    @csrf
                                    <input type="hidden" name="status" value="tolak">
                                    <button class="px-3 py-1 bg-red-500 text-white rounded text-xs hover:bg-red-600"
                                            onclick="return confirm('Tolak booking ini?')">Tolak</button>
                                </form>

                                <form action="{{ route('booking.updateStatus', $b->id) }}" method="POST" class="inline">
                                    @csrf
                                    <input type="hidden" name="status" value="selesai">
                                    <button class="px-3 py-1 bg-gray-500 text-white rounded text-xs hover:bg-gray-600"
                                            onclick="return confirm('Tandai selesai?')">Selesai</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-gray-500 py-4">Belum ada booking</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
