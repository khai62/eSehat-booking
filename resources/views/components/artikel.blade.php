@props(['articles'])

@php use Illuminate\Support\Str; @endphp

<div class="max-w-7xl mx-auto py-16 px-6 grid grid-cols-1 md:grid-cols-4 gap-10">

  {{-- Konten Artikel Utama --}}
  <div class="md:col-span-3 space-y-10">

    {{-- Judul Besar --}}
    <div>
      <h2 class="text-3xl font-bold text-teal-700 mb-2">Artikel Kesehatan Terkini</h2>
      <p class="text-gray-600 text-sm">Dapatkan informasi kesehatan terpercaya, terbaru, dan terkurasi oleh tim dokter.</p>
    </div>

    {{-- Artikel Unggulan (Artikel Pertama) --}}
    @if ($articles->count() > 0)
      @php $featured = $articles->first(); @endphp
      <div class="rounded-2xl overflow-hidden shadow-md hover:shadow-lg transition bg-white">
        <div class="h-56 bg-gray-200">
          @if($featured->image)
            <a href="{{ route('artikel.detail', $featured->id) }}">
              <img src="{{ asset('storage/' . $featured->image) }}" class="w-full h-full object-cover" alt="{{ $featured->title }}">
            </a>
          @endif
        </div>
        <div class="p-5">
          <h3 class="text-xl font-semibold text-gray-800 mb-2 hover:text-teal-600 cursor-pointer transition">
            <a href="{{ route('artikel.detail', $featured->id) }}">
              {{ $featured->title }}
            </a>
          </h3>
          <p class="text-gray-600 text-sm">
            {{ Str::limit(strip_tags($featured->body), 120) }}
          </p>
        </div>
      </div>
    @endif

    {{-- Artikel Lainnya --}}
    <div class="grid gap-6">
      @foreach ($articles->skip(1) as $article)
        <div class="flex gap-4 group">
          <div class="w-32 h-24 bg-gray-200 rounded-xl overflow-hidden">
            @if($article->image)
              <a href="{{ route('artikel.detail', $article->id) }}">
                <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
              </a>
            @endif
          </div>
          <div>
            <h4 class="font-semibold text-gray-800 group-hover:text-teal-600 transition">
              <a href="{{ route('artikel.detail', $article->id) }}">
                {{ $article->title }}
              </a>
            </h4>
            <p class="text-sm text-gray-600">
              {{ Str::limit(strip_tags($article->body), 100) }}
            </p>
          </div>
        </div>
      @endforeach
    </div>
  </div>

  {{-- Sidebar Kategori --}}
  <aside class="bg-white shadow rounded-2xl p-6 space-y-4 h-fit border border-teal-100">
    <h3 class="text-lg font-bold text-teal-700">📂 Kategori</h3>
    <ul class="space-y-2 text-sm text-gray-700">
    @php
        $kategoriAktif = request()->route('kategori');
      @endphp

      @foreach (['Nutrisi','Diabetes','Jantung','Kesehatan Mulut','Kolestrol Tinggi','Diet'] as $kategori)
        @php
          $slug = Str::slug($kategori);
          $isActive = $slug === $kategoriAktif;
        @endphp
        <li class="py-1 border-b">
          @auth
            <a href="{{ route('artikel.kategori', ['kategori' => $slug]) }}"
              class="block transition {{ $isActive ? 'text-teal-600 font-semibold' : 'text-gray-700 hover:text-teal-600' }}">
              {{ $kategori }}
            </a>
          @else
            <a href="{{ route('login') }}"
              class="block transition text-gray-700 hover:text-teal-600">
              {{ $kategori }}
            </a>
          @endauth
        </li>
      @endforeach
    </ul>
  </aside>

</div>
