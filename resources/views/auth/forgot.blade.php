<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Lupa Password - eSehat</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-green-50 to-blue-50 min-h-screen flex items-center justify-center px-4 py-10">

    <form method="POST" action="{{ route('password.email') }}"
          class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md border border-blue-100">
        @csrf

        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold text-blue-700">🔐 Lupa Password</h2>
            <p class="text-sm text-gray-600 mt-1">Masukkan email Anda untuk menerima link reset.</p>
        </div>

        @if(session('status'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4 text-sm text-center">
                {{ session('status') }}
            </div>
        @endif

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

        <button type="submit"
                class="w-full bg-emerald-600 text-white py-2 rounded hover:bg-emerald-700 transition shadow">
            Kirim Link Reset
        </button>

        <p class="text-center text-sm text-gray-600 mt-5">
            <a href="{{ route('login') }}" class="text-blue-600 hover:underline">← Kembali ke Login</a>
        </p>
    </form>

</body>
</html>
