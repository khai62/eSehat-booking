<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>eSehat</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="icon" href="/favicon.ico" type="image/x-icon" />
</head>
<body class="flex flex-col min-h-screen bg-gray-50 text-gray-800">

  <!-- Navbar -->
  <x-navbar />

  <!-- Hero Section -->
  <section class="bg-gradient-to-r from-teal-100 to-sky-100 relative h-[320px] px-6 md:px-20 flex items-center">
    <div class="max-w-xl z-10">
      <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-4 leading-snug">
        Booking Dokter Jadi Lebih Praktis
      </h1>
      <p class="text-gray-700 mb-6">
        Temukan dokter terbaik sesuai kebutuhan Anda. Proses cepat, aman, dan tanpa antre.
      </p>
      <a href="{{ route('login') }}" class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-full shadow transition font-medium">
        Booking Sekarang
      </a>
    </div>

    <!-- Gambar Dokter -->
    <div class="absolute bottom-0 right-6 hidden md:block">
      <img src="/img/doctor.png" alt="Ilustrasi Dokter" class="h-[280px] object-contain" />
    </div>
  </section>

  <!-- Tentang eSehat -->
  <x-about />

  <!-- Artikel Kesehatan -->
  <x-artikel />

  <!-- Footer -->
  <x-footer />

</body>
</html>
