-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 05, 2022 at 08:28 PM
-- Server version: 10.4.26-MariaDB-1:10.4.26+maria~deb10-log
-- PHP Version: 7.3.33-5+ubuntu20.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student`
--

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `iCourseId` int(11) NOT NULL,
  `vCourse` varchar(50) DEFAULT NULL,
  `vProfessorName` varchar(50) DEFAULT NULL,
  `tDescription` text DEFAULT NULL,
  `iStatus` tinyint(2) DEFAULT 1,
  `dtCreatedAt` datetime DEFAULT current_timestamp(),
  `dtUpdatedAt` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `dtDeletedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`iCourseId`, `vCourse`, `vProfessorName`, `tDescription`, `iStatus`, `dtCreatedAt`, `dtUpdatedAt`, `dtDeletedAt`) VALUES
(1, 'PHP', 'Abhishek', 'test                                                    ', 1, '2022-09-05 20:14:30', '2022-09-05 20:16:32', NULL),
(2, 'JAVA', 'Abhishek', '                            test                                                                            ', 1, '2022-09-05 20:16:53', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `student_course_trance`
--

CREATE TABLE `student_course_trance` (
  `iStudentCourseId` int(11) NOT NULL,
  `iUserId` int(11) DEFAULT 0,
  `iCourseId` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_course_trance`
--

INSERT INTO `student_course_trance` (`iStudentCourseId`, `iUserId`, `iCourseId`) VALUES
(2, 3, 1),
(3, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `iUserId` int(11) NOT NULL,
  `iUserTypeId` int(11) DEFAULT 0,
  `vName` varchar(50) DEFAULT NULL,
  `vUsername` varchar(50) DEFAULT NULL,
  `vEmail` varchar(50) DEFAULT NULL,
  `vPassword` varchar(50) DEFAULT NULL,
  `vPhoneNumber` varchar(10) DEFAULT NULL,
  `iStatus` tinyint(2) DEFAULT 1,
  `dtCreatedAt` datetime DEFAULT current_timestamp(),
  `dtUpdatedAt` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `dtDeletedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`iUserId`, `iUserTypeId`, `vName`, `vUsername`, `vEmail`, `vPassword`, `vPhoneNumber`, `iStatus`, `dtCreatedAt`, `dtUpdatedAt`, `dtDeletedAt`) VALUES
(1, 1, 'admin', 'admin', 'sahus8349@gmail.com', '202cb962ac59075b964b07152d234b70', NULL, 1, '2022-09-05 18:06:32', '2022-09-05 20:01:16', NULL),
(3, 2, 'Abhishek Sahu', 'sahus12@gmail.com', 'sahus12@gmail.com', NULL, '8349667240', 1, '2022-09-05 19:50:08', '2022-09-05 20:24:17', NULL),
(4, 2, 'Ram', 'r1@gmail.com', 'r1@gmail.com', NULL, '8888888888', 1, '2022-09-05 20:20:32', '2022-09-05 20:21:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `iUserTypeId` int(11) NOT NULL COMMENT 'User Type Id',
  `vUserType` varchar(20) DEFAULT NULL COMMENT 'User Type',
  `iStatus` tinyint(2) DEFAULT 1 COMMENT 'Status (0 - Inactive, 1 - Active)',
  `dtCreatedAt` datetime DEFAULT current_timestamp() COMMENT 'Created Date',
  `dtUpdatedAt` datetime DEFAULT NULL ON UPDATE current_timestamp() COMMENT 'Updated Date',
  `dtDeletedAt` datetime DEFAULT NULL COMMENT 'Deleted Date'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`iUserTypeId`, `vUserType`, `iStatus`, `dtCreatedAt`, `dtUpdatedAt`, `dtDeletedAt`) VALUES
(1, 'admin', 1, '2022-09-05 18:05:51', NULL, NULL),
(2, 'student', 1, '2022-09-05 18:05:51', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`iCourseId`);

--
-- Indexes for table `student_course_trance`
--
ALTER TABLE `student_course_trance`
  ADD PRIMARY KEY (`iStudentCourseId`),
  ADD KEY `iUserId` (`iUserId`),
  ADD KEY `iCourseId` (`iCourseId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`iUserId`),
  ADD UNIQUE KEY `vUsername` (`vUsername`),
  ADD UNIQUE KEY `vEmail` (`vEmail`),
  ADD KEY `iUserTypeId` (`iUserTypeId`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`iUserTypeId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `iCourseId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `student_course_trance`
--
ALTER TABLE `student_course_trance`
  MODIFY `iStudentCourseId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `iUserId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `iUserTypeId` int(11) NOT NULL AUTO_INCREMENT COMMENT 'User Type Id', AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
