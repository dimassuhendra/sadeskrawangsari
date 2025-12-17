<div class="sidebar">
    <div class="sidebar-header">
        <img src="{{ asset('img/mainLogo.png') }}" width="60">
        <h2 style="font-size: 16px; margin-top: 10px;">DESA KRAWANG SARI</h2>
    </div>
    <nav class="sidebar-menu">
        <a href="{{ route('dashboard.warga') }}"
            class="menu-item {{ request()->routeIs('dashboard.warga') ? 'active' : '' }}">
            <i class="fas fa-home"></i> Dashboard
        </a>
        <a href="#" class="menu-item"><i class="fas fa-file-alt"></i> Pengajuan Surat</a>
        <a href="#" class="menu-item"><i class="fas fa-bullhorn"></i> Pengaduan</a>
        <a href="#" class="menu-item"><i class="fas fa-user"></i> Profil Saya</a>

        <form action="{{ route('logout.warga') }}" method="POST">
            @csrf
            <button type="submit" class="menu-item"
                style="background:none; border:none; width:100%; cursor:pointer; text-align:left;">
                <i class="fas fa-sign-out-alt"></i> Keluar
            </button>
        </form>
    </nav>
</div>