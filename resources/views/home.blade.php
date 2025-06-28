@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
  <x-about />
  <div class="max-w-7xl mx-auto px-6">
    <x-artikel :articles="$articles" />
  </div>
@endsection
