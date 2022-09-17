-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 17, 2022 at 09:19 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php_uditha`
--

-- --------------------------------------------------------

--
-- Table structure for table `route`
--

CREATE TABLE `route` (
  `rid` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Active/0=Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `route`
--

INSERT INTO `route` (`rid`, `name`, `status`) VALUES
(1, 'Nittambuwa', 1),
(2, 'Ranpokunagama', 1),
(3, 'Gampaha', 1);

-- --------------------------------------------------------

--
-- Table structure for table `saller`
--

CREATE TABLE `saller` (
  `sid` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `telephone` varchar(10) NOT NULL,
  `route_id` int(11) NOT NULL,
  `join_date` date NOT NULL,
  `comment` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Active/0=Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `saller`
--

INSERT INTO `saller` (`sid`, `name`, `email`, `telephone`, `route_id`, `join_date`, `comment`, `status`) VALUES
(1, 'Perera', 'Perera@gmail.com', '071965975', 2, '2022-01-01', 'Test', 1),
(2, 'Uditha Harshana Perera', 'uditha@gmail.com', '0719651975', 2, '2022-09-05', 'Test 01', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `route`
--
ALTER TABLE `route`
  ADD PRIMARY KEY (`rid`);

--
-- Indexes for table `saller`
--
ALTER TABLE `saller`
  ADD PRIMARY KEY (`sid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `route`
--
ALTER TABLE `route`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `saller`
--
ALTER TABLE `saller`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
