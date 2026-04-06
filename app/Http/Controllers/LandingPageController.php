<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use Illuminate\Support\Facades\DB;

class LandingPageController extends Controller
{
    public function index()
    {
        // 1. Ambil semua pengaturan desa (termasuk yang baru kita tambahkan)
        $pengaturan = DB::table('pengaturan_desa')->where('id', 1)->first();

        // 2. Ambil 3 berita terbaru yang publish
        $berita = Berita::where('status', 'publish')
            ->latest()
            ->take(3)
            ->get();

        // 3. Kirim ke view
        return view('landingpage', compact('pengaturan', 'berita'));
    }
}
