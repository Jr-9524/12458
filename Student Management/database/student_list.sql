-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 31, 2024 at 03:50 PM
-- Server version: 8.0.39
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student_list`
--

-- --------------------------------------------------------

--
-- Table structure for table `bscs2d`
--

CREATE TABLE `bscs2d` (
  `stud-id` varchar(20) NOT NULL,
  `firstName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `mi` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `stud-gender` varchar(10) NOT NULL,
  `stud-status` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bscs2d`
--

INSERT INTO `bscs2d` (`stud-id`, `firstName`, `lastName`, `mi`, `stud-gender`, `stud-status`) VALUES
('123', 'Jhon Ruzzel ', 'Olan', 'L', 'Male', 'Regular'),
('124', 'Reniel', 'Borela', 'A', 'Male', 'Regular'),
('125', 'Ivan', 'Bautista', '', 'Male', 'Regular'),
('23123', 'asdadw', 'adaw', 'AS', 'Male', 'Irregular'),
('3232', 'Jhon Ruzzel L Olan', 'asd', 'L', 'Male', 'Regular'),
('6468', 'Asdw', 'awdawd', 'ad', 'Female', 'Irregular');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bscs2d`
--
ALTER TABLE `bscs2d`
  ADD PRIMARY KEY (`stud-id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
