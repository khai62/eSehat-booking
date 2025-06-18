<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PasienAuthController;
use App\Http\Controllers\DokterAuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\LoginController;

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
    return redirect()->route('login');
})->name('logout');

// ======================= DASHBOARD BERDASARKAN ROLE =======================
Route::middleware('auth')->group(function () {
    Route::get('/pasien/dashboard', function () {
        return view('dashboard.pasien');
    })->name('dashboard.pasien');

    Route::get('/dokter/dashboard', function () {
        return view('dashboard.dokter');
    })->name('dashboard.dokter');
});

// ======================= RESET PASSWORD (Universal) =======================
Route::get('/password/reset', [ForgotPasswordController::class, 'request'])->name('password.request');
Route::post('/password/email', [ForgotPasswordController::class, 'sendEmail'])->name('password.email');
Route::get('/password/reset/{token}', [ForgotPasswordController::class, 'resetForm'])->name('password.reset');
Route::post('/password/reset', [ForgotPasswordController::class, 'reset'])->name('password.update');
