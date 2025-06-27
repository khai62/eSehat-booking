<nav class="bg-white/80 backdrop-blur border-b border-teal-100 shadow-sm">
  <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
    <!-- Logo -->
    <div class="text-2xl font-bold text-teal-600 tracking-wide flex items-center gap-2">
      <svg class="w-6 h-6 text-teal-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path d="M12 8v8m4-4H8m13 0A9 9 0 1 1 3 12a9 9 0 0 1 18 0Z" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
      <span>eSehat</span>
    </div>

    <!-- Menu -->
    <div class="space-x-4">
      <a href="{{ route('login') }}"
         class="px-4 py-2 rounded-xl bg-teal-50 text-teal-700 hover:bg-teal-100 transition shadow-sm text-sm font-medium">
         Login
      </a>
      <a href="{{ route('pasien.register.form') }}"
         class="px-4 py-2 rounded-xl bg-teal-500 text-white hover:bg-teal-600 transition shadow-sm text-sm font-medium">
         Daftar
      </a>
    </div>
  </div>
</nav>
