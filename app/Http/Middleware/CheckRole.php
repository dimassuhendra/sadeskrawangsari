<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // 1. Cek apakah sudah login
        if (!Auth::check()) {
            return redirect('/');
        }

        // 2. Cek apakah role user ada di dalam daftar role yang diperbolehkan
        if (in_array(Auth::user()->role, $roles)) {
            return $next($request);
        }

        // Jika tidak punya akses, lempar ke 403 atau dashboard masing-masing
        abort(403, 'Anda tidak memiliki akses ke halaman ini.');
    }
}
