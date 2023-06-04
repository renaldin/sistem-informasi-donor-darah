-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2023 at 02:40 PM
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
  `nik` varchar(20) DEFAULT NULL,
  `nama_anggota` varchar(100) DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `status_anggota` enum('Mandiri','Event') NOT NULL DEFAULT 'Mandiri',
  `tanggal_donor_kembali` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id_anggota`, `nik`, `nama_anggota`, `jenis_kelamin`, `alamat`, `status_anggota`, `tanggal_donor_kembali`) VALUES
(1, NULL, 'Teresia 1', 'Perempuan', 'Subang', 'Mandiri', '2023-06-22'),
(2, NULL, 'Teresia 2', 'Perempuan', 'Subang', 'Mandiri', '2023-06-22'),
(3, NULL, 'Teresia 3', 'Perempuan', 'Subang', 'Mandiri', '2023-06-22'),
(4, NULL, 'Teresia 5', 'Perempuan', 'Subang', 'Mandiri', '2023-06-22'),
(5, NULL, 'Teresia 6', 'Perempuan', 'Subang', 'Mandiri', '2023-06-22'),
(6, NULL, 'Teresia 7', 'Perempuan', 'Subang', 'Mandiri', '2023-06-01'),
(7, NULL, 'Teresia 8', 'Perempuan', 'Subang', 'Mandiri', '2023-05-20'),
(9, NULL, 'Teresia 1 Event', 'Perempuan', 'Subang', 'Event', '2023-06-25'),
(10, NULL, 'Teresia 2 Event 6', 'Perempuan', 'Subang', 'Event', '2023-06-25'),
(11, NULL, 'Teresia 3 Event 6', 'Perempuan', 'Subang', 'Event', '2023-06-25'),
(12, NULL, 'Teresia 4 Event 6', 'Perempuan', 'Subang', 'Event', '2023-06-25'),
(13, NULL, 'Teresia 5 Event 6', 'Perempuan', 'Subang', 'Event', '2023-06-25'),
(14, '123123', 'Teresia', 'Perempuan', 'Subang', 'Event', '2023-06-25'),
(15, '112233445566', 'Sumanto', 'Laki-laki', 'Subang', 'Mandiri', '2023-06-03');

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
(1, 1, 'K1', 'A', 'A', 'A', '2023-05-18', '2023-05-18 00:00:00'),
(2, 2, 'K2', 'C', 'C', 'C', '2023-05-18', '2023-05-18 00:00:00'),
(3, 2, 'K3', 'B', 'B', 'B', '2023-05-20', '2023-05-20 22:55:30'),
(4, 1, 'K4', 'O', 'O', 'O', '2023-05-21', '2023-05-20 22:55:56'),
(5, 3, 'K5', 'O', 'B', 'C', '2023-05-23', '2023-05-23 10:25:54'),
(6, 2, 'K6', 'O', 'B', 'C', '2023-05-23', '2023-05-23 10:31:54'),
(7, 4, 'K7', 'C', 'C', 'C', '2023-05-23', '2023-05-23 23:30:33'),
(8, 5, 'K8', 'A', 'A', 'A', '2023-06-10', '2023-05-23 23:43:49'),
(9, 1, 'K9', 'A', 'A', 'A', '2023-05-25', '2023-05-25 13:28:59'),
(10, 7, 'K10', 'A', 'A', 'A', '2023-06-10', '2023-05-25 14:02:20'),
(11, 8, 'K11', 'A', 'A', 'A', '2023-11-11', '2023-05-25 14:41:16'),
(12, 9, 'K12', 'A', 'A', 'A', '2023-08-31', '2023-05-25 14:44:43'),
(13, 10, 'K13', 'A', 'A', 'A', '2023-06-26', '2023-05-26 09:54:25'),
(14, 11, 'K14', 'B', 'B', 'B', '2023-06-26', '2023-05-26 10:01:04'),
(15, 12, 'K15', 'A', 'A', 'A', '2023-06-26', '2023-05-26 10:01:34'),
(16, 13, 'K16', 'A', 'A', 'A', '2023-06-26', '2023-05-26 10:02:02'),
(17, 14, 'K17', 'A', 'A', 'A', '2023-06-26', '2023-05-26 10:02:27'),
(18, 15, 'K18', 'A', 'A', 'A', '2023-06-26', '2023-05-26 10:41:00');

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
(3, 9, 2, '2023-05-25 13:32:38');

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
(7, 4, 4, '2023-05-23 10:33:25');

-- --------------------------------------------------------

--
-- Table structure for table `darah_masuk`
--

CREATE TABLE `darah_masuk` (
  `id_darah_masuk` int(11) NOT NULL,
  `id_darah` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tanggal_masuk` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `darah_masuk`
