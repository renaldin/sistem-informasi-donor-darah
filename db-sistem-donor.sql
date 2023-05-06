-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2023 at 12:46 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.0.19

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
-- Table structure for table `biodata_web`
--

CREATE TABLE `biodata_web` (
  `id_biodata_web` int(11) NOT NULL,
  `nama_website` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nomor_telepon` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `logo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `biodata_web`
--

INSERT INTO `biodata_web` (`id_biodata_web`, `nama_website`, `email`, `nomor_telepon`, `alamat`, `logo`) VALUES
(1, 'Sistem Donor', 'sistembookingbillboard@gmail.com', '(123) 123-456', 'Jalan Srigunting Raya Nomor 1 Bandung', '04202023074227.png');

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
  `tanggal_pengajuan` date DEFAULT NULL,
  `status_pengajuan` enum('Menunggu Persetujuan','Disetujui','Tidak Disetujui','Belum Dikirim') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id_event`, `id_user`, `nama_instansi`, `alamat_lengkap`, `tanggal_event`, `jam`, `jumlah_orang`, `upload_surat`, `tanggal_pengajuan`, `status_pengajuan`) VALUES
(1, 7, 'Politeknik Negeri Subang', 'Cibogo', '2023-06-02', '12:30', 5, '05062023102743 Politeknik Negeri Subang.pdf', '2023-05-06', 'Belum Dikirim');

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
  `role` enum('Admin','Donatur','Rumah Sakit','Event','Petugas Kesehatan','Pusat PMI') NOT NULL,
  `foto` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `email`, `password`, `nomor_telepon`, `role`, `foto`) VALUES
(1, 'Admin Sistem', 'admin122@gmail.com', '$2y$10$FOLMcTQ.ZQmG4XkXHemNkuvTur77scCIzvFMyQyRV9SdbHXGYN0iy', '08989786444', 'Admin', NULL),
(2, 'Admin Sistem Donor', 'admin@gmail.com', '$2y$10$smeipeg7V7MdF0BNmGaVduxOyL9ugB0d9s8kAYH0ABF./QqXZDzfW', '0896775651', 'Admin', '05062023024216Admin Sistem Donor.png'),
(5, 'Renaldi Noviandi', 'renaldinoviandi0@gmail.com', '$2y$10$CfofXEParDaLa28vB2/i9uxG0Z8ywPKJycZ9pBYn/vSYeZ6fd4e9a', '08989786444', 'Donatur', NULL),
(6, 'Teresia Purba', 'renaldinoviandi9@gmail.com', '$2y$10$QnxqGS7U4ncQsXAIff9.Oe5WdsjNV1CUxmR4QAmnKglZ6fysF3QRy', '08989784353', 'Donatur', '05062023011528Teresia Purba.png'),
(7, 'Event', 'event@gmail.com', '$2y$10$Mfd7GStgY7g9C2ykYfYkNelJEKrv4x.tilybL3iHTgPtqiP3YyLpm', '08989784353', 'Event', '05062023014106Event.png'),
(8, 'Petugas Kesehatan', 'pasker@gmail.com', '$2y$10$efC/qal7R6LOIzriA0edce5C3JDCypRJwtmUEhgddXHtX6NeEFSRC', '08989784353', 'Petugas Kesehatan', '05062023014318Petugas Kesehatan.png'),
(9, 'Rumah Sakit', 'rumahsakit@gmail.com', '$2y$10$V2B.NKXJKtWyPfKXmHBf2.3KlVE7.fEFOhNE1tE0cwlkrJkBf5ITW', '08989784353', 'Rumah Sakit', '05062023014538Rumah Sakit.png'),
(10, 'Pusat PMI', 'pusatpmi@gmail.com', '$2y$10$VGcpnvPkcrl.trf3NIYp5.EbGumotuG1j2iBXEIXyjQ/W328BxpSi', '08989784353', 'Pusat PMI', '05062023014618Pusat PMI.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `biodata_web`
--
ALTER TABLE `biodata_web`
  ADD PRIMARY KEY (`id_biodata_web`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id_event`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `biodata_web`
--
ALTER TABLE `biodata_web`
  MODIFY `id_biodata_web` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id_event` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
