-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2024 at 06:51 AM
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
  `nama_kategori` varchar(50) NOT NULL,
  `jenis` enum('masuk','keluar','permohonan') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_kategori_surat`
--

INSERT INTO `t_kategori_surat` (`id_kategori`, `nama_kategori`, `jenis`) VALUES
(1, 'Permohonan Izin Penelitian Tugas Akhir', 'permohonan');

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
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_sample_surat`
--

INSERT INTO `t_sample_surat` (`id_sample_surat`, `nama_surat`, `id_kategori`, `kode_fak`, `format_nomor`, `kop_surat`, `template`, `params`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Permohonan Izin Penelitian Tugas Akhir', 1, 6, '6/FT/-UNMA/I/2023', 'dc0762e0cb0b628b8cf6b14f527504aa.png', '<div>Majalengka, [4]<br>Nomor     : [1]<br>Lampiran  : [3]<br>Hal            : [2]<br><br>Kepada Yth.<br><strong>[5]<br></strong>di<br>      <strong>Tempat<br></strong><br>Dengan Hormat,<br>Berkenan dengan kegiatan Tugas Akhir salah satu mahasiswa kami dengan Judul : \" [6] \", oleh karena itu mohon kiranya dapat mengizinkan yang bersangkutan untuk keperluan penelitian dan pengambilan data di [10] guna menyelesaikan Tugas Akhir, Adapun mahasiswa yang akan melakukan penelitian yaitu :<br>        Nama                      : [7]<br>        NPM                        : [8]<br>        Program Studi         : [9]<br>        Waktu Pelaksanaan : [11]<br>         Demikian surat ini kami sampaikan, Atas kebijaksanaan Bapak/Ibu pimpinan serta kerja sama yang baik, kami ucapkan terima kasih.</div>', '[1]#Nomor#sesuai_format|[2]#Hal#nama_surat|[3]#Lampiran#-|[4]#Tanggal#tanggal_surat|[5]#Kepada#input_by_mhs|[6]#Judul Tugas Akhir#input_by_mhs|[7]#Nama Mahasiswa#input_by_mhs|[8]#NPM#input_by_mhs|[9]#Progam Studi#input_by_mhs|[10]#Lokasi Penelitian#input_by_mhs|[11]#Waktu Pelaksanaan#input_by_mhs|', 'tatausaha', 'tatausaha', '2024-04-11 09:39:26', '2024-04-11 09:39:26');

-- --------------------------------------------------------

--
-- Table structure for table `t_surat_keluar`
--

CREATE TABLE `t_surat_keluar` (
  `id_surat_keluar` int(11) NOT NULL,
  `id_sample_surat` int(11) NOT NULL,
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
(5, 1, '2024-03-19', '4', '4', '4', 'mpdf3.pdf', 'mpdf4.pdf', 'mpdf5.pdf', '4', '', '2024-03-19 21:28:19', '2024-03-19 21:28:19', 'admin', 'admin'),
(6, 1, '2024-03-31', '5', '5', '5', 'mpdf6.pdf', 'mpdf7.pdf', 'mpdf8.pdf', '5', NULL, '2024-03-31 13:38:26', '2024-03-31 13:38:26', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `t_surat_permohonan`
--

CREATE TABLE `t_surat_permohonan` (
  `id_sp` int(11) NOT NULL,
  `id_sample_surat` int(11) NOT NULL,
  `tgl_permohonan` date NOT NULL,
  `username` varchar(50) NOT NULL,
  `no_sp` varchar(50) DEFAULT NULL,
  `value_sp` text DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `approve1` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `t_user`
--

CREATE TABLE `t_user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` int(11) NOT NULL,
  `kode_fak` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_user`
--

INSERT INTO `t_user` (`id`, `username`, `password`, `level`, `kode_fak`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, 0),
(2, 'tatausaha', '82849c85acf1f4e6e4eec748f0aeddf4', 2, 6),
(3, '20.14.1.0011', '9ca22081408ff00fab842543c4e1c3f1', 3, 6);

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
  ADD PRIMARY KEY (`id_surat_keluar`),
  ADD KEY `id_smpl_surat` (`id_sample_surat`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `t_surat_masuk`
--
ALTER TABLE `t_surat_masuk`
  ADD PRIMARY KEY (`id_surat_masuk`);

--
-- Indexes for table `t_surat_permohonan`
--
ALTER TABLE `t_surat_permohonan`
  ADD PRIMARY KEY (`id_sp`),
  ADD KEY `id_sample` (`id_sample_surat`),
  ADD KEY `username` (`username`);

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
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `t_sample_surat`
--
ALTER TABLE `t_sample_surat`
  MODIFY `id_sample_surat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `t_surat_keluar`
--
ALTER TABLE `t_surat_keluar`
  MODIFY `id_surat_keluar` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_surat_masuk`
--
ALTER TABLE `t_surat_masuk`
  MODIFY `id_surat_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `t_surat_permohonan`
--
ALTER TABLE `t_surat_permohonan`
  MODIFY `id_sp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `t_user`
--
ALTER TABLE `t_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
