<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\PengajuanSurat;
use App\Models\Surat;

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
    
    public function setujuiSurat(Request $request, $id)
    {
        // 1. Validasi: Admin HANYA menginput nomor urut bagian depannya saja (XXX)
        $request->validate([
            'no_urut' => 'required|string|max:50',
        ]);

        $pengajuan = PengajuanSurat::with('jenisSurat')->findOrFail($id);

        // 2. Buat Mapping Singkatan Surat berdasarkan ID Jenis Surat
        // $kode_surat_map = [
        //     1 => 'SKTM',
        //     2 => 'BEASISWA',
        //     3 => 'IUMK',
        //     4 => 'DOMISILI',
        //     5 => 'PENGHASILAN',
        //     6 => 'KEHILANGAN',
        //     7 => 'KEMATIAN',
        //     8 => 'PENGANTAR-KTP',
        //     9 => 'JAMKES',
        //     10 => 'IZIN-RAMAI',
        //     11 => 'PINDAH',
        //     12 => 'UBAH-DATA',
        //     13 => 'BLM-MENIKAH'
        // ];

        $kode_surat_map = [
            1  => 'SKTM',
            2  => 'BEAS',
            3  => 'IUMK',
            4  => 'DOMI',
            5  => 'PHSL', // Penghasilan
            6 => 'BLMK',  // Belum Menikah
            7  => 'HILG', // Kehilangan
            8  => 'KMAT', // Kematian
            9  => 'KTPP', // Pengantar KTP
            10 => 'JAMK',
            11 => 'IZRM', // Izin Ramai
            12 => 'PNDH', // Pindah
            13 => 'UBDT', // Ubah Data
        ];

        // Ambil kode berdasarkan ID, jika tidak ada fallback ke 'SURAT'
        $kode_surat = $kode_surat_map[$pengajuan->jenis_surat_id] ?? 'SURAT';

        // 3. Generate Bulan Romawi Saat Ini
        $romawi = ['', 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];
        $bulanSekarang = date('n'); // Menghasilkan angka 1-12
        $bulanRomawi = $romawi[$bulanSekarang];

        // 4. Generate Tahun Saat Ini
        $tahunSekarang = date('Y');

        // 5. Rangkai Format Final (Contoh: 145/SKTM/III/2026)
        $nomorSuratLengkap = $request->no_urut . '/' . $kode_surat . '/' . $bulanRomawi . '/' . $tahunSekarang;

        // 6. Simpan ke database
        $pengajuan->update([
            'status' => 'Disetujui',
            'nomor_surat' => $nomorSuratLengkap
        ]);

        return back()->with('success', "Surat disetujui dengan Nomor Registrasi: $nomorSuratLengkap");
    }

    // Fungsi khusus untuk menolak dan menyimpan Alasan (Keterangan Admin)
    public function tolakSurat(Request $request, $id)
    {
        $request->validate([
            'keterangan_admin' => 'required|string',
        ]);

        $pengajuan = PengajuanSurat::findOrFail($id);

        // Simpan status dan alasan penolakan
        $pengajuan->update([
            'status' => 'Ditolak',
            'keterangan_admin' => $request->keterangan_admin
        ]);

        return back()->with('success', 'Permohonan surat berhasil ditolak beserta alasannya.');
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
            'updated' => $surat->updated_at->format('d F Y'),
            'status' => $surat->status,
            'metode_ambil' => $surat->metode_ambil === 'mandiri' ? 'Cetak Sendiri' : 'Ambil di Kantor',
            'nomor_surat' => $surat->nomor_surat ? $surat->nomor_surat : 'Belum ada nomor surat',
        ]);
    }

    public function cetakSurat($id)
    {
        // Load pengajuan beserta warga, jenisSurat, dan semua kemungkinan detail
        $surat = PengajuanSurat::with([
            'warga',
            'jenisSurat',
            'penghasilanDetail',
            'sktmDetail',
            'beasiswaDetail',
            'iumkDetail',
            'belumMenikahDetail',
        ])->findOrFail($id);

        if ($surat->status !== 'Disetujui') {
            return redirect()->back()->with('error', 'Surat belum disetujui.');
        }

        $namaSurat = $surat->jenisSurat->nama_surat;

        // Mapping Template berdasarkan Nama atau ID
        if (stripos($namaSurat, 'Surat Rekomendasi Beasiswa') !== false) {
            $view = 'admin.surat.pdf-rekomendasi-beasiswa';
        } elseif (stripos($namaSurat, 'Surat Keterangan Penghasilan') !== false) {
            $view = 'admin.surat.pdf-penghasilan';
        } elseif (stripos($namaSurat, 'Surat Keterangan Tidak Mampu') !== false || stripos($namaSurat, 'Tidak Mampu') !== false) {
            $view = 'admin.surat.pdf-sktm';
        } elseif (stripos($namaSurat, 'Surat Keterangan Izin Usaha') !== false || stripos($namaSurat, 'IUMK') !== false) {
            $view = 'admin.surat.pdf-iumk';
        } elseif (stripos($namaSurat, 'Surat Belum Menikah') !== false || stripos($namaSurat, 'Belum Menikah') !== false) {
            $view = 'admin.surat.pdf-belummenikah';
        } else {
            $view = 'admin.surat.pdf-umum';
        }

        $pdf = Pdf::loadView($view, compact('surat'));
        $pdf->setPaper('letter', 'portrait');

        return $pdf->stream('Surat_' . $namaSurat . '_' . $surat->warga->nama_lengkap . '.pdf');
    }
}
