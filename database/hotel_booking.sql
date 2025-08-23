-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 23, 2025 at 08:21 AM
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
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `hotel_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('unpaid','paid','cancelled','checked_out') DEFAULT 'unpaid',
  `num_rooms` int(11) NOT NULL DEFAULT 1,
  `status_reason` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `hotel_id`, `room_id`, `check_in`, `check_out`, `total_price`, `created`, `updated`, `status`, `num_rooms`, `status_reason`) VALUES
(1, 2, 1, 1, '2025-08-05', '2025-08-06', 900000.00, '2025-08-04 04:37:40', '2025-08-23 05:52:23', 'checked_out', 1, NULL),
(2, 2, 1, 1, '2025-08-05', '2025-08-06', 900000.00, '2025-08-04 04:38:12', '2025-08-04 04:38:17', 'cancelled', 1, NULL),
(3, 2, 1, 1, '2025-08-05', '2025-08-06', 900000.00, '2025-08-04 04:38:30', '2025-08-04 04:38:48', 'cancelled', 1, NULL),
(4, 2, 1, 1, '2025-08-05', '2025-08-07', 1800000.00, '2025-08-04 06:43:47', '2025-08-22 09:13:33', 'cancelled', 1, NULL),
(5, 2, 1, 1, '2025-08-04', '2025-08-05', 900000.00, '2025-08-04 07:43:45', '2025-08-06 02:55:07', 'cancelled', 1, NULL),
(6, 1, 2, 2, '2025-08-22', '2025-08-23', 90000.00, '2025-08-22 10:00:16', '2025-08-22 10:00:16', 'unpaid', 1, NULL),
(7, 1, 2, 2, '2025-08-22', '2025-08-23', 90000.00, '2025-08-22 10:00:34', '2025-08-22 10:00:34', 'unpaid', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hotels`
--

