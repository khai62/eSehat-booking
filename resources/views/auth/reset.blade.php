<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Reset Password - eSehat</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <form method="POST" action="{{ route('password.update') }}" class="bg-white p-6 rounded shadow-md w-full max-w-md">
        @csrf

        <h2 class="text-xl font-bold mb-4 text-center">Reset Password</h2>

        <input type="hidden" name="token" value="{{ $token }}">

        @if($errors->any())
            <div class="bg-red-100 text-red-700 p-2 rounded mb-4">
                {{ $errors->first() }}
            </div>
        @endif

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1" for="email">Email</label>
            <input type="email" name="email" id="email" required class="w-full border rounded p-2" value="{{ old('email') }}">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1" for="password">Password Baru</label>
            <input type="password" name="password" id="password" required class="w-full border rounded p-2">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1" for="password_confirmation">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required class="w-full border rounded p-2">
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded w-full hover:bg-green-700">Reset Password</button>
    </form>
</body>
</html>
 