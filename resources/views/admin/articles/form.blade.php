@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto bg-white shadow-lg rounded-xl p-8">
    <h1 class="text-2xl font-bold text-teal-700 mb-6">
        {{ $article->exists ? '✏️ Edit Artikel' : '📝 Artikel Baru' }}
    </h1>

    @if(session('status'))
        <div class="mb-4 bg-emerald-50 border border-emerald-200 text-emerald-700 p-3 rounded-md">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST"
          action="{{ $article->exists ? route('articles.update', $article) : route('articles.store') }}"
          enctype="multipart/form-data" class="space-y-6">
        @csrf
        @if($article->exists) @method('PUT') @endif

        {{-- Judul --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Judul Artikel</label>
            <input name="title" value="{{ old('title',$article->title) }}"
                   class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-teal-400">
            @error('title') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Konten --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Isi Artikel</label>
            <textarea name="body" rows="8"
                      class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-teal-400">{{ old('body',$article->body) }}</textarea>
            @error('body') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Kategori --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Kategori</label>
            <select name="category"
                    class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-teal-400">
                @foreach (['Nutrisi','Diabetes','Jantung','Kesehatan Mulut','Kolestrol Tinggi','Diet'] as $cat)
                    <option value="{{ $cat }}" {{ old('category', $article->category) == $cat ? 'selected' : '' }}>
                        {{ $cat }}
                    </option>
                @endforeach
            </select>
            @error('category') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Gambar --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Gambar (Opsional)</label>
            <input type="file" name="image"
                   class="w-full text-sm border border-gray-300 rounded-md file:mr-4 file:px-4 file:py-2
                          file:bg-teal-50 file:text-teal-700 file:rounded-md hover:file:bg-teal-100">

            @error('image') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror

            @if($article->image)
                <img src="{{ asset('storage/'.$article->image) }}"
                     class="h-40 mt-3 rounded shadow-md">
            @endif
        </div>

        {{-- Tanggal --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Tanggal Terbit</label>
            <input type="date" name="published_at"
                   value="{{ old('published_at', $article->published_at?->toDateString()) }}"
                   class="border border-gray-300 rounded-md p-3 w-full focus:outline-none focus:ring-2 focus:ring-teal-400">
        </div>

        {{-- Tombol --}}
        <div class="pt-4">
            <button class="px-6 py-3 bg-teal-600 hover:bg-teal-700 text-black rounded-md shadow">
                💾 Simpan
            </button>
        </div>
    </form>
</div>
@endsection
