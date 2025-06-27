<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register Pasien</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-100 to-green-100 min-h-screen px-4 py-24 flex items-center justify-center">

    <form method="POST" action="{{ route('pasien.register') }}"
          class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md space-y-4">
        @csrf

        <div class="text-center">
            <h2 class="text-3xl font-bold text-gray-800 mb-1">Daftar Akun Pasien</h2>
            <p class="text-sm text-gray-500">Silakan lengkapi data Anda</p>
        </div>

        {{-- Nama --}}
        <div>
            <label class="block text-sm text-gray-700 mb-1">Nama Lengkap</label>
            <input name="name" placeholder="Nama Lengkap" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-green-400 outline-none" required>
        </div>

        {{-- Email --}}
        <div>
            <label class="block text-sm text-gray-700 mb-1">Email</label>
            <input name="email" type="email" placeholder="contoh@email.com" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-green-400 outline-none" required>
        </div>

        {{-- Gender --}}
        <div>
            <label class="block text-sm text-gray-700 mb-1">Jenis Kelamin</label>
            <select name="gender" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-green-400 outline-none" required>
                <option value="">-- Pilih --</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
        </div>

        {{-- Tanggal Lahir --}}
        <div>
            <label class="block text-sm text-gray-700 mb-1">Tanggal Lahir</label>
            <input name="birthdate" type="date" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-green-400 outline-none" required>
        </div>

        {{-- Kota --}}
        <div>
            <label class="block text-sm text-gray-700 mb-1">Kota/Kabupaten</label>
            <input name="city" placeholder="Contoh: Jakarta" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-green-400 outline-none" required>
        </div>

        {{-- Password --}}
        <div>
            <label class="block text-sm text-gray-700 mb-1">Password</label>
            <input name="password" type="password" placeholder="••••••••"
                   class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-green-400 outline-none" required>
        </div>

        {{-- Konfirmasi Password --}}
        <div>
            <label class="block text-sm text-gray-700 mb-1">Konfirmasi Password</label>
            <input name="password_confirmation" type="password" placeholder="••••••••"
                   class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-green-400 outline-none" required>
        </div>

        {{-- Tombol Daftar --}}
        <button class="bg-green-600 text-white w-full py-3 rounded-lg hover:bg-green-700 transition font-semibold">
            Daftar
        </button>

        <p class="text-sm text-center text-gray-600">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-blue-600 hover:underline font-medium">Login</a>
        </p>
    </form>

</body>
</html>
