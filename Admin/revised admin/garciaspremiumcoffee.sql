-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 17, 2019 at 05:57 PM
-- Server version: 5.7.19
-- PHP Version: 7.1.9

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
  `password` varchar(201) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type` varchar(201) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middlename` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_number` int(20) NOT NULL,
  `email` varchar(201) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`accountid`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  UNIQUE KEY `accountid_UNIQUE` (`accountid`),
  UNIQUE KEY `password_UNIQUE` (`password`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`accountid`, `username`, `password`, `user_type`, `firstname`, `middlename`, `lastname`, `contact_number`, `email`) VALUES
(1, 'admin', 'admin', 'admin', 'Eli', 'Angel', 'Garcia', 9177777, 'eliangel77@gmail.com'),
(2, 'subadmin1', 'subadmin1', 'sub-admin1', 'Victoria Bendi', 'Olarte', 'Buse', 91888888, 'bendi9@gmail.com'),
(3, 'subadmin2', 'subadmin2', 'sub-admin2', 'Steven', 'Barry', 'Mangati', 91999999, 'steven10@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

DROP TABLE IF EXISTS `branch`;
CREATE TABLE IF NOT EXISTS `branch` (
  `branchid` int(15) UNSIGNED NOT NULL AUTO_INCREMENT,
  `branch_address` varchar(201) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_name` varchar(201) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`branchid`),
  UNIQUE KEY `branchid_UNIQUE` (`branchid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`branchid`, `branch_address`, `branch_name`) VALUES
(1, 'Public Market Baguio City', 'Market'),
(2, 'Porta Vaga Session Road Baguio City', 'Porta'),
(3, NULL, 'Market and Porta');

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

DROP TABLE IF EXISTS `delivery`;
CREATE TABLE IF NOT EXISTS `delivery` (
  `deliveryid` int(15) NOT NULL,
  `productid` int(15) NOT NULL,
  `quantity` double(10,2) NOT NULL,
  `time` timestamp NOT NULL,
  `branchid` int(15) NOT NULL,
  `orderid` int(15) NOT NULL,
  `supplierid` int(15) NOT NULL,
  `idnumber` int(15) UNSIGNED NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`idnumber`),
  UNIQUE KEY `idnumber_UNIQUE` (`idnumber`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`deliveryid`, `productid`, `quantity`, `time`, `branchid`, `orderid`, `supplierid`, `idnumber`) VALUES
(1, 1, 300.00, '2019-03-08 17:16:00', 1, 5, 1, 1),
(2, 2, 500.00, '2019-03-08 18:30:00', 2, 6, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `orderid` int(15) NOT NULL,
  `supplierid` int(15) DEFAULT NULL,
  `branchid` int(15) NOT NULL,
  `productid` int(15) NOT NULL,
  `quantity` double(10,2) NOT NULL,
  `time` timestamp NOT NULL,
  `deliveryid` int(15) DEFAULT NULL,
  `accountid` int(15) NOT NULL,
  `idnumber` int(15) UNSIGNED NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`idnumber`),
  UNIQUE KEY `idnumber_UNIQUE` (`idnumber`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderid`, `supplierid`, `branchid`, `productid`, `quantity`, `time`, `deliveryid`, `accountid`, `idnumber`) VALUES
(1, 1, 1, 1, 100.00, '2019-03-09 00:03:05', 3, 2, 9),
(1, 2, 1, 2, 100.00, '2019-03-09 00:03:05', 1, 2, 10),
(2, 1, 1, 3, 150.00, '2019-03-09 00:27:07', 5, 2, 11),
(3, 3, 2, 4, 150.00, '2019-03-09 01:10:07', 6, 3, 12),
(3, 3, 2, 6, 200.00, '2019-03-09 01:10:07', 7, 3, 13),
(3, 3, 2, 8, 100.00, '2019-03-09 01:10:07', 8, 3, 14),
(4, 3, 2, 17, 300.00, '2019-03-09 02:27:00', 9, 3, 15),
(5, 1, 1, 1, 300.00, '2019-03-09 03:16:00', 1, 1, 16),
(6, 3, 2, 2, 500.00, '2019-03-08 17:00:00', 2, 1, 17);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `productid` int(15) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(201) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(201) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`productid`),
  UNIQUE KEY `productid_UNIQUE` (`productid`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`productid`, `name`, `status`) VALUES
