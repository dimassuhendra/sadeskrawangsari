-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 08, 2026 at 06:48 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_desa`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nama`, `email`, `password`, `foto`, `created_at`, `updated_at`) VALUES
(1, 'Admin Utama', 'admin@desakrawangsari.com', '$2y$12$pyKug4oEvzVv9nZ/ec1HD.ogtrliNMAkRnk0cdfZ8Q4cf5dAY0O9y', NULL, NULL, '2025-12-18 00:35:17');

-- --------------------------------------------------------

--
-- Table structure for table `aktivitas_logs`
--

CREATE TABLE `aktivitas_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `aksi` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `isi` text NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `status` enum('draft','publish') DEFAULT 'publish',
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`id`, `judul`, `slug`, `isi`, `gambar`, `status`, `admin_id`, `created_at`, `updated_at`) VALUES
(1, 'Pemerintah Perketat Pengawasan Platform Digital, Tindak Kekerasan terhadap Perempuan di Ruang Siber', 'pemerintah-perketat-pengawasan-platform-digital-tindak-kekerasan-terhadap-perempuan-di-ruang-siber-1776861401', '<p>Kasus kekerasan terhadap perempuan di ruang digital terus meningkat, dengan sekitar 2.000 laporan per tahun, didominasi kekerasan seksual online. Menyikapi hal ini, pemerintah memperketat pengawasan platform digital dan menuntut tanggung jawab penyelenggara dalam menjaga keamanan pengguna.<br><br>Menteri Komunikasi dan Digital Meutya Hafid menegaskan platform wajib menangani kasus di dalam sistemnya, dengan sanksi tegas hingga penutupan jika membahayakan publik. Sementara itu, Komnas Perempuan menilai angka kasus masih belum mencerminkan kondisi sebenarnya karena banyak yang belum dilaporkan, terutama di wilayah dengan keterbatasan akses layanan.<br><br>Kolaborasi antara pemerintah dan Komnas Perempuan akan difokuskan pada penanganan konten berbahaya, peningkatan literasi digital, serta penguatan kebijakan untuk melindungi perempuan dan kelompok rentan di ruang digital.</p>', 'berita/H8WdBuiyPeH8aLKP0Mz1RHLkXRDTLZm03Ty7F8sR.jpg', 'publish', 1, '2026-04-22 05:36:42', '2026-04-22 05:36:42'),
(2, 'Vaksinasi Penyakit Mulut dan Kuku (PMK) dalam Menghadapi Hari Raya Idul Adha 1447 H', 'vaksinasi-penyakit-mulut-dan-kuku-pmk-dalam-menghadapi-hari-raya-idul-adha-1447-h-1776862007', '<p>Dinas Pertanian Kota Bandar Lampung, sesuai arahan Ibu Walikota, melakukan Vaksinasi Penyakit Mulut dan Kuku (PMK) dalam rangka menghadapi Hari Raya Idul Adha 1447 H. Kegiatan vaksinasi ini dihadiri oleh Kepala Dinas Pertanian didampingi oleh Dr. Lieana Dwi Metarika selaku Kepala UPT Puskeswan Kota Bandar Lampung dan beberapa staf.</p><p>&nbsp;</p><p>Vaksinasi PMK ini bertujuan untuk mengantisipasi dan pencegahan hewan tertular penyakit mulut dan kuku. Kota Bandar Lampung mendapatkan bantuan vaksin PMK sebanyak 500 dosis dari Dinas Pertanian Provinsi Lampung. Vaksin ini merupakan vaksin PMK yang disalurkan untuk periode pertama (Januari-Maret).</p>', 'berita/I6oyhOCdaVRpbCnLtPhKjMwT3tawRKI6Cirs1V2K.jpg', 'publish', 1, '2026-04-22 05:46:47', '2026-04-22 05:46:47'),
(3, 'Wali Kota Bandar Lampung, Hj. Eva Dwiana Pimpin Rapat Koordinasi Percepatan Penanggulangan TBC, Perkuat Program TOS TB di Pemerintahan Kota Bandar Lampung', 'wali-kota-bandar-lampung-hj-eva-dwiana-pimpin-rapat-koordinasi-percepatan-penanggulangan-tbc-perkuat-program-tos-tb-di-pemerintahan-kota-bandar-lampung-1776862063', '<p>RAPAT KOORDINASI PERCEPATAN PENANGGULANGAN TBC (TOS TB)<br>Tindak Lanjut Kunjungan Wakil Menteri Kesehatan<br><br>Wali Kota Bandar Lampung, Eva Dwiana, memimpin Rapat Koordinasi Percepatan Penanggulangan Tuberkulosis (TBC) melalui program Temukan Obati Sampai Sembuh (TOS TB) sebagai tindak lanjut atas kunjungan Wakil Menteri Kesehatan Republik Indonesia di Ruang Rapat Walikota Bandar Lampung, Kamis (16/04/2026).<br><br>Dalam arahannya, Wali Kota Bandar Lampung menegaskan pentingnya sinergi lintas sektor dalam upaya percepatan eliminasi TBC di Kota Bandar Lampung. Melalui program TOS TB, Pemerintah Kota Bandar Lampung terus mendorong peningkatan penemuan kasus secara aktif, pengobatan hingga tuntas, serta penguatan peran puskesmas, rumah sakit, dan kader kesehatan di tengah masyarakat.<br><br>Sementara itu, Kepala Dinas Kesehatan Kota Bandar Lampung menyampaikan bahwa pihaknya akan terus mengoptimalkan langkah-langkah strategis dalam penanggulangan TBC, termasuk meningkatkan edukasi kepada masyarakat terkait deteksi dini serta pentingnya kepatuhan dalam menjalani pengobatan hingga sembuh.<br><br>Pemerintah Kota Bandar Lampung berkomitmen penuh mendukung program nasional eliminasi TBC dengan melibatkan seluruh OPD, tenaga kesehatan, serta masyarakat guna memutus rantai penularan.<br><br>Melalui rapat koordinasi ini, diharapkan upaya percepatan penanggulangan TBC di Kota Bandar Lampung dapat berjalan lebih efektif, terintegrasi, dan berkelanjutan, sehingga target eliminasi TBC dapat tercapai sesuai dengan yang telah ditetapkan pemerintah pusat.</p>', 'berita/rkCrjcX4eg1pNU9hrxL5Q3S8zGGFcqextUJrBk5M.jpg', 'publish', 1, '2026-04-22 05:47:43', '2026-04-22 05:47:43'),
(4, 'Wali Kota Bandar Lampung, Hj. Eva Dwiana Terima Kunjungan Kerja Wamenkes dan Wamendagri RI, Bandar Lampung Diproyeksikan Jadi Pilot Project Eliminasi TBC Nasional', 'wali-kota-bandar-lampung-hj-eva-dwiana-terima-kunjungan-kerja-wamenkes-dan-wamendagri-ri-bandar-lampung-diproyeksikan-jadi-pilot-project-eliminasi-tbc-nasional-1776862142', '<p>Walikota Bandar Lampung, Hj. Eva Dwiana, menerima kunjungan kerja dari Wakil Menteri Kesehatan (Wamenkes) Benjamin Paulus Octavianus dan Wakil Menteri Dalam Negeri (Wamendagri) Akhmad Wiyagus di Aula Gedung Semergou, Selasa (14/04/2026).<br><br>Dalam kunjungan ini, Kota Bandar Lampung resmi diproyeksikan menjadi pilot project untuk percepatan eliminasi Tuberkulosis (TBC) di tingkat nasional. Kunjungan ini bertujuan untuk memastikan sinkronisasi program prioritas Presiden Prabowo Subianto, seperti Cek Kesehatan Gratis (CKG) dan penanganan TBC secara lintas sektoral, dengan fokus pada penguatan upaya kesehatan di tingkat primer.<br><br>Wamendagri Akhmad Wiyagus memberikan apresiasi yang tinggi terhadap komitmen Pemerintah Kota Bandar Lampung. Menurutnya, dari empat kunjungan kerja serupa yang dilakukan di Indonesia, Bandar Lampung menunjukkan kesiapan paling lengkap, terutama dalam penguasaan data teknis dan pemberdayaan kader.<br><br>Walikota Eva Dwiana menyatakan bahwa Kota Bandar Lampung siap menjalankan instruksi pusat, dengan dukungan 31 Puskesmas dan 51 Pustu yang tersebar di 20 kecamatan.<br><br>Gubernur Lampung, Rahmat Mirzani Djausal, juga menekankan bahwa kesehatan adalah modal utama untuk produktivitas ekonomi masyarakat. Ia melaporkan bahwa capaian Standar Pelayanan Minimal (SPM) kesehatan di Provinsi Lampung terus menunjukkan peningkatan signifikan, mencapai 131% pada tahun 2025. Gubernur Rahmat menambahkan bahwa TBC bukan hanya masalah medis, tetapi juga ancaman terhadap produktivitas masyarakat. Dengan penguatan program CKG di tingkat Puskesmas, diharapkan angka rujukan ke Rumah Sakit Umum Daerah Abdul Moeloek dapat ditekan, sehingga masyarakat tetap sehat dan produktif.<br><br>Pemerintah Provinsi Lampung juga melibatkan berbagai pihak dalam penanganan TBC, termasuk TNI, Polri, akademisi, dan jurnalis, untuk menghapus stigma negatif yang berkembang di masyarakat. Selain itu, sektor swasta dan Kementerian Pekerjaan Umum dan Perumahan Rakyat (PUPR) turut berperan dalam memperbaiki sanitasi dan hunian pasien TBC yang tidak layak, sebagai upaya untuk memutuskan siklus penularan penyakit akibat lingkungan yang buruk.</p>', 'berita/8veTRscQzc7PjuCzdzvkKpbhZoEN5zDBEIPLe8p4.jpg', 'publish', 1, '2026-04-22 05:49:02', '2026-04-22 05:49:02');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_surat`
--

