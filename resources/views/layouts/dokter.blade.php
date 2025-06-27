<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>@yield('title', 'Dashboard Dokter - eSehat')</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100  flex">

    {{-- Sidebar --}}
    @include('components.dokter.sidebar')


    {{-- Konten Utama --}}
     <main class="w-full flex-1">
        @yield('content')
    </main>
    
</body>
 <script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const texts = sidebar.querySelectorAll('.sidebar-text');

        // Toggle lebar sidebar
        sidebar.classList.toggle('w-64');
        sidebar.classList.toggle('w-20');

        // Toggle teks
        texts.forEach(text => {
            text.classList.toggle('hidden');
        });
    }
    </script>
</html>
