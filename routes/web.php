<?php

use App\Http\Controllers\Auth\LoginWargaController;
use App\Http\Controllers\Auth\RegisterWargaController;
use App\Http\Controllers\Auth\LoginAdminController;

use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\DashboardWargaController;
use App\Http\Controllers\PengajuanSuratController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\ProfileWargaController;
use App\Http\Controllers\KeluargaController;

use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\PendudukController;

use Illuminate\Support\Facades\Route;

// Route Pengunjung
Route::get('/', [LandingPageController::class, 'index'])->name('landingpage');

// Login Warga
Route::middleware(['guest'])->group(function () {
    Route::get('/login-warga', [LoginWargaController::class, 'showLoginForm'])->name('login.warga');
    Route::post('/login-warga', [LoginWargaController::class, 'login']);

    Route::get('/login-admin', [LoginAdminController::class, 'showLoginForm'])->name('login.admin');
    Route::post('/login-admin', [LoginAdminController::class, 'login']);

    Route::get('/register-warga', [RegisterWargaController::class, 'showRegistrationForm'])->name('register.warga');
    Route::post('/register-warga', [RegisterWargaController::class, 'register']);
});

// Route Warga
Route::middleware(['auth', 'role:warga'])->group(function () {
    Route::get('/dashboard-warga', [DashboardWargaController::class, 'index'])->name('dashboard.warga');

    Route::post('/logout-warga', [LoginWargaController::class, 'logout'])->name('logout.warga');

    Route::get('/buat-pengajuan', [PengajuanSuratController::class, 'index'])->name('pengajuan.katalog');
    Route::get('/buat-pengajuan/{jenis}', [PengajuanSuratController::class, 'create'])->name('pengajuan.create');
    Route::post('/buat-pengajuan/store', [PengajuanSuratController::class, 'store'])->name('pengajuan.store');

    Route::get('/pengaduan', [PengaduanController::class, 'index'])->name('pengaduan');
    Route::post('/pengaduan/kirim', [PengaduanController::class, 'store'])->name('pengaduan.store');

    Route::get('/profil-saya', [ProfileWargaController::class, 'index'])->name('profile.warga');
    Route::post('/profil-saya/update', [ProfileWargaController::class, 'update'])->name('profile.update');

    Route::get('/data-keluarga', [KeluargaController::class, 'index'])->name('keluarga.warga');
    Route::post('/data-keluarga/store', [KeluargaController::class, 'storeKeluarga'])->name('keluarga.store');
    Route::post('/data-keluarga/add-anggota', [KeluargaController::class, 'addAnggota'])->name('keluarga.addAnggota');
});

// Route Admin
Route::middleware(['auth', 'role:admin,kades'])->group(function () {
    Route::get('/dashboard-admin', [DashboardAdminController::class, 'index'])->name('admin.dashboard');

    Route::get('/admin/surat-masuk', [SuratMasukController::class, 'index'])->name('admin.surat-masuk');
    Route::get('/admin/surat-proses/{id}/{status}', [SuratMasukController::class, 'updateStatus'])->name('admin.surat-proses');
    Route::get('/admin/surat-detail/{id}', [SuratMasukController::class, 'show'])->name('admin.surat-detail');
    Route::get('/admin/surat-cetak/{id}', [SuratMasukController::class, 'cetakSurat'])->name('admin.surat-cetak');

    Route::get('/admin/surat-masuk', [DashboardAdminController::class, 'suratMasuk'])->name('admin.surat-masuk');
    Route::get('/admin/surat-arsip', [DashboardAdminController::class, 'suratArsip'])->name('admin.surat-arsip');
    Route::get('/admin/surat-proses', [DashboardAdminController::class, 'suratProses'])->name('admin.surat-proses');


    Route::get('/admin/penduduk', [DashboardAdminController::class, 'wargaIndex'])->name('admin.warga.index');
    Route::get('/admin/keluarga', [DashboardAdminController::class, 'keluargaIndex'])->name('admin.keluarga.index');

    Route::get('/admin/pengaduan', [DashboardAdminController::class, 'pengaduanIndex'])->name('admin.pengaduan.index');
    Route::get('/admin/berita', [DashboardAdminController::class, 'beritaIndex'])->name('admin.berita.index');

    Route::get('/admin/profile', [DashboardAdminController::class, 'profile'])->name('admin.profile');
    Route::get('/admin/pengaturan', [DashboardAdminController::class, 'pengaturan'])->name('admin.pengaturan');

    Route::get('/admin/penduduk', [PendudukController::class, 'index'])->name('admin.penduduk');
    Route::get('/admin/penduduk/export-proses', [PendudukController::class, 'exportData'])->name('admin.penduduk.export');
    Route::get('/admin/{nik}', [PendudukController::class, 'show'])->name('admin.penduduk.show');
    Route::delete('/admin/penduduk/{nik}', [PendudukController::class, 'destroy'])->name('penduduk.destroy');

    Route::post('/logout-admin', [LoginAdminController::class, 'logout'])->name('admin.logout');
});
