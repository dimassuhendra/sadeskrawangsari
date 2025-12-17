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
        }

        .sidebar a {
            text-decoration: none !important;
            /* Hilangkan garis bawah */
            color: rgba(255, 255, 255, 0.8) !important;
            /* Warna teks putih agak transparan */
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

        body.sidebar-closed .sidebar {
            transform: translateX(-100%);
        }

        /* --- MAIN CONTENT (ANTI-TINDIH) --- */
        .main-content {
            flex: 1;
            /* Inilah yang mencegah konten tertutup sidebar */
            margin-left: var(--sidebar-width);
            padding: 30px;
            padding-top: 80px;
            /* Ruang untuk tombol toggle */
            transition: margin-left var(--transition-speed) ease;
            min-height: 100vh;
            width: 100%;
        }
        @yield('extra-style')
    </style>
</head>

<body class="">
    @include('layouts.sidebar-warga')

    <div class="main-content">
        @yield('content')
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const btn = document.getElementById('sidebarToggle');
            const body = document.body;

            btn.addEventListener('click', function () {
                body.classList.toggle('sidebar-closed');

                const icon = btn.querySelector('i');
                if (body.classList.contains('sidebar-closed')) {
                    icon.classList.replace('fa-bars', 'fa-chevron-right');
                } else {
                    icon.classList.replace('fa-chevron-right', 'fa-bars');
                }
            });
        });
    </script>
</body>

</html>