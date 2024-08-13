-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 13, 2024 at 09:08 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aplikasi_kasir`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `ID_Barang` int(11) NOT NULL,
  `NamaBarang` varchar(30) NOT NULL,
  `Satuan` char(20) NOT NULL,
  `HargaSatuan` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`ID_Barang`, `NamaBarang`, `Satuan`, `HargaSatuan`) VALUES
(3671, 'Indomie Ayam Bawang', 'bungkus', 2500),
(3672, 'Gula', 'Kg', 12000);

-- --------------------------------------------------------

--
-- Table structure for table `detail_penjualan`
--

CREATE TABLE `detail_penjualan` (
  `ID_Penjualan` int(11) NOT NULL,
  `ID_Barang` int(11) NOT NULL,
  `Kuantitas` smallint(6) NOT NULL,
  `HargaSatuan` float NOT NULL,
  `Sub_total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_penjualan`
--

INSERT INTO `detail_penjualan` (`ID_Penjualan`, `ID_Barang`, `Kuantitas`, `HargaSatuan`, `Sub_total`) VALUES
(1, 3672, 1, 1234, 2);

-- --------------------------------------------------------

--
-- Table structure for table `kasir`
--

CREATE TABLE `kasir` (
  `ID_Kasir` int(11) NOT NULL,
  `Username` char(10) NOT NULL,
  `NamaKasir` varchar(30) NOT NULL,
  `Alamat` varchar(100) NOT NULL,
  `NomorHP` char(15) NOT NULL,
  `NomorKTP` char(20) NOT NULL,
  `Password` char(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kasir`
--

INSERT INTO `kasir` (`ID_Kasir`, `Username`, `NamaKasir`, `Alamat`, `NomorHP`, `NomorKTP`, `Password`) VALUES
(1010, 'Budi', 'Budi Maryadi', 'Tangerang', '085616126121', '56745674567', 'c7911af3adbd12a035b289556d96470a'),
(1017, 'admin', 'Nabila Khairunnisa', 'Bojong Indah', '0812345678', '3201101111100', '21232f297a57a5a743894a0e4a801fc3'),
(1020, 'zikri', 'Zikri', 'Parung', '1235', '8730518', '61243c7b9a4022cb3f8dc3106767ed12');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `ID_Penjualan` int(11) NOT NULL,
  `WaktuTransaksi` datetime NOT NULL,
  `Total` float NOT NULL,
  `ID_Shift` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`ID_Penjualan`, `WaktuTransaksi`, `Total`, `ID_Shift`) VALUES
(1, '2024-08-12 16:28:00', 400000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `shift`
--

CREATE TABLE `shift` (
  `ID_Shift` int(11) NOT NULL,
  `ID_Kasir` int(11) NOT NULL,
  `WaktuBuka` datetime NOT NULL,
  `SaldoAwal` double NOT NULL,
  `JumlahPenjualan` double NOT NULL,
  `SaldoAkhir` double NOT NULL,
  `WaktuTutup` datetime NOT NULL,
  `Status` char(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shift`
--

INSERT INTO `shift` (`ID_Shift`, `ID_Kasir`, `WaktuBuka`, `SaldoAwal`, `JumlahPenjualan`, `SaldoAkhir`, `WaktuTutup`, `Status`) VALUES
(1, 1010, '2024-08-12 00:00:00', 10000, 5, 90000, '2024-08-12 23:59:00', 'CLOSE'),
(2, 1017, '2024-08-11 15:38:00', 5000, 10, 1000000, '2024-08-11 15:38:00', 'OPEN');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`ID_Barang`);

--
-- Indexes for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD UNIQUE KEY `ID_Penjualan` (`ID_Penjualan`),
  ADD UNIQUE KEY `ID_Barang` (`ID_Barang`);

--
-- Indexes for table `kasir`
--
ALTER TABLE `kasir`
  ADD PRIMARY KEY (`ID_Kasir`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`ID_Penjualan`),
  ADD UNIQUE KEY `ID_Shift` (`ID_Shift`);

--
-- Indexes for table `shift`
--
ALTER TABLE `shift`
  ADD PRIMARY KEY (`ID_Shift`),
  ADD UNIQUE KEY `ID_Kasir_2` (`ID_Kasir`),
  ADD KEY `ID_Kasir` (`ID_Kasir`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `ID_Barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3676;

--
-- AUTO_INCREMENT for table `kasir`
--
ALTER TABLE `kasir`
  MODIFY `ID_Kasir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1023;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `ID_Penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `shift`
--
ALTER TABLE `shift`
  MODIFY `ID_Shift` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD CONSTRAINT `detail_penjualan_ibfk_1` FOREIGN KEY (`ID_Barang`) REFERENCES `barang` (`ID_Barang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_penjualan_ibfk_2` FOREIGN KEY (`ID_Penjualan`) REFERENCES `penjualan` (`ID_Penjualan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `penjualan_ibfk_1` FOREIGN KEY (`ID_Shift`) REFERENCES `shift` (`ID_Shift`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `shift`
--
ALTER TABLE `shift`
  ADD CONSTRAINT `shift_ibfk_1` FOREIGN KEY (`ID_Kasir`) REFERENCES `kasir` (`ID_Kasir`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
