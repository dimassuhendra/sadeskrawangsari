<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Krawang Sari</title>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;600&family=Domine:wght@700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style-warga.css') }}">
    <style>
        body {
            display: flex;
            background-color: #f4f7f6;
            font-family: 'Fredoka', sans-serif;
            margin: 0;
        }

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

        /* --- STYLING MENU SIDEBAR --- */
        .menu-label {
            display: block;
            padding: 20px 25px 10px 25px;
            color: rgba(255, 255, 255, 0.4);
            text-transform: uppercase;
            font-size: 10px;
            letter-spacing: 1.5px;
            font-weight: 600;
        }

        .menu-item {
            padding: 12px 25px;
            display: flex;
            align-items: center;
            gap: 15px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s;
            border-left: 4px solid transparent;
            font-size: 14px;
        }

        .menu-item i {
            width: 20px;
            font-size: 18px;
        }

        .menu-item:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border-left: 4px solid var(--color-2);
        }

        .menu-item.active {
            background: var(--color-2);
            color: white;
            border-left: 4px solid white;
            font-weight: 600;
        }

        .sidebar-footer {
            margin-top: 40px;
            padding: 0 20px 20px 20px;
        }

        .btn-logout-sidebar {
            width: 100%;
            background-color: #e74c3c;
            border: none;
            color: white;
            padding: 12px;
            border-radius: 8px;
            text-align: center;
            cursor: pointer;
            font-family: 'Fredoka', sans-serif;
            font-weight: 600;
            transition: 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-logout-sidebar:hover {
            background-color: #c0392b;
        }

        .main-content {
            margin-left: 260px;
            flex: 1;
            padding: 30px;
        }

        @yield('extra-style')
    </style>
</head>

<body>
    @include('layouts.sidebar-warga')

    <div class="main-content">
        @yield('content')
    </div>
</body>

</html>