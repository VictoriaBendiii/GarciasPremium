-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 18, 2019 at 03:47 PM
-- Server version: 5.7.24
-- PHP Version: 7.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `garciaspremiumcoffee`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
CREATE TABLE IF NOT EXISTS `accounts` (
  `accountid` int(15) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(201) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(201) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(201) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type` varchar(201) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middlename` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_number` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branchid` int(15) NOT NULL,
  PRIMARY KEY (`accountid`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  UNIQUE KEY `accountid_UNIQUE` (`accountid`),
  UNIQUE KEY `password_UNIQUE` (`password`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`accountid`, `username`, `email`, `password`, `user_type`, `firstname`, `middlename`, `lastname`, `contact_number`, `status`, `branchid`) VALUES
(1, 'admin', 'eliangel77@gmail.com', 'admin', 'admin', 'Eli', 'Angel', 'Garcia', '091777777', 'Active', 3),
(2, 'subadmin1', 'bendi9@gmail.com', 'subadmin1', 'sub-admin1', 'Victoria Bendi', 'Olarte', 'Buse', '091888888', 'Active', 1),
(3, 'subadmin2', 'steven10@gmail.com', 'subadmin2', 'sub-admin2', 'Steven', 'Barry', 'Mangati', '091999999', 'Active', 2);

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

DROP TABLE IF EXISTS `branch`;
CREATE TABLE IF NOT EXISTS `branch` (
  `branchid` int(15) UNSIGNED NOT NULL AUTO_INCREMENT,
  `branch_name` varchar(201) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch_address` varchar(201) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`branchid`),
  UNIQUE KEY `branchid_UNIQUE` (`branchid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`branchid`, `branch_name`, `branch_address`) VALUES
(1, 'Market', 'Public Market Baguio City'),
(2, 'Porta', 'Porta Vaga Session Road Baguio City'),
(3, 'Market and Porta', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

DROP TABLE IF EXISTS `delivery`;
CREATE TABLE IF NOT EXISTS `delivery` (
  `idnumber` int(15) UNSIGNED NOT NULL AUTO_INCREMENT,
  `deliveryid` int(15) NOT NULL,
  `productid` int(15) NOT NULL,
  `quantity` double(10,2) NOT NULL,
  `supplierid` int(15) NOT NULL,
  `branchid` int(15) NOT NULL,
  `orderid` int(15) NOT NULL,
  `time` timestamp NOT NULL,
  `status` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`idnumber`),
  UNIQUE KEY `idnumber_UNIQUE` (`idnumber`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`idnumber`, `deliveryid`, `productid`, `quantity`, `supplierid`, `branchid`, `orderid`, `time`, `status`) VALUES
(1, 1, 1, 300.00, 1, 1, 5, '2019-03-03 02:16:00', 'delivered'),
(2, 2, 2, 200.00, 3, 2, 6, '2019-03-03 05:00:00', 'delivered'),
(5, 5, 6, 300.00, 1, 1, 9, '2019-03-04 08:00:00', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `idnumber` int(15) UNSIGNED NOT NULL AUTO_INCREMENT,
  `orderid` int(15) NOT NULL,
  `stockid` int(15) NOT NULL,
  `productid` int(15) NOT NULL,
  `quantity` double(10,2) NOT NULL,
  `solditemid` int(15) DEFAULT NULL,
  `deliveryid` int(15) DEFAULT NULL,
  `supplierid` int(15) DEFAULT NULL,
  `branchid` int(15) NOT NULL,
  `accountid` int(15) NOT NULL,
  `time` timestamp NOT NULL,
  `status` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idnumber`),
  UNIQUE KEY `idnumber_UNIQUE` (`idnumber`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`idnumber`, `orderid`, `stockid`, `productid`, `quantity`, `solditemid`, `deliveryid`, `supplierid`, `branchid`, `accountid`, `time`, `status`) VALUES
(1, 1, 1, 1, 1.00, 1, NULL, NULL, 1, 2, '2019-03-02 05:28:34', 'sold'),
(2, 1, 2, 2, 1.00, 1, NULL, NULL, 1, 2, '2019-03-02 05:29:34', 'sold'),
(3, 2, 3, 3, 1.50, 2, NULL, NULL, 1, 2, '2019-03-02 06:08:30', 'sold'),
(4, 3, 27, 4, 1.50, 3, NULL, NULL, 2, 3, '2019-03-02 11:33:02', 'sold'),
(5, 3, 29, 6, 2.00, 3, NULL, NULL, 2, 3, '2019-03-02 11:33:02', 'sold'),
(6, 3, 31, 8, 1.00, 3, NULL, NULL, 2, 3, '2019-03-02 11:33:02', 'sold'),
(7, 4, 40, 17, 3.00, 4, NULL, NULL, 2, 3, '2019-03-02 11:38:02', 'sold'),
(8, 5, 1, 1, 300.00, NULL, 1, 1, 1, 1, '2019-03-03 02:16:00', 'delivered'),
(9, 6, 25, 2, 200.00, NULL, 2, 3, 2, 1, '2019-03-03 05:00:00', 'delivered'),
(10, 7, 4, 4, 200.00, NULL, 3, 1, 1, 1, '2019-03-03 11:28:34', 'accepted'),
(11, 8, 33, 10, 300.00, NULL, 4, 3, 2, 1, '2019-03-04 05:28:34', 'accepted'),
(12, 9, 6, 6, 300.00, NULL, 5, 1, 1, 1, '2019-03-04 08:00:00', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `productid` int(15) UNSIGNED NOT NULL AUTO_INCREMENT,
  `productname` varchar(201) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branchid` int(11) NOT NULL,
  `status` varchar(201) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`productid`),
  UNIQUE KEY `productid_UNIQUE` (`productid`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`productid`, `productname`, `branchid`, `status`) VALUES
(1, 'Premium Barako Excelsa', 3, 'Active'),
(2, 'Arabica Medium Blend', 3, 'Active'),
(3, 'Barako Blend Coffee', 3, 'Active'),
(4, 'Benguet', 3, 'Active'),
(5, 'Barako', 3, 'Active'),
(6, 'Sagada Dark', 3, 'Active'),
(7, 'Sagada Medium', 3, 'Active'),
(8, 'House Blend Arabica', 3, 'Active'),
(9, 'Italian Espresso', 3, 'Active'),
(10, 'Kalinga Medium', 3, 'Active'),
(11, 'Kalinga Dark', 3, 'Active'),
(12, 'Hazelnut', 3, 'Active'),
(13, 'Mocha', 3, 'Active'),
(14, 'Hazelnut-Vanilla', 3, 'Active'),
(15, 'Vanilla', 3, 'Active'),
(16, 'Butterscotch', 3, 'Active'),
(17, 'Macadamia', 3, 'Active'),
(18, 'Cinnamon Nut', 3, 'Active'),
(19, 'Irish Cream', 3, 'Active'),
(20, 'Caramel', 3, 'Active'),
(21, 'Cookies and Cream', 3, 'Active'),
(22, 'Baileys Irish Cream', 3, 'Active'),
(23, 'Double Chocolate', 3, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `reconciliation`
--

DROP TABLE IF EXISTS `reconciliation`;
CREATE TABLE IF NOT EXISTS `reconciliation` (
  `reconciliationid` int(15) UNSIGNED NOT NULL AUTO_INCREMENT,
  `userid` int(15) NOT NULL,
  `productid` int(15) NOT NULL,
  `logical_count` double(10,2) NOT NULL,
  `physical_count` double(10,2) NOT NULL,
  `stockid` int(15) NOT NULL,
  `branchid` int(15) NOT NULL,
  `time` timestamp NOT NULL,
  `remarks` varchar(201) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(201) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`reconciliationid`),
  UNIQUE KEY `reconciliationid_UNIQUE` (`reconciliationid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reconciliation`
--

INSERT INTO `reconciliation` (`reconciliationid`, `userid`, `productid`, `logical_count`, `physical_count`, `stockid`, `branchid`, `time`, `remarks`, `status`) VALUES
(1, 2, 1, 455.00, 456.00, 0, 0, '2019-03-09 13:01:01', 'Adjusted', 'Not Match');

-- --------------------------------------------------------

--
-- Table structure for table `solditem`
--

DROP TABLE IF EXISTS `solditem`;
CREATE TABLE IF NOT EXISTS `solditem` (
  `idnumber` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `solditemid` int(15) NOT NULL,
  `productid` int(15) NOT NULL,
  `quantity` double(10,2) NOT NULL,
  `orderid` int(15) NOT NULL,
  `branchid` int(15) NOT NULL,
  `accountid` int(15) NOT NULL,
  `time` timestamp NOT NULL,
  `status` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`idnumber`),
  UNIQUE KEY `idnumber_UNIQUE` (`idnumber`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `solditem`
--

INSERT INTO `solditem` (`idnumber`, `solditemid`, `productid`, `quantity`, `orderid`, `branchid`, `accountid`, `time`, `status`) VALUES
(1, 1, 1, 1.00, 1, 1, 2, '2019-03-02 05:28:34', 'sold'),
(2, 1, 2, 1.00, 1, 1, 2, '2019-03-02 05:28:34', 'sold'),
(3, 2, 3, 1.50, 2, 1, 2, '2019-03-02 05:28:34', 'sold'),
(4, 3, 4, 1.50, 3, 2, 3, '2019-03-02 11:33:02', 'sold'),
(5, 3, 6, 2.00, 3, 2, 3, '2019-03-02 11:33:02', 'sold'),
(6, 3, 8, 1.00, 3, 2, 3, '2019-03-02 11:33:02', 'sold'),
(7, 4, 17, 3.00, 4, 2, 3, '2019-03-02 02:16:00', 'sold'),
(8, 13, 5, 1.00, 13, 1, 2, '2019-04-18 14:43:02', 'sold');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

DROP TABLE IF EXISTS `stock`;
CREATE TABLE IF NOT EXISTS `stock` (
  `stockid` int(15) UNSIGNED NOT NULL AUTO_INCREMENT,
  `productid` int(15) NOT NULL,
  `quantity` double(10,2) NOT NULL,
  `stockin` double(10,2) NOT NULL,
  `date_in` timestamp NOT NULL,
  `stockout` double(10,2) NOT NULL,
  `date_out` timestamp NOT NULL,
  `branchid` int(15) NOT NULL,
  `accountid` int(15) NOT NULL,
  PRIMARY KEY (`stockid`),
  UNIQUE KEY `stockid_UNIQUE` (`stockid`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`stockid`, `productid`, `quantity`, `stockin`, `date_in`, `stockout`, `date_out`, `branchid`, `accountid`) VALUES
(1, 1, 456.00, 300.00, '2019-03-01 01:33:02', 44.00, '2019-03-02 05:28:34', 1, 1),
(2, 2, 621.00, 100.00, '2019-03-01 01:28:34', 79.00, '2019-03-02 05:28:34', 1, 1),
(3, 3, 500.00, 250.00, '2019-03-01 01:31:02', 50.00, '2019-03-02 06:08:30', 1, 1),
(4, 4, 598.00, 200.00, '2019-03-01 02:30:06', 2.00, '2019-03-01 11:28:34', 1, 1),
(5, 5, 600.00, 200.00, '2019-03-01 01:33:00', 100.00, '2019-03-03 05:00:00', 1, 1),
(6, 6, 453.00, 300.00, '2019-03-01 02:31:09', 47.00, '2019-03-02 11:41:34', 1, 1),
(7, 7, 564.00, 200.00, '2019-03-01 02:31:15', 36.00, '2019-03-01 11:28:34', 1, 1),
(9, 9, 415.00, 300.00, '2019-03-01 01:34:02', 85.00, '2019-03-03 05:28:34', 1, 1),
(10, 10, 426.00, 300.00, '2019-03-01 01:35:02', 74.00, '2019-03-03 05:28:34', 1, 1),
(11, 11, 439.00, 300.00, '2019-03-01 01:40:02', 61.00, '2019-03-02 05:28:34', 1, 1),
(12, 12, 524.00, 200.00, '2019-03-01 05:34:02', 76.00, '2019-03-02 11:33:02', 1, 1),
(13, 13, 645.00, 100.00, '2019-03-01 05:34:34', 55.00, '2019-03-01 11:33:02', 1, 1),
(14, 14, 438.00, 150.00, '2019-03-01 05:35:30', 212.00, '2019-03-02 11:38:02', 1, 1),
(15, 15, 678.00, 100.00, '2019-03-01 01:42:34', 22.00, '2019-03-01 08:33:02', 1, 1),
(16, 16, 437.00, 200.00, '2019-03-01 05:37:41', 163.00, '2019-03-02 11:00:00', 1, 1),
(17, 17, 577.00, 200.00, '2019-03-01 01:49:34', 23.00, '2019-03-01 08:33:02', 1, 1),
(18, 18, 450.00, 300.00, '2019-03-01 05:28:23', 50.00, '2019-03-01 11:33:02', 1, 1),
(19, 19, 455.00, 300.00, '2019-03-01 05:38:34', 45.00, '2019-03-01 10:43:02', 1, 1),
(20, 20, 545.00, 250.00, '2019-03-01 01:52:34', 5.00, '2019-03-01 02:33:02', 1, 1),
(21, 21, 560.00, 200.00, '2019-03-01 01:52:34', 40.00, '2019-03-01 10:33:02', 1, 1),
(22, 22, 634.00, 100.00, '2019-03-02 05:39:03', 66.00, '2019-03-01 11:33:02', 1, 1),
(23, 23, 436.00, 300.00, '2019-03-02 01:53:48', 64.00, '2019-03-01 11:43:02', 1, 1),
(24, 1, 436.00, 300.00, '2019-03-02 05:28:34', 64.00, '2019-03-02 10:33:02', 2, 2),
(25, 2, 560.00, 200.00, '2019-03-02 05:28:38', 40.00, '2019-03-02 09:33:02', 2, 2),
(26, 3, 634.00, 100.00, '2019-03-02 05:28:41', 66.00, '2019-03-02 10:33:02', 2, 2),
(27, 4, 345.00, 150.00, '2019-03-02 01:40:34', 305.00, '2019-03-02 11:33:02', 2, 2),
(28, 5, 435.00, 300.00, '2019-03-02 05:29:05', 65.00, '2019-03-02 10:33:02', 2, 2),
(29, 6, 526.00, 200.00, '2019-03-02 01:40:37', 74.00, '2019-03-02 11:33:02', 2, 2),
(30, 7, 634.05, 100.00, '2019-03-02 05:29:38', 66.05, '2019-03-02 10:33:02', 2, 2),
(31, 8, 403.00, 300.00, '2019-03-02 01:40:39', 97.00, '2019-03-02 11:33:02', 2, 2),
(32, 9, 540.00, 200.00, '2019-03-02 05:29:39', 60.00, '2019-03-02 10:43:02', 2, 2),
(33, 10, 403.00, 300.00, '2019-03-03 05:30:42', 97.00, '2019-03-02 11:33:02', 2, 2),
(34, 11, 367.00, 400.00, '2019-03-01 01:42:41', 33.00, '2019-03-02 02:33:02', 2, 2),
(35, 12, 490.00, 250.00, '2019-03-01 01:43:45', 60.00, '2019-03-02 10:43:02', 2, 2),
(36, 13, 547.00, 200.00, '2019-03-03 05:31:04', 53.00, '2019-03-02 11:33:02', 2, 2),
(37, 14, 634.00, 100.00, '2019-03-01 01:46:38', 66.00, '2019-03-02 10:33:02', 2, 2),
(38, 15, 570.00, 200.00, '2019-03-01 01:48:34', 30.00, '2019-03-03 02:33:02', 2, 2),
(39, 16, 523.00, 200.00, '2019-03-03 05:34:01', 77.00, '2019-03-02 11:33:02', 2, 2),
(40, 17, 539.00, 200.00, '2019-03-03 05:35:04', 61.00, '2019-03-02 11:38:02', 2, 2),
(41, 18, 629.05, 100.00, '2019-03-03 05:35:09', 71.05, '2019-03-02 11:33:02', 2, 2),
(42, 19, 488.00, 300.00, '2019-03-03 05:37:04', 12.00, '2019-03-03 02:40:02', 2, 2),
(43, 20, 392.05, 400.00, '2019-03-02 05:38:03', 8.05, '2019-03-03 02:33:02', 2, 2),
(44, 21, 365.00, 400.00, '2019-03-03 05:39:50', 35.00, '2019-03-02 02:33:02', 2, 2),
(45, 22, 463.00, 300.00, '2019-03-02 05:43:52', 37.00, '2019-03-03 02:33:02', 2, 2),
(46, 23, 477.00, 300.00, '2019-03-02 05:44:30', 23.00, '2019-03-02 10:33:02', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

DROP TABLE IF EXISTS `supplier`;
CREATE TABLE IF NOT EXISTS `supplier` (
  `supplierid` int(15) UNSIGNED NOT NULL AUTO_INCREMENT,
  `supplier_name` varchar(201) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_contact_person` varchar(201) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_number` varchar(201) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(201) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`supplierid`),
  UNIQUE KEY `supplierid_UNIQUE` (`supplierid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplierid`, `supplier_name`, `supplier_contact_person`, `contact_number`, `address`, `status`) VALUES
(1, 'Atok', 'Eli', '09177889900', 'Atok Benguet', 'active'),
(2, 'Sablan', 'Eli', '09166778899', 'Kamog Sablan Baguio City', 'active'),
(3, 'Market', 'Eli', '09155667788', 'Public Market Baguio City', 'active');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
