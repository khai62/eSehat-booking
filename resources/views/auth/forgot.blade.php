<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Lupa Password - eSehat</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <form method="POST" action="{{ route('password.email') }}" class="bg-white p-6 rounded shadow-md w-full max-w-md">
        @csrf

        <h2 class="text-xl font-bold mb-4 text-center">Lupa Password</h2>

        @if(session('status'))
            <div class="bg-green-100 text-green-700 p-2 rounded mb-4">
                {{ session('status') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 text-red-700 p-2 rounded mb-4">
                {{ $errors->first() }}
            </div>
        @endif

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1" for="email">Email</label>
            <input type="email" name="email" id="email" required class="w-full border rounded p-2" value="{{ old('email') }}">
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded w-full hover:bg-blue-700">Kirim Link Reset</button>

        <p class="text-center text-sm text-gray-600 mt-4">
            <a href="{{ route('login') }}" class="text-blue-700 underline">Kembali ke login</a>
        </p>
    </form>
</body>
</html>
