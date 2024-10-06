-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 06, 2024 at 12:36 AM
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
-- Database: `event_app_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `ATTENDENTEE`
--

CREATE TABLE `ATTENDENTEE` (
  `AT_ID` int(11) NOT NULL,
  `EMAIL` varchar(30) NOT NULL,
  `PHONE` varchar(30) NOT NULL,
  `ADDRESS` varchar(30) NOT NULL,
  `TIME` datetime NOT NULL,
  `DATE` date NOT NULL,
  `LOCATION` varchar(30) NOT NULL,
  `EVENTID` int(11) NOT NULL,
  `USERID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `CATEGORY`
--

CREATE TABLE `CATEGORY` (
  `CA_ID` int(11) NOT NULL,
  `TYPE` varchar(30) NOT NULL,
  `NAME` varchar(30) NOT NULL,
  `EVENTID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `EVENT`
--

CREATE TABLE `EVENT` (
  `EVENTID` int(11) NOT NULL,
  `TITLE` varchar(255) NOT NULL,
  `INFO` varchar(255) NOT NULL,
  `DATE` datetime NOT NULL,
  `TIME` time NOT NULL,
  `ADDRESS` varchar(255) NOT NULL,
  `COORDINATES` varchar(255) NOT NULL,
  `CATEGORYID` int(11) NOT NULL,
  `ORGANIZERID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `EVENT`
--

INSERT INTO `EVENT` (`EVENTID`, `TITLE`, `INFO`, `DATE`, `TIME`, `ADDRESS`, `COORDINATES`, `CATEGORYID`, `ORGANIZERID`) VALUES
(1, 'Tech Conference 2024', 'A conference about the latest in technology.', '2024-10-10 00:00:00', '09:00:00', 'Main Hall, Tech Park', '', 1, 2),
(2, 'Tech Conference 2024', 'A conference about the latest in technology.', '2024-10-10 00:00:00', '09:00:00', 'Main Hall, Tech Park', '', 1, 2),
(3, 'Tech Conference 2024', 'A conference about the latest in technology.', '2024-10-10 00:00:00', '09:00:00', 'Main Hall, Tech Park', '', 1, 2),
(4, 'Tech Conference 2024', 'A conference about the latest in technology.', '2024-10-10 00:00:00', '09:00:00', 'Main Hall, Tech Park', '', 1, 2),
(5, 'Tech Conference 2024', 'A conference about the latest in technology.', '2024-10-10 00:00:00', '09:00:00', 'Main Hall, Tech Park', '', 1, 2),
(6, 'Tech Conference 2024', 'A conference about the latest in technology.', '2024-10-10 00:00:00', '09:00:00', 'Main Hall, Tech Park', '', 1, 2),
(7, 'Tech Conference 2024', 'A conference about the latest in technology.', '2024-10-10 00:00:00', '09:00:00', 'Main Hall, Tech Park', '', 1, 2),
(8, 'Tech Conference 2024', 'A conference about the latest in technology.', '2024-10-10 00:00:00', '09:00:00', 'Main Hall, Tech Park', '', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `SAVED_EVENT_LIST`
--

CREATE TABLE `SAVED_EVENT_LIST` (
  `LISTID` int(11) NOT NULL,
  `TIME` datetime NOT NULL,
  `DATE` date NOT NULL,
  `LOCATION` varchar(50) NOT NULL,
  `LIST_DESCR` varchar(50) NOT NULL,
  `USERID` int(11) NOT NULL,
  `EVENTID` int(11) NOT NULL,
  `TYPE` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `USER`
--

CREATE TABLE `USER` (
  `USERID` int(11) NOT NULL,
  `FIRSTNAME` varchar(50) NOT NULL,
  `LASTNAME` varchar(50) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `PHONE` varchar(20) NOT NULL,
  `ADDRESS` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `USER`
--

INSERT INTO `USER` (`USERID`, `FIRSTNAME`, `LASTNAME`, `PASSWORD`, `EMAIL`, `PHONE`, `ADDRESS`) VALUES
(1, 'John', 'Doe', '$2y$10$mpGuj.ipLWwfylC995FVc..Ci3Ebx86qfesXsnr2F5EWCDZu4Nzzu', 'john@example.com', '1234567890', '123 Main St, Springfield'),
(2, 'John', 'Doe', '$2y$10$jfKVmmTOLf0DUIiVm1aM7OdqKDEL6W7pDGe4IYxD1deTlqsITxnuq', 'john@example.com', '1234567890', '123 Main St, Springfield'),
(3, 'John', 'Doe', '$2y$10$FCiDZsCiTaPtpAVY36YV6.4Svy5b.N3SSPmkhNfopdOEhs2v/F85q', 'john@example.com', '1234567890', '123 Main St, Springfield'),
(4, 'John', 'Doe', '$2y$10$q5z805Y0B3KDEXojoVAsxeOvj1pw28quZxeuzQ873jAun8YWp1tjK', 'john@example.com', '1234567890', '123 Main St, Springfield'),
(5, 'John', 'Doe', '$2y$10$QryTj951le6lbCex0uNc4OwPjjqRQ7rt97Wp/bocxNRbGaYRDZnN.', 'john@example.com', '1234567890', '123 Main St, Springfield'),
(6, 'John', 'Doe', '$2y$10$SEG4pJnBS40T1EX60MYzXOD3V2LgpNym7hVVB/iSjL2.YGORv3GrG', 'john@example.com', '1234567890', '123 Main St, Springfield'),
(7, 'John', 'Doe', '$2y$10$m4dyiF1H7xIl9l5qSCn/D.2dVywSjTiO1Ys3fmi7fJCVn4lN0gsP2', 'john@example.com', '1234567890', '123 Main St, Springfield'),
(8, 'John', 'Doe', '$2y$10$i3py.rsT1.0SeZGeCjf5BeAxZo.ToS0WgCuxv0RXBoBovqK8CJCNu', 'john@example.com', '1234567890', '123 Main St, Springfield'),
(9, 'John', 'Doe', '$2y$10$K/0.eVGZ7UQUhbukaeHhDOCry5MOxbWeJD8hRknGZoUTEzwPpz7e6', 'john@example.com', '1234567890', '123 Main St, Springfield'),
(10, 'John', 'Doe', '$2y$10$7YpFK.AH6qq7Kvt5zBriXuLLyY0Yi2PLMPpK3bUJRlYuYU7o5F/1S', 'john@example.com', '1234567890', '123 Main St, Springfield'),
(11, 'John', 'Doe', '$2y$10$TMlQFhKWDtfF8uzcoZp0a.46CkfuLSdFi45E2qNxdlmL8KmFTQ8vi', 'john@example.com', '1234567890', '123 Main St, Springfield'),
(26, 'ronak', 'Doe', '$2y$10$xz/vYgAywD2Ch5h13VOzoejl70kp5wXpTNIJFDyn6j2uNJW7A8dGK', 'john@example.com', '1234567890', '123 Main St, Springfield'),
(27, 'sidhgvflsdkfvbdwd', 'sss', '$2y$10$jDCJhip76AxuiB1U7Z.oY.fH9aVX.3xUrBdkk27cfaEOylKjrpUEe', 'john@example.com', '1234567890', '123 Main St, Springfield');

-- --------------------------------------------------------

--
-- Table structure for table `VENUE`
--

CREATE TABLE `VENUE` (
  `VENUEID` int(11) NOT NULL,
  `NAME` varchar(30) NOT NULL,
  `ADDRESS` varchar(30) NOT NULL,
  `CITY` varchar(30) NOT NULL,
  `STATE` varchar(30) NOT NULL,
  `ZIP` varchar(30) NOT NULL,
  `CAPACITY` int(11) NOT NULL,
  `EVENTID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ATTENDENTEE`
--
ALTER TABLE `ATTENDENTEE`
  ADD PRIMARY KEY (`AT_ID`),
  ADD KEY `USERID` (`USERID`),
  ADD KEY `EVENTID` (`EVENTID`);

--
-- Indexes for table `CATEGORY`
--
ALTER TABLE `CATEGORY`
  ADD PRIMARY KEY (`CA_ID`),
  ADD KEY `EVENTID` (`EVENTID`);

--
-- Indexes for table `EVENT`
--
ALTER TABLE `EVENT`
  ADD PRIMARY KEY (`EVENTID`),
  ADD KEY `CATEGORYID` (`CATEGORYID`);

--
-- Indexes for table `SAVED_EVENT_LIST`
--
ALTER TABLE `SAVED_EVENT_LIST`
  ADD PRIMARY KEY (`LISTID`),
  ADD KEY `USERID` (`USERID`),
  ADD KEY `EVENTID` (`EVENTID`);

--
-- Indexes for table `USER`
--
ALTER TABLE `USER`
  ADD PRIMARY KEY (`USERID`);

--
-- Indexes for table `VENUE`
--
ALTER TABLE `VENUE`
  ADD PRIMARY KEY (`VENUEID`),
  ADD KEY `EVENTID` (`EVENTID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `EVENT`
--
ALTER TABLE `EVENT`
  MODIFY `EVENTID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `USER`
--
ALTER TABLE `USER`
  MODIFY `USERID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ATTENDENTEE`
--
ALTER TABLE `ATTENDENTEE`
  ADD CONSTRAINT `ATTENDENTEE_ibfk_1` FOREIGN KEY (`USERID`) REFERENCES `USER` (`USERID`),
  ADD CONSTRAINT `ATTENDENTEE_ibfk_2` FOREIGN KEY (`EVENTID`) REFERENCES `EVENT` (`EVENTID`);

--
-- Constraints for table `CATEGORY`
--
ALTER TABLE `CATEGORY`
  ADD CONSTRAINT `CATEGORY_ibfk_1` FOREIGN KEY (`EVENTID`) REFERENCES `EVENT` (`EVENTID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
