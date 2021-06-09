-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2021 at 03:08 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.1.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `book`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `Id` int(11) NOT NULL,
  `Name` varchar(60) DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`Id`, `Name`, `CreatedDate`) VALUES
(1, 'Md Shakil Rana', '2021-06-02 17:58:01'),
(2, 'Sumaiya Konica ', '2021-06-02 17:35:18'),
(3, 'Prisila Punom', '2021-06-02 17:52:19'),
(5, 'Test', '2021-06-02 17:40:32'),
(7, 'after adding', '2021-06-02 21:41:18'),
(8, 'Herbert Schield', '2021-06-06 06:29:08');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `Id` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `WarningQuantity` float DEFAULT NULL,
  `PhotoUrl` varchar(255) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `AuthorId` int(11) DEFAULT NULL,
  `CategoryId` int(11) DEFAULT NULL,
  `SubCategoryId` int(11) DEFAULT NULL,
  `PublicationId` int(11) DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`Id`, `Name`, `WarningQuantity`, `PhotoUrl`, `Description`, `AuthorId`, `CategoryId`, `SubCategoryId`, `PublicationId`, `CreatedDate`) VALUES
(1, 'C Programming', 100, '../public/image/1622730170book.jpg', 'C Programming', 8, 3, 3, 7, '2021-06-03 07:56:51'),
(2, 'C# Programming', 10, '', 'C# ', 1, 3, 3, 7, '2021-06-06 06:17:10'),
(3, 'Organic Chemistry', 10, '../public/image/1623112882book.jpg', 'organic chemistry', 5, 4, 4, 2, '2021-06-08 06:22:41');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `Id` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`Id`, `Name`, `CreatedDate`) VALUES
(1, 'Electronics', '2021-06-02 21:07:38'),
(2, 'Comics', '2021-06-02 21:16:38'),
(3, 'CSE', '2021-06-06 06:00:09'),
(4, 'Science', '2021-06-08 06:56:39');

-- --------------------------------------------------------

--
-- Table structure for table `companyinformation`
--

