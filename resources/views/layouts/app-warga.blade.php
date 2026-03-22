<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Krawang Sari</title>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;600&family=Domine:wght@700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style-warga.css') }}">

    <style>
        :root {
            --sidebar-width: 300px;
            --transition-speed: 0.3s;
            --color-1: #48B3AF;
            /* Pastikan variabel warna terdefinisi */
        }

        body {
            display: flex;
            background-color: #f4f7f6;
            font-family: 'Fredoka', sans-serif;
            margin: 0;
            overflow-x: hidden;
        }

        /* --- SIDEBAR CUSTOMIZATION --- */
        .sidebar {
            width: var(--sidebar-width);
            background-color: var(--color-1);
            min-height: 100vh;
            color: white;
            position: fixed;
            left: 0;
            top: 0;
            transition: transform var(--transition-speed) ease;
            z-index: 1050;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            /* Tambahan shadow halus */
        }

        .sidebar a {
            text-decoration: none !important;
            color: rgba(255, 255, 255, 0.8) !important;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 25px;
            transition: all 0.3s ease;
            font-size: 14px;
        }

        .sidebar a:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white !important;
        }

        .sidebar a.active {
            background: rgba(255, 255, 255, 0.2);
            color: white !important;
            font-weight: 600;
            border-left: 4px solid white;
        }

        .sidebar a i {
            width: 20px;
            text-align: center;
            font-size: 16px;
        }

        .menu-label {
            display: block;
            padding: 20px 25px 5px 25px;
            color: rgba(255, 255, 255, 0.4) !important;
            text-transform: uppercase;
            font-size: 10px;
            letter-spacing: 1.5px;
            font-weight: 600;
        }

        /* Transisi Desktop Tutup Sidebar */
        body.sidebar-closed .sidebar {
            transform: translateX(-100%);
        }

        body.sidebar-closed .main-content {
            margin-left: 0;
        }

        /* --- MAIN CONTENT --- */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            padding: 30px;
            transition: margin-left var(--transition-speed) ease;
            min-height: 100vh;
            width: 100%;
        }

        /* --- MOBILE HEADER & TOGGLE (BARU) --- */
        .mobile-header {
            display: none;
            /* Disembunyikan di desktop */
            align-items: center;
            justify-content: space-between;
            background-color: white;
            padding: 15px 20px;
            border-radius: 12px;
            margin-bottom: 25px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        .mobile-header h4 {
            margin: 0;
            font-size: 18px;
            color: #333;
            font-weight: 600;
        }

        .btn-toggle-sidebar {
            background: var(--color-1);
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 18px;
            transition: 0.3s;
        }

        .btn-toggle-sidebar:hover {
            background: #3a918e;
        }

        /* Overlay Gelap Untuk Mobile */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1040;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        /* --- RESPONSIVE MOBILE CSS --- */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                /* Sembunyikan sidebar di mobile */
            }

            .main-content {
                margin-left: 0;
                /* Konten ambil lebar penuh */
                padding: 15px;
                /* Kurangi padding agar pas di HP */
            }

            .mobile-header {
                display: flex;
                /* Tampilkan Header & Tombol Menu di HP */
            }

            /* Kelas saat sidebar di buka di mobile via JS */
            body.mobile-sidebar-open .sidebar {
                transform: translateX(0);
            }

            body.mobile-sidebar-open .sidebar-overlay {
                display: block;
                opacity: 1;
            }

            body.mobile-sidebar-open {
                overflow: hidden;
                /* Cegah body bisa discroll saat menu terbuka */
            }
        }

        @yield('extra-style')
    </style>
</head>

<body>
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    @include('layouts.sidebar-warga')

    <div class="main-content">
        <div class="mobile-header">
            <h4>Menu Penduduk</h4>
            <button class="btn-toggle-sidebar" id="sidebarToggle">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        @yield('content')
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const btn = document.getElementById('sidebarToggle');
            const body = document.body;
            const overlay = document.getElementById('sidebarOverlay');

            // Logika Toggle Menu
            if (btn) {
                btn.addEventListener('click', function() {
                    // Cek apakah user sedang pakai Desktop atau Mobile
                    if (window.innerWidth <= 768) {
                        body.classList.toggle('mobile-sidebar-open');
                    } else {
                        body.classList.toggle('sidebar-closed');
                    }
                });
            }

            // Logika klik area gelap/overlay untuk menutup sidebar (Khusus Mobile)
            if (overlay) {
                overlay.addEventListener('click', function() {
                    body.classList.remove('mobile-sidebar-open');
                });
            }

            // Tutup sidebar otomatis jika resize dari hp ke desktop dan sidebar masih 'mobile-open'
            window.addEventListener('resize', function() {
                if (window.innerWidth > 768 && body.classList.contains('mobile-sidebar-open')) {
                    body.classList.remove('mobile-sidebar-open');
                }
            });
        });
    </script>
</body>

</html>
