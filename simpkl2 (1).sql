-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2026 at 07:17 AM
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
-- Database: `simpkl2`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `siswa_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `jam_masuk` time DEFAULT NULL,
  `jam_pulang` time DEFAULT NULL,
  `status` enum('Hadir','Izin','Sakit','Alpa') NOT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`id`, `siswa_id`, `tanggal`, `jam_masuk`, `jam_pulang`, `status`, `keterangan`) VALUES
(1, 5, '2026-04-06', '07:30:00', '16:00:00', 'Hadir', NULL),
(2, 6, '2026-04-06', '07:30:00', '16:00:00', 'Hadir', NULL),
(3, 5, '2026-04-07', '07:30:00', '16:00:00', 'Hadir', NULL),
(4, 6, '2026-04-07', '07:30:00', '16:00:00', 'Hadir', NULL),
(5, 5, '2026-04-08', '07:30:00', '16:00:00', 'Hadir', NULL),
(6, 6, '2026-04-08', '07:30:00', '16:00:00', 'Hadir', NULL),
(7, 5, '2026-04-09', '07:30:00', '16:00:00', 'Hadir', NULL),
(8, 6, '2026-04-09', '07:30:00', '16:00:00', 'Hadir', NULL),
(9, 5, '2026-04-10', NULL, NULL, 'Alpa', 'Keterangan alpa'),
(10, 6, '2026-04-10', '07:30:00', '16:00:00', 'Hadir', NULL),
(11, 5, '2026-04-13', '07:30:00', '16:00:00', 'Hadir', NULL),
(12, 6, '2026-04-13', NULL, NULL, 'Izin', 'Keterangan izin'),
(13, 5, '2026-04-14', NULL, NULL, 'Izin', 'Keterangan izin'),
(14, 6, '2026-04-14', NULL, NULL, 'Alpa', 'Keterangan alpa'),
(15, 5, '2026-04-15', NULL, NULL, 'Alpa', 'Keterangan alpa'),
(16, 6, '2026-04-15', NULL, NULL, 'Sakit', 'Keterangan sakit'),
(17, 5, '2026-04-16', NULL, NULL, 'Alpa', 'Keterangan alpa'),
(18, 6, '2026-04-16', NULL, NULL, 'Alpa', 'Keterangan alpa'),
(19, 5, '2026-04-17', '07:30:00', '16:00:00', 'Hadir', NULL),
(20, 6, '2026-04-17', NULL, NULL, 'Sakit', 'Keterangan sakit'),
(21, 5, '2026-04-20', '07:30:00', '16:00:00', 'Hadir', NULL),
(22, 6, '2026-04-20', '07:30:00', '16:00:00', 'Hadir', NULL),
(23, 5, '2026-04-21', NULL, NULL, 'Sakit', 'Keterangan sakit'),
(24, 6, '2026-04-21', NULL, NULL, 'Alpa', 'Keterangan alpa'),
(25, 5, '2026-04-22', NULL, NULL, 'Sakit', 'Keterangan sakit'),
(26, 6, '2026-04-22', '07:30:00', '16:00:00', 'Hadir', NULL),
(27, 5, '2026-04-23', '07:30:00', '16:00:00', 'Hadir', NULL),
(28, 6, '2026-04-23', '07:30:00', '16:00:00', 'Hadir', NULL),
(29, 5, '2026-04-24', '07:30:00', '16:00:00', 'Hadir', NULL),
(30, 6, '2026-04-24', '07:30:00', '16:00:00', 'Hadir', NULL),
(31, 5, '2026-04-27', '07:30:00', '16:00:00', 'Hadir', NULL),
(32, 6, '2026-04-27', NULL, NULL, 'Alpa', 'Keterangan alpa'),
(33, 5, '2026-04-28', '07:30:00', '16:00:00', 'Hadir', NULL),
(34, 6, '2026-04-28', '07:30:00', '16:00:00', 'Hadir', NULL),
(35, 5, '2026-04-29', '07:30:00', '16:00:00', 'Hadir', NULL),
(36, 6, '2026-04-29', '07:30:00', '16:00:00', 'Hadir', NULL),
(37, 5, '2026-04-30', '07:30:00', '16:00:00', 'Hadir', NULL),
(38, 6, '2026-04-30', '07:30:00', '16:00:00', 'Hadir', NULL),
(39, 5, '2026-05-01', '07:30:00', '16:00:00', 'Hadir', NULL),
(40, 6, '2026-05-01', '07:30:00', '16:00:00', 'Hadir', NULL),
(41, 5, '2026-05-04', '07:30:00', '16:00:00', 'Hadir', NULL),
(42, 6, '2026-05-04', '07:30:00', '16:00:00', 'Hadir', NULL),
(43, 5, '2026-05-05', '07:30:00', '16:00:00', 'Hadir', NULL),
(44, 6, '2026-05-05', '07:30:00', '16:00:00', 'Hadir', NULL),
(45, 5, '2026-05-06', '07:30:00', '16:00:00', 'Hadir', NULL),
(46, 6, '2026-05-06', '07:30:00', '16:00:00', 'Hadir', NULL),
(47, 5, '2026-05-07', '07:30:00', '16:00:00', 'Hadir', NULL),
(48, 6, '2026-05-07', '07:30:00', '16:00:00', 'Hadir', NULL),
(49, 5, '2026-05-08', '07:30:00', '16:00:00', 'Hadir', NULL),
(50, 6, '2026-05-08', '07:30:00', '16:00:00', 'Hadir', NULL),
(51, 5, '2026-05-11', NULL, NULL, 'Sakit', 'Keterangan sakit'),
(52, 6, '2026-05-11', '07:30:00', '16:00:00', 'Hadir', NULL),
(53, 5, '2026-05-12', '07:30:00', '16:00:00', 'Hadir', NULL),
(54, 6, '2026-05-12', '07:30:00', '16:00:00', 'Hadir', NULL),
(55, 5, '2026-05-13', '07:30:00', '16:00:00', 'Hadir', NULL),
(56, 6, '2026-05-13', NULL, NULL, 'Alpa', 'Keterangan alpa'),
(57, 5, '2026-05-14', '07:30:00', '16:00:00', 'Hadir', NULL),
(58, 6, '2026-05-14', '07:30:00', '16:00:00', 'Hadir', NULL),
(59, 5, '2026-05-15', '07:30:00', '16:00:00', 'Hadir', NULL),
(60, 6, '2026-05-15', '07:30:00', '16:00:00', 'Hadir', NULL),
(61, 5, '2026-05-18', '07:30:00', '16:00:00', 'Hadir', NULL),
(62, 6, '2026-05-18', '07:30:00', '16:00:00', 'Hadir', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jurnal_harian`
--

