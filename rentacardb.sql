-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2020 at 05:41 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rentacardb`
--

-- --------------------------------------------------------

--
-- Table structure for table `automjetet`
--

CREATE TABLE `automjetet` (
  `automjetiid` int(11) NOT NULL,
  `kategoriaid` int(11) NOT NULL,
  `emri` varchar(255) NOT NULL,
  `nr_regjistrimit` varchar(255) NOT NULL,
  `pershkrimi` text DEFAULT NULL,
  `kostoja` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `kategorite`
--

CREATE TABLE `kategorite` (
  `kategoriaid` int(11) NOT NULL,
  `emri` varchar(255) NOT NULL,
  `pershkrimi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `klientet`
--

CREATE TABLE `klientet` (
  `klientiid` int(11) NOT NULL,
  `emri` varchar(255) NOT NULL,
  `mbiemri` varchar(255) NOT NULL,
  `nr_personal` bigint(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefoni` varchar(255) NOT NULL,
  `adresa` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rezervimet`
--

CREATE TABLE `rezervimet` (
  `rezervimiid` int(11) NOT NULL,
  `klientiid` int(11) NOT NULL,
  `automjetiid` int(11) NOT NULL,
  `data_e_rezervimit` date NOT NULL,
  `data_e_marrjes` date DEFAULT NULL,
  `komente` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `automjetet`
--
ALTER TABLE `automjetet`
  ADD PRIMARY KEY (`automjetiid`),
  ADD KEY `kategoriaid` (`kategoriaid`);

--
-- Indexes for table `kategorite`
--
ALTER TABLE `kategorite`
  ADD PRIMARY KEY (`kategoriaid`);

--
-- Indexes for table `klientet`
--
ALTER TABLE `klientet`
  ADD PRIMARY KEY (`klientiid`);

--
-- Indexes for table `rezervimet`
--
ALTER TABLE `rezervimet`
  ADD PRIMARY KEY (`rezervimiid`),
  ADD KEY `klientiid` (`klientiid`),
  ADD KEY `automjetiid` (`automjetiid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `automjetet`
--
ALTER TABLE `automjetet`
  MODIFY `automjetiid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategorite`
--
ALTER TABLE `kategorite`
  MODIFY `kategoriaid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `klientet`
--
ALTER TABLE `klientet`
  MODIFY `klientiid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rezervimet`
--
ALTER TABLE `rezervimet`
  MODIFY `rezervimiid` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `automjetet`
--
ALTER TABLE `automjetet`
  ADD CONSTRAINT `automjetet_ibfk_1` FOREIGN KEY (`kategoriaid`) REFERENCES `kategorite` (`kategoriaid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rezervimet`
--
ALTER TABLE `rezervimet`
  ADD CONSTRAINT `rezervimet_ibfk_1` FOREIGN KEY (`klientiid`) REFERENCES `klientet` (`klientiid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rezervimet_ibfk_2` FOREIGN KEY (`automjetiid`) REFERENCES `automjetet` (`automjetiid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
