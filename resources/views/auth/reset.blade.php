<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Reset Password - eSehat</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-green-50 to-blue-50 min-h-screen flex items-center justify-center px-4 py-10">

    <form method="POST" action="{{ route('password.update') }}"
          class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md border border-blue-100">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold text-blue-700">🔒 Reset Password</h2>
            <p class="text-sm text-gray-600 mt-1">Silakan masukkan password baru Anda.</p>
        </div>

        @if($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-sm text-center">
                {{ $errors->first() }}
            </div>
        @endif

        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-700 mb-1" for="email">Email</label>
            <input type="email" name="email" id="email" required
                   class="w-full p-3 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
                   value="{{ old('email') }}">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-700 mb-1" for="password">Password Baru</label>
            <input type="password" name="password" id="password" required
                   class="w-full p-3 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-700 mb-1" for="password_confirmation">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required
                   class="w-full p-3 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>

        <button type="submit"
                class="w-full bg-emerald-600 text-white py-2 rounded hover:bg-emerald-700 transition shadow">
            Reset Password
        </button>

        <p class="text-center text-sm text-gray-600 mt-5">
            <a href="{{ route('login') }}" class="text-blue-600 hover:underline">← Kembali ke Login</a>
        </p>
    </form>

</body>
</html>
