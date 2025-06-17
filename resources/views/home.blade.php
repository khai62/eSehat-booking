<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>eSehat</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col min-h-screen bg-gray-50">

  <!-- Navbar -->
  <x-navbar />

  <!-- Hero Section -->
  <section class="bg-gray-200 py-10 px-6 md:px-20 flex flex-col md:flex-row justify-between items-center">
    <div class="max-w-xl">
      <h2 class="text-3xl font-bold mb-4">Booking Dokter, Lebih Praktis</h2>
      <p class="text-gray-700 mb-4">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit...
      </p>
      <a href="/booking" class="bg-green-600 text-white px-6 py-2 rounded shadow hover:bg-green-700 transition">Booking Sekarang</a>
    </div>
    <img src="/img/doctor.png" alt="Dokter" class="w-60 mt-6 md:mt-0">
  </section>

  <!-- Tentang eSehat -->
  <section class="py-10 px-6 md:px-20">
    <h2 class="text-2xl font-bold mb-4">Tentang eSehat</h2>
    <p class="text-gray-600 mb-4">Lorem ipsum dolor sit amet...</p>
    <p class="text-gray-600">Aliquam at sem id lorem pulvinar commodo...</p>
  </section>

  <!-- Artikel & Sidebar -->
  <section class="bg-gray-200 py-10 px-6 md:px-20 flex flex-col md:flex-row gap-10">
    <!-- Artikel -->
    <div class="flex-1">
      <h2 class="text-xl font-bold mb-4">Artikel Kesehatan Terkini Untuk Anda</h2>
      <div class="grid gap-4">
        <div class="bg-white p-4 shadow rounded">
          <h3 class="font-semibold">Lorem ipsum dolor sit amet,</h3>
          <p class="text-sm text-gray-600">Lorem ipsum dolor sit amet, consectetur...</p>
        </div>
        <!-- Tambah artikel lain di sini -->
      </div>
    </div>

    <!-- Sidebar -->
    <aside class="w-full md:w-1/3">
      <h3 class="font-semibold mb-2">Kategori</h3>
      <ul class="space-y-2 text-gray-700">
        <li>Nutirisi</li>
        <li>Diabetes</li>
        <li>Jantung</li>
        <li>Kesehatan Mulut</li>
        <li>Kolesterol Tinggi</li>
        <li>Diet</li>
      </ul>
    </aside>
  </section>

  <!-- Footer -->
  <x-footer />

</body>
</html>
