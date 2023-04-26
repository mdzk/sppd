-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 26, 2023 at 11:46 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sppd`
--

-- --------------------------------------------------------

--
-- Table structure for table `kwitansi`
--

CREATE TABLE `kwitansi` (
  `id_kwitansi` int(11) NOT NULL,
  `no_kwitansi` varchar(255) NOT NULL,
  `nominal` int(11) NOT NULL,
  `status` enum('diajukan','diterima') NOT NULL,
  `id_surat_tugas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kwitansi`
--

INSERT INTO `kwitansi` (`id_kwitansi`, `no_kwitansi`, `nominal`, `status`, `id_surat_tugas`) VALUES
(1, 'ojkasjo12jo21 Edit', 951000, 'diterima', 11),
(2, 'bbsamndb', 100000, 'diterima', 10),
(3, '9879798', 79879, 'diajukan', 8);

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nip` varchar(255) DEFAULT NULL,
  `pangkat` varchar(255) DEFAULT NULL,
  `jabatan` varchar(255) NOT NULL,
  `id_surat_tugas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nama`, `nip`, `pangkat`, `jabatan`, `id_surat_tugas`) VALUES
(3, 'Muhammad Dzaky', '324932498923', 'VII a', 'Teknisi', 8),
(7, 'Muhammad Dzaky', '324324 34 33434 ', 'Pembina / IV. a', 'Kepala Bidang Perencanaan dan Pendanaan Daerah pada Bappelitbang Kabupaten Tanggamus', 10),
(8, 'Budi Hartono', NULL, NULL, 'Pelaksana pada Bappelitbang Kabupaten Tanggamus', 10),
(9, 'Muhammad Dzaky', NULL, NULL, 'Engineer', 11);

-- --------------------------------------------------------

--
-- Table structure for table `surat_tugas`
--

CREATE TABLE `surat_tugas` (
  `id_surat_tugas` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nomor` varchar(255) NOT NULL,
  `dasar` text DEFAULT NULL,
  `status` enum('diajukan','diterima','selesai','') NOT NULL,
  `tanggal_pelaksanaan` date NOT NULL,
  `waktu` varchar(255) NOT NULL,
  `tempat` varchar(255) NOT NULL,
  `tanggal_ttd` datetime DEFAULT NULL,
  `bukti` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `surat_tugas`
--

INSERT INTO `surat_tugas` (`id_surat_tugas`, `nama`, `nomor`, `dasar`, `status`, `tanggal_pelaksanaan`, `waktu`, `tempat`, `tanggal_ttd`, `bukti`, `created_at`, `updated_at`) VALUES
(8, 'Kunjungan Pariwisata Edit', '113. 2323. /n 12 #3', NULL, 'diterima', '2023-12-31', '', 'SMA Negeri 9 Bandar Lampung', NULL, NULL, '2023-04-10 22:59:31', '2023-04-25 22:34:17'),
(10, 'Fasilitasi dan Disiminasi Capaian Implementasi Program dan Kebijakan Merdeka Belajar Tahun 2022 untuk Bappeda Provinsi dan Kabupaten/Kota', '090/12123/21/12', NULL, 'selesai', '2023-12-31', 'Pukul 08.00 WIB s.d Selesai', 'Hotel Novotel Lampung', '2023-04-26 08:38:36', '1682536498_f15ed0271bd44666d69c.jpeg', '2023-04-26 04:01:01', '2023-04-27 02:14:58'),
(11, 'Fasilitasi dan Disiminasi Capaian Implementasi Program dan Kebijakan Merdeka Belajar Tahun 2022 untuk Bappeda Provinsi dan Kabupaten/Kota', '123/2133/232/12', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin bibendum eget metus non fermentum. Vivamus ultricies eleifend bibendum. Pellentesque a dignissim lorem. Aenean pharetra ipsum sit amet arcu cursus, et maximus lorem pulvinar. Ut at nunc arcu. Vestibulum nulla sem, vulputate sit amet hendrerit et, aliquam ac mi. Morbi sed risus fringilla ligula sodales volutpat eget non risus. Cras erat massa, tristique quis suscipit eu, egestas in nisi. Quisque ac leo sit amet augue ullamcorper gravida eu quis arcu. Duis lobortis tortor vitae sapien dapibus egestas. Cras vestibulum semper quam et pharetra. Pellentesque tempor libero nec metus vestibulum lacinia. Morbi eu mauris quis sem euismod luctus id gravida enim. Sed elementum massa quis lectus faucibus dignissim. Sed eu egestas dui.', 'selesai', '2023-12-31', '23:59 s.d Selesai', 'SMA Negeri 9 Bandar Lampung', '2023-04-26 09:01:20', '1682534086_8f577654d9569c3c8900.jpeg', '2023-04-26 08:55:04', '2023-04-27 01:34:46');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_users` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin','pimpinan','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_users`, `name`, `username`, `password`, `role`) VALUES
(2, 'Muhammad Dzaky', 'admin', '$2y$10$4UDQyhiz801cUw50KR008uHU2Cgu05OyTF8w7AzggtzGF4kKXrwy2', 'admin'),
(3, 'Siti', 'user', '$2y$10$HHV8ZWFFdpbrHt9SlB4JNuGUwYW0bHNTcg389aAWsSKGlmY2A/Tde', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kwitansi`
--
ALTER TABLE `kwitansi`
  ADD PRIMARY KEY (`id_kwitansi`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indexes for table `surat_tugas`
--
ALTER TABLE `surat_tugas`
  ADD PRIMARY KEY (`id_surat_tugas`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kwitansi`
--
ALTER TABLE `kwitansi`
  MODIFY `id_kwitansi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `surat_tugas`
--
ALTER TABLE `surat_tugas`
  MODIFY `id_surat_tugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
