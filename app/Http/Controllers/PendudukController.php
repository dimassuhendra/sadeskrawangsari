<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warga; // Pastikan nama Model Anda sesuai (Warga atau Penduduk)
use App\Exports\PendudukExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class PendudukController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');

        $query = Warga::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%$search%")
                    ->orWhere('nik', 'like', "%$search%")
                    ->orWhere('no_kk', 'like', "%$search%");
            });
        }

        // Logic Sortir
        if ($request->sort == 'nama') {
            $query->orderBy('nama_lengkap', 'asc');
        } elseif ($request->sort == 'nik') {
            $query->orderBy('nik', 'asc');
        } else {
            $query->latest();
        }

        $warga = $query->paginate($perPage);

        // Data untuk Chart & Statistik
        $totalWarga = Warga::count();
        $totalKeluarga = Warga::distinct('no_kk')->count();

        $genderStats = Warga::select('jenis_kelamin', DB::raw('count(*) as total'))
            ->groupBy('jenis_kelamin')->get();

        $statusNikahStats = Warga::select('status_perkawinan', DB::raw('count(*) as total'))
            ->groupBy('status_perkawinan')->get();

        $ageStats = Warga::select(DB::raw("
            CASE 
                WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) < 18 THEN 'Anak-anak'
                WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 18 AND 60 THEN 'Produktif'
                ELSE 'Lansia'
            END as kelompok_usia
        "), DB::raw('count(*) as total'))
            ->groupBy('kelompok_usia')->get();

        return view('admin.penduduk', compact(
            'warga',
            'totalWarga',
            'totalKeluarga',
            'genderStats',
            'statusNikahStats',
            'ageStats'
        ));
    }

    // FUNGSI INI YANG TADI HILANG/ERROR
    public function exportData(Request $request)
    {
        $columns = $request->input('columns');

        // Cek jika user belum memilih kolom
        if (!$columns || !is_array($columns)) {
            return back()->with('error', 'Silakan pilih minimal satu kolom untuk didownload.');
        }

        $search = $request->input('search');
        $format = $request->input('format', 'xlsx');
        $fileName = 'data_penduduk_' . date('Ymd_His') . '.' . $format;

        // Memanggil class Export
        $export = new PendudukExport($columns, $search);

        if ($format === 'csv') {
            return Excel::download($export, $fileName, \Maatwebsite\Excel\Excel::CSV);
        }

        return Excel::download($export, $fileName);
    }

    public function show($nik)
    {
        $data = Warga::where('nik', $nik)->first();
        if (!$data) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
        return response()->json($data);
    }

    public function destroy($nik)
    {
        Warga::where('nik', $nik)->delete();
        return back()->with('success', 'Data berhasil dihapus');
    }
}