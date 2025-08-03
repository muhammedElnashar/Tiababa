-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Oct 01, 2023 at 06:22 PM
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
-- Table structure for table `domains`
--

CREATE TABLE `domains` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `current_domain` varchar(255) DEFAULT NULL,
  `custom_domain` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `domain_settings`
--

CREATE TABLE `domain_settings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `short_details` text NOT NULL,
  `details` text NOT NULL,
  `ip` varchar(255) NOT NULL,
  `type1` varchar(255) NOT NULL,
  `host1` varchar(255) NOT NULL,
  `value1` varchar(255) NOT NULL,
  `ttl1` varchar(255) NOT NULL,
  `type2` varchar(255) NOT NULL,
  `host2` varchar(255) NOT NULL,
  `value2` varchar(255) NOT NULL,
  `ttl2` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `thumb` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `domain_settings`
--

INSERT INTO `domain_settings` (`id`, `user_id`, `title`, `short_details`, `details`, `ip`, `type1`, `host1`, `value1`, `ttl1`, `type2`, `host2`, `value2`, `ttl2`, `image`, `thumb`) VALUES
(1, 1, 'Custom Domain Integration Guideline', 'Custom Domain Integration Guideline short details', '<div>Integrating a custom domain with DNS settings typically involves the following steps:</div>\r\n\r\n<div> </div>\r\n\r\n<ol>\r\n <li><strong>Purchase a domain name:</strong> You&#39;ll need to purchase a domain name from a domain registrar such as GoDaddy, Namecheap, or Google Domains.</li>\r\n <li><strong>Obtain your DNS records: </strong>Once you have a domain provider, they will provide you with <strong>DNS records</strong> that you&#39;ll need to configure for your domain. These records will typically include an <strong>A record & CNAME record</strong>.</li>\r\n <li><strong>Configure DNS settings:</strong> Log in to your domain registrar&#39;s account and navigate to the DNS management section.You need to add 2 new DNS record, choose the record type (<strong>A & CNAME</strong>) & follow the settings below <strong>(DNS Settings One & DNS Settings Two)</strong>, and enter the corresponding value.</li>\r\n <li><strong>Wait for propagation:</strong> Once you&#39;ve made the changes to your DNS settings, it can take up to 48 hours for the changes to propagate throughout the internet. During this time, your website or application may be temporarily unavailable.</li>\r\n</ol>\r\n\r\n<div>That&#39;s it! Once your DNS records have propagated, your custom domain should be fully integrated with our application.</div>\r\n', '200.201.200.122', 'CNAME Record', 'www', 'localhost', 'Automatic', 'A Record', '@', '200.201.200.122', 'Automatic', 'uploads/medium/ffacb0959f18f3f8043243c937559a6c_medium-1200x1200.jpg', 'uploads/thumbnail/ffacb0959f18f3f8043243c937559a6c_thumb-150x150.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `payouts`
--

CREATE TABLE `payouts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `payout_method` varchar(255) NOT NULL,
  `amount` bigint(20) NOT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `message` text,
  `currency` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `referrals`
--

CREATE TABLE `referrals` (
  `id` int(11) NOT NULL,
  `referrar_id` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT '0',
  `status` int(11) DEFAULT '0',
  `order_id` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `commision` varchar(255) NOT NULL,
  `commision_amount` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `referral_payouts`
--

CREATE TABLE `referral_payouts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `payout_method` varchar(255) NOT NULL,
  `method_details` varchar(255) NOT NULL,
  `amount` bigint(20) NOT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

-- --------------------------------------------------------

--
-- Table structure for table `users_payout_accounts`
--

CREATE TABLE `users_payout_accounts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `payout_paypal_email` varchar(255) DEFAULT NULL,
  `payout_bank_info` mediumtext,
  `iban_full_name` varchar(255) DEFAULT NULL,
  `iban_country_id` varchar(20) DEFAULT NULL,
  `iban_bank_name` varchar(255) DEFAULT NULL,
  `iban_number` varchar(500) DEFAULT NULL,
  `swift_full_name` varchar(255) DEFAULT NULL,
  `swift_address` varchar(500) DEFAULT NULL,
  `swift_state` varchar(255) DEFAULT NULL,
  `swift_city` varchar(255) DEFAULT NULL,
  `swift_postcode` varchar(100) DEFAULT NULL,
  `swift_country_id` varchar(20) DEFAULT NULL,
  `swift_bank_account_holder_name` varchar(255) DEFAULT NULL,
  `swift_iban` varchar(255) DEFAULT NULL,
  `swift_code` varchar(255) DEFAULT NULL,
  `swift_bank_name` varchar(255) DEFAULT NULL,
  `swift_bank_branch_city` varchar(255) DEFAULT NULL,
  `swift_bank_branch_country_id` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `domains`
--
ALTER TABLE `domains`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `domain_settings`
--
ALTER TABLE `domain_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payouts`
--
ALTER TABLE `payouts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `referrals`
--
ALTER TABLE `referrals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `referral_payouts`
--
ALTER TABLE `referral_payouts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `referral_settings`
--
ALTER TABLE `referral_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_payout_accounts`
--
ALTER TABLE `users_payout_accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `domains`
--
ALTER TABLE `domains`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `domain_settings`
--
ALTER TABLE `domain_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payouts`
--
ALTER TABLE `payouts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `referrals`
--
ALTER TABLE `referrals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `referral_payouts`
--
ALTER TABLE `referral_payouts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `referral_settings`
--
ALTER TABLE `referral_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users_payout_accounts`
--
ALTER TABLE `users_payout_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
