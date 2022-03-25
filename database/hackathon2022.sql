-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2022 at 05:34 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hackathon2022`
--

-- --------------------------------------------------------

--
-- Table structure for table `action`
--

CREATE TABLE `action` (
  `id` int(12) NOT NULL,
  `device` int(11) NOT NULL,
  `action` enum('ON','OFF') NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `action`
--

INSERT INTO `action` (`id`, `device`, `action`, `datetime`) VALUES
(2, 5, 'ON', '2022-03-16 17:50:40'),
(3, 5, 'OFF', '2022-03-16 17:50:43'),
(4, 5, 'ON', '2022-03-24 17:55:54'),
(5, 5, 'OFF', '2022-03-24 17:55:59'),
(6, 5, 'ON', '2022-03-24 18:51:47'),
(7, 5, 'OFF', '2022-03-24 18:51:51'),
(8, 5, 'ON', '2022-03-24 18:53:44'),
(9, 5, 'OFF', '2022-03-24 18:53:47'),
(10, 5, 'ON', '2022-03-24 18:54:31'),
(11, 5, 'OFF', '2022-03-24 18:54:33'),
(12, 5, 'ON', '2022-03-24 19:10:44'),
(13, 5, 'OFF', '2022-03-24 19:10:46'),
(14, 5, 'ON', '2022-03-24 19:15:18'),
(15, 5, 'OFF', '2022-03-24 19:15:30'),
(16, 5, 'ON', '2022-03-24 19:16:30'),
(17, 5, 'OFF', '2022-03-24 19:16:35'),
(18, 5, 'ON', '2022-03-24 19:22:02'),
(19, 5, 'OFF', '2022-03-24 19:35:41'),
(20, 7, 'ON', '2022-03-24 19:43:11'),
(21, 7, 'OFF', '2022-03-24 19:43:14'),
(22, 5, 'ON', '2022-03-24 20:14:41'),
(23, 5, 'OFF', '2022-03-24 20:14:44'),
(24, 7, 'ON', '2022-03-24 20:16:07'),
(25, 7, 'OFF', '2022-03-24 20:16:09'),
(26, 8, 'ON', '2022-03-24 20:17:40'),
(27, 8, 'OFF', '2022-03-24 20:17:41'),
(28, 5, 'ON', '2022-03-24 20:23:32'),
(29, 5, 'OFF', '2022-03-24 20:30:22'),
(30, 5, 'ON', '2022-03-24 21:38:42'),
(31, 7, 'ON', '2022-03-24 21:38:49'),
(32, 8, 'ON', '2022-03-24 21:38:51'),
(33, 5, 'OFF', '2022-03-24 23:19:13'),
(34, 7, 'OFF', '2022-03-24 23:19:16'),
(35, 8, 'OFF', '2022-03-24 23:19:18'),
(36, 5, 'ON', '2022-03-24 23:19:40'),
(37, 7, 'ON', '2022-03-24 23:19:42'),
(38, 5, 'OFF', '2022-03-25 00:02:04'),
(39, 7, 'OFF', '2022-03-25 00:02:05'),
(40, 5, 'ON', '2022-03-25 00:02:26'),
(41, 7, 'ON', '2022-03-25 00:02:29'),
(42, 5, 'OFF', '2022-03-25 00:33:31'),
(43, 7, 'OFF', '2022-03-25 00:33:34'),
(44, 7, 'ON', '2022-03-25 00:47:35'),
(45, 5, 'ON', '2022-03-25 00:47:38'),
(46, 5, 'OFF', '2022-03-25 00:52:52'),
(47, 7, 'OFF', '2022-03-25 00:53:29'),
(48, 5, 'ON', '2022-03-25 01:07:05'),
(49, 7, 'ON', '2022-03-25 01:07:09'),
(50, 9, 'ON', '2022-03-25 10:54:00');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(1) NOT NULL,
  `username` varchar(50) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `first_name`, `last_name`, `password`) VALUES
(1, 'kurtchan', 'Kurt', 'De Austria', '40447ea943c73f8aa70073cda95fe8a8');

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int(4) NOT NULL,
  `name` varchar(100) NOT NULL,
  `device_type` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `name`, `device_type`) VALUES
(1, 'Condura', 1),
(2, 'Carrier', 1),
(3, 'Dowell', 1),
(4, 'Sony', 5);

-- --------------------------------------------------------

--
-- Table structure for table `device`
--

CREATE TABLE `device` (
  `id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `device_type` int(4) NOT NULL,
  `brand` int(4) NOT NULL,
  `model` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `device`
--

INSERT INTO `device` (`id`, `owner_id`, `name`, `device_type`, `brand`, `model`) VALUES
(5, 1, 'Bedroom Aircon', 1, 1, '3'),
(7, 1, 'Living Room Aircon', 1, 1, '4'),
(8, 2, 'test', 1, 1, '3'),
(9, 1, 'Television', 5, 4, '5');

-- --------------------------------------------------------

--
-- Table structure for table `device_type`
--

CREATE TABLE `device_type` (
  `id` int(4) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `device_type`
--

INSERT INTO `device_type` (`id`, `name`) VALUES
(1, 'Air-conditioner'),
(2, 'Refrigerator'),
(3, 'Fan'),
(4, 'Lighting'),
(5, 'Television');

-- --------------------------------------------------------

--
-- Table structure for table `model`
--

CREATE TABLE `model` (
  `id` int(11) NOT NULL,
  `device_type` int(4) NOT NULL,
  `brand` int(4) NOT NULL,
  `model` varchar(50) NOT NULL,
  `average_consumption` decimal(8,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `model`
--

INSERT INTO `model` (`id`, `device_type`, `brand`, `model`, `average_consumption`) VALUES
(3, 1, 1, 'WCONZ006EC', '0.2542'),
(4, 1, 1, 'WCONX010EC1', '0.5353'),
(5, 5, 4, 'SDHFSADJF', '0.3560');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `email`, `password`) VALUES
(1, 'Laurence', 'Cortez', 'laurence@gmail.com', '40447ea943c73f8aa70073cda95fe8a8');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `action`
--
ALTER TABLE `action`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `device`
--
ALTER TABLE `device`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `device_type`
--
ALTER TABLE `device_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model`
--
ALTER TABLE `model`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `action`
--
ALTER TABLE `action`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `device`
--
ALTER TABLE `device`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `device_type`
--
ALTER TABLE `device_type`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `model`
--
ALTER TABLE `model`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
