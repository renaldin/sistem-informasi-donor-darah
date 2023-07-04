-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2023 at 07:31 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db-sistem-donor`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `id_anggota` int(11) NOT NULL,
  `nik` varchar(30) DEFAULT NULL,
  `nama_anggota` varchar(100) DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_wa` varchar(30) DEFAULT NULL,
  `status_anggota` enum('Mandiri','Event') NOT NULL DEFAULT 'Mandiri',
  `tanggal_donor_kembali` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id_anggota`, `nik`, `nama_anggota`, `jenis_kelamin`, `alamat`, `no_wa`, `status_anggota`, `tanggal_donor_kembali`) VALUES
(1, NULL, 'Teresia 1', 'Perempuan', 'Subang', '0895336928026', 'Mandiri', '2023-06-22'),
(2, NULL, 'Teresia 2', 'Perempuan', 'Subang', '0895336928026', 'Mandiri', '2023-06-22'),
(3, NULL, 'Teresia 3', 'Perempuan', 'Subang', '0895336928026', 'Mandiri', '2023-06-22'),
(4, NULL, 'Teresia 5', 'Perempuan', 'Subang', '0895336928026', 'Mandiri', '2023-06-22'),
(5, NULL, 'Teresia 6', 'Perempuan', 'Subang', '0895336928026', 'Mandiri', '2023-06-22'),
(6, NULL, 'Teresia 7', 'Perempuan', 'Subang', '0895336928026', 'Mandiri', '2023-06-01'),
(7, NULL, 'Teresia 8', 'Perempuan', 'Subang', '0895336928026', 'Mandiri', '2023-05-20'),
(9, NULL, 'Teresia 1 Event', 'Perempuan', 'Subang', '0895336928026', 'Event', '2023-06-25'),
(10, NULL, 'Teresia 2 Event 6', 'Perempuan', 'Subang', '0895336928026', 'Event', '2023-06-25'),
(11, NULL, 'Teresia 3 Event 6', 'Perempuan', 'Subang', '0895336928026', 'Event', '2023-06-25'),
(12, NULL, 'Teresia 4 Event 6', 'Perempuan', 'Subang', '0895336928026', 'Event', '2023-06-25'),
(13, NULL, 'Teresia 5 Event 6', 'Perempuan', 'Subang', '0895336928026', 'Event', '2023-06-25'),
(14, '123123', 'Teresia', 'Perempuan', 'Subang', '0895336928026', 'Mandiri', '2023-08-30'),
(15, '112233445566', 'Sumanto', 'Laki-laki', 'Subang', '0895336928026', 'Mandiri', '2023-08-22'),
(16, '99999999999', 'Teresia 9', 'Perempuan', 'Subang', '0895336928026', 'Mandiri', '2023-08-29'),
(17, '11111111111111', 'Event Donor 1', 'Perempuan', 'Subang', '0895336928026', 'Event', '2023-08-01'),
(18, '22222222222222', 'Event 12 Donor 2', 'Perempuan', 'Subang', '089878672368', 'Event', '2023-08-01'),
(19, '10101010101010', 'Teresia Purba', 'Perempuan', 'Subang', '08989784353', 'Mandiri', '2023-09-02');

-- --------------------------------------------------------

--
-- Table structure for table `biodata_web`
--

CREATE TABLE `biodata_web` (
  `id_biodata_web` int(11) NOT NULL,
  `nama_website` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nomor_telepon` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `logo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `biodata_web`
--

INSERT INTO `biodata_web` (`id_biodata_web`, `nama_website`, `email`, `nomor_telepon`, `alamat`, `logo`) VALUES
(1, 'Sistem Donor', 'pmi@gmail.com', '(123) 123-456', 'Jalan Srigunting Raya Nomor 1 Subang', '04202023074227.png');

-- --------------------------------------------------------

--
-- Table structure for table `darah`
--

CREATE TABLE `darah` (
  `id_darah` int(11) NOT NULL,
  `id_donor` int(11) NOT NULL,
  `no_kantong` varchar(50) DEFAULT NULL,
  `golongan_darah` varchar(10) DEFAULT NULL,
  `resus` varchar(50) DEFAULT NULL,
  `volume_darah` varchar(50) DEFAULT NULL,
  `tanggal_kedaluwarsa` date DEFAULT NULL,
  `tanggal_darah_masuk` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `darah`
--

INSERT INTO `darah` (`id_darah`, `id_donor`, `no_kantong`, `golongan_darah`, `resus`, `volume_darah`, `tanggal_kedaluwarsa`, `tanggal_darah_masuk`) VALUES
(1, 1, 'K1', 'A', 'Positif', 'A', '2023-05-18', '2023-05-18 00:00:00'),
(2, 2, 'K2', 'B', 'Negatif', 'B', '2023-05-18', '2023-05-18 00:00:00'),
(3, 2, 'K3', 'B', 'Positif', 'B', '2023-05-20', '2023-05-20 22:55:30'),
(4, 1, 'K4', 'O', 'Negatif', 'O', '2023-05-21', '2023-05-20 22:55:56'),
(5, 3, 'K5', 'O', 'Positif', 'C', '2023-05-23', '2023-05-23 10:25:54'),
(6, 2, 'K6', 'O', 'Negatif', 'C', '2023-05-23', '2023-05-23 10:31:54'),
(7, 4, 'K7', 'C', 'Negatif', 'C', '2023-05-23', '2023-05-23 23:30:33'),
(8, 5, 'K8', 'A', 'Positif', 'A', '2023-06-10', '2023-05-23 23:43:49'),
(9, 1, 'K9', 'A', 'Negatif', 'A', '2023-05-25', '2023-05-25 13:28:59'),
(10, 7, 'K10', 'A', 'Positif', 'A', '2023-06-10', '2023-05-25 14:02:20'),
(11, 8, 'K11', 'A', 'Negatif', 'A', '2023-11-11', '2023-05-25 14:41:16'),
(12, 9, 'K12', 'A', 'Negatif', 'A', '2023-08-31', '2023-05-25 14:44:43'),
(13, 10, 'K13', 'A', 'Positif', 'A', '2023-06-26', '2023-05-26 09:54:25'),
(14, 11, 'K14', 'B', 'Positif', 'B', '2023-06-26', '2023-05-26 10:01:04'),
(15, 12, 'K15', 'A', 'Negatif', 'A', '2023-06-26', '2023-05-26 10:01:34'),
(16, 13, 'K16', 'A', 'Positif', 'A', '2023-06-26', '2023-05-26 10:02:02'),
(17, 14, 'K17', 'A', 'Positif', 'A', '2023-06-26', '2023-05-26 10:02:27'),
(18, 15, 'K18', 'A', 'Negatif', 'A', '2023-06-26', '2023-05-26 10:41:00'),
(19, 19, 'K19', 'A', 'Positif', '1', '2023-11-09', '2023-06-23 04:02:26'),
(20, 20, 'K20', 'A', 'Positif', '90', '2023-06-30', '2023-06-30 10:26:28'),
(21, 16, 'K21', 'A', 'Positif', 'Volume', '2023-08-05', '2023-07-01 13:27:48'),
(22, 17, 'K22', 'A', 'Positif', 'Volume', '2023-08-05', '2023-07-01 13:47:46'),
(23, 21, 'K23', 'O', 'Positif', '1', '2023-08-06', '2023-07-02 08:59:49'),
(24, 22, 'K24', 'O', 'Positif', '2', '2023-08-06', '2023-07-02 09:12:15');

-- --------------------------------------------------------

--
-- Table structure for table `darah_buang`
--

CREATE TABLE `darah_buang` (
  `id_darah_buang` int(11) NOT NULL,
  `id_darah` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tanggal_buang` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `darah_buang`
