<section class="bg-gray-100 py-10 px-6 md:px-20">
  <div class="flex flex-col md:flex-row justify-between items-center gap-10">
    
    {{-- Text --}}
    <div class="max-w-xl">
      <h2 class="text-3xl md:text-4xl font-bold leading-snug mb-4">
        Booking Dokter Dengan <br class="hidden md:block"> Mudah Sekarang
      </h2>
      <p class="text-gray-700 mb-6">
        Temukan dan booking dokter spesialis pilihan Anda dengan mudah, cepat, dan terpercaya hanya dalam beberapa langkah sederhana.
      </p>
    </div>

    {{-- Image --}}
    <div class="shrink-0">
      <img src="{{ asset('img/doctor.png') }}" alt="Dokter" class="w-60 md:w-72">
    </div>
  </div>

  {{-- Form Pencarian --}}
  <form action="#" method="GET" class="mt-8 bg-white shadow-md rounded-lg flex flex-col md:flex-row overflow-hidden">
    <div class="flex items-center px-4 py-3 border-b md:border-b-0 md:border-r">
      <i class="ri-map-pin-line mr-2 text-gray-500"></i>
      <select name="lokasi" class="w-full outline-none">
        <option value="">Semua Lokasi</option>
        {{-- Tambahkan data lokasi di sini --}}
      </select>
    </div>

    <div class="flex items-center px-4 py-3 flex-1 border-b md:border-b-0 md:border-r">
      <i class="ri-search-line mr-2 text-gray-500"></i>
      <input type="text" name="keyword" placeholder="Cari Dokter Spesialis" class="w-full outline-none" />
    </div>

    <button type="submit" class="bg-green-600 text-white px-6 py-3 hover:bg-green-700 transition">
      <i class="ri-search-line mr-2"></i> Cari
    </button>
  </form>
</section>
