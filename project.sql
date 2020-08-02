-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 24, 2020 at 09:45 AM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `AID` int(11) NOT NULL AUTO_INCREMENT,
  `AName` varchar(255) NOT NULL,
  `AUsername` varchar(255) NOT NULL,
  `APassword` varchar(255) NOT NULL,
  PRIMARY KEY (`AID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`AID`, `AName`, `AUsername`, `APassword`) VALUES
(1, 'Frimpong', 'admin', '21232f297a57a5a743894a0e4a801fc3'),
(2, 'Admin2', 'admin2', 'c84258e9c39059a89ab77d846ddab909');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

DROP TABLE IF EXISTS `attendance`;
CREATE TABLE IF NOT EXISTS `attendance` (
  `AID` int(11) NOT NULL AUTO_INCREMENT,
  `SID` int(11) NOT NULL,
  `LID` int(11) NOT NULL,
  `ClassID` int(11) NOT NULL,
  `CourseID` int(11) NOT NULL,
  `CRDate` varchar(255) NOT NULL,
  PRIMARY KEY (`AID`),
  KEY `SID` (`SID`),
  KEY `LID` (`LID`),
  KEY `ClassID` (`ClassID`),
  KEY `CourseID` (`CourseID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `classreservation`
--

DROP TABLE IF EXISTS `classreservation`;
CREATE TABLE IF NOT EXISTS `classreservation` (
  `CRID` int(11) NOT NULL AUTO_INCREMENT,
  `ClassID` int(11) NOT NULL,
  `CourseID` int(11) NOT NULL,
  `SID` int(11) NOT NULL,
  `CRDate` varchar(255) NOT NULL,
  PRIMARY KEY (`CRID`),
  KEY `ClassID` (`ClassID`),
  KEY `CourseID` (`CourseID`),
  KEY `SID` (`SID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `classroom`
--

DROP TABLE IF EXISTS `classroom`;
CREATE TABLE IF NOT EXISTS `classroom` (
  `ClassID` int(11) NOT NULL AUTO_INCREMENT,
  `CourseID` int(11) NOT NULL,
  `Slot` varchar(255) NOT NULL,
  `Capacity` varchar(255) NOT NULL,
  `Location` varchar(255) NOT NULL,
  `StartTime` varchar(255) NOT NULL,
  `EndTime` varchar(255) NOT NULL,
  `ClassDate` varchar(255) NOT NULL,
  PRIMARY KEY (`ClassID`),
  KEY `CourseID` (`CourseID`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `classroom`
--

INSERT INTO `classroom` (`ClassID`, `CourseID`, `Slot`, `Capacity`, `Location`, `StartTime`, `EndTime`, `ClassDate`) VALUES
(20, 4, '4', '4', 'Mingde Building N602', '01:30 PM', '03:30 PM', '07/01/2020'),
(21, 7, '6', '6', 'Mingde Building N502', '10:10 AM', '12:10 PM', '06/01/2020'),
(22, 8, '5', '5', 'Wende Building S303', '01:30 PM', '04:30 PM', '07/01/2020'),
(23, 9, '5', '6', 'Mingde Building N101', '10:10 AM', '01:10 PM', '07/01/2020'),
(24, 12, '3', '4', 'YiFu Building', '03:40 PM', '05:40 PM', '07/01/2020'),
(28, 13, '4', '4', 'Reading Academy N213', '05:45 PM', '06:45 PM', '06/01/2020'),
(30, 2, '6', '6', 'Wende Building N505', '08:30 AM', '10:30 AM', '07/01/2020'),
(31, 14, '11', '20', 'Minde Building N406', '09:30 AM', '10:30 AM', '07/01/2020');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

DROP TABLE IF EXISTS `course`;
CREATE TABLE IF NOT EXISTS `course` (
  `CourseID` int(11) NOT NULL AUTO_INCREMENT,
  `CourseName` varchar(255) NOT NULL,
  `LID` int(11) NOT NULL,
  `CourseDesc` varchar(255) NOT NULL,
  `Session` varchar(255) NOT NULL,
  `Hours` varchar(255) NOT NULL,
  PRIMARY KEY (`CourseID`),
  KEY `LID` (`LID`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`CourseID`, `CourseName`, `LID`, `CourseDesc`, `Session`, `Hours`) VALUES
(2, 'Java Programming', 6, 'Learn Java Programming with Object-Oriented Programming. ', '1', '2'),
(4, 'Python Programming', 4, 'Python is the most popular programming language in the world. ', '2', '2'),
(7, 'Web Development', 5, 'Learn Front-End (HTML, CSS, JavaScript) and Back-End (SQL)', '1', '2'),
(8, 'Chinese Language', 5, 'Learn Chinese Language and pass your HSK exams with flying colors.', '2', '3'),
(9, 'C++ Programming', 4, 'Learn C++ Programming ', '1', '3'),
(10, 'Internet of Things', 5, 'Internet of Things', '1', '2'),
(11, 'Machine Learning ', 4, 'Machine Learning with Python', '2', '3'),
(12, 'Accounting', 6, 'Learn Accounting', '1', '2'),
(13, 'Algorithm Design', 1, 'Algorithm Design', '1', '1'),
(14, 'Object Oriented Programming', 7, 'OOP java and python', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `lecturer`
--

DROP TABLE IF EXISTS `lecturer`;
CREATE TABLE IF NOT EXISTS `lecturer` (
  `LID` int(11) NOT NULL AUTO_INCREMENT,
  `LName` varchar(255) NOT NULL,
  `LUsername` varchar(255) NOT NULL,
  `LPassword` varchar(255) NOT NULL,
  PRIMARY KEY (`LID`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lecturer`
--

INSERT INTO `lecturer` (`LID`, `LName`, `LUsername`, `LPassword`) VALUES
(1, 'Dr. Sunih', 'sunih', 'e10adc3949ba59abbe56e057f20f883e'),
(4, 'Dr. Yingnan Zhao', 'yingnanzhao', 'e10adc3949ba59abbe56e057f20f883e'),
(5, 'Mr. Zheng Yu', 'zhengyu', 'e10adc3949ba59abbe56e057f20f883e'),
(6, 'Dr. Fang Wei', 'fangwei', 'e10adc3949ba59abbe56e057f20f883e'),
(7, 'Linda Java', 'lindajava', 'e10adc3949ba59abbe56e057f20f883e'),
(8, 'Guo Ping', 'guoping', 'e10adc3949ba59abbe56e057f20f883e'),
(9, 'Fan Chunnian', 'fanchunnian', 'e10adc3949ba59abbe56e057f20f883e'),
(10, 'He Wenjian', 'hewenjian', 'e10adc3949ba59abbe56e057f20f883e'),
(11, 'Wang Nan', 'wangnan', 'e10adc3949ba59abbe56e057f20f883e'),
(12, 'Zhang Xiuzai', 'zhangxiuzai', 'e10adc3949ba59abbe56e057f20f883e'),
(13, 'Saad Ahmed Javed', 'saadahmed', 'e10adc3949ba59abbe56e057f20f883e'),
(14, 'Wang Haibin', 'wanghaibin', 'e10adc3949ba59abbe56e057f20f883e'),
(15, 'Feng Yun', 'fengyun', 'e10adc3949ba59abbe56e057f20f883e'),
(16, 'Liu Xiang', 'liuxiang', 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `OrderID` int(11) NOT NULL AUTO_INCREMENT,
  `ClassID` int(11) NOT NULL,
  `CourseID` int(11) NOT NULL,
  `SID` int(11) NOT NULL,
  `OrderDate` varchar(255) NOT NULL,
  PRIMARY KEY (`OrderID`),
  KEY `ClassID` (`ClassID`),
  KEY `CourseID` (`CourseID`),
  KEY `SID` (`SID`)
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`OrderID`, `ClassID`, `CourseID`, `SID`, `OrderDate`) VALUES
(43, 20, 4, 5, '04/03/2020'),
(44, 22, 8, 1, '04/03/2020'),
(45, 21, 7, 1, '04/03/2020'),
(46, 23, 9, 1, '04/03/2020'),
(49, 20, 4, 6, '04/04/2020'),
(50, 21, 7, 6, '04/04/2020'),
(51, 23, 9, 6, '04/04/2020'),
(52, 22, 8, 6, '04/04/2020'),
(53, 24, 12, 5, '04/04/2020'),
(57, 28, 13, 4, '04/07/2020'),
(58, 20, 4, 4, '04/07/2020'),
(59, 21, 7, 4, '04/07/2020'),
(60, 22, 8, 4, '04/07/2020'),
(61, 23, 9, 4, '04/07/2020'),
(62, 24, 12, 4, '04/07/2020'),
(63, 28, 13, 6, '04/07/2020'),
(64, 28, 13, 1, '04/10/2020'),
(66, 30, 2, 4, '04/12/2020'),
(68, 21, 7, 13, '04/12/2020'),
(69, 28, 13, 13, '04/12/2020'),
(70, 30, 2, 14, '04/13/2020'),
(71, 23, 9, 5, '04/13/2020'),
(72, 30, 2, 5, '04/13/2020'),
(74, 31, 14, 3, '04/15/2020'),
(75, 31, 14, 1, '04/15/2020'),
(76, 31, 14, 5, '04/15/2020'),
(77, 31, 14, 4, '04/15/2020'),
(78, 31, 14, 6, '04/15/2020'),
(79, 31, 14, 13, '04/15/2020'),
(80, 31, 14, 14, '04/15/2020'),
(81, 31, 14, 19, '04/15/2020'),
(82, 31, 14, 2, '04/15/2020'),
(83, 30, 2, 19, '04/15/2020'),
(84, 20, 4, 19, '04/15/2020'),
(85, 21, 7, 19, '04/15/2020'),
(86, 22, 8, 19, '04/15/2020'),
(87, 23, 9, 19, '04/15/2020'),
(88, 24, 12, 19, '04/15/2020'),
(89, 31, 14, 25, '04/15/2020');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `SID` int(11) NOT NULL AUTO_INCREMENT,
  `SName` varchar(255) NOT NULL,
  `SUsername` varchar(255) NOT NULL,
  `SPassword` varchar(255) NOT NULL,
  `SEmail` varchar(255) NOT NULL,
  PRIMARY KEY (`SID`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`SID`, `SName`, `SUsername`, `SPassword`, `SEmail`) VALUES
(1, 'Bryan Burusi', '20165308003', 'e10adc3949ba59abbe56e057f20f883e', 'kengwei91@hotmail.com'),
(2, 'Chris Gyan', '20165308009', 'e10adc3949ba59abbe56e057f20f883e', 'chris@gmail.com'),
(3, 'Bernard Kwakye', '20165308002', 'e10adc3949ba59abbe56e057f20f883e', 'xuan@gmail.com'),
(4, 'Daxelle Yakubu', '20165308006', 'e10adc3949ba59abbe56e057f20f883e', 'samiul@gmail.com'),
(5, 'Mohammad Aziz', '20165308004', 'e10adc3949ba59abbe56e057f20f883e', 'rafidz@gmail.com'),
(6, 'Mike Xzibit', '20165308010', 'e10adc3949ba59abbe56e057f20f883e', 'kengwei99@gmail.com'),
(13, 'Raphael Anadumba', '20165308011', 'e10adc3949ba59abbe56e057f20f883e', 'raf@gmail.com'),
(14, 'Thierry Scott', '20165308012', 'e10adc3949ba59abbe56e057f20f883e', 'thierry@gmail.com'),
(19, 'Osei Frimpong', '20165308007', 'e10adc3949ba59abbe56e057f20f883e', 'fosei@gmail.com'),
(20, 'Anesto Michael', '20165308008', 'e10adc3949ba59abbe56e057f20f883e', 'anesto@gmail.com'),
(21, 'Tetelesti Oppong-Baah', '20165305001', 'e10adc3949ba59abbe56e057f20f883e', 'lesti@gmail.com'),
(22, 'Addai Mabel', '20165305002', 'e10adc3949ba59abbe56e057f20f883e', 'bella@gmail.com'),
(23, 'Nana Ama Konadu', '20165305003', 'e10adc3949ba59abbe56e057f20f883e', 'nanaama@gmail.com'),
(24, 'Yals Elliasu', '20175307001', 'e10adc3949ba59abbe56e057f20f883e', 'yalley@nuist.edu.cn'),
(25, 'Valentina Boamah', '20175305001', 'e10adc3949ba59abbe56e057f20f883e', 'valentina@nuist.edu.cn');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`SID`) REFERENCES `student` (`SID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `attendance_ibfk_2` FOREIGN KEY (`LID`) REFERENCES `lecturer` (`LID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `attendance_ibfk_3` FOREIGN KEY (`ClassID`) REFERENCES `classroom` (`ClassID`) ON DELETE CASCADE,
  ADD CONSTRAINT `attendance_ibfk_4` FOREIGN KEY (`CourseID`) REFERENCES `course` (`CourseID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `classreservation`
--
ALTER TABLE `classreservation`
  ADD CONSTRAINT `classreservation_ibfk_1` FOREIGN KEY (`ClassID`) REFERENCES `classroom` (`ClassID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `classreservation_ibfk_2` FOREIGN KEY (`CourseID`) REFERENCES `course` (`CourseID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `classreservation_ibfk_3` FOREIGN KEY (`SID`) REFERENCES `student` (`SID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `classroom`
--
ALTER TABLE `classroom`
  ADD CONSTRAINT `classroom_ibfk_1` FOREIGN KEY (`CourseID`) REFERENCES `course` (`CourseID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_ibfk_1` FOREIGN KEY (`LID`) REFERENCES `lecturer` (`LID`) ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`ClassID`) REFERENCES `classroom` (`ClassID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`CourseID`) REFERENCES `course` (`CourseID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`SID`) REFERENCES `student` (`SID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
