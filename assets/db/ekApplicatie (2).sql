-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 13, 2020 at 12:44 PM
-- Server version: 10.1.44-MariaDB-0ubuntu0.18.04.1
-- PHP Version: 7.1.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ekApplicatie`
--

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `country_id` int(11) NOT NULL,
  `country_name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`country_id`, `country_name`) VALUES
(1, 'Turkije'),
(2, 'Italie'),
(3, 'Wales'),
(4, 'Zwitserland'),
(5, 'Denemarken'),
(6, 'Finland'),
(7, 'Belgie'),
(8, 'Rusland'),
(9, 'Nederland'),
(10, 'Oekraine'),
(11, 'Oostenrijk'),
(12, 'Engeland'),
(13, 'Kroatie'),
(14, 'Tsjechie'),
(15, 'Spanje'),
(16, 'Zweden'),
(17, 'Polen'),
(18, 'Portugal'),
(19, 'Frankrijk'),
(20, 'Duitsland');

-- --------------------------------------------------------

--
-- Table structure for table `poule`
--

CREATE TABLE `poule` (
  `poule_id` int(11) NOT NULL,
  `poule_administrator_id` int(11) NOT NULL,
  `poule_name` varchar(60) NOT NULL,
  `correct_country_id_1` int(11) DEFAULT NULL,
  `correct_country_id_2` int(11) DEFAULT NULL,
  `correct_country_id_3` int(11) DEFAULT NULL,
  `correct_country_id_4` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `poule`
--

INSERT INTO `poule` (`poule_id`, `poule_administrator_id`, `poule_name`, `correct_country_id_1`, `correct_country_id_2`, `correct_country_id_3`, `correct_country_id_4`) VALUES
(46, 53, 'Bittergarnituur', 9, 12, 20, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(60) DEFAULT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_email`, `user_password`) VALUES
(53, 'Michel Zuidema', 'sjarreldevis@gmail.com', '$2y$10$5uZYcnFGwrrxb1rDiycDCeP9RBXJES/5xcbq8DhcdYL39YwvVcNrO'),
(54, '', 'milanvried@gmail.com', '$2y$10$cQaf.0K9K5pQjoQuKLDmFO/mmTeMKSK5ZrwW7s3hwHwokibjdp3OW');

-- --------------------------------------------------------

--
-- Table structure for table `user_poule`
--

CREATE TABLE `user_poule` (
  `user_id` int(11) NOT NULL,
  `poule_id` int(11) NOT NULL,
  `user_sel_country_1` int(11) DEFAULT NULL,
  `user_sel_country_2` int(11) DEFAULT NULL,
  `user_sel_country_3` int(11) DEFAULT NULL,
  `user_sel_country_4` int(11) DEFAULT NULL,
  `points` int(3) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_poule`
--

INSERT INTO `user_poule` (`user_id`, `poule_id`, `user_sel_country_1`, `user_sel_country_2`, `user_sel_country_3`, `user_sel_country_4`, `points`) VALUES
(53, 46, 8, 12, 20, 10, 12);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `poule`
--
ALTER TABLE `poule`
  ADD PRIMARY KEY (`poule_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `poule`
--
ALTER TABLE `poule`
  MODIFY `poule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
