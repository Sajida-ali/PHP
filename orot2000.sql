-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 05, 2023 at 11:20 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `orot2000`
--

-- --------------------------------------------------------

--
-- Table structure for table `custumers`
--

DROP TABLE IF EXISTS `custumers`;
CREATE TABLE IF NOT EXISTS `custumers` (
  `id` int(11) NOT NULL,
  `password` varchar(10) NOT NULL,
  `phone` int(10) NOT NULL,
  `name` text NOT NULL,
  `order` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `custumers`
--

INSERT INTO `custumers` (`id`, `password`, `phone`, `name`, `order`) VALUES
(1234, '1234', 55, 'ahmad', NULL),
(5678, '5678', 66, 'nimer', NULL),
(9876, '9876', 77, 'shada', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lamps`
--

DROP TABLE IF EXISTS `lamps`;
CREATE TABLE IF NOT EXISTS `lamps` (
  `code` int(11) NOT NULL,
  `name` text NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(256) NOT NULL,
  PRIMARY KEY (`code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lamps`
--

INSERT INTO `lamps` (`code`, `name`, `price`, `quantity`, `image`) VALUES
(5, 'study table', 150, 147, '1675348979'),
(4, 'nightstand', 550, 37, '1675348912'),
(3, 'vintage', 680, 70, '1675348794'),
(2, 'vipia', 360, 75, '1675348664'),
(1, 'spot', 150, 36, '1675348635');

-- --------------------------------------------------------

--
-- Table structure for table `ordes`
--

DROP TABLE IF EXISTS `ordes`;
CREATE TABLE IF NOT EXISTS `ordes` (
  `total_sum` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ordes`
--

INSERT INTO `ordes` (`total_sum`, `customer_id`) VALUES
(50, 1111);

-- --------------------------------------------------------

--
-- Table structure for table `workers`
--

DROP TABLE IF EXISTS `workers`;
CREATE TABLE IF NOT EXISTS `workers` (
  `name` text NOT NULL,
  `password` varchar(10) NOT NULL,
  `phone` int(10) NOT NULL,
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `workers`
--

INSERT INTO `workers` (`name`, `password`, `phone`, `id`) VALUES
('amir', '111', 111, 111),
('shade', '222', 22, 222);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
