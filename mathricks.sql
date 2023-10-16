-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 16, 2023 at 11:56 AM
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
-- Database: `mathricks`
--

-- --------------------------------------------------------

--
-- Table structure for table `scores`
--

CREATE TABLE `scores` (
  `id` int(11) NOT NULL,
  `grade` varchar(255) NOT NULL,
  `difficulty` varchar(255) NOT NULL,
  `score` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `scores`
--

INSERT INTO `scores` (`id`, `grade`, `difficulty`, `score`, `timestamp`, `user_id`) VALUES
(1, '2', 'easy', 6, '2023-10-16 06:17:15', 0),
(2, '2', 'medium', 12, '2023-10-16 06:20:13', 0),
(3, '2', 'easy', 14, '2023-10-16 06:36:03', 0),
(4, '2', 'easy', 2, '2023-10-16 06:37:41', 0),
(5, '2', 'easy', 1, '2023-10-16 06:38:47', 0),
(6, '2', 'easy', 4, '2023-10-16 06:41:32', 0),
(7, '2', 'easy', 13, '2023-10-16 06:44:12', 0),
(8, '2', 'easy', 0, '2023-10-16 06:50:58', 0),
(9, '2', 'easy', 16, '2023-10-16 06:53:01', 0),
(10, '2', 'hard', 4, '2023-10-16 07:04:06', 0),
(11, '2', 'medium', 4, '2023-10-16 07:14:37', 1),
(12, '2', 'easy', 2, '2023-10-16 08:13:31', 2),
(13, '2', 'easy', 3, '2023-10-16 09:38:08', 1),
(14, '2', 'easy', 2, '2023-10-16 09:40:03', 1),
(15, '2', 'easy', 0, '2023-10-16 09:44:28', 1),
(16, '2', 'easy', 16, '2023-10-16 09:45:29', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `grade` int(11) DEFAULT NULL,
  `role` varchar(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `grade`, `role`, `username`, `password`) VALUES
(1, 'mark royo', 'horlador', 2, 'student', 'mac', '$2y$10$Xl2BkfmnnNwQaGRiKtH8lORDrEilvNUIoSO4SBa3vFtuDhpn0QUHC'),
(2, 'roel', 'leonen', 2, 'student', 'roel', '$2y$10$q8DYXUEJPgGEy8UIyw6d/e37LaKWC/xZLfzQ0JtLziWnoGk0kE3FG');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `scores`
--
ALTER TABLE `scores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `scores`
--
ALTER TABLE `scores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
