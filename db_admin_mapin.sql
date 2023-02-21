-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 14 Feb 2023 pada 15.47
-- Versi Server: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Struktur dari tabel `tbl_bab`
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
-- Dumping data untuk tabel `tbl_bab`
--

INSERT INTO `tbl_bab` (`id_bab`, `id_materi`, `no_bab`, `nama_bab`, `file_bab`, `created_by`, `created_date`, `modify_by`, `modify_date`) VALUES
('BAB-tF8oBmaVnJP2xk1keO7B', 'MTR-FFSKt8iRNebI6gJDqdAA', 1, 'Sistem Klasifikasi Makhluk Hidup', 'assets/bab/file_bab_1676377113.pdf', 'USR-6916729a645d639253da', '2023-02-14 19:18:33', 'USR-6916729a645d639253da', '2023-02-14 21:11:35');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_mapel`
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
-- Dumping data untuk tabel `tbl_mapel`
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
-- Struktur dari tabel `tbl_materi`
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
-- Dumping data untuk tabel `tbl_materi`
--

INSERT INTO `tbl_materi` (`id_materi`, `id_mapel`, `no_materi`, `nama_materi`, `penulis_materi`, `tanggal_rilis_materi`, `created_by`, `created_date`, `modify_by`, `modify_date`) VALUES
('MTR-FFSKt8iRNebI6gJDqdAA', 'MPL-Gs5XKZFsUfIz6axDLbbd', 1, 'Kualifikasi Makhluk Hidup', 'Humam', '2023-02-15', 'USR-6916729a645d639253da', '2023-02-14 16:41:22', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_soal`
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

--
-- Dumping data untuk tabel `tbl_soal`
--

INSERT INTO `tbl_soal` (`id_soal`, `id_bab`, `no_soal`, `pertanyaan`, `jawaban_a`, `jawaban_b`, `jawaban_c`, `jawaban_d`, `jawaban_benar`, `created_by`, `created_date`, `modify_by`, `modify_date`) VALUES
('SOL-akhsdkajda', 'BAB-tF8oBmaVnJP2xk1keO7B', 1, 'Tujuan dari klasifikasi makhluk hidup adalah?', 'Mempermudah pengenalan makhluk hidup', 'Mempercepat pengenalan makhluk hidup', 'Memperlancar pengenalan makhluk hidup', 'Mempermulus pengenalan makhluk hidup', 'B', 'a', '2023-02-14 19:20:03', 'USR-6916729a645d639253da', '2023-02-14 21:41:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
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
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `full_name`, `user_name`, `user_password`, `user_level`, `created_by`, `created_date`, `modify_by`, `modify_date`) VALUES
('USR-6916729a645d639253da', 'Admin Mapin', 'admin', 'oX7sARRWqPeiJqsnLnQk-tko1eWOsHAKa5lqe5oH1k5ZblYaLdZ9QPX4QXHFrsxFVvkoW9diZ1zMO5H5fBm2pA', 'admin', 'USR-6916729a645d639253da', '2023-02-12 15:49:21', NULL, NULL);

--
-- Indexes for dumped tables
--

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
