-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Dec 05, 2020 at 01:23 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hostelmanage`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `total_rooms` int(11) NOT NULL,
  `st_num` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `phone`, `total_rooms`, `st_num`) VALUES
(4, 'Ramya', 'ramya@gmail.com', 'ramya123', 8936634996, 200, 3),
(5, 'Sreeshma', 'sreeshma@gmail.com', 'sreeshma123', 658839, 50, 3),
(6, 'test', 'test@gmail.com', 'test', 6473940, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
CREATE TABLE IF NOT EXISTS `students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `parent_name` varchar(100) NOT NULL,
  `parent_phone` bigint(20) NOT NULL,
  `student_phone` bigint(20) NOT NULL,
  `address` varchar(200) NOT NULL,
  `work_or_college` varchar(200) NOT NULL,
  `room_no` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `hid`, `name`, `email`, `parent_name`, `parent_phone`, `student_phone`, `address`, `work_or_college`, `room_no`) VALUES
(1, 4, 'Sreeshma', 'sreeshma@gmail.com', 'Murali', 7388437829, 63489828, 'hbdshbb ds\r\ndfvjbdfj\r\nbjdbfb', 'IHRD college Puthenvelikkara', 1),
(12, 5, 'c', 'c@gmail.com', 'c', 73894, 37388998, 'fvhkjnnnl', 'c', 1),
(13, 5, 'Ramya', 'ramya@gmail.com', 'b', 3637839, 3738949, 'mbhbdhn', 'c', 2),
(16, 6, 'Ramya', 'a@gmail.com', 'Murali', 6347, 348789, 'sbdhb', 'hebdfb', 2),
(14, 6, 'f', 'f@gmail.com', 'f', 46478, 38399, 'f', 'f', 1),
(11, 5, 'b', 'b@gmail.com', 'b', 63749, 73849, 'hvhfh', 'b', 1),
(8, 4, 'Ramya', 'ramya@gmail.com', 'Murali', 638487, 374676, 'dbvhshf', 'IHRD college Puthenvelikkara', 2),
(9, 4, 'Rinoj', 'ray@gmail.com', 'James', 563477, 273783846, 'hsdvhjfdh\r\ndfjb', 'IHRD college Puthenvelikkara', 2);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
