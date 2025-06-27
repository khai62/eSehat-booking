<div class="max-w-7xl mx-auto py-16 px-6 grid grid-cols-1 md:grid-cols-4 gap-10">

  {{-- Konten Artikel Utama --}}
  <div class="md:col-span-3 space-y-10">

    {{-- Judul Besar --}}
    <div>
      <h2 class="text-3xl font-bold text-teal-700 mb-2">Artikel Kesehatan Terkini</h2>
      <p class="text-gray-600 text-sm">Dapatkan informasi kesehatan terpercaya, terbaru, dan terkurasi oleh tim dokter.</p>
    </div>

    {{-- Artikel Unggulan --}}
    <div class="rounded-2xl overflow-hidden shadow-md hover:shadow-lg transition bg-white">
      <div class="h-56 bg-gray-200">
        {{-- Ganti dengan gambar artikel --}}
        {{-- <img src="..." class="w-full h-full object-cover" alt="..."> --}}
      </div>
      <div class="p-5">
        <h3 class="text-xl font-semibold text-gray-800 mb-2 hover:text-teal-600 cursor-pointer transition">
          Lorem ipsum dolor sit amet
        </h3>
        <p class="text-gray-600 text-sm">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed euismod sapien nec ipsum porta, at suscipit urna fermentum.
        </p>
      </div>
    </div>

    {{-- Artikel Lainnya --}}
    <div class="grid gap-6">
      @foreach ([1, 2] as $i)
      <div class="flex gap-4 group">
        <div class="w-32 h-24 bg-gray-200 rounded-xl overflow-hidden">
          {{-- <img src="..." alt="..." class="w-full h-full object-cover"> --}}
        </div>
        <div>
          <h4 class="font-semibold text-gray-800 group-hover:text-teal-600 transition">
            Lorem ipsum dolor sit amet
          </h4>
          <p class="text-sm text-gray-600">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed euismod sapien nec ipsum porta, at suscipit urna fermentum.
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
      @foreach (['Nutrisi','Diabetes','Jantung','Kesehatan Mulut','Kolestrol Tinggi','Diet'] as $kategori)
      <li class="py-1 border-b hover:text-teal-600 cursor-pointer transition">{{ $kategori }}</li>
      @endforeach
    </ul>
  </aside>

</div>
