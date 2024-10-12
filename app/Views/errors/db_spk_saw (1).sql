-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2024 at 02:30 PM
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
-- Database: `db_spk_saw`
--

-- --------------------------------------------------------

--
-- Table structure for table `alternatif`
--

CREATE TABLE `alternatif` (
  `id_alternatif` int(11) NOT NULL,
  `id_bulan` varchar(11) NOT NULL,
  `id_tahun` varchar(11) NOT NULL,
  `alternatif` varchar(100) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `jns_kelamin` varchar(100) NOT NULL,
  `no_telp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `alternatif`
--

INSERT INTO `alternatif` (`id_alternatif`, `id_bulan`, `id_tahun`, `alternatif`, `tgl_lahir`, `alamat`, `jns_kelamin`, `no_telp`) VALUES
(1, '1', '22', 'Produk  1', '0000-00-00', '', '', ''),
(2, '1', '22', 'Produk  2', '0000-00-00', '', '', ''),
(3, '1', '22', 'Produk  3', '0000-00-00', '', '', ''),
(4, '1', '22', 'Produk  4', '0000-00-00', '', '', ''),
(5, '1', '23', 'test 1 edit', '0000-00-00', '', '', ''),
(6, '1', '23', 'test 2', '0000-00-00', '', '', ''),
(7, '1', '23', 'test 4', '0000-00-00', '', '', ''),
(8, '1', '23', 'Test 5', '0000-00-00', '', '', ''),
(9, '2', '22', 'Produk 1', '0000-00-00', '', '', ''),
(10, '2', '22', 'Produk 2', '0000-00-00', '', '', ''),
(11, '2', '22', 'Produk 3', '0000-00-00', '', '', ''),
(12, '2', '22', 'Produk 4', '0000-00-00', '', '', ''),
(13, '2', '22', 'Produk 5', '0000-00-00', '', '', ''),
(14, '2', '22', 'Produk 6', '0000-00-00', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `hasil`
--

CREATE TABLE `hasil` (
  `id_hasil` int(11) NOT NULL,
  `kode_hasil` varchar(255) NOT NULL,
  `alternatif` varchar(100) NOT NULL,
  `id_bulan` int(11) NOT NULL,
  `id_tahun` int(11) NOT NULL,
  `nilai` float NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hasil`
--

INSERT INTO `hasil` (`id_hasil`, `kode_hasil`, `alternatif`, `id_bulan`, `id_tahun`, `nilai`, `status`) VALUES
(1, 'hasil-65d6cd3268a2f1.81005679', 'Produk  1', 1, 22, 0.9125, 'Layak'),
(2, 'hasil-65d6cd3268a2f1.81005679', 'Produk  2', 1, 22, 0.878571, 'Layak'),
(3, 'hasil-65d6cd3268a2f1.81005679', 'Produk  3', 1, 22, 0.708214, 'Tidak Layak'),
(4, 'hasil-65d6cd3268a2f1.81005679', 'Produk  4', 1, 22, 0.674286, 'Tidak Layak'),
(5, 'hasil-65d6ce8d4f2705.24115896', 'test 1 edit', 1, 23, 0.737143, 'Tidak Layak'),
(6, 'hasil-65d6ce8d4f2705.24115896', 'test 2', 1, 23, 0.935714, 'Layak'),
(7, 'hasil-65d6ce8d4f2705.24115896', 'test 4', 1, 23, 0.757143, 'Tidak Layak'),
(8, 'hasil-65d6ce8d4f2705.24115896', 'Test 5', 1, 23, 0.751429, 'Tidak Layak'),
(9, 'hasil-65d6d0179b8aa1.11964938', 'Produk 1', 2, 22, 0.514286, 'Tidak Layak'),
(10, 'hasil-65d6d0179b8aa1.11964938', 'Produk 2', 2, 22, 0.914286, 'Layak'),
(11, 'hasil-65d6d0179b8aa1.11964938', 'Produk 3', 2, 22, 0.714286, 'Tidak Layak'),
(12, 'hasil-65d6d0179b8aa1.11964938', 'Produk 4', 2, 22, 0.633929, 'Tidak Layak'),
(13, 'hasil-65d6d0179b8aa1.11964938', 'Produk 5', 2, 22, 0.728571, 'Tidak Layak'),
(14, 'hasil-65d6d0179b8aa1.11964938', 'Produk 6', 2, 22, 0.692857, 'Tidak Layak');

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `kode_kriteria` varchar(10) NOT NULL,
  `kriteria` varchar(50) NOT NULL,
  `type` enum('Benefit','Cost') NOT NULL,
  `bobot` float NOT NULL,
  `ada_pilihan` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `kode_kriteria`, `kriteria`, `type`, `bobot`, `ada_pilihan`) VALUES
