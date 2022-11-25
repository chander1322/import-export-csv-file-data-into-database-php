-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2022 at 06:20 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `xlstodb`
--

-- --------------------------------------------------------

--
-- Table structure for table `emp_data`
--

CREATE TABLE `emp_data` (
  `id` int(11) NOT NULL,
  `First_Name` varchar(200) NOT NULL,
  `Country` varchar(2000) NOT NULL,
  `status` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `emp_data`
--

INSERT INTO `emp_data` (`id`, `First_Name`, `Country`, `status`) VALUES
(1, 'Eldon Base for stackable storage shelf, platinum', 'Muhammed MacIntyre', '1'),
(2, '1.7 Cubic Foot Compact \"Cube\" Office Refrigerators', 'Barry French', '1'),
(3, 'Cardinal Slant-D? Ring Binder, Heavy Gauge Vinyl', 'Barry French', '0'),
(4, 'R380', 'Clay Rozendal', '0'),
(5, 'Holmes HEPA Air Purifier', 'Carlos Soltero', '1'),
(6, 'G.E. Longer-Life Indoor Recessed Floodlight Bulbs', 'Carlos Soltero', '0'),
(7, 'Angle-D Binders with Locking Rings, Label Holders', 'Carl Jackson', '1'),
(8, 'SAFCO Mobile Desk Side File, Wire Frame', 'Carl Jackson', '0'),
(9, 'SAFCO Commercial Wire Shelving, Black', 'Monica Federle', '0'),
(10, 'Xerox 198', 'Dorothy Badders', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `emp_data`
--
ALTER TABLE `emp_data`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `emp_data`
--
ALTER TABLE `emp_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
