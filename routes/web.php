<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PasienAuthController;
use App\Http\Controllers\DokterAuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\DokterJadwalController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Admin\AuthController;
use App\Models\Article;

// Halaman utama
Route::get('/', function () {
    $articles = Article::latest()->take(4)->get(); // Ambil 4 artikel terbaru
    return view('home', compact('articles'));
})->name('home');

// ======================= REGISTER PASIEN =======================
Route::get('/pasien/register', [PasienAuthController::class, 'showRegister'])->name('pasien.register.form');
Route::post('/pasien/register', [PasienAuthController::class, 'register'])->name('pasien.register');

// ======================= REGISTER DOKTER =======================
Route::get('/dokter/register', [DokterAuthController::class, 'showRegister'])->name('dokter.register.form');
Route::post('/dokter/register', [DokterAuthController::class, 'register'])->name('dokter.register');

// ======================= LOGIN UNIVERSAL (ROLE BASED) =======================
Route::get('/login', function () {
    return view('login.login'); // View login umum
})->name('login');

Route::post('/login', [LoginController::class, 'login'])->name('login.process');

// ======================= LOGOUT =======================
Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('home'); // ← ARAHKAN KE HALAMAN UTAMA
})->name('logout');

// ======================= RESET PASSWORD (Universal) =======================
Route::get('/password/reset', [ForgotPasswordController::class, 'request'])->name('password.request');
Route::post('/password/email', [ForgotPasswordController::class, 'sendEmail'])->name('password.email');
Route::get('/password/reset/{token}', [ForgotPasswordController::class, 'resetForm'])->name('password.reset');
Route::post('/password/reset', [ForgotPasswordController::class, 'reset'])->name('password.update');

   Route::get('/artikel/kategori/{kategori}', function ($kategori) {
    $articles = Article::where('category', 'LIKE', str_replace('-', ' ', $kategori))->latest()->get();
    return view('components.artikel-kategori', compact('articles', 'kategori'));
})->name('artikel.kategori');


Route::middleware(['auth'])->group(function () {
    // ======================= DASHBOARD PASIEN =======================
    Route::get('/pasien/dashboard', [PasienController::class, 'dashboard'])->name('dashboard.pasien');


    // ======================= DASHBOARD DOKTER =======================
    Route::get('/dokter/dashboard', [BookingController::class, 'dokterDashboard'])->name('dashboard.dokter');
    // ======================= PROFILE PASIEN =======================
    Route::get('/pasien/profil', function () {return view('components.pasien.profile');})->name('profil.pasien');
    Route::get('/pasien/profil/edit',  [PasienController::class, 'edit'  ])->name('pasien.profil.edit');
    Route::put('/pasien/profil/edit',  [PasienController::class, 'update'])->name('pasien.profil.update');


    // ======================= PESANAN PASIEN =======================
    Route::get('/pesanan', [BookingController::class, 'index'])->name('pesanan.pasien');


    // ======================= FORM BOOKING =======================
    Route::get('/booking/form/{id}', [BookingController::class, 'form'])->name('booking.form');

    // ======================= SIMPAN BOOKING =======================
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');

    // ======================= DASHBOARD DOKTER - BOOKING =======================
    Route::get('/dokter/booking', [BookingController::class, 'index'])->name('dokter.booking.index');
    Route::post('/dokter/booking/{booking}/update-status', [BookingController::class, 'updateStatus'])->name('booking.updateStatus');
    Route::get('/dokter/riwayat-kunjungan', [BookingController::class, 'riwayatKunjungan'])->name('dokter.riwayat');

    Route::get('/profile',  [DokterController::class, 'edit'])->name('dokter.profile.edit');
    Route::put('/profile',  [DokterController::class, 'update'])->name('dokter.profile.update');


    Route::get('/jadwal',  [DokterJadwalController::class, 'edit'])->name('jadwal.edit');
          // proses simpan
    Route::put('/jadwal',  [DokterJadwalController::class, 'update'])->name('jadwal.update');

    // --------------------------------

    Route::get('/artikel', function () {$articles = Article::latest()->get();return view('artikel', compact('articles'));})->name('artikel.public');

    Route::resource('articles', ArticleController::class);

    Route::post('/logout', [AuthController::class,'logout'])->name('logout');
    Route::get('/dashboard', fn() => redirect()->route('articles.index'))->name('admin.dashboard');

    Route::get('/artikel/{id}', function ($id) {
    $article = Article::findOrFail($id);
    return view('components.artikel-detail', compact('article'));
})->name('artikel.detail');

    // ======================= DETAIL DOKTER =======================
    Route::get('/dokter/{id}', [PasienController::class, 'detailDokter'])->name('dokter.detail');



});


// ======================= CARI PASIEN=======================
Route::get('/cari-dokter', [PasienController::class, 'cari'])->name('pasien.cari');





