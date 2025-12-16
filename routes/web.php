<?php

use App\Http\Controllers\LandingPageController;

use App\Http\Controllers\Auth\LoginWargaController;
use App\Http\Controllers\Auth\RegisterWargaController;

use Illuminate\Support\Facades\Route;

Route::get('/', [LandingPageController::class, 'index'])->name('landingpage');

Route::get('/login-warga', [LoginWargaController::class, 'showLoginForm'])->name('login.warga');
Route::post('/login-warga', [LoginWargaController::class, 'login']);
Route::middleware(['isWarga'])->group(function () {
    Route::get('/dashboard-warga', function () {
        return view('warga.dashboard');
    });
    Route::post('/logout-warga', [LoginWargaController::class, 'logout'])->name('logout.warga');
});

Route::get('/register-warga', [RegisterWargaController::class, 'showRegistrationForm'])->name('register.warga');
Route::post('/register-warga', [RegisterWargaController::class, 'register']);