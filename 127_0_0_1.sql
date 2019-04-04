-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2019 at 07:57 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aplusdb`
--
CREATE DATABASE IF NOT EXISTS `aplusdb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `aplusdb`;

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `ChatID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `SessionID` int(11) NOT NULL,
  `LogLocation` varchar(255) DEFAULT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`ChatID`, `UserID`, `SessionID`, `LogLocation`, `Timestamp`) VALUES
(71, 7, 62, '17689357911553928608.html', '2019-03-30 06:50:08'),
(72, 6, 62, '10926854911553928617.html', '2019-03-30 06:50:17');

-- --------------------------------------------------------

--
-- Table structure for table `line`
--

CREATE TABLE `line` (
  `LineID` int(11) NOT NULL,
  `SessionID` int(11) NOT NULL,
  `Color1` varchar(8) NOT NULL,
  `Color2` varchar(8) NOT NULL,
  `Width` int(2) NOT NULL,
  `Gradient` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `point`
--

CREATE TABLE `point` (
  `PointID` int(11) NOT NULL,
  `LineID` int(11) NOT NULL,
  `PointX` int(11) NOT NULL DEFAULT '0',
  `PointY` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `SessionID` int(11) NOT NULL,
  `SessionName` varchar(50) NOT NULL,
  `SessionCode` varchar(255) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`SessionID`, `SessionName`, `SessionCode`, `Timestamp`) VALUES
(62, 'Teach fafa fortnite', '16705301361553928607', '2019-03-30 06:50:07');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(20) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `UserPassword` varchar(255) NOT NULL,
  `Email` varchar(254) NOT NULL,
  `ShortBio` longtext,
  `PicName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserID`, `Username`, `FirstName`, `LastName`, `UserPassword`, `Email`, `ShortBio`, `PicName`) VALUES
(6, 'cloudMaster', 'fafa', 'ke', '$2y$10$h6QE8Qi9jM6r3hqyu5/TTuLZ.IDuvS58JIQkivvvAQMn3aAyRkp2q', 'fafa@league.com', 'Nothing here yet...', '15122474951553820024.png'),
(7, 'senorDavid', 'david', 'moreno', '$2y$10$o/SD9I1pHXNrZCgCvSQSVu0b5yF9NULdPff9cpuJqsVLHqYkMkHLe', 'david@fortniteisbetter.ca', 'They call me david.', '18200786351553819914.png');

-- --------------------------------------------------------

--
-- Table structure for table `usersession`
--

CREATE TABLE `usersession` (
  `UserID` int(11) NOT NULL,
  `SessionID` int(11) NOT NULL,
  `UserType` int(11) NOT NULL,
  `Status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usersession`
--

INSERT INTO `usersession` (`UserID`, `SessionID`, `UserType`, `Status`) VALUES
(6, 62, 2, 1),
(7, 62, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`ChatID`),
  ADD KEY `MessageID` (`ChatID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `SessionID` (`SessionID`);

--
-- Indexes for table `line`
--
ALTER TABLE `line`
  ADD PRIMARY KEY (`LineID`),
  ADD KEY `LineID` (`LineID`),
  ADD KEY `SessionID` (`SessionID`);

--
-- Indexes for table `point`
--
ALTER TABLE `point`
  ADD PRIMARY KEY (`PointID`),
  ADD KEY `LineID` (`LineID`),
  ADD KEY `PointID` (`PointID`);

--
-- Indexes for table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`SessionID`),
  ADD KEY `SessionID` (`SessionID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `usersession`
--
ALTER TABLE `usersession`
  ADD PRIMARY KEY (`UserID`,`SessionID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `SessionID` (`SessionID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `ChatID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `line`
--
ALTER TABLE `line`
  MODIFY `LineID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `point`
--
ALTER TABLE `point`
  MODIFY `PointID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `session`
--
ALTER TABLE `session`
  MODIFY `SessionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