CREATE TABLE `hotels` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `location_embed` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hotels`
--

INSERT INTO `hotels` (`id`, `name`, `description`, `image`, `created_at`, `location_embed`) VALUES
(1, 'Akariz Hotel', 'Conveniently situated in the Chaungtha Beachfront part of Chaungtha Beach, this property puts you close to attractions and interesting dining options. Rated with 4 stars, this high-quality property provides guests with access to restaurant and outdoor pool on-site.', '', '2025-05-10 14:28:01', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3816.1182880012866!2d94.44787437389544!3d16.968730914733317!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30bfb38fc012a941%3A0xec2bbefc070460c9!2sAkariz%20(Ambo)%20Resort!5e0!3m2!1sen!2smm!4v1746887108607!5m2!1sen!2smm\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>'),
(2, 'Alliance Hotel', 'Get your trip off to a great start with a stay at this property, which offers car park free of charge. Conveniently situated in the Chaungtha part of Chaungtha Beach, this property puts you close to attractions and interesting dining options. As an added bonus, restaurant is provided on-site to conveniently serve your needs.', '', '2025-05-11 03:39:08', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3816.294512563857!2d94.44118957389522!3d16.960057614977558!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30bfb38684a35429%3A0x4e1ae1e90cd9030c!2sAlliance%20Resort%20Hotel!5e0!3m2!1sen!2smm!4v1746934730098!5m2!1sen!2smm\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>'),
(3, 'Amazing Hotel', 'The car parking and the Wi-Fi are always free, so you can stay in touch and come and go as you please. Conveniently situated in the Ngapali Beach part of Ngapali, this property puts you close to attractions and interesting dining options. Rated with 4 stars, this high-quality property provides guests with access to massage, restaurant and hot tub on-site.', '', '2025-05-11 03:41:11', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.5783142765554!2d94.43532302812548!3d16.9567788747087!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30bfb480064ad785%3A0x124b8fe1357baa00!2sAmazing%20Chaung%20Tha%20Resort!5e0!3m2!1sen!2smm!4v1746934852005!5m2!1sen!2smm\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>'),
(4, 'Grand Ngwe Saung Hotel', 'The car parking and the Wi-Fi are always free, so you can stay in touch and come and go as you please. Conveniently situated in the Beachfront part of Ngwesaung Beach, this property puts you close to attractions and interesting dining options. Rated with 3 stars, this high-quality property provides guests with access to restaurant and outdoor pool on-site.', '', '2025-05-11 03:43:07', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3818.616082947902!2d94.38712896940694!3d16.845391482751882!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30be4aa127da2fc9%3A0xe2d1ef4b4b057f6a!2sGrand%20Ngwe%20Saung%20Resort!5e0!3m2!1sen!2smm!4v1746934946666!5m2!1sen!2smm\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>'),
(5, 'Palm Beach Resort', 'Get your trip off to a great start with a stay at this property, which offers car park free of charge. Conveniently situated in the Beachfront part of Ngwesaung Beach, this property puts you close to attractions and interesting dining options. Rated with 3.5 stars, this high-quality property provides guests with access to massage, restaurant and outdoor pool on-site.', '', '2025-05-11 03:46:14', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3818.5697809545795!2d94.3889227738925!3d16.847685818131!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30be35494a822f75%3A0xbb7db850d294d0b6!2sThe%20Palm%20Beach%20Resort!5e0!3m2!1sen!2smm!4v1746935160602!5m2!1sen!2smm\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>'),
(6, 'Aureum Palace Hotel', 'Situated in Ngwesaung, Aureum Palace Hotel & Resort Ngwe Saung offers 4-star accommodation, as well as an outdoor pool. It also provides meeting rooms, massage services and a 24-hour reception. Those staying at the resort have access to its wide range of outdoor activities, including snorkeling, scuba diving and fishing. It also provides a concierge, a tour desk and a ticket service. Aureum Palace Hotel & Resort Ngwe Saung offers 61 rooms, all of which are equipped with a hair dryer and a mini bar.', '', '2025-05-11 03:47:32', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3818.122991322011!2d94.37632812389299!3d16.869809367511667!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30be4aa0c316b601%3A0x35c661c731a3f34e!2sAureum%20Palace%20Hotel%20%26%20Resort%20Ngwe%20Saung!5e0!3m2!1sen!2smm!4v1746935213699!5m2!1sen!2smm\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>'),
(7, 'Seasons Hotel And Resorts', 'Conveniently situated in the Ngapali Beach part of Ngapali, this property puts you close to attractions and interesting dining options.', '', '2025-05-11 03:50:39', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3784.944633243175!2d94.31495446966872!3d18.440822833257993!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30b91f25d4e41b9b%3A0xf849989c3817488d!2sSeasons%20Hotels%20and%20Resorts-Ngapali!5e0!3m2!1sen!2smm!4v1746935339082!5m2!1sen!2smm\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>'),
(8, 'Ngapali Win Hotel', 'The car parking and the Wi-Fi are always free, so you can stay in touch and come and go as you please. Conveniently situated in the Ngapali Beach part of Ngapali, this property puts you close to attractions and interesting dining options. Rated with 4 stars, this high-quality property provides guests with access to restaurant, hot tub and indoor pool on-site.', '', '2025-05-11 03:51:58', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3784.9597958148715!2d94.31696477393352!3d18.440134471628838!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30b91ed173b05b85%3A0xb863c46f6b5390a4!2sNGAPALI%20WIN%20HOTEL!5e0!3m2!1sen!2smm!4v1746935471469!5m2!1sen!2smm\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>'),
(9, 'Thande Beach Hotel', 'The car parking and the Wi-Fi are always free, so you can stay in touch and come and go as you please. Conveniently situated in the Ngapali Beach part of Ngapali, this property puts you close to attractions and interesting dining options. Rated with 4 stars, this high-quality property provides guests with access to restaurant, hot tub and indoor pool on-site.', '', '2025-05-11 03:52:54', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3785.826803454301!2d94.33428217393244!3d18.40073207282645!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30b91f3c20c15c9d%3A0x368ad29bdfc3310e!2sThande%20Beach%20Hotel!5e0!3m2!1sen!2smm!4v1746935539504!5m2!1sen!2smm\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>');

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
(20, 2, 'alliance.jpg'),
(21, 2, 'alliance2.jpg'),
(25, 2, 'alliance3.jpg'),
(26, 2, 'alliance4.jpg'),
(28, 3, 'amazing.jpg'),
(29, 3, 'amazing2.jpg'),
(30, 3, 'amazing3.jpg'),
(31, 3, 'amazing4.jpg'),
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
(68, 9, 'thande4.jpg'),
(69, 1, 'akariz3.jpg'),
(70, 1, 'akariz4.jpg'),
(72, 1, 'akariz5.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `max_guests` int(11) NOT NULL,
  `room_type` enum('single','double','suite','family') DEFAULT 'single',
  `hotel_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `total_rooms` int(11) NOT NULL DEFAULT 1,
  `available_rooms` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `description`, `price`, `max_guests`, `room_type`, `hotel_id`, `created_at`, `updated_at`, `total_rooms`, `available_rooms`) VALUES
