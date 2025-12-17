<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengajuanSurat;
use App\Models\Berita;
use Illuminate\Support\Facades\Auth;

class DashboardWargaController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Mengambil statistik pengajuan surat milik warga tersebut
        $stats = [
            'total' => PengajuanSurat::where('warga_nik', $user->nik)->count(),
            'proses' => PengajuanSurat::where('warga_nik', $user->nik)->where('status', 'Diproses')->count(),
            'selesai' => PengajuanSurat::where('warga_nik', $user->nik)->where('status', 'Disetujui')->count(),
        ];

        // Mengambil 3 berita terbaru untuk widget berita
        $berita = Berita::where('status', 'publish')->latest()->take(3)->get();

        return view('warga.dashboard', compact('user',  'stats', 'berita'));
    }
}