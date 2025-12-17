<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Warga - Krawang Sari</title>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;600&family=Domine:wght@700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style-warga.css') }}">
    <style>
        body {
            display: flex;
            background-color: #f4f7f6;
            font-family: 'Fredoka', sans-serif;
        }

        /* Sidebar */
        .sidebar {
            width: 260px;
            background-color: var(--color-1);
            min-height: 100vh;
            color: white;
            position: fixed;
        }

        .sidebar-header {
            padding: 30px 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-menu {
            padding: 20px 0;
        }

        .menu-item {
            padding: 15px 25px;
            display: flex;
            align-items: center;
            gap: 15px;
            color: white;
            text-decoration: none;
            transition: 0.3s;
        }

        .menu-item:hover,
        .menu-item.active {
            background-color: var(--color-2);
        }

        /* Main Content */
        .main-content {
            margin-left: 260px;
            flex: 1;
            padding: 30px;
        }

        .welcome-card {
            background: linear-gradient(to right, var(--color-2), #3a918e);
            color: white;
            padding: 30px;
            border-radius: 15px;
            margin-bottom: 30px;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: white;
        }

        /* Table/List Section */
        .content-section {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .btn-request {
            background-color: var(--color-2);
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            float: right;
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <div class="sidebar-header">
            <img src="{{ asset('img/mainLogo.png') }}" width="60">
            <h2 style="font-size: 16px; margin-top: 10px;">DESA KRAWANG SARI</h2>
        </div>
        <nav class="sidebar-menu">
            <a href="#" class="menu-item active"><i class="fas fa-home"></i> Dashboard</a>
            <a href="#" class="menu-item"><i class="fas fa-file-alt"></i> Pengajuan Surat</a>
            <a href="#" class="menu-item"><i class="fas fa-bullhorn"></i> Pengaduan</a>
            <a href="#" class="menu-item"><i class="fas fa-user"></i> Profil Saya</a>
            <form action="{{ route('logout.warga') }}" method="POST">
                @csrf
                <button type="submit" class="menu-item"
                    style="background:none; border:none; width:100%; cursor:pointer;">
                    <i class="fas fa-sign-out-alt"></i> Keluar
                </button>
            </form>
        </nav>
    </div>

    <div class="main-content">
        <div class="welcome-card">
            <h1>Halo, {{ $user->nama_lengkap }}!</h1>
            <p>Selamat datang di sistem layanan mandiri Desa Krawang Sari. NIK Anda: {{ $user->nik }}</p>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon" style="background-color: #476EAE;"><i class="fas fa-folder"></i></div>
                <div><small>Total Pengajuan</small>
                    <h3>{{ $stats['total'] }}</h3>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background-color: #f39c12;"><i class="fas fa-clock"></i></div>
                <div><small>Sedang Diproses</small>
                    <h3>{{ $stats['proses'] }}</h3>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background-color: #27ae60;"><i class="fas fa-check-circle"></i></div>
                <div><small>Selesai</small>
                    <h3>{{ $stats['selesai'] }}</h3>
                </div>
            </div>
        </div>

        <div class="content-section">
            <a href="#" class="btn-request">+ Ajukan Surat Baru</a>
            <h2 style="font-family: 'Domine'; color: var(--color-1);">Pengumuman Desa</h2>
            <hr style="margin: 15px 0; border: 0.5px solid #eee;">

            @if($berita->count() > 0)
                @foreach($berita as $item)
                    <div style="margin-bottom: 20px; padding-bottom: 10px; border-bottom: 1px dashed #ddd;">
                        <h4 style="color: var(--color-2);">{{ $item->judul }}</h4>
                        <small class="text-muted">{{ $item->created_at->format('d M Y') }}</small>
                    </div>
                @endforeach
            @else
                <p>Belum ada pengumuman terbaru.</p>
            @endif
        </div>
    </div>

</body>

</html>