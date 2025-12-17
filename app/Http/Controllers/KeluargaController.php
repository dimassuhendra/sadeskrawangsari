<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keluarga;
use App\Models\Warga;
use Illuminate\Support\Facades\Auth;

class KeluargaController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Cari data keluarga berdasarkan no_kk user yang login
        $keluarga = Keluarga::with('anggota')->find($user->no_kk);

        return view('warga.keluarga', compact('user', 'keluarga'));
    }

    public function storeKeluarga(Request $request)
    {
        $request->validate([
            'no_kk' => 'required|digits:16|unique:keluarga,no_kk',
            'nama_kepala_keluarga' => 'required|string|max:150',
        ]);

        Keluarga::create($request->all());

        // Otomatis update no_kk di profil user yang sedang login
        Warga::where('nik', Auth::user()->nik)->update(['no_kk' => $request->no_kk]);

        return back()->with('success', 'Data Keluarga berhasil dibuat!');
    }

    public function addAnggota(Request $request)
    {
        $request->validate([
            'nik' => 'required|digits:16',
            'nama_lengkap' => 'required|string|max:150',
        ]);

        $user = Auth::user();

        // Hubungkan NIK tersebut ke No KK user saat ini
        Warga::updateOrCreate(
            ['nik' => $request->nik],
            [
                'nama_lengkap' => $request->nama_lengkap,
                'no_kk' => $user->no_kk,
                // Default data wajib lainnya jika warga baru benar-benar belum ada
                'is_active' => 1
            ]
        );

        return back()->with('success', 'Anggota keluarga berhasil ditambahkan!');
    }
}