CREATE TABLE `companyinformation` (
  `Id` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `LogoUrl` varchar(255) DEFAULT NULL,
  `Slogan` varchar(255) DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `companyinformation`
--

INSERT INTO `companyinformation` (`Id`, `Name`, `Email`, `Address`, `LogoUrl`, `Slogan`, `CreatedDate`) VALUES
(1, 'Online Book Shop', 'someemail@gmail.com', 'Dhaka, Bangladesh', '', 'Define, Ultimate', '2021-06-07 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `Id` int(11) NOT NULL,
  `InvoiceNumber` varchar(50) DEFAULT NULL,
  `UserId` int(11) DEFAULT NULL,
  `InvoiceDate` datetime DEFAULT NULL,
  `GrandTotal` float DEFAULT NULL,
  `SubTotal` float DEFAULT NULL,
  `Discount` float DEFAULT NULL,
  `Dues` float DEFAULT NULL,
  `PaymentMode` varchar(30) DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `invoicedetail`
--

CREATE TABLE `invoicedetail` (
  `Id` int(11) NOT NULL,
  `InvoiceId` int(11) DEFAULT NULL,
  `BookId` int(11) DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `UnitPrice` float DEFAULT NULL,
  `SellTax` float DEFAULT NULL,
  `TotalPrice` float DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `publications`
--

CREATE TABLE `publications` (
  `Id` int(11) NOT NULL,
  `Name` varchar(60) DEFAULT NULL,
  `Remarks` varchar(100) DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `publications`
--

INSERT INTO `publications` (`Id`, `Name`, `Remarks`, `CreatedDate`) VALUES
(2, 'Panjaree', NULL, '2021-06-02 21:05:13'),
(3, 'delete me', NULL, '2021-06-02 21:31:13'),
(4, 'Lecture', NULL, '2021-06-02 21:14:20'),
(6, 'Adil', NULL, '2021-06-02 21:30:20'),
(7, 'Schaums Series', NULL, '2021-06-06 06:38:08');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `Id` int(11) NOT NULL,
  `InvoiceNumber` varchar(50) DEFAULT NULL,
  `SupplierId` int(11) DEFAULT NULL,
  `PurchaseDate` date DEFAULT NULL,
  `GrandTotal` float DEFAULT NULL,
  `SubTotal` float DEFAULT NULL,
  `Discount` float DEFAULT NULL,
  `Dues` float DEFAULT NULL,
  `PaymentMode` varchar(30) DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`Id`, `InvoiceNumber`, `SupplierId`, `PurchaseDate`, `GrandTotal`, `SubTotal`, `Discount`, `Dues`, `PaymentMode`, `CreatedDate`) VALUES
(1, 'PUR-000001', 1, '2021-06-07', 999.6, 1020, 2, 0, 'Cash', '2021-06-07 12:28:09'),
(2, 'PUR-000002', 1, '2021-06-07', 816, 816, 0, 0, 'Cash', '2021-06-07 12:00:13'),
(3, 'PUR-000003', 5, '2021-06-07', 3500, 3500, 0, 0, 'Card', '2021-06-07 12:16:18'),
(4, 'PUR-000004', 11, '2021-06-07', 350, 350, 0, 0, 'Mobile Banking', '2021-06-07 12:34:19'),
(5, 'PUR-000005', 7, '2021-06-08', 10000, 10000, 0, 0, 'Cash', '2021-06-08 06:20:42');

-- --------------------------------------------------------

--
-- Table structure for table `purchasedetail`
--

CREATE TABLE `purchasedetail` (
  `Id` int(11) NOT NULL,
  `PurchaseId` int(11) DEFAULT NULL,
  `BookId` int(11) DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `PurchaseUnitPrice` float DEFAULT NULL,
  `SellUnitPrice` float DEFAULT NULL,
  `PurchaseTax` float DEFAULT NULL,
  `SellTax` float DEFAULT NULL,
  `TotalPrice` float DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchasedetail`
--

INSERT INTO `purchasedetail` (`Id`, `PurchaseId`, `BookId`, `Quantity`, `PurchaseUnitPrice`, `SellUnitPrice`, `PurchaseTax`, `SellTax`, `TotalPrice`, `CreatedDate`) VALUES
(1, 1, 2, 10, 100, 120, 2, NULL, 1020, '2021-06-07 12:28:09'),
(2, 2, 2, 8, 102, 120, 0, NULL, 816, '2021-06-07 12:00:13'),
(3, 3, 1, 10, 350, 375, 0, NULL, 3500, '2021-06-07 12:16:18'),
(4, 4, 1, 1, 350, 375, 0, NULL, 350, '2021-06-07 12:34:19'),
(5, 5, 3, 40, 250, 275, 0, NULL, 10000, '2021-06-08 06:20:42');

-- --------------------------------------------------------

--
-- Table structure for table `shipment`
--

CREATE TABLE `shipment` (
  `Id` int(11) NOT NULL,
  `InvoiceId` int(11) DEFAULT NULL,
  `ShipmentCharge` float DEFAULT NULL,
  `Status` varchar(30) DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `Id` int(11) NOT NULL,
  `BookId` int(11) DEFAULT NULL,
  `Quantity` float DEFAULT NULL,
  `UnitPrice` float DEFAULT NULL,
  `UpdatedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`Id`, `BookId`, `Quantity`, `UnitPrice`, `UpdatedDate`) VALUES
(1, 2, 18, 120, '2021-06-07 12:00:13'),
(2, 1, 11, 375, '2021-06-07 12:34:19'),
(3, 3, 40, 275, '2021-06-08 06:20:42');

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `Id` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`Id`, `Name`, `CreatedDate`) VALUES
(1, 'Laptop', '2021-06-02 21:23:38'),
(2, 'Mobile', '2021-06-02 21:28:38'),
(3, 'Programming', '2021-06-06 06:06:09'),
(4, 'Chemistry', '2021-06-08 06:06:40');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `Id` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Phone` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `PhotoUrl` varchar(255) DEFAULT NULL,
  `CompanyName` varchar(255) DEFAULT NULL,
  `Designation` varchar(255) DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`Id`, `Name`, `Phone`, `Email`, `Address`, `PhotoUrl`, `CompanyName`, `Designation`, `CreatedDate`) VALUES
(1, 'Shakil Rana', '094435345', 'shakil@sslebd.com', 'Kaliakoir', '', 'SSLE', 'Software Engineer', '2021-05-30 00:00:00'),
(3, 'mobole', '34545', 'skol@gmail.com', 'sdfdsf', '', '', '', '2021-05-31 17:08:13'),
(4, 'dataTable', '013434', 'datatable@gmail.com', 'adsdsds', '', 'dsfdf', 'dsfdsf', '2021-05-31 20:49:19'),
(5, 'knka freeze', '3454', 'konka@gmail.com', 'Manikgonj', '', 'some', 'Engineer', '2021-05-31 21:43:28'),
(7, 'sajib', '4353', 'safdsf', 'afdfdsf', '', 'dsfdsf', 'dsfdsfdsf', '2021-05-31 21:53:58'),
(11, 'validation', '32343', 'email@gmail.com', 'some address', '', '', '', '2021-06-01 07:06:21'),
(13, 'fdsfdsf', '323434', 'sfdsf@gmail.com', 'sdfdf', '', 'dsfdsf', 'dsfdfdsf', '2021-06-01 07:41:29'),
(14, 'dfdsgdg', '123', 'fgfhfh@gmail.com', '', '', '', '', '2021-06-01 19:17:58');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Id` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Phone` varchar(255) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `OutsideCity` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `PhotoUrl` varchar(255) DEFAULT NULL,
  `UserType` varchar(30) DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `Name`, `Email`, `Phone`, `Address`, `OutsideCity`, `Password`, `PhotoUrl`, `UserType`, `CreatedDate`) VALUES
(1, 'Super Admin', 'superadmin@gmail.com', '123', 'Kaliakoir', NULL, 'b715f831f1fee468d6b1760226035b29', '../public/layout/images/superadmin.jpg', 'SuperAdmin', '2021-05-29 14:01:13'),
(15, 'public', 'public@gmail.com', '123445456', 'some address', NULL, '202cb962ac59075b964b07152d234b70', '../public/image/1622624336admin.png', 'Admin', '2021-06-02 06:29:25'),
(16, 'without photo', 'whitout@gmail.com', '123', '123', NULL, '202cb962ac59075b964b07152d234b70', '', 'Admin', '2021-06-02 06:07:32'),
(17, 'Shakil Rana', 'skl@gmail.com', '435435', 'kaliakoir', NULL, '202cb962ac59075b964b07152d234b70', '../public/image/1622623459admin.png', 'Admin', '2021-06-02 14:19:44'),
(19, 'duplicate test', 'skl1@gmail.com', '234324', 'sdsgfdg', NULL, '202cb962ac59075b964b07152d234b70', '../public/image/1622624891admin.png', 'Admin', '2021-06-02 15:48:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Name` (`Name`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `companyinformation`
--
ALTER TABLE `companyinformation`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `invoicedetail`
--
ALTER TABLE `invoicedetail`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `publications`
--
ALTER TABLE `publications`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Name` (`Name`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `purchasedetail`
--
ALTER TABLE `purchasedetail`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `shipment`
--
ALTER TABLE `shipment`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Phone` (`Phone`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `companyinformation`
--
ALTER TABLE `companyinformation`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoicedetail`
--
ALTER TABLE `invoicedetail`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `publications`
--
ALTER TABLE `publications`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `purchasedetail`
--
ALTER TABLE `purchasedetail`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `shipment`
--
ALTER TABLE `shipment`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
