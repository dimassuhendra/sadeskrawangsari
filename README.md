# 🚀 SISTEM INFORMASI PERSURATAN DESA DIGITAL (SIP-DESA)

[![Laravel](https://img.shields.io/badge/Framework-Laravel-FF2D20?style=for-the-badge&logo=laravel)](https://laravel.com/)
[![Database](https://img.shields.io/badge/Database-MySQL-4479A1?style=for-the-badge&logo=mysql)](https://www.mysql.com/)
[![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)](LICENSE)
[![Status](https://img.shields.io/badge/Status-Skripsi%20Final-blue?style=for-the-badge)](https://github.com/yourusername/repo-name)

Sistem Informasi Persuratan Desa Digital (SIP-DESA) adalah aplikasi berbasis web yang dirancang untuk mengotomatisasi seluruh proses administrasi persuratan di tingkat desa/kelurahan. Dibangun menggunakan framework Laravel, sistem ini berfokus pada efisiensi *resource* server dan legalitas dokumen digital, menjadikannya solusi ideal untuk *hosting* dengan biaya rendah.

## ✨ Fitur Unggulan

* **13 Jenis Surat Esensial:** Melayani persuratan mulai dari Kependudukan (Domisili, Pindah) hingga Sosial (SKTM) dan Ekonomi (IUMK).
* **Optimalisasi Hosting (Low-Cost Ready):** Menggunakan **Blanko PDF** dan manipulasi *Form Field* yang sangat ringan, menghindari *rendering* HTML atau konversi DOCX yang berat, menjamin performa cepat di *server* dengan spesifikasi terbatas.
* **Master Data Warga:** Fitur *pre-fill* otomatis pada formulir surat, meminimalkan *input* berulang dan kesalahan data.
* **Legalitas Digital (QR & TTE):** Dilengkapi Tanda Tangan Elektronik (TTE) dan QR Code verifikasi pada surat yang diterbitkan untuk menjamin keabsahan dokumen yang dicetak mandiri.
* **Dual-Option Retrieval:** Pilihan pengambilan surat: **"Cetak Sendiri"** (untuk surat non-vital) atau **"Ambil di Kantor"** (untuk surat yang memerlukan cap basah).

## 🧩 Modul Utama

### 1. Modul Pengguna Warga (Frontend)
* **Dashboard Warga:** Memantau riwayat pengajuan surat dan status terkini.
* **Modul Persuratan:** Formulir input data sesuai jenis surat.
* **Modul Pengaduan:** Sarana komunikasi non-persuratan.

### 2. Modul Pengguna Admin (Backend)
* **Dashboard Analitik:** Menyajikan *chart* dan *card* informasi real-time mengenai tren pengajuan surat dan jumlah pendaftar baru.
* **Kelola Persuratan:** Proses verifikasi, persetujuan, penolakan, dan penerbitan dokumen.
* **Pengaturan Template PDF:** Fitur *upload* mandiri bagi admin untuk mengganti *template* PDF Master jika format surat desa berubah.
* **Manajemen Akun:** Pengelolaan akun admin dan data warga terdaftar.

## 🛠️ Instalasi Proyek

Ikuti langkah-langkah di bawah ini untuk menjalankan proyek secara lokal:

### Prasyarat
* PHP (>= 8.0)
* Composer
* MySQL/MariaDB
* Node.js & NPM

### Langkah-Langkah
1.  **Clone Repository:**
    ```bash
    git clone [https://github.com/yourusername/repo-name.git](https://github.com/yourusername/repo-name.git)
    cd repo-name
    ```

2.  **Instalasi Dependensi PHP:**
    ```bash
    composer install
    ```

3.  **Setup Environment:**
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
    *Edit file `.env` dan konfigurasikan detail database Anda (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`).*

4.  **Migrasi Database:**
    ```bash
    php artisan migrate --seed
    ```
    *(Gunakan `--seed` untuk mengisi data awal admin jika tersedia.)*

5.  **Instalasi Frontend (Jika menggunakan Laravel Mix/Vite):**
    ```bash
    npm install
    npm run dev  # atau npm run watch
    ```

6.  **Jalankan Aplikasi:**
    ```bash
    php artisan serve
    ```
    Aplikasi akan berjalan di `http://127.0.0.1:8000`.

---

Lisensi MIT &copy; 2025 [Dimas Suhendra]