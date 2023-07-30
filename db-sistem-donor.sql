-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 30, 2023 at 10:27 AM
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
(1, '3333333333333333', 'Donatur 1', 'Laki-laki', 'Subang', '08986782321', 'Mandiri', '2023-09-28');

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
  `jenis_darah` enum('Darah Segar','Darah Simpan','Darah Baru') DEFAULT 'Darah Segar',
  `volume_darah` varchar(50) DEFAULT NULL,
  `tanggal_kedaluwarsa` date DEFAULT NULL,
  `tanggal_darah_masuk` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `darah`
--

INSERT INTO `darah` (`id_darah`, `id_donor`, `no_kantong`, `golongan_darah`, `resus`, `jenis_darah`, `volume_darah`, `tanggal_kedaluwarsa`, `tanggal_darah_masuk`) VALUES
(1, 5, 'K1', 'A', 'Positif', 'Darah Segar', 'A', '2023-09-03', '2023-07-30 11:15:33');

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
(1, 1, 1, '2023-07-30 11:34:58');

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

-- --------------------------------------------------------

--
-- Table structure for table `donor`
--

CREATE TABLE `donor` (
  `id_donor` int(11) NOT NULL,
  `id_anggota` int(11) DEFAULT NULL,
  `id_event` int(11) DEFAULT NULL,
  `id_petugas_kuesioner` int(11) DEFAULT NULL,
  `id_petugas_kesehatan` int(11) DEFAULT NULL,
  `tanggal_donor` datetime DEFAULT NULL,
  `status_donor` enum('Ready','Proses','Selesai','Gagal') DEFAULT NULL,
  `hasil_kusioner` enum('Lolos','Tidak Lolos','Proses') DEFAULT NULL,
  `deskripsi_hasil_kusioner` varchar(255) DEFAULT NULL,
  `hb` varchar(10) DEFAULT NULL,
  `tekanan_darah` varchar(10) DEFAULT NULL,
  `berat_badan` varchar(10) DEFAULT NULL,
  `denyut_nadi` varchar(10) DEFAULT NULL,
  `tinggi_badan` varchar(10) DEFAULT NULL,
  `keadaan_umum` varchar(30) DEFAULT NULL,
  `catatan_pendonor` text DEFAULT NULL,
  `nomor_antrian` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donor`
--

INSERT INTO `donor` (`id_donor`, `id_anggota`, `id_event`, `id_petugas_kuesioner`, `id_petugas_kesehatan`, `tanggal_donor`, `status_donor`, `hasil_kusioner`, `deskripsi_hasil_kusioner`, `hb`, `tekanan_darah`, `berat_badan`, `denyut_nadi`, `tinggi_badan`, `keadaan_umum`, `catatan_pendonor`, `nomor_antrian`) VALUES
(1, 1, NULL, 34, 34, '2023-05-27 20:13:31', 'Ready', 'Lolos', NULL, '100', '100/80', '70', '100', '170', 'Sehat', NULL, 1),
(3, 1, NULL, 34, NULL, '2023-07-27 20:37:14', 'Proses', 'Tidak Lolos', 'Anda sedang minum antibiotik, jadi tidak bisa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id_event` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nomor_pengajuan` varchar(30) DEFAULT NULL,
  `nama_koordinator` varchar(255) DEFAULT NULL,
  `nomor_koordinator` varchar(30) DEFAULT NULL,
  `kd_instansi` varchar(30) DEFAULT NULL,
  `nama_instansi` varchar(100) DEFAULT NULL,
  `nama_kegiatan` varchar(200) DEFAULT NULL,
  `alamat_lengkap` varchar(255) DEFAULT NULL,
  `tanggal_event` date DEFAULT NULL,
  `jam` varchar(10) DEFAULT NULL,
  `jumlah_orang` int(11) DEFAULT NULL,
  `upload_surat` text DEFAULT NULL,
  `tanggal_pengajuan` datetime DEFAULT NULL,
  `status_pengajuan` enum('Menunggu Persetujuan','Disetujui','Tidak Disetujui','Belum Dikirim','Dibuat Admin') DEFAULT NULL,
  `status_event` enum('Aktif','Tidak Aktif') NOT NULL DEFAULT 'Tidak Aktif',
  `alasan` varchar(255) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kuesioner_donor`
--

CREATE TABLE `kuesioner_donor` (
  `id_kuesioner` int(11) NOT NULL,
  `id_donor` int(11) NOT NULL,
  `pertanyaan_1` int(11) NOT NULL,
  `pertanyaan_2` int(11) NOT NULL,
  `pertanyaan_3` int(11) NOT NULL,
  `pertanyaan_4` int(11) NOT NULL,
  `pertanyaan_5` int(11) NOT NULL,
  `pertanyaan_6` int(11) NOT NULL,
  `pertanyaan_7` int(11) NOT NULL,
  `pertanyaan_8` int(11) NOT NULL,
  `pertanyaan_9` int(11) NOT NULL,
  `pertanyaan_10` int(11) NOT NULL,
  `pertanyaan_11` int(11) NOT NULL,
  `pertanyaan_12` int(11) NOT NULL,
  `pertanyaan_13` int(11) NOT NULL,
  `pertanyaan_14` int(11) NOT NULL,
  `pertanyaan_15` int(11) NOT NULL,
  `pertanyaan_16` int(11) NOT NULL,
  `pertanyaan_17` int(11) NOT NULL,
  `pertanyaan_18` int(11) NOT NULL,
  `pertanyaan_19` int(11) NOT NULL,
  `pertanyaan_20` int(11) NOT NULL,
  `pertanyaan_21` int(11) NOT NULL,
  `pertanyaan_22` int(11) NOT NULL,
  `pertanyaan_23` int(11) NOT NULL,
  `pertanyaan_24` int(11) NOT NULL,
  `pertanyaan_25` int(11) NOT NULL,
  `pertanyaan_26` int(11) NOT NULL,
  `pertanyaan_27` int(11) NOT NULL,
  `pertanyaan_28` int(11) NOT NULL,
  `pertanyaan_29` int(11) NOT NULL,
  `pertanyaan_30` int(11) NOT NULL,
  `pertanyaan_31` int(11) NOT NULL,
  `pertanyaan_32` int(11) NOT NULL,
  `pertanyaan_33` int(11) NOT NULL,
  `pertanyaan_34` int(11) NOT NULL,
  `pertanyaan_35` int(11) NOT NULL,
  `pertanyaan_36` int(11) NOT NULL,
  `pertanyaan_37` int(11) NOT NULL,
  `pertanyaan_38` int(11) NOT NULL,
  `pertanyaan_39` int(11) NOT NULL,
  `pertanyaan_40` int(11) NOT NULL,
  `pertanyaan_41` int(11) NOT NULL,
  `bulan_kehamilan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kuesioner_donor`
--

INSERT INTO `kuesioner_donor` (`id_kuesioner`, `id_donor`, `pertanyaan_1`, `pertanyaan_2`, `pertanyaan_3`, `pertanyaan_4`, `pertanyaan_5`, `pertanyaan_6`, `pertanyaan_7`, `pertanyaan_8`, `pertanyaan_9`, `pertanyaan_10`, `pertanyaan_11`, `pertanyaan_12`, `pertanyaan_13`, `pertanyaan_14`, `pertanyaan_15`, `pertanyaan_16`, `pertanyaan_17`, `pertanyaan_18`, `pertanyaan_19`, `pertanyaan_20`, `pertanyaan_21`, `pertanyaan_22`, `pertanyaan_23`, `pertanyaan_24`, `pertanyaan_25`, `pertanyaan_26`, `pertanyaan_27`, `pertanyaan_28`, `pertanyaan_29`, `pertanyaan_30`, `pertanyaan_31`, `pertanyaan_32`, `pertanyaan_33`, `pertanyaan_34`, `pertanyaan_35`, `pertanyaan_36`, `pertanyaan_37`, `pertanyaan_38`, `pertanyaan_39`, `pertanyaan_40`, `pertanyaan_41`, `bulan_kehamilan`) VALUES
(1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL),
(3, 3, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL);

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
  `rhesus` enum('Positif','Negatif') NOT NULL,
  `jenis_darah` enum('Darah Segar','Darah Simpan','Darah Baru') NOT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `upload_surat` text DEFAULT NULL,
  `status_permohonan` enum('Belum Dikirim','Menunggu Proses','Dikirim','Diterima') DEFAULT NULL,
  `tanggal_permohonan` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permohonan_darah`
--

INSERT INTO `permohonan_darah` (`id_permohonan_darah`, `id_user`, `nama_rs`, `nama_dokter`, `nama_pasien`, `golda`, `rhesus`, `jenis_darah`, `jumlah`, `upload_surat`, `status_permohonan`, `tanggal_permohonan`) VALUES
(1, 2, 'Rumah Sakit', 'Nama Dokter', 'Nama Pasien', 'A', 'Positif', 'Darah Segar', 1, '07302023113358 Rumah Sakit.pdf', 'Menunggu Proses', '2023-07-30 11:33:58');

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
  `nomor_telepon` varchar(30) DEFAULT NULL,
  `role` enum('Admin','Donatur','Rumah Sakit','Event','Petugas Kesehatan') NOT NULL,
  `status_verifikasi` enum('Belum','Sudah') NOT NULL DEFAULT 'Belum',
  `foto` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `alamat_user`, `email`, `password`, `nomor_telepon`, `role`, `status_verifikasi`, `foto`) VALUES
(2, 'Admin Sistem Donor', 'Subang', 'admin@gmail.com', '$2y$10$smeipeg7V7MdF0BNmGaVduxOyL9ugB0d9s8kAYH0ABF./QqXZDzfW', '089787387878', 'Admin', 'Sudah', '07242023070004Admin Sistem Donor.png'),
(31, 'Teresia Purba', 'Subang', 'renaldinoviandi@gmail.com', '$2y$10$EKARFSuwl7W/WdYW6fFgCuDKQ3tGerqXbHZG0ADp8ZMIc6IN0GNc6', '0895336928026', 'Donatur', 'Sudah', NULL),
(32, 'Teresia Purba 1', 'Subang', 'renaldinoviandi1@gmail.com', '$2y$10$6flUBUdr3ws5I4Y0dXHHlOxMjKEOebbWBBKBz3RMjimrgszdscVe2', '089898989898', 'Donatur', 'Sudah', '07242023070142Teresia Purba 1.png'),
(33, 'Rumah Sakit 1', 'Subang', 'renaldinoviandi9@gmail.com', '$2y$10$aUTkw9voq/g9cCWcn9Yfpu/YX1rAkJChvSTu8pNU9khdELJ2C6r1W', '089898989898', 'Event', 'Sudah', '07242023071520Rumah Sakit 1.png'),
(34, 'Paskes 2', 'Subang', 'paskes2@gmail.com', '$2y$10$8XCs6CfwMRNYS76EXx6cceaUBzwyKAb5HzknRngCKOGaTMw4GFz5i', '0908333323', 'Petugas Kesehatan', 'Sudah', '07242023020541Paskes 2.png'),
(35, 'Donatur 1', 'Subang', 'donatur@gmail.com', '$2y$10$/JyFnAKFjS7sAPCeyD2qC.kyAAoxlzpk/r0NPQVLLLbWswqqRrE/6', '08986782321', 'Donatur', 'Sudah', '07242023021117Donatur 1.png'),
(36, 'Event 2', 'Subang', 'event2@gmail.com', '$2y$10$5CbW4EjQjF.AQAwc1MdzcOOhEcmAYYe49r2ZuorchBmMb6SgOAiZy', '089898989898', 'Event', 'Sudah', '07242023071407Event 2.png'),
(38, 'Rumah Sakit 2', 'Subang', 'rumahsakit2@gmail.com', '$2y$10$oPxNOOZIcjVOLEoKEddfaeWGOeHsnDpowXehJAO8dyY4FhD308yuu', '089898787898', 'Rumah Sakit', 'Sudah', '07242023071956Rumah Sakit 2.png');

-- --------------------------------------------------------

--
-- Table structure for table `user_donatur`
--

CREATE TABLE `user_donatur` (
  `id_user_donatur` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `kartu` enum('KTP','SIM') NOT NULL,
  `nik` varchar(30) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jk` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `gol_darah` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_donatur`
--

INSERT INTO `user_donatur` (`id_user_donatur`, `id_user`, `kartu`, `nik`, `tanggal_lahir`, `jk`, `gol_darah`) VALUES
(1, 31, 'KTP', '2222222222222222', '2001-01-23', 'Perempuan', 'A'),
(2, 32, 'SIM', '222222222222', '2001-01-29', 'Perempuan', 'A'),
(3, 35, 'KTP', '3333333333333333', '1999-12-27', 'Laki-laki', 'A'),
(5, 40, 'KTP', '3213213213213213', '2001-01-01', 'Perempuan', 'AB');

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
(1, 33, 'RS-001'),
(2, 36, 'E-002');

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
(2, 38, 'RS-0002');

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
-- Indexes for table `kuesioner_donor`
--
ALTER TABLE `kuesioner_donor`
  ADD PRIMARY KEY (`id_kuesioner`);

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
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `biodata_web`
--
ALTER TABLE `biodata_web`
  MODIFY `id_biodata_web` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `darah`
--
ALTER TABLE `darah`
  MODIFY `id_darah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `darah_buang`
--
ALTER TABLE `darah_buang`
  MODIFY `id_darah_buang` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `darah_keluar`
--
ALTER TABLE `darah_keluar`
  MODIFY `id_darah_keluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `darah_masuk`
--
ALTER TABLE `darah_masuk`
  MODIFY `id_darah_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `donor`
--
ALTER TABLE `donor`
  MODIFY `id_donor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id_event` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kuesioner_donor`
--
ALTER TABLE `kuesioner_donor`
  MODIFY `id_kuesioner` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `permohonan_darah`
--
ALTER TABLE `permohonan_darah`
  MODIFY `id_permohonan_darah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `user_donatur`
--
ALTER TABLE `user_donatur`
  MODIFY `id_user_donatur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_event`
--
ALTER TABLE `user_event`
  MODIFY `id_user_event` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_rs`
--
ALTER TABLE `user_rs`
  MODIFY `id_user_rs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