--

INSERT INTO `darah_masuk` (`id_darah_masuk`, `id_darah`, `id_user`, `tanggal_masuk`) VALUES
(9, 7, 2, '2023-05-23 23:30:33'),
(12, 10, 2, '2023-05-25 14:02:20'),
(13, 11, 2, '2023-05-25 14:41:16'),
(14, 12, 2, '2023-05-25 14:44:43'),
(15, 13, 2, '2023-05-26 09:54:25'),
(16, 14, 2, '2023-05-26 10:01:04'),
(17, 15, 2, '2023-05-26 10:01:34'),
(18, 16, 2, '2023-05-26 10:02:02'),
(19, 17, 2, '2023-05-26 10:02:27'),
(20, 18, 2, '2023-05-26 10:41:00');

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
(16, 14, NULL, '2023-06-03 01:36:07', 'Ready', 'Lolos', 'Lolos kusioner', '22', '90', '50', '22', '165', 'Sehat'),
(17, 14, NULL, '2023-06-03 08:40:05', 'Proses', 'Lolos', 'Lolos kusioner', '40', '50', '50', '180', '170', 'Sehat'),
(18, 15, NULL, '2023-06-03 08:42:14', 'Proses', 'Lolos', 'Lolos kusioner', NULL, NULL, NULL, NULL, NULL, NULL);

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
  `status_event` enum('Aktif','Tidak Aktif') NOT NULL DEFAULT 'Tidak Aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id_event`, `id_user`, `nama_instansi`, `alamat_lengkap`, `tanggal_event`, `jam`, `jumlah_orang`, `upload_surat`, `tanggal_pengajuan`, `status_pengajuan`, `status_event`) VALUES
