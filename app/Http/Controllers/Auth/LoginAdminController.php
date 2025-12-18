<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class LoginAdminController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login-admin');
    }

    public function login(Request $request)
    {
        // 1. Validasi Input (Admin biasanya menggunakan username)
        $request->validate([
            'email' => 'required|string',
            'password' => 'required',
        ]);

        // --- MULAI BLOK DEBUGGING ---
        // Mencari data di tabel admin berdasarkan username
        $admin = Admin::where('email', $request->email)->first();

        // Cek apakah Admin ditemukan
        if (!$admin) {
            return back()->withErrors(['email' => 'Debugging: Alamat email tidak ditemukan.'])->withInput();
        }

        // Cek apakah password cocok
        if (!Hash::check($request->password, $admin->password)) {
            return back()->withErrors(['email' => 'Debugging: Username ada, tapi Password salah.'])->withInput();
        }
        // --- SELESAI BLOK DEBUGGING ---

        // 2. Jalankan Attempt menggunakan Guard 'admin'
        // Pastikan guard 'admin' sudah terdaftar di config/auth.php
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            $request->session()->regenerate();

            // Redirect ke halaman dashboard admin
            return redirect()->intended('/dashboard-admin');
        }

        // Jika attempt gagal padahal password benar di pengecekan manual (Hash::check)
        return back()->withErrors(['email' => 'Debugging: Guard "admin" gagal masuk. Periksa kembali config/auth.php Anda.']);
    }

    public function logout(Request $request)
    {
        // Logout dari guard admin
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect ke halaman login admin atau beranda
        return redirect('/login-admin');
    }
}