<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun Penduduk</title>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Fredoka', sans-serif;
        }

        body {
            background: #f0f2f5;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
        }

        .login-container {
            display: flex;
            width: 1000px;
            max-width: 100%;
            background: #fff;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

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
            width: 70%;
            height: 70%;
            background-image: url('{{ asset("img/login-icon.png") }}');
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
            z-index: -1;
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

        .login-right {
            flex: 1.2;
            padding: 40px 50px;
            overflow-y: auto;
            max-height: 90vh;
        }

        .login-right h1 {
            color: #48B3AF;
            margin-bottom: 5px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #333;
            font-weight: 600;
            font-size: 14px;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
            outline: none;
        }

        .form-group input:focus {
            border-color: #48B3AF;
        }

        .error-msg {
            color: #e74c3c;
            font-size: 12px;
            margin-top: 5px;
        }

        .btn-register {
            width: 100%;
            padding: 12px;
            background: #48B3AF;
            border: none;
            color: white;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 10px;
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
            <div style="position: relative; z-index: 2;">
                <h3 style="font-size: 28px;">Aktivasi Akun</h3>
                <p style="color: rgba(255,255,255,0.9);">Pastikan NIK Anda sudah terdaftar di database desa.</p>
            </div>
        </div>

        <div class="login-right">
            <h1>Daftar Akun Penduduk</h1>
            <p style="color: #666; font-size: 14px; margin-bottom: 25px;">Lengkapi data di bawah untuk membuat akun.
            </p>

            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Nomor Induk Kependudukan (NIK)</label>
                    <input type="text" name="nik" value="{{ old('nik') }}" placeholder="16 digit NIK" required>
                    @error('nik') <div class="error-msg">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="contoh@mail.com" required>
                    @error('email') <div class="error-msg">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Minimal 8 karakter" required>
                    @error('password') <div class="error-msg">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label>Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" placeholder="Ulangi password" required>
                </div>

                <button type="submit" class="btn-register">DAFTAR SEKARANG</button>

                <p style="text-align: center; margin-top: 20px; font-size: 14px;">
                    Sudah punya akun? <a href="{{ route('login-warga') }}"
                        style="color: #48B3AF; text-decoration: none; font-weight: 600;">Login di sini</a>
                </p>
            </form>
        </div>
    </div>
</body>

</html>