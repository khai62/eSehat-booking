@extends('layouts.dokter')

@section('title', 'Riwayat Kunjungan')

@section('content')
<div class="p-6">
    <h2 class="text-2xl font-bold mb-4">Riwayat Kunjungan Pasien</h2>

    <div class="bg-white p-4 rounded shadow overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="text-gray-600 border-b">
                <tr>
                    <th class="py-2 px-3">Nama Pasien</th>
                    <th class="py-2 px-3">Tanggal</th>
                    <th class="py-2 px-3">Jam</th>
                    <th class="py-2 px-3">Keluhan</th>
                    <th class="py-2 px-3">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($riwayat as $r)
                <tr class="border-t">
                    <td class="py-2 px-3">{{ $r->pasien->name ?? 'Pasien' }}</td>
                    <td class="py-2 px-3">{{ \Carbon\Carbon::parse($r->tanggal)->format('d M Y') }}</td>
                    <td class="py-2 px-3">{{ $r->jam }}</td>
                    <td class="py-2 px-3">{{ $r->keluhan ?? '-' }}</td>
                    <td class="py-2 px-3">
                        <span class="bg-gray-200 text-gray-700 px-2 py-1 rounded-full text-xs">
                            {{ ucfirst($r->status) }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center py-4 text-gray-500">Belum ada kunjungan selesai.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
