@extends('layouts.dokter')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 px-4 py-10">
    <div class="w-full max-w-3xl p-6 bg-white shadow-lg rounded-2xl border-l-4 border-teal-500">
        <h2 class="text-2xl font-bold text-teal-700 mb-6 flex items-center gap-2">
            🩺 Atur Jadwal Praktik
        </h2>

        {{-- Flash Message --}}
        @if(session('status'))
            <div class="mb-4 bg-green-100 text-green-700 px-4 py-2 rounded-md">
                {{ session('status') }}
            </div>
        @endif

        @php
            $raw = json_decode($user->jadwal_praktek ?: '[]', true);
            $jadwal = [];
            foreach ($raw as $row) {
                $jadwal[] = [
                    'hari'        => $row['hari'] ?? '',
                    'jam_mulai'   => str_replace('.', ':', $row['jam_mulai'] ?? ''),
                    'jam_selesai' => str_replace('.', ':', $row['jam_selesai'] ?? ''),
                ];
            }
            if (!$jadwal) {
                $jadwal = [[ 'hari'=>'', 'jam_mulai'=>'', 'jam_selesai'=>'' ]];
            }
            $hariList = ['senin','selasa','rabu','kamis','jumat','sabtu','minggu'];
        @endphp

        <form method="POST" action="{{ route('jadwal.update') }}" class="space-y-4" id="jadwalForm">
            @csrf
            @method('PUT')

            <div id="rows">
                @foreach($jadwal as $row)
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-2 jadwal-row relative">
                        <select name="hari[]" class="border rounded-md p-2 focus:ring-2 focus:ring-teal-500">
                            <option value="">Pilih Hari</option>
                            @foreach($hariList as $h)
                                <option value="{{ $h }}" @selected($row['hari']===$h)>{{ ucfirst($h) }}</option>
                            @endforeach
                        </select>
                        <input type="time" name="jam_mulai[]" value="{{ $row['jam_mulai'] }}" class="border rounded-md p-2 focus:ring-2 focus:ring-teal-500">
                        <input type="time" name="jam_selesai[]" value="{{ $row['jam_selesai'] }}" class="border rounded-md p-2 focus:ring-2 focus:ring-teal-500">

                        {{-- Tombol Hapus --}}
                        <button type="button"
                            class="hapus-row absolute -top-3 -right-3 bg-red-500 text-white w-6 h-6 rounded-full text-xs flex items-center justify-center shadow hover:bg-red-600"
                            title="Hapus Jadwal">×</button>
                    </div>
                @endforeach
            </div>

            <button type="button" id="addRow" class="text-sm text-teal-600 hover:underline">
                + Tambah Hari & Jam Praktik
            </button>

            <div class="pt-4 flex justify-end">
                <button class="px-5 py-2 bg-teal-600 text-white rounded-md hover:bg-teal-700">
                    Simpan Jadwal
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

