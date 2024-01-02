-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 02, 2024 at 10:49 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rulebasedsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `menu_item_id` int(11) DEFAULT NULL,
  `booking_date` date DEFAULT NULL,
  `booking_time` time DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `user_id`, `menu_item_id`, `booking_date`, `booking_time`, `status`) VALUES
(5, 12, 14, '2023-11-25', '04:13:00', '1'),
(6, 12, 18, '2024-01-02', '22:41:00', '1');

-- --------------------------------------------------------

--
-- Table structure for table `cafeterias`
--

CREATE TABLE `cafeterias` (
  `cafeteria_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `contact_phone` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cafeterias`
--

INSERT INTO `cafeterias` (`cafeteria_id`, `name`, `location`, `contact_phone`) VALUES
(1, 'Cafeteria 1', 'Campus A', '123-456-7890'),
(2, 'Cafeteria 2', 'Campus B', '987-654-3210'),
(3, 'Cafeteria 3', 'Campus C', '555-123-4567'),
(5, 'Cafeteria D', '647 Hotoro police station', '345678987');

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE `menu_items` (
  `menu_item_id` int(11) NOT NULL,
  `cafeteria_id` int(11) DEFAULT NULL,
  `dish_name` varchar(255) NOT NULL,
  `ingredients` text DEFAULT NULL,
  `dietary_tags` varchar(255) DEFAULT NULL,
  `image_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`menu_item_id`, `cafeteria_id`, `dish_name`, `ingredients`, `dietary_tags`, `image_url`) VALUES
(1, 2, 'Vegetable Stir-Fry', 'Mixed vegetables, tofu, soy sauce', 'organic', 'uploads/ch.jfif'),
(2, 1, 'Grilled Chicken Salad', 'Grilled chicken breast, mixed greens, vinaigrette', 'high-protein,organic', 'uploads/bread.PNG'),
(3, 2, 'Margherita Pizza', 'Tomato sauce, mozzarella, basil', 'high-protein,organic', 'uploads/fruit.PNG'),
(4, 2, 'Pasta Primavera', 'Pasta, assorted vegetables, cream sauce', 'low-carb,organic', 'uploads/Salsa.PNG'),
(5, 3, 'Salmon Bowl', 'Grilled salmon, brown rice, teriyaki sauce', 'organic,keto,vegetarian', 'uploads/Salsa.PNG'),
(6, 3, 'Vegan Burrito', 'Black beans, rice, guacamole, salsa', 'high-protein,organic', 'uploads/Capture.PNG'),
(7, 1, 'Fruit Salad', 'Assorted fresh fruits, honey drizzle', 'vegetarian,vegan', 'uploads/fruit.PNG'),
(8, 3, 'Mushroom Risotto', 'Arborio rice, mushrooms, parmesan', 'low-carb,high-protein', 'uploads/berry.PNG'),
(9, 2, 'Chicken Shawarma', 'Grilled chicken, pita, tahini sauce', 'high-protein', 'uploads/chicken.PNG'),
(10, 3, 'Tofu Noodle Bowl', 'Tofu, soba noodles, sesame dressing', 'vegetarian,vegan', 'uploads/Capture.PNG'),
(11, 2, 'Pepper Chicken', 'Chicken, pepper, oil', 'low-carb,high-protein', 'uploads/chicks.PNG'),
(13, 3, 'BREAKFAST BURRITO', 'chopped pork patties, green and red bell peppers, chopped onions, olive, cheese', 'Diary-free', 'uploads/d1.PNG'),
(14, 3, 'MICHIGAN BEAN SOUP', 'dried red kidney beans, dried black beans, dried pinto beans, vegetable, minced garlic, diced carrots, crushed tomatoes, canned', 'vegetarian,Gluten-free', 'uploads/g1.PNG'),
(15, 3, 'CHICKEN RICE SOUP', 'chicken broth or stock, diced yellow onions, diced celery, long grain rice, salt, pepper', 'Gluten-free', 'uploads/g2.PNG'),
(16, 3, 'LENTIL SOUP', 'dried red lentils, olive, diced yellow onion, diced carrots, minced garlic, diced potatoes, garlic powder, purpose flour', 'vegan', 'uploads/v1.PNG'),
(17, 3, 'BAKED BEAN AND TOMATO CASSEROLE', 'olive, diced yellow onion, minced garlic or garlic powder, diced canned tomatoes, black pepper, lima beans', 'vegan,Gluten-free', 'uploads/v2.PNG'),
(18, 2, 'LENTIL AND RICE BAKE', 'dried green lentils, dried red lentils, water, salt, diced yellow onions, rice, vegetable broth', 'vegan,Gluten-free', 'uploads/v3.PNG'),
(19, 1, 'CLASSIC GREEN BEAN CASSEROLE', 'green beans, cream of mushroom soup, pepper, French fried onions, salt', 'vegetarian', 'uploads/v4.PNG');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('student','staff') NOT NULL,
  `dietary_preferences` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `role`, `dietary_preferences`) VALUES
(12, 'saneeitas', 'saneeitas@gmail.com', '$2y$10$jkGq2dmcOuCLI8R2KgBQJOOMYx3Q03h7ZW5/d5Sg3vLnGFI5oEbYW', 'student', 'Gluten-free');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `cafeterias`
--
ALTER TABLE `cafeterias`
  ADD PRIMARY KEY (`cafeteria_id`);

--
-- Indexes for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`menu_item_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cafeterias`
--
ALTER TABLE `cafeterias`
  MODIFY `cafeteria_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `menu_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
