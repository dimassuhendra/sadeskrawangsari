<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
            'sktm' => 1,
            'beasiswa' => 2,
            'iumk' => 3,
            'domisili' => 4,
            'penghasilan' => 5,
            'kehilangan-dok' => 6,
            'kematian' => 7,
            'pengantar-ktp' => 8,
            'jaminan-kesehatan' => 9,
            'izin-keramaian' => 10,
            'pindah-domisili' => 11,
            'perubahan-data' => 12,
            'belum-menikah' => 13
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
        if ($request->slug == 'sktm') {
            $rules += ['tujuan_sktm' => 'required', 'jumlah_tanggungan' => 'required|integer', 'keterangan_aset' => 'required', 'total_penghasilan_keluarga' => 'required|numeric'];
        } elseif ($request->slug == 'beasiswa') {
            $rules += ['nama_institusi' => 'required', 'tingkat_pendidikan' => 'required|in:SD,SMP,SMA,Perguruan Tinggi,Lainnya', 'nama_penerima_beasiswa' => 'required'];
        } elseif ($request->slug == 'iumk') {
            $rules += ['nama_usaha' => 'required', 'jenis_usaha' => 'required', 'lokasi_usaha' => 'required', 'modal_usaha' => 'required|numeric'];
        } elseif ($request->slug == 'domisili') {
            $rules += ['tujuan_pembuatan' => 'required'];
        } elseif ($request->slug == 'penghasilan') {
            $rules += ['penghasilan_per_bulan' => 'required|numeric', 'pekerjaan_sebenarnya' => 'required', 'tujuan_surat' => 'required'];
        } elseif ($request->slug == 'kehilangan-dok') {
            $rules += ['jenis_dokumen_hilang' => 'required', 'keterangan_hilang' => 'required', 'lokasi_hilang' => 'required'];
        } elseif ($request->slug == 'kematian') {
            $rules += ['nik_yang_meninggal' => 'required|size:16', 'nama_yang_meninggal' => 'required', 'tanggal_kematian' => 'required', 'tempat_kematian' => 'required', 'penyebab_kematian' => 'required', 'nik_pelapor' => 'required|size:16'];
        } elseif ($request->slug == 'pindah-domisili') {
            $rules += ['alamat_tujuan_lengkap' => 'required', 'alasan_pindah' => 'required', 'tgl_rencana_pindah' => 'required|date', 'jumlah_ikut_pindah' => 'required|integer'];
        } elseif ($request->slug == 'belum-menikah') {
            $rules += ['tujuan_permohonan' => 'required'];
        }

        $request->validate($rules);

        try {
            DB::beginTransaction();

            // 3. Simpan ke Tabel Utama (pengajuan_surat)
            // Sesuai DB: id, warga_nik, jenis_surat_id, status, metode_ambil
            $pengajuanId = DB::table('pengajuan_surat')->insertGetId([
                'warga_nik' => Auth::user()->nik,
                'jenis_surat_id' => $request->jenis_surat_id,
                'status' => 'Diajukan', // Sesuai Enum di DB
                'metode_ambil' => $request->metode_ambil,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // 4. Persiapkan Data Detail (Hanya kolom yang ada di tabel detail)
            $tableName = 'surat_' . str_replace('-', '_', $request->slug) . '_detail';

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
        $surat = PengajuanSurat::with(['warga', 'jenisSurat'])->findOrFail($id);

        if ($surat->status !== 'Disetujui') {
            return back()->with('error', 'Surat belum disetujui untuk dicetak.');
        }

        // Gunakan library DomPDF (pastikan sudah install: composer require barryvdh/laravel-dompdf)
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.surat.pdf-template', compact('surat'));

        return $pdf->stream('Surat_' . $surat->warga_nik . '.pdf');
    }
}