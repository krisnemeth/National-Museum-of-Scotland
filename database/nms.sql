-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 02, 2023 at 01:30 PM
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
-- Database: `nms`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `eventName` varchar(50) DEFAULT NULL,
  `visitors` varchar(30) DEFAULT NULL,
  `time` varchar(50) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `booking_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`eventName`, `visitors`, `time`, `date`, `user_id`, `booking_id`) VALUES
('Japanese Contemporary Design', '2', '11:00', '2023-05-29', 1, 19),
('Rising Tide', '2', '12:00', '2023-06-01', 1, 20),
('Japanese Contemporary Design', '10', '14:00', '2023-06-07', 10, 21);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `eventName` varchar(50) DEFAULT NULL,
  `eventPlace` varchar(30) DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `image` varchar(80) DEFAULT NULL,
  `eventTime` varchar(80) DEFAULT NULL,
  `shortDescription` varchar(300) DEFAULT NULL,
  `event_id` int(11) NOT NULL,
  `eventDuration` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`eventName`, `eventPlace`, `description`, `image`, `eventTime`, `shortDescription`, `event_id`, `eventDuration`) VALUES
('Japanese Contemporary Design', 'Exhibition Gallery 3, Level 1', 'This display considers how Japanese contemporary makers have combined innovative and traditional art, craft and design elements over the past five decades. A more diverse range of makers have emerged in Japan in recent years, with highly skilled women breaking into historically male-dominated artistic disciplines. This follows a move away from the traditional apprenticeship-based system and the long-established custom of the eldest son taking over from his father. Japanese Contemporary Design will include an equal number of works by female and male makers, shining a light on some remarkable artisans who have previously been overlooked.', './img/cards/japanese.jpg', '6 May - 30 July', 'This display considers how Japanese contemporary makers have combined innovative and traditional art, craft and design elements over the past five decades.', 1, '10:00 - 17:00'),
('Museum Socials', 'Museum Cantine', 'Museum Socials create a friendly environment where everyone is welcome and all contributions are valued. They are suitable for first-time visitors and for those who might not regularly come to the museum, as well as people who have always loved visiting. The return of our in-person museum social for people living with any mental illness and their supporters. Our sessions are relaxed and informal, start with tea and cake, and feature a range of activities inspired by our collections. Museum Socials are inspired by Meet Me at MoMA. We are programming these with the National Galleries of Scotland and the National Library of Scotland.', './img/cards/socials.jpg', 'Daily', 'Our Museum Socials events are created for anyone affected by mental illness and their relatives, friends and supporters.', 2, '10:00 - 17:00'),
('Rising Tide', 'Exhibition Gallery 2, Level 3', 'Rising Tide considers our relationship to the natural environment through contemporary responses to climate change and plastic waste by Indigenous Australian and Pacific Islander artists. Rising Tide also features historical material from National Museums Scotland\'s collections, such as spear points from the Kimberley region of Western Australia made by Aboriginal men from discarded glass bottles. The vulnerabilities of Oceanic countries to climate change will be highlighted, whilst showcasing the strength and resilience of their diverse communities.', './img/cards/risingtide.jpg', '5 May - 12 September', 'Delve into the most important and pressing issue of our time, humanity’s damaging relationship with planet Earth.', 3, '10:00 - 17:00');

-- --------------------------------------------------------

--
-- Table structure for table `profilePic`
--

CREATE TABLE `profilePic` (
  `image_id` int(11) NOT NULL,
  `image` varchar(250) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profilePic`
--

INSERT INTO `profilePic` (`image_id`, `image`, `user_id`, `username`) VALUES
(16, 'uploads/Kris646f5cbfc1df84.49207162.png', 1, 'Kris');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(80) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`) VALUES
(1, 'Kris', 'krsnmth@gmail.com', '5ef8a77c3ae9d708a40d17c75fe8d036'),
(6, 'Lizz', 'lizzwayt14@gmail.com', '0679ac1581611294c955f71cc1c87925'),
(7, 'ricracrok', 'rikki@ricky.com', '1e6182fe3b3a018fe1b45707a87cb5ff'),
(10, 'Admin', 'admin@admin.com', '513640fd1a4d011b433b659f82a5659a');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `profilePic`
--
ALTER TABLE `profilePic`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `profilePic`
--
ALTER TABLE `profilePic`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
