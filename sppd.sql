-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 31, 2023 at 11:50 AM
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
  `nominal` int(11) NOT NULL,
  `status_kwitansi` enum('diajukan','diterima') NOT NULL,
  `kode_rekening` varchar(255) NOT NULL,
  `uraian` varchar(255) NOT NULL,
  `sumber` varchar(255) NOT NULL,
  `id_surat_tugas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kwitansi`
--

INSERT INTO `kwitansi` (`id_kwitansi`, `nominal`, `status_kwitansi`, `kode_rekening`, `uraian`, `sumber`, `id_surat_tugas`) VALUES
(11, 1950000, 'diterima', '232.2232. 232', 'Lorem Ipsum dolor sit Amet Lorem Ipsum dolor sit Amet', 'BADAN PERENCANAAN PEMBANGUNAN PENELITIAN DAN PENGEMBANGAN KABUPATEN TANGGAMUS', 20);

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
(13, 'Muhammad Dzaky', NULL, 'IV/e', 'Direktur', 20);

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
  `tipe` enum('sekda','bupati') NOT NULL,
  `ttd_jabatan` varchar(255) NOT NULL,
  `ttd_nama` varchar(255) NOT NULL,
  `ttd_golongan` varchar(255) NOT NULL,
  `ttd_nip` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `surat_tugas`
--

INSERT INTO `surat_tugas` (`id_surat_tugas`, `nama`, `nomor`, `dasar`, `status`, `tanggal_pelaksanaan`, `waktu`, `tempat`, `tanggal_ttd`, `bukti`, `tipe`, `ttd_jabatan`, `ttd_nama`, `ttd_golongan`, `ttd_nip`, `created_at`, `updated_at`) VALUES
(20, 'Musyawarah Perencanaan Pembangunan (Musrenbang) Provinsi Lampung Tahun 2023 dalam Rangka Penyusunan RKPD Provinsi Lampung Tahun 2024', '090/23/123/2023', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus efficitur fermentum tempor. Suspendisse facilisis leo sed dapibus tincidunt. Aenean interdum felis quis quam eleifend, eu maximus ligula interdum. Vestibulum mi lectus, vulputate dignissim erat ac, fermentum sagittis ligula. Sed dictum at metus at tristique.', 'diterima', '2023-02-01', '00:02 s.d Selesai', 'Hotel Novotel', '2023-05-06 01:39:37', NULL, 'bupati', 'BUPATI TANGGAMUS SEKRETARIS DAERAH KABUPATEN', 'Mukhlis Santoso', 'Pembina Utama Madya', '1232 2323 23', '2023-05-06 01:32:46', '2023-05-06 01:39:37');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_users` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin','pimpinan','') NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_users`, `name`, `username`, `password`, `role`, `foto`) VALUES
(2, 'Muhammad Dzaky', 'admin', '$2y$10$4UDQyhiz801cUw50KR008uHU2Cgu05OyTF8w7AzggtzGF4kKXrwy2', 'admin', 'default.jpg'),
(4, 'Kasubag Umum', 'pimpinan', '$2y$10$PqQXLr7cjChaEK6L.YAykuA/0m561ZCGcSr1cnXGqMEXfLEUlYaAu', 'pimpinan', 'default.jpg'),
(7, 'Staff Sekretaris', 'user', '$2y$10$dDwuHmXfZeGZJ47OmGdXWeKwiPwOY37w6thu6.DK8vmKs6vcQBVqm', 'user', 'default.jpg');

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
  MODIFY `id_kwitansi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `surat_tugas`
--
ALTER TABLE `surat_tugas`
  MODIFY `id_surat_tugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
