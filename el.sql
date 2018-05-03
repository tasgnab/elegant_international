-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2018 at 04:33 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `el`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('omr61ndg3jfod3bhfktog719ih10gj3n', '::1', 1525111192, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532353131313035373b),
('tjaf27aipbl0cgqdi30vothscronundn', '::1', 1525111226, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532353131313139393b),
('m47ssag2a4r5p8f7hlq36d2oqhrgqn44', '::1', 1525111494, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532353131313233363b),
('jf320ucjkekberp4rvueu70uerr9iq4i', '::1', 1525111644, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532353131313531363b);

-- --------------------------------------------------------

--
-- Table structure for table `collection`
--

CREATE TABLE `collection` (
  `id` int(10) UNSIGNED ZEROFILL NOT NULL,
  `title` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  `image` varchar(50) NOT NULL,
  `is_favorite` varchar(1) NOT NULL,
  `created_by` varchar(30) NOT NULL,
  `updated_by` varchar(30) NOT NULL,
  `created_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `collection`
--

INSERT INTO `collection` (`id`, `title`, `description`, `image`, `is_favorite`, `created_by`, `updated_by`, `created_timestamp`, `updated_timestamp`) VALUES
(0000000005, 'Test', 'Test 1', 'lgQSR0tV.jpg', '1', '', 'thopo', '2018-04-29 14:45:50', '2018-04-30 04:57:02'),
(0000000006, 'Test 2', 'Test 2', 'Vame3Aoj.jpg', '1', '', 'thopo', '2018-04-29 14:46:01', '2018-04-29 14:46:48'),
(0000000007, 'Test 3', 'Test 3', 'laiL2CuD.jpg', '1', '', 'thopo', '2018-04-29 14:46:12', '2018-04-29 14:46:49'),
(0000000008, 'Test 4', 'Test 4', 'DucRj0NQ.jpg', '1', '', 'thopo', '2018-04-29 14:46:22', '2018-04-29 14:46:50'),
(0000000009, 'Test 5', 'Test 5', 'fZ7maqsB.jpg', '1', '', 'thopo', '2018-04-29 14:46:33', '2018-04-29 14:46:51');

-- --------------------------------------------------------

--
-- Table structure for table `garment`
--

CREATE TABLE `garment` (
  `id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `filename` varchar(50) NOT NULL,
  `brand` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `is_deleted` varchar(1) NOT NULL,
  `created_by` varchar(30) NOT NULL,
  `updated_by` varchar(30) NOT NULL,
  `created_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `garment`
--

INSERT INTO `garment` (`id`, `code`, `filename`, `brand`, `stock`, `is_deleted`, `created_by`, `updated_by`, `created_timestamp`, `updated_timestamp`) VALUES
(1, 'S__11878402', 'sybKgTXd.jpg', 1, 30, '', '', 'thopo', '2018-04-30 04:57:34', '2018-04-30 04:57:55'),
(2, 'kjkjlk', 'Zcxp548A.jpg', 1, 50, '', '', 'thopo', '2018-04-30 04:59:34', '2018-04-30 04:59:34'),
(3, 'pempek1', 'aj86gyBw.jpg', 2, 0, '', '', 'thopo', '2018-04-30 05:02:01', '2018-04-30 05:02:01'),
(4, 'pempek2', 'iWY3qkSa.jpg', 2, 0, '', '', 'thopo', '2018-04-30 05:02:01', '2018-04-30 05:02:01'),
(5, 'pempek3', '0hkeR1Qv.jpg', 2, 0, '', '', 'thopo', '2018-04-30 05:02:01', '2018-04-30 05:02:01');

-- --------------------------------------------------------

--
-- Table structure for table `garment_brand`
--

CREATE TABLE `garment_brand` (
  `id` int(10) UNSIGNED ZEROFILL NOT NULL,
  `brand` varchar(30) NOT NULL,
  `description` varchar(100) NOT NULL,
  `image` varchar(50) NOT NULL,
  `is_favorite` varchar(1) NOT NULL,
  `is_deleted` varchar(1) NOT NULL,
  `created_by` varchar(30) NOT NULL,
  `updated_by` varchar(30) NOT NULL,
  `created_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `garment_brand`
--

INSERT INTO `garment_brand` (`id`, `brand`, `description`, `image`, `is_favorite`, `is_deleted`, `created_by`, `updated_by`, `created_timestamp`, `updated_timestamp`) VALUES
(0000000001, 'Drago', 'Drago', '', '1', '0', '', 'thopo', '2018-04-30 04:57:25', '2018-04-30 04:58:01'),
(0000000002, 'Guabello', 'Guabello', '', '1', '0', '', 'thopo', '2018-04-30 05:01:53', '2018-04-30 05:02:16');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `failed_attempt` int(11) NOT NULL,
  `last_failed_attempt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` varchar(30) NOT NULL DEFAULT 'SYSTEM',
  `updated_by` varchar(30) NOT NULL,
  `created_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `username`, `password`, `last_login`, `failed_attempt`, `last_failed_attempt`, `created_by`, `updated_by`, `created_timestamp`, `updated_timestamp`) VALUES
(1, 'thopo', '4dfe52b98ed69dd92edaca4846c34ada', '2018-04-30 16:33:44', 0, '2018-04-30 16:33:44', 'SYSTEM', '', '2018-04-29 14:36:48', '2018-04-30 16:33:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `collection`
--
ALTER TABLE `collection`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `garment`
--
ALTER TABLE `garment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `garment_brand`
--
ALTER TABLE `garment_brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `collection`
--
ALTER TABLE `collection`
  MODIFY `id` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `garment`
--
ALTER TABLE `garment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `garment_brand`
--
ALTER TABLE `garment_brand`
  MODIFY `id` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
