-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2024 at 09:43 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_saw_rekomendasi_skincare`
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
  `no_telp` varchar(20) NOT NULL,
  `file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `alternatif`
--

INSERT INTO `alternatif` (`id_alternatif`, `id_bulan`, `id_tahun`, `alternatif`, `tgl_lahir`, `alamat`, `jns_kelamin`, `no_telp`, `file`) VALUES
(1, '1', '22', 'Produk  1', '0000-00-00', '', '', '', ''),
(2, '1', '22', 'Produk  2', '0000-00-00', '', '', '', ''),
(3, '1', '22', 'Produk  3', '0000-00-00', 'tes ', 'l', '087786xxxxx', ''),
(4, '1', '22', 'Produk  4', '0000-00-00', 'test', 'l', '', ''),
(5, '1', '23', 'test 1 edit', '0000-00-00', '', '', '', ''),
(6, '1', '23', 'test 2', '0000-00-00', '', '', '', ''),
(7, '1', '23', 'test 4', '0000-00-00', '', '', '', ''),
(8, '1', '23', 'Test 5', '0000-00-00', '', '', '', ''),
(9, '2', '22', 'Produk 1', '0000-00-00', '', '', '', ''),
(10, '2', '22', 'Produk 2', '0000-00-00', '', '', '', ''),
(11, '2', '22', 'Produk 3', '0000-00-00', '', '', '', ''),
(12, '2', '22', 'Produk 4', '0000-00-00', '', '', '', ''),
(13, '2', '22', 'Produk 5', '0000-00-00', '', '', '', ''),
(14, '2', '22', 'Produk 6', '0000-00-00', '', '', '', ''),
(15, '1', '22', 'Amir', '1989-03-26', 'test upload', 'l', '089xxx', '1709786621_e271271337e7db1602e6.png');

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id_brand` int(11) NOT NULL,
  `kode_brand` varchar(11) NOT NULL,
  `nama_brand` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id_brand`, `kode_brand`, `nama_brand`) VALUES
(2, 'BR1', 'Fifi Skin Klinik');

-- --------------------------------------------------------

--
-- Table structure for table `hasil`
--

