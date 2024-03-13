-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2024 at 12:48 PM
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
-- Database: `knygos`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategorijos`
--

CREATE TABLE `kategorijos` (
  `ID` int(11) NOT NULL,
  `kategorija` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategorijos`
--

INSERT INTO `kategorijos` (`ID`, `kategorija`) VALUES
(1, 'Nuotykių'),
(2, 'Romanai'),
(3, 'Psichologija'),
(4, 'Filosofija'),
(6, 'Religija'),
(7, 'Gyvūnai');

-- --------------------------------------------------------

--
-- Table structure for table `knygos`
--

CREATE TABLE `knygos` (
  `ID` int(11) NOT NULL,
  `pavadinimas` varchar(80) NOT NULL,
  `santrauka` text NOT NULL,
  `ISBN` bigint(20) NOT NULL,
  `nuotrauka` varchar(60) NOT NULL,
  `pslSk` int(11) NOT NULL,
  `kategorijosID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `knygos`
--

INSERT INTO `knygos` (`ID`, `pavadinimas`, `santrauka`, `ISBN`, `nuotrauka`, `pslSk`, `kategorijosID`) VALUES
(1, 'Sulopyta Širdis', 'Knyga apie skausmą ir prarasima', 14528, 'images/meile.jpg', 70, 3),
(2, 'Kartu su šeima', 'tai nuotykių knyga apie šeimą', 14525, 'images/Nuotykiai.jpg', 52, 1),
(3, 'Didžiosios skyrybos', 'Lewis knyga apie skyrybas reminatis kataliku suvokimu', 12546, 'images/psichologija.jpg', 78, 6);

-- --------------------------------------------------------

--
-- Table structure for table `megstami`
--

CREATE TABLE `megstami` (
  `ID` int(11) NOT NULL,
  `megstKnygID` int(11) NOT NULL,
  `megstVartID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `megstami`
--

INSERT INTO `megstami` (`ID`, `megstKnygID`, `megstVartID`) VALUES
(1, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `uzsakymai`
--

CREATE TABLE `uzsakymai` (
  `ID` int(11) NOT NULL,
  `vartotojoID` int(11) NOT NULL,
  `knygosID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uzsakymai`
--

INSERT INTO `uzsakymai` (`ID`, `vartotojoID`, `knygosID`) VALUES
(1, 2, 1),
(2, 2, 2),
(3, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `vartotojai`
--

CREATE TABLE `vartotojai` (
  `ID` int(11) NOT NULL,
  `vardas` varchar(30) NOT NULL,
  `tipas` varchar(30) NOT NULL,
  `kodSlaptazodis` varchar(85) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vartotojai`
--

INSERT INTO `vartotojai` (`ID`, `vardas`, `tipas`, `kodSlaptazodis`) VALUES
(1, 'Jonas', 'admin', '$2y$10$pWS.FeQE7MNejnVK/cnH5OM1jCD7X/UbD06A4YaRPqLsUpegionO.'),
(2, 'Lina', 'skait', '$2y$10$t/w3L9Nze7RyYx2hvMPjZO0iXGBRHErc1crwhhpPnDKyGr/af3Dt.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategorijos`
--
ALTER TABLE `kategorijos`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `knygos`
--
ALTER TABLE `knygos`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `kategorijosID` (`kategorijosID`);

--
-- Indexes for table `megstami`
--
ALTER TABLE `megstami`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `megstKnygID` (`megstKnygID`,`megstVartID`),
  ADD KEY `megstVartID` (`megstVartID`);

--
-- Indexes for table `uzsakymai`
--
ALTER TABLE `uzsakymai`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `vartotojoID` (`vartotojoID`,`knygosID`),
  ADD KEY `knygosID` (`knygosID`);

--
-- Indexes for table `vartotojai`
--
ALTER TABLE `vartotojai`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategorijos`
--
ALTER TABLE `kategorijos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `knygos`
--
ALTER TABLE `knygos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `megstami`
--
ALTER TABLE `megstami`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `uzsakymai`
--
ALTER TABLE `uzsakymai`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vartotojai`
--
ALTER TABLE `vartotojai`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `knygos`
--
ALTER TABLE `knygos`
  ADD CONSTRAINT `knygos_ibfk_1` FOREIGN KEY (`kategorijosID`) REFERENCES `kategorijos` (`ID`);

--
-- Constraints for table `megstami`
--
ALTER TABLE `megstami`
  ADD CONSTRAINT `megstami_ibfk_1` FOREIGN KEY (`megstKnygID`) REFERENCES `knygos` (`ID`),
  ADD CONSTRAINT `megstami_ibfk_2` FOREIGN KEY (`megstVartID`) REFERENCES `vartotojai` (`ID`);

--
-- Constraints for table `uzsakymai`
--
ALTER TABLE `uzsakymai`
  ADD CONSTRAINT `uzsakymai_ibfk_1` FOREIGN KEY (`knygosID`) REFERENCES `knygos` (`ID`),
  ADD CONSTRAINT `uzsakymai_ibfk_2` FOREIGN KEY (`vartotojoID`) REFERENCES `vartotojai` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
