-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2026 at 06:17 AM
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
-- Database: `orkeddata`
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

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `memberID` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phoneNum` varchar(20) DEFAULT NULL,
  `street` varchar(100) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `postcode` varchar(5) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`memberID`, `email`, `firstName`, `lastName`, `password`, `phoneNum`, `street`, `city`, `postcode`, `state`) VALUES
(1, 'hana@gmail.com', 'Nur', 'Hanah', '$2y$10$3ZwOd4XxHRSHfVkeH.6bg.4B2aeL7P6bENBMGLuVblfz5kuBGhTAC', '0155454125', 'No. 21, Jalan SG 2/1, Taman Sri Gombak', 'Batu Caves', '68100', NULL),
(2, 'n.hana2@gmail.com', 'Nur', 'Rafhanah', '$2y$10$tRdPRA.Rxvq6Q34qZwKwqOZ5GEc59lC2ZLbxdLwVi8U.VEm63vVWi', '0155454125', 'No. 21, Jalan SG 2/1, Taman Sri Gombak', 'Batu Caves', '68100', NULL),
(3, 'ahmad1@gmail.com', 'Ahmad', 'Han', '$2y$10$KMm8cVXjZuDGCMJS.og78ujWjiUk3iaVFDMc/FjLcYTPYaTRlLUHi', '0155454125', 'No. 21, Jalan SG 2/1, Taman Sri Gombak', 'Batu Caves', '68100', 'Selangor'),
(5, 'amirul21@gmail.com', 'Nur', 'Amirul', '$2y$10$PrTCu9p.W5c/hv/2I2/eoeeaN2.9CNtvsNvrTn.hzI.wr3SQt8niO', '0155454125', 'No. 21, Jalan SG 2/1, Taman Sri Gombak', 'Batu Caves', '68100', 'Selangor'),
(6, 'huda@gmail.com', 'Huda', 'Willson', '$2y$10$PWiYI230s2iTyH65uLK/Pe7z.96HvD3Dkd9ZODrPId1/GUMSxI8a.', '0155454125', 'No. 21, Jalan SG 2/1, Taman Sri Gombak', 'Batu Caves', '68100', 'Selangor'),
(7, 'jane@gmail.com', 'Nur', 'Jane', '$2y$10$nJvbqASK/t6lYB4bb0b8MedKPN1l1GbnVYr4qLiV7w2A1QaG3aFx6', '0155454125', 'No. 21, Jalan SG 2/1, Taman Sri Gombak', 'Batu Caves', '68100', 'Selangor'),
(8, 'ahmadW@gmail.com', 'Ahmad', 'Will', '$2y$10$3M4ByOgOBSDTQFBVG.cPROpcIYN.1AnJo3L5RNeZYWOi53ph4PLg2', '0155454125', 'No. 21, Jalan SG 2/1, Taman Sri Gombak', 'Batu Caves', '68100', 'Selangor'),
(9, 'jas@gmail.com', 'jasni', 'zain', '$2y$10$w03SEDjelzHqbCKBa8o9tOuJr17d6L4Y1cK1uz1ld5WFvIslhLQp.', '0155454125', 'No. 21, Jalan SG 2/1, Taman Sri Gombak', 'Batu Caves', '68100', 'Selangor'),
(10, 'han@gmail.com', 'Ahmad', 'Han', '$2y$10$Q62HiQx6NUFYpkTN4EQCie9sfnJcKcKTVVSmbY0AqtMopjLbRMhoi', '0155454125', 'No. 21, Jalan SG 2/1, Taman Sri Gombak', 'Batu Caves', '68100', 'Selangor'),
(11, 'jay@gmail.com', 'Jay', 'Park', '$2y$10$6vBx8qWsnOOG5l/xRy0sFe2ltmZEsSLfXHvuH/0UFn8vW1owf6GW6', '0155454125', 'No. 21, Jalan SG 2/1, Taman Sri Gombak', 'Batu Caves', '68100', 'Selangor');

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
  `adminID` int(11) DEFAULT NULL,
  `paymentID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `membership`
--

INSERT INTO `membership` (`membershipID`, `startDate`, `endDate`, `memberID`, `mTypeID`, `adminID`, `paymentID`) VALUES
(2, '2026-01-07', '2027-01-07', 6, 1, NULL, NULL),
(3, '2026-01-07', '2027-01-07', 7, 1, NULL, NULL),
(4, '2026-01-07', '2027-01-07', 8, 1, NULL, NULL),
(5, '2026-01-07', '2027-01-07', 9, 1, NULL, NULL),
(6, '2026-01-07', '2028-01-07', 10, 2, NULL, NULL),
(7, '2026-01-07', '2028-01-07', 11, 2, NULL, NULL);

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
  `paymentStatus` enum('Pending','Completed','Failed') NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `paymentMethod` varchar(50) NOT NULL,
  `membershipID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  ADD KEY `memberID` (`memberID`),
  ADD KEY `mTypeID` (`mTypeID`),
  ADD KEY `adminID` (`adminID`);

--
-- Indexes for table `membership_type`
--
ALTER TABLE `membership_type`
  ADD PRIMARY KEY (`mTypeID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`paymentID`),
  ADD KEY `membershipID` (`membershipID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `memberID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `membership`
--
ALTER TABLE `membership`
  MODIFY `membershipID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `membership_type`
--
ALTER TABLE `membership_type`
  MODIFY `mTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `paymentID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `membership`
--
ALTER TABLE `membership`
  ADD CONSTRAINT `membership_ibfk_1` FOREIGN KEY (`memberID`) REFERENCES `member` (`memberID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `membership_ibfk_2` FOREIGN KEY (`mTypeID`) REFERENCES `membership_type` (`mTypeID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `membership_ibfk_3` FOREIGN KEY (`adminID`) REFERENCES `admin` (`adminID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`membershipID`) REFERENCES `membership` (`membershipID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
