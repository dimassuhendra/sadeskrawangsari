<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengajuanSurat;
use Illuminate\Support\Facades\Auth;

class PengajuanSuratController extends Controller
{
    // Menampilkan Katalog Pilihan Surat
    public function index()
    {
        return view('warga.pengajuan.katalog');
    }

    // Menampilkan Form Spesifik berdasarkan Jenis Surat
    public function create($jenis)
    {
        $jenis_surat = str_replace('-', ' ', ucwords($jenis, '-'));
        return view('warga.pengajuan.create', compact('jenis_surat'));
    }

    // Menyimpan Pengajuan ke Database
    public function store(Request $request)
    {
        $request->validate([
            'jenis_surat' => 'required',
            'keperluan' => 'required|string|min:10',
        ]);

        PengajuanSurat::create([
            'warga_nik' => Auth::user()->nik,
            'jenis_surat' => $request->jenis_surat,
            'keperluan' => $request->keperluan,
            'status' => 'Menunggu',
            'created_at' => now(),
        ]);

        return redirect()->route('riwayat.warga')->with('success', 'Pengajuan ' . strtoupper($request->jenis_surat) . ' berhasil dikirim!');
    }
}