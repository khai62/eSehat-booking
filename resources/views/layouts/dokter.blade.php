<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Dokter - eSehat</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <nav class="bg-blue-600 text-white p-4 flex justify-between items-center">
        <h1 class="text-xl font-bold">Dashboard Dokter</h1>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="bg-red-500 px-4 py-1 rounded hover:bg-red-600">Logout</button>
        </form>
    </nav>

    <main class="p-6">
        <div class="bg-white shadow-md rounded p-6">
            <h2 class="text-2xl font-semibold mb-4">Selamat datang, {{ auth()->user()->name }}</h2>
            <p>Email: {{ auth()->user()->email }}</p>
            <p>Spesialis: {{ auth()->user()->spesialis ?? '-' }}</p>
            <p>Pengalaman: {{ auth()->user()->pengalaman ?? '-' }} tahun</p>
            <p>Jadwal Praktek:</p>
            <ul class="list-disc list-inside">
                @foreach(json_decode(auth()->user()->jadwal_praktek ?? '[]', true) as $jadwal)
                    <li>{{ $jadwal['hari'] }} - {{ $jadwal['jam_mulai'] }} s/d {{ $jadwal['jam_selesai'] }}</li>
                @endforeach
            </ul>
        </div>
    </main>
</body>
</html>
