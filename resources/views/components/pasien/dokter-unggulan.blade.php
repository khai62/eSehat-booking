<div class="mt-10">
  <div class="flex justify-between items-center mb-4">
    <h2 class="text-xl font-bold">Dokter Unggulan</h2>
    <a href="#" class="text-blue-600 text-sm hover:underline">Lihat Semua</a>
  </div>

  <div class="flex overflow-x-auto space-x-4">
    @foreach ($unggulan as $dokter)
     <a href="{{ route('dokter.detail', $dokter->id) }}" class="block">
      <div class="relative rounded-xl overflow-hidden shadow-md w-48 h-64">
        {{-- Gambar dokter --}}
        @if($dokter->foto)
            <img src="{{ asset('storage/' . $dokter->foto) }}" alt="{{ $dokter->name }}" class="w-full h-full object-cover">
        @endif

        {{-- Overlay teks --}}
        <div class="absolute bottom-0 w-full bg-gradient-to-t from-black/70 to-transparent text-white p-4">
            <h3 class="text-lg font-bold">DR.{{ $dokter->name }}</h3>
            <p class="text-sm">{{ $dokter->spesialis }}</p>
            <p class="text-xs">Pengalaman {{ $dokter->pengalaman }} tahun</p>
        </div>
        </div>
        </a>
    @endforeach
  </div>
</div>
