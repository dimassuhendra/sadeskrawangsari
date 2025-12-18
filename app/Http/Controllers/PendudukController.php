<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use App\Models\Keluarga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PendudukController extends Controller
{
    public function index(Request $request)
    {
        $query = Warga::with('keluarga');

        // Filter Pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                    ->orWhere('nik', 'like', "%{$search}%")
                    ->orWhereHas('keluarga', function ($k) use ($search) {
                        $k->where('nama_kepala_keluarga', 'like', "%{$search}%");
                    });
            });
        }

        // Sorting
        if ($request->sort === 'nama') {
            $query->orderBy('nama_lengkap', 'asc');
        } elseif ($request->sort === 'nik') {
            $query->orderBy('nik', 'asc');
        } else {
            $query->latest();
        }

        $warga = $query->paginate(10)->withQueryString();

        // Masking Data Sensitif
        $warga->getCollection()->transform(function ($item) {
            $item->nik_masked = substr($item->nik, 0, 10) . '******';
            $item->no_kk_masked = $item->no_kk ? substr($item->no_kk, 0, 10) . '******' : '-';
            return $item;
        });

        // Statistik untuk Header
        $totalWarga = Warga::count();
        $totalKeluarga = Keluarga::count();

        // Data Chart
        $genderStats = Warga::select('jenis_kelamin', DB::raw('count(*) as total'))
            ->groupBy('jenis_kelamin')->get();

        $statusNikahStats = Warga::select('status_perkawinan', DB::raw('count(*) as total'))
            ->groupBy('status_perkawinan')->get();

        $ageStats = Warga::select(DB::raw("
            CASE 
                WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) < 18 THEN 'Anak'
                WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 18 AND 60 THEN 'Produktif'
                ELSE 'Lansia'
            END as kelompok_usia,
            COUNT(*) as total
        "))->groupBy('kelompok_usia')->get();

        return view('admin.penduduk', compact(
            'warga',
            'totalWarga',
            'totalKeluarga',
            'genderStats',
            'statusNikahStats',
            'ageStats'
        ));
    }

    // Pastikan route ini terdaftar di web.php: Route::get('/admin/penduduk/detail/{nik}', ...)
    public function show($nik)
    {
        // Menggunakan first() karena nik adalah string/primary key manual
        $data = Warga::with('keluarga')->where('nik', $nik)->first();

        if (!$data) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json($data);
    }

    public function destroy($nik)
    {
        Warga::where('nik', $nik)->delete();
        return redirect()->back()->with('success', 'Data penduduk berhasil dihapus');
    }
}