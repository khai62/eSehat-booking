<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PasienAuthController;
use App\Http\Controllers\DokterAuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\BookingController;

// Halaman utama
Route::get('/', function () {
    return view('home');
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
    return redirect()->route('home');
})->name('logout');

// ======================= RESET PASSWORD (Universal) =======================
Route::get('/password/reset', [ForgotPasswordController::class, 'request'])->name('password.request');
Route::post('/password/email', [ForgotPasswordController::class, 'sendEmail'])->name('password.email');
Route::get('/password/reset/{token}', [ForgotPasswordController::class, 'resetForm'])->name('password.reset');
Route::post('/password/reset', [ForgotPasswordController::class, 'reset'])->name('password.update');

Route::middleware(['auth'])->group(function () {
    // ======================= DASHBOARD PASIEN =======================
    Route::get('/pasien/dashboard', [PasienController::class, 'dashboard'])->name('dashboard.pasien');

    // ======================= DASHBOARD DOKTER =======================
    Route::get('/dokter/dashboard', function () {
        return view('layouts.dokter');
    })->name('dashboard.dokter');

    // ======================= PROFILE PASIEN =======================
    Route::get('/pasien/profil', function () {
        return view('components.pasien.profile');
    })->name('profil.pasien');

    // ======================= PESANAN PASIEN =======================
    Route::get('/pesanan', [BookingController::class, 'index'])->name('pesanan.pasien');

    // ======================= DETAIL DOKTER =======================
    Route::get('/dokter/{id}', [PasienController::class, 'detailDokter'])->name('dokter.detail');

    // ======================= FORM BOOKING =======================
    Route::get('/booking/form/{id}', [BookingController::class, 'form'])->name('booking.form');

    // ======================= SIMPAN BOOKING =======================
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');

    // ======================= DASHBOARD DOKTER - BOOKING =======================
    Route::get('/dokter/booking', [BookingController::class, 'index'])->name('dokter.booking.index');
    Route::post('/dokter/booking/{booking}/update-status', [BookingController::class, 'updateStatus'])->name('booking.updateStatus');
});


// ======================= CARI PASIEN=======================
Route::get('/cari-dokter', [PasienController::class, 'cari'])->name('pasien.cari');

