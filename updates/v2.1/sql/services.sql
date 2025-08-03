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
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `category` int(11) NOT NULL,
  `details` text,
  `price` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `thumb` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;





-- إنشاء جدول الفواتير (Invoices)
CREATE TABLE invoices (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(255) NOT NULL, -- اسم العميل
    total_price DECIMAL(10, 2) NOT NULL, -- السعر الإجمالي
    status INT(1) NOT NULL, -- حالة الفاتورة (1: مدفوعة، 0: غير مدفوعة)
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP -- تاريخ الإنشاء
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- إنشاء جدول عناصر الفاتورة (تفاصيل الفاتورة أو invoice_items)
CREATE TABLE invoice_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    invoice_id INT NOT NULL, -- معرف الفاتورة المرتبطة
    service_name VARCHAR(255) NOT NULL, -- اسم الخدمة
    doctor_name VARCHAR(255) NOT NULL, -- اسم الطبيب
    price DECIMAL(10, 2) NOT NULL, -- سعر الخدمة
    FOREIGN KEY (invoice_id) REFERENCES invoices(id) ON DELETE CASCADE -- ربط الفاتورة بالعناصر
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- إضافة بيانات الفاتورة مع الخدمات المرتبطة بها
-- ملاحظة: يمكنك إضافة خدمات باستخدام الـ INSERT INTO في الجداول المناسبة بعد إنشائها




/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
