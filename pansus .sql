-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 17, 2019 at 06:05 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pansus`
--

-- --------------------------------------------------------

--
-- Table structure for table `extra`
--

CREATE TABLE `extra` (
  `id_extra` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `body` text NOT NULL,
  `type` varchar(15) NOT NULL,
  `detail` varchar(26) DEFAULT NULL,
  `url` varchar(15) DEFAULT NULL,
  `insert_at` timestamp NULL DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `extra`
--

INSERT INTO `extra` (`id_extra`, `nama`, `body`, `type`, `detail`, `url`, `insert_at`, `update_at`) VALUES
(1, 'info', '<p>ererwe</p>', 'info', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kecukupan_gizi`
--

CREATE TABLE `kecukupan_gizi` (
  `id_kecukupan_gizi` int(11) NOT NULL,
  `kalori_minimum` varchar(10) DEFAULT NULL,
  `protein_minimum` varchar(10) DEFAULT NULL,
  `lemak_minimum` varchar(10) DEFAULT NULL,
  `karbo_minimum` varchar(10) DEFAULT NULL,
  `range_age` varchar(15) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `insert_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kecukupan_gizi`
--

INSERT INTO `kecukupan_gizi` (`id_kecukupan_gizi`, `kalori_minimum`, `protein_minimum`, `lemak_minimum`, `karbo_minimum`, `range_age`, `id_user`, `insert_at`, `updated_at`) VALUES
(2, '1900', '62', '53', '300', '8-12', 1, '2019-09-09 02:39:40', '2019-09-09 02:39:40'),
(3, '2000', '70', '53', '310', '12-15', 1, '2019-09-09 02:40:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `list_menu` text NOT NULL,
  `tanggal_menu` date NOT NULL,
  `hari_menu` varchar(15) NOT NULL,
  `status_menu` varchar(15) NOT NULL,
  `harga_menu` decimal(10,0) DEFAULT NULL,
  `detail_harga_menu` decimal(10,0) DEFAULT NULL,
  `insert_at` text,
  `updated_at` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_kecukupan_gizi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `list_menu`, `tanggal_menu`, `hari_menu`, `status_menu`, `harga_menu`, `detail_harga_menu`, `insert_at`, `updated_at`, `id_user`, `id_kecukupan_gizi`) VALUES
(5, 'a:4:{s:4:\"pagi\";a:4:{s:5:\"sayur\";a:3:{s:4:\"name\";s:4:\"sawi\";s:6:\"jumlah\";d:407.02;s:5:\"harga\";d:3663.18;}s:4:\"lauk\";a:3:{s:4:\"name\";s:10:\"Ikan Segar\";s:6:\"jumlah\";i:35;s:5:\"harga\";i:420;}s:6:\"mpokok\";a:3:{s:4:\"name\";s:5:\"Beras\";s:6:\"jumlah\";d:154.33;s:5:\"harga\";d:5247.22;}s:11:\"total_harga\";d:9330.4;}s:5:\"siang\";a:4:{s:5:\"sayur\";a:3:{s:4:\"name\";s:8:\"Kangkung\";s:6:\"jumlah\";d:500.63;s:5:\"harga\";d:5006.3;}s:4:\"lauk\";a:3:{s:4:\"name\";s:4:\"Ayam\";s:6:\"jumlah\";i:35;s:5:\"harga\";i:1190;}s:6:\"mpokok\";a:3:{s:4:\"name\";s:5:\"Beras\";s:6:\"jumlah\";d:149.36;s:5:\"harga\";d:5078.240000000001;}s:11:\"total_harga\";d:11274.54;}s:5:\"malam\";a:4:{s:5:\"sayur\";a:3:{s:4:\"name\";s:5:\"Bayam\";s:6:\"jumlah\";d:500.63;s:5:\"harga\";d:5006.3;}s:4:\"lauk\";a:3:{s:4:\"name\";s:10:\"Ikan Segar\";s:6:\"jumlah\";i:35;s:5:\"harga\";i:420;}s:6:\"mpokok\";a:3:{s:4:\"name\";s:5:\"Beras\";s:6:\"jumlah\";d:149.36;s:5:\"harga\";d:5078.240000000001;}s:11:\"total_harga\";d:6751.62;}s:9:\"total_all\";i:27355;}', '2019-09-18', 'Rabu', 'true', '27355', NULL, NULL, NULL, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `pangan`
--

CREATE TABLE `pangan` (
  `id_pangan` int(11) NOT NULL,
  `nama_pangan` varchar(255) NOT NULL,
  `type_pangan` varchar(255) NOT NULL,
  `kalori_pangan` varchar(15) NOT NULL,
  `protein_pangan` varchar(15) NOT NULL,
  `lemak_pangan` varchar(15) NOT NULL,
  `karbo_pangan` varchar(15) DEFAULT NULL,
  `harga_pangan` varchar(25) NOT NULL,
  `insert_at` timestamp NULL DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pangan`
--

INSERT INTO `pangan` (`id_pangan`, `nama_pangan`, `type_pangan`, `kalori_pangan`, `protein_pangan`, `lemak_pangan`, `karbo_pangan`, `harga_pangan`, `insert_at`, `updated_at`, `id_user`) VALUES
(4, 'Ayam', 'lauk', '3.11', '2.00', '1.12', '0', '34000', NULL, '2019-09-09 02:35:36', NULL),
(7, 'Bayam', 'sayur', '0.256', '0.025', '0.04', '0.046', '10000', NULL, NULL, 1),
(8, 'Kangkung', 'sayur', '0.203', '0.021', '0.002', '0.038', '10000', NULL, NULL, 1),
(9, 'sawi', 'sayur', '0.191', '0.021', '0.003', '0.035', '9000', NULL, NULL, 1),
(10, 'Ikan Segar', 'lauk', '0.904', '0.136', '0.036', '0', '12000', NULL, NULL, 1),
(11, 'Tempe', 'lauk', '1.490', '0.183', '0.040', '0.0127', '8000', NULL, NULL, 1),
(12, 'Beras', 'mpokok', '3.600', '0.068', '0.007', '0.789', '11000', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(15) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `level` varchar(10) DEFAULT NULL,
  `access` varchar(10) DEFAULT NULL,
  `name` varchar(25) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `insert_at` timestamp NULL DEFAULT NULL,
  `key_user` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `level`, `access`, `name`, `email`, `phone`, `insert_at`, `key_user`, `updated_at`) VALUES
(1, 'admin', 'fcea920f7412b5da7be0cf42b8c93759', 'admin', 'root', 'Zulkifli Mahardhika', 'dboyscoz@gmail.com', '83867859132', '0000-00-00 00:00:00', '', '2019-08-27 02:58:32'),
(2, 'zoelyo', 'e10adc3949ba59abbe56e057f20f883e', 'user', 'user', 'zoel', 'mahardhika894@gmail.com', '1232131231', NULL, NULL, '2019-08-27 09:05:30'),
(3, 'rojozo', '18ab4ff8faa6cd66f4bb0976139d7542', 'user', 'user', NULL, 'dboyscos12@gmail.com', NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `extra`
--
ALTER TABLE `extra`
  ADD PRIMARY KEY (`id_extra`);

--
-- Indexes for table `kecukupan_gizi`
--
ALTER TABLE `kecukupan_gizi`
  ADD PRIMARY KEY (`id_kecukupan_gizi`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `pangan`
--
ALTER TABLE `pangan`
  ADD PRIMARY KEY (`id_pangan`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `extra`
--
ALTER TABLE `extra`
  MODIFY `id_extra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kecukupan_gizi`
--
ALTER TABLE `kecukupan_gizi`
  MODIFY `id_kecukupan_gizi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pangan`
--
ALTER TABLE `pangan`
  MODIFY `id_pangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
