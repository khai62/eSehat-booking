<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register Dokter</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .step { display: none; }
        .step.active { display: block; }
    </style>
</head>
<body class="bg-gradient-to-br from-green-50 to-blue-50 min-h-screen flex items-center justify-center py-16 px-4">

    <form id="registerForm" method="POST" action="{{ route('dokter.register') }}" enctype="multipart/form-data"
        class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-2xl space-y-6 border border-green-100">
        @csrf

        {{-- Step 1: Akun --}}
        <div class="step active" data-step="1">
            <h2 class="text-2xl font-bold text-green-700 mb-4">Informasi Akun</h2>
            <input name="name" placeholder="Nama Lengkap" class="w-full p-3 border rounded mb-3 focus:ring-2 focus:ring-green-300" required>
            <input name="email" type="email" placeholder="Email" class="w-full p-3 border rounded mb-3 focus:ring-2 focus:ring-green-300" required>
            <input name="password" type="password" placeholder="Password" class="w-full p-3 border rounded mb-3 focus:ring-2 focus:ring-green-300" required>
            <input name="password_confirmation" type="password" placeholder="Konfirmasi Password" class="w-full p-3 border rounded mb-3 focus:ring-2 focus:ring-green-300" required>
        </div>

        {{-- Step 2: Data Pribadi --}}
        <div class="step" data-step="2">
            <h2 class="text-2xl font-bold text-green-700 mb-4">Data Pribadi</h2>

            <select name="gender" class="w-full p-3 border rounded mb-3 focus:ring-2 focus:ring-green-300" required>
                <option value="">-- Jenis Kelamin --</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>

            <input name="birthdate" type="date" placeholder="Tanggal Lahir" class="w-full p-3 border rounded mb-3 focus:ring-2 focus:ring-green-300" required>
            <input name="city" placeholder="Kota Domisili" class="w-full p-3 border rounded mb-3 focus:ring-2 focus:ring-green-300" required>
            <input name="alamat_rumah" placeholder="Alamat Rumah" class="w-full p-3 border rounded mb-3 focus:ring-2 focus:ring-green-300" required>
            <input name="no_hp" placeholder="Nomor HP" class="w-full p-3 border rounded mb-3 focus:ring-2 focus:ring-green-300" required>
            <input name="pendidikan" placeholder="Pendidikan Terakhir" class="w-full p-3 border rounded mb-3 focus:ring-2 focus:ring-green-300" required>

            <label class="block mb-2 text-gray-700 font-medium">Foto Profil</label>
            <input type="file" name="foto" accept="image/*" class="w-full p-2 border rounded mb-3">
        </div>

        {{-- Step 3: Informasi Kedokteran --}}
        <div class="step" data-step="3">
            <h2 class="text-2xl font-bold text-green-700 mb-4">Informasi Kedokteran</h2>
            <input name="no_lisensi" placeholder="No Lisensi" class="w-full p-3 border rounded mb-3 focus:ring-2 focus:ring-green-300" required>
            <input name="spesialis" placeholder="Spesialis" class="w-full p-3 border rounded mb-3 focus:ring-2 focus:ring-green-300" required>
            <input name="pengalaman" type="number" placeholder="Pengalaman (tahun)" class="w-full p-3 border rounded mb-3 focus:ring-2 focus:ring-green-300" required>
            <input name="alamat_klinik" placeholder="Alamat Klinik" class="w-full p-3 border rounded mb-3 focus:ring-2 focus:ring-green-300" required>

            <label class="block font-medium mb-1 text-gray-700">Deskripsi Profil</label>
            <textarea name="deskripsi" rows="4" placeholder="Tulis deskripsi profil Anda di sini..." class="w-full p-3 border rounded mb-3 focus:ring-2 focus:ring-green-300" required></textarea>

            <div id="praktekContainer">
                <div class="flex gap-2 mb-2">
                    <input name="hari_praktek[]" placeholder="Hari Praktek" class="w-1/3 p-2 border rounded" required>
                    <input type="time" name="jam_mulai[]" class="w-1/3 p-2 border rounded" required>
                    <input type="time" name="jam_selesai[]" class="w-1/3 p-2 border rounded" required>
                </div>
            </div>

            <button type="button" onclick="addPraktek()" class="text-sm text-blue-600 hover:underline">
                + Tambah Hari & Jam Praktek
            </button>
        </div>

        {{-- Navigation Buttons --}}
        <div class="flex justify-between pt-4">
            <button type="button" id="prevBtn" onclick="changeStep(-1)" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400 transition hidden">Sebelumnya</button>
            <button type="button" id="nextBtn" onclick="changeStep(1)" class="bg-emerald-600 text-white px-4 py-2 rounded shadow hover:bg-emerald-700 transition">Selanjutnya</button>
            <button type="submit" id="submitBtn" class="hidden bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700 transition">Daftar</button>
        </div>

    </form>

    {{-- JS --}}
    <script>
        let currentStep = 1;
        const totalSteps = document.querySelectorAll('.step').length;

        function showStep(step) {
            document.querySelectorAll('.step').forEach((el, idx) => {
                el.classList.remove('active');
                if (idx === step - 1) el.classList.add('active');
            });

            document.getElementById('prevBtn').classList.toggle('hidden', step === 1);
            document.getElementById('nextBtn').classList.toggle('hidden', step === totalSteps);
            document.getElementById('submitBtn').classList.toggle('hidden', step !== totalSteps);
        }

        function changeStep(direction) {
            currentStep += direction;
            if (currentStep < 1) currentStep = 1;
            if (currentStep > totalSteps) currentStep = totalSteps;
            showStep(currentStep);
        }

        function addPraktek() {
            const container = document.getElementById('praktekContainer');
            const html = `
                <div class="flex gap-2 mb-2">
                    <input name="hari_praktek[]" placeholder="Hari Praktek" class="w-1/3 p-2 border rounded" required>
                    <input type="time" name="jam_mulai[]" class="w-1/3 p-2 border rounded" required>
                    <input type="time" name="jam_selesai[]" class="w-1/3 p-2 border rounded" required>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', html);
        }

        showStep(currentStep);
    </script>
</body>
</html>
