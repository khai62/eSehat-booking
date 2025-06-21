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

  <x-artikel></x-artikel>

  <!-- Footer -->
  <x-footer />

</body>
</html>
