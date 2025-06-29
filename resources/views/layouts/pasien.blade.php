{{-- resources/views/layouts/pasien.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>@yield('title', 'Dashboard Pasien - eSehat')</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">

  {{-- Navbar --}}
  @include('components.pasien.navbar')

{{-- Hero: hanya tampil kalau halaman punya section hero --}}
  @hasSection('hero')
    @yield('hero')
  @endif


  {{-- Konten --}}
  <main class="w-full flex-1">
    @yield('content')
  </main>

  <x-footer></x-footer>
</body>
{{-- JavaScript Validasi Durasi Booking --}}
<script>
document.addEventListener('DOMContentLoaded', () => {
  const form = document.querySelector('form[action="{{ route('booking.store') }}"]');
  if (!form) return;

  const errorBox = document.createElement('p');
  errorBox.className = 'mt-2 text-red-600 text-sm hidden';
  // sisipkan tepat setelah input jam_selesai
  form.querySelector('[name="jam_selesai"]').after(errorBox);

  form.addEventListener('submit', e => {
    const mulai   = form['jam_mulai'].value;
    const selesai = form['jam_selesai'].value;

    errorBox.classList.add('hidden');      // reset
    errorBox.textContent = '';

    if (mulai && selesai) {
      const durasi = (new Date(`1970-01-01T${selesai}`) - new Date(`1970-01-01T${mulai}`)) / 3600000;
      if (durasi < 1) {
        e.preventDefault();
        errorBox.textContent = 'Durasi minimal booking adalah 1 jam.';
        errorBox.classList.remove('hidden');
        // tambahkan highlight
        form['jam_selesai'].classList.add('border-red-500', 'ring-2', 'ring-red-200');
      }
    }
  });
});



    const sidebar = document.getElementById('sidebarPasien');
    const toggleBtn = document.getElementById('btnSidebarPasien');
    const overlay = document.getElementById('overlaySidebarPasien');

    toggleBtn.addEventListener('click', () => {
        sidebar.classList.toggle('-translate-x-full');
        overlay.classList.toggle('hidden');
    });

    overlay.addEventListener('click', () => {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
    });

</script>

</html>
