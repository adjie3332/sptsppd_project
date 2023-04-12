-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 05, 2023 at 10:06 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sppd_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `biayas`
--

CREATE TABLE `biayas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kegiatan` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_pegawai` bigint(20) UNSIGNED NOT NULL,
  `lokasi` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hari_tgl` date NOT NULL,
  `rekening` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uang_harian` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uang_transport` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `biaya_transport` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `biaya_diperintah`
--

CREATE TABLE `biaya_diperintah` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `biaya_id` bigint(20) UNSIGNED NOT NULL,
  `pegawai_id` bigint(20) UNSIGNED NOT NULL,
  `uang_harian` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uang_transport` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `biaya_transport` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `biaya_namas`
--

CREATE TABLE `biaya_namas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `biaya_id` bigint(20) UNSIGNED NOT NULL,
  `pegawai_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `instansis`
--

CREATE TABLE `instansis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'DINAS KETAHANAN PANGAN',
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Jl. Nusantara No. 1',
  `telepon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '(0276) 325174',
  `faksimile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '(0276) 325174',
  `website` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'www.ketahananpangan.boyolali.go.id',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'dkp@boyolali.go.id',
  `kodepos` int(11) NOT NULL DEFAULT 57312,
  `kepala_dinas` bigint(20) UNSIGNED NOT NULL,
  `sekretaris` bigint(20) UNSIGNED NOT NULL,
  `kabid_KKP` bigint(20) UNSIGNED NOT NULL,
  `kabid_KDCP` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `instansis`
--

