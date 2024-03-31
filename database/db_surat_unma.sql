-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2024 at 06:38 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_surat_unma`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_kategori_surat`
--

CREATE TABLE `t_kategori_surat` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_kategori_surat`
--

INSERT INTO `t_kategori_surat` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Surat Izin Penelitian');

-- --------------------------------------------------------

--
-- Table structure for table `t_sample_surat`
--

CREATE TABLE `t_sample_surat` (
  `id_sample_surat` int(11) NOT NULL,
  `nama_surat` varchar(50) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `kode_fak` int(11) NOT NULL,
  `format_nomor` varchar(50) DEFAULT NULL,
  `kop_surat` varchar(255) DEFAULT NULL,
  `template` text NOT NULL,
  `params` text NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `updated_by` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `update_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_sample_surat`
--

INSERT INTO `t_sample_surat` (`id_sample_surat`, `nama_surat`, `id_kategori`, `kode_fak`, `format_nomor`, `kop_surat`, `template`, `params`, `created_by`, `updated_by`, `created_at`, `update_at`) VALUES
(1, 'Surat Izin Penelitian', 1, 6, NULL, NULL, '', '', 'admin', 'admin', '2024-03-24 00:00:00', '2024-03-24 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `t_surat_keluar`
--

CREATE TABLE `t_surat_keluar` (
  `id_surat_keluar` int(11) NOT NULL,
  `id_smpl_surat` int(11) NOT NULL,
  `no_surat_keluar` varchar(50) NOT NULL,
  `isi_surat` text NOT NULL,
  `dokumen` varchar(255) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `approve1` int(1) NOT NULL DEFAULT 0,
  `approve2` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `t_surat_masuk`
--

CREATE TABLE `t_surat_masuk` (
  `id_surat_masuk` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `tgl_masuk` date DEFAULT NULL,
  `pengirim` varchar(50) NOT NULL,
  `nomor` varchar(50) NOT NULL,
  `perihal` varchar(50) NOT NULL,
  `file_surat` varchar(255) NOT NULL,
  `lampiran` varchar(255) DEFAULT NULL,
  `berkas` varchar(255) DEFAULT NULL,
  `tindakan` varchar(100) DEFAULT NULL,
  `kode_fak` varchar(15) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `updated_by` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_surat_masuk`
--

INSERT INTO `t_surat_masuk` (`id_surat_masuk`, `id_kategori`, `tgl_masuk`, `pengirim`, `nomor`, `perihal`, `file_surat`, `lampiran`, `berkas`, `tindakan`, `kode_fak`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(4, 1, '2024-03-19', '3', '3', '3', 'mpdf.pdf', 'mpdf1.pdf', 'mpdf2.pdf', '3', '', '2024-03-19 21:25:38', '2024-03-19 21:25:38', 'admin', 'admin'),
(5, 1, '2024-03-19', '4', '4', '4', 'mpdf3.pdf', 'mpdf4.pdf', 'mpdf5.pdf', '4', '', '2024-03-19 21:28:19', '2024-03-19 21:28:19', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `t_user`
--

CREATE TABLE `t_user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_user`
--

INSERT INTO `t_user` (`id`, `username`, `password`, `level`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1),
(2, 'tatausaha', '82849c85acf1f4e6e4eec748f0aeddf4', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_kategori_surat`
--
ALTER TABLE `t_kategori_surat`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `t_sample_surat`
--
ALTER TABLE `t_sample_surat`
  ADD PRIMARY KEY (`id_sample_surat`);

--
-- Indexes for table `t_surat_keluar`
--
ALTER TABLE `t_surat_keluar`
  ADD PRIMARY KEY (`id_surat_keluar`);

--
-- Indexes for table `t_surat_masuk`
--
ALTER TABLE `t_surat_masuk`
  ADD PRIMARY KEY (`id_surat_masuk`);

--
-- Indexes for table `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_kategori_surat`
--
ALTER TABLE `t_kategori_surat`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t_sample_surat`
--
ALTER TABLE `t_sample_surat`
  MODIFY `id_sample_surat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t_surat_keluar`
--
ALTER TABLE `t_surat_keluar`
  MODIFY `id_surat_keluar` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_surat_masuk`
--
ALTER TABLE `t_surat_masuk`
  MODIFY `id_surat_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `t_user`
--
ALTER TABLE `t_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
