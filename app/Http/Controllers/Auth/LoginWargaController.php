<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Warga;
use Illuminate\Support\Facades\Hash;

class LoginWargaController extends Controller
{
    public function showLoginForm() {
        return view('auth.login-warga');
    }

    public function login(Request $request) {
        $request->validate([
            'nik' => 'required|string',
            'password' => 'required',
        ]);

        // --- MULAI BLOK DEBUGGING ---
        $user = Warga::where('nik', $request->nik)->first();

        // 1. Cek apakah NIK ada di database
        if (!$user) {
            return back()->withErrors(['nik' => 'Debugging: NIK tidak ditemukan di tabel warga.'])->withInput();
        }

        // 2. Cek apakah password cocok (menggunakan Hash::check)
        if (!Hash::check($request->password, $user->password)) {
            // Jika ini gagal, berarti password di DB bukan hasil dari Hash::make() 
            // atau memang password salah.
            return back()->withErrors(['nik' => 'Debugging: NIK ada, tapi Password salah atau tidak ter-hash dengan benar.'])->withInput();
        }
        // --- SELESAI BLOK DEBUGGING ---

        // Jalankan attempt yang sebenarnya
        if (Auth::guard('warga')->attempt(['nik' => $request->nik, 'password' => $request->password], $request->remember)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard-warga');
        }

        // Jika sampai sini tapi attempt gagal, biasanya masalah di config/auth.php
        return back()->withErrors(['nik' => 'Debugging: Validasi lolos tapi Guard gagal masuk. Cek config/auth.php Anda.']);
    }

    public function logout(Request $request) {
        Auth::guard('warga')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}