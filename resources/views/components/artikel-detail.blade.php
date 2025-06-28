@extends('layouts.pasien') {{-- Atau layouts.app, sesuaikan --}}

@section('title', $article->title)

@section('content')
<div class="max-w-4xl mx-auto py-16 px-6 space-y-6">
  <h1 class="text-3xl font-bold text-teal-700">{{ $article->title }}</h1>
  <p class="text-sm text-gray-500">{{ $article->published_at?->format('d M Y') }}</p>

  @if($article->image)
    <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="w-full rounded-xl shadow">
  @endif

  <div class="prose max-w-none">
    {!! $article->body !!}
  </div>
</div>
@endsection
