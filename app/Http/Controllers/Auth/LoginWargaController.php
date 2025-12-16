<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginWargaController extends Controller
{
    public function showLoginForm() {
        return view('auth.login-warga');
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'nik' => 'required|string',
            'password' => 'required',
        ]);

        if (Auth::guard('warga')->attempt(['nik' => $request->nik, 'password' => $request->password], $request->remember)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard-warga');
        }

        return back()->withErrors(['nik' => 'NIK atau Password salah.']);
    }

    public function logout(Request $request) {
        Auth::guard('warga')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}