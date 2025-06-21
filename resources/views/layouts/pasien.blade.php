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
</html>
