-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: May 15, 2025 at 08:19 AM
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
-- Database: `pa1`
--

-- --------------------------------------------------------

--
-- Table structure for table `abouts`
--

CREATE TABLE `abouts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `gambar1` varchar(255) DEFAULT NULL,
  `sejarah` text DEFAULT NULL,
  `gambar2` varchar(255) DEFAULT NULL,
  `visi_misi` text DEFAULT NULL,
  `jumlah_penduduk` int(11) DEFAULT NULL,
  `luas_wilayah` varchar(255) DEFAULT NULL,
  `jumlah_perangkat_desa` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `about_uses`
--

CREATE TABLE `about_uses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `gambar1` varchar(255) DEFAULT NULL,
  `visi_misi` text DEFAULT NULL,
  `gambar2` varchar(255) DEFAULT NULL,
  `sejarah` longtext DEFAULT NULL,
  `jumlah_penduduk` int(11) DEFAULT NULL,
  `luas_wilayah` varchar(255) DEFAULT NULL,
  `jumlah_perangkat_desa` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `alat_pertanian`
--

CREATE TABLE `alat_pertanian` (
  `id_alat_pertanian` bigint(20) UNSIGNED NOT NULL,
  `nama_alat_pertanian` varchar(255) NOT NULL,
  `jenis_alat_pertanian` enum('Olah_Lahan','Pascapanen','Lainnya') NOT NULL,
  `harga_sewa` int(11) NOT NULL,
  `status_alat` enum('tersedia','tidak_tersedia') NOT NULL DEFAULT 'tersedia',
  `jumlah_alat` int(11) NOT NULL,
  `jumlah_tersedia` int(11) NOT NULL DEFAULT 0,
  `gambar_alat` varchar(255) NOT NULL,
  `catatan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `alat_pertanian`
--

INSERT INTO `alat_pertanian` (`id_alat_pertanian`, `nama_alat_pertanian`, `jenis_alat_pertanian`, `harga_sewa`, `status_alat`, `jumlah_alat`, `jumlah_tersedia`, `gambar_alat`, `catatan`, `created_at`, `updated_at`) VALUES
(1, 'Tes1', 'Olah_Lahan', 120000, 'tersedia', 11, 9, 'alat_pertanian/z8X8h9IADktU0EJqSoKznLaSFQz3VqAtjoBBIgEy.png', 'tes', '2025-05-14 08:04:36', '2025-05-14 18:17:07'),
(2, 'A', 'Olah_Lahan', 120000, 'tersedia', 11, 10, 'alat_pertanian/pyqUigGiiskITNXvE8Gqcllj0KjdF7YYAP1Oba4k.png', 'tes', '2025-05-14 17:54:42', '2025-05-14 19:55:42'),
(3, 'Tes1', 'Olah_Lahan', 1200, 'tersedia', 12, 12, 'alat_pertanian/9vBDgztWhANHcJTFk6OPsyBhuThv3ANSIhqe2snQ.png', 'Tes', '2025-05-14 19:52:56', '2025-05-14 19:55:46');

-- --------------------------------------------------------

--
-- Table structure for table `data_pengurus_desas`
--

CREATE TABLE `data_pengurus_desas` (
  `id_data_pengurus_desa` bigint(20) UNSIGNED NOT NULL,
  `nama_data_pengurus_desa` varchar(255) NOT NULL,
  `jabatan_data_pengurus_desa` varchar(255) NOT NULL,
  `deskripsi_data_pengurus_desa` varchar(255) NOT NULL,
  `gambar_data_pengurus_desa` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
-- Table structure for table `fasilitas`
--

CREATE TABLE `fasilitas` (
  `id_fasilitas` bigint(20) UNSIGNED NOT NULL,
  `nama_fasilitas` varchar(255) NOT NULL,
  `deskripsi_fasilitas` text NOT NULL,
  `lokasi_fasilitas` varchar(255) NOT NULL,
  `gambar_fasilitas` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fasilitas`
--

INSERT INTO `fasilitas` (`id_fasilitas`, `nama_fasilitas`, `deskripsi_fasilitas`, `lokasi_fasilitas`, `gambar_fasilitas`, `created_at`, `updated_at`) VALUES
(1, 'F1', 'F1', 'F1', 'fasilitas/5j7izw1bkBSOY4ACDD88dCBrrhRJXwlzUBN3WjuO.png', '2025-05-14 19:09:30', '2025-05-14 19:09:30'),
(2, 'Tes', 'Tes', 'Tes', 'fasilitas/NhJ5wP3V7mnGUIhIB9OgWCNJdBBhj4Bglil8jjhx.png', '2025-05-14 19:44:58', '2025-05-14 19:44:58');

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE `galleries` (
  `id_galeri` bigint(20) UNSIGNED NOT NULL,
  `judul_galeri` varchar(255) NOT NULL,
  `gambar_galeri` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `informasi`
--

CREATE TABLE `informasi` (
  `id_informasi` bigint(20) UNSIGNED NOT NULL,
  `judul_informasi` varchar(255) NOT NULL,
  `deskripsi_informasi` text DEFAULT NULL,
  `kategori_informasi` enum('berita','pengumuman') NOT NULL,
  `lampiran_informasi` varchar(255) NOT NULL,
  `status_informasi` enum('draft','publish') NOT NULL DEFAULT 'draft',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `name`, `email`, `message`, `created_at`, `updated_at`) VALUES
(1, 'Tes', 'tes@gmail.com', 'Tes', '2025-05-14 19:58:14', '2025-05-14 19:58:14'),
(2, 'Tes1', 'tes1@gmail.com', 'Tes1', '2025-05-14 19:59:45', '2025-05-14 19:59:45');

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
(18, '2025_05_13_084127_create_about_us_table', 3),
(22, '2014_10_12_000000_create_users_table', 4),
(23, '2014_10_12_100000_create_password_reset_tokens_table', 4),
(24, '2019_08_19_000000_create_failed_jobs_table', 4),
(25, '2019_12_14_000001_create_personal_access_tokens_table', 4),
(26, '2025_04_01_095225_create_fasilitas_table', 4),
(27, '2025_04_06_124401_create_informasi_table', 4),
(28, '2025_04_07_005902_rename_gambar_informasi_to_lampiran_in_informasi_table', 4),
(29, '2025_04_09_013753_rename_lampiran_to_lampiran_informasi_in_informasi_table', 4),
(30, '2025_04_14_065152_create_galleries_table', 4),
(31, '2025_04_21_065657_create_data_pengurus_desas_table', 4),
(32, '2025_04_29_011249_create_alat_pertanian_table', 4),
(33, '2025_04_29_131906_add_photo_to_users_table', 4),
(34, '2025_04_30_021748_create_peminjaman_table', 4),
(35, '2025_04_30_135755_create_messages_table', 4),
(36, '2025_05_09_035156_rename_peminjaman_to_nama_peminjam_in_peminjaman_table', 4),
(37, '2025_05_10_032744_add_jumlah_pinjam_to_peminjaman_table', 4),
(38, '2025_05_13_092057_alter_default_alat_pertanian', 4),
(39, '2025_05_13_124237_create_abouts_table', 4),
(40, '2025_05_13_161856_create_permission_tables', 4),
(41, '2025_05_14_071042_update_status_peminjaman_enum', 4),
(43, '2025_05_14_151249_add_user_id_to_peminjaman_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `alat_pertanian_id` bigint(20) UNSIGNED NOT NULL,
  `nama_peminjam` varchar(255) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `jumlah_alat_di_sewa` int(11) NOT NULL DEFAULT 1,
  `tanggal_kembali` date NOT NULL,
  `status_peminjaman` enum('menunggu','disetujui','ditolak','dibatalkan') DEFAULT 'menunggu',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id`, `alat_pertanian_id`, `nama_peminjam`, `tanggal_pinjam`, `jumlah_alat_di_sewa`, `tanggal_kembali`, `status_peminjaman`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 1, 'Tes', '2025-05-16', 1, '2025-05-17', 'disetujui', '2025-05-14 18:17:07', '2025-05-14 18:17:16', 2),
(2, 2, 'TesNew1', '2025-05-16', 1, '2025-05-17', 'menunggu', '2025-05-14 18:19:56', '2025-05-14 18:19:56', 3),
(3, 2, 'Tes', '2025-05-16', 2, '2025-05-17', 'dibatalkan', '2025-05-14 18:51:11', '2025-05-14 19:55:42', 3),
(4, 3, 'Chrisman', '2025-05-16', 1, '2025-05-17', 'dibatalkan', '2025-05-14 19:54:44', '2025-05-14 19:55:46', 3);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `usertype` enum('user','bumdes','sekretaris') NOT NULL DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `address`, `password`, `usertype`, `created_at`, `updated_at`, `photo`) VALUES
(1, 'user', 'user@gmail.com', '081234567890', 'Taonmarisi', '$2y$10$s5LZfHwCCx1xWzHnj2Etau1a4axaE9e8vUhVtFfK69CdWCkffi1i2', 'user', '2025-05-14 07:59:39', '2025-05-14 07:59:39', NULL),
(2, 'bumdes', 'bumdes@gmail.com', '081234567890', 'Taonmarisi', '$2y$10$D4DK/hvLgpqOMp2bZ8Gn/uhb1me5YLW9Y9iLzWkvol36PwMYY7xkm', 'bumdes', '2025-05-14 08:03:22', '2025-05-14 08:03:22', NULL),
(3, 'sekretaris', 'sekretaris@gmail.com', '081234567890', 'Taonmarisi', '$2y$10$KrUdfnXM95Gj7zBOi3lfmu80bHRb6Nq.qT5cRxKpY3CSfOn2268w.', 'sekretaris', '2025-05-14 08:03:47', '2025-05-14 08:03:47', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abouts`
--
ALTER TABLE `abouts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `about_uses`
--
ALTER TABLE `about_uses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `alat_pertanian`
--
ALTER TABLE `alat_pertanian`
  ADD PRIMARY KEY (`id_alat_pertanian`);

--
-- Indexes for table `data_pengurus_desas`
--
ALTER TABLE `data_pengurus_desas`
  ADD PRIMARY KEY (`id_data_pengurus_desa`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `fasilitas`
--
ALTER TABLE `fasilitas`
  ADD PRIMARY KEY (`id_fasilitas`);

--
-- Indexes for table `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id_galeri`);

--
-- Indexes for table `informasi`
--
ALTER TABLE `informasi`
  ADD PRIMARY KEY (`id_informasi`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id`),
  ADD KEY `peminjaman_alat_pertanian_id_foreign` (`alat_pertanian_id`),
  ADD KEY `peminjaman_user_id_foreign` (`user_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

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
-- AUTO_INCREMENT for table `abouts`
--
ALTER TABLE `abouts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `about_uses`
--
ALTER TABLE `about_uses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `alat_pertanian`
--
ALTER TABLE `alat_pertanian`
  MODIFY `id_alat_pertanian` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `data_pengurus_desas`
--
ALTER TABLE `data_pengurus_desas`
  MODIFY `id_data_pengurus_desa` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fasilitas`
--
ALTER TABLE `fasilitas`
  MODIFY `id_fasilitas` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id_galeri` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `informasi`
--
ALTER TABLE `informasi`
  MODIFY `id_informasi` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_alat_pertanian_id_foreign` FOREIGN KEY (`alat_pertanian_id`) REFERENCES `alat_pertanian` (`id_alat_pertanian`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `peminjaman_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