(1, 'Premium Barako Excelsa', NULL),
(2, 'Arabica Medium Blend', NULL),
(3, 'Barako Blend Coffee', NULL),
(4, 'Benguet', NULL),
(5, 'Barako', NULL),
(6, 'Sagada Dark', NULL),
(7, 'Sagada Medium', NULL),
(8, 'HouseBlendArabica', NULL),
(9, 'Italian Espresso', NULL),
(10, 'Kalinga Medium', NULL),
(11, 'Kalinga Dark', NULL),
(12, 'Hazelnut', NULL),
(13, 'Mocha', NULL),
(14, 'Hazelnut-Vanilla', NULL),
(15, 'Vanilla', NULL),
(16, 'Butterscotch', NULL),
(17, 'Macadamia', NULL),
(18, 'Cinnamon Nut', NULL),
(19, 'Irish Cream', NULL),
(20, 'Caramel', NULL),
(21, 'Cookies and Cream', NULL),
(22, 'Bailey’s Irish Cream', NULL),
(23, 'Double Chocolate', NULL);

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
  `time` timestamp NOT NULL,
  `status` varchar(201) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remarks` varchar(201) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stockid` int(15) NOT NULL,
  `branchid` int(15) NOT NULL,
  PRIMARY KEY (`reconciliationid`),
  UNIQUE KEY `reconciliationid_UNIQUE` (`reconciliationid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reconciliation`
--

INSERT INTO `reconciliation` (`reconciliationid`, `userid`, `productid`, `logical_count`, `physical_count`, `time`, `status`, `remarks`, `stockid`, `branchid`) VALUES
(1, 2, 1, 455.00, 456.00, '2019-03-09 13:01:01', 'Not Match', 'Adjusted', 0, 0);

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
  `time` timestamp NOT NULL,
  `accountid` int(15) NOT NULL,
  `orderid` int(15) NOT NULL,
  PRIMARY KEY (`idnumber`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `solditem`
--

INSERT INTO `solditem` (`idnumber`, `solditemid`, `productid`, `quantity`, `time`, `accountid`, `orderid`) VALUES
(1, 1, 1, 1.00, '2019-03-09 00:04:05', 2, 1),
(2, 1, 2, 1.00, '2019-03-09 00:04:05', 2, 1),
(3, 2, 3, 1.50, '2019-03-09 00:28:07', 2, 2),
(4, 3, 4, 1.50, '2019-03-09 01:11:07', 3, 3),
(5, 3, 6, 2.00, '2019-03-09 01:11:07', 3, 3),
(6, 3, 8, 1.00, '2019-03-09 01:11:07', 3, 3),
(7, 4, 17, 3.00, '2019-03-09 02:29:00', 3, 4);

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
  `stockout` double(10,2) NOT NULL,
  `branchid` int(15) NOT NULL,
  `created` timestamp NOT NULL,
  `updated` timestamp NOT NULL,
  PRIMARY KEY (`stockid`),
  UNIQUE KEY `stockid_UNIQUE` (`stockid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`stockid`, `productid`, `quantity`, `stockin`, `stockout`, `branchid`, `created`, `updated`) VALUES
(1, 1, 456.00, 300.00, 55.00, 1, '2019-03-01 12:28:34', '2019-03-01 14:33:02'),
(2, 2, 621.00, 200.00, 69.00, 1, '2019-03-01 12:28:34', '2019-03-01 12:28:34'),
(3, 3, 600.00, 100.00, 55.00, 2, '2019-03-14 22:33:21', '2019-03-14 22:33:21');

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
  `productid` int(15) NOT NULL,
  `branchid` int(15) NOT NULL,
  PRIMARY KEY (`supplierid`),
  UNIQUE KEY `supplierid_UNIQUE` (`supplierid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplierid`, `supplier_name`, `supplier_contact_person`, `contact_number`, `address`, `productid`, `branchid`) VALUES
(1, 'Atok', 'Eli', '09177889900', 'Atok Benguet', 1, 1),
(2, 'Sablan', 'Eli', '09166778899', 'Kamog Sablan Baguio City', 2, 1),
(3, 'Market', 'Eli', '09123456', 'Public Market Baguio City', 1, 2);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
