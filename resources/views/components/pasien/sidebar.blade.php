<div class="bg-white p-6 shadow rounded-lg text-sm w-48">
    <nav class="flex flex-col gap-4 font-medium text-gray-800">
        <a href="{{ route('profil.pasien') }}"
           class="{{ request()->routeIs('profil.pasien') ? 'text-blue-600 border-b-2 border-blue-600 pb-1' : 'hover:underline' }} block">
           Profil
        </a>

        <a href="{{ route('pesanan.pasien') }}"
           class="{{ request()->routeIs('pesanan.pasien') ? 'text-blue-600 border-b-2 border-blue-600 pb-1' : 'hover:underline' }} block">
           Pesanan Saya
        </a>

        <form method="POST" action="{{ route('logout') }}" class="block">
            @csrf
            <button type="submit" class="text-left text-red-600 hover:underline w-full">Keluar</button>
        </form>
    </nav>
</div>