--

INSERT INTO `darah_buang` (`id_darah_buang`, `id_darah`, `id_user`, `tanggal_buang`) VALUES
(1, 2, 3, '2023-05-18 00:00:00'),
(2, 8, 2, '2023-05-23 23:53:13'),
(3, 9, 2, '2023-05-25 13:32:38'),
(4, 20, 2, '2023-07-02 09:38:59');

-- --------------------------------------------------------

--
-- Table structure for table `darah_keluar`
--

CREATE TABLE `darah_keluar` (
  `id_darah_keluar` int(11) NOT NULL,
  `id_darah` int(11) NOT NULL,
  `id_permohonan_darah` int(11) NOT NULL,
  `tanggal_keluar` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `darah_keluar`
--

INSERT INTO `darah_keluar` (`id_darah_keluar`, `id_darah`, `id_permohonan_darah`, `tanggal_keluar`) VALUES
(2, 1, 3, '2023-05-20 23:27:24'),
(3, 3, 3, '2023-05-20 23:27:29'),
(5, 5, 4, '2023-05-23 10:32:56'),
(6, 6, 4, '2023-05-23 10:33:08'),
(7, 4, 4, '2023-05-23 10:33:25'),
(8, 7, 6, '2023-06-18 02:39:41'),
(9, 10, 6, '2023-06-18 02:39:45'),
(11, 15, 7, '2023-07-02 09:32:47'),
(12, 16, 7, '2023-07-02 09:33:01');

-- --------------------------------------------------------

--
-- Table structure for table `darah_masuk`
--

CREATE TABLE `darah_masuk` (
  `id_darah_masuk` int(11) NOT NULL,
  `id_darah` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `status_darah_masuk` enum('Belum Masuk','Sudah Masuk') NOT NULL DEFAULT 'Belum Masuk',
  `tanggal_masuk` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `darah_masuk`
--

INSERT INTO `darah_masuk` (`id_darah_masuk`, `id_darah`, `id_user`, `status_darah_masuk`, `tanggal_masuk`) VALUES
(13, 11, 2, 'Sudah Masuk', '2023-05-25 14:41:16'),
(14, 12, 2, 'Sudah Masuk', '2023-05-25 14:44:43'),
(16, 14, 2, 'Sudah Masuk', '2023-05-26 10:01:04'),
(19, 17, 2, 'Sudah Masuk', '2023-05-26 10:02:27'),
(20, 18, 2, 'Sudah Masuk', '2023-05-26 10:41:00'),
(21, 19, 2, 'Sudah Masuk', '2023-06-23 04:02:26'),
(23, 21, 2, 'Sudah Masuk', '2023-07-01 13:27:48'),
(24, 22, 2, 'Sudah Masuk', '2023-07-01 13:47:46'),
(25, 23, 2, 'Sudah Masuk', NULL),
(26, 24, 2, 'Sudah Masuk', NULL),
(27, 13, 2, 'Sudah Masuk', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `donor`
--

CREATE TABLE `donor` (
  `id_donor` int(11) NOT NULL,
  `id_anggota` int(11) DEFAULT NULL,
  `id_event` int(11) DEFAULT NULL,
  `tanggal_donor` datetime DEFAULT NULL,
  `status_donor` enum('Ready','Proses','Selesai') DEFAULT NULL,
  `hasil_kusioner` enum('Lolos','Tidak Lolos') DEFAULT NULL,
  `deskripsi_hasil_kusioner` varchar(255) DEFAULT NULL,
  `hb` varchar(10) DEFAULT NULL,
  `tekanan_darah` varchar(10) DEFAULT NULL,
  `berat_badan` varchar(10) DEFAULT NULL,
  `denyut_nadi` varchar(10) DEFAULT NULL,
  `tinggi_badan` varchar(10) DEFAULT NULL,
  `keadaan_umum` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donor`
--

INSERT INTO `donor` (`id_donor`, `id_anggota`, `id_event`, `tanggal_donor`, `status_donor`, `hasil_kusioner`, `deskripsi_hasil_kusioner`, `hb`, `tekanan_darah`, `berat_badan`, `denyut_nadi`, `tinggi_badan`, `keadaan_umum`) VALUES
(1, 1, NULL, '2023-05-25 09:18:04', 'Selesai', 'Lolos', 'Lolos kusioner', NULL, NULL, NULL, NULL, NULL, NULL),
(2, 2, NULL, '2023-05-25 09:18:04', 'Selesai', 'Lolos', 'Lolos kusioner', NULL, NULL, NULL, NULL, NULL, NULL),
(3, 3, NULL, '2023-05-25 09:18:04', 'Selesai', 'Lolos', 'Lolos kusioner', NULL, NULL, NULL, NULL, NULL, NULL),
(4, 4, NULL, '2023-05-25 09:18:04', 'Selesai', 'Lolos', 'Lolos kusioner', NULL, NULL, NULL, NULL, NULL, NULL),
(5, 5, NULL, '2023-05-25 09:18:04', 'Selesai', 'Lolos', 'Lolos kusioner', NULL, NULL, NULL, NULL, NULL, NULL),
(6, 1, NULL, '2023-05-25 09:18:04', 'Selesai', 'Lolos', 'Lolos kusioner', NULL, NULL, NULL, NULL, NULL, NULL),
(7, 6, NULL, '2023-05-25 14:02:20', 'Selesai', 'Lolos', 'Lolos kusioner', NULL, NULL, NULL, NULL, NULL, NULL),
(8, 7, NULL, '2023-05-25 14:41:16', 'Selesai', 'Lolos', 'Deskripsi hasil kusioner teresia 8', NULL, NULL, NULL, NULL, NULL, NULL),
(9, 1, NULL, '2023-05-25 14:44:43', 'Selesai', 'Lolos', 'Deskripsi hasil kusioner teresia 1', NULL, NULL, NULL, NULL, NULL, NULL),
(10, 9, 6, '2023-05-26 09:54:25', 'Selesai', 'Lolos', 'Donor darah dari event', NULL, NULL, NULL, NULL, NULL, NULL),
(11, 10, 6, '2023-05-26 10:01:04', 'Selesai', 'Lolos', 'Donor darah dari event', NULL, NULL, NULL, NULL, NULL, NULL),
(12, 11, 6, '2023-05-26 10:01:34', 'Selesai', 'Lolos', 'Donor darah dari event', NULL, NULL, NULL, NULL, NULL, NULL),
(13, 12, 6, '2023-05-26 10:02:02', 'Selesai', 'Lolos', 'Donor darah dari event', NULL, NULL, NULL, NULL, NULL, NULL),
(14, 13, 6, '2023-05-26 10:02:27', 'Selesai', 'Lolos', 'Donor darah dari event', NULL, NULL, NULL, NULL, NULL, NULL),
(15, 14, 6, '2023-05-26 10:41:00', 'Selesai', 'Lolos', 'Donor darah dari event', NULL, NULL, NULL, NULL, NULL, NULL),
(16, 14, NULL, '2023-06-03 01:36:07', 'Selesai', 'Lolos', 'Lolos kusioner', '22', '90', '50', '22', '165', 'Sehat'),
(17, 14, NULL, '2023-06-03 08:40:05', 'Selesai', 'Lolos', 'Lolos kusioner', '40', '50', '50', '180', '170', 'Sehat'),
(18, 15, NULL, '2023-06-03 08:42:14', 'Proses', 'Lolos', 'Lolos kusioner', NULL, NULL, NULL, NULL, NULL, NULL),
(19, 15, NULL, '2023-06-23 04:02:26', 'Selesai', 'Lolos', 'Deskripsi', NULL, NULL, NULL, NULL, NULL, NULL),
(20, 16, NULL, '2023-06-30 10:26:28', 'Selesai', 'Lolos', 'Lulus Kusioner', NULL, NULL, NULL, NULL, NULL, NULL),
(21, 17, 12, '2023-07-02 08:59:49', 'Selesai', 'Lolos', 'Donor darah dari event', NULL, NULL, NULL, NULL, NULL, NULL),
(22, 18, 12, '2023-07-02 09:12:15', 'Selesai', 'Lolos', 'Donor darah dari event', NULL, NULL, NULL, NULL, NULL, NULL),
(23, 19, NULL, '2023-07-04 23:46:34', 'Proses', 'Lolos', 'Lolos kusioner', NULL, NULL, NULL, NULL, NULL, NULL),
(24, 19, NULL, '2023-07-04 23:47:06', 'Proses', 'Lolos', 'Lolos kusioner', NULL, NULL, NULL, NULL, NULL, NULL),
(25, 19, NULL, '2023-07-04 23:48:39', 'Proses', 'Lolos', 'Lolos kusioner', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id_event` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_instansi` varchar(100) DEFAULT NULL,
  `alamat_lengkap` varchar(255) DEFAULT NULL,
  `tanggal_event` date DEFAULT NULL,
  `jam` varchar(10) DEFAULT NULL,
  `jumlah_orang` int(11) DEFAULT NULL,
  `upload_surat` text DEFAULT NULL,
  `tanggal_pengajuan` datetime DEFAULT NULL,
  `status_pengajuan` enum('Menunggu Persetujuan','Disetujui','Tidak Disetujui','Belum Dikirim','Dibuat Admin') DEFAULT NULL,
  `status_event` enum('Aktif','Tidak Aktif') NOT NULL DEFAULT 'Tidak Aktif',
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id_event`, `id_user`, `nama_instansi`, `alamat_lengkap`, `tanggal_event`, `jam`, `jumlah_orang`, `upload_surat`, `tanggal_pengajuan`, `status_pengajuan`, `status_event`, `gambar`) VALUES
(3, 2, 'Politeknik Negeri Subang', 'Cibogo', '2023-05-07', '12:00', 4, '05072023011122 Politeknik Negeri Subang.pdf', '2023-05-07 00:00:00', 'Tidak Disetujui', 'Tidak Aktif', 'event1.jpeg'),
(4, 7, 'Politeknik Negeri Subang', 'Cibogo', '2023-05-12', '12:00', 2, '05122023072455 Politeknik Negeri Subang.pdf', '2023-05-12 00:00:00', 'Tidak Disetujui', 'Tidak Aktif', 'event2.jpg'),
(6, 7, 'Politeknik Negeri Subang', 'Cibogo', '2023-05-13', '12:00', 3, '05132023081819 Politeknik Negeri Subang.pdf', '2023-05-13 00:00:00', 'Disetujui', 'Tidak Aktif', 'event3.jpg'),
(7, 2, 'Politeknik Negeri Subang', 'Cibogo Update', '2023-05-13', '02:00', 3, '05132023082930 Politeknik Negeri Subang.pdf', '2023-05-13 00:00:00', 'Disetujui', 'Tidak Aktif', 'event4.jpeg'),
(9, 7, 'Politeknik Negeri Subang Update', 'Cibogo Update', '2023-05-13', '12:00', 3, '05132023084032 Politeknik Negeri Subang Update.pdf', '2023-05-13 00:00:00', 'Disetujui', 'Tidak Aktif', 'event5.jpg'),
(10, 2, 'Politeknik Negeri Subang Update', 'Cibogo Update', '2023-05-13', '12:00', 3, '05132023084418 Politeknik Negeri Subang Update.pdf', '2023-05-13 00:00:00', 'Disetujui', 'Tidak Aktif', 'event6.jpg'),
(12, 18, 'Event Instansi 1', 'Cibogo', '2023-08-01', '08:00', 50, '07022023082319 Event Instansi 1.pdf', '2023-07-02 00:00:00', 'Disetujui', 'Aktif', 'Event Instansi 1.png'),
(13, 18, 'Polsub', 'subang cibogo', '2023-07-13', '07:00', 10, '07022023232651 Polsub.pdf', '2023-07-02 23:26:51', 'Belum Dikirim', 'Tidak Aktif', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permohonan_darah`
--

CREATE TABLE `permohonan_darah` (
  `id_permohonan_darah` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_rs` varchar(100) DEFAULT NULL,
  `nama_dokter` varchar(100) DEFAULT NULL,
  `nama_pasien` varchar(255) DEFAULT NULL,
  `golda` varchar(10) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `upload_surat` text DEFAULT NULL,
  `status_permohonan` enum('Belum Dikirim','Menunggu Proses','Dikirim','Diterima') DEFAULT NULL,
  `tanggal_permohonan` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permohonan_darah`
--

INSERT INTO `permohonan_darah` (`id_permohonan_darah`, `id_user`, `nama_rs`, `nama_dokter`, `nama_pasien`, `golda`, `jumlah`, `upload_surat`, `status_permohonan`, `tanggal_permohonan`) VALUES
(4, 9, 'Rumah Sakit', 'Nama Dokter Update', 'Nama Pasien Update', 'A', 2, '05232023102308 Rumah Sakit.pdf', 'Diterima', '2023-05-23 10:23:29'),
(6, 9, 'Rumah Sakit', 'Nama Dokter Update', 'Nama Pasien Update', 'A', 3, '06182023023327 Rumah Sakit.pdf', 'Diterima', '2023-06-18 02:36:54'),
(7, 19, 'Rumah Sakit 10', 'Nama Dokter Rumah Sakit 10', 'Nama Pasien', 'A', 2, '07022023092312 Rumah Sakit 10.pdf', 'Menunggu Proses', '2023-07-02 09:23:49');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat_user` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `nomor_telepon` varchar(30) NOT NULL,
  `role` enum('Admin','Donatur','Rumah Sakit','Event','Petugas Kesehatan') NOT NULL,
  `foto` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `alamat_user`, `email`, `password`, `nomor_telepon`, `role`, `foto`) VALUES
(1, 'Admin Sistem', 'Subang', 'admin122@gmail.com', '$2y$10$FOLMcTQ.ZQmG4XkXHemNkuvTur77scCIzvFMyQyRV9SdbHXGYN0iy', '08989786444', 'Admin', '07042023171439Admin Sistem.jpg'),
(2, 'Admin Sistem Donor', 'Subang', 'admin@gmail.com', '$2y$10$smeipeg7V7MdF0BNmGaVduxOyL9ugB0d9s8kAYH0ABF./QqXZDzfW', '0896775651', 'Admin', '07022023010547Admin Sistem Donor Update.png'),
(6, 'Teresia Purba', 'Subang', 'teresia9@gmail.com', '$2y$10$BQYqnOd3iOCUmYDjhJH56eSRpNtJ.MA6uE0YKTRucaFkYitpVoz4u', '08989784353', 'Donatur', '07042023171506Teresia Purba.png'),
(7, 'Event', 'Subang', 'event@gmail.com', '$2y$10$Mfd7GStgY7g9C2ykYfYkNelJEKrv4x.tilybL3iHTgPtqiP3YyLpm', '08989784353', 'Event', '05062023014106Event.png'),
(8, 'Petugas Kesehatan 1', 'Subang', 'paskes1@gmail.com', '$2y$10$efC/qal7R6LOIzriA0edce5C3JDCypRJwtmUEhgddXHtX6NeEFSRC', '08989784353', 'Petugas Kesehatan', '07042023170842Petugas Kesehatan 1.png'),
(9, 'Rumah Sakit', 'Subang', 'rumahsakit@gmail.com', '$2y$10$V2B.NKXJKtWyPfKXmHBf2.3KlVE7.fEFOhNE1tE0cwlkrJkBf5ITW', '08989784353', 'Rumah Sakit', '05062023014538Rumah Sakit.png'),
(17, 'Teresia Purba', 'Subang', 'teresia10@gmail.com', '$2y$10$Hm9aEtEEiKdHETLVtLX04OSFsP5ib4dIzNPsIswzwd4/W3VbXwr4i', '08989784353', 'Donatur', '07042023170806Teresia Purba.png'),
(18, 'Event Instansi 1', 'Subang', 'event10@gmail.com', '$2y$10$y1q.KZMJzytfGRRbuxS9henEg6WHTPT/pK0Dh8YMdoslJuHDlzWmC', '08989784353', 'Event', '07042023170754Event Instansi 1.png'),
(19, 'Rumah Sakit 10', 'Subang', 'rumahsakit10@gmail.com', '$2y$10$QX2zJRL0qCQtm9bJuphgx.hCPQaicUIQhvbaFBU5yGbRRXXWWeDuC', '08989784353', 'Rumah Sakit', '07042023170409Rumah Sakit 10.png');

-- --------------------------------------------------------

--
-- Table structure for table `user_donatur`
--

CREATE TABLE `user_donatur` (
  `id_user_donatur` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nik` varchar(30) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jk` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `gol_darah` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_donatur`
--

INSERT INTO `user_donatur` (`id_user_donatur`, `id_user`, `nik`, `tanggal_lahir`, `jk`, `gol_darah`) VALUES
(3, 17, '10101010101010', '2001-07-12', 'Perempuan', NULL),
(4, 6, '3211236544567899', '2001-07-03', 'Laki-laki', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_event`
--

CREATE TABLE `user_event` (
  `id_user_event` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `kode_instansi` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_event`
--

INSERT INTO `user_event` (`id_user_event`, `id_user`, `kode_instansi`) VALUES
(2, 18, 'E-010'),
(4, 7, 'E-05');

-- --------------------------------------------------------

--
-- Table structure for table `user_rs`
--

CREATE TABLE `user_rs` (
  `id_user_rs` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `kode_rs` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_rs`
--

INSERT INTO `user_rs` (`id_user_rs`, `id_user`, `kode_rs`) VALUES
(2, 19, 'RS-010'),
(3, 9, 'RS-005');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indexes for table `biodata_web`
--
ALTER TABLE `biodata_web`
  ADD PRIMARY KEY (`id_biodata_web`);

--
-- Indexes for table `darah`
--
ALTER TABLE `darah`
  ADD PRIMARY KEY (`id_darah`);

--
-- Indexes for table `darah_buang`
--
ALTER TABLE `darah_buang`
  ADD PRIMARY KEY (`id_darah_buang`);

--
-- Indexes for table `darah_keluar`
--
ALTER TABLE `darah_keluar`
  ADD PRIMARY KEY (`id_darah_keluar`);

--
-- Indexes for table `darah_masuk`
--
ALTER TABLE `darah_masuk`
  ADD PRIMARY KEY (`id_darah_masuk`);

--
-- Indexes for table `donor`
--
ALTER TABLE `donor`
  ADD PRIMARY KEY (`id_donor`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id_event`);

--
-- Indexes for table `permohonan_darah`
--
ALTER TABLE `permohonan_darah`
  ADD PRIMARY KEY (`id_permohonan_darah`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `user_donatur`
--
ALTER TABLE `user_donatur`
  ADD PRIMARY KEY (`id_user_donatur`);

--
-- Indexes for table `user_event`
--
ALTER TABLE `user_event`
  ADD PRIMARY KEY (`id_user_event`);

--
-- Indexes for table `user_rs`
--
ALTER TABLE `user_rs`
  ADD PRIMARY KEY (`id_user_rs`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `biodata_web`
--
ALTER TABLE `biodata_web`
  MODIFY `id_biodata_web` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `darah`
--
ALTER TABLE `darah`
  MODIFY `id_darah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `darah_buang`
--
ALTER TABLE `darah_buang`
  MODIFY `id_darah_buang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `darah_keluar`
--
ALTER TABLE `darah_keluar`
  MODIFY `id_darah_keluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `darah_masuk`
--
ALTER TABLE `darah_masuk`
  MODIFY `id_darah_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `donor`
--
ALTER TABLE `donor`
  MODIFY `id_donor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id_event` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `permohonan_darah`
--
ALTER TABLE `permohonan_darah`
  MODIFY `id_permohonan_darah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user_donatur`
--
ALTER TABLE `user_donatur`
  MODIFY `id_user_donatur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_event`
--
ALTER TABLE `user_event`
  MODIFY `id_user_event` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_rs`
--
ALTER TABLE `user_rs`
  MODIFY `id_user_rs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
