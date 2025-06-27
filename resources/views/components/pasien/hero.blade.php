<section class="bg-gradient-to-br from-white via-teal-50 to-white py-5 px-6 md:px-20">

  <div class="flex flex-col md:flex-row justify-between items-center gap-10">

    {{-- Text --}}
    <div class="max-w-xl">
      <h2 class="text-3xl md:text-4xl font-extrabold text-gray-800 leading-tight mb-6">
        Booking Dokter <br class="hidden md:block">Dengan Mudah Sekarang
      </h2>
      <p class="text-gray-600 text-base md:text-lg mb-6">
        Temukan dan booking dokter spesialis terpercaya dalam beberapa langkah cepat dan aman.
      </p>
    </div>

    {{-- Image --}}
    <div class="shrink-0">
      <img src="{{ asset('img/doctor.png') }}" alt="Ilustrasi Dokter" class="w-64 md:w-60 drop-shadow-md">
    </div>

  </div>

  {{-- Form Pencarian --}}
  <form action="{{ route('pasien.cari') }}" method="GET"
        class="mt-1 bg-white shadow-xl rounded-2xl overflow-hidden flex flex-col md:flex-row divide-y md:divide-y-0 md:divide-x divide-gray-100 border border-teal-100">

    {{-- Lokasi --}}
    <div class="flex items-center px-5 py-4 w-full md:w-1/4">
      <i class="ri-map-pin-line mr-3 text-teal-500 text-xl"></i>
      <select name="lokasi" class="w-full outline-none text-sm text-gray-700 bg-transparent">
        <option value="">📍 Semua Lokasi</option>
        <option value="Batam">Batam</option>
        <option value="Tanjungpinang">Tanjungpinang</option>
      </select>
    </div>

    {{-- Spesialis --}}
    <div class="flex items-center px-5 py-4 w-full md:w-1/4">
      <i class="ri-stethoscope-line mr-3 text-teal-500 text-xl"></i>
      <select name="spesialis" class="w-full outline-none text-sm text-gray-700 bg-transparent">
        <option value="">🩺 Semua Spesialis</option>
        <option value="Bedah">Bedah</option>
        <option value="Anak">Anak</option>
        <option value="Gigi">Gigi</option>
      </select>
    </div>

    {{-- Keyword --}}
    <div class="flex items-center px-5 py-4 w-full md:flex-1">
      <i class="ri-search-line mr-3 text-teal-500 text-xl"></i>
      <input type="text" name="keyword" placeholder="Cari Dokter atau Spesialis..."
             class="w-full outline-none text-sm text-gray-700 placeholder-gray-400 bg-transparent">
    </div>

    {{-- Tombol Cari --}}
    <button type="submit"
            class="bg-teal-500 hover:bg-teal-600 text-white text-sm font-medium px-6 py-4 transition-all">
      <i class="ri-search-line mr-2"></i> Cari
    </button>
  </form>
</section>
