@extends('layouts.dokter')

@section('title', 'Riwayat Kunjungan')

@section('content')
<div class="p-6">
    <h2 class="text-2xl font-bold text-teal-700 mb-6 flex items-center gap-2">
        Riwayat Kunjungan Pasien
    </h2>

    <div class="bg-white border-l-4 border-teal-500 p-4 rounded-xl shadow-md overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="text-gray-700 border-b bg-teal-50">
                <tr>
                    <th class="py-3 px-4">Nama Pasien</th>
                    <th class="py-3 px-4">Tanggal</th>
                    <th class="py-3 px-4">Jam</th>
                    <th class="py-3 px-4">Keluhan</th>
                    <th class="py-3 px-4">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($riwayat as $r)
                <tr class="border-t hover:bg-gray-50">
                    <td class="py-3 px-4 font-medium text-gray-800">
                        {{ $r->pasien->name ?? 'Pasien' }}
                    </td>
                    <td class="py-3 px-4 text-gray-700">
                        {{ \Carbon\Carbon::parse($r->tanggal)->translatedFormat('d M Y') }}
                    </td>
                    <td class="py-3 px-4 text-gray-700">{{ $r->jam }}</td>
                    <td class="py-3 px-4 text-gray-700">{{ $r->keluhan ?? '-' }}</td>
                    <td class="py-3 px-4">
                        <span class="bg-gray-200 text-gray-700 px-3 py-1 rounded-full text-xs font-medium">
                            {{ ucfirst($r->status) }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-gray-500 py-6">
                        Tidak ada riwayat kunjungan yang selesai.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
