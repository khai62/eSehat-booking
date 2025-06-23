@extends('layouts.dokter')

@section('title', 'Dashboard Dokter')

@section('content')
<div class="p-6 space-y-6">

    <h2 class="text-2xl font-bold mb-4">Dashboard</h2>

    {{-- Kartu Statistik --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-white p-4 rounded shadow">
            <p class="text-gray-500">📅 Total Booking Hari Ini</p>
            <h3 class="text-2xl font-bold text-blue-600">{{ $totalBookingHariIni }}</h3>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <p class="text-gray-500">👨‍⚕️ Jadwal Hari Ini</p>
            <h3 class="text-2xl font-bold text-green-600">{{ $jadwalHariIni->count() }}</h3>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <p class="text-gray-500">👥 Pasien Minggu Ini</p>
            <h3 class="text-2xl font-bold text-purple-600">{{ $pasienMingguIni }}</h3>
        </div>
    </div>

    {{-- Daftar Booking --}}
    <div class="bg-white p-4 rounded shadow">
        <h3 class="text-lg font-semibold mb-4">📄 Daftar Booking</h3>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="text-gray-600 border-b">
                        <th class="py-2 px-2">Nama Pasien</th>
                        <th class="py-2 px-2">Tanggal</th>
                        <th class="py-2 px-2">Jam</th>
                        <th class="py-2 px-2">Keluhan</th>
                        <th class="py-2 px-2">Status</th>
                        <th class="py-2 px-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($bookings as $b)
                        <tr class="border-t">
                            <td class="py-2 px-2">{{ $b->pasien->name ?? 'Pasien' }}</td>
                            <td class="py-2 px-2">{{ \Carbon\Carbon::parse($b->tanggal)->format('d M Y') }}</td>
                            <td class="py-2 px-2">{{ $b->jam }}</td>
                            <td class="py-2 px-2">{{ $b->keluhan ?? '-' }}</td>
                            <td class="py-2 px-2">
                                <span class="px-2 py-1 rounded-full text-xs 
                                    @if ($b->status === 'pending') bg-yellow-100 text-yellow-700
                                    @elseif ($b->status === 'terima') bg-green-100 text-green-700
                                    @elseif ($b->status === 'selesai') bg-gray-200 text-gray-700
                                    @else bg-red-100 text-red-700 @endif">
                                    {{ ucfirst($b->status) }}
                                </span>
                            </td>
                            <td class="py-2 px-2 space-x-1">
                                <td class="py-2 px-2 space-x-1">
                                    <form action="{{ route('booking.updateStatus', $b->id) }}" method="POST" class="inline">
                                        @csrf
                                        <input type="hidden" name="status" value="terima">
                                        <button class="px-2 py-1 bg-green-500 text-white rounded text-xs" onclick="return confirm('Terima booking ini?')">Terima</button>
                                    </form>

                                    <form action="{{ route('booking.updateStatus', $b->id) }}" method="POST" class="inline">
                                        @csrf
                                        <input type="hidden" name="status" value="tolak">
                                        <button class="px-2 py-1 bg-red-500 text-white rounded text-xs" onclick="return confirm('Tolak booking ini?')">Tolak</button>
                                    </form>

                                    <form action="{{ route('booking.updateStatus', $b->id) }}" method="POST" class="inline">
                                        @csrf
                                        <input type="hidden" name="status" value="selesai">
                                        <button class="px-2 py-1 bg-gray-500 text-white rounded text-xs" onclick="return confirm('Tandai selesai?')">Selesai</button>
                                    </form>
                                </td>

                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center text-gray-500 py-4">Belum ada booking</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