CREATE TABLE `hasil` (
  `id_hasil` int(11) NOT NULL,
  `kode_hasil` varchar(255) NOT NULL,
  `nama_produk` varchar(150) NOT NULL,
  `kode_tipekulit` varchar(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `nilai` float NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hasil`
--

INSERT INTO `hasil` (`id_hasil`, `kode_hasil`, `nama_produk`, `kode_tipekulit`, `id_kategori`, `nilai`, `status`) VALUES
(36, 'hasil-67023a4e8c8f17.93337369', 'FI TONER LIGHT ESSENCE', 'a3', 3, 76.8627, ''),
(37, 'hasil-67023a4e8c8f17.93337369', 'FI FACE TONER ND', 'a3', 3, 73.5294, ''),
(38, 'hasil-67023a4e8c8f17.93337369', 'FI FACE TONER AHA', 'a3', 3, 73.5294, ''),
(39, 'hasil-67023e4de5bf92.48836734', 'FI SKIN CONDITIONING GEL', 'a4', 5, 67.2829, ''),
(40, 'hasil-67023e4de5bf92.48836734', 'FI BPO TOTOL JERAWAT', 'a4', 5, 63.9496, ''),
(41, 'hasil-67023e4de5bf92.48836734', 'FI ACNE SPOT GEL', 'a4', 5, 63.9496, ''),
(42, 'hasil-67023e4de5bf92.48836734', 'FI STAY CLEAR ACNE NIGHT CREAM', 'a4', 5, 67.2829, '');

-- --------------------------------------------------------

--
-- Table structure for table `hasil_rekomendasi`
--

CREATE TABLE `hasil_rekomendasi` (
  `id_hasil_rekomendasi` int(11) NOT NULL,
  `id_visitor` int(11) NOT NULL,
  `id_kategori_produk` int(11) NOT NULL,
  `kode_tipekulit` varchar(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `skor_produk` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `kategori_produk`
--

CREATE TABLE `kategori_produk` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori_produk` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori_produk`
--

INSERT INTO `kategori_produk` (`id_kategori`, `nama_kategori_produk`) VALUES
(1, 'Sabun Muka'),
(2, 'Pembersih Muka'),
(3, 'Toner'),
(4, 'Serum'),
(5, 'Pelembab'),
(9, 'Tabir Surya');

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
(1, 'C1', 'Jenis Produk', 'Benefit', 20, 1),
(2, 'C2', 'Jenis Kulit', 'Benefit', 30, 1),
(3, 'C3', 'Volume', 'Benefit', 10, 1),
(4, 'C4', 'Rating', 'Benefit', 15, 1),
(6, 'C5', 'Harga', 'Cost', 25, 1);

-- --------------------------------------------------------

--
-- Table structure for table `kriteria_visitor`
--

CREATE TABLE `kriteria_visitor` (
  `id_kriteria_visitor` int(11) NOT NULL,
  `id_visitor` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `id_sub_kriteria` int(11) NOT NULL,
  `nilai_kriteria` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kriteria_visitor`
--

INSERT INTO `kriteria_visitor` (`id_kriteria_visitor`, `id_visitor`, `id_kriteria`, `id_sub_kriteria`, `nilai_kriteria`) VALUES
(1, 1, 1, 1, 85),
(2, 1, 2, 10, 60),
(3, 1, 3, 21, 45),
(4, 1, 4, 32, 85),
(5, 2, 1, 7, 30),
(6, 2, 2, 9, 80),
(7, 2, 3, 24, 60),
(8, 2, 4, 32, 85),
(9, 3, 1, 5, 45),
(10, 3, 2, 8, 100),
(11, 3, 3, 25, 65),
(12, 3, 4, 32, 85),
(13, 4, 1, 3, 65),
(14, 4, 2, 9, 80),
(15, 4, 3, 28, 80),
(16, 4, 4, 32, 85),
(17, 5, 1, 2, 70),
(18, 5, 2, 9, 80),
(19, 5, 3, 27, 75),
(20, 5, 4, 31, 50),
(21, 6, 1, 7, 30),
(22, 6, 2, 10, 60),
(23, 6, 3, 24, 60),
(24, 6, 4, 33, 100),
(25, 7, 1, 1, 85),
(26, 7, 2, 8, 100),
(27, 7, 3, 28, 80),
(28, 7, 4, 33, 100),
(29, 8, 1, 1, 85),
(30, 8, 2, 8, 100),
(31, 8, 3, 16, 20),
(32, 8, 4, 32, 85),
(33, 9, 1, 4, 50),
(34, 9, 2, 10, 60),
(35, 9, 3, 21, 45),
(36, 9, 4, 32, 85),
(37, 10, 1, 6, 35),
(38, 10, 2, 9, 80),
(39, 10, 3, 24, 60),
(40, 10, 4, 32, 85),
(41, 11, 1, 6, 35),
(42, 11, 2, 8, 100),
(43, 11, 3, 29, 95),
(44, 11, 4, 32, 85),
(45, 12, 1, 7, 30),
(46, 12, 2, 10, 60),
(47, 12, 3, 28, 80),
(48, 12, 4, 33, 100),
(49, 13, 1, 5, 45),
(50, 13, 2, 10, 60),
(51, 13, 3, 27, 75),
(52, 13, 4, 33, 100),
(53, 14, 1, 3, 65),
(54, 14, 2, 8, 100),
(55, 14, 3, 27, 75),
(56, 14, 4, 32, 85),
(57, 15, 1, 2, 70),
(58, 15, 2, 10, 60),
(59, 15, 3, 27, 75),
(60, 15, 4, 32, 85),
(61, 16, 1, 3, 65),
(62, 16, 2, 10, 60),
(63, 16, 3, 28, 80),
(64, 16, 4, 32, 85),
(65, 17, 1, 6, 35),
(66, 17, 2, 10, 60),
(67, 17, 3, 26, 70),
(68, 17, 4, 32, 85),
(69, 18, 1, 3, 65),
(70, 18, 2, 9, 80),
(71, 18, 3, 26, 70),
(72, 18, 4, 32, 85),
(73, 19, 1, 7, 30),
(74, 19, 2, 12, 20),
(75, 19, 3, 29, 95),
(76, 19, 4, 33, 100),
(77, 20, 1, 4, 50),
(78, 20, 2, 10, 60),
(79, 20, 3, 29, 95),
(80, 20, 4, 33, 100),
(81, 21, 1, 4, 50),
(82, 21, 2, 10, 60),
(83, 21, 3, 29, 95),
(84, 21, 4, 33, 100),
(85, 22, 1, 2, 70),
(86, 22, 2, 9, 80),
(87, 22, 3, 29, 95),
(88, 22, 4, 32, 85),
(89, 23, 1, 7, 30),
(90, 23, 2, 8, 100),
(91, 23, 3, 13, 5),
(92, 23, 4, 33, 100),
(93, 24, 1, 3, 70),
(94, 24, 2, 11, 60),
(95, 24, 3, 13, 25),
(96, 24, 4, 32, 85),
(97, 24, 6, 36, 60),
(98, 25, 1, 5, 65),
(99, 25, 2, 10, 70),
(100, 25, 3, 13, 25),
(101, 25, 4, 32, 85),
(102, 25, 6, 36, 60),
(103, 26, 1, 5, 65),
(104, 26, 2, 10, 70),
(105, 26, 3, 13, 25),
(106, 26, 4, 32, 85),
(107, 26, 6, 36, 60),
(108, 27, 1, 3, 70),
(109, 27, 2, 10, 70),
(110, 27, 3, 14, 60),
(111, 27, 4, 32, 85),
(112, 27, 6, 36, 60),
(113, 28, 1, 5, 65),
(114, 28, 2, 11, 60),
(115, 28, 3, 14, 60),
(116, 28, 4, 32, 85),
(117, 28, 6, 36, 60);

-- --------------------------------------------------------

--
-- Table structure for table `penilaian`
--

CREATE TABLE `penilaian` (
  `id_penilaian` int(11) NOT NULL,
  `kode_tipekulit` varchar(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `id_produk` int(10) NOT NULL,
  `id_kriteria` int(10) NOT NULL,
  `nilai` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penilaian`
--

INSERT INTO `penilaian` (`id_penilaian`, `kode_tipekulit`, `id_kategori`, `id_produk`, `id_kriteria`, `nilai`) VALUES
(174, 'a3', 3, 56, 1, 70),
(175, 'a3', 3, 56, 2, 60),
(176, 'a3', 3, 56, 3, 85),
(177, 'a3', 3, 56, 4, 60),
(178, 'a3', 3, 56, 1, 70),
(179, 'a3', 3, 56, 2, 70),
(180, 'a3', 3, 56, 3, 60),
(181, 'a3', 3, 56, 4, 85),
(182, 'a3', 3, 56, 6, 60),
(183, 'a3', 3, 65, 1, 70),
(184, 'a3', 3, 65, 2, 70),
(185, 'a3', 3, 65, 3, 60),
(186, 'a3', 3, 65, 4, 85),
(187, 'a3', 3, 65, 6, 100),
(188, 'a3', 3, 74, 1, 70),
(189, 'a3', 3, 74, 2, 70),
(190, 'a3', 3, 74, 3, 60),
(191, 'a3', 3, 74, 4, 85),
(192, 'a3', 3, 74, 6, 100),
(193, 'a3', 4, 70, 1, 85),
(194, 'a3', 4, 70, 2, 70),
(195, 'a3', 4, 70, 3, 60),
(196, 'a3', 4, 70, 4, 20),
(197, 'a3', 4, 70, 6, 20),
(198, 'a3', 4, 93, 1, 85),
(199, 'a3', 4, 93, 2, 70),
(200, 'a3', 4, 93, 3, 60),
(201, 'a3', 4, 93, 4, 85),
(202, 'a3', 4, 93, 6, 20),
(203, 'a3', 5, 1, 1, 65),
(204, 'a3', 5, 1, 2, 70),
(205, 'a3', 5, 1, 3, 25),
(206, 'a3', 5, 1, 4, 85),
(207, 'a3', 5, 1, 6, 60),
(208, 'a3', 5, 76, 1, 65),
(209, 'a3', 5, 76, 2, 70),
(210, 'a3', 5, 76, 3, 25),
(211, 'a3', 5, 76, 4, 85),
(212, 'a3', 5, 76, 6, 60),
(213, 'a3', 5, 85, 1, 65),
(214, 'a3', 5, 85, 2, 70),
(215, 'a3', 5, 85, 3, 25),
(216, 'a3', 5, 85, 4, 85),
(217, 'a3', 5, 85, 6, 100),
(218, 'a3', 5, 88, 1, 65),
(219, 'a3', 5, 88, 2, 70),
(220, 'a3', 5, 88, 3, 60),
(221, 'a3', 5, 88, 4, 85),
(222, 'a3', 5, 88, 6, 60),
(223, 'a3', 9, 53, 1, 50),
(224, 'a3', 9, 53, 2, 70),
(225, 'a3', 9, 53, 3, 25),
(226, 'a3', 9, 53, 4, 85),
(227, 'a3', 9, 53, 6, 60),
(228, 'a3', 1, 52, 1, 45),
(229, 'a3', 1, 52, 2, 70),
(230, 'a3', 1, 52, 3, 60),
(231, 'a3', 1, 52, 4, 85),
(232, 'a3', 1, 52, 6, 100),
(238, 'a4', 1, 79, 1, 45),
(239, 'a4', 1, 79, 2, 60),
(240, 'a4', 1, 79, 3, 80),
(241, 'a4', 1, 79, 4, 85),
(242, 'a4', 1, 79, 6, 60),
(243, 'a4', 1, 50, 1, 45),
(244, 'a4', 1, 50, 2, 60),
(245, 'a4', 1, 50, 3, 60),
(246, 'a4', 1, 50, 4, 85),
(247, 'a4', 1, 50, 6, 100),
(248, 'a4', 2, 80, 1, 45),
(249, 'a4', 2, 80, 2, 60),
(250, 'a4', 2, 80, 3, 80),
(251, 'a4', 2, 80, 4, 85),
(252, 'a4', 2, 80, 6, 60),
(258, 'a4', 3, 57, 1, 70),
(259, 'a4', 3, 57, 2, 60),
(260, 'a4', 3, 57, 3, 60),
(261, 'a4', 3, 57, 4, 85),
(262, 'a4', 3, 57, 6, 60),
(263, 'a4', 3, 66, 1, 70),
(264, 'a4', 3, 66, 2, 60),
(265, 'a4', 3, 66, 3, 80),
(266, 'a4', 3, 66, 4, 85),
(267, 'a4', 3, 66, 6, 100),
(268, 'a4', 3, 89, 1, 70),
(269, 'a4', 3, 89, 2, 60),
(270, 'a4', 3, 89, 3, 60),
(271, 'a4', 3, 89, 4, 85),
(272, 'a4', 3, 89, 6, 60),
(273, 'a4', 4, 72, 1, 85),
(274, 'a4', 4, 72, 2, 60),
(275, 'a4', 4, 72, 3, 25),
(276, 'a4', 4, 72, 4, 85),
(277, 'a4', 4, 72, 6, 20),
(278, 'a4', 5, 78, 1, 65),
(279, 'a4', 5, 78, 2, 60),
(280, 'a4', 5, 78, 3, 25),
(281, 'a4', 5, 78, 4, 85),
(282, 'a4', 5, 78, 6, 60),
(283, 'a4', 5, 83, 1, 65),
(284, 'a4', 5, 83, 2, 60),
(285, 'a4', 5, 83, 3, 25),
(286, 'a4', 5, 83, 4, 85),
(287, 'a4', 5, 83, 6, 100),
(288, 'a4', 5, 86, 1, 65),
(289, 'a4', 5, 86, 2, 60),
(290, 'a4', 5, 86, 3, 25),
(291, 'a4', 5, 86, 4, 85),
(292, 'a4', 5, 86, 6, 100),
(293, 'a4', 5, 92, 1, 65),
(294, 'a4', 5, 92, 2, 60),
(295, 'a4', 5, 92, 3, 25),
(296, 'a4', 5, 92, 4, 85),
(297, 'a4', 5, 92, 6, 60);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `kode_produk` varchar(11) NOT NULL,
  `nama_produk` varchar(150) NOT NULL,
  `foto_produk` varchar(255) NOT NULL,
  `id_brand` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `tipe_kulit` varchar(50) NOT NULL,
  `link_produk` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `kode_produk`, `nama_produk`, `foto_produk`, `id_brand`, `id_kategori`, `tipe_kulit`, `link_produk`, `created_at`, `update_at`) VALUES
(1, 'PR-01', 'FI MOISTFULL CREAM', '', 2, 5, 'a3', '', '2024-09-25 08:51:24', '2024-09-25 09:10:15'),
(49, 'PR-2', 'FI SUNSCREEN ASTA 5', '', 2, 9, 'a2', '', '2024-09-25 09:10:51', '2024-09-25 09:10:51'),
(50, 'PR-3', 'FI FACIAL WASH NTO', '', 2, 1, 'a4', '', '2024-09-25 09:34:46', '2024-09-25 09:35:17'),
(51, 'PR-4', 'FI SUNSCREEN WHITE SPF 50', '', 2, 9, 'a1', '', '2024-09-25 09:35:56', '2024-09-25 09:35:56'),
(52, 'PR-5', 'FI FACIAL WASH NORMAL TO DRY', '', 2, 1, 'a3', '', '2024-09-25 09:37:19', '2024-09-25 09:37:19'),
(53, 'PR-6', 'FI SUNSCREEN YELLOW SPF 50', '', 2, 9, 'a3', '', '2024-09-26 08:18:16', '2024-09-26 08:31:10'),
(54, 'PR-7', 'FI SUNSCREEN FBG', '', 2, 9, 'a5', '', '2024-09-26 08:19:01', '2024-09-26 08:19:01'),
(55, 'PR-8', 'FI ESSENTIAL SERUM', '', 2, 4, 'a1', '', '2024-09-26 08:19:37', '2024-09-26 08:20:16'),
(56, 'PR-9', 'FI TONER LIGHT ESSENCE', '', 2, 3, 'a3', '', '2024-09-26 08:20:56', '2024-09-26 08:20:56'),
(57, 'PR-10', 'FI STAY CLEAR ACNE PORE ESSENCE', '', 2, 3, 'a4', '', '2024-09-26 08:21:33', '2024-09-26 08:21:33'),
(58, 'PR-11', 'FI MINI LIFTING SERUM', '', 2, 4, 'a1', '', '2024-09-26 08:22:17', '2024-09-26 08:22:17'),
(59, 'PR-12', 'FI LIFTING SERUM', '', 2, 4, 'a1', '', '2024-09-26 08:22:48', '2024-09-26 08:22:48'),
(60, 'PR-13', 'SPOT LIGHTENING SERUM', '', 2, 4, 'a5', '', '2024-09-26 08:24:55', '2024-09-26 08:24:55'),
(61, 'PR-14', 'FI ACNE SERUM', '', 2, 4, 'a5', '', '2024-09-26 08:25:30', '2024-09-26 08:25:30'),
(62, 'PR-15', 'FI STAYCLEAR ACNE SUNSCREEN', '', 2, 9, 'a5', '', '2024-09-26 08:26:09', '2024-09-26 08:26:09'),
(63, 'PR-16', 'FI MOISTGLOW SUNSCREEN', '', 2, 9, 'a5', '', '2024-09-26 08:30:09', '2024-09-26 08:30:09'),
(64, 'PR-17', 'FI SUNSCREEN BEIGE SPF 50', '', 2, 9, 'a2', '', '2024-09-26 08:30:45', '2024-09-26 08:30:45'),
(65, 'PR-18', 'FI FACE TONER ND', '', 2, 3, 'a3', '', '2024-09-26 08:31:39', '2024-09-26 08:31:39'),
(66, 'PR-19', 'FI SKIN BALANCER TONER', '', 2, 3, 'a4', '', '2024-09-26 08:32:32', '2024-09-26 08:32:32'),
(67, 'PR-20', 'FACE TONER AA', '', 2, 3, 'a1', '', '2024-09-26 08:33:08', '2024-09-26 08:33:08'),
(68, 'PR-21', 'FI TX GLOW SERUM', '', 2, 4, 'a5', '', '2024-09-26 08:33:49', '2024-09-26 08:33:49'),
(69, 'PR-22', 'FACIAL WASH AA', '', 2, 1, 'a1', '', '2024-09-26 08:34:29', '2024-09-26 08:34:29'),
(70, 'PR-23', 'FI BIOME PROTECTION GEL SERUM', '', 2, 4, 'a3', '', '2024-09-26 08:35:01', '2024-09-26 08:35:01'),
(71, 'PR-24', 'GLOW AND BRIGHT SUNSCREEN SPRAY ', '', 2, 9, 'a1', '', '2024-09-26 08:35:38', '2024-09-26 08:35:38'),
(72, 'PR-25', 'FI GLOW UP SERUM', '', 2, 4, 'a4', '', '2024-09-26 08:36:21', '2024-09-26 08:36:21'),
(73, 'PR-26', 'FI DNA SALMON GOLD', '', 2, 4, 'a1', '', '2024-09-26 08:37:14', '2024-09-26 08:37:14'),
(74, 'PR-27', 'FI FACE TONER AHA', '', 2, 3, 'a3', '', '2024-09-26 08:42:08', '2024-09-26 08:42:08'),
(75, 'PR-28', 'FI TONER SOFT ESSENCE', '', 2, 3, 'a5', '', '2024-09-26 08:43:08', '2024-09-26 08:43:08'),
(76, 'PR-29', 'FI STAY WHITE NIGHT CREAM', '', 2, 5, 'a3', '', '2024-09-26 08:44:00', '2024-09-26 08:44:00'),
(77, 'PR-30', 'FI STAY WHITE NIGHT LOTION', '', 2, 5, 'a1', '', '2024-09-26 08:44:35', '2024-09-26 08:44:35'),
(78, 'PR-31', 'FI SKIN CONDITIONING GEL', '', 2, 5, 'a4', '', '2024-09-26 08:45:10', '2024-09-26 08:45:10'),
(79, 'PR-32', 'FI ACNE FIGHTER SCRUB', '', 2, 1, 'a4', '', '2024-09-26 08:45:46', '2024-09-26 08:45:46'),
(80, 'PR-33', 'FI MICELLAR WATER ', '', 2, 2, 'a4', '', '2024-09-26 08:46:26', '2024-09-26 08:46:26'),
(81, 'PR-34', 'FI ANTI IRITASI', '', 2, 5, 'a1', '', '2024-09-26 08:46:53', '2024-09-26 08:46:53'),
(82, 'PR-35', 'FI DAILY LOTION SPF 30', '', 2, 5, 'a1', '', '2024-09-26 08:47:23', '2024-09-26 08:47:23'),
(83, 'PR-36', 'FI BPO TOTOL JERAWAT', '', 2, 5, 'a4', '', '2024-09-26 08:48:04', '2024-09-26 08:48:04'),
(84, 'PR-37', 'FI SENSITIVE SKIN SERUM', '', 2, 4, 'a5', '', '2024-09-26 08:48:37', '2024-09-26 08:48:37'),
(85, 'PR-38', 'FI DARK SPOT GEL', '', 2, 5, 'a3', '', '2024-09-26 08:49:10', '2024-09-26 08:49:10'),
(86, 'PR-39', 'FI ACNE SPOT GEL', '', 2, 5, 'a4', '', '2024-09-26 08:49:40', '2024-09-26 08:49:40'),
(87, 'PR-40', 'FI PLATINUM EYE SERUM', '', 2, 4, 'a1', '', '2024-09-26 08:50:49', '2024-09-26 08:50:49'),
(88, 'PR-41', 'FI COLLAGEN', '', 2, 5, 'a3', '', '2024-09-26 08:51:19', '2024-09-26 08:51:19'),
(89, 'PR-42', 'FI ACNE COMPRESS', '', 2, 3, 'a4', '', '2024-09-26 08:51:53', '2024-09-26 08:51:53'),
(90, 'PR-43', 'FI RECOVERY SERUM', '', 2, 4, 'a1', '', '2024-09-26 08:52:27', '2024-09-26 08:52:27'),
(91, 'PR-44', 'FI BIOME PROTECTION GEL SERUM', '', 2, 4, 'a1', '', '2024-09-26 08:52:57', '2024-09-26 08:52:57'),
(92, 'PR-45', 'FI STAY CLEAR ACNE NIGHT CREAM', '', 2, 5, 'a4', '', '2024-09-26 08:53:30', '2024-09-26 08:53:30'),
(93, 'PR-46', 'PLATINUM BRIGHT CRYSTAL SERUM', '', 2, 4, 'a3', '', '2024-09-26 08:53:59', '2024-09-26 08:53:59'),
(94, 'PR-47', 'FI FACE TONER SS', '', 2, 3, 'a5', '', '2024-09-26 08:54:27', '2024-09-26 08:54:27'),
(95, 'PR-48', 'FI EXFOLIATING FACE SCRUB', '', 2, 2, 'a1', '', '2024-09-26 08:55:14', '2024-09-26 08:55:14'),
(96, 'PR-49', 'FI REJUVINATION SERUM', '', 2, 4, 'a2', '', '2024-09-26 08:55:48', '2024-09-26 08:56:26');

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

--
-- Dumping data for table `sub_kriteria`
--

INSERT INTO `sub_kriteria` (`id_sub_kriteria`, `id_kriteria`, `sub_kriteria`, `nilai`) VALUES
(1, 1, 'Sabun Muka', 45),
(2, 1, 'Pembersih Muka', 30),
(3, 1, 'Toner', 70),
(4, 1, 'Serum', 85),
(5, 1, 'Pelembab', 65),
(6, 1, 'Tabir Surya', 50),
(8, 2, 'Semua Jenis Kulit', 80),
(9, 2, 'Normal', 75),
(10, 2, 'Kering', 70),
(11, 2, 'Berminyak', 60),
(12, 2, 'Berjerawat', 65),
(13, 3, '5 ml - 20 ml', 25),
(14, 3, '30 ml - 60 ml', 60),
(15, 3, '100 ml', 80),
(30, 4, 'Belum Ada', 20),
(31, 4, 'Rating 1 - 3', 50),
(32, 4, 'Rating 4 - 5', 85),
(35, 6, 'Murah (50.000 – 75.000)', 100),
(36, 6, 'Mahal (80.000 – 150.000)', 60),
(37, 6, 'Sangat Mahal (>= 150.000)', 20);

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
(13, 'admin', '$2y$10$hJ2wO3pdWIjN3Ds14lwSB.1V6V3bsDS28qnKjkEilqeaPNfpq98CG', 'irwan', 'irwan@float.co.id', '1'),
(16, 'admins', '$2y$10$bWo5mG8fyBR5x.w22lmBT.ZM5VmC2umWyE.8dgMHUBxzoeW6tX5ve', 'admin', 'admin@gmail.com', '1');

-- --------------------------------------------------------

--
-- Table structure for table `visitor`
--

CREATE TABLE `visitor` (
  `id_visitor` int(11) NOT NULL,
  `nama_visitor` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `visitor`
--

INSERT INTO `visitor` (`id_visitor`, `nama_visitor`, `email`) VALUES
(1, 'Irwan', 'irwan@lua.co.id'),
(2, 'Andie', 'andie@lua.co.id'),
(3, 'test', 'test@gmail.com'),
(4, 'Api Meta Graha PT', 'irwanramadhan131@gmail.com'),
(5, 'abdi', 'adbdi@gmail.co.id'),
(6, 'syair', 'ys@g.co'),
(7, 'test', 'asdasd@gmail.com'),
(8, 'asdas', 'sdf@gmail.com'),
(9, 'irwan', 'irwan@test.co.id'),
(10, 'irwan', 'irwan@asda'),
(11, 'Ujang', 'sdf@gmail.com'),
(12, 'Raditya', 'rad@th'),
(13, 'andie', 'test@a'),
(14, 'Ujang', 'as@gmail.com'),
(15, 'Irwan', 'irwan@test.gmail'),
(16, 'ratna', 'ratna@test.com'),
(17, 'dewi', 'dewi@test.co.id'),
(18, 'test', 'irwanramadhan131@gmail.com'),
(19, 'andie', 'sd@gmail.com'),
(20, 'test s', 'tests@gmail.com'),
(21, 'test lg', 'tslg@gmail.com'),
(22, 'test lg', 'sda@gmail.com'),
(23, 'Aulia', 'aulia@gmail.com'),
(24, 'coba', 'sdsd@gfgdg.com'),
(25, 'aulia', 'aulia@gmail.com'),
(26, 'aulia', 'aulia@gmail.com'),
(27, 'Aulia', 'qwe@gmail.com'),
(28, 'coba', 'qwe@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alternatif`
--
ALTER TABLE `alternatif`
  ADD PRIMARY KEY (`id_alternatif`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id_brand`);

--
-- Indexes for table `hasil`
--
ALTER TABLE `hasil`
  ADD PRIMARY KEY (`id_hasil`);

--
-- Indexes for table `hasil_rekomendasi`
--
ALTER TABLE `hasil_rekomendasi`
  ADD PRIMARY KEY (`id_hasil_rekomendasi`);

--
-- Indexes for table `kategori_produk`
--
ALTER TABLE `kategori_produk`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `kriteria_visitor`
--
ALTER TABLE `kriteria_visitor`
  ADD PRIMARY KEY (`id_kriteria_visitor`);

--
-- Indexes for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`id_penilaian`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

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
-- Indexes for table `visitor`
--
ALTER TABLE `visitor`
  ADD PRIMARY KEY (`id_visitor`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alternatif`
--
ALTER TABLE `alternatif`
  MODIFY `id_alternatif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id_brand` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `hasil`
--
ALTER TABLE `hasil`
  MODIFY `id_hasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `hasil_rekomendasi`
--
ALTER TABLE `hasil_rekomendasi`
  MODIFY `id_hasil_rekomendasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;

--
-- AUTO_INCREMENT for table `kategori_produk`
--
ALTER TABLE `kategori_produk`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kriteria_visitor`
--
ALTER TABLE `kriteria_visitor`
  MODIFY `id_kriteria_visitor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `penilaian`
--
ALTER TABLE `penilaian`
  MODIFY `id_penilaian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=298;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  MODIFY `id_sub_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `visitor`
--
ALTER TABLE `visitor`
  MODIFY `id_visitor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
