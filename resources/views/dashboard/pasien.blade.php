<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Pasien</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="p-10">
    <h1 class="text-2xl font-bold mb-4">Selamat datang, {{ Auth::user()->name }}</h1>
    <form method="POST" action="{{ route('pasien.logout') }}">
        @csrf
        <button class="bg-red-500 text-white px-4 py-2 rounded">Logout</button>
    </form>
</body>
</html>
