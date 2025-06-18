<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Pengguna</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex justify-center items-center min-h-screen">
    <form method="POST" action="{{ route('login.process') }}" class="bg-white p-8 rounded shadow-md w-full max-w-md">
        @csrf

        <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Login</h2>

        @if ($errors->any())
            <div class="mb-4 bg-red-100 text-red-700 px-4 py-2 rounded">
                <ul class="text-sm list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <input name="email" type="email" placeholder="Email" value="{{ old('email') }}"
               class="w-full p-3 border rounded mb-4 focus:outline-none focus:ring-2 focus:ring-blue-400" required>

        <input name="password" type="password" placeholder="Password"
               class="w-full p-3 border rounded mb-4 focus:outline-none focus:ring-2 focus:ring-blue-400" required>

        <button type="submit"
                class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700 transition">
            Login
        </button>

        <div class="mt-3 text-center">
            <a href="{{ route('password.request') }}" class="text-sm text-blue-500 hover:underline">
                Lupa password?
            </a>
        </div>

        <p class="mt-4 text-sm text-center text-gray-600">
            Belum punya akun?
            <a href="{{ route('pasien.register.form') }}" class="text-blue-500 hover:underline">Daftar Pasien</a> |
            <a href="{{ route('dokter.register.form') }}" class="text-blue-500 hover:underline">Daftar Dokter</a>
        </p>
    </form>
</body>
</html>
