<?php

use App\Http\Controllers\Auth\LoginWargaController;
use App\Http\Controllers\Auth\RegisterWargaController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\DashboardWargaController;
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
    
    // PERBAIKAN DI SINI: Panggil Controller, jangan langsung View
    Route::get('/dashboard-warga', [DashboardWargaController::class, 'index'])->name('dashboard.warga');
    
    Route::post('/logout-warga', [LoginWargaController::class, 'logout'])->name('logout.warga');
});