<nav class="bg-white shadow">
  <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

    {{-- Logo --}}
    <a href="{{ route('dashboard.pasien') }}" class="text-2xl font-bold text-green-600">eSehat</a>

    {{-- Profil Pengguna --}}
    <a href="{{ route('profil.pasien') }}" class="flex items-center space-x-3">
      @if(Auth::user()->foto)
        <img src="{{ asset('storage/' . Auth::user()->foto) }}" class="w-8 h-8 rounded-full object-cover" alt="Foto Profil">
      @else
        <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center text-white">
          {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
        </div>
      @endif
      <span class="text-sm font-medium text-gray-800">{{ Auth::user()->name }}</span>
    </a>

  </div>
</nav>
