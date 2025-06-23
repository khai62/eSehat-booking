<aside id="sidebar" class="bg-blue-50 h-screen w-64 p-5 flex flex-col justify-between shadow transition-all duration-300 overflow-hidden">
    
    {{-- Logo dan Toggle --}}
    <div>
        <div class="flex items-center justify-between p-2">
            <h1 class="text-xl font-bold text-blue-600 whitespace-nowrap sidebar-text">eSehat</h1>
            <button onclick="toggleSidebar()" class="text-gray-500 hover:text-blue-600">
                ☰
            </button>
        </div>

        {{-- Menu --}}
        <ul class="space-y-2 mt-6">
            <li>
                <a href="{{ route('dashboard.dokter') }}" class="flex items-center space-x-3 px-3 py-2 rounded-md hover:bg-blue-100 {{ request()->routeIs('dashboard.dokter') ? 'bg-blue-200 font-semibold' : '' }}">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0h6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    <span class="sidebar-text">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center space-x-3 px-3 py-2 rounded-md hover:bg-blue-100">
                    <span>👤</span>
                    <span class="sidebar-text">Profile</span>
                </a>
            </li>
            <li>
                <a href="{{ route('dokter.riwayat') }}" class="flex items-center space-x-3 px-3 py-2 rounded-md hover:bg-blue-100">
                    <span>📋</span>
                    <span class="sidebar-text">Riwayat Kunjungan</span>
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center space-x-3 px-3 py-2 rounded-md hover:bg-blue-100">
                    <span>🧑‍⚕️</span>
                    <span class="sidebar-text">Atur Jadwal Praktik</span>
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center space-x-3 px-3 py-2 rounded-md hover:bg-blue-100">
                    <span>⚙️</span>
                    <span class="sidebar-text">Pengaturan</span>
                </a>
            </li>
        </ul>
    </div>

    {{-- Footer --}}
<div class="mt-10 border-t pt-4">
    {{-- Profil --}}
    <div class="flex items-center space-x-3 mb-4">
        <img src="{{ Auth::user()->foto ? asset('storage/' . Auth::user()->foto) : 'https://via.placeholder.com/40' }}" class="w-10 h-10 rounded-full object-cover" alt="Profile">
        <div class="sidebar-text">
            <p class="text-sm font-semibold">{{ Auth::user()->name }}</p>
            <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
        </div>
    </div>

    {{-- Tombol Logout --}}
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="w-full text-left text-red-600 hover:text-red-800 hover:underline text-sm">
            🚪 Keluar
        </button>
    </form>
</div>
</aside>
