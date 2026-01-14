-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2026 at 12:16 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `orked_mall`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminID` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `adPassword` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminID`, `username`, `adPassword`) VALUES
(1, 'admin', '$2y$10$isaNr.7gtDeuDDe2wXa.MuZkfBET6rv0P.WxnHVvQdymUuEuKNRGq');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `memberID` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `fullName` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phoneNum` varchar(20) DEFAULT NULL,
  `street` varchar(100) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `postcode` varchar(5) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `birthDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`memberID`, `email`, `fullName`, `password`, `phoneNum`, `street`, `city`, `postcode`, `state`, `birthDate`) VALUES
(1, 'n.rafhans29@gmail.com', 'Nur Rafhanah', '$2y$10$g9ISALGDGA0rdw1lAYagYued2ulgbiPRvlxEdw7kCSQ8SI/1I7/1a', '0155454125', 'No. 21, Jalan SG 2/1, Taman Sri Gombak', 'Batu Caves', '68100', 'Selangor', '2004-03-29'),
(2, 'mark@gmail.com', 'Mark Adam', '$2y$10$nOjHKKpDQqHkQaQN/q.JWOgCmLDYh2TSUpdP1Q3zWsJHJtZi.wtmq', '01258896584', 'No.38, Jalan IG 2/1, Taman Indah Gemilang', 'Shah Alam', '42500', 'Selangor', '2008-01-02'),
(3, 'karim23@gmail.com', 'Abdul Karim', '$2y$10$lSSeGSYPGKoHkrP50oFSOON7sAsudsizG1nY.QEODyt5PyTJv345O', '0128459675', 'No. 45, Jalan 2/1, Taman Indah Gemilang', 'Batu Caves', '68100', 'Selangor', '1995-02-23'),
(4, 'aisyah@gmail.com', 'Siti Aisyah', '$2y$10$xkZPSJMsR8GR9Z0BNgncO.yL3X4KC7lKkLZs5bb1OF/MqZZOb3srK', '0135698754', 'no. 32, Jalan Makmur, 2/5 Taman Sri Makmur', 'Batu Caves', '68100', 'Selangor', '1993-09-13');

-- --------------------------------------------------------

--
-- Table structure for table `membership`
--

CREATE TABLE `membership` (
  `membershipID` int(11) NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `memberID` int(11) NOT NULL,
  `mTypeID` int(11) NOT NULL,
  `paymentID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `membership`
--

INSERT INTO `membership` (`membershipID`, `startDate`, `endDate`, `memberID`, `mTypeID`, `paymentID`) VALUES
(5, '2026-01-14', '2027-01-14', 1, 1, 5),
(6, '2026-01-14', '2028-01-14', 2, 2, 6),
(7, '2026-01-14', '2028-01-14', 3, 2, 7),
(8, '2026-01-14', '2027-01-14', 4, 1, 8);

-- --------------------------------------------------------

--
-- Table structure for table `membership_type`
--

CREATE TABLE `membership_type` (
  `mTypeID` int(11) NOT NULL,
  `mTypeName` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `duration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `membership_type`
--

INSERT INTO `membership_type` (`mTypeID`, `mTypeName`, `price`, `duration`) VALUES
(1, 'Platinum', 160.00, 12),
(2, 'Gold', 240.00, 24);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `paymentID` int(11) NOT NULL,
  `paymentDate` date NOT NULL,
  `paymentStatus` enum('Pending','Completed','Failed') NOT NULL DEFAULT 'Pending',
  `amount` decimal(10,2) NOT NULL,
  `paymentMethod` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`paymentID`, `paymentDate`, `paymentStatus`, `amount`, `paymentMethod`) VALUES
(1, '2026-01-09', 'Completed', 240.00, 'Touch n Go'),
(2, '2026-01-09', 'Completed', 240.00, 'FPX'),
(3, '2026-01-10', 'Completed', 160.00, 'ShopeePay'),
(4, '2026-01-10', 'Completed', 160.00, 'Touch n Go'),
(5, '2026-01-14', '', 160.00, 'FPX'),
(6, '2026-01-14', '', 240.00, 'Card'),
(7, '2026-01-14', '', 240.00, 'GrabPay'),
(8, '2026-01-14', '', 160.00, 'ShopeePay');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminID`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`memberID`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `membership`
--
ALTER TABLE `membership`
  ADD PRIMARY KEY (`membershipID`),
  ADD KEY `fk_membership_member` (`memberID`),
  ADD KEY `fk_membership_type` (`mTypeID`),
  ADD KEY `fk_membership_payment` (`paymentID`);

--
-- Indexes for table `membership_type`
--
ALTER TABLE `membership_type`
  ADD PRIMARY KEY (`mTypeID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`paymentID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `memberID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `membership`
--
ALTER TABLE `membership`
  MODIFY `membershipID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `membership_type`
--
ALTER TABLE `membership_type`
  MODIFY `mTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `paymentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `membership`
--
ALTER TABLE `membership`
  ADD CONSTRAINT `fk_membership_member` FOREIGN KEY (`memberID`) REFERENCES `member` (`memberID`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_membership_payment` FOREIGN KEY (`paymentID`) REFERENCES `payment` (`paymentID`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_membership_type` FOREIGN KEY (`mTypeID`) REFERENCES `membership_type` (`mTypeID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
