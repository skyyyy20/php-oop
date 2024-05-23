-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2024 at 07:16 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `loginmethod`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `UserName` varchar(255) DEFAULT NULL,
  `UserPass` varchar(255) DEFAULT NULL,
  `Firstname` varchar(255) DEFAULT NULL,
  `Lastname` varchar(255) DEFAULT NULL,
  `Birthday` date DEFAULT NULL,
  `Sex` varchar(255) DEFAULT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_profile_picture` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `UserName`, `UserPass`, `Firstname`, `Lastname`, `Birthday`, `Sex`, `user_email`, `user_profile_picture`) VALUES
(90020, 'Asle', 'Aslena01', NULL, NULL, NULL, NULL, '', ''),
(90021, 'oaka', '1234', NULL, NULL, NULL, NULL, '', ''),
(90022, 'ubehalaya', 'ube123', NULL, NULL, NULL, NULL, '', ''),
(90023, 'asleee', '12345', NULL, NULL, NULL, NULL, '', ''),
(90025, 'gummy', '123456', 'Gum', 'My', '2000-02-04', 'female', '', ''),
(90026, 'guyss', '12345', 'Guys', 'Ngapala', '2024-04-10', 'male', '', ''),
(90027, 'benten10', '12345', 'Ben', 'Ten', '2010-10-10', 'Male', '', ''),
(90028, 'jvquisto12', '11111', 'Jv', 'Quisto', '2003-12-12', 'Male', '', ''),
(90029, 'jcquisto12', '1111', 'Jc', 'Quisto', '2000-03-12', 'Female', '', ''),
(90030, 'jaquisto12', '11111', 'Ja', 'Quisto', '2005-05-12', 'Select Sex', '', ''),
(90031, 'ben', '', 'Ben', 'Ten', '2010-10-10', 'Female', '', ''),
(90032, 'b10', '1010', 'B', 'Ten', '2010-10-10', 'Female', '', ''),
(90033, 'bubble10', '11111', 'Bubble', 'Gum', '2005-03-10', 'Female', '', ''),
(90038, 'ronquillo123', '$2y$10$ltUy0/70ZB9WlzN.3RT8pemEfnZp3fbZqd1ydUduoGQb96Ygn.0ku', 'Jm', 'Ronquillo', '2000-11-06', 'Male', 'jmronquillo@gmail.com', 'uploads/ronquillo_2023-08-18_15-17-51.jpg'),
(90039, 'ronquillo', '$2y$10$ioEch6td4dSjZJu89hjQTelq8XT1x4ND05bOmitlX.zGfwryiEBAi', 'Jm', 'Ronquillo', '2000-11-06', 'Male', 'jmronquillo@gmail.com', 'uploads/ronquillo_2023-08-18_15-17-51_1716340811.jpg'),
(90040, 'jm', '$2y$10$kdfDCgelTuFv7GJ68XU4Oe1bMj54dLzcfu1okc3wNTmMIr52akK8O', 'Jm', 'Ronquillo', '2000-11-06', 'Male', 'jmronquillo@gmail.com', 'uploads/UAAP85-MVB-JM-Ronquillo-7809550.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user_address`
--

CREATE TABLE `user_address` (
  `user_add_id` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `user_add_street` varchar(255) NOT NULL,
  `user_add_barangay` varchar(255) NOT NULL,
  `user_add_city` varchar(255) NOT NULL,
  `user_add_province` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_address`
--

INSERT INTO `user_address` (`user_add_id`, `UserID`, `user_add_street`, `user_add_barangay`, `user_add_city`, `user_add_province`) VALUES
(5, 90038, 'Purok 1', 'Bolbok', 'Lipa City', 'Region IV-A (CALABARZON)'),
(6, 90039, 'Alip', 'Barangay 1 (Pob.)', 'Batangas City (Capital)', 'Region IV-A (CALABARZON)'),
(7, 90040, 'Purok 2', 'Balete', 'Batangas City (Capital)', 'Region IV-A (CALABARZON)');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `user_address`
--
ALTER TABLE `user_address`
  ADD PRIMARY KEY (`user_add_id`),
  ADD KEY `UserID` (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90042;

--
-- AUTO_INCREMENT for table `user_address`
--
ALTER TABLE `user_address`
  MODIFY `user_add_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_address`
--
ALTER TABLE `user_address`
  ADD CONSTRAINT `user_address_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
