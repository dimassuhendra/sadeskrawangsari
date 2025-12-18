<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Warga;
use App\Models\PengajuanSurat;
use App\Models\Berita;
use App\Models\AktivitasLog; // Pastikan model ini ada, atau hapus jika belum dibuat

class DashboardAdminController extends Controller
{
    public function index()
    {
        // 1. Definisi variabel $user (Admin yang sedang login)
        $user = Auth::user();

        // 2. Definisi variabel $stats (Untuk statistik di kotak-kotak atas)
        $stats = [
            'total_warga' => Warga::count(),
            'pending' => PengajuanSurat::where('status', 'Diajukan')->count(),
            'selesai' => PengajuanSurat::where('status', 'Disetujui')->count(),
            'berita' => Berita::count(),
        ];

        // 3. Definisi variabel $permohonan_terbaru
        // Kita menggunakan with('warga') karena di DB Anda relasinya ke tabel warga (warga_nik)
        $permohonan_terbaru = PengajuanSurat::with('warga')
            ->where('status', 'Diajukan')
            ->latest()
            ->take(5)
            ->get();

        // 4. Definisi variabel $logs (Log Aktivitas)
        // Jika belum ada tabelnya di DB, kita buat array kosong agar tidak error
        $logs = [];
        if (class_exists('App\Models\AktivitasLog')) {
            $logs = AktivitasLog::latest()->take(5)->get();
        }

        // Mengirimkan semua variabel ke file Blade
        return view('admin.dashboard', compact('user', 'stats', 'permohonan_terbaru', 'logs'));
    }
}