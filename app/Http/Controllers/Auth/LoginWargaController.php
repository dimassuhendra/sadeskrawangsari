<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Warga;

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

        // Cari warga berdasarkan NIK
        $warga = Warga::where('nik', $request->nik)->first();

        // Cek apakah warga ada dan memiliki akun user
        if ($warga && $warga->user) {
            // Attempt login menggunakan email dari tabel users dan password yang diinput
            if (Auth::attempt(['email' => $warga->user->email, 'password' => $request->password], $request->remember)) {

                // Pastikan yang login memang rolenya warga
                if (Auth::user()->role === 'warga') {
                    $request->session()->regenerate();
                    return redirect()->intended('/dashboard-warga');
                }

                Auth::logout();
                return back()->withErrors(['nik' => 'Akun ini bukan akun warga.']);
            }
        }

        return back()->withErrors(['nik' => 'NIK atau Password salah.'])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
