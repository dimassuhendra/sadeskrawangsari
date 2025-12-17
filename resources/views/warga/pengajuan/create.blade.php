@extends('layouts.app-warga')

@section('title', 'Form Pengajuan')

@section('content')
    <div class="welcome-card-2">
        <h1>Layanan Surat Mandiri - {{ $jenis_surat }}</h1>
        <p>Pilih jenis surat yang ingin Anda ajukan di bawah ini dengan mudah dan cepat.</p>
    </div>

    <div class="form-container" style="max-width: 700px; margin: auto;">
        <div class="card"
            style="background: white; padding: 40px; border-radius: 20px; box-shadow: 0 10px 25px rgba(0,0,0,0.05);">
            <h2 style="font-family: 'Domine'; color: var(--color-1); margin-top: 0;">Formulir Pengajuan</h2>
            <div
                style="background: var(--color-2); color: white; padding: 10px 20px; border-radius: 10px; display: inline-block; margin-bottom: 25px;">
                <strong>Jenis Surat:</strong> {{ $jenis_surat }}
            </div>

            <form action="{{ route('pengajuan.store') }}" method="POST">
                @csrf
                <input type="hidden" name="jenis_surat" value="{{ $jenis_surat }}">

                <div class="form-group" style="margin-bottom: 20px;">
                    <label style="display: block; font-weight: 600; margin-bottom: 10px;">NIK Pemohon</label>
                    <input type="text" class="form-control" value="{{ Auth::user()->nik }}" disabled
                        style="background: #f8f9fa; border: 1px solid #ddd; width: 100%; padding: 12px; border-radius: 8px;">
                </div>

                <div class="form-group" style="margin-bottom: 20px;">
                    <label style="display: block; font-weight: 600; margin-bottom: 10px;">Tujuan / Keperluan Surat</label>
                    <textarea name="keperluan" class="form-control" rows="5" required
                        placeholder="Contoh: Digunakan sebagai syarat pendaftaran beasiswa anak di tingkat SMA."
                        style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; font-family: 'Fredoka';"></textarea>
                    <small style="color: #888;">Jelaskan secara rinci tujuan pembuatan surat Anda.</small>
                </div>

                <div style="display: flex; gap: 15px; margin-top: 30px;">
                    <a href="{{ route('pengajuan.katalog') }}"
                        style="flex: 1; text-align: center; padding: 12px; border-radius: 8px; text-decoration: none; color: #666; background: #eee;">Batal</a>
                    <button type="submit"
                        style="flex: 2; background: var(--color-1); color: white; border: none; padding: 12px; border-radius: 8px; font-weight: 600; cursor: pointer;">Kirim
                        Pengajuan</button>
                </div>
            </form>
        </div>
    </div>
@endsection