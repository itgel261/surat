-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2024 at 04:38 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `surat_gel`
--

-- --------------------------------------------------------

--
-- Table structure for table `datasurat`
--

CREATE TABLE `datasurat` (
  `nomorsurat` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `divisi` varchar(255) NOT NULL,
  `tandatangan` varchar(255) NOT NULL,
  `perihal` varchar(255) NOT NULL,
  `isisurat` varchar(255) NOT NULL,
  `hasilsurat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` varchar(255) NOT NULL,
  `divisi` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `prefix` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `divisi`, `password`, `prefix`, `status`) VALUES
('1', 'TC', 'tc', 'TC', 'Aktif'),
('2', 'LEGAL', 'legal', 'LGL', 'Aktif');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `datasurat`
--
ALTER TABLE `datasurat`
  ADD PRIMARY KEY (`nomorsurat`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