(3, 2, 'Politeknik Negeri Subang', 'Cibogo', '2023-05-07', '12:00', 4, '05072023011122 Politeknik Negeri Subang.pdf', '2023-05-07 00:00:00', 'Tidak Disetujui', 'Tidak Aktif'),
(4, 7, 'Politeknik Negeri Subang', 'Cibogo', '2023-05-12', '12:00', 2, '05122023072455 Politeknik Negeri Subang.pdf', '2023-05-12 00:00:00', 'Tidak Disetujui', 'Tidak Aktif'),
(6, 7, 'Politeknik Negeri Subang', 'Cibogo', '2023-05-13', '12:00', 3, '05132023081819 Politeknik Negeri Subang.pdf', '2023-05-13 00:00:00', 'Disetujui', 'Aktif'),
(7, 2, 'Politeknik Negeri Subang', 'Cibogo Update', '2023-05-13', '02:00', 3, '05132023082930 Politeknik Negeri Subang.pdf', '2023-05-13 00:00:00', 'Disetujui', 'Tidak Aktif'),
(9, 7, 'Politeknik Negeri Subang Update', 'Cibogo Update', '2023-05-13', '12:00', 3, '05132023084032 Politeknik Negeri Subang Update.pdf', '2023-05-13 00:00:00', 'Disetujui', 'Tidak Aktif'),
(10, 2, 'Politeknik Negeri Subang Update', 'Cibogo Update', '2023-05-13', '12:00', 3, '05132023084418 Politeknik Negeri Subang Update.pdf', '2023-05-13 00:00:00', 'Disetujui', 'Tidak Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `permohonan_darah`
--

CREATE TABLE `permohonan_darah` (
  `id_permohonan_darah` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_rs` varchar(100) DEFAULT NULL,
  `golda` varchar(10) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `upload_surat` text DEFAULT NULL,
  `status_permohonan` enum('Belum Dikirim','Menunggu Proses','Dikirim','Diterima') DEFAULT NULL,
  `tanggal_permohonan` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permohonan_darah`
--

INSERT INTO `permohonan_darah` (`id_permohonan_darah`, `id_user`, `nama_rs`, `golda`, `jumlah`, `upload_surat`, `status_permohonan`, `tanggal_permohonan`) VALUES
(3, 9, 'Rumah Sakit', 'A', 4, '05202023173242 Rumah Sakit.pdf', 'Diterima', '2023-05-20 17:44:01'),
(4, 9, 'Rumah Sakit', 'A', 2, '05232023102308 Rumah Sakit.pdf', 'Diterima', '2023-05-23 10:23:29');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `nomor_telepon` varchar(30) NOT NULL,
  `role` enum('Admin','Donatur','Rumah Sakit','Event','Petugas Kesehatan') NOT NULL,
  `foto` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `email`, `password`, `nomor_telepon`, `role`, `foto`) VALUES
(1, 'Admin Sistem', 'admin122@gmail.com', '$2y$10$FOLMcTQ.ZQmG4XkXHemNkuvTur77scCIzvFMyQyRV9SdbHXGYN0iy', '08989786444', 'Admin', NULL),
(2, 'Admin Sistem Donor', 'admin@gmail.com', '$2y$10$smeipeg7V7MdF0BNmGaVduxOyL9ugB0d9s8kAYH0ABF./QqXZDzfW', '0896775651', 'Admin', '05062023024216Admin Sistem Donor.png'),
(6, 'Teresia Purba', 'renaldinoviandi9@gmail.com', '$2y$10$BQYqnOd3iOCUmYDjhJH56eSRpNtJ.MA6uE0YKTRucaFkYitpVoz4u', '08989784353', 'Donatur', '05062023011528Teresia Purba.png'),
(7, 'Event', 'event@gmail.com', '$2y$10$Mfd7GStgY7g9C2ykYfYkNelJEKrv4x.tilybL3iHTgPtqiP3YyLpm', '08989784353', 'Event', '05062023014106Event.png'),
(8, 'Petugas Kesehatan', 'pasker@gmail.com', '$2y$10$efC/qal7R6LOIzriA0edce5C3JDCypRJwtmUEhgddXHtX6NeEFSRC', '08989784353', 'Petugas Kesehatan', '05062023014318Petugas Kesehatan.png'),
(9, 'Rumah Sakit', 'rumahsakit@gmail.com', '$2y$10$V2B.NKXJKtWyPfKXmHBf2.3KlVE7.fEFOhNE1tE0cwlkrJkBf5ITW', '08989784353', 'Rumah Sakit', '05062023014538Rumah Sakit.png'),
(12, 'Teresia Purba', 'rumahsakit@gmail.com', '$2y$10$8gnVgdf9aNhhea02ehOny.RtHpejmoYiyzOYQYWPxky4h4e2utoNq', '08989784353', 'Rumah Sakit', NULL);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `biodata_web`
--
ALTER TABLE `biodata_web`
  MODIFY `id_biodata_web` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `darah`
--
ALTER TABLE `darah`
  MODIFY `id_darah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `darah_buang`
--
ALTER TABLE `darah_buang`
  MODIFY `id_darah_buang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `darah_keluar`
--
ALTER TABLE `darah_keluar`
  MODIFY `id_darah_keluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `darah_masuk`
--
ALTER TABLE `darah_masuk`
  MODIFY `id_darah_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `donor`
--
ALTER TABLE `donor`
  MODIFY `id_donor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id_event` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `permohonan_darah`
--
ALTER TABLE `permohonan_darah`
  MODIFY `id_permohonan_darah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