(1, 'C1', 'Daya Tahan', 'Benefit', 0.2, 0),
(2, 'C2', 'Umur', 'Benefit', 0.3, 0),
(3, 'C3', 'Harga', 'Cost', 0.35, 0),
(4, 'C4', 'Layanan Purna Jual', 'Benefit', 0.15, 0);

-- --------------------------------------------------------

--
-- Table structure for table `penilaian`
--

CREATE TABLE `penilaian` (
  `id_penilaian` int(11) NOT NULL,
  `id_alternatif` int(10) NOT NULL,
  `id_kriteria` int(10) NOT NULL,
  `nilai` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penilaian`
--

INSERT INTO `penilaian` (`id_penilaian`, `id_alternatif`, `id_kriteria`, `nilai`) VALUES
(1, 1, 1, 5),
(2, 1, 2, 5),
(3, 1, 3, 4),
(4, 1, 4, 7),
(5, 2, 1, 4),
(6, 2, 2, 4),
(7, 2, 3, 3),
(8, 2, 4, 6),
(9, 3, 1, 3),
(10, 3, 2, 4),
(11, 3, 3, 4),
(12, 3, 4, 4),
(13, 4, 1, 2),
(14, 4, 2, 3),
(15, 4, 3, 3),
(16, 4, 4, 3),
(17, 5, 1, 4),
(18, 5, 2, 2),
(19, 5, 3, 3),
(20, 5, 4, 5),
(21, 6, 1, 5),
(22, 6, 2, 5),
(23, 6, 3, 3),
(24, 6, 4, 4),
(25, 7, 1, 3),
(26, 7, 2, 3),
(27, 7, 3, 3),
(28, 7, 4, 5),
(29, 8, 1, 5),
(30, 8, 2, 3),
(31, 8, 3, 3),
(32, 8, 4, 1),
(33, 9, 1, 3),
(34, 9, 2, 4),
(35, 9, 3, 7),
(36, 9, 4, 5),
(37, 10, 1, 7),
(38, 10, 2, 7),
(39, 10, 3, 3),
(40, 10, 4, 3),
(41, 11, 1, 6),
(42, 11, 2, 3),
(43, 11, 3, 3),
(44, 11, 4, 3),
(45, 12, 1, 4),
(46, 12, 2, 4),
(47, 12, 3, 4),
(48, 12, 4, 4),
(49, 13, 1, 5),
(50, 13, 2, 4),
(51, 13, 3, 3),
(52, 13, 4, 3),
(53, 14, 1, 3),
(54, 14, 2, 3),
(55, 14, 3, 3),
(56, 14, 4, 6);

-- --------------------------------------------------------

--
-- Table structure for table `sub_kriteria`
--

CREATE TABLE `sub_kriteria` (
  `id_sub_kriteria` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `sub_kriteria` varchar(50) NOT NULL,
  `nilai` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(5) NOT NULL,
  `username` varchar(16) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(70) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `role` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `email`, `role`) VALUES
(13, 'admin', '$2y$10$SzY9i.Q7JhkQ0ZfMpB13xeoany9nNk1YlXm8QnRTzhRMBIWpywhzm', 'tet', 'tet@as', '1'),
(14, 'adelia', '$2y$10$Vh7KYcb5HiuJehSSdy8/rOYFNnDGlUU0ZmHKOisrBMTauNE0MSZmG', 'adel', 'adelia@irwan.co.id', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alternatif`
--
ALTER TABLE `alternatif`
  ADD PRIMARY KEY (`id_alternatif`);

--
-- Indexes for table `hasil`
--
ALTER TABLE `hasil`
  ADD PRIMARY KEY (`id_hasil`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`id_penilaian`);

--
-- Indexes for table `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  ADD PRIMARY KEY (`id_sub_kriteria`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alternatif`
--
ALTER TABLE `alternatif`
  MODIFY `id_alternatif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `hasil`
--
ALTER TABLE `hasil`
  MODIFY `id_hasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `penilaian`
--
ALTER TABLE `penilaian`
  MODIFY `id_penilaian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  MODIFY `id_sub_kriteria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
