-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2022 at 12:59 PM
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
-- Table structure for table `save_nft`
--

CREATE TABLE `save_nft` (
  `id` int(11) NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `data` varchar(2000) NOT NULL,
  `user_id` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `save_nft`
--

INSERT INTO `save_nft` (`id`, `link`, `data`, `user_id`, `time`) VALUES
(2, 'https://nft.communi3.io/', '{\"name\":\" Communi3\",\"image\":\"\\/\\/howrare.is\\/drop_logos\\/4769_KZfk6_jR_400x400.jpg\",\"price\":\"\",\"links\":[\"https:\\/\\/nft.communi3.io\\/\",\"https:\\/\\/twitter.com\\/communi3_io\",\"https:\\/\\/discord.gg\\/communi3\"]}', 3, '2022-05-04 10:13:59'),
(5, 'https://nextdrop.is/project/10307', '{\"name\":\"VeVe - Star Wars Digital Co...\",\"image\":\"https:\\/\\/nextdrop.s3.amazonaws.com\\/3406-starwars.jpeg\",\"price\":\"15.0 USD\",\"links\":[\"https:\\/\\/nextdrop.is\\/project\\/10307\"]}', 3, '2022-05-04 10:20:10');

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
  `is_admin` tinyint(4) NOT NULL DEFAULT 0,
  `roll` enum('Free','Pro','Admin','Agency') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`id`, `Name`, `profile`, `emailId`, `mobileNumber`, `userPassword`, `regDate`, `isActive`, `lastUpdationDate`, `last_login`, `is_admin`, `roll`) VALUES
(3, NULL, '', 'anasjmi29@gmail.com', NULL, 'be77f8e570caa9818d15eef603afb116', '2022-04-20 18:30:00', 1, NULL, '1651661833', 1, 'Pro'),
(14, NULL, '', 'mohdanas.codecounter@gmail.com', NULL, 'be77f8e570caa9818d15eef603afb116', '2022-04-20 18:30:00', 1, NULL, '1651295874', 0, 'Free');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `save_nft`
--
ALTER TABLE `save_nft`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `save_nft`
--
ALTER TABLE `save_nft`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblusers`
--
ALTER TABLE `tblusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
