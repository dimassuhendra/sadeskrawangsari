<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Surat Rekomendasi Beasiswa - {{ $surat->warga->nama_lengkap }}</title>
    <style>
        @page {
            margin: 1cm;
            /* Atur jarak aman dari tepi kertas */
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }

        .container {
            padding: 10px 30px;
        }

        /* Kop Surat */
        .kop-tabel {
            width: 100%;
            border-bottom: 3px double #000;
            padding-bottom: 10px;
            margin-bottom: 25px;
        }

        .logo-img {
            width: 80px;
            /* Sesuaikan ukuran logo */
        }

        .kop-text {
            text-align: center;
        }

        .kop-text h3 {
            margin: 0;
            font-size: 14pt;
            font-weight: normal;
            line-height: 1.2;
        }

        .kop-text h2 {
            margin: 0;
            font-size: 16pt;
            text-transform: uppercase;
            line-height: 1.2;
        }

        .kop-text p {
            margin: 0;
            font-size: 10pt;
            font-style: italic;
        }

        /* Judul */
        .judul-surat {
            text-align: center;
            margin-bottom: 30px;
        }

        .judul-surat h4 {
            text-decoration: underline;
            text-transform: uppercase;
            margin-bottom: 5px;
        }

        /* Isi */
        .isi-surat {
            text-align: justify;
        }

        .data-table {
            margin: 15px 0 15px 40px;
        }

        .data-table td {
            padding: 2px 5px;
            vertical-align: top;
        }

        /* Penutup & TTD */
        .penutup {
            margin-top: 20px;
        }

        .ttd-wrapper {
            margin-top: 50px;
            width: 100%;
        }

        .ttd-box {
            float: right;
            width: 250px;
            text-align: center;
        }

        .space {
            height: 70px;
        }
    </style>
</head>

<body>
    <div class="container">
        <table class="kop-tabel">
            <tr>
                <td width="15%" class="kop-logo">
                    <img src="{{ public_path('img/mainLogo.png') }}" class="logo-img">
                </td>
                <td width="85%" class="kop-text">
                    <h3>PEMERINTAH KABUPATEN LAMPUNG SELATAN</h3>
                    <h3>KECAMATAN NATAR</h3>
                    <h2>KANTOR KEPALA DESA KRAWANG SARI</h2>
                    <p>Alamat: Jl. Raya Krawang Sari No. 01 Kode Pos 35357</p>
                </td>
                {{-- Jika ingin simetris, tambahkan td kosong di kanan atau logo kedua --}}
                <td width="15%"></td>
            </tr>
        </table>

        <div class="judul-surat">
            <h4>SURAT REKOMENDASI</h4>
            <span>Nomor: 420 / {{ str_pad($surat->id, 3, '0', STR_PAD_LEFT) }} / DS-KS / {{ date('Y') }}</span>
        </div>

        <div class="isi-surat">
            <p>Yang bertanda tangan di bawah ini Kepala Desa Krawang Sari, Kecamatan Merbau Mataram, Kabupaten Lampung Selatan, dengan ini memberikan rekomendasi kepada:</p>

            <table class="data-table">
                <tr>
                    <td width="160">Nama Lengkap</td>
                    <td width="10">:</td>
                    <td><strong>{{ $surat->warga->nama_lengkap }}</strong></td>
                </tr>
                <tr>
                    <td>NIK</td>
                    <td>:</td>
                    <td>{{ $surat->warga_nik }}</td>
                </tr>
                <tr>
                    <td>Tempat, Tgl Lahir</td>
                    <td>:</td>
                    <td>{{ $surat->warga->tempat_lahir }}, {{ \Carbon\Carbon::parse($surat->warga->tanggal_lahir)->translatedFormat('d F Y') }}</td>
                </tr>
                <tr>
                    <td>Pekerjaan/Status</td>
                    <td>:</td>
                    <td>Pelajar/Mahasiswa</td>
                </tr>
                <tr>
                    <td>Alamat Lengkap</td>
                    <td>:</td>
                    <td>{{ $surat->warga->alamat }}</td>
                </tr>
            </table>

            <p>Surat rekomendasi ini diberikan sebagai persyaratan untuk mengajukan <strong>{{ $surat->keperluan }}</strong>. Kami sangat mendukung permohonan yang bersangkutan sebagai upaya peningkatan kualitas sumber daya manusia di desa kami.</p>
            <p class="penutup">Demikian surat rekomendasi ini diberikan kepada yang bersangkutan untuk dapat dipergunakan sebagaimana mestinya.</p>
        </div>

        <div class="ttd-wrapper">
            <div class="ttd-box">
                <p>Krawang Sari, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
                <p>Kepala Desa Krawang Sari</p>
                <div class="space"></div>
                <p><strong>( ____________________ )</strong></p>
                <p>NIP. .........................</p>
            </div>
        </div>
    </div>
</body>

</html>