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