<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginAdminController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login-admin');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Gunakan guard default 'web'
        if (Auth::attempt($credentials, $request->remember)) {
            $user = Auth::user();

            if ($user->role === 'admin' || $user->role === 'kades') {
                $request->session()->regenerate();
                return redirect()->intended('/dashboard-admin');
            }

            // Jika role-nya ternyata 'warga', paksa logout
            Auth::logout();
            return back()->withErrors(['email' => 'Anda tidak memiliki akses admin.']);
        }

        return back()->withErrors(['email' => 'Email atau Password salah.'])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login-admin');
    }
}
