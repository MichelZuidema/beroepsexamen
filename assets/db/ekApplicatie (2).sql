-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 12, 2020 at 05:28 PM
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
(35, 24, 'bittergarnituur', 9, 12, 1, 5),
(36, 33, 'Michels Poule', 9, 12, 8, 16),
(37, 35, 'testing', NULL, NULL, NULL, NULL);

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
(24, 'Michel', 'sjarreldevis@gmail.coms', '$2y$10$jIqgM7yAmQ8lmTxOfV7pKOzOASPzrNVg7ud3buTCVIVrVDOrMUYIW'),
(25, 'mzuidema', 'mzuidema@com.com', '$2y$10$jIqgM7yAmQ8lmTxOfV7pKOzOASPzrNVg7ud3buTCVIVrVDOrMUYIW'),
(27, '', 'test@gmail.com', '$2y$10$d1lFFHqSMDWTdrayXFfgseKQIiXB.1vWP/UxEZS1tiqf3rOl/qzNK'),
(29, '', 'milanvried@gmail.coms', '$2y$10$eNhy0BP6E7LP8baSh9qKXOjmaaXqBwHPYNBeXBv5GiRqjb5DniSke'),
(31, '', 'rite@gmail.com', '$2y$10$HX6LHsJyfjRH5SFdjA5W.e0KG6jA2LROzLCuBQXGwR0i9xkzXJxOW'),
(32, '', 'ueet@gmail.com', '$2y$10$1d7Pk4sj6aCvFiKY2cTO8.yk.iIEuWhx9KXxdLbhOX6HQEZqr2FnK'),
(33, 'Michel', '83239@glr.nl', '$2y$10$RnqO.2j9GZrQQY7SsUK8Z.qXPEawgq49Xz16Tw3sc0UVA3h32XZVu'),
(34, '', 'sjarreldevis@gmail.com', '$2y$10$E.Ad3JO2Yd.xI0keu4L2o.ZqYjyfZoVE3Vq8jc.MD/xeTkdhIlbsS'),
(35, 'yeet', 'milanvried@gmail.com', '$2y$10$HnbjHaJT8hfQ9deC/kH1F.b79W4zHAwVvLMHGJFPMId4n4yT3I1Ta');

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
(9, 21, 1, 3, 20, 20, 0),
(24, 35, 9, 12, 1, 5, 5),
(0, 35, NULL, NULL, NULL, NULL, 0),
(29, 35, NULL, NULL, NULL, NULL, 7),
(32, 1, NULL, NULL, NULL, NULL, 0),
(32, 35, NULL, NULL, NULL, NULL, 0),
(33, 36, 4, 10, 8, 3, 5),
(34, 36, 10, 18, 13, 3, 0),
(35, 37, NULL, NULL, NULL, NULL, 0);

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
  MODIFY `poule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