CREATE TABLE `jurnal_harian` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `siswa_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `jam_masuk` time DEFAULT NULL,
  `jam_keluar` time DEFAULT NULL,
  `kegiatan` text NOT NULL,
  `foto_kegiatan` varchar(255) DEFAULT NULL,
  `status_validasi` enum('pending','valid','tolak') NOT NULL DEFAULT 'pending',
  `komentar_pembimbing` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jurnal_harian`
--

INSERT INTO `jurnal_harian` (`id`, `siswa_id`, `tanggal`, `jam_masuk`, `jam_keluar`, `kegiatan`, `foto_kegiatan`, `status_validasi`, `komentar_pembimbing`) VALUES
(1, 5, '2026-04-20', '07:30:00', '16:00:00', 'Membuat desain UI untuk halaman dashboard menggunakan Figma.', NULL, 'valid', 'Baik, pertahankan semangat belajarnya!'),
(2, 6, '2026-04-20', '07:30:00', '16:00:00', 'Membuat dokumentasi teknis untuk fitur yang sudah selesai dibangun.', NULL, 'valid', 'Baik, pertahankan semangat belajarnya!'),
(3, 5, '2026-04-21', '07:30:00', '16:00:00', 'Mengimplementasikan API endpoint untuk fitur autentikasi pengguna.', NULL, 'valid', 'Baik, pertahankan semangat belajarnya!'),
(4, 6, '2026-04-21', '07:30:00', '16:00:00', 'Mengimplementasikan API endpoint untuk fitur autentikasi pengguna.', NULL, 'valid', 'Baik, pertahankan semangat belajarnya!'),
(5, 5, '2026-04-22', '07:30:00', '16:00:00', 'Presentasi progress pekerjaan kepada pembimbing lapangan.', NULL, 'pending', 'Baik, pertahankan semangat belajarnya!'),
(6, 6, '2026-04-22', '07:30:00', '16:00:00', 'Melakukan optimasi query database dan memperbaiki performa aplikasi.', NULL, 'valid', 'Baik, pertahankan semangat belajarnya!'),
(7, 5, '2026-04-23', '07:30:00', '16:00:00', 'Membuat desain UI untuk halaman dashboard menggunakan Figma.', NULL, 'valid', 'Baik, pertahankan semangat belajarnya!'),
(8, 6, '2026-04-23', '07:30:00', '16:00:00', 'Mengerjakan fitur CRUD data siswa sesuai spesifikasi yang diberikan.', NULL, 'valid', 'Baik, pertahankan semangat belajarnya!'),
(9, 5, '2026-04-24', '07:30:00', '16:00:00', 'Melakukan testing dan debugging pada modul laporan mingguan.', NULL, 'pending', 'Baik, pertahankan semangat belajarnya!'),
(10, 6, '2026-04-24', '07:30:00', '16:00:00', 'Membuat desain UI untuk halaman dashboard menggunakan Figma.', NULL, 'valid', 'Baik, pertahankan semangat belajarnya!'),
(11, 5, '2026-04-27', '07:30:00', '16:00:00', 'Membuat desain UI untuk halaman dashboard menggunakan Figma.', NULL, 'tolak', 'Baik, pertahankan semangat belajarnya!'),
(12, 6, '2026-04-27', '07:30:00', '16:00:00', 'Melakukan testing dan debugging pada modul laporan mingguan.', NULL, 'tolak', 'Baik, pertahankan semangat belajarnya!'),
(13, 5, '2026-04-28', '07:30:00', '16:00:00', 'Presentasi progress pekerjaan kepada pembimbing lapangan.', NULL, 'valid', 'Baik, pertahankan semangat belajarnya!'),
(14, 6, '2026-04-28', '07:30:00', '16:00:00', 'Membuat dokumentasi teknis untuk fitur yang sudah selesai dibangun.', NULL, 'valid', 'Baik, pertahankan semangat belajarnya!'),
(15, 5, '2026-04-29', '07:30:00', '16:00:00', 'Membuat desain UI untuk halaman dashboard menggunakan Figma.', NULL, 'pending', 'Baik, pertahankan semangat belajarnya!'),
(16, 6, '2026-04-29', '07:30:00', '16:00:00', 'Presentasi progress pekerjaan kepada pembimbing lapangan.', NULL, 'valid', 'Baik, pertahankan semangat belajarnya!'),
(17, 5, '2026-04-30', '07:30:00', '16:00:00', 'Mengerjakan fitur CRUD data siswa sesuai spesifikasi yang diberikan.', NULL, 'tolak', 'Baik, pertahankan semangat belajarnya!'),
(18, 6, '2026-04-30', '07:30:00', '16:00:00', 'Presentasi progress pekerjaan kepada pembimbing lapangan.', NULL, 'valid', 'Baik, pertahankan semangat belajarnya!'),
(19, 5, '2026-05-01', '07:30:00', '16:00:00', 'Presentasi progress pekerjaan kepada pembimbing lapangan.', NULL, 'valid', 'Baik, pertahankan semangat belajarnya!'),
(20, 6, '2026-05-01', '07:30:00', '16:00:00', 'Mengimplementasikan API endpoint untuk fitur autentikasi pengguna.', NULL, 'tolak', 'Baik, pertahankan semangat belajarnya!'),
(21, 5, '2026-05-04', '07:30:00', '16:00:00', 'Presentasi progress pekerjaan kepada pembimbing lapangan.', NULL, 'tolak', 'Baik, pertahankan semangat belajarnya!'),
(22, 6, '2026-05-04', '07:30:00', '16:00:00', 'Mengerjakan fitur CRUD data siswa sesuai spesifikasi yang diberikan.', NULL, 'valid', 'Baik, pertahankan semangat belajarnya!'),
(23, 5, '2026-05-05', '07:30:00', '16:00:00', 'Mengikuti daily standup meeting dan code review bersama tim senior.', NULL, 'valid', 'Baik, pertahankan semangat belajarnya!'),
(24, 6, '2026-05-05', '07:30:00', '16:00:00', 'Membuat desain UI untuk halaman dashboard menggunakan Figma.', NULL, 'valid', 'Baik, pertahankan semangat belajarnya!'),
(25, 5, '2026-05-06', '07:30:00', '16:00:00', 'Mengerjakan fitur CRUD data siswa sesuai spesifikasi yang diberikan.', NULL, 'valid', 'Baik, pertahankan semangat belajarnya!'),
(26, 6, '2026-05-06', '07:30:00', '16:00:00', 'Mempelajari struktur database dan relasi antar tabel yang digunakan sistem.', NULL, 'valid', 'Baik, pertahankan semangat belajarnya!'),
(27, 5, '2026-05-07', '07:30:00', '16:00:00', 'Mengikuti daily standup meeting dan code review bersama tim senior.', NULL, 'valid', 'Baik, pertahankan semangat belajarnya!'),
(28, 6, '2026-05-07', '07:30:00', '16:00:00', 'Belajar dan praktek penggunaan Git untuk version control.', NULL, 'pending', 'Baik, pertahankan semangat belajarnya!'),
(29, 5, '2026-05-08', '07:30:00', '16:00:00', 'Presentasi progress pekerjaan kepada pembimbing lapangan.', NULL, 'valid', 'Baik, pertahankan semangat belajarnya!'),
(30, 6, '2026-05-08', '07:30:00', '16:00:00', 'Melakukan optimasi query database dan memperbaiki performa aplikasi.', NULL, 'tolak', 'Baik, pertahankan semangat belajarnya!'),
(31, 5, '2026-05-11', '07:30:00', '16:00:00', 'Membuat dokumentasi teknis untuk fitur yang sudah selesai dibangun.', NULL, 'valid', 'Baik, pertahankan semangat belajarnya!'),
(32, 6, '2026-05-11', '07:30:00', '16:00:00', 'Mengikuti daily standup meeting dan code review bersama tim senior.', NULL, 'valid', 'Baik, pertahankan semangat belajarnya!'),
(33, 5, '2026-05-12', '07:30:00', '16:00:00', 'Presentasi progress pekerjaan kepada pembimbing lapangan.', NULL, 'pending', 'Baik, pertahankan semangat belajarnya!'),
(34, 6, '2026-05-12', '07:30:00', '16:00:00', 'Belajar dan praktek penggunaan Git untuk version control.', NULL, 'valid', 'Baik, pertahankan semangat belajarnya!'),
(35, 5, '2026-05-13', '07:30:00', '16:00:00', 'Membuat desain UI untuk halaman dashboard menggunakan Figma.', NULL, 'valid', 'Baik, pertahankan semangat belajarnya!'),
(36, 6, '2026-05-13', '07:30:00', '16:00:00', 'Mengerjakan fitur CRUD data siswa sesuai spesifikasi yang diberikan.', NULL, 'valid', 'Baik, pertahankan semangat belajarnya!'),
(37, 5, '2026-05-14', '07:30:00', '16:00:00', 'Mengerjakan fitur CRUD data siswa sesuai spesifikasi yang diberikan.', NULL, 'tolak', 'Baik, pertahankan semangat belajarnya!'),
(38, 6, '2026-05-14', '07:30:00', '16:00:00', 'Mengerjakan fitur CRUD data siswa sesuai spesifikasi yang diberikan.', NULL, 'valid', 'Baik, pertahankan semangat belajarnya!'),
(39, 5, '2026-05-15', '07:30:00', '16:00:00', 'Mempelajari struktur database dan relasi antar tabel yang digunakan sistem.', NULL, 'valid', 'Baik, pertahankan semangat belajarnya!'),
(40, 6, '2026-05-15', '07:30:00', '16:00:00', 'Mengimplementasikan API endpoint untuk fitur autentikasi pengguna.', NULL, 'tolak', 'Baik, pertahankan semangat belajarnya!'),
(41, 5, '2026-05-18', '07:30:00', '16:00:00', 'Mengerjakan fitur CRUD data siswa sesuai spesifikasi yang diberikan.', NULL, 'valid', NULL),
(42, 6, '2026-05-18', '07:30:00', '16:00:00', 'Mengimplementasikan API endpoint untuk fitur autentikasi pengguna.', NULL, 'valid', NULL),
(43, 7, '2026-05-18', '00:50:00', '10:52:00', 'sdadWEdxzW4zfetwf', NULL, 'valid', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `laporan_pkl`
--

CREATE TABLE `laporan_pkl` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `siswa_id` bigint(20) UNSIGNED NOT NULL,
  `judul_laporan` varchar(200) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `jenis_laporan` enum('mingguan','akhir') NOT NULL,
  `status_pembimbing` enum('pending','revisi','disetujui') NOT NULL DEFAULT 'pending',
  `status_wakasek` enum('pending','disetujui') NOT NULL DEFAULT 'pending',
  `catatan_revisi` text DEFAULT NULL,
  `tampil_di_publik` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `laporan_pkl`
--

INSERT INTO `laporan_pkl` (`id`, `siswa_id`, `judul_laporan`, `file_path`, `jenis_laporan`, `status_pembimbing`, `status_wakasek`, `catatan_revisi`, `tampil_di_publik`, `created_at`) VALUES
(1, 5, 'Laporan Mingguan Ke-1', NULL, 'mingguan', 'disetujui', 'disetujui', NULL, 1, '2026-04-12 20:31:17'),
(2, 5, 'Laporan Mingguan Ke-2', NULL, 'mingguan', 'disetujui', 'disetujui', NULL, 1, '2026-04-19 20:31:17'),
(3, 5, 'Laporan Mingguan Ke-3', NULL, 'mingguan', 'disetujui', 'disetujui', NULL, 1, '2026-04-26 20:31:17'),
(4, 5, 'Laporan Mingguan Ke-4', NULL, 'mingguan', 'disetujui', 'disetujui', NULL, 1, '2026-05-03 20:31:17'),
(5, 5, 'Laporan Mingguan Ke-5', NULL, 'mingguan', 'disetujui', 'pending', NULL, 0, '2026-05-10 20:31:17'),
(6, 5, 'Laporan Mingguan Ke-6', NULL, 'mingguan', 'pending', 'pending', NULL, 0, '2026-05-17 20:31:17'),
(7, 5, 'Laporan Akhir PKL', NULL, 'akhir', 'pending', 'pending', NULL, 0, '2026-05-17 20:31:17'),
(8, 6, 'Laporan Mingguan Ke-1', NULL, 'mingguan', 'disetujui', 'disetujui', NULL, 1, '2026-04-12 20:31:17'),
(9, 6, 'Laporan Mingguan Ke-2', NULL, 'mingguan', 'disetujui', 'disetujui', NULL, 1, '2026-04-19 20:31:17'),
(10, 6, 'Laporan Mingguan Ke-3', NULL, 'mingguan', 'disetujui', 'disetujui', NULL, 1, '2026-04-26 20:31:17'),
(11, 6, 'Laporan Mingguan Ke-4', NULL, 'mingguan', 'disetujui', 'disetujui', NULL, 1, '2026-05-03 20:31:17'),
(12, 6, 'Laporan Mingguan Ke-5', NULL, 'mingguan', 'disetujui', 'pending', NULL, 0, '2026-05-10 20:31:17'),
(13, 6, 'Laporan Mingguan Ke-6', NULL, 'mingguan', 'pending', 'pending', NULL, 0, '2026-05-17 20:31:17'),
(14, 6, 'Laporan Akhir PKL', NULL, 'akhir', 'pending', 'pending', NULL, 0, '2026-05-17 20:31:17');

-- --------------------------------------------------------

--
-- Table structure for table `log_aktivitas`
--

CREATE TABLE `log_aktivitas` (
  `id_log` bigint(20) UNSIGNED NOT NULL,
  `id_users` bigint(20) UNSIGNED DEFAULT NULL,
  `aktivitas` text NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `log_aktivitas`
--

INSERT INTO `log_aktivitas` (`id_log`, `id_users`, `aktivitas`, `waktu`) VALUES
(1, 5, 'Login ke sistem sebagai siswa', '2026-05-16 20:31:17'),
(2, 5, 'Menambahkan jurnal harian tanggal hari ini', '2026-05-17 18:31:17'),
(3, 5, 'Memperbarui data profil', '2026-05-17 15:31:17'),
(4, 5, 'Mengunggah laporan PKL: Laporan Mingguan Ke-6', '2026-05-16 20:31:17'),
(5, 6, 'Login ke sistem sebagai siswa', '2026-05-17 17:31:17'),
(6, 6, 'Menambahkan jurnal harian tanggal hari ini', '2026-05-17 17:31:17'),
(7, 3, 'Login ke sistem sebagai pembimbing', '2026-05-17 19:31:17'),
(8, 1, 'Login ke sistem sebagai admin', '2026-05-17 20:32:26'),
(9, 1, 'Logout dari sistem', '2026-05-17 20:37:20'),
(10, 2, 'Login ke sistem sebagai wakasek', '2026-05-17 20:37:47'),
(11, 2, 'Logout dari sistem', '2026-05-17 20:42:33'),
(12, 9, 'Registrasi akun baru sebagai siswa', '2026-05-17 20:44:43'),
(13, 9, 'Mengajukan PKL ke PT.sepatu bahagia permai', '2026-05-17 20:46:22'),
(14, 9, 'Logout dari sistem', '2026-05-17 20:46:33'),
(15, 2, 'Login ke sistem sebagai wakasek', '2026-05-17 20:47:08'),
(16, 2, 'Logout dari sistem', '2026-05-17 20:48:08'),
(17, 7, 'Login ke sistem sebagai siswa', '2026-05-17 20:48:29'),
(18, 7, 'Menambahkan jurnal harian tanggal 18/05/2026', '2026-05-17 20:49:08'),
(19, 7, 'Logout dari sistem', '2026-05-17 20:49:18'),
(20, 2, 'Login ke sistem sebagai wakasek', '2026-05-17 20:49:37'),
(21, 2, 'Logout dari sistem', '2026-05-17 20:50:18'),
(22, 3, 'Login ke sistem sebagai pembimbing', '2026-05-17 20:51:35'),
(23, 3, 'Logout dari sistem', '2026-05-17 20:52:56'),
(24, 4, 'Login ke sistem sebagai pembimbing', '2026-05-17 20:53:20'),
(25, 4, 'Logout dari sistem', '2026-05-17 20:54:19'),
(26, 1, 'Login ke sistem sebagai admin', '2026-05-17 20:54:32'),
(27, 1, 'Logout dari sistem', '2026-05-17 20:57:50'),
(28, 2, 'Login ke sistem sebagai wakasek', '2026-05-17 21:03:58');

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
(1, '2024_01_01_000001_create_users_table', 1),
(2, '2024_01_01_000002_create_profil_siswa_table', 1),
(3, '2024_01_01_000003_create_profil_guru_table', 1),
(4, '2024_01_01_000004_create_mitra_industri_table', 1),
(5, '2024_01_01_000005_create_pkl_pengajuan_table', 1),
(6, '2024_01_01_000006_create_pkl_anggota_table', 1),
(7, '2024_01_01_000007_create_absensi_table', 1),
(8, '2024_01_01_000008_create_jurnal_harian_table', 1),
(9, '2024_01_01_000009_create_laporan_pkl_table', 1),
(10, '2024_01_01_000010_create_nilai_pkl_table', 1),
(11, '2024_01_01_000011_create_log_aktivitas_table', 1),
(12, '2024_01_01_000012_create_walikelas_table', 1),
(13, '2026_05_07_020022_create_sessions_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `mitra_industri`
--

CREATE TABLE `mitra_industri` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_perusahaan` varchar(100) NOT NULL,
  `alamat_perusahaan` text DEFAULT NULL,
  `website` varchar(100) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mitra_industri`
--

INSERT INTO `mitra_industri` (`id`, `nama_perusahaan`, `alamat_perusahaan`, `website`, `logo`, `created_at`) VALUES
(1, 'PT Teknologi Nusantara', 'Jl. Asia Afrika No. 12, Bandung', 'https://teknologi-nusantara.co.id', NULL, '2026-05-17 20:31:08'),
(2, 'CV Kreasi Digital', 'Jl. Dago No. 88, Bandung', 'https://kreasidigital.id', NULL, '2026-05-17 20:31:09'),
(3, 'PT Solusi Inovasi', 'Jl. Braga No. 45, Bandung', 'https://solusiinovasi.com', NULL, '2026-05-17 20:31:09');

-- --------------------------------------------------------

--
-- Table structure for table `nilai_pkl`
--

CREATE TABLE `nilai_pkl` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `siswa_id` bigint(20) UNSIGNED NOT NULL,
  `pembimbing_id` bigint(20) UNSIGNED NOT NULL,
  `nilai_sikap` int(11) NOT NULL DEFAULT 0,
  `nilai_keterampilan` int(11) NOT NULL DEFAULT 0,
  `nilai_laporan` int(11) NOT NULL DEFAULT 0,
  `nilai_akhir` decimal(5,2) DEFAULT NULL,
  `predikat` char(2) DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nilai_pkl`
--

INSERT INTO `nilai_pkl` (`id`, `siswa_id`, `pembimbing_id`, `nilai_sikap`, `nilai_keterampilan`, `nilai_laporan`, `nilai_akhir`, `predikat`, `catatan`, `created_at`) VALUES
(1, 5, 3, 88, 92, 85, 88.33, 'B', 'Ahmad menunjukkan perkembangan yang sangat baik. Disiplin, kreatif, dan mampu bekerja dalam tim.', '2026-05-15 20:31:17'),
(2, 6, 3, 90, 87, 93, 90.00, 'A', 'Siti sangat teliti dan laporan yang dibuat sangat berkualitas. Pertahankan!', '2026-05-15 20:31:17');

-- --------------------------------------------------------

--
-- Table structure for table `pkl_anggota`
--

CREATE TABLE `pkl_anggota` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pengajuan_id` bigint(20) UNSIGNED NOT NULL,
  `siswa_id` bigint(20) UNSIGNED NOT NULL,
  `status_keanggotaan` enum('aktif','nonaktif') NOT NULL DEFAULT 'aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pkl_anggota`
--

INSERT INTO `pkl_anggota` (`id`, `pengajuan_id`, `siswa_id`, `status_keanggotaan`) VALUES
(1, 1, 5, 'aktif'),
(2, 1, 6, 'aktif'),
(3, 2, 7, 'aktif'),
(4, 2, 8, 'aktif'),
(5, 3, 9, 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `pkl_pengajuan`
--

CREATE TABLE `pkl_pengajuan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ketua_id` bigint(20) UNSIGNED NOT NULL,
  `nama_perusahaan` varchar(100) NOT NULL,
  `alamat_perusahaan` text NOT NULL,
  `website` varchar(255) DEFAULT NULL,
  `file_dokumen` varchar(255) DEFAULT NULL,
  `status_pembimbing` enum('pending','disetujui','ditolak') NOT NULL DEFAULT 'pending',
  `status_wakasek` enum('pending','disetujui','ditolak') NOT NULL DEFAULT 'pending',
  `pembimbing_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tanggal_pengajuan` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pkl_pengajuan`
--

INSERT INTO `pkl_pengajuan` (`id`, `ketua_id`, `nama_perusahaan`, `alamat_perusahaan`, `website`, `file_dokumen`, `status_pembimbing`, `status_wakasek`, `pembimbing_id`, `tanggal_pengajuan`) VALUES
(1, 5, 'PT Teknologi Nusantara', 'Jl. Asia Afrika No. 12, Bandung', 'https://teknologi-nusantara.co.id', NULL, 'disetujui', 'disetujui', 3, '2026-04-03 03:31:10'),
(2, 7, 'CV Kreasi Digital', 'Jl. Dago No. 88, Bandung', 'https://kreasidigital.id', NULL, 'disetujui', 'pending', 4, '2026-05-13 03:31:13'),
(3, 9, 'PT.sepatu bahagia permai', 'jl. jendral prabroro', NULL, NULL, 'pending', 'pending', NULL, '2026-05-18 10:46:22');

-- --------------------------------------------------------

--
-- Table structure for table `profil_guru`
--

CREATE TABLE `profil_guru` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `nip` varchar(30) DEFAULT NULL,
  `jabatan` varchar(100) DEFAULT NULL,
  `jabatan_terakhir` varchar(100) DEFAULT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `foto_profil` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profil_guru`
--

INSERT INTO `profil_guru` (`id`, `user_id`, `nip`, `jabatan`, `jabatan_terakhir`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `no_hp`, `foto_profil`) VALUES
(1, 3, '198501012010011001', 'Guru Produktif', 'Koordinator PKL', 'Bandung', '1985-01-01', 'Jl. Merdeka No. 10, Bandung', '081234567890', NULL),
(2, 4, '199003152012012002', 'Guru Pembimbing', 'Wali Kelas XII', 'Jakarta', '1990-03-15', 'Jl. Sudirman No. 5, Jakarta', '082345678901', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `profil_siswa`
--

CREATE TABLE `profil_siswa` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `nis` varchar(20) DEFAULT NULL,
  `kelas` varchar(20) DEFAULT NULL,
  `jurusan` varchar(50) DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `foto_profil` varchar(255) DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `agama` varchar(50) DEFAULT NULL,
  `tempat_lahir` varchar(100) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `golongan_darah` enum('A','B','AB','O') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profil_siswa`
--

INSERT INTO `profil_siswa` (`id`, `user_id`, `nis`, `kelas`, `jurusan`, `no_hp`, `foto_profil`, `jenis_kelamin`, `agama`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `golongan_darah`) VALUES
(1, 5, '0012345678', 'XII', 'RPL', '081122334455', NULL, 'Laki-laki', 'Islam', 'Bandung', '2006-03-12', 'Jl. Anggrek No. 7, Bandung', 'A'),
(2, 6, '0012345679', 'XII', 'RPL', '082233445566', NULL, 'Perempuan', 'Islam', 'Cimahi', '2006-07-22', 'Jl. Mawar No. 3, Cimahi', 'B'),
(3, 7, '0012345680', 'XII', 'RPL', '083344556677', NULL, 'Laki-laki', 'Islam', 'Sumedang', '2006-11-05', 'Jl. Melati No. 15, Sumedang', 'O'),
(4, 8, '0012345681', 'XII', 'RPL', '084455667788', NULL, 'Perempuan', 'Kristen', 'Garut', '2006-01-30', 'Jl. Dahlia No. 2, Garut', 'AB'),
(5, 9, '0987654321', 'XI', 'RPL', NULL, NULL, NULL, NULL, 'bandung', '2008-06-18', 'kampung cilegok hangseur', NULL);

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

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('iPcPTRSpj8Kwt4Det2FFKrcgCtwqOk8EOP6S1rSx', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.120.0 Chrome/142.0.7444.265 Electron/39.8.8 Safari/537.36', 'eyJfdG9rZW4iOiJxQzF2TVE1R2xyZnRJa2VvSUdOVWpETElEOEdEQmVjYmVtdW1rdU9OIiwiX2ZsYXNoIjp7Im5ldyI6W10sIm9sZCI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL3dha2FzZWtcL3BlbmdhanVhbiIsInJvdXRlIjoid2FrYXNlay5wZW5nYWp1YW4ifSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjJ9', 1779078241);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_depan` varchar(50) NOT NULL,
  `nama_belakang` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('siswa','pembimbing','wakasek','admin') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama_depan`, `nama_belakang`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'Admin', 'SIMPKL', 'admin@simpkl.local', '$2y$12$gqW50rVLF8muTjG83lIBQuM8nJPbMOM5MKTOq/X1d2s9WLt2dHXMi', 'admin', '2026-05-17 20:31:01'),
(2, 'Drs.', 'Hendra Gunawan', 'wakasek@simpkl.local', '$2y$12$6La3cMlnq0oq9HL95Dw55upyHWCk38AS3k.vakC5kNl4Q/rMGcMbW', 'wakasek', '2026-05-17 20:31:02'),
(3, 'Budi', 'Santoso S.Kom', 'budi@simpkl.local', '$2y$12$aUr4I2ChvtnB4diyKtUo9.ZbpFw1mjcJICfGJkjZ69D4aPdvs5JxK', 'pembimbing', '2026-05-17 20:31:03'),
(4, 'Sari', 'Dewi M.Pd', 'sari@simpkl.local', '$2y$12$7EHeGEsBtjZi313/bQfX6.Luh80UDW/oKi7Y8Ryd8PeFxfCfj6Cy.', 'pembimbing', '2026-05-17 20:31:04'),
(5, 'Ahmad', 'Fauzi', 'ahmad@simpkl.local', '$2y$12$OtkSpCqNhGfbpFYxjOG8POEptdTgUG39hQlzqjOe2tZse0YOOzHyW', 'siswa', '2026-05-17 20:31:04'),
(6, 'Siti', 'Nurhaliza', 'siti@simpkl.local', '$2y$12$ZLSKf36nBGDyxIbRzQevQO2Wa0.5j3WlRN94oraWi2vqQOYQQiwdy', 'siswa', '2026-05-17 20:31:06'),
(7, 'Rizky', 'Pratama', 'rizky@simpkl.local', '$2y$12$kPLREtiEF2a1dnRhNQGza.EOIkkxQF5Po7xtE5nWin0cev/D2A0I2', 'siswa', '2026-05-17 20:31:07'),
(8, 'Putri', 'Rahayu', 'putri@simpkl.local', '$2y$12$8Zeb/2WDZw7bdyJTIrkDUuTfy3HZHqghmNLG86ngMuO8TTgQ1MbSS', 'siswa', '2026-05-17 20:31:08'),
(9, 'riko', 'ganteng pisan', 'rikoganteng@simpkl.local', '$2y$12$MgVa9RmplRDABeU7E0QEmeDUzFg8EsYAlQ9oZrGsBEmWRox72BJvi', 'siswa', '2026-05-18 03:44:43');

-- --------------------------------------------------------

--
-- Table structure for table `walikelas`
--

CREATE TABLE `walikelas` (
  `id_walikelas` bigint(20) UNSIGNED NOT NULL,
  `Nama_wakel` varchar(40) NOT NULL,
  `Alamat` varchar(50) NOT NULL,
  `Agama_wakel` varchar(10) NOT NULL,
  `No_kontak` varchar(20) NOT NULL,
  `Mewalikelaskan` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `walikelas`
--

INSERT INTO `walikelas` (`id_walikelas`, `Nama_wakel`, `Alamat`, `Agama_wakel`, `No_kontak`, `Mewalikelaskan`) VALUES
(1, 'Dra. Hj. Fatimah', 'Jl. Cihampelas No. 10, Bandung', 'Islam', '081122334400', 1),
(2, 'Bpk. Yusuf S.Pd', 'Jl. Diponegoro No. 5, Bandung', 'Islam', '082233445500', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `absensi_siswa_id_foreign` (`siswa_id`);

--
-- Indexes for table `jurnal_harian`
--
ALTER TABLE `jurnal_harian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jurnal_harian_siswa_id_foreign` (`siswa_id`);

--
-- Indexes for table `laporan_pkl`
--
ALTER TABLE `laporan_pkl`
  ADD PRIMARY KEY (`id`),
  ADD KEY `laporan_pkl_siswa_id_foreign` (`siswa_id`);

--
-- Indexes for table `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `log_aktivitas_id_users_foreign` (`id_users`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mitra_industri`
--
ALTER TABLE `mitra_industri`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai_pkl`
--
ALTER TABLE `nilai_pkl`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nilai_pkl_siswa_id_foreign` (`siswa_id`),
  ADD KEY `nilai_pkl_pembimbing_id_foreign` (`pembimbing_id`);

--
-- Indexes for table `pkl_anggota`
--
ALTER TABLE `pkl_anggota`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pkl_anggota_pengajuan_id_foreign` (`pengajuan_id`),
  ADD KEY `pkl_anggota_siswa_id_foreign` (`siswa_id`);

--
-- Indexes for table `pkl_pengajuan`
--
ALTER TABLE `pkl_pengajuan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pkl_pengajuan_ketua_id_foreign` (`ketua_id`),
  ADD KEY `pkl_pengajuan_pembimbing_id_foreign` (`pembimbing_id`);

--
-- Indexes for table `profil_guru`
--
ALTER TABLE `profil_guru`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profil_guru_user_id_foreign` (`user_id`);

--
-- Indexes for table `profil_siswa`
--
ALTER TABLE `profil_siswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `profil_siswa_nis_unique` (`nis`),
  ADD KEY `profil_siswa_user_id_foreign` (`user_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `walikelas`
--
ALTER TABLE `walikelas`
  ADD PRIMARY KEY (`id_walikelas`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `jurnal_harian`
--
ALTER TABLE `jurnal_harian`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `laporan_pkl`
--
ALTER TABLE `laporan_pkl`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  MODIFY `id_log` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `mitra_industri`
--
ALTER TABLE `mitra_industri`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `nilai_pkl`
--
ALTER TABLE `nilai_pkl`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pkl_anggota`
--
ALTER TABLE `pkl_anggota`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pkl_pengajuan`
--
ALTER TABLE `pkl_pengajuan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `profil_guru`
--
ALTER TABLE `profil_guru`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `profil_siswa`
--
ALTER TABLE `profil_siswa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `walikelas`
--
ALTER TABLE `walikelas`
  MODIFY `id_walikelas` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `absensi_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jurnal_harian`
--
ALTER TABLE `jurnal_harian`
  ADD CONSTRAINT `jurnal_harian_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `laporan_pkl`
--
ALTER TABLE `laporan_pkl`
  ADD CONSTRAINT `laporan_pkl_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  ADD CONSTRAINT `log_aktivitas_id_users_foreign` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `nilai_pkl`
--
ALTER TABLE `nilai_pkl`
  ADD CONSTRAINT `nilai_pkl_pembimbing_id_foreign` FOREIGN KEY (`pembimbing_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `nilai_pkl_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pkl_anggota`
--
ALTER TABLE `pkl_anggota`
  ADD CONSTRAINT `pkl_anggota_pengajuan_id_foreign` FOREIGN KEY (`pengajuan_id`) REFERENCES `pkl_pengajuan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pkl_anggota_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `pkl_pengajuan`
--
ALTER TABLE `pkl_pengajuan`
  ADD CONSTRAINT `pkl_pengajuan_ketua_id_foreign` FOREIGN KEY (`ketua_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `pkl_pengajuan_pembimbing_id_foreign` FOREIGN KEY (`pembimbing_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `profil_guru`
--
ALTER TABLE `profil_guru`
  ADD CONSTRAINT `profil_guru_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `profil_siswa`
--
ALTER TABLE `profil_siswa`
  ADD CONSTRAINT `profil_siswa_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
