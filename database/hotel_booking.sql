-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2025 at 05:58 AM
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
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hotels`
--

CREATE TABLE `hotels` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `location_embed` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hotels`
--

INSERT INTO `hotels` (`id`, `name`, `description`, `image`, `price`, `created_at`, `location_embed`) VALUES
(1, 'Akariz Hotel', 'Deluxe Garden View (2pax) Television LCD/plasma screen Air conditioning In room safe Shower Toiletries Towels Slippers Linens Free bottled water', '', 85000.00, '2025-05-10 14:28:01', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3816.1182880012866!2d94.44787437389544!3d16.968730914733317!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30bfb38fc012a941%3A0xec2bbefc070460c9!2sAkariz%20(Ambo)%20Resort!5e0!3m2!1sen!2smm!4v1746887108607!5m2!1sen!2smm\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>'),
(2, 'Alliance Hotel', 'Deluxe Garden View (2pax) Television LCD/plasma screen Air conditioning In room safe Shower Toiletries Towels Slippers Linens Free bottled water', '', 85000.00, '2025-05-11 03:39:08', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3816.294512563857!2d94.44118957389522!3d16.960057614977558!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30bfb38684a35429%3A0x4e1ae1e90cd9030c!2sAlliance%20Resort%20Hotel!5e0!3m2!1sen!2smm!4v1746934730098!5m2!1sen!2smm\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>'),
(3, 'Amazing Hotel', 'Deluxe Garden View (2pax) Television LCD/plasma screen Air conditioning In room safe Shower Toiletries Towels Slippers Linens Free bottled water', '', 85000.00, '2025-05-11 03:41:11', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.5783142765554!2d94.43532302812548!3d16.9567788747087!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30bfb480064ad785%3A0x124b8fe1357baa00!2sAmazing%20Chaung%20Tha%20Resort!5e0!3m2!1sen!2smm!4v1746934852005!5m2!1sen!2smm\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>'),
(4, 'Grand Ngwe Saung Hotel', 'Deluxe Garden View (2pax) Television LCD/plasma screen Air conditioning In room safe Shower Toiletries Towels Slippers Linens Free bottled water', '', 85000.00, '2025-05-11 03:43:07', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3818.616082947902!2d94.38712896940694!3d16.845391482751882!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30be4aa127da2fc9%3A0xe2d1ef4b4b057f6a!2sGrand%20Ngwe%20Saung%20Resort!5e0!3m2!1sen!2smm!4v1746934946666!5m2!1sen!2smm\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>'),
(5, 'Palm Beach Resort', 'Deluxe Garden View (2pax) Television LCD/plasma screen Air conditioning In room safe Shower Toiletries Towels Slippers Linens Free bottled water', '', 85000.00, '2025-05-11 03:46:14', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3818.5697809545795!2d94.3889227738925!3d16.847685818131!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30be35494a822f75%3A0xbb7db850d294d0b6!2sThe%20Palm%20Beach%20Resort!5e0!3m2!1sen!2smm!4v1746935160602!5m2!1sen!2smm\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>'),
(6, 'Aureum Palace Hotel', 'Deluxe Garden View (2pax) Television LCD/plasma screen Air conditioning In room safe Shower Toiletries Towels Slippers Linens Free bottled water', '', 85000.00, '2025-05-11 03:47:32', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3818.122991322011!2d94.37632812389299!3d16.869809367511667!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30be4aa0c316b601%3A0x35c661c731a3f34e!2sAureum%20Palace%20Hotel%20%26%20Resort%20Ngwe%20Saung!5e0!3m2!1sen!2smm!4v1746935213699!5m2!1sen!2smm\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>'),
(7, 'Seasons Hotel And Resorts', 'Deluxe Garden View (2pax) Television LCD/plasma screen Air conditioning In room safe Shower Toiletries Towels Slippers Linens Free bottled water', '', 85000.00, '2025-05-11 03:50:39', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3784.944633243175!2d94.31495446966872!3d18.440822833257993!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30b91f25d4e41b9b%3A0xf849989c3817488d!2sSeasons%20Hotels%20and%20Resorts-Ngapali!5e0!3m2!1sen!2smm!4v1746935339082!5m2!1sen!2smm\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>'),
(8, 'Ngapali Win Hotel', 'Deluxe Garden View (2pax) Television LCD/plasma screen Air conditioning In room safe Shower Toiletries Towels Slippers Linens Free bottled water', '', 85000.00, '2025-05-11 03:51:58', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3784.9597958148715!2d94.31696477393352!3d18.440134471628838!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30b91ed173b05b85%3A0xb863c46f6b5390a4!2sNGAPALI%20WIN%20HOTEL!5e0!3m2!1sen!2smm!4v1746935471469!5m2!1sen!2smm\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>'),
(9, 'Thande Beach Hotel', 'Deluxe Garden View (2pax) Television LCD/plasma screen Air conditioning In room safe Shower Toiletries Towels Slippers Linens Free bottled water', '', 85000.00, '2025-05-11 03:52:54', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3785.826803454301!2d94.33428217393244!3d18.40073207282645!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30b91f3c20c15c9d%3A0x368ad29bdfc3310e!2sThande%20Beach%20Hotel!5e0!3m2!1sen!2smm!4v1746935539504!5m2!1sen!2smm\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>');

-- --------------------------------------------------------

--
-- Table structure for table `hotel_images`
--

CREATE TABLE `hotel_images` (
  `id` int(11) NOT NULL,
  `hotel_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(2, 'user', '$2y$10$5EWJ7Sh/BOK2qjyHDTIx5O37HGPpb0wA2WGadsYHe1BvgvjbUW5D.', 'user@gmail.com', 'user', '2025-04-30 09:40:00', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `hotel_id` (`hotel_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hotels`
--
ALTER TABLE `hotels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `hotel_images`
--
ALTER TABLE `hotel_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`);

--
-- Constraints for table `hotel_images`
--
ALTER TABLE `hotel_images`
  ADD CONSTRAINT `hotel_images_ibfk_1` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
