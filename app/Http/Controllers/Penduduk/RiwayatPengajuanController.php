<?php

namespace App\Http\Controllers\Penduduk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PengajuanSurat;

class RiwayatPengajuanController extends Controller
{
    public function index()
    {
        // Ambil NIK warga yang sedang login
        $nik = Auth::guard('warga')->user()->nik;

        // Ambil data pengajuan beserta relasi jenis_surat, urutkan dari yang terbaru
        $riwayat = PengajuanSurat::with('jenisSurat')
            ->where('warga_nik', $nik)
            ->orderBy('created_at', 'desc')
            ->get();

        // Arahkan ke folder view yang baru agar lebih terstruktur
        return view('warga.riwayat', compact('riwayat'));
    }
}
