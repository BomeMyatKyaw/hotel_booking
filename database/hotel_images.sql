-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2025 at 09:26 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel_booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `hotel_images`
--

CREATE TABLE `hotel_images` (
  `id` int(11) NOT NULL,
  `hotel_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hotel_images`
--

INSERT INTO `hotel_images` (`id`, `hotel_id`, `image`) VALUES
(15, 1, 'akariz.jpg'),
(16, 1, 'akariz2.jpg'),
(17, 1, 'akariz3.jpg'),
(18, 1, 'akariz4.jpg'),
(19, 1, 'akariz5.jpg'),
(20, 2, 'alliance.jpg'),
(21, 2, 'alliance2.jpg'),
(25, 2, 'alliance3.jpg'),
(26, 2, 'alliance4.jpg'),
(27, 2, 'amazing5.jpg'),
(28, 3, 'amazing.jpg'),
(29, 3, 'amazing2.jpg'),
(30, 3, 'amazing3.jpg'),
(31, 3, 'amazing4.jpg'),
(32, 3, 'amazing5.jpg'),
(36, 5, 'palm.jpg'),
(37, 5, 'palm2.jpg'),
(38, 5, 'palm3.jpg'),
(39, 4, 'grand.jpg'),
(40, 4, 'grand2.jpg'),
(41, 4, 'grand3.jpg'),
(42, 4, 'grand4.jpg'),
(43, 6, 'aureum.jpg'),
(44, 6, 'aureum2.jpg'),
(45, 6, 'aureum3.jpg'),
(46, 8, 'ngapaliwin.jpg'),
(47, 8, 'ngapaliwin2.jpg'),
(48, 8, 'ngapaliwin3.jpg'),
(49, 8, 'ngapaliwin4.jpg'),
(50, 8, 'ngapaliwin5.jpg'),
(51, 8, 'ngapaliwin6.jpg'),
(52, 8, 'ngapaliwin7.jpg'),
(53, 8, 'ngapaliwin8.jpg'),
(54, 8, 'ngapaliwin9.jpg'),
(55, 7, 'seasons.jpg'),
(56, 7, 'seasons2.jpg'),
(57, 7, 'seasons3.jpg'),
(58, 7, 'seasons4.jpg'),
(59, 7, 'seasons5.jpg'),
(60, 7, 'seasons6.jpg'),
(61, 7, 'seasons7.jpg'),
(62, 7, 'seasons8.jpg'),
(63, 7, 'seasons9.jpg'),
(64, 7, 'seasons10.jpg'),
(65, 9, 'thande.jpg'),
(66, 9, 'thande2.jpg'),
(67, 9, 'thande3.jpg'),
(68, 9, 'thande4.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hotel_images`
--
ALTER TABLE `hotel_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hotel_id` (`hotel_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hotel_images`
--
ALTER TABLE `hotel_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hotel_images`
--
ALTER TABLE `hotel_images`
  ADD CONSTRAINT `hotel_images_ibfk_1` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
