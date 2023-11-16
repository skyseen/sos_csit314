-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2023 at 09:13 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sos`
--
CREATE DATABASE IF NOT EXISTS `sos` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `sos`;
-- --------------------------------------------------------

--
-- Table structure for table `bid`
--

CREATE TABLE `bid` (
  `bidID` int(10) NOT NULL,
  `userID` int(10) NOT NULL,
  `workslotID` int(10) NOT NULL,
  `status` enum('pending','approved','rejected') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bid`
--

INSERT INTO `bid` (`bidID`, `userID`, `workslotID`, `status`) VALUES
(2, 5, 7, 'rejected'),
(3, 4, 7, 'pending'),
(4, 4, 1, 'approved'),
(5, 5, 2, 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `useraccount`
--

CREATE TABLE `useraccount` (
  `userID` int(10) NOT NULL,
  `userName` varchar(40) NOT NULL,
  `passWord` varchar(100) NOT NULL,
  `DOB` date NOT NULL,
  `userEmail` varchar(50) NOT NULL,
  `maxShiftCount` int(10) DEFAULT NULL,
  `profileID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `useraccount`
--

INSERT INTO `useraccount` (`userID`, `userName`, `passWord`, `DOB`, `userEmail`, `maxShiftCount`, `profileID`) VALUES
(1, 'admintest', '$2y$10$UBmGSoxUzo9X2febL8IPBO01fZ.Af2o8ZqC808Tp4wtbk0LNRo8DC', '1999-06-10', 'admin@gmail.com', NULL, 2023001),
(2, 'owner', '$2y$10$Z7k31fxrdCZHUvC0qU.8C.ywvsGXOzWNaiOG/ZuXaomlpt6Nsxep.', '1998-01-13', 'owner@gmail.com', NULL, 2023003),
(3, 'manager', '$2y$10$WK7eO65XIIHmNwaQnNSjrOQ88m7NkjebZ0UhlLZWovA8VsLO6hMWi', '2023-11-11', 'manager@gmail.com', NULL, 2023002),
(4, 'Ken Yi', '$2y$10$Bk2b7feKzTm2bakpva3kNO9HVTd/QfTg8.rYII.r4ToJmFolEzVEy', '2023-11-07', 'kenyi@gmail.com', 8, 2023004),
(5, 'BQ', '$2y$10$gFu8RuJoZ9DkoCEuiUzdMuMZm7Zu4mAialPJFPVad.LMXAlH66MUG', '2023-11-09', 'bq@gmail.com', 9, 2023004),
(6, 'SY', '$2y$10$XQTnH0cYT1XDdCZjPJ6Q2uoQn995TqsCQixiJV8iAuFNh9qYlWM0W', '2023-11-12', 'sy@gmail.com', 10, 2023004);

-- --------------------------------------------------------

--
-- Table structure for table `userprofile`
--

CREATE TABLE `userprofile` (
  `profileID` int(10) NOT NULL,
  `roleType` enum('System Admin','Cafe Manager','Cafe Staff','Cafe Owner') NOT NULL,
  `description` varchar(200) NOT NULL,
  `accessRight` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userprofile`
--

INSERT INTO `userprofile` (`profileID`, `roleType`, `description`, `accessRight`) VALUES
(2023001, 'System Admin', 'A system administrator, often referred to as a sysadmin, is a professional  responsible for managing and maintaining an organization\'s computer systems and network infrastructure. ', 'User account creation and management.'),
(2023002, 'Cafe Manager', 'As a Café Manager, you play a pivotal role in ensuring the smooth and efficient operation of our café.', 'Manage bid'),
(2023003, 'Cafe Owner', 'As a Café Owner, you are the driving force behind the success of your café business. ', 'Workslots Creation'),
(2023004, 'Cafe Staff', 'As a Café Staff member, you play a pivotal role in creating a positive and welcoming experience for our café\'s customers.	', 'Access to bid');

-- --------------------------------------------------------

--
-- Table structure for table `workslot`
--

CREATE TABLE `workslot` (
  `workslotID` int(10) NOT NULL,
  `role` enum('Cashier','Chef','Waiter') NOT NULL,
  `date` date NOT NULL,
  `shift` enum('AM','PM') NOT NULL,
  `slot` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `workslot`
--

INSERT INTO `workslot` (`workslotID`, `role`, `date`, `shift`, `slot`) VALUES
(1, 'Cashier', '2023-11-07', 'AM', 1),
(2, 'Chef', '2023-11-07', 'AM', 2),
(3, 'Waiter', '2023-11-07', 'AM', 2),
(4, 'Cashier', '2023-11-07', 'PM', 1),
(5, 'Chef', '2023-11-07', 'PM', 2),
(6, 'Waiter', '2023-11-07', 'PM', 2),
(7, 'Cashier', '2023-11-08', 'AM', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bid`
--
ALTER TABLE `bid`
  ADD PRIMARY KEY (`bidID`),
  ADD KEY `bid_FK1` (`userID`),
  ADD KEY `bid_FK2` (`workslotID`);

--
-- Indexes for table `useraccount`
--
ALTER TABLE `useraccount`
  ADD PRIMARY KEY (`userID`),
  ADD KEY `useraccount_FK1` (`profileID`) USING BTREE;

--
-- Indexes for table `userprofile`
--
ALTER TABLE `userprofile`
  ADD PRIMARY KEY (`profileID`);

--
-- Indexes for table `workslot`
--
ALTER TABLE `workslot`
  ADD PRIMARY KEY (`workslotID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bid`
--
ALTER TABLE `bid`
  MODIFY `bidID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `useraccount`
--
ALTER TABLE `useraccount`
  MODIFY `userID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `userprofile`
--
ALTER TABLE `userprofile`
  MODIFY `profileID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2023006;

--
-- AUTO_INCREMENT for table `workslot`
--
ALTER TABLE `workslot`
  MODIFY `workslotID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bid`
--
ALTER TABLE `bid`
  ADD CONSTRAINT `bid_FK1` FOREIGN KEY (`userID`) REFERENCES `useraccount` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bid_FK2` FOREIGN KEY (`workslotID`) REFERENCES `workslot` (`workslotID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `useraccount`
--
ALTER TABLE `useraccount`
  ADD CONSTRAINT `useraccount_FK1` FOREIGN KEY (`profileID`) REFERENCES `userprofile` (`profileID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
