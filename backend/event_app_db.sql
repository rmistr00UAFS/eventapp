-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 17, 2024 at 04:25 AM
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
-- Table structure for table `CATEGORY`
--

CREATE TABLE `CATEGORY` (
  `CA_ID` int(11) NOT NULL,
  `TYPE` varchar(30) DEFAULT NULL,
  `NAME` varchar(30) DEFAULT NULL,
  `EVENTID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `CATEGORY`
--

INSERT INTO `CATEGORY` (`CA_ID`, `TYPE`, `NAME`, `EVENTID`) VALUES
(1, 'Conference', 'Tech Conference', 101),
(2, 'Workshop', 'Coding Bootcamp', 102),
(3, 'Seminar', 'AI Seminar', 103),
(4, 'Meetup', 'Developer Meetup', 104),
(5, 'Webinar', 'Cloud Computing Webinar', 105);

-- --------------------------------------------------------

--
-- Table structure for table `EVENT`
--

CREATE TABLE `EVENT` (
  `EVENTID` int(11) NOT NULL,
  `TITLE` varchar(255) DEFAULT NULL,
  `INFO` varchar(255) DEFAULT NULL,
  `DATE` datetime DEFAULT NULL,
  `TIME` time DEFAULT NULL,
  `ADDRESS` varchar(255) DEFAULT NULL,
  `COORDINATES` varchar(255) DEFAULT NULL,
  `CATEGORYID` int(11) DEFAULT NULL,
  `USERID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `EVENT`
--

INSERT INTO `EVENT` (`EVENTID`, `TITLE`, `INFO`, `DATE`, `TIME`, `ADDRESS`, `COORDINATES`, `CATEGORYID`, `USERID`) VALUES
(39, 'Art in the Park', 'An open-air art exhibition showcasing local artists.', '2024-10-16 00:00:00', '10:00:00', 'Fort Smith, AR, 72901', '{\"lat\":35.3704608,\"lng\":-94.4130648}', 3, 29),
(40, 'Art in the Park', 'An open-air art exhibition showcasing local artists.', '2024-10-15 00:00:00', '10:00:00', 'Fort Smith, AR, 72901', '{\"lat\":35.3704608,\"lng\":-94.4130648}', 0, 29),
(41, 'Art', 'An open-air art exhibition showcasing local artists.', '2024-10-15 00:00:00', '10:00:00', 'Fort Smith, AR, 72901', '{\"lat\":35.3704608,\"lng\":-94.4130648}', 1, 29),
(42, 'CS Webinar', 'An open-air exhibition showcasing local artists.', '2024-10-17 00:00:00', '10:00:00', 'Fort Smith, AR, 72907', '{\"lat\":35.3843722,\"lng\":-94.42096459999999}', 5, 29);

-- --------------------------------------------------------

--
-- Table structure for table `SAVED_EVENTS`
--

CREATE TABLE `SAVED_EVENTS` (
  `ID` int(11) NOT NULL,
  `EVENTID` int(11) NOT NULL,
  `USERID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `SAVED_EVENTS`
--

INSERT INTO `SAVED_EVENTS` (`ID`, `EVENTID`, `USERID`) VALUES
(1, 30, 28),
(6, 38, 29),
(9, 41, 29),
(13, 42, 29);

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
(27, 'sidhgvflsdkfvbdwd', 'sss', '$2y$10$jDCJhip76AxuiB1U7Z.oY.fH9aVX.3xUrBdkk27cfaEOylKjrpUEe', 'john@example.com', '1234567890', '123 Main St, Springfield'),
(28, '', 'Doe', '$2y$10$gQiMaHLP8h/bozngJ8TJQ.SR.IT1BeLwpd.rGanux664htDIlclG.', 'xyz@x.com', '', ''),
(29, '', 'Doe', '$2y$10$jQcIy2lyv1gKMVGJ3U9NBemIIfcy2lpdWlkV8bVHgx.9./guV/hzO', 'sqs@wdww.com', '', '');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `SAVED_EVENTS`
--
ALTER TABLE `SAVED_EVENTS`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `USER`
--
ALTER TABLE `USER`
  ADD PRIMARY KEY (`USERID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `CATEGORY`
--
ALTER TABLE `CATEGORY`
  MODIFY `CA_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `EVENT`
--
ALTER TABLE `EVENT`
  MODIFY `EVENTID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `SAVED_EVENTS`
--
ALTER TABLE `SAVED_EVENTS`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `USER`
--
ALTER TABLE `USER`
  MODIFY `USERID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `CATEGORY`
--
ALTER TABLE `CATEGORY`
  ADD CONSTRAINT `CATEGORY_ibfk_1` FOREIGN KEY (`EVENTID`) REFERENCES `EVENT` (`EVENTID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
