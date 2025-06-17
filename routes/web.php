<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PasienAuthController;
use App\Http\Controllers\DokterAuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;

// Halaman utama
Route::get('/', function () {
    return view('home');
})->name('home');


// -------------------- PASIEN ROUTES -------------------- //

// Register Pasien
Route::get('/pasien/register', [PasienAuthController::class, 'showRegister'])->name('pasien.register.form');
Route::post('/pasien/register', [PasienAuthController::class, 'register'])->name('pasien.register');

// Login Pasien
Route::get('/pasien/login', [PasienAuthController::class, 'showLogin'])->name('pasien.login.form');
Route::post('/pasien/login', [PasienAuthController::class, 'login'])->name('pasien.login');

// Logout Pasien
Route::post('/pasien/logout', [PasienAuthController::class, 'logout'])->name('pasien.logout');

// Dashboard Pasien (auth middleware)
Route::get('/pasien/dashboard', function () {
    return view('dashboard.pasien');
})->middleware('auth')->name('dashboard.pasien');

// Fitur Lupa Password Pasien
Route::get('/pasien/password/reset', [ForgotPasswordController::class, 'request'])->name('pasien.password.request');
Route::post('/pasien/password/email', [ForgotPasswordController::class, 'sendEmail'])->name('pasien.password.email');
Route::get('/pasien/password/reset/{token}', [ForgotPasswordController::class, 'resetForm'])
    ->name('password.reset'); // biarkan ini saja, pakai ini juga untuk pasien
Route::post('/pasien/password/reset', [ForgotPasswordController::class, 'reset'])->name('pasien.password.update');


// -------------------- DOKTER ROUTES (NANTI) -------------------- //
// Bisa ditambahkan seperti berikut agar tidak bentrok:

// Route::get('/dokter/register', [DokterAuthController::class, 'showRegister'])->name('dokter.register.form');
// Route::post('/dokter/register', [DokterAuthController::class, 'register'])->name('dokter.register');

// Route::get('/dokter/login', [DokterAuthController::class, 'showLogin'])->name('dokter.login.form');
// Route::post('/dokter/login', [DokterAuthController::class, 'login'])->name('dokter.login');

// Route::post('/dokter/logout', [DokterAuthController::class, 'logout'])->name('dokter.logout');

// Route::get('/dokter/dashboard', function () {
//     return view('dashboard.dokter');
// })->middleware('auth')->name('dokter.dashboard');
