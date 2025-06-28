@extends('layouts.admin')

@section('content')
<div class="p-8">
    <h1 class="text-2xl font-semibold mb-6">Artikel</h1>

    @if(session('status'))
        <div class="mb-4 bg-emerald-50 border border-emerald-200 text-emerald-700 p-3 rounded">
            {{ session('status') }}
        </div>
    @endif

    <a href="{{ route('articles.create') }}"
       class="inline-block mb-4 bg-sky-600 hover:bg-sky-700 text-white px-4 py-2 rounded">+ Tambah</a>

    <table class="w-full bg-white shadow rounded">
        <thead class="bg-sky-50 text-left">
            <tr><th class="px-4 py-2">Judul</th><th>Tgl Terbit</th><th class="w-32">Aksi</th></tr>
        </thead>
        <tbody>
        @forelse($articles as $a)
            <tr class="border-b last:border-0">
                <td class="px-4 py-2">{{ $a->title }}</td>
                <td>{{ $a->published_at?->format('d M Y') ?: '-' }}</td>
                <td class="px-4 py-2 flex gap-2">
                    <a href="{{ route('articles.edit',$a) }}" class="text-sky-600 hover:underline">Edit</a>
                    <form method="POST" action="{{ route('articles.destroy',$a) }}"
                          onsubmit="return confirm('Hapus artikel?')">
                        @csrf @method('DELETE')
                        <button class="text-red-600 hover:underline">Hapus</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="3" class="px-4 py-4 text-center text-gray-500">Belum ada artikel.</td></tr>
        @endforelse
        </tbody>
    </table>

    <div class="mt-6">{{ $articles->links() }}</div>
</div>
@endsection
