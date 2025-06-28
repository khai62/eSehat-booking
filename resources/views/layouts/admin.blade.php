<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="min-h-screen flex">
        {{-- Sidebar --}}
        <aside class="w-64 bg-white shadow-md hidden md:block">
            <div class="p-4 font-bold text-lg border-b">Admin Panel</div>

            <ul class="p-4 space-y-2">
                <li><a href="{{ route('articles.index') }}" class="block hover:text-sky-600">📄 Daftar Artikel</a></li>
                <li><a href="{{ route('articles.create') }}" class="block hover:text-sky-600">➕ Tambah Artikel</a></li>
            </ul>
        </aside>

        {{-- Konten Utama --}}
        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>
</body>
</html>
