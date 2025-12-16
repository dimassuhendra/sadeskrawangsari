<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Berita;

class LandingPageController extends Controller
{
    public function index()
    {
        // 1. Mengambil konten statis dari tabel settings
        $visi_misi = Setting::where('key', 'visi_misi')->first()->value ?? null;
        $sambutan = Setting::where('key', 'sambutan_kades')->first()->value ?? null;

        // 2. Mengambil 3 berita terbaru yang statusnya 'publish'
        $berita = Berita::where('status', 'publish')
                        ->latest()
                        ->take(3)
                        ->get();

        // 3. Mengirim data ke view welcome.blade.php
        return view('landingpage', compact('visi_misi', 'sambutan', 'berita'));
    }
}