-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 24, 2024 at 08:16 AM
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
-- Database: `sultans`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `super_admin` tinyint(4) DEFAULT 0,
  `password` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `phone`, `status`, `super_admin`, `password`) VALUES
(1, 'Admin', 'admin@gmail.com', '8889997778', 0, 1, '1234'),
(2, 'agent', 'agent@gmail.com', '6546546546', 0, 0, '1234'),
(5, 'ali', 'ali@ali.com', '01164534715', 0, 0, '1234');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint(20) NOT NULL,
  `room_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `checkin` datetime NOT NULL,
  `checkout` datetime NOT NULL,
  `price` varchar(191) NOT NULL,
  `payment_mode` varchar(191) DEFAULT NULL,
  `booking_status` int(11) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `Status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `room_id`, `user_id`, `checkin`, `checkout`, `price`, `payment_mode`, `booking_status`, `created_at`, `Status`) VALUES
(5, 1, 1, '2024-01-01 20:29:00', '2024-01-01 21:29:00', '3299', 'Cash', 0, '2024-01-01 20:29:49', 'Approved'),
(6, 1, 1, '2024-01-01 20:54:00', '2024-01-01 23:54:00', '3299', 'Cash', 0, '2024-01-01 20:54:29', 'Denied'),
(7, 1, 3, '2024-01-01 22:30:00', '2024-01-01 23:30:00', '3299', 'Cash', 0, '2024-01-01 22:30:56', 'Approved'),
(8, 1, 3, '2024-01-02 21:20:00', '2024-01-02 21:20:00', '3299', 'Cash', 0, '2024-01-02 19:21:29', 'Approved'),
(9, 1, 48, '2024-12-05 23:30:00', '2024-12-27 23:30:00', '', NULL, 0, '2024-12-04 23:30:56', 'Approved'),
(10, 1, 48, '2024-12-07 18:00:00', '2024-12-20 18:00:00', '', NULL, 0, '2024-12-06 18:02:25', 'Approved'),
(11, 2, 48, '2024-12-21 18:02:00', '2024-12-21 18:02:00', '', NULL, 0, '2024-12-06 18:03:08', 'Approved'),
(12, 3, 48, '2024-12-13 18:55:00', '2024-12-20 18:55:00', '', NULL, 0, '2024-12-06 18:55:45', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

CREATE TABLE `facilities` (
  `id` int(11) NOT NULL,
  `facility_name` varchar(255) NOT NULL,
  `facility_image` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `facilities`
--

INSERT INTO `facilities` (`id`, `facility_name`, `facility_image`, `description`) VALUES
(1, 'Swimming Pool', 'pool.jpg', 'Relax and unwind at our state-of-the-art pool surrounded by lush greenery.'),
(2, 'Spa', 'Spa.jpg', 'Indulge in luxurious treatments designed to rejuvenate your mind and body.'),
(3, 'Restaurants', 'Restaurants.jpg', 'Enjoy gourmet cuisine from our world-class chefs, available around the clock.'),
(4, 'Gym', 'Gym.jpg', 'Stay fit with modern equipment and expert trainers available anytime.'),
(5, 'Salon', 'Salon.jpg', 'Pamper yourself with our premium beauty and grooming services.'),
(6, 'Kids Play Area', 'Kids Play Area.jpg', 'A fun and safe space for your little ones to play and enjoy.');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` bigint(20) NOT NULL,
  `room_name` varchar(191) NOT NULL,
  `no_of_beds` tinyint(4) NOT NULL,
  `room_qty` int(11) NOT NULL,
  `description` varchar(500) NOT NULL,
  `price` varchar(191) NOT NULL,
  `room_image` varchar(191) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `door_no` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `room_name`, `no_of_beds`, `room_qty`, `description`, `price`, `room_image`, `status`, `created_at`, `door_no`) VALUES
(1, 'Family Rooms', 2, 3, '<p>Best in class rooms with the following amenities</p><ul><li>Wi-fi</li><li>AC</li><li>2 Large size Beds </li></ul>', '139 ', 'delux.jpg', 0, '2021-05-09 13:54:20', '302'),
(2, 'Premium Rooms', 3, 2, '<p>Premuim rooms with Wi-Fi and AC.</p>', '5999', 'premium.jpg', 0, '2021-05-09 13:55:49', '101'),
(3, 'Royal Rooms', 3, 5, '<p>Royal rooms have the best quality furnitures and comfort.&nbsp;</p>', '5999', 'royal.jpg', 0, '2021-05-10 13:22:08', '211'),
(5, 'test', 12, 2, 'test', '12', '43891582151_8efbf67293_b.jpg', 0, '2024-01-01 09:04:18', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(11) NOT NULL,
  `fname` varchar(191) NOT NULL,
  `lname` char(191) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `email` varchar(191) NOT NULL,
  `password` varchar(191) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `active` tinyint(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `phone`, `gender`, `email`, `password`, `status`, `created_at`, `active`) VALUES
(1, 'Hasan', 'Mohammed', '0123456789', 'Male', 'hsnforstudy@gmail.com', '$2y$10$mYA8GpoGyWIey5xK0oJM8el/CcWKQ6hF1BBqMRGHPG1VtT771GzRK', 0, '2024-12-20 12:03:49', 1),
(2, 'Hamzah ', 'bi210029', '01160673933', 'Male', 'onetow11223@gmail.com', '$2y$10$DnAn0DgFOMaULCsOrKjRX.gZxbfGj8.a8nkQNjqDF/WfwnFY/d6NC', 0, '2024-12-20 12:03:53', 1),
(52, 'AONI ALI MOHAMMED MOHAMMED', '09617759', '01160673933', 'Male', 'bi210028@student.uthm.edu.my', '$2y$10$mXWg5eU7/pGiOPIymVIF0.p/IcFeunpDWctgR.65wsIA2oFou.OF.', 0, '2024-12-20 12:11:36', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