(1, 'Delux Room', 'Deluxe Garden View (2pax) Television LCD/plasma screen Air conditioning In room safe Shower Toiletries Towels Slippers Linens Free bottled water', 900000.00, 2, 'double', 1, '2025-05-27 05:24:56', '2025-08-23 05:52:23', 10, 3),
(2, 'Delux Room', 'Deluxe Garden View (2pax) Television LCD/plasma screen Air conditioning In room safe Shower Toiletries Towels Slippers Linens Free bottled water', 90000.00, 2, 'double', 2, '2025-07-16 05:00:43', '2025-07-16 05:35:27', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `room_images`
--

CREATE TABLE `room_images` (
  `id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `image_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `room_images`
--

INSERT INTO `room_images` (`id`, `room_id`, `image_name`, `created_at`) VALUES
(4, 1, 'akariz2.jpg', '2025-05-31 07:02:41'),
(5, 2, 'alliance3.jpg', '2025-07-16 05:00:43');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('active','disabled') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`, `created_at`, `status`) VALUES
(1, 'admin', '$2y$10$F6uJSqVi7o85WWZ5jcwy0.NU.8WaZzKy/CK3MH93tsjGJn1zcMkzO', 'admin@gmail.com', 'admin', '2025-04-30 09:35:18', 'active'),
(2, 'user', '$2y$10$5EWJ7Sh/BOK2qjyHDTIx5O37HGPpb0wA2WGadsYHe1BvgvjbUW5D.', 'user@gmail.com', 'user', '2025-04-30 09:40:00', 'active'),
(3, 'admin1', '$2y$10$gyWsj5yESQd1saXCaz1qfeROYoBCtU.KRkJmBnTimIBgHqnFMlHmS', 'admin1@gmail.com', 'admin', '2025-05-22 10:07:45', 'active'),
(4, 'user1', '$2y$10$5EWJ7Sh/BOK2qjyHDTIx5O37HGPpb0wA2WGadsYHe1BvgvjbUW5D.', 'user1@gmail.com', 'user', '2025-04-30 09:40:00', 'active'),
(5, 'user2', '$2y$10$5EWJ7Sh/BOK2qjyHDTIx5O37HGPpb0wA2WGadsYHe1BvgvjbUW5D.', 'user2@gmail.com', 'user', '2025-04-30 09:40:00', 'active'),
(6, 'user3', '$2y$10$5EWJ7Sh/BOK2qjyHDTIx5O37HGPpb0wA2WGadsYHe1BvgvjbUW5D.', 'user3@gmail.com', 'user', '2025-04-30 09:40:00', 'active'),
(7, 'user4', '$2y$10$5EWJ7Sh/BOK2qjyHDTIx5O37HGPpb0wA2WGadsYHe1BvgvjbUW5D.', 'user4@gmail.com', 'user', '2025-04-30 09:40:00', 'active'),
(8, 'user5', '$2y$10$5EWJ7Sh/BOK2qjyHDTIx5O37HGPpb0wA2WGadsYHe1BvgvjbUW5D.', 'user5@gmail.com', 'user', '2025-04-30 09:40:00', 'active'),
(9, 'user6', '$2y$10$5EWJ7Sh/BOK2qjyHDTIx5O37HGPpb0wA2WGadsYHe1BvgvjbUW5D.', 'user6@gmail.com', 'user', '2025-04-30 09:40:00', 'active'),
(10, 'user7', '$2y$10$5EWJ7Sh/BOK2qjyHDTIx5O37HGPpb0wA2WGadsYHe1BvgvjbUW5D.', 'user7@gmail.com', 'user', '2025-04-30 09:40:00', 'active'),
(11, 'user8', '$2y$10$5EWJ7Sh/BOK2qjyHDTIx5O37HGPpb0wA2WGadsYHe1BvgvjbUW5D.', 'user8@gmail.com', 'user', '2025-04-30 09:40:00', 'active'),
(12, 'user9', '$2y$10$5EWJ7Sh/BOK2qjyHDTIx5O37HGPpb0wA2WGadsYHe1BvgvjbUW5D.', 'user9@gmail.com', 'user', '2025-04-30 09:40:00', 'active'),
(13, 'user10', '$2y$10$5EWJ7Sh/BOK2qjyHDTIx5O37HGPpb0wA2WGadsYHe1BvgvjbUW5D.', 'user10@gmail.com', 'user', '2025-04-30 09:40:00', 'active'),
(14, 'admin2', '$2y$10$gyWsj5yESQd1saXCaz1qfeROYoBCtU.KRkJmBnTimIBgHqnFMlHmS', 'admin2@gmail.com', 'admin', '2025-05-22 10:07:45', 'active'),
(15, 'user', '$2y$10$xb7ZrspMWvR4zisSBsbjj.LyRsepPor/bRvIJMlwiLyXbUd1pjCGi', 'user123456@gmail.com', 'user', '2025-06-02 05:29:49', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `hotel_id` (`hotel_id`),
  ADD KEY `room_id` (`room_id`) USING BTREE;

--
-- Indexes for table `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hotel_images`
--
ALTER TABLE `hotel_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hotel_id` (`hotel_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hotel_id` (`hotel_id`);

--
-- Indexes for table `room_images`
--
ALTER TABLE `room_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `hotels`
--
ALTER TABLE `hotels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `hotel_images`
--
ALTER TABLE `hotel_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `room_images`
--
ALTER TABLE `room_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`),
  ADD CONSTRAINT `fk_room_id` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `hotel_images`
--
ALTER TABLE `hotel_images`
  ADD CONSTRAINT `hotel_images_ibfk_1` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_ibfk_1` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `room_images`
--
ALTER TABLE `room_images`
  ADD CONSTRAINT `room_images_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
