-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2024 at 09:12 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `movie_rating`
--

-- --------------------------------------------------------

--
-- Table structure for table `movie`
--

CREATE TABLE `movie` (
  `id` int(11) NOT NULL,
  `movie_name` varchar(255) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `release_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movie`
--

INSERT INTO `movie` (`id`, `movie_name`, `genre`, `release_date`) VALUES
(1, 'Home Alone', 'Comedy', '1996-04-01'),
(7, 'The Godfather', 'Crime', '1972-04-01'),
(8, 'Avengers: Endgame', 'Action', '2022-06-03'),
(37, 'The nun', 'horror', '2024-06-28');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `rating` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `user_id`, `movie_id`, `rating`) VALUES
(83, 19, 1, 0.50),
(84, 19, 7, 4.30),
(85, 19, 8, 4.90),
(86, 19, 17, 5.00),
(87, 19, 18, 2.20),
(88, 20, 1, 4.20),
(89, 20, 7, 0.60),
(90, 20, 8, 5.00),
(91, 20, 17, 5.00),
(92, 31, 32, 4.50),
(94, 19, 37, 4.80),
(95, 48, 37, 3.00),
(96, 48, 1, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(999) NOT NULL,
  `phone` varchar(99) NOT NULL,
  `password` varchar(999) NOT NULL,
  `email` varchar(999) NOT NULL,
  `role` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `phone`, `password`, `email`, `role`) VALUES
(1, 'anik', '1600000000', 'Oli@12345', 'oliahammed@gmail.com', 0),
(19, 'Oli Ahammed Sarker', '01627324997', '$2y$10$ZO9gq7M3JoX03iBJJjir7.lVkCx4OCk.9geJMK2ClUdry.gcBrxKq', 'oliahammed65@gmail.com', 0),
(20, 'dsfdfd', '01600000127', '$2y$10$RFRS.IacDg/F4H4munAJT.Niv2hYhRf5Nmp.MX9r5RdN6inrAwj4.', 'oliahammed02@gmail.com', 0),
(47, 'Rakib', '324234234', '$2y$10$UjlXCsMTl8Q7zqpr/uOHQ.TQwVca/5FYEZY0Bo.vX2wI86ARf919u', 'rakib@gmail.com', 1),
(48, 'Rabbi', '23324324', '$2y$10$FXD9aZqmrzgewp1uW8jRNOXeQkjrrJPjn2zyWyna70whYh3Ylap6O', 'rabbi@gmail.com', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `movie`
--
ALTER TABLE `movie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
