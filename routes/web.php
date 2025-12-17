<?php

use App\Http\Controllers\Auth\LoginWargaController;
use App\Http\Controllers\Auth\RegisterWargaController;

use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\DashboardWargaController;
use App\Http\Controllers\ProfileWargaController;
use App\Http\Controllers\KeluargaController;

use Illuminate\Support\Facades\Route;

// Halaman Utama
Route::get('/', [LandingPageController::class, 'index'])->name('landingpage');

// Guest Only (Belum Login)
Route::middleware(['guest'])->group(function () {
    Route::get('/login-warga', [LoginWargaController::class, 'showLoginForm'])->name('login.warga');
    Route::post('/login-warga', [LoginWargaController::class, 'login']);

    Route::get('/register-warga', [RegisterWargaController::class, 'showRegistrationForm'])->name('register.warga');
    Route::post('/register-warga', [RegisterWargaController::class, 'register']);
});

// Authenticated (Sudah Login)
Route::middleware(['auth:warga'])->group(function () {
    Route::get('/dashboard-warga', [DashboardWargaController::class, 'index'])->name('dashboard.warga');
    Route::post('/logout-warga', [LoginWargaController::class, 'logout'])->name('logout.warga');
    Route::get('/profil-saya', [ProfileWargaController::class, 'index'])->name('profile.warga');
    Route::post('/profil-saya/update', [ProfileWargaController::class, 'update'])->name('profile.update');
    Route::get('/data-keluarga', [KeluargaController::class, 'index'])->name('keluarga.warga');
    Route::post('/data-keluarga/store', [KeluargaController::class, 'storeKeluarga'])->name('keluarga.store');
    Route::post('/data-keluarga/add-anggota', [KeluargaController::class, 'addAnggota'])->name('keluarga.addAnggota');
});