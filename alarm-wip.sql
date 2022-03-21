-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Mar 16, 2022 at 01:24 PM
-- Server version: 8.0.27
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alarm`
--

-- --------------------------------------------------------

--
-- Table structure for table `Alarm`
--

CREATE TABLE `Alarm` (
  `alarmID` int NOT NULL,
  `userID` int NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `startTime` time NOT NULL,
  `AlarmeAreaID` int NOT NULL,
  `enabled` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Alarm`
--

INSERT INTO `Alarm` (`alarmID`, `userID`, `name`, `startTime`, `AlarmeAreaID`, `enabled`) VALUES
(2, 1, 'Alarme Padrão', '10:05:00', 1, 1),
(3, 1, 'Alarme Novo', '10:20:00', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `AlarmArea`
--

CREATE TABLE `AlarmArea` (
  `ID` int NOT NULL,
  `Nome` varchar(15) NOT NULL,
  `GPIO_PORT` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `AlarmArea`
--

INSERT INTO `AlarmArea` (`ID`, `Nome`, `GPIO_PORT`) VALUES
(1, 'Área Comum', 8);

-- --------------------------------------------------------

--
-- Table structure for table `AlarmSong`
--

CREATE TABLE `AlarmSong` (
  `alarmSongID` int NOT NULL,
  `songID` int NOT NULL,
  `alarmID` int NOT NULL,
  `songTime` int NOT NULL,
  `fadeinTime` int NOT NULL,
  `fadeoutTime` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `AlarmSong`
--

INSERT INTO `AlarmSong` (`alarmSongID`, `songID`, `alarmID`, `songTime`, `fadeinTime`, `fadeoutTime`) VALUES
(1, 1, 2, 30, 2, 2),
(2, 7, 3, 20, 5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `Song`
--

CREATE TABLE `Song` (
  `songID` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `path` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Song`
--

INSERT INTO `Song` (`songID`, `name`, `path`) VALUES
(16, 'Iza - Ginga.mp3', 'songs/Iza - Ginga.mp3');

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `userID` int NOT NULL,
  `user` varchar(30) NOT NULL,
  `password` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`userID`, `user`, `password`, `name`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Administrador');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Alarm`
--
ALTER TABLE `Alarm`
  ADD PRIMARY KEY (`alarmID`);

--
-- Indexes for table `AlarmArea`
--
ALTER TABLE `AlarmArea`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `AlarmSong`
--
ALTER TABLE `AlarmSong`
  ADD PRIMARY KEY (`alarmSongID`);

--
-- Indexes for table `Song`
--
ALTER TABLE `Song`
  ADD PRIMARY KEY (`songID`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Alarm`
--
ALTER TABLE `Alarm`
  MODIFY `alarmID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `AlarmArea`
--
ALTER TABLE `AlarmArea`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `AlarmSong`
--
ALTER TABLE `AlarmSong`
  MODIFY `alarmSongID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `Song`
--
ALTER TABLE `Song`
  MODIFY `songID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `userID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
