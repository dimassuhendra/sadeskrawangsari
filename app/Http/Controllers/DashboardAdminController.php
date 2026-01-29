<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Warga;
use App\Models\PengajuanSurat;
use App\Models\Berita;
use App\Models\AktivitasLog;

class DashboardAdminController extends Controller
{
    public function index()
    {
        // 1. Ambil user dari tabel 'users' (Admin/Kades)
        $user = Auth::user();

        // 2. Statistik (Optimasi query)
        $stats = [
            'total_warga' => Warga::count(),
            'pending'     => PengajuanSurat::where('status', 'Diajukan')->count(),
            'selesai'     => PengajuanSurat::where('status', 'Disetujui')->count(),
            'berita'      => Berita::count(),
        ];

        // 3. Permohonan terbaru dengan Eager Loading
        // Mengambil data permohonan yang belum diproses (Diajukan)
        $permohonan_terbaru = PengajuanSurat::with(['warga', 'jenisSurat'])
            ->latest()
            ->take(5)
            ->get();

        // 4. Log Aktivitas (Sistem proteksi jika model belum dibuat)
        $logs = collect([]);
        if (class_exists('App\Models\AktivitasLog')) {
            $logs = \App\Models\AktivitasLog::latest()->take(5)->get();
        }

        return view('admin.dashboard', compact('user', 'stats', 'permohonan_terbaru', 'logs'));
    }
    // Tambahkan method ini di dalam DashboardAdminController.php

    public function suratMasuk(Request $request)
    {
        $user = Auth::user();

        $query = PengajuanSurat::with(['warga', 'jenisSurat'])->latest();

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $surat = $query->paginate(10);

        return view('admin.surat-masuk', compact('user', 'surat'));
    }

    public function prosesSurat($id, $status)
    {
        $pengajuan = PengajuanSurat::findOrFail($id);

        $pengajuan->update(['status' => $status]);

        return back()->with('success', 'Status permohonan berhasil diperbarui menjadi ' . $status);
    }
}
