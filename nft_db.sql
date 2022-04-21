-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2022 at 04:47 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nft_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

CREATE TABLE `tblusers` (
  `id` int(11) NOT NULL,
  `Name` varchar(200) DEFAULT NULL,
  `profile` varchar(255) NOT NULL,
  `emailId` varchar(200) DEFAULT NULL,
  `mobileNumber` bigint(10) DEFAULT NULL,
  `userPassword` text DEFAULT NULL,
  `regDate` timestamp NULL DEFAULT current_timestamp(),
  `isActive` int(1) DEFAULT NULL,
  `lastUpdationDate` datetime DEFAULT NULL,
  `last_login` varchar(200) DEFAULT NULL,
  `YoutubeAPIKey` varchar(255) NOT NULL,
  `YoutubeAPISecret` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`id`, `Name`, `profile`, `emailId`, `mobileNumber`, `userPassword`, `regDate`, `isActive`, `lastUpdationDate`, `last_login`, `YoutubeAPIKey`, `YoutubeAPISecret`) VALUES
(1, 'Mohd Anas', '1628423525-ead665c21c1351c3351744a938dade9f.jpg', 'mohdanas.codecounter@gmail.com', 9654503182, 'be77f8e570caa9818d15eef603afb116', '2021-08-07 18:30:00', 1, '2021-08-09 00:00:00', '1650549932', 'AIzaSyAE_5rV5TqwS1gihiuffUZZ9i-y8iWhFos', 'dBxl6ZvF-W0B-vKzFAjI31V-'),
(3, NULL, '', 'anasjmi29@gmail.com', NULL, 'be77f8e570caa9818d15eef603afb116', '2022-04-20 18:30:00', 1, NULL, '1650551435', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblusers`
--
ALTER TABLE `tblusers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mobileNumber` (`mobileNumber`),
  ADD UNIQUE KEY `emailId` (`emailId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblusers`
--
ALTER TABLE `tblusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
