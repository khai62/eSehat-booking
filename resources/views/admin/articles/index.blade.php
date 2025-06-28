@extends('layouts.admin')

@section('content')
<div class="max-w-6xl mx-auto bg-white shadow-lg rounded-xl p-8">
    <h1 class="text-2xl font-bold text-teal-700 mb-6">📄 Daftar Artikel</h1>

    @if(session('status'))
        <div class="mb-4 bg-emerald-50 border border-emerald-200 text-emerald-700 p-3 rounded-md">
            {{ session('status') }}
        </div>
    @endif

    <div class="flex justify-between items-center mb-4">
        <span class="text-sm text-gray-500">{{ $articles->total() }} total artikel</span>
        <a href="{{ route('articles.create') }}"
           class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-md shadow transition">
            ➕ Tambah Artikel
        </a>
    </div>

    <div class="overflow-x-auto rounded-lg border border-gray-200">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-teal-50 text-teal-800 font-semibold">
                <tr>
                    <th class="px-4 py-3 text-left">Judul</th>
                    <th class="px-4 py-3">Kategori</th>
                    <th class="px-4 py-3">Tanggal Terbit</th>
                    <th class="px-4 py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($articles as $a)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 font-medium text-gray-800">{{ $a->title }}</td>
                        <td class="px-4 py-3 text-gray-600">{{ $a->category ?? '-' }}</td>
                        <td class="px-4 py-3 text-gray-600">{{ $a->published_at?->format('d M Y') ?? '-' }}</td>
                        <td class="px-4 py-3 text-right">
                            <div class="flex justify-end gap-3">
                                <a href="{{ route('articles.edit', $a) }}"
                                   class="text-sky-600 hover:underline">Edit</a>
                                <form method="POST" action="{{ route('articles.destroy', $a) }}"
                                      onsubmit="return confirm('Yakin ingin menghapus artikel ini?')">
                                    @csrf @method('DELETE')
                                    <button class="text-red-600 hover:underline">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-gray-500 py-6">Belum ada artikel.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-6">
        {{ $articles->links() }}
    </div>
</div>
@endsection
