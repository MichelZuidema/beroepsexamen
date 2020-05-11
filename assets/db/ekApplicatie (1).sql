-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 11, 2020 at 05:15 PM
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
  `poule_name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `poule`
--

INSERT INTO `poule` (`poule_id`, `poule_administrator_id`, `poule_name`) VALUES
(6, 6, 'bittergarnituur'),
(7, 8, 'bittergarnituur2'),
(17, 1, 'yeet'),
(18, 1, 'yeet'),
(19, 1, 'yeet'),
(20, 9, 'bittergarnituur20'),
(21, 9, 'bittergarnituur21'),
(22, 11, 'speedyTiger'),
(23, 12, 'speedyTigers'),
(24, 13, 'dsasadas'),
(25, 14, 'kobe');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(60) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(120) NOT NULL,
  `user_sel_country_1` int(11) DEFAULT NULL,
  `user_sel_country_2` int(11) DEFAULT NULL,
  `user_sel_country_3` int(11) DEFAULT NULL,
  `user_sel_country_4` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_email`, `user_password`, `user_sel_country_1`, `user_sel_country_2`, `user_sel_country_3`, `user_sel_country_4`) VALUES
(1, 'mzuidema', '83239@glr.nl', '$2y$10$9HrfZckxRGjcSpA//SkDCe0vleLLxrzlWS2iErh3iVBrQAqb27vV.', NULL, NULL, NULL, NULL),
(4, 'Michel', 'Kobe@gmail.com', '$2y$10$/WdVOeJHz1IBTyWdOrCX2ex9.PXQNUVP4RF8SeZwom7pQ/M8ON2aO', NULL, NULL, NULL, NULL),
(5, 'Michel', 'dasda@gmail.com', '$2y$10$COjWjYDPezUTTNxVdYfY.ewhmUTlXWM8MB59nFXYVh1uM5JaLdyHu', NULL, NULL, NULL, NULL),
(6, 'Michel1', 'michel1@gmail.com', '$2y$10$rydIjsF7zznPXeskJjP9v.CNrGOIC7SuyTVoD.DR/o5rS0QjtMkwq', NULL, NULL, NULL, NULL),
(7, 'Michel2', 'michel2@gmail.com', '$2y$10$rl2wN6g5lKjhkTPXa1JHaOzWPAdjCK5cxXN9Gnner4w1OA4Yh93Z2', NULL, NULL, NULL, NULL),
(8, 'Michel3', 'michel3@gmail.com', '$2y$10$/pL9LOmzmCRsld8PB9blxOBedOoSeact5MK4fOHA0tLJsjeiABjjq', NULL, NULL, NULL, NULL),
(9, 'michel5', 'michelg5@gmail.com', '$2y$10$p0gXLH2OLWV0PJ0tDgvlXOCE5.WBvtfDOB4rtxwbYLn2apxzJfKg2', NULL, NULL, NULL, NULL),
(11, 'michel9', 'michel9@gmail.com', '$2y$10$NqPNGOULxG4piHFiQ10SkuscPXjm2Adqn4TmZ7zLfKELfiy7a/4GO', NULL, NULL, NULL, NULL),
(12, 'michel10', 'michel10@gmail.com', '$2y$10$AgyueB4Ec6nzplB7HDSTQeP1MgBtUEwbn3YXihNsIbkQ16bpqeZS2', NULL, NULL, NULL, NULL),
(13, 'adskadksk', 'kdaskdk@gmail.com', '$2y$10$/GJ5o3qD1WgHvp9YdhOcQe6OFe7Bbf/jvx95mpZaaNiihsPVd.squ', NULL, NULL, NULL, NULL),
(14, 'zuidema', 'zuidema@gmail.com', '$2y$10$.18DPxXFunYk71FZhI8DzOZwlXK2pxoAcyAhCE9NAJE.pzhf5iqI2', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_poule`
--

CREATE TABLE `user_poule` (
  `user_id` int(11) NOT NULL,
  `poule_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_poule`
--

INSERT INTO `user_poule` (`user_id`, `poule_id`) VALUES
(9, 20),
(9, 21),
(11, 22),
(13, 24),
(14, 25);

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
  ADD PRIMARY KEY (`user_id`);

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
  MODIFY `poule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
