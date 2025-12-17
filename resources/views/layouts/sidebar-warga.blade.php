<?php
// 1. Set timezone ke Asia/Jakarta (GMT+7)
date_default_timezone_set('Asia/Jakarta');

// 2. Buat array untuk nama hari dan bulan dalam Bahasa Indonesia
$nama_hari = [
    'Sunday' => 'Minggu', 'Monday' => 'Senin', 'Tuesday' => 'Selasa',
    'Wednesday' => 'Rabu', 'Thursday' => 'Kamis', 'Friday' => 'Jumat', 'Saturday' => 'Sabtu'
];

$nama_bulan = [
    1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
    'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
];

// 3. Ambil data waktu sekarang
$hari_inggris = date('l');
$hari = $nama_hari[$hari_inggris];
$tanggal = date('d');
$bulan_angka = (int)date('m');
$bulan = $nama_bulan[$bulan_angka];
$tahun = date('Y');
$jam = date('H:i:s');
?>
<div class="sidebar">
    <div class="sidebar-header">
        <img src="{{ asset('img/mainLogo.png') }}" width="60">
        <h3 style="margin-top: 10px;">DESA KRAWANG SARI</h3>
        <h5 ><?php echo "$hari, $tanggal $bulan $tahun"; ?></h5>
    </div>

    <nav class="sidebar-menu">
        <small class="menu-label">Navigasi Utama</small>
        <a href="{{ route('dashboard.warga') }}"
            class="menu-item {{ request()->routeIs('dashboard.warga') ? 'active' : '' }}">
            <i class="fas fa-th-large"></i> Dashboard
        </a>

        <small class="menu-label">Layanan Persuratan</small>
        <a href="#" class="menu-item">
            <i class="fas fa-file-signature"></i> Buat Pengajuan
        </a>
        <a href="#" class="menu-item">
            <i class="fas fa-history"></i> Riwayat & Progres
        </a>

        <small class="menu-label">Layanan Publik</small>
        <a href="#" class="menu-item">
            <i class="fas fa-bullhorn"></i> Pengaduan Warga
        </a>

        <small class="menu-label">Data Penduduk</small>
        <a href="#" class="menu-item">
            <i class="fas fa-user-circle"></i> Profil Saya
        </a>
        <a href="#" class="menu-item">
            <i class="fas fa-id-card"></i> Data Keluarga
        </a>

        <div class="sidebar-footer">
            <form action="{{ route('logout.warga') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout-sidebar">
                    <i class="fas fa-power-off"></i> Keluar Aplikasi
                </button>
            </form>
        </div>
    </nav>
</div>