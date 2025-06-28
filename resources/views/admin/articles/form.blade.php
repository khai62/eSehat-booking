@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto p-8">
    <h1 class="text-2xl font-semibold mb-6">
        {{ $article->exists ? 'Edit Artikel' : 'Artikel Baru' }}
    </h1>

    @if(session('status'))
        <div class="mb-4 bg-emerald-50 border border-emerald-200 text-emerald-700 p-3 rounded">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST"
          action="{{ $article->exists ? route('articles.update', $article) : route('articles.store') }}"
          enctype="multipart/form-data" class="space-y-6">
        @csrf
        @if($article->exists) @method('PUT') @endif

        <div>
            <label class="block text-sm font-medium mb-1">Judul</label>
            <input name="title" value="{{ old('title',$article->title) }}"
                   class="w-full border rounded p-2">
            @error('title') <p class="text-red-600 text-xs">{{ $message }}</p> @enderror
        </div>


        <div>
            <label class="block text-sm font-medium mb-1">Konten</label>
            <textarea name="body" rows="8"
                      class="w-full border rounded p-2">{{ old('body',$article->body) }}</textarea>
            @error('body') <p class="text-red-600 text-xs">{{ $message }}</p> @enderror
        </div>
        <div>
        <label class="block text-sm font-medium mb-1">Kategori</label>
        <select name="category" class="w-full border rounded p-2">
            @foreach (['Nutrisi','Diabetes','Jantung','Kesehatan Mulut','Kolestrol Tinggi','Diet'] as $cat)
                <option value="{{ $cat }}" {{ old('category', $article->category) == $cat ? 'selected' : '' }}>
                    {{ $cat }}
                </option>
            @endforeach
        </select>
        @error('category') <p class="text-red-600 text-xs">{{ $message }}</p> @enderror
        </div>


        <div>
            <label class="block text-sm font-medium mb-1">Gambar (opsional)</label>
            <input type="file" name="image"
                   class="w-full text-sm file:mr-4 file:px-4 file:py-2
                          file:bg-sky-50 file:text-sky-700 file:rounded
                          hover:file:bg-sky-100">
            @error('image') <p class="text-red-600 text-xs">{{ $message }}</p> @enderror

            @if($article->image)
                <img src="{{ asset('storage/'.$article->image) }}"
                     class="h-40 mt-3 rounded shadow">
            @endif
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Tanggal Terbit</label>
            <input type="date" name="published_at"
                   value="{{ old('published_at', $article->published_at?->toDateString()) }}"
                   class="border rounded p-2">
        </div>

        <button class="px-6 py-2 bg-sky-600 hover:bg-sky-700 text-white rounded">
            💾 Simpan
        </button>
    </form>
</div>
@endsection
