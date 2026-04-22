<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Keluarga;

class KeluargaController extends Controller
{
    public function index(Request $request)
    {
        // Panggil data keluarga sekaligus dengan anggota keluarganya
        $query = Keluarga::with('anggota:no_kk,nik,nama_lengkap');

        // Fitur Pencarian
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('no_kk', 'like', "%{$search}%")
                ->orWhere('nama_kepala_keluarga', 'like', "%{$search}%");
        }

        // Fitur Sorting
        $sort = $request->input('sort', 'terbaru');
        if ($sort == 'nama_az') {
            $query->orderBy('nama_kepala_keluarga', 'asc');
        } elseif ($sort == 'nama_za') {
            $query->orderBy('nama_kepala_keluarga', 'desc');
        } elseif ($sort == 'kk_asc') {
            $query->orderBy('no_kk', 'asc');
        } elseif ($sort == 'kk_desc') {
            $query->orderBy('no_kk', 'desc');
        } else {
            $query->latest(); // Default: Terbaru
        }

        $keluarga = $query->paginate(15)->withQueryString();
        $totalKeluarga = Keluarga::count();

        return view('admin.keluarga', compact('keluarga', 'totalKeluarga'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_kk' => 'required|string|size:16|unique:keluarga,no_kk', // No KK biasanya 16 digit
            'nama_kepala_keluarga' => 'required|string|max:150',
        ]);

        Keluarga::create($request->all());

        return redirect()->route('admin.keluarga.index')->with('success', 'Data Keluarga berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        // Parameter $id di sini sebenarnya berisi no_kk
        $keluarga = Keluarga::findOrFail($id);

        $request->validate([
            'no_kk' => 'required|string|size:16|unique:keluarga,no_kk,' . $keluarga->no_kk . ',no_kk',
            'nama_kepala_keluarga' => 'required|string|max:150',
        ]);

        $keluarga->update($request->all());

        return redirect()->route('admin.keluarga.index')->with('success', 'Data Keluarga berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $keluarga = Keluarga::findOrFail($id);
        $keluarga->delete();

        return redirect()->route('admin.keluarga.index')->with('success', 'Data Keluarga berhasil dihapus!');
    }
}