INSERT INTO `instansis` (`id`, `nama`, `alamat`, `telepon`, `faksimile`, `website`, `email`, `kodepos`, `kepala_dinas`, `sekretaris`, `kabid_KKP`, `kabid_KDCP`, `created_at`, `updated_at`) VALUES
(1, 'DINAS KETAHANAN PANGAN', 'Jl. Nusantara No. 1', '(0276) 325174', '(0276) 325174', 'www.ketahananpangan.boyolali.go.id', 'dkp@boyolali.go.id', 57312, 1, 2, 3, 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `log_activity`
--

CREATE TABLE `log_activity` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `agent` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_11_25_020558_create_contacts_table', 1),
(6, '2022_11_28_062739_create_pegawais_table', 1),
(7, '2022_12_07_015338_create_spts_table', 1),
(8, '2022_12_07_020155_create_spt_diperintahs_table', 1),
(9, '2022_12_09_075647_create_sppds_table', 1),
(10, '2022_12_10_015413_create_sppd_pengikuts', 1),
(11, '2022_12_10_064026_create_log_activity_table', 1),
(12, '2022_12_12_035556_create_biayas_table', 1),
(13, '2022_12_13_040777_create_biaya_namas', 1),
(14, '2022_12_17_040777_create_biaya_diperintah', 1),
(15, '2022_12_19_203008_create_instansis_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pegawais`
--

CREATE TABLE `pegawais` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pangkat` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `golongan` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `eselon` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pegawais`
--

INSERT INTO `pegawais` (`id`, `nip`, `name`, `jabatan`, `pangkat`, `golongan`, `eselon`, `created_at`, `updated_at`) VALUES
(1, '19650220 199302 1 002', 'Ir. JOKO SUHARTONO, M.Si', 'Kepala Dinas Ketahanan Pangan Kabupaten Boyolali', 'Pembina Utama Muda', 'IV/c', 'Eselon II', '2023-04-05 01:24:02', '2023-04-05 01:24:02'),
(2, '19681027 199403 1 005', 'Drs. Sabarudin, SH. MM', 'Sekretaris Dinas Ketahanan Pangan Kabupaten Boyolali', 'Pembina Tingkat I', 'IV/b', 'Eselon III', '2023-04-05 01:24:22', '2023-04-05 01:24:22'),
(3, '19650912 199303 2 007', 'Ir. Wiwit Soco Widati', 'Kepala Bidang Konsumsi dan Keamanan Pangan Dinas Ketahanan Pangan Kab. Boyolali', 'Pembina', 'IV/a', 'Eselon III', '2023-04-05 01:24:50', '2023-04-05 01:24:50'),
(4, '19800224 200501 2 007', 'Drh. Dhian Mujiwiyati', 'Kepala Bidang Ketersediaan, Distribusi, dan Cadangan Pangan DKP Kab. Boyolali', 'Pembina', 'IV/a', 'Eselon III', '2023-04-05 01:25:10', '2023-04-05 01:25:10'),
(5, '19761021 200312 2 004', 'Lailia WindawatiS.Hut.MM', 'Analisis Ketahanan pangan Ahli Muda Dinas Ketahanan Pangan Kab. Boyolali', 'Pembina', 'IV/a', 'Eselon III', '2023-04-05 02:30:07', '2023-04-05 02:30:07'),
(6, '19760803 200312 2 005', 'Rumsari Sri Utami, S.Pt.M.Si', 'Pengawas mutu hasil Pertanian Ahli Muda Dinas Ketahanan Pangan Kab. Boyolali', 'Pembina', 'IV/a', 'Eselon III', '2023-04-05 02:31:47', '2023-04-05 02:31:47'),
(7, '19690308 199603 2 002', 'RR. Sri Wahyuni, MM', 'Analisis  Ketahanan Pangan Ahli Muda Ketahanan Pangan Kab. Boyolali', 'Pembina', 'IV/a', 'Eselon III', '2023-04-05 02:32:46', '2023-04-05 02:32:46'),
(8, '19770923 200801 1 005', 'Mohammad Adam Nurfathoni, SP. M.M', 'Kasubag Tata Usaha Dinas Ketahannan Pangan Kab. Boyolali', 'Penata Tingkat I', 'III/d', 'Eselon IV', '2023-04-05 02:33:45', '2023-04-05 02:33:45'),
(9, '19790625 200604 2 005', 'Nur Djamilah, S.TP', 'Analisis Ketahanan pangan Ahli Muda Dinas Ketahanan Pangan Kab. Boyolali', 'Penata Tingkat I', 'III/d', 'Eselon IV', '2023-04-05 02:35:13', '2023-04-05 02:35:13'),
(10, '19690820 198903 2 005', 'Purwati. SPT', 'Analisis Ketahanan pangan Ahli Muda Dinas Ketahanan Pangan Kab. Boyolali', 'Penata Tingkat I', 'III/d', 'Eselon IV', '2023-04-05 02:35:57', '2023-04-05 02:35:57'),
(11, '19720928 200801 2 004', 'Iwin Nawantiana W.SP.MM', 'Analisis Ketahanan pangan Ahli Muda Dinas Ketahanan Pangan Kab. Boyolali', 'Penata Tingkat I', 'III/d', 'Eselon IV', '2023-04-05 02:36:52', '2023-04-05 02:36:52'),
(12, '19721007 200604 2 017', 'Ida Lawina, S.Sn', 'Perencana Ahli Muda Dinas Ketahanan Pangan Kab. Boyolali', 'Penata Tingkat I', 'III/d', 'Eselon IV', '2023-04-05 02:38:15', '2023-04-05 02:38:15'),
(13, '19750413 199803 2 003', 'Sugiyanti.SP', 'Pengelolah  Data Laporan Keuangan Dinas Ketahanan Pangan Kab. Boyolali', 'Penata Tingkat I', 'III/d', 'Eselon IV', '2023-04-05 02:40:25', '2023-04-05 02:40:25');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sppds`
--

CREATE TABLE `sppds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `nomor_surat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `maksud_perintah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transportasi` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_berangkat` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_tujuan` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_pergi` date NOT NULL,
  `tgl_kembali` date NOT NULL,
  `pejabat_pemerintah` bigint(20) UNSIGNED NOT NULL,
  `pejabat_diperintah` bigint(20) UNSIGNED NOT NULL,
  `instansi` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mata_anggaran` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_keluar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_tujuan_1` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_tiba_1` date DEFAULT NULL,
  `tgl_berangkat_dari_1` date DEFAULT NULL,
  `tempat_tujuan_2` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_tiba_2` date DEFAULT NULL,
  `tgl_berangkat_dari_2` date DEFAULT NULL,
  `tempat_tujuan_3` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_tiba_3` date DEFAULT NULL,
  `tgl_berangkat_dari_3` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sppds`
--

INSERT INTO `sppds` (`id`, `user_id`, `nomor_surat`, `maksud_perintah`, `transportasi`, `tempat_berangkat`, `tempat_tujuan`, `tgl_pergi`, `tgl_kembali`, `pejabat_pemerintah`, `pejabat_diperintah`, `instansi`, `mata_anggaran`, `keterangan`, `tgl_keluar`, `tempat_tujuan_1`, `tgl_tiba_1`, `tgl_berangkat_dari_1`, `tempat_tujuan_2`, `tgl_tiba_2`, `tgl_berangkat_dari_2`, `tempat_tujuan_3`, `tgl_tiba_3`, `tgl_berangkat_dari_3`, `created_at`, `updated_at`) VALUES
(1, 1, '094 / 001 / 4.7 / 2023', 'Mengikuti Bimtek Pengolahan Data dan Informasi Pemerintahan Kabupaten Boyolali Tahun Anggaran 2022', 'Kendaraan Dinas', 'DKP Kab. Boyolali', 'Ampel', '2023-04-05', '2023-04-05', 1, 2, 'Dinas Ketahanan Pangan Kabupaten Boyolali', '5. 1. 02. 04. 01. 0001', NULL, '2023-04-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-05 01:31:04', '2023-04-05 01:31:04');

-- --------------------------------------------------------

--
-- Table structure for table `sppd_pengikuts`
--

CREATE TABLE `sppd_pengikuts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sppd_id` bigint(20) UNSIGNED NOT NULL,
  `pegawai_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `spts`
--

CREATE TABLE `spts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nomor_surat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dasar_perintah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `maksud_tugas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_pergi` date NOT NULL,
  `tgl_kembali` date NOT NULL,
  `waktu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_ditetapkan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_ditetapkan` date NOT NULL,
  `yang_menetapkan` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `spts`
--

INSERT INTO `spts` (`id`, `nomor_surat`, `dasar_perintah`, `maksud_tugas`, `tgl_pergi`, `tgl_kembali`, `waktu`, `tempat`, `tempat_ditetapkan`, `tgl_ditetapkan`, `yang_menetapkan`, `user_id`, `created_at`, `updated_at`) VALUES
(1, '094 / 001 / 4.7 / 2023', NULL, 'Input Data SIPD dan FMIS dan Perubahan 2022 Serta Nurni 2023 Dinas Ketahanan Pangan Kabupaten Boyolali', '2023-04-05', '2023-04-05', '08:00', 'Hotel Grand Keisha Yogyakarta', 'Boyolali', '2023-04-05', 1, 2, '2023-04-05 01:30:20', '2023-04-05 02:08:26');

-- --------------------------------------------------------

--
-- Table structure for table `spt_diperintahs`
--

CREATE TABLE `spt_diperintahs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `spt_id` bigint(20) UNSIGNED NOT NULL,
  `pegawai_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `spt_diperintahs`
--

INSERT INTO `spt_diperintahs` (`id`, `spt_id`, `pegawai_id`, `created_at`, `updated_at`) VALUES
(1, 1, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'dkpboyolali', 'dkp@boyolali.go.id', NULL, '$2y$10$sngRLmzpVSWcGLVViZecNuuZk7E5csS/sKMQ.nDyWG9AMX2XQCrna', 'user', NULL, '2023-04-05 01:23:30', '2023-04-05 01:23:30'),
(2, 'Aji Santoso', 'adjie3332@gmail.com', NULL, '$2y$10$qymCwuSPgELq8cp93EFJrO2e/HCpO4sGqVhsoUcgd6S1kMnDquYkS', 'user', NULL, '2023-04-05 01:40:54', '2023-04-05 01:40:54'),
(3, 'admin', 'admin@admin.com', NULL, '$2y$10$PIbIO57yuguNtNNxeTrTe.m..XTR9JxF04.Y91x8OLxRWCuoOhAua', 'user', NULL, '2023-04-05 04:00:52', '2023-04-05 04:00:52'),
(4, 'cek', 'cek@admin.com', NULL, '$2y$10$dBDvlTHjILPOdJ059NxkUeUFdCTuS8aZ7oR74bM8k6mnNNjtB0Qi6', 'user', NULL, '2023-04-05 04:11:23', '2023-04-05 04:11:23'),
(5, 'admin', 'cobalagi@admin.com', NULL, '$2y$10$hRSEbs5osgAk1BbtQTgnceIgB/xkUuZG0VoFl8LXG.ipNEycv1ogK', 'admin', NULL, '2023-04-05 04:14:24', '2023-04-05 04:14:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `biayas`
--
ALTER TABLE `biayas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `biayas_nama_pegawai_foreign` (`nama_pegawai`);

--
-- Indexes for table `biaya_diperintah`
--
ALTER TABLE `biaya_diperintah`
  ADD PRIMARY KEY (`id`),
  ADD KEY `biaya_diperintah_biaya_id_foreign` (`biaya_id`),
  ADD KEY `biaya_diperintah_pegawai_id_foreign` (`pegawai_id`);

--
-- Indexes for table `biaya_namas`
--
ALTER TABLE `biaya_namas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `biaya_namas_biaya_id_foreign` (`biaya_id`),
  ADD KEY `biaya_namas_pegawai_id_foreign` (`pegawai_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `instansis`
--
ALTER TABLE `instansis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `instansis_kepala_dinas_foreign` (`kepala_dinas`),
  ADD KEY `instansis_sekretaris_foreign` (`sekretaris`),
  ADD KEY `instansis_kabid_kkp_foreign` (`kabid_KKP`),
  ADD KEY `instansis_kabid_kdcp_foreign` (`kabid_KDCP`);

--
-- Indexes for table `log_activity`
--
ALTER TABLE `log_activity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pegawais`
--
ALTER TABLE `pegawais`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `sppds`
--
ALTER TABLE `sppds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sppds_user_id_foreign` (`user_id`),
  ADD KEY `sppds_pejabat_pemerintah_foreign` (`pejabat_pemerintah`),
  ADD KEY `sppds_pejabat_diperintah_foreign` (`pejabat_diperintah`);

--
-- Indexes for table `sppd_pengikuts`
--
ALTER TABLE `sppd_pengikuts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sppd_pengikuts_sppd_id_foreign` (`sppd_id`),
  ADD KEY `sppd_pengikuts_pegawai_id_foreign` (`pegawai_id`);

--
-- Indexes for table `spts`
--
ALTER TABLE `spts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `spts_yang_menetapkan_foreign` (`yang_menetapkan`),
  ADD KEY `spts_user_id_foreign` (`user_id`);

--
-- Indexes for table `spt_diperintahs`
--
ALTER TABLE `spt_diperintahs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `spt_diperintahs_spt_id_foreign` (`spt_id`),
  ADD KEY `spt_diperintahs_pegawai_id_foreign` (`pegawai_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `biayas`
--
ALTER TABLE `biayas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `biaya_diperintah`
--
ALTER TABLE `biaya_diperintah`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `biaya_namas`
--
ALTER TABLE `biaya_namas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `instansis`
--
ALTER TABLE `instansis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `log_activity`
--
ALTER TABLE `log_activity`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pegawais`
--
ALTER TABLE `pegawais`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sppds`
--
ALTER TABLE `sppds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sppd_pengikuts`
--
ALTER TABLE `sppd_pengikuts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `spts`
--
ALTER TABLE `spts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `spt_diperintahs`
--
ALTER TABLE `spt_diperintahs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `biayas`
--
ALTER TABLE `biayas`
  ADD CONSTRAINT `biayas_nama_pegawai_foreign` FOREIGN KEY (`nama_pegawai`) REFERENCES `pegawais` (`id`);

--
-- Constraints for table `biaya_diperintah`
--
ALTER TABLE `biaya_diperintah`
  ADD CONSTRAINT `biaya_diperintah_biaya_id_foreign` FOREIGN KEY (`biaya_id`) REFERENCES `biayas` (`id`),
  ADD CONSTRAINT `biaya_diperintah_pegawai_id_foreign` FOREIGN KEY (`pegawai_id`) REFERENCES `pegawais` (`id`);

--
-- Constraints for table `biaya_namas`
--
ALTER TABLE `biaya_namas`
  ADD CONSTRAINT `biaya_namas_biaya_id_foreign` FOREIGN KEY (`biaya_id`) REFERENCES `biayas` (`id`),
  ADD CONSTRAINT `biaya_namas_pegawai_id_foreign` FOREIGN KEY (`pegawai_id`) REFERENCES `pegawais` (`id`);

--
-- Constraints for table `instansis`
--
ALTER TABLE `instansis`
  ADD CONSTRAINT `instansis_kabid_kdcp_foreign` FOREIGN KEY (`kabid_KDCP`) REFERENCES `pegawais` (`id`),
  ADD CONSTRAINT `instansis_kabid_kkp_foreign` FOREIGN KEY (`kabid_KKP`) REFERENCES `pegawais` (`id`),
  ADD CONSTRAINT `instansis_kepala_dinas_foreign` FOREIGN KEY (`kepala_dinas`) REFERENCES `pegawais` (`id`),
  ADD CONSTRAINT `instansis_sekretaris_foreign` FOREIGN KEY (`sekretaris`) REFERENCES `pegawais` (`id`);

--
-- Constraints for table `sppds`
--
ALTER TABLE `sppds`
  ADD CONSTRAINT `sppds_pejabat_diperintah_foreign` FOREIGN KEY (`pejabat_diperintah`) REFERENCES `pegawais` (`id`),
  ADD CONSTRAINT `sppds_pejabat_pemerintah_foreign` FOREIGN KEY (`pejabat_pemerintah`) REFERENCES `pegawais` (`id`),
  ADD CONSTRAINT `sppds_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `sppd_pengikuts`
--
ALTER TABLE `sppd_pengikuts`
  ADD CONSTRAINT `sppd_pengikuts_pegawai_id_foreign` FOREIGN KEY (`pegawai_id`) REFERENCES `pegawais` (`id`),
  ADD CONSTRAINT `sppd_pengikuts_sppd_id_foreign` FOREIGN KEY (`sppd_id`) REFERENCES `sppds` (`id`);

--
-- Constraints for table `spts`
--
ALTER TABLE `spts`
  ADD CONSTRAINT `spts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `spts_yang_menetapkan_foreign` FOREIGN KEY (`yang_menetapkan`) REFERENCES `pegawais` (`id`);

--
-- Constraints for table `spt_diperintahs`
--
ALTER TABLE `spt_diperintahs`
  ADD CONSTRAINT `spt_diperintahs_pegawai_id_foreign` FOREIGN KEY (`pegawai_id`) REFERENCES `pegawais` (`id`),
  ADD CONSTRAINT `spt_diperintahs_spt_id_foreign` FOREIGN KEY (`spt_id`) REFERENCES `spts` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
