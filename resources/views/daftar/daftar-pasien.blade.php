<!DOCTYPE html>
<html>
<head>
    <title>Register Pasien</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex justify-center items-center h-screen">
    <form method="POST" action="{{ route('pasien.register') }}" class="bg-white p-8 rounded shadow-md w-full max-w-md">
        @csrf
        <h2 class="text-2xl font-bold mb-4">Daftar</h2>

        <input name="name" placeholder="Nama Lengkap" class="w-full p-2 border rounded mb-3" required>
        <input name="email" type="email" placeholder="Email" class="w-full p-2 border rounded mb-3" required>

        <select name="gender" class="w-full p-2 border rounded mb-3" required>
            <option value="">-- Jenis Kelamin --</option>
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
        </select>

        <input name="birthdate" type="date" class="w-full p-2 border rounded mb-3" required>
        <input name="city" placeholder="Kabupaten/Kota" class="w-full p-2 border rounded mb-3" required>

        <input name="password" type="password" placeholder="Password" class="w-full p-2 border rounded mb-3" required>
        <input name="password_confirmation" type="password" placeholder="Konfirmasi Password" class="w-full p-2 border rounded mb-3" required>

        <button class="bg-green-600 text-white w-full py-2 rounded hover:bg-green-700">Daftar</button>
        <p class="text-sm mt-2 text-center">Sudah punya akun? <a href="{{ route('login') }}" class="text-blue-500 underline">Login</a></p>
    </form>
</body>
</html>
