<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Warga;
use App\Models\User;

class LoginWargaController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login-warga');
    }

    public function login(Request $request)
    {
        $request->validate([
            'nik' => 'required|string',
            'password' => 'required',
        ]);

        // 1. Cari data warga berdasarkan NIK
        $warga = Warga::where('nik', $request->nik)->first();

        // 2. Jika NIK tidak ada di tabel warga
        if (!$warga) {
            return back()->withErrors(['nik' => 'NIK tidak terdaftar dalam data warga.'])->withInput();
        }

        // 3. Cari akun di tabel users menggunakan user_id yang ada di tabel warga
        $user = User::find($warga->user_id);

        // 4. Jika user_id di tabel warga kosong atau tidak ditemukan di tabel users
        if (!$user) {
            return back()->withErrors(['nik' => 'Akun login tidak ditemukan untuk NIK ini (user_id tidak cocok).'])->withInput();
        }

        // 5. Cek apakah password yang diinput cocok dengan password di tabel users
        // Kita gunakan Hash::check karena Auth::attempt biasanya minta email
        if (Hash::check($request->password, $user->password)) {

            // 6. Jika cocok, login-kan user tersebut ke sistem
            Auth::login($user, $request->remember);

            // 7. Pastikan role-nya adalah warga
            if (Auth::user()->role === 'warga') {
                $request->session()->regenerate();
                return redirect()->intended('/dashboard-warga');
            }

            // Jika ternyata role-nya bukan warga (misal admin nyasar)
            Auth::logout();
            return back()->withErrors(['nik' => 'Ini bukan akun warga!']);
        }

        // 8. Jika password salah
        return back()->withErrors(['nik' => 'Password yang Anda masukkan salah.'])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
