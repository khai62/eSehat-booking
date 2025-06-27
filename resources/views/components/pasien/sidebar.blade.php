<!-- Sidebar Pasien Modern -->
<div class="bg-white shadow-xl border border-teal-100 rounded-3xl p-6 w-60 text-sm">
    <nav class="flex flex-col gap-4 font-medium text-gray-700">

        <!-- Profil -->
        <a href="{{ route('profil.pasien') }}"
           class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-200
                  {{ request()->routeIs('pasien.profil') ? 'bg-teal-100 text-teal-700 font-semibold ring-1 ring-inset ring-teal-200' : 'hover:bg-gray-50' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-teal-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 15c2.485 0 4.793.623 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            Profil
        </a>

        <!-- Pesanan -->
        <a href="{{ route('pesanan.pasien') }}"
           class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-200
                  {{ request()->routeIs('pasien.pesanan*') ? 'bg-teal-100 text-teal-700 font-semibold ring-1 ring-inset ring-teal-200' : 'hover:bg-gray-50' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-teal-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18" />
            </svg>
            Pesanan Saya
        </a>

        <!-- Keluar -->
        <form method="POST" action="{{ route('logout') }}" class="block pt-2">
            @csrf
            <button type="submit"
                    class="flex items-center gap-3 w-full text-left px-4 py-2.5 rounded-xl text-red-600 hover:bg-red-50 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M17 16l4-4m0 0l-4-4m4 4H7" />
                </svg>
                Keluar
            </button>
        </form>
    </nav>
</div>
