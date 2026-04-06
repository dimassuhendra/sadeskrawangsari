<?php

namespace App\Http\Controllers\Penduduk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Models\PengajuanSurat;

class PengajuanSuratController extends Controller
{
    public function index()
    {
        return view('warga.pengajuan.katalog');
    }

    public function create($jenis)
    {
        $slug = $jenis;
        $jenis_surat_nama = str_replace('-', ' ', ucwords($jenis, '-'));

        // Ambil data jenis surat dari DB berdasarkan kode/nama untuk mendapatkan ID-nya
        $surat_info = DB::table('jenis_surat')->where('nama_surat', 'like', '%' . $jenis_surat_nama . '%')->first();

        $jenis_id_map = [
            'surat-sktm' => 1,
            'surat-beasiswa' => 2,
            'surat-iumk' => 3,
            'surat-domisili' => 4,
            'surat-penghasilan' => 5,
            'surat-belummenikah' => 6,
            'surat-kehilangan' => 7,
            'surat-kematian' => 8,
            'surat-pengantar' => 9,
            'surat-jamkes' => 10,
            'surat-keramaian' => 11,
            'surat-pindah' => 12,
            'surat-perubahandata' => 13
        ];

        $jenis_id = $surat_info ? $surat_info->id : ($jenis_id_map[$slug] ?? null);

        return view('warga.pengajuan.create', compact('jenis_surat_nama', 'slug', 'jenis_id'));
    }

