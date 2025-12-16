<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk Akun Penduduk</title>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-box-sizing: border-box;
            font-family: 'Fredoka', sans-serif;
        }

        body {
            background: #f0f2f5;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .login-container {
            display: flex;
            width: 900px;
            max-width: 95%;
            background: #fff;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        /* Sisi Kiri - Gambar */
        .login-left {
            flex: 1;
            background-color: #48B3AF;
            padding: 40px;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .login-left::after {
            content: "";
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 80%;
            height: 80%;
            background-image: url('{{ asset("img/login-icon.png") }}');
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
            z-index: -1;
            opacity: 1;
        }

        .header-logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .header-logo,
        .login-left-content {
            position: relative;
            z-index: 2;
        }

        .header-logo img {
            width: 50px;
        }

        .header-logo h2 {
            font-size: 14px;
            line-height: 1.2;
        }

        /* Sisi Kanan - Form */
        .login-right {
            flex: 1;
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-right h1 {
            color: #48B3AF;
            margin-bottom: 10px;
        }

        .login-right p {
            color: #666;
            margin-bottom: 30px;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #333;
            font-weight: 600;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            outline: none;
        }

        .form-group input:focus {
            border-color: #48B3AF;
        }

        .btn-login {
            width: 100%;
            padding: 12px;
            background: #48B3AF;
            border: none;
            color: white;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-login:hover {
            background: #3a918e;
        }

        .footer-links {
            display: flex;
            flex-direction: column;
            font-size: 13px;
        }

        .footer-links-top {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
            font-size: 13px;
        }

        .footer-links a {
            color: #48B3AF;
            text-decoration: none;
        }

        @media (max-width: 768px) {
            .login-left {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-left">
            <div class="header-logo">
                <img src="{{ asset('img/mainLogo.png') }}" alt="Logo">
                <div>
                    <h2>SISTEM INFORMASI PENDUDUK<br>DESA KRAWANG SARI<br>LAMPUNG SELATAN</h2>
                </div>
            </div>
            <div>
                <h3 style="font-size: 32px;">Selamat Datang Kembali</h3>
                <p style="color: rgba(255,255,255,0.8);">Silahkan login untuk mengakses layanan persuratan mandiri desa.
                </p>
            </div>
        </div>

        <div class="login-right">
            <h1>Masuk Akun Penduduk</h1>
            <p>Masukkan NIK dan Password Anda untuk melanjutkan.</p>

            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>NIK</label>
                    <input type="text" name="nik" placeholder="Masukkan 16 digit NIK" required>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="********" required>
                </div>

                <div style="margin-bottom: 20px;">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember" style="display: inline; font-size: 13px; font-weight: 400;">Ingat Saya</label>
                </div>

                <button type="submit" class="btn-login">MASUK</button>

                <div class="footer-links">
                    <div class="footer-links-top">
                        <span>Belum punya akun? <a href="{{ route('register') }}">Daftar</a></span>
                        <a href="#">Lupa Password?</a>
                    </div>
                    <a href="{{ route('landingpage') }}">Kembali ke Halaman Utama</a>
                </div>
            </form>
        </div>
    </div>

</body>

</html>