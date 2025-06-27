<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Pengguna</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-green-100 to-blue-100 min-h-screen flex items-center justify-center px-4">

    <form method="POST" action="{{ route('login.process') }}"
          class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md space-y-5">
        @csrf

        <div class="text-center">
            <h2 class="text-3xl font-bold text-gray-800 mb-1">Masuk ke eSehat</h2>
            <p class="text-sm text-gray-500">Silakan login untuk melanjutkan</p>
        </div>

        {{-- Error Handling --}}
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 px-4 py-2 rounded text-sm">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Email --}}
        <div>
            <label class="block text-sm text-gray-700 mb-1">Email</label>
            <input name="email" type="email" value="{{ old('email') }}" placeholder="nama@email.com"
                   class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-400 focus:outline-none" required>
        </div>

        {{-- Password --}}
        <div>
            <label class="block text-sm text-gray-700 mb-1">Password</label>
            <input name="password" type="password" placeholder="••••••••"
                   class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-400 focus:outline-none" required>
        </div>

        {{-- Button Login --}}
        <button type="submit"
                class="w-full bg-green-600 text-white py-3 rounded-lg font-medium hover:bg-green-700 transition">
            Login
        </button>

        {{-- Link Lupa Password --}}
        <div class="text-center">
            <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:underline">
                Lupa password?
            </a>
        </div>

        {{-- Link Registrasi --}}
        <p class="text-sm text-center text-gray-600">
            Belum punya akun?
            <a href="{{ route('pasien.register.form') }}" class="text-blue-600 hover:underline font-medium">Daftar Pasien</a> |
            <a href="{{ route('dokter.register.form') }}" class="text-blue-600 hover:underline font-medium">Daftar Dokter</a>
        </p>
    </form>

</body>
</html>