    public function store(Request $request)
    {
        // 1. Validasi Input Dasar
        $rules = [
            'jenis_surat_id' => 'required',
            'metode_ambil' => 'required|in:kantor,mandiri',
        ];

        // 2. Validasi Spesifik sesuai kolom di Database Anda
        if ($request->slug == 'surat-sktm') {
            $rules += ['tujuan_sktm' => 'required', 'jumlah_tanggungan' => 'required|integer', 'keterangan_aset' => 'required', 'total_penghasilan_keluarga' => 'required|numeric'];
        } elseif ($request->slug == 'surat-beasiswa') {
            $rules += ['nama_institusi' => 'required', 'tingkat_pendidikan' => 'required|in:SD,SMP,SMA,Perguruan Tinggi,Lainnya', 'nama_penerima_beasiswa' => 'required'];
        } elseif ($request->slug == 'surat-iumk') {
            $rules += ['nama_usaha' => 'required', 'jenis_usaha' => 'required', 'lokasi_usaha' => 'required', 'modal_usaha' => 'required|numeric'];
        } elseif ($request->slug == 'surat-domisili') {
            $rules += ['tujuan_pembuatan' => 'required'];
        } elseif ($request->slug == 'surat-penghasilan') {
            $rules += ['penghasilan_per_bulan' => 'required|numeric', 'pekerjaan_sebenarnya' => 'required', 'tujuan_surat' => 'required'];
        } elseif ($request->slug == 'surat-kehilangan') {
            $rules += ['jenis_dokumen_hilang' => 'required', 'keterangan_hilang' => 'required', 'lokasi_hilang' => 'required'];
        } elseif ($request->slug == 'surat-kematian') {
            $rules += ['nik_yang_meninggal' => 'required|size:16', 'nama_yang_meninggal' => 'required', 'tanggal_kematian' => 'required', 'tempat_kematian' => 'required', 'penyebab_kematian' => 'required', 'nik_pelapor' => 'required|size:16'];
        } elseif ($request->slug == 'surat-pindah') {
            $rules += ['alamat_tujuan_lengkap' => 'required', 'alasan_pindah' => 'required', 'tgl_rencana_pindah' => 'required|date', 'jumlah_ikut_pindah' => 'required|integer'];
        } elseif ($request->slug == 'surat-belummenikah') {
            $rules += ['tujuan_permohonan' => 'required'];
        } elseif ($request->slug == 'surat-keramaian') {
            $rules += ['nama_kegiatan' => 'required', 'lokasi_kegiatan' => 'required', 'tgl_mulai' => 'required|date', 'tgl_selesai' => 'required|date|after_or_equal:tgl_mulai', 'penanggung_jawab' => 'required'];
        } elseif ($request->slug == 'surat-pengantar') {
            $rules += ['jenis_pengantar' => 'required', 'keterangan' => 'required'];
        }

        $request->validate($rules);

        try {
            DB::beginTransaction();

            // 3. Simpan ke Tabel Utama (pengajuan_surat)
            // Sesuai DB: id, warga_nik, jenis_surat_id, status, metode_ambil
            $pengajuanId = DB::table('pengajuan_surat')->insertGetId([
                'warga_nik' => Auth::guard('warga')->user()->nik,
                'jenis_surat_id' => $request->jenis_surat_id,
                'status' => 'Diajukan', // Sesuai Enum di DB
                'metode_ambil' => $request->metode_ambil,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // 4. Persiapkan Data Detail (Hanya kolom yang ada di tabel detail)
            $tableName = str_replace('-', '_', $request->slug) . '_detail';

            // Ambil semua input kecuali yang milik tabel utama
            $detailData = $request->except(['_token', 'slug', 'jenis_surat_id', 'metode_ambil']);
            $detailData['pengajuan_id'] = $pengajuanId;
            $detailData['created_at'] = now();
            $detailData['updated_at'] = now();

            // Simpan ke tabel detail
            DB::table($tableName)->insert($detailData);

            DB::commit();
            return redirect()->route('dashboard.warga')->with('success', 'Pengajuan berhasil dikirim.');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error("Gagal simpan: " . $e->getMessage());
            return back()->with('error', 'Gagal: ' . $e->getMessage())->withInput();
        }
    }
    public function updateStatus($id, $status)
    {
        $pengajuan = PengajuanSurat::findOrFail($id);
        $pengajuan->update(['status' => $status]);

        // Jika disetujui, Anda bisa menambahkan logika notifikasi di sini
        return back()->with('success', "Status berhasil diperbarui menjadi $status.");
    }

    // Fungsi Cetak PDF (Bisa diakses Admin & Warga)
    public function cetakSurat($id)
    {
        // 1. Load pengajuan beserta warga, jenisSurat, dan SEMUA relasi tabel detail
        $surat = PengajuanSurat::with([
            'warga',
            'jenisSurat',
            'penghasilanDetail',
            'sktmDetail',
            'beasiswaDetail',
            'iumkDetail',
            'belumMenikahDetail',
            'izinKeramaianDetail',
            'kehilanganDokDetail',
            'pengantarDetail'
        ])->findOrFail($id);

        // 2. Keamanan: Pastikan yang mencetak adalah pemilik surat
        if ($surat->warga_nik !== Auth::guard('warga')->user()->nik) {
            abort(403, 'Anda tidak memiliki akses ke dokumen ini.');
        }

        if ($surat->status !== 'Disetujui') {
            return back()->with('error', 'Surat belum disetujui untuk dicetak.');
        }

        $namaSurat = $surat->jenisSurat->nama_surat;

        // 3. Mapping View Template PDF (Logika yang sama seperti di Admin)
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
        } elseif (stripos($namaSurat, 'Surat Izin Keramaian') !== false || stripos($namaSurat, 'Keramaian') !== false) {
            $view = 'admin.surat.pdf-keramaian';
        } elseif (stripos($namaSurat, 'Surat Kehilangan') !== false || stripos($namaSurat, 'Kehilangan') !== false) {
            $view = 'admin.surat.pdf-kehilangan';
        } elseif (stripos($namaSurat, 'Surat Pengantar') !== false || stripos($namaSurat, 'Pengantar') !== false) {
            $view = 'admin.surat.pdf-pengantar';
        } else {
            $view = 'admin.surat.pdf-umum';
        }

        // 4. Proses render PDF
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView($view, compact('surat'));
        $pdf->setPaper('letter', 'portrait');

        return $pdf->stream('Surat_' . $namaSurat . '_' . $surat->warga->nama_lengkap . '.pdf');
    }
}
