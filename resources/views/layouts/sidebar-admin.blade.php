<?php
date_default_timezone_set('Asia/Jakarta');

$nama_hari = [
    'Sunday' => 'Minggu',
    'Monday' => 'Senin',
    'Tuesday' => 'Selasa',
    'Wednesday' => 'Rabu',
    'Thursday' => 'Kamis',
    'Friday' => 'Jumat',
    'Saturday' => 'Sabtu'
];

$nama_bulan = [
    1 => 'Januari',
    'Februari',
    'Maret',
    'April',
    'Mei',
    'Juni',
    'Juli',
    'Agustus',
    'September',
    'Oktober',
    'November',
    'Desember'
];

$hari = $nama_hari[date('l')];
$tanggal = date('d');
$bulan = $nama_bulan[(int) date('m')];
$tahun = date('Y');
?>
<style>
    .menu-item {
        padding: 12px 25px;
        color: rgba(255, 255, 255, 0.7);
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 12px;
        transition: 0.3s;
    }

    .menu-item:hover,
    .menu-item.active {
        background: rgba(255, 255, 255, 0.1);
        color: white;
        border-left: 4px solid #fff;
    }

    .badge-count {
        background: #f1c40f;
        color: #000;
        font-size: 10px;
        padding: 2px 7px;
        border-radius: 50px;
        margin-left: auto;
        font-weight: bold;
    }
</style>
<div class="sidebar">
    <div class="sidebar-header"
        style="padding: 30px 20px; text-align: center; border-bottom: 1px solid rgba(255,255,255,0.1);">
        <img src="{{ asset('img/mainLogo.png') }}" width="60" style="filter: drop-shadow(0 4px 8px rgba(0,0,0,0.2));">
        <h3 style="margin-top: 15px; font-family: 'Domine'; font-size: 18px; letter-spacing: 1px;">PANEL ADMIN</h3>
        <h6 style="opacity: 0.8; font-weight: 400; font-size: 12px;"><?php echo "$hari, $tanggal $bulan $tahun"; ?></h6>
    </div>

    <nav class="sidebar-menu"
        style="padding: 20px 0; display: flex; flex-direction: column; height: calc(100vh - 180px); overflow-y: auto;">

        <small class="menu-label"
            style="display: block; padding: 10px 25px; opacity: 0.5; font-size: 10px; text-transform: uppercase; letter-spacing: 2px;">Ikhtisar</small>
        <a href="{{ route('admin.dashboard') }}"
            class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fas fa-chart-line"></i> Statistik Desa
        </a>

        <small class="menu-label"
            style="display: block; padding: 20px 25px 10px; opacity: 0.5; font-size: 10px; text-transform: uppercase; letter-spacing: 2px;">Manajemen
            Surat</small>
        <a href="{{ route('admin.surat.masuk') }}"
            class="menu-item {{ request()->routeIs('admin.surat.masuk') ? 'active' : '' }}">
            <i class="fas fa-envelope-open-text"></i> Permohonan Baru
            <span class="badge-count">5</span> </a>
        <a href="{{ route('admin.surat.arsip') }}" class="menu-item">
            <i class="fas fa-archive"></i> Arsip Surat Selesai
        </a>

        <small class="menu-label"
            style="display: block; padding: 20px 25px 10px; opacity: 0.5; font-size: 10px; text-transform: uppercase; letter-spacing: 2px;">Kependudukan</small>
        <a href="{{ route('admin.penduduk') }}"
            class="menu-item {{ request()->routeIs('admin.penduduk') ? 'active' : '' }}">
            <i class="fas fa-users"></i> Data Penduduk
        </a>
        <a href="{{ route('admin.keluarga.index') }}" class="menu-item">
            <i class="fas fa-address-card"></i> Kartu Keluarga
        </a>

        <small class="menu-label"
            style="display: block; padding: 20px 25px 10px; opacity: 0.5; font-size: 10px; text-transform: uppercase; letter-spacing: 2px;">Interaksi
            Publik</small>
        <a href="{{ route('admin.pengaduan.index') }}"
            class="menu-item {{ request()->routeIs('admin.pengaduan.*') ? 'active' : '' }}">
            <i class="fas fa-exclamation-circle"></i> Keluhan Warga
        </a>
        <a href="{{ route('admin.berita.index') }}" class="menu-item">
            <i class="fas fa-newspaper"></i> Kelola Berita
        </a>

        <small class="menu-label"
            style="display: block; padding: 20px 25px 10px; opacity: 0.5; font-size: 10px; text-transform: uppercase; letter-spacing: 2px;">Sistem</small>
        <a href="{{ route('admin.profile') }}" class="menu-item">
            <i class="fas fa-user-shield"></i> Profil Admin
        </a>
        <a href="{{ route('admin.pengaturan') }}" class="menu-item">
            <i class="fas fa-cog"></i> Pengaturan Desa
        </a>

        <div class="sidebar-footer" style="margin-top: auto; padding: 20px;">
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout-sidebar"
                    style="width: 100%; padding: 12px; border-radius: 10px; border: none; background: #e74c3c; color: white; font-weight: 600; display: flex; align-items: center; justify-content: center; gap: 10px; transition: 0.3s;">
                    <i class="fas fa-sign-out-alt"></i> Keluar Panel
                </button>
            </form>
        </div>
    </nav>
</div>