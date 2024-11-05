-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 02, 2024 at 12:53 AM
-- Server version: 10.11.9-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `D`
--

-- --------------------------------------------------------

--
-- Table structure for table `CATEGORIES`
--

CREATE TABLE `CATEGORIES` (
  `CATEGORY_ID` int(11) NOT NULL,
  `CATEGORY_NAME` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `CATEGORIES`
--

INSERT INTO `CATEGORIES` (`CATEGORY_ID`, `CATEGORY_NAME`) VALUES
(1, 'sport'),
(2, 'gaming'),
(3, 'movies'),
(4, 'music'),
(5, 'meetup'),
(6, 'studying'),
(7, 'pets'),
(8, 'dancing'),
(9, 'reading'),
(10, 'cosplay'),
(11, 'sewing'),
(12, 'hiking'),
(13, 'quilting'),
(14, 'tableTop'),
(15, 'cardGame');

-- --------------------------------------------------------

--
-- Table structure for table `EVENTS`
--

CREATE TABLE `EVENTS` (
  `EVENT_ID` int(11) NOT NULL,
  `EVENT_NAME` varchar(30) DEFAULT NULL,
  `EVENT_DESCR` varchar(255) DEFAULT NULL,
  `STREET_ADD` varchar(255) DEFAULT NULL,
  `CITY` varchar(30) DEFAULT NULL,
  `ZIPCODE` int(11) DEFAULT NULL,
  `CREATOR` int(11) DEFAULT NULL,
  `CATEGORY` int(11) DEFAULT NULL,
  `DATETIME` datetime DEFAULT NULL,
  `WEBSITE` varchar(255) DEFAULT NULL,
  `LATITUDE` float(10,6) DEFAULT NULL,
  `LONGITUDE` float(10,6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `EVENTS`
--

INSERT INTO `EVENTS` (`EVENT_ID`, `EVENT_NAME`, `EVENT_DESCR`, `STREET_ADD`, `CITY`, `ZIPCODE`, `CREATOR`, `CATEGORY`, `DATETIME`, `WEBSITE`, `LATITUDE`, `LONGITUDE`) VALUES
(2, 'Little Rock Food Festival', 'Annual food festival showcasing local Arkansas cuisine.', '546', 'LR', 72454, 1, 1, '2024-11-20 12:00:00', 'https://littlerockfoodfest.com', 1.000000, 1.000000),
(3, 'Arkansas Startup Expo', 'An event for showcasing Arkansas-based startups.', '546', 'LR', 72616, 1, 1, '2024-12-05 10:30:00', 'https://arkstartup.com', 1.000000, 1.000000),
(6, 'kjbkjb', 'lknk', 'lknlk', 'jbkjb', 72903, 6, 13, '2023-09-28 22:45:00', 'wwsw', 35.352680, -94.362694);

-- --------------------------------------------------------

--
-- Table structure for table `EVENT_STATUS`
--

CREATE TABLE `EVENT_STATUS` (
  `USER_ID` int(11) NOT NULL,
  `EVENT_ID` int(11) NOT NULL,
  `STATUS_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `EVENT_STATUS`
--

INSERT INTO `EVENT_STATUS` (`USER_ID`, `EVENT_ID`, `STATUS_ID`) VALUES
(2, 2, 2),
(6, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `REPLY`
--

CREATE TABLE `REPLY` (
  `REPLYID` int(11) NOT NULL,
  `REVIEWID` int(11) NOT NULL,
  `USERID` int(11) NOT NULL,
  `REPLY` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `REVIEWS`
--

CREATE TABLE `REVIEWS` (
  `REVIEWID` int(11) NOT NULL,
  `USERID` int(11) NOT NULL,
  `EVENTID` int(11) NOT NULL,
  `COMMENT` varchar(255) NOT NULL,
  `STARS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `STATUS`
--

CREATE TABLE `STATUS` (
  `STATUS_ID` int(11) NOT NULL,
  `STATUS_DESCR` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `STATUS`
--

INSERT INTO `STATUS` (`STATUS_ID`, `STATUS_DESCR`) VALUES
(1, 'Not Going'),
(2, 'Interested'),
(3, 'Going');

-- --------------------------------------------------------

--
-- Table structure for table `USERS`
--

CREATE TABLE `USERS` (
  `USER_ID` int(11) NOT NULL,
  `F_NAME` varchar(30) DEFAULT NULL,
  `L_NAME` varchar(30) DEFAULT NULL,
  `EMAIL` varchar(255) DEFAULT NULL,
  `PASSWORD` varchar(255) DEFAULT NULL,
  `ORGANIZATION` tinyint(1) DEFAULT NULL,
  `ADMIN` tinyint(1) DEFAULT NULL,
  `NOTIFICATIONS` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `USERS`
--

INSERT INTO `USERS` (`USER_ID`, `F_NAME`, `L_NAME`, `EMAIL`, `PASSWORD`, `ORGANIZATION`, `ADMIN`, `NOTIFICATIONS`) VALUES
(1, 'John', 'Doe', 'john.doe@example.com', 'password123', 1, 0, 1),
(2, 'Jane', 'Smith', 'jane.smith@example.com', 'password456', 0, 1, 1),
(3, 'Alice', 'Johnson', 'alice.j@example.com', 'alicePass789', 1, 0, 0),
(4, 'Bob', 'Williams', 'bob.williams@example.com', 'bobSecure456', 0, 0, 1),
(5, 'Charlie', 'Brown', 'charlie.brown@example.com', 'charlieStrongPass', 1, 1, 0),
(6, 'Daniel', 'Kiss', 'd@gmail.com', '$2y$10$eekLb/j.Fu7ZAh9QXkrjRuQcNj/4qGOasDezqYJpygeg81d3YoQle', 1, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `CATEGORIES`
--
ALTER TABLE `CATEGORIES`
  ADD PRIMARY KEY (`CATEGORY_ID`);

--
-- Indexes for table `EVENTS`
--
ALTER TABLE `EVENTS`
  ADD PRIMARY KEY (`EVENT_ID`),
  ADD KEY `CREATOR` (`CREATOR`),
  ADD KEY `CATEGORY` (`CATEGORY`);

--
-- Indexes for table `EVENT_STATUS`
--
ALTER TABLE `EVENT_STATUS`
  ADD PRIMARY KEY (`USER_ID`,`EVENT_ID`),
  ADD KEY `EVENT_ID` (`EVENT_ID`),
  ADD KEY `STATUS_ID` (`STATUS_ID`);

--
-- Indexes for table `REPLY`
--
ALTER TABLE `REPLY`
  ADD PRIMARY KEY (`REPLYID`);

--
-- Indexes for table `REVIEWS`
--
ALTER TABLE `REVIEWS`
  ADD PRIMARY KEY (`REVIEWID`);

--
-- Indexes for table `STATUS`
--
ALTER TABLE `STATUS`
  ADD PRIMARY KEY (`STATUS_ID`);

--
-- Indexes for table `USERS`
--
ALTER TABLE `USERS`
  ADD PRIMARY KEY (`USER_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `CATEGORIES`
--
ALTER TABLE `CATEGORIES`
  MODIFY `CATEGORY_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `EVENTS`
--
ALTER TABLE `EVENTS`
  MODIFY `EVENT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `REPLY`
--
ALTER TABLE `REPLY`
  MODIFY `REPLYID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `REVIEWS`
--
ALTER TABLE `REVIEWS`
  MODIFY `REVIEWID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `STATUS`
--
ALTER TABLE `STATUS`
  MODIFY `STATUS_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `USERS`
--
ALTER TABLE `USERS`
  MODIFY `USER_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `EVENTS`
--
ALTER TABLE `EVENTS`
  ADD CONSTRAINT `EVENTS_ibfk_1` FOREIGN KEY (`CREATOR`) REFERENCES `USERS` (`USER_ID`),
  ADD CONSTRAINT `EVENTS_ibfk_2` FOREIGN KEY (`CATEGORY`) REFERENCES `CATEGORIES` (`CATEGORY_ID`);

--
-- Constraints for table `EVENT_STATUS`
--
ALTER TABLE `EVENT_STATUS`
  ADD CONSTRAINT `EVENT_STATUS_ibfk_1` FOREIGN KEY (`USER_ID`) REFERENCES `USERS` (`USER_ID`),
  ADD CONSTRAINT `EVENT_STATUS_ibfk_2` FOREIGN KEY (`EVENT_ID`) REFERENCES `EVENTS` (`EVENT_ID`),
  ADD CONSTRAINT `EVENT_STATUS_ibfk_3` FOREIGN KEY (`STATUS_ID`) REFERENCES `STATUS` (`STATUS_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

