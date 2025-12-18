<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warga;
use App\Exports\PendudukExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class PendudukController extends Controller
{
    public function index(Request $request)
    {
        $query = Warga::query();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama_lengkap', 'like', "%{$request->search}%")
                    ->orWhere('nik', 'like', "%{$request->search}%")
                    ->orWhere('no_kk', 'like', "%{$request->search}%");
            });
        }
        if ($request->filled('agama'))
            $query->where('agama', $request->agama);
        if ($request->filled('status_perkawinan'))
            $query->where('status_perkawinan', $request->status_perkawinan);
        if ($request->filled('jenis_kelamin'))
            $query->where('jenis_kelamin', $request->jenis_kelamin);

        $warga = $query->latest()->paginate($request->input('per_page', 10));

        $totalWarga = Warga::count();
        $totalKeluarga = Warga::distinct('no_kk')->count();

        $genderStats = Warga::select('jenis_kelamin', DB::raw('count(*) as total'))
            ->groupBy('jenis_kelamin')->get();

        $statusNikahStats = Warga::select('status_perkawinan', DB::raw('count(*) as total'))
            ->groupBy('status_perkawinan')->get();

        $ageStats = Warga::select(DB::raw("CASE 
                WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) < 18 THEN 'Anak-anak'
                WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 18 AND 60 THEN 'Produktif'
                ELSE 'Lansia' 
            END as kelompok_usia"), DB::raw('count(*) as total'))
            ->groupBy('kelompok_usia')
            ->orderByRaw("FIELD(kelompok_usia, 'Anak-anak', 'Produktif', 'Lansia')")
            ->get();

        return view('admin.penduduk', compact(
            'warga',
            'totalWarga',
            'totalKeluarga',
            'genderStats',
            'statusNikahStats',
            'ageStats'
        ));
    }

    public function exportData(Request $request)
    {
        $columns = $request->input('columns', ['nik', 'nama_lengkap']);
        $filters = $request->only(['search', 'agama', 'status_perkawinan', 'jenis_kelamin']);

        $fileName = 'Data_Penduduk_' . date('YmdHis') . '.xlsx';
        return Excel::download(new PendudukExport($columns, $filters), $fileName);
    }

    public function show($nik)
    {
        $warga = Warga::where('nik', $nik)->first();
        return $warga ? response()->json($warga) : response()->json(['message' => 'Not Found'], 404);
    }

    public function destroy($nik)
    {
        Warga::where('nik', $nik)->delete();
        return back()->with('success', 'Data berhasil dihapus');
    }
}