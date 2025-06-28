@extends('layouts.pasien')

@section('content')
  <div class="max-w-6xl mx-auto py-10 px-6">

    @if ($articles->isEmpty())
      <p class="text-gray-500">Belum ada artikel dalam kategori ini.</p>
    @else
      <x-artikel :articles="$articles" />
    @endif
  </div>
@endsection