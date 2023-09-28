-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 28, 2023 at 07:14 PM
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
-- Database: `freelaundryaccess`
--

-- --------------------------------------------------------

--
-- Table structure for table `contactform`
--

CREATE TABLE `contactform` (
  `contactID` int(11) NOT NULL,
  `contactName` varchar(50) NOT NULL,
  `contactEmail` varchar(100) NOT NULL,
  `contactPhone` varchar(20) NOT NULL,
  `comments` text NOT NULL,
  `formCreated` datetime NOT NULL,
  `emailSent` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `familymembers`
--

CREATE TABLE `familymembers` (
  `familyMemberID` int(11) NOT NULL,
  `participantID` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `dateOfBirth` date NOT NULL,
  `relationshipToParticipant` varchar(50) NOT NULL,
  `gender` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `participants`
--

CREATE TABLE `participants` (
  `participantID` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `dateOfBirth` date NOT NULL,
  `numberOfHousehold` int(11) NOT NULL,
  `numberOfAdults` int(11) NOT NULL,
  `NumberOfChildrenUnder12` int(11) NOT NULL,
  `NumberOfChildrenOver12` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `streetAddress` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `city` varchar(50) NOT NULL,
  `province` varchar(50) NOT NULL,
  `postalCode` varchar(10) NOT NULL,
  `currentHousingSituation` varchar(50) NOT NULL,
  `howDidYouFindProgram` varchar(200) NOT NULL,
  `formCreated` datetime NOT NULL,
  `consent` tinyint(1) NOT NULL,
  `participantReference` varchar(10) NOT NULL,
  `letter` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `participants`
--
DELIMITER $$
CREATE TRIGGER `update_participant_reference` BEFORE INSERT ON `participants` FOR EACH ROW BEGIN
    -- Set 'A' as the default value for the letter column
    IF NEW.letter IS NULL THEN
        SET NEW.letter = 'A';
    END IF;

    -- Set next_reference using SET
    SET @next_reference = (
        SELECT CONCAT(
            NEW.letter,
            LPAD(COALESCE(MAX(CAST(SUBSTRING(participantReference, 2) AS UNSIGNED)), 0) % 10000 + 1, 4, '0')
        )
        FROM participants
        WHERE letter = NEW.letter
    );

    -- If the number part exceeds or equals 9999, increment the letter
    IF CAST(SUBSTRING(@next_reference, 2) AS UNSIGNED) >= 9999 THEN
        SET NEW.letter = CHAR(ASCII(NEW.letter) + 1);
        SET @next_reference = CONCAT(NEW.letter, '0001');
    END IF;

    SET NEW.participantReference = @next_reference;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `partnership`
--

CREATE TABLE `partnership` (
  `partnerID` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `streetAddress` varchar(100) NOT NULL,
  `city` varchar(50) NOT NULL,
  `province` varchar(50) NOT NULL,
  `postalcode` varchar(10) NOT NULL,
  `numberOfWashers` int(11) NOT NULL,
  `numberOfDryers` int(11) NOT NULL,
  `hasAttendant` varchar(3) NOT NULL,
  `formCreated` datetime NOT NULL,
  `partnerReference` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `partnership`
--
DELIMITER $$
CREATE TRIGGER `before_partnership_insert` BEFORE INSERT ON `partnership` FOR EACH ROW BEGIN
    DECLARE unique_ref VARCHAR(10);
    DECLARE ref_exists INT;

    -- Generate a random number between 1 and 9999
    SET unique_ref = CONCAT('PT', LPAD(FLOOR(1 + (RAND() * 9999)), 4, '0'));

    -- Check if the generated reference already exists in the table
    SELECT COUNT(*) INTO ref_exists FROM Partnership WHERE partnerReference = unique_ref;

    -- If the reference already exists, generate a new one
    WHILE ref_exists > 0 DO
        SET unique_ref = CONCAT('PT', LPAD(FLOOR(1 + (RAND() * 9999)), 4, '0'));
        SELECT COUNT(*) INTO ref_exists FROM Partnership WHERE partnerReference = unique_ref;
    END WHILE;

    -- Set the generated unique partnerReference for the new entry
    SET NEW.partnerReference = unique_ref;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contactform`
--
ALTER TABLE `contactform`
  ADD PRIMARY KEY (`contactID`);

--
-- Indexes for table `familymembers`
--
ALTER TABLE `familymembers`
  ADD PRIMARY KEY (`familyMemberID`);

--
-- Indexes for table `participants`
--
ALTER TABLE `participants`
  ADD PRIMARY KEY (`participantID`);

--
-- Indexes for table `partnership`
--
ALTER TABLE `partnership`
  ADD PRIMARY KEY (`partnerID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contactform`
--
ALTER TABLE `contactform`
  MODIFY `contactID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `familymembers`
--
ALTER TABLE `familymembers`
  MODIFY `familyMemberID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `participants`
--
ALTER TABLE `participants`
  MODIFY `participantID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `partnership`
--
ALTER TABLE `partnership`
  MODIFY `partnerID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