CREATE TABLE `jenis_surat` (
  `id` int(10) UNSIGNED NOT NULL,
  `kode_surat` varchar(10) NOT NULL,
  `nama_surat` varchar(150) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `template_file_path` varchar(255) DEFAULT NULL,
  `opsi_pengambilan` enum('kantor','mandiri','keduanya') NOT NULL DEFAULT 'keduanya',
  `deskripsi_form` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jenis_surat`
--

INSERT INTO `jenis_surat` (`id`, `kode_surat`, `nama_surat`, `kategori`, `template_file_path`, `opsi_pengambilan`, `deskripsi_form`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'SKTM', 'Surat Keterangan Tidak Mampu', 'Sosial', NULL, 'keduanya', NULL, 1, NULL, NULL),
(2, 'BEA', 'Surat Rekomendasi Beasiswa', 'Pendidikan', NULL, 'keduanya', NULL, 1, NULL, NULL),
(3, 'IUMK', 'Surat IUMK', 'Usaha', NULL, 'keduanya', NULL, 1, NULL, NULL),
(4, 'DOM', 'Surat Keterangan Domisili', 'Kependudukan', NULL, 'keduanya', NULL, 1, NULL, NULL),
(5, 'PENG', 'Surat Keterangan Penghasilan', 'Ekonomi', NULL, 'keduanya', NULL, 1, NULL, NULL),
(6, 'NIKAH', 'Surat Keterangan Belum Menikah', 'Status', NULL, 'keduanya', NULL, 1, NULL, NULL),
(7, 'HILANG', 'Surat Kehilangan', 'Keamanan', NULL, 'keduanya', NULL, 1, NULL, NULL),
(8, 'MATI', 'Surat Kematian', 'Kependudukan', NULL, 'keduanya', NULL, 1, NULL, NULL),
(9, 'KTP', 'Surat Pengantar KTP', 'Kependudukan', NULL, 'keduanya', NULL, 1, NULL, NULL),
(10, 'BPJS', 'Surat Jaminan Kesehatan', 'Kesehatan', NULL, 'keduanya', NULL, 1, NULL, NULL),
(11, 'RAMAI', 'Surat Izin Keramaian', 'Sosial', NULL, 'keduanya', NULL, 1, NULL, NULL),
(12, 'PINDAH', 'Surat Pengantar Pindah Domisili', 'Kependudukan', NULL, 'keduanya', NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `keluarga`
--

CREATE TABLE `keluarga` (
  `no_kk` varchar(16) NOT NULL,
  `nama_kepala_keluarga` varchar(150) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `keluarga`
--

INSERT INTO `keluarga` (`no_kk`, `nama_kepala_keluarga`, `created_at`, `updated_at`) VALUES
('3275040000000001', 'Budi Santoso', '2025-12-18 13:45:12', '2025-12-18 13:45:12'),
('3275040000000002', 'Ahmad Hidayat', '2025-12-18 13:45:12', '2025-12-18 13:45:12'),
('3275040000000003', 'Slamet Riyadi', '2025-12-18 13:45:12', '2025-12-18 13:45:12'),
('3275040000000004', 'Andi Wijaya', '2025-12-18 13:45:12', '2025-12-18 13:45:12'),
('3275040000000005', 'Dedi Kusnadi', '2025-12-18 13:45:12', '2025-12-18 13:45:12'),
('3275040000000006', 'Hendra Gunawan', '2025-12-18 13:45:12', '2025-12-18 13:45:12'),
('3275040000000007', 'Mulyadi', '2025-12-18 13:45:12', '2025-12-18 13:45:12'),
('3275040000000008', 'Roni Setiawan', '2025-12-18 13:45:12', '2025-12-18 13:45:12'),
('3275040000000009', 'Agus Prayitno', '2025-12-18 13:45:12', '2025-12-18 13:45:12'),
('3275040000000010', 'Eko Prasetyo', '2025-12-18 13:45:12', '2025-12-18 13:45:12'),
('3275040000000011', 'Surya Saputra', '2025-12-18 13:45:12', '2025-12-18 13:45:12'),
('3275040000000012', 'Ferry Irawan', '2025-12-18 13:45:12', '2025-12-18 13:45:12'),
('3275040000000013', 'Bambang Pamungkas', '2025-12-18 13:45:12', '2025-12-18 13:45:12'),
('3275040000000014', 'Indra Lesmana', '2025-12-18 13:45:12', '2025-12-18 13:45:12'),
('3275040000000015', 'Taufik Hidayat', '2025-12-18 13:45:12', '2025-12-18 13:45:12'),
('3275040000000016', 'Rian Gede', '2025-12-18 13:45:12', '2025-12-18 13:45:12'),
('3275040000000017', 'Adi Nugroho', '2025-12-18 13:45:12', '2025-12-18 13:45:12'),
('3275040000000018', 'Gading Marten', '2025-12-18 13:45:12', '2025-12-18 13:45:12'),
('3275040000000019', 'Raffi Ahmad', '2025-12-18 13:45:12', '2025-12-18 13:45:12'),
('3275040000000020', 'Sule Prikitiw', '2025-12-18 13:45:12', '2025-12-18 13:45:12'),
('3275041304070302', 'Sutrisno', '2025-12-17 01:55:41', '2025-12-17 01:55:41');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_04_06_213550_create_aktivitas_logs_table', 2),
(5, '2026_04_06_222642_create_pengaturan_desa_table', 3),
(6, '2026_04_06_224230_add_landing_fields_to_pengaturan_desa_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengaduan`
--

CREATE TABLE `pengaduan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `warga_nik` varchar(16) NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `isi_pengaduan` text NOT NULL,
  `lampiran_path` varchar(255) DEFAULT NULL,
  `status` enum('Baru','Diterima','Diproses','Selesai','Ditolak') NOT NULL DEFAULT 'Baru',
  `tanggapan_admin` text DEFAULT NULL,
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengaduan`
--

INSERT INTO `pengaduan` (`id`, `warga_nik`, `kategori`, `judul`, `isi_pengaduan`, `lampiran_path`, `status`, `tanggapan_admin`, `admin_id`, `created_at`, `updated_at`) VALUES
(1, '3275041807010011', 'Infrastruktur', 'Jalan Bergeluduk', 'Jalanan jelek', NULL, 'Selesai', 'Jalanan sudah diperbaiki. Terimakasih atas laporannya', 1, '2025-12-17 07:28:44', '2026-04-22 06:24:08'),
(2, '3275041807010011', 'Kebersihan', 'Kotor', 'bau', NULL, 'Selesai', 'Terimakasih keluhan anda sudah ditindaklanjuti', 1, '2025-12-17 07:39:55', '2026-04-22 06:32:53');

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan_surat`
--

CREATE TABLE `pengajuan_surat` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nomor_surat` varchar(255) DEFAULT NULL,
  `warga_nik` varchar(16) NOT NULL,
  `jenis_surat_id` int(10) UNSIGNED NOT NULL,
  `status` enum('Diajukan','Diproses','Disetujui','Ditolak') NOT NULL DEFAULT 'Diajukan',
  `metode_ambil` enum('kantor','mandiri') NOT NULL,
  `keterangan_admin` text DEFAULT NULL,
  `final_pdf_path` varchar(255) DEFAULT NULL,
  `kode_verifikasi_qr` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengajuan_surat`
--

INSERT INTO `pengajuan_surat` (`id`, `nomor_surat`, `warga_nik`, `jenis_surat_id`, `status`, `metode_ambil`, `keterangan_admin`, `final_pdf_path`, `kode_verifikasi_qr`, `created_at`, `updated_at`) VALUES
(1, NULL, '3275041807010011', 2, 'Disetujui', 'mandiri', NULL, NULL, NULL, '2026-01-16 04:29:48', '2026-01-29 01:42:45'),
(2, NULL, '3275041807010011', 1, 'Disetujui', 'mandiri', NULL, NULL, NULL, '2026-03-22 07:16:14', '2026-03-22 07:33:34'),
(3, '003/SKTM/III/2026', '3275041807010011', 1, 'Disetujui', 'kantor', NULL, NULL, NULL, '2026-03-22 07:48:52', '2026-03-22 07:59:25'),
(5, '001/IUMK/III/2026', '3275041807010011', 3, 'Disetujui', 'kantor', NULL, NULL, NULL, '2026-03-23 06:54:03', '2026-03-23 06:55:02'),
(8, '001/BLMK/III/2026', '3275041807010011', 6, 'Disetujui', 'mandiri', NULL, NULL, NULL, '2026-03-23 07:17:45', '2026-03-23 07:18:52'),
(9, '001/PHSL/III/2026', '3275041807010011', 5, 'Disetujui', 'mandiri', NULL, NULL, NULL, '2026-03-23 07:18:35', '2026-03-23 07:19:01'),
(10, '145/HILG/III/2026', '3275041807010011', 7, 'Disetujui', 'mandiri', NULL, NULL, NULL, '2026-03-23 07:51:10', '2026-03-23 07:52:25'),
(11, '144/IZRM/III/2026', '3275041807010011', 11, 'Disetujui', 'kantor', NULL, NULL, NULL, '2026-03-23 07:51:52', '2026-03-23 07:52:12'),
(12, '010/PNTR/III/2026', '3275041807010011', 9, 'Disetujui', 'kantor', NULL, NULL, NULL, '2026-03-23 08:27:27', '2026-03-23 08:30:54'),
(13, '002/PNTR/IV/2026', '3275041807010011', 9, 'Disetujui', 'mandiri', NULL, NULL, NULL, '2026-04-06 14:06:41', '2026-04-06 14:43:42'),
(14, '134/BEAS/IV/2026', '3275041807010012', 2, 'Disetujui', 'mandiri', NULL, NULL, NULL, '2026-04-06 14:18:00', '2026-04-06 14:20:10');

-- --------------------------------------------------------

--
-- Table structure for table `pengaturan_desa`
--

CREATE TABLE `pengaturan_desa` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_desa` varchar(150) NOT NULL DEFAULT 'Desa Krawang Sari',
  `alamat` text DEFAULT NULL,
  `telepon` varchar(30) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `visi_misi` longtext DEFAULT NULL,
  `sejarah` longtext DEFAULT NULL,
  `sambutan_kades` text DEFAULT NULL,
  `nama_kades` varchar(100) DEFAULT NULL,
  `foto_kades` varchar(255) DEFAULT NULL,
  `hero_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengaturan_desa`
--

INSERT INTO `pengaturan_desa` (`id`, `nama_desa`, `alamat`, `telepon`, `email`, `visi_misi`, `sejarah`, `sambutan_kades`, `nama_kades`, `foto_kades`, `hero_image`, `created_at`, `updated_at`) VALUES
(1, 'Desa Krawang Sari', NULL, NULL, NULL, '<p><strong>Visi:</strong> \"Terwujudnya Desa Krawang Sari yang Mandiri, Inovatif, Sejahtera, dan Agamis Berlandaskan Semangat Gotong Royong.\"</p><p><strong>Misi:</strong></p><p><strong>Peningkatan Kualitas Pelayanan:</strong> Mewujudkan tata kelola pemerintahan desa yang baik <i>(Good Governance)</i>, transparan, dan responsif melalui pemanfaatan teknologi informasi.</p><p><strong>Pemberdayaan Ekonomi Warga:</strong> Meningkatkan kesejahteraan masyarakat melalui pemberdayaan sektor pertanian, peternakan, dan Usaha Mikro Kecil dan Menengah (UMKM) lokal.</p><p><strong>Pembangunan Infrastruktur:</strong> Meningkatkan pembangunan sarana dan prasarana fisik desa yang adil, merata, dan berkelanjutan guna menunjang mobilitas dan perekonomian warga.</p><p><strong>Peningkatan Kualitas SDM:</strong> Mendukung program pendidikan dan kesehatan untuk menciptakan generasi Krawang Sari yang cerdas, sehat, dan berakhlak mulia.</p><p><strong>Pelestarian Lingkungan &amp; Budaya:</strong> Menjaga kelestarian lingkungan hidup serta memelihara nilai-nilai agama, sosial, dan budaya luhur yang ada di masyarakat Kecamatan Natar.</p>', '<p>Desa Krawang Sari adalah salah satu desa yang terletak di Kecamatan Natar, Kabupaten Lampung Selatan, Provinsi Lampung. Secara etimologi, penamaan \"Krawang Sari\" diambil dari filosofi dan harapan para pendiri desa. Kata <i>Sari</i> bermakna inti atau kejayaan, yang melambangkan doa dan harapan agar wilayah ini menjadi tanah yang subur, makmur, dan memberikan kesejahteraan bagi setiap penduduk yang mendiaminya.</p><p>Pada masa awal pembentukannya, wilayah Krawang Sari mulanya adalah kawasan hutan dan perkebunan yang secara bertahap mulai dibuka oleh kelompok masyarakat perintis yang datang mencari penghidupan baru. Seiring berjalannya waktu, wilayah ini terus mengalami pertumbuhan penduduk yang signifikan, baik dari masyarakat pribumi Lampung maupun para pendatang dari berbagai daerah yang hidup berdampingan secara harmonis.</p><p>Mata pencaharian utama masyarakat Krawang Sari sejak dahulu bertumpu pada sektor agraris, terutama pertanian, perkebunan, dan peternakan, yang didukung oleh kontur tanah yang subur khas wilayah Lampung Selatan.</p><p>Kini, seiring dengan kemajuan zaman, Desa Krawang Sari terus berbenah. Di bawah kepemimpinan yang silih berganti, desa ini perlahan bertransformasi dari desa agraris tradisional menuju desa berkembang yang melek teknologi, dengan tetap mempertahankan nilai-nilai luhur gotong royong dan kebersamaan antar warganya.</p>', '<p><strong>Assalamu’alaikum Warahmatullahi Wabarakatuh, Tabik Pun!</strong></p><p>Puji syukur senantiasa kita panjatkan ke hadirat Allah SWT, Tuhan Yang Maha Esa, atas segala rahmat dan karunia-Nya sehingga website resmi Pemerintah Desa Krawang Sari, Kecamatan Natar, Kabupaten Lampung Selatan ini dapat hadir di tengah-tengah masyarakat.</p><p>Di era keterbukaan informasi dan digitalisasi saat ini, kehadiran website desa bukan lagi sekadar pelengkap, melainkan sebuah kebutuhan mendasar. Melalui portal ini, kami Pemerintah Desa Krawang Sari berkomitmen untuk menghadirkan pelayanan publik yang lebih cepat, transparan, dan akuntabel. Warga kini dapat mengakses informasi pembangunan desa, pengumuman penting, hingga mengajukan layanan administrasi persuratan secara <i>online</i> dari rumah masing-masing.</p><p>Kami menyadari bahwa website ini masih akan terus berkembang. Oleh karena itu, kritik dan saran yang membangun dari seluruh warga masyarakat Krawang Sari sangat kami harapkan demi kesempurnaan pelayanan kami ke depannya.</p><p>Mari bersama-sama kita wujudkan Desa Krawang Sari yang mandiri, maju, dan sejahtera dengan semangat gotong royong!</p><p><strong>Wassalamu’alaikum Warahmatullahi Wabarakatuh.</strong></p>', NULL, NULL, 'pengaturan/sLMvJevLMqn0etCZMD1n2K2nONUpNKGKTbQetow0.jpg', '2026-04-06 15:31:44', '2026-04-22 08:38:28');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(100) NOT NULL,
  `value` text DEFAULT NULL,
  `type` enum('text','image','color','html') DEFAULT 'text',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `surat_beasiswa_detail`
--

CREATE TABLE `surat_beasiswa_detail` (
  `pengajuan_id` bigint(20) UNSIGNED NOT NULL,
  `nama_institusi` varchar(255) NOT NULL,
  `tingkat_pendidikan` enum('SD','SMP','SMA','Perguruan Tinggi','Lainnya') NOT NULL,
  `nama_penerima_beasiswa` varchar(150) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `surat_beasiswa_detail`
--

INSERT INTO `surat_beasiswa_detail` (`pengajuan_id`, `nama_institusi`, `tingkat_pendidikan`, `nama_penerima_beasiswa`, `created_at`, `updated_at`) VALUES
(1, 'UIN Raden Intan Lampung', 'Perguruan Tinggi', 'Dimas Suhendra', '2026-01-16 04:29:48', '2026-01-16 04:29:48'),
(14, 'SMP PGRI 2', 'SMP', 'Destri Wahyuni', '2026-04-06 14:18:00', '2026-04-06 14:18:00');

-- --------------------------------------------------------

--
-- Table structure for table `surat_belummenikah_detail`
--

CREATE TABLE `surat_belummenikah_detail` (
  `pengajuan_id` bigint(20) UNSIGNED NOT NULL,
  `tujuan_permohonan` varchar(255) NOT NULL,
  `nama_pasangan_ideal` varchar(150) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `surat_belummenikah_detail`
--

INSERT INTO `surat_belummenikah_detail` (`pengajuan_id`, `tujuan_permohonan`, `nama_pasangan_ideal`, `created_at`, `updated_at`) VALUES
(8, 'Untuk melamar pekerjaan', NULL, '2026-03-23 07:17:45', '2026-03-23 07:17:45');

-- --------------------------------------------------------

--
-- Table structure for table `surat_domisili_detail`
--

CREATE TABLE `surat_domisili_detail` (
  `pengajuan_id` bigint(20) UNSIGNED NOT NULL,
  `tujuan_pembuatan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `surat_iumk_detail`
--

CREATE TABLE `surat_iumk_detail` (
  `pengajuan_id` bigint(20) UNSIGNED NOT NULL,
  `nama_usaha` varchar(255) NOT NULL,
  `jenis_usaha` varchar(150) NOT NULL,
  `lokasi_usaha` text NOT NULL,
  `modal_usaha` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `surat_iumk_detail`
--

INSERT INTO `surat_iumk_detail` (`pengajuan_id`, `nama_usaha`, `jenis_usaha`, `lokasi_usaha`, `modal_usaha`, `created_at`, `updated_at`) VALUES
(5, 'Ayam Geprek Mas Boy', 'Food and Beverage', 'Jalan Karimun Jawa No. 38, Outlet Geprek Mas Boy', 20000000.00, '2026-03-23 06:54:03', '2026-03-23 06:54:03');

-- --------------------------------------------------------

--
-- Table structure for table `surat_jamkes_detail`
--

CREATE TABLE `surat_jamkes_detail` (
  `pengajuan_id` bigint(20) UNSIGNED NOT NULL,
  `status_peserta` enum('Baru','Perpanjangan','Perubahan Data') NOT NULL,
  `program_bantuan` varchar(100) NOT NULL,
  `nik_tertanggung` varchar(16) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `surat_kehilangan_detail`
--

CREATE TABLE `surat_kehilangan_detail` (
  `pengajuan_id` bigint(20) UNSIGNED NOT NULL,
  `jenis_dokumen_hilang` varchar(100) NOT NULL,
  `keterangan_hilang` text NOT NULL,
  `lokasi_hilang` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `surat_kehilangan_detail`
--

INSERT INTO `surat_kehilangan_detail` (`pengajuan_id`, `jenis_dokumen_hilang`, `keterangan_hilang`, `lokasi_hilang`, `created_at`, `updated_at`) VALUES
(10, 'Buku tabungan', 'Saya lupa', 'saat perjalanan ke uin', '2026-03-23 07:51:10', '2026-03-23 07:51:10');

-- --------------------------------------------------------

--
-- Table structure for table `surat_kematian_detail`
--

CREATE TABLE `surat_kematian_detail` (
  `pengajuan_id` bigint(20) UNSIGNED NOT NULL,
  `nik_yang_meninggal` varchar(16) NOT NULL,
  `nama_yang_meninggal` varchar(150) NOT NULL,
  `tanggal_kematian` datetime NOT NULL,
  `tempat_kematian` varchar(100) NOT NULL,
  `penyebab_kematian` text NOT NULL,
  `nik_pelapor` varchar(16) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `surat_keramaian_detail`
--

CREATE TABLE `surat_keramaian_detail` (
  `pengajuan_id` bigint(20) UNSIGNED NOT NULL,
  `nama_kegiatan` varchar(255) NOT NULL,
  `lokasi_kegiatan` text NOT NULL,
  `tgl_mulai` datetime NOT NULL,
  `tgl_selesai` datetime NOT NULL,
  `penanggung_jawab` varchar(150) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `surat_keramaian_detail`
--

INSERT INTO `surat_keramaian_detail` (`pengajuan_id`, `nama_kegiatan`, `lokasi_kegiatan`, `tgl_mulai`, `tgl_selesai`, `penanggung_jawab`, `created_at`, `updated_at`) VALUES
(11, 'Pernikahan', 'Lapangan pabrik kerupuk', '2026-03-28 00:00:00', '2026-03-29 00:00:00', 'Dimas', '2026-03-23 07:51:52', '2026-03-23 07:51:52');

-- --------------------------------------------------------

--
-- Table structure for table `surat_pengantar_detail`
--

CREATE TABLE `surat_pengantar_detail` (
  `pengajuan_id` bigint(20) UNSIGNED NOT NULL,
  `jenis_pengantar` varchar(150) NOT NULL,
  `keterangan` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `surat_pengantar_detail`
--

INSERT INTO `surat_pengantar_detail` (`pengajuan_id`, `jenis_pengantar`, `keterangan`, `created_at`, `updated_at`) VALUES
(12, 'Pembuatan KTP Baru', 'Pembuatan KTP baru', '2026-03-23 08:27:27', '2026-03-23 08:27:27'),
(13, 'Pembuatan KTP Baru', 'Pembuatan KTP Baru', '2026-04-06 14:06:41', '2026-04-06 14:06:41');

-- --------------------------------------------------------

--
-- Table structure for table `surat_pengantar_ktp_detail`
--

CREATE TABLE `surat_pengantar_ktp_detail` (
  `pengajuan_id` bigint(20) UNSIGNED NOT NULL,
  `jenis_pengurusan` enum('KTP Baru','KK Baru','Akte Kelahiran','Akte Kematian') NOT NULL,
  `alasan_pengurusan` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `surat_penghasilan_detail`
--

CREATE TABLE `surat_penghasilan_detail` (
  `pengajuan_id` bigint(20) UNSIGNED NOT NULL,
  `penghasilan_per_bulan` decimal(15,2) NOT NULL,
  `pekerjaan_sebenarnya` varchar(150) NOT NULL,
  `tempat_kerja` varchar(255) NOT NULL,
  `tujuan_surat` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `surat_penghasilan_detail`
--

INSERT INTO `surat_penghasilan_detail` (`pengajuan_id`, `penghasilan_per_bulan`, `pekerjaan_sebenarnya`, `tempat_kerja`, `tujuan_surat`, `created_at`, `updated_at`) VALUES
(9, 7500000.00, 'Web Developer', '', 'Untuk sekolah anak', '2026-03-23 07:18:35', '2026-03-23 07:18:35');

-- --------------------------------------------------------

--
-- Table structure for table `surat_perubahan_data_detail`
--

CREATE TABLE `surat_perubahan_data_detail` (
  `pengajuan_id` bigint(20) UNSIGNED NOT NULL,
  `data_lama` varchar(255) NOT NULL,
  `data_baru` varchar(255) NOT NULL,
  `alasan_perubahan` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `surat_pindah_domisili_detail`
--

CREATE TABLE `surat_pindah_domisili_detail` (
  `pengajuan_id` bigint(20) UNSIGNED NOT NULL,
  `alamat_tujuan_lengkap` text NOT NULL,
  `alasan_pindah` varchar(255) NOT NULL,
  `tgl_rencana_pindah` date NOT NULL,
  `jumlah_ikut_pindah` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `surat_sktm_detail`
--

CREATE TABLE `surat_sktm_detail` (
  `pengajuan_id` bigint(20) UNSIGNED NOT NULL,
  `tujuan_sktm` varchar(255) NOT NULL,
  `jumlah_tanggungan` int(11) NOT NULL,
  `keterangan_aset` varchar(255) NOT NULL,
  `total_penghasilan_keluarga` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `surat_sktm_detail`
--

INSERT INTO `surat_sktm_detail` (`pengajuan_id`, `tujuan_sktm`, `jumlah_tanggungan`, `keterangan_aset`, `total_penghasilan_keluarga`, `created_at`, `updated_at`) VALUES
(2, 'Pendaftaran Beasiswa', 3, 'Rumah sendiri', 2000000.00, '2026-03-22 07:16:14', '2026-03-22 07:16:14'),
(3, 'Pendaftaran LPDP', 3, 'Tidak ada', 3000000.00, '2026-03-22 07:48:52', '2026-03-22 07:48:52');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `role` enum('admin','warga','kades') DEFAULT 'warga',
  `is_active` tinyint(1) DEFAULT 1,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `is_active`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin Utama', 'admin@desakrawangsari.com', 'admin', 1, NULL, '$2y$12$pyKug4oEvzVv9nZ/ec1HD.ogtrliNMAkRnk0cdfZ8Q4cf5dAY0O9y', 'cRPEjCeIkHgF6blD5lYsSGmj2iQON6zy670ZfajsZGvljfij2ss2Kkd3dX8L', NULL, '2025-12-18 00:35:17'),
(2, 'Dimas Suhendraa', 'dimassuhendra0204@gmail.com', 'warga', 1, NULL, '$2y$12$.7/uHNLGsEY4GIyWwpaidO4Ex2jvS6x3IEYIUcgpsHZnKiB4gzm1G', 'EtoqNJs8HoVNANx0W2Drez7VVy2dwmEOuGIPJBIVzmXHCu9WTzw4aEKdUWo4', '2026-01-29 03:51:17', '2026-01-28 23:24:16'),
(4, 'Kepala Desa', 'kades@desakrawangsari.com', 'kades', 1, NULL, '$2y$12$rd9Iey67sB72E0GChnLG7.OvC.lKZAAEkEGcmKTpcVtuywQkwPq.C', NULL, '2026-04-22 06:55:27', '2026-04-22 06:55:27');

-- --------------------------------------------------------

--
-- Table structure for table `warga`
--

CREATE TABLE `warga` (
  `nik` varchar(16) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `no_kk` varchar(16) DEFAULT NULL,
  `nama_lengkap` varchar(150) NOT NULL,
  `tempat_lahir` varchar(100) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `alamat_jalan` varchar(255) DEFAULT NULL,
  `rt_rw` varchar(10) DEFAULT NULL,
  `kel_desa` varchar(100) DEFAULT NULL,
  `kecamatan` varchar(100) DEFAULT NULL,
  `agama` enum('Islam','Kristen','Katolik','Hindu','Buddha','Konghucu') DEFAULT NULL,
  `status_perkawinan` enum('Kawin','Belum Kawin','Cerai Hidup','Cerai Mati') NOT NULL DEFAULT 'Belum Kawin',
  `pekerjaan` varchar(100) DEFAULT NULL,
  `kewarganegaraan` enum('WNI','WNA') NOT NULL DEFAULT 'WNI',
  `no_hp` varchar(15) DEFAULT NULL,
  `foto` varchar(255) DEFAULT 'foto_profil/nopict.png',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `warga`
--

INSERT INTO `warga` (`nik`, `user_id`, `no_kk`, `nama_lengkap`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `alamat_jalan`, `rt_rw`, `kel_desa`, `kecamatan`, `agama`, `status_perkawinan`, `pekerjaan`, `kewarganegaraan`, `no_hp`, `foto`, `is_active`, `created_at`, `updated_at`) VALUES
('3275041000000011', NULL, '3275040000000001', 'Budi Santoso', NULL, '1990-01-01', 'L', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000013', NULL, '3275040000000001', 'Anisa Santoso', NULL, '1992-05-15', 'P', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000014', NULL, '3275040000000001', 'Doni Santoso', NULL, '1988-10-20', 'L', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000015', NULL, '3275040000000001', 'Eka Santoso', NULL, '1995-02-12', 'P', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000021', NULL, '3275040000000002', 'Ahmad Hidayat', NULL, '1985-07-30', 'L', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000022', NULL, '3275040000000002', 'Ratna Sari', NULL, '1987-11-05', 'P', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000023', NULL, '3275040000000002', 'Lutfi Hidayat', NULL, '1991-04-18', 'L', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000024', NULL, '3275040000000002', 'Maya Hidayat', NULL, '1993-09-22', 'P', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000025', NULL, '3275040000000002', 'Rizky Hidayat', NULL, '1989-12-01', 'L', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000031', NULL, '3275040000000003', 'Slamet Riyadi', NULL, '1990-06-14', 'P', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000032', NULL, '3275040000000003', 'Dewi Lestari', NULL, '1984-03-25', 'L', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000033', NULL, '3275040000000003', 'Rina Riyadi', NULL, '1996-08-08', 'P', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000034', NULL, '3275040000000003', 'Fajar Riyadi', NULL, '1992-01-19', 'L', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000035', NULL, '3275040000000003', 'Gita Riyadi', NULL, '1994-05-30', 'P', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000041', NULL, '3275040000000004', 'Andi Wijaya', NULL, '1986-10-12', 'L', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000042', NULL, '3275040000000004', 'Linda Wijaya', NULL, '1989-02-28', 'P', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000043', NULL, '3275040000000004', 'Bagas Wijaya', NULL, '1991-07-22', 'L', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000044', NULL, '3275040000000004', 'Sinta Wijaya', NULL, '1993-12-05', 'P', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000045', NULL, '3275040000000004', 'Putra Wijaya', NULL, '1987-04-15', 'L', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000051', NULL, '3275040000000005', 'Dedi Kusnadi', NULL, '1990-09-10', 'P', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000052', NULL, '3275040000000005', 'Yeni Kusnadi', NULL, '1985-06-25', 'L', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000053', NULL, '3275040000000005', 'Rahmat Kusnadi', NULL, '1992-03-18', 'P', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000054', NULL, '3275040000000005', 'Hendra Kusnadi', NULL, '1994-08-02', 'L', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000055', NULL, '3275040000000005', 'Lia Kusnadi', NULL, '1996-01-20', 'P', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000061', NULL, '3275040000000006', 'Hendra Gunawan', NULL, '1988-05-12', 'L', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000062', NULL, '3275040000000006', 'Nina Gunawan', NULL, '1991-10-30', 'P', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000063', NULL, '3275040000000006', 'Aldi Gunawan', NULL, '1993-02-14', 'L', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000064', NULL, '3275040000000006', 'Sari Gunawan', NULL, '1995-07-07', 'P', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000065', NULL, '3275040000000006', 'Bayu Gunawan', NULL, '1989-11-22', 'L', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000071', NULL, '3275040000000007', 'Mulyadi', NULL, '1990-04-05', 'P', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000072', NULL, '3275040000000007', 'Ani Mulyadi', NULL, '1986-09-18', 'L', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000073', NULL, '3275040000000007', 'Iman Mulyadi', NULL, '1992-01-25', 'P', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000074', NULL, '3275040000000007', 'Nur Mulyadi', NULL, '1994-06-12', 'L', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000075', NULL, '3275040000000007', 'Dian Mulyadi', NULL, '1997-10-30', 'P', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000081', NULL, '3275040000000008', 'Roni Setiawan', NULL, '1987-03-05', 'L', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000082', NULL, '3275040000000008', 'Tania Setiawan', NULL, '1990-08-20', 'P', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000083', NULL, '3275040000000008', 'Gery Setiawan', NULL, '1992-12-15', 'L', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000084', NULL, '3275040000000008', 'Lina Setiawan', NULL, '1995-05-02', 'P', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000085', NULL, '3275040000000008', 'Rara Setiawan', NULL, '1989-10-18', 'L', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000091', NULL, '3275040000000009', 'Agus Prayitno', NULL, '1991-02-25', 'P', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000092', NULL, '3275040000000009', 'Ida Prayitno', NULL, '1985-07-12', 'L', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000093', NULL, '3275040000000009', 'Eko Prayitno', NULL, '1993-11-30', 'P', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000094', NULL, '3275040000000009', 'Dwi Prayitno', NULL, '1995-04-05', 'L', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000095', NULL, '3275040000000009', 'Tri Prayitno', NULL, '1997-09-18', 'P', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000101', NULL, '3275040000000010', 'Eko Prasetyo', NULL, '1988-12-12', 'L', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000102', NULL, '3275040000000010', 'Fitri Prasetyo', NULL, '1991-05-25', 'P', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000103', NULL, '3275040000000010', 'Galih Prasetyo', NULL, '1993-10-08', 'L', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000104', NULL, '3275040000000010', 'Hani Prasetyo', NULL, '1996-03-20', 'P', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000105', NULL, '3275040000000010', 'Indra Prasetyo', NULL, '1990-07-15', 'L', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000111', NULL, '3275040000000011', 'Surya Saputra', NULL, '1992-11-02', 'P', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000112', NULL, '3275040000000011', 'Juli Saputra', NULL, '1986-04-18', 'L', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000113', NULL, '3275040000000011', 'Kiki Saputra', NULL, '1994-09-30', 'P', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000114', NULL, '3275040000000011', 'Lulu Saputra', NULL, '1996-02-12', 'L', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000115', NULL, '3275040000000011', 'Maman Saputra', NULL, '1998-07-05', 'P', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000121', NULL, '3275040000000012', 'Ferry Irawan', NULL, '1989-01-22', 'L', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000122', NULL, '3275040000000012', 'Nana Irawan', NULL, '1992-06-05', 'P', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000123', NULL, '3275040000000012', 'Oky Irawan', NULL, '1994-10-18', 'L', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000124', NULL, '3275040000000012', 'Puti Irawan', NULL, '1997-03-02', 'P', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000125', NULL, '3275040000000012', 'Qori Irawan', NULL, '1991-08-15', 'L', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000131', NULL, '3275040000000013', 'Bambang Pamungkas', NULL, '1993-12-28', 'P', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000132', NULL, '3275040000000013', 'Rosa Pamungkas', NULL, '1987-05-10', 'L', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000133', NULL, '3275040000000013', 'Soni Pamungkas', NULL, '1995-10-22', 'P', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000134', NULL, '3275040000000013', 'Tini Pamungkas', NULL, '1997-04-05', 'L', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000135', NULL, '3275040000000013', 'Umar Pamungkas', NULL, '1999-09-18', 'P', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000141', NULL, '3275040000000014', 'Indra Lesmana', NULL, '1990-02-12', 'L', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000142', NULL, '3275040000000014', 'Vina Lesmana', NULL, '1993-07-25', 'P', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000143', NULL, '3275040000000014', 'Wawan Lesmana', NULL, '1995-12-08', 'L', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000144', NULL, '3275040000000014', 'Xena Lesmana', NULL, '1998-04-20', 'P', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000145', NULL, '3275040000000014', 'Yudi Lesmana', NULL, '1992-08-15', 'L', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000151', NULL, '3275040000000015', 'Taufik Hidayat', NULL, '1994-01-02', 'P', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000152', NULL, '3275040000000015', 'Zahra Hidayat', NULL, '1988-06-18', 'L', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000153', NULL, '3275040000000015', 'Ali Hidayat', NULL, '1996-11-30', 'P', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000154', NULL, '3275040000000015', 'Bella Hidayat', NULL, '1998-04-12', 'L', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000155', NULL, '3275040000000015', 'Caca Hidayat', NULL, '2000-09-05', 'P', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000161', NULL, '3275040000000016', 'Rian Gede', NULL, '1991-03-22', 'L', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000162', NULL, '3275040000000016', 'Dina Gede', NULL, '1994-08-05', 'P', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000163', NULL, '3275040000000016', 'Eris Gede', NULL, '1996-12-18', 'L', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000164', NULL, '3275040000000016', 'Fani Gede', NULL, '1999-05-02', 'P', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000165', NULL, '3275040000000016', 'Gina Gede', NULL, '1993-09-15', 'L', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000171', NULL, '3275040000000017', 'Adi Nugroho', NULL, '1995-02-02', 'P', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000172', NULL, '3275040000000017', 'Hana Nugroho', NULL, '1989-07-18', 'L', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000173', NULL, '3275040000000017', 'Iwan Nugroho', NULL, '1997-12-30', 'P', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000174', NULL, '3275040000000017', 'Jaka Nugroho', NULL, '1999-05-12', 'L', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000175', NULL, '3275040000000017', 'Kiki Nugroho', NULL, '2001-10-05', 'P', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000181', NULL, '3275040000000018', 'Gading Marten', NULL, '1992-04-22', 'L', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000182', NULL, '3275040000000018', 'Gisel Marten', NULL, '1995-09-05', 'P', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000183', NULL, '3275040000000018', 'Gempi Marten', NULL, '1997-01-18', 'L', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000184', NULL, '3275040000000018', 'Gani Marten', NULL, '2000-06-02', 'P', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000185', NULL, '3275040000000018', 'Gito Marten', NULL, '1994-10-15', 'L', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000191', NULL, '3275040000000019', 'Raffi Ahmad', NULL, '1996-03-02', 'P', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000192', NULL, '3275040000000019', 'Nagita Slavina', NULL, '1990-08-18', 'L', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000193', NULL, '3275040000000019', 'Rafathar Ahmad', NULL, '1998-12-30', 'P', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000194', NULL, '3275040000000019', 'Rayyanza Ahmad', NULL, '2000-05-12', 'L', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000195', NULL, '3275040000000019', 'Merry Ahmad', NULL, '2002-10-05', 'P', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000201', NULL, '3275040000000020', 'Sule Prikitiw', NULL, '1993-05-22', 'L', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000202', NULL, '3275040000000020', 'Nathalie Sule', NULL, '1996-10-05', 'P', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000203', NULL, '3275040000000020', 'Rizky Sule', NULL, '1998-02-18', 'L', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000204', NULL, '3275040000000020', 'Putri Sule', NULL, '2001-07-02', 'P', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041000000205', NULL, '3275040000000020', 'Rizwan Sule', NULL, '1995-11-15', 'L', NULL, NULL, NULL, NULL, NULL, 'Belum Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 13:45:39', '2025-12-18 13:45:39'),
('3275041807010011', 2, '3275041304070302', 'Dimas Suhendraa', 'Indonesia', '1997-04-02', 'P', 'Jalan Pelabuhan Raya Kost Villa Marina', '01/03', 'Sukabumi', 'Sukarame', 'Islam', 'Belum Kawin', 'Belum ada pekerjaan', 'WNI', '085780809099', 'foto_profil/nopict.png', 1, '2025-12-16 07:20:27', '2026-01-16 04:03:35'),
('3275041807010012', NULL, '3275041304070302', 'Destri wahyuni', NULL, '1991-09-18', 'L', NULL, NULL, NULL, NULL, 'Islam', 'Kawin', NULL, 'WNI', NULL, 'foto_profil/nopict.png', 1, '2025-12-18 03:44:02', '2025-12-18 03:44:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `aktivitas_logs`
--
ALTER TABLE `aktivitas_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jenis_surat`
--
ALTER TABLE `jenis_surat`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_surat` (`kode_surat`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keluarga`
--
ALTER TABLE `keluarga`
  ADD PRIMARY KEY (`no_kk`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `warga_nik` (`warga_nik`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `pengajuan_surat`
--
ALTER TABLE `pengajuan_surat`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_verifikasi_qr` (`kode_verifikasi_qr`),
  ADD KEY `warga_nik` (`warga_nik`),
  ADD KEY `jenis_surat_id` (`jenis_surat_id`);

--
-- Indexes for table `pengaturan_desa`
--
ALTER TABLE `pengaturan_desa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `key` (`key`);

--
-- Indexes for table `surat_beasiswa_detail`
--
ALTER TABLE `surat_beasiswa_detail`
  ADD PRIMARY KEY (`pengajuan_id`);

--
-- Indexes for table `surat_belummenikah_detail`
--
ALTER TABLE `surat_belummenikah_detail`
  ADD PRIMARY KEY (`pengajuan_id`);

--
-- Indexes for table `surat_domisili_detail`
--
ALTER TABLE `surat_domisili_detail`
  ADD PRIMARY KEY (`pengajuan_id`);

--
-- Indexes for table `surat_iumk_detail`
--
ALTER TABLE `surat_iumk_detail`
  ADD PRIMARY KEY (`pengajuan_id`);

--
-- Indexes for table `surat_jamkes_detail`
--
ALTER TABLE `surat_jamkes_detail`
  ADD PRIMARY KEY (`pengajuan_id`);

--
-- Indexes for table `surat_kehilangan_detail`
--
ALTER TABLE `surat_kehilangan_detail`
  ADD PRIMARY KEY (`pengajuan_id`);

--
-- Indexes for table `surat_kematian_detail`
--
ALTER TABLE `surat_kematian_detail`
  ADD PRIMARY KEY (`pengajuan_id`),
  ADD KEY `nik_pelapor` (`nik_pelapor`);

--
-- Indexes for table `surat_keramaian_detail`
--
ALTER TABLE `surat_keramaian_detail`
  ADD PRIMARY KEY (`pengajuan_id`);

--
-- Indexes for table `surat_pengantar_detail`
--
ALTER TABLE `surat_pengantar_detail`
  ADD PRIMARY KEY (`pengajuan_id`);

--
-- Indexes for table `surat_pengantar_ktp_detail`
--
ALTER TABLE `surat_pengantar_ktp_detail`
  ADD PRIMARY KEY (`pengajuan_id`);

--
-- Indexes for table `surat_penghasilan_detail`
--
ALTER TABLE `surat_penghasilan_detail`
  ADD PRIMARY KEY (`pengajuan_id`);

--
-- Indexes for table `surat_perubahan_data_detail`
--
ALTER TABLE `surat_perubahan_data_detail`
  ADD PRIMARY KEY (`pengajuan_id`);

--
-- Indexes for table `surat_pindah_domisili_detail`
--
ALTER TABLE `surat_pindah_domisili_detail`
  ADD PRIMARY KEY (`pengajuan_id`);

--
-- Indexes for table `surat_sktm_detail`
--
ALTER TABLE `surat_sktm_detail`
  ADD PRIMARY KEY (`pengajuan_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `warga`
--
ALTER TABLE `warga`
  ADD PRIMARY KEY (`nik`),
  ADD KEY `no_kk` (`no_kk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `aktivitas_logs`
--
ALTER TABLE `aktivitas_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jenis_surat`
--
ALTER TABLE `jenis_surat`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pengaduan`
--
ALTER TABLE `pengaduan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pengajuan_surat`
--
ALTER TABLE `pengajuan_surat`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pengaturan_desa`
--
ALTER TABLE `pengaturan_desa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `berita`
--
ALTER TABLE `berita`
  ADD CONSTRAINT `berita_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD CONSTRAINT `pengaduan_ibfk_1` FOREIGN KEY (`warga_nik`) REFERENCES `warga` (`nik`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pengaduan_ibfk_2` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `pengajuan_surat`
--
ALTER TABLE `pengajuan_surat`
  ADD CONSTRAINT `pengajuan_surat_ibfk_1` FOREIGN KEY (`warga_nik`) REFERENCES `warga` (`nik`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pengajuan_surat_ibfk_2` FOREIGN KEY (`jenis_surat_id`) REFERENCES `jenis_surat` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `surat_beasiswa_detail`
--
ALTER TABLE `surat_beasiswa_detail`
  ADD CONSTRAINT `surat_beasiswa_detail_ibfk_1` FOREIGN KEY (`pengajuan_id`) REFERENCES `pengajuan_surat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `surat_belummenikah_detail`
--
ALTER TABLE `surat_belummenikah_detail`
  ADD CONSTRAINT `surat_belummenikah_detail_ibfk_1` FOREIGN KEY (`pengajuan_id`) REFERENCES `pengajuan_surat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `surat_domisili_detail`
--
ALTER TABLE `surat_domisili_detail`
  ADD CONSTRAINT `surat_domisili_detail_ibfk_1` FOREIGN KEY (`pengajuan_id`) REFERENCES `pengajuan_surat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `surat_iumk_detail`
--
ALTER TABLE `surat_iumk_detail`
  ADD CONSTRAINT `surat_iumk_detail_ibfk_1` FOREIGN KEY (`pengajuan_id`) REFERENCES `pengajuan_surat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `surat_jamkes_detail`
--
ALTER TABLE `surat_jamkes_detail`
  ADD CONSTRAINT `surat_jamkes_detail_ibfk_1` FOREIGN KEY (`pengajuan_id`) REFERENCES `pengajuan_surat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `surat_kehilangan_detail`
--
ALTER TABLE `surat_kehilangan_detail`
  ADD CONSTRAINT `surat_kehilangan_detail_ibfk_1` FOREIGN KEY (`pengajuan_id`) REFERENCES `pengajuan_surat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `surat_kematian_detail`
--
ALTER TABLE `surat_kematian_detail`
  ADD CONSTRAINT `surat_kematian_detail_ibfk_1` FOREIGN KEY (`pengajuan_id`) REFERENCES `pengajuan_surat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `surat_kematian_detail_ibfk_2` FOREIGN KEY (`nik_pelapor`) REFERENCES `warga` (`nik`) ON UPDATE CASCADE;

--
-- Constraints for table `surat_keramaian_detail`
--
ALTER TABLE `surat_keramaian_detail`
  ADD CONSTRAINT `surat_keramaian_detail_ibfk_1` FOREIGN KEY (`pengajuan_id`) REFERENCES `pengajuan_surat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `surat_pengantar_detail`
--
ALTER TABLE `surat_pengantar_detail`
  ADD CONSTRAINT `surat_pengantar_detail_ibfk_1` FOREIGN KEY (`pengajuan_id`) REFERENCES `pengajuan_surat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `surat_pengantar_ktp_detail`
--
ALTER TABLE `surat_pengantar_ktp_detail`
  ADD CONSTRAINT `surat_pengantar_ktp_detail_ibfk_1` FOREIGN KEY (`pengajuan_id`) REFERENCES `pengajuan_surat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `surat_penghasilan_detail`
--
ALTER TABLE `surat_penghasilan_detail`
  ADD CONSTRAINT `surat_penghasilan_detail_ibfk_1` FOREIGN KEY (`pengajuan_id`) REFERENCES `pengajuan_surat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `surat_perubahan_data_detail`
--
ALTER TABLE `surat_perubahan_data_detail`
  ADD CONSTRAINT `surat_perubahan_data_detail_ibfk_1` FOREIGN KEY (`pengajuan_id`) REFERENCES `pengajuan_surat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `surat_pindah_domisili_detail`
--
ALTER TABLE `surat_pindah_domisili_detail`
  ADD CONSTRAINT `surat_pindah_domisili_detail_ibfk_1` FOREIGN KEY (`pengajuan_id`) REFERENCES `pengajuan_surat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `surat_sktm_detail`
--
ALTER TABLE `surat_sktm_detail`
  ADD CONSTRAINT `surat_sktm_detail_ibfk_1` FOREIGN KEY (`pengajuan_id`) REFERENCES `pengajuan_surat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `warga`
--
ALTER TABLE `warga`
  ADD CONSTRAINT `warga_ibfk_1` FOREIGN KEY (`no_kk`) REFERENCES `keluarga` (`no_kk`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
