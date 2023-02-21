-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 20, 2023 at 11:52 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.0.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admin_mapin`
--

-- --------------------------------------------------------

--
-- Table structure for table `materi`
--

CREATE TABLE `materi` (
  `id` int(11) NOT NULL,
  `nim` varchar(25) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `alamat` varchar(25) NOT NULL,
  `fakultas` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_artikel`
--

CREATE TABLE `tbl_artikel` (
  `id_artikel` varchar(255) NOT NULL,
  `nama_artikel` varchar(255) NOT NULL,
  `img_artikel` text NOT NULL,
  `keterangan_artikel` text NOT NULL,
  `penulis_artikel` varchar(255) NOT NULL,
  `tanggal_rilis_artikel` date NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL,
  `modify_by` varchar(255) NOT NULL,
  `modify_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_artikel`
--

INSERT INTO `tbl_artikel` (`id_artikel`, `nama_artikel`, `img_artikel`, `keterangan_artikel`, `penulis_artikel`, `tanggal_rilis_artikel`, `created_by`, `created_date`, `modify_by`, `modify_date`) VALUES
('ATK-iBHKL4HFvmBWTRXHGKjq', 'muhammadiyah', 'assets/img/img_artikel_1676852009.jpg', 'berhasil', 'humam', '2023-02-20', 'USR-6916729a645d639253da', '2023-02-20 07:13:29', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bab`
--

CREATE TABLE `tbl_bab` (
  `id_bab` varchar(255) NOT NULL,
  `id_materi` varchar(255) NOT NULL,
  `no_bab` int(11) NOT NULL,
  `nama_bab` varchar(255) NOT NULL,
  `file_bab` text,
  `created_by` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL,
  `modify_by` varchar(255) DEFAULT NULL,
  `modify_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_bab`
--

INSERT INTO `tbl_bab` (`id_bab`, `id_materi`, `no_bab`, `nama_bab`, `file_bab`, `created_by`, `created_date`, `modify_by`, `modify_date`) VALUES
('BAB-tF8oBmaVnJP2xk1keO7B', 'MTR-FFSKt8iRNebI6gJDqdAA', 1, 'Sistem Klasifikasi Makhluk Hidup', 'assets/bab/file_bab_1676377113.pdf', 'USR-6916729a645d639253da', '2023-02-14 19:18:33', 'USR-6916729a645d639253da', '2023-02-14 21:11:35');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mapel`
--

CREATE TABLE `tbl_mapel` (
  `id_mapel` varchar(255) NOT NULL,
  `nama_mapel` varchar(255) NOT NULL,
  `img_mapel` text NOT NULL,
  `keterangan_mapel` text,
  `created_by` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL,
  `modify_by` varchar(255) DEFAULT NULL,
  `modify_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_mapel`
--

INSERT INTO `tbl_mapel` (`id_mapel`, `nama_mapel`, `img_mapel`, `keterangan_mapel`, `created_by`, `created_date`, `modify_by`, `modify_date`) VALUES
('MPL-Gs5XKZFsUfIz6axDLbbd', 'Biologi', 'assets/img/img_mapel_1676303615.svg', '', 'USR-6916729a645d639253da', '2023-02-13 22:53:35', NULL, NULL),
('MPL-LnRlmaVMbbF4aY6orSST', 'Kimia', 'assets/img/img_mapel_1676303410.svg', '', 'USR-6916729a645d639253da', '2023-02-13 22:50:10', NULL, NULL),
('MPL-oDRe9dapgO4rtt4hyf4g', 'Matematika', 'assets/img/img_mapel_1676303420.svg', '', 'USR-6916729a645d639253da', '2023-02-13 22:50:20', NULL, NULL),
('MPL-pWefcfpa3LTjcT4gU31n', 'Bahasa Inggris', 'assets/img/img_mapel_1676303449.svg', '', 'USR-6916729a645d639253da', '2023-02-13 22:50:49', NULL, NULL),
('MPL-SGqL4ac45Ix6KBryFEEQ', 'Bahasa Indonesia', 'assets/img/img_mapel_1676303436.svg', '', 'USR-6916729a645d639253da', '2023-02-13 22:50:36', NULL, NULL),
('MPL-SvLBRx4DDZs40NaJ14gT', 'Fisika', 'assets/img/img_mapel_1676303392.svg', '', 'USR-6916729a645d639253da', '2023-02-13 22:49:52', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_materi`
--

CREATE TABLE `tbl_materi` (
  `id_materi` varchar(255) NOT NULL,
  `id_mapel` varchar(255) NOT NULL,
  `no_materi` int(11) DEFAULT NULL,
  `nama_materi` varchar(255) NOT NULL,
  `penulis_materi` varchar(255) DEFAULT NULL,
  `tanggal_rilis_materi` date NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL,
  `modify_by` varchar(255) DEFAULT NULL,
  `modify_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_materi`
--

INSERT INTO `tbl_materi` (`id_materi`, `id_mapel`, `no_materi`, `nama_materi`, `penulis_materi`, `tanggal_rilis_materi`, `created_by`, `created_date`, `modify_by`, `modify_date`) VALUES
('MTR-DnBBZegrFTxW5KG7V1VQ', 'MPL-SGqL4ac45Ix6KBryFEEQ', 1, 'p', 'p', '2023-02-16', 'USR-6916729a645d639253da', '2023-02-16 07:45:29', NULL, NULL),
('MTR-FFSKt8iRNebI6gJDqdAA', 'MPL-Gs5XKZFsUfIz6axDLbbd', 1, 'Kualifikasi Makhluk Hidup', 'Humam', '2023-02-15', 'USR-6916729a645d639253da', '2023-02-14 16:41:22', 'USR-6916729a645d639253da', '2023-02-15 01:03:45');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_promo`
--

CREATE TABLE `tbl_promo` (
  `id_promo` varchar(255) NOT NULL,
  `nama_promo` varchar(255) NOT NULL,
  `kelas_promo` varchar(1) NOT NULL,
  `img_promo` text NOT NULL,
  `keterangan_promo` text NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL,
  `modify_by` varchar(255) NOT NULL,
  `modify_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_promo`
--

INSERT INTO `tbl_promo` (`id_promo`, `nama_promo`, `kelas_promo`, `img_promo`, `keterangan_promo`, `created_by`, `created_date`, `modify_by`, `modify_date`) VALUES
('PRM-xn39YhFVgTyk01Dg5x3O', 'Mapin Hemat', '7', 'assets/img/img_promo_1676852054.jpg', 'upload', 'USR-6916729a645d639253da', '2023-02-20 07:14:14', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_soal`
--

CREATE TABLE `tbl_soal` (
  `id_soal` varchar(255) NOT NULL,
  `id_bab` varchar(255) NOT NULL,
  `no_soal` int(11) NOT NULL,
  `pertanyaan` text NOT NULL,
  `jawaban_a` text NOT NULL,
  `jawaban_b` text,
  `jawaban_c` text,
  `jawaban_d` text,
  `jawaban_benar` varchar(1) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL,
  `modify_by` varchar(255) DEFAULT NULL,
  `modify_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` varchar(255) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `user_password` varchar(255) DEFAULT NULL,
  `user_level` varchar(255) DEFAULT NULL,
  `created_by` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL,
  `modify_by` varchar(255) DEFAULT NULL,
  `modify_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `full_name`, `user_name`, `user_password`, `user_level`, `created_by`, `created_date`, `modify_by`, `modify_date`) VALUES
('USR-6916729a645d639253da', 'Admin Mapin', 'admin', 'oX7sARRWqPeiJqsnLnQk-tko1eWOsHAKa5lqe5oH1k5ZblYaLdZ9QPX4QXHFrsxFVvkoW9diZ1zMO5H5fBm2pA', 'admin', 'USR-6916729a645d639253da', '2023-02-12 15:49:21', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `materi`
--
ALTER TABLE `materi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nim` (`nim`);

--
-- Indexes for table `tbl_bab`
--
ALTER TABLE `tbl_bab`
  ADD PRIMARY KEY (`id_bab`);

--
-- Indexes for table `tbl_mapel`
--
ALTER TABLE `tbl_mapel`
  ADD PRIMARY KEY (`id_mapel`);

--
-- Indexes for table `tbl_materi`
--
ALTER TABLE `tbl_materi`
  ADD PRIMARY KEY (`id_materi`);

--
-- Indexes for table `tbl_soal`
--
ALTER TABLE `tbl_soal`
  ADD PRIMARY KEY (`id_soal`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `materi`
--
ALTER TABLE `materi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
