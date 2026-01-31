<?php

namespace App\Http\Controllers;

use App\Models\PengajuanSurat;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuratMasukController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $query = PengajuanSurat::with(['warga', 'jenisSurat'])->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $surat = $query->paginate(10);
        return view('admin.surat-masuk', compact('user', 'surat'));
    }

    public function updateStatus($id, $status)
    {
        $pengajuan = PengajuanSurat::findOrFail($id);
        $pengajuan->update(['status' => $status]);

        return back()->with('success', "Status permohonan berhasil diubah menjadi $status.");
    }

    // Fungsi untuk mengambil data detail via AJAX
    public function show($id)
    {
        $surat = PengajuanSurat::with(['warga', 'jenisSurat'])->findOrFail($id);

        // Kita kirim dalam bentuk JSON agar bisa ditampilkan di Modal tanpa reload
        return response()->json([
            'nama' => $surat->warga->nama_lengkap,
            'nik' => $surat->warga_nik,
            'jenis' => $surat->jenisSurat->nama_surat,
            'tanggal' => $surat->created_at->format('d F Y'),
            'status' => $surat->status,
            'keperluan' => $surat->keperluan ?? 'Tidak disebutkan',
            // Tambahkan field lain sesuai kebutuhan (misal: foto dokumen)
        ]);
    }

    public function cetakSurat($id)
    {
        // Load pengajuan beserta warga, jenisSurat, dan semua kemungkinan detail
        $surat = PengajuanSurat::with([
            'warga',
            'jenisSurat',
            'penghasilanDetail', // Contoh relasi detail
            'sktmDetail'
        ])->findOrFail($id);

        if ($surat->status !== 'Disetujui') {
            return redirect()->back()->with('error', 'Surat belum disetujui.');
        }

        $namaSurat = $surat->jenisSurat->nama_surat;

        // Mapping Template berdasarkan Nama atau ID
        if (stripos($namaSurat, 'Surat Rekomendasi Beasiswa') !== false) {
            $view = 'admin.surat.pdf-rekomendasi-beasiswa';
        } elseif (stripos($namaSurat, 'Surat Keterangan Penghasilan') !== false) {
            $view = 'admin.surat.pdf-keterangan-penghasilan';
        } elseif (stripos($namaSurat, 'Surat Keterangan Tidak Mampu') !== false || stripos($namaSurat, 'Tidak Mampu') !== false) {
            $view = 'admin.surat.pdf-sktm';
        } else {
            $view = 'admin.surat.pdf-umum';
        }

        $pdf = Pdf::loadView($view, compact('surat'));
        $pdf->setPaper('letter', 'portrait');

        return $pdf->stream('Surat_' . $namaSurat . '_' . $surat->warga->nama_lengkap . '.pdf');
    }
}
