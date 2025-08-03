-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Oct 01, 2023 at 05:53 PM
-- Server version: 5.7.39
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `doxe_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `referral_settings`
--

CREATE TABLE `referral_settings` (
  `id` int(11) NOT NULL,
  `is_enable` varchar(255) NOT NULL,
  `referral_policy` text NOT NULL,
  `commision_rate` varchar(255) NOT NULL,
  `minimum_payout` varchar(255) DEFAULT NULL,
  `payment_method` varchar(255) NOT NULL,
  `referral_guideline` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `referral_settings`
--

INSERT INTO `referral_settings` (`id`, `is_enable`, `referral_policy`, `commision_rate`, `minimum_payout`, `payment_method`, `referral_guideline`) VALUES
(1, '1', '2', '50', '5', '1. Paypal 2. Bank Deposit', '<p>1.fdhgfdhjfghfghfgh12333ytryrtyhgfhfghfghfghfghfghfghfghfghfghf</p>\r\n\r\n<p>2. fdhgfdhjfghfghfgh12333ytryrty gfhgfhgf fghgfhgn gfhgfhgf</p>\r\n\r\n<p>3. fdhgfdhjfghfghfgh12333ytryrtygfhgfh gfhgfh gffhfgh fghgfh</p>\r\n');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `referral_settings`
--
ALTER TABLE `referral_settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `referral_settings`
--
ALTER TABLE `referral_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
