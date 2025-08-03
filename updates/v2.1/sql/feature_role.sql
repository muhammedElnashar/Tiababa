-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: May 06, 2024 at 01:08 PM
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
-- Table structure for table `feature_role`
--

CREATE TABLE `feature_role` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `feature_role`
--

INSERT INTO `feature_role` (`id`, `name`, `slug`) VALUES
(1, 'Department ', 'department '),
(2, 'Schedule', 'schedule'),
(3, 'Consultation Settings', 'consultation-settings'),
(4, 'QR Code', 'qr-code '),
(5, 'Custom Domain', 'custom-domain'),
(6, 'Payouts', 'payouts'),
(7, 'Affiliate', 'affiliate'),
(8, 'Consultation', 'consultation'),
(9, 'Prescription Settings', 'prescription-settings'),
(10, 'Prescription', 'prescription'),
(11, 'Ratings & Review', 'ratings-review'),
(12, 'Patients', 'patients'),
(13, 'Appointments', 'appointments'),
(14, 'Drugs', 'drugs'),
(15, 'Doctor Profile', 'doctor-profile'),
(16, 'Blogs', 'blogs'),
(17, 'Services', 'services');
(18, 'invoice', 'invoice');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `feature_role`
--
ALTER TABLE `feature_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `feature_role`
--
ALTER TABLE `feature_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
