<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Warga;
use Illuminate\Http\Request;

class PendudukController extends Controller
{
    public function index()
    {
        // Mengambil semua data warga, urutkan berdasarkan yang terbaru didaftarkan
        $warga = Warga::latest()->paginate(10);
        return view('admin.penduduk', compact('warga'));
    }

    public function show($nik)
    {
        $warga = Warga::findOrFail($nik);
        return view('penduduk.show', compact('warga'));
    }

    public function destroy($nik)
    {
        $warga = Warga::findOrFail($nik);
        $warga->delete();

        return redirect()->route('admin.penduduk')->with('success', 'Data penduduk berhasil dihapus.');
    }
}