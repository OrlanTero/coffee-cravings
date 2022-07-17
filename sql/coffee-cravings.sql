-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2022 at 11:12 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.3.33
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;
/*!40101 SET NAMES utf8mb4 */
;
--
-- Database: `coffee-cravings`
--
-- --------------------------------------------------------
--
-- Table structure for table `categories`
--
CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `date_made` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
--
-- Dumping data for table `categories`
--
INSERT INTO `categories` (`category_id`, `category_name`, `date_made`)
VALUES (1, 'Drinks', '2022-07-11 01:06:44'),
  (2, 'Rice Meal', '2022-07-11 01:22:05'),
  (3, 'Snacks', '2022-07-11 01:22:05');
-- --------------------------------------------------------
--
-- Table structure for table `members`
--
CREATE TABLE `members` (
  `member_id` int(11) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `points` int(11) NOT NULL,
  `address` varchar(200) NOT NULL,
  `date_registered` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
--
-- Dumping data for table `members`
--

-- --------------------------------------------------------
--
-- Table structure for table `orders`
--
CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `pre_order_id` varchar(200) NOT NULL,
  `transaction_id` varchar(200) NOT NULL,
  `member_id` varchar(100) DEFAULT NULL,
  `total_amount` float NOT NULL,
  `redeemed_points` float NOT NULL,
  `earned_points` float NOT NULL,
  `discount` float NOT NULL,
  `final_amount` float NOT NULL,
  `reward_points` float NOT NULL,
  `date_made` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
--
-- Dumping data for table `orders`
--

-- --------------------------------------------------------
--
-- Table structure for table `points_history`
--
CREATE TABLE `points_history` (
  `point_history_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `member_id` varchar(100) NOT NULL,
  `total_amount` float NOT NULL,
  `redeemed_points` float NOT NULL,
  `earned_points` float NOT NULL,
  `discount` float NOT NULL,
  `final_amount` float NOT NULL,
  `reward_points` float NOT NULL,
  `date_made` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
--
-- Dumping data for table `points_history`
--

-- --------------------------------------------------------
--
-- Table structure for table `products`
--
CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `category` varchar(100) NOT NULL,
  `image` varchar(250) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
--
-- Dumping data for table `products`
--
INSERT INTO `products` (
    `product_id`,
    `name`,
    `price`,
    `category`,
    `image`,
    `date_created`
  )
VALUES (
    1,
    'Cafe Americano',
    70,
    'Drinks',
    'drinks-62cc3ee528a6d.jpg',
    '2022-07-11 15:16:53'
  ),
  (
    2,
    'Cafe Latte',
    80,
    'Drinks',
    'drinks-62cc3ee53b88a.jpeg',
    '2022-07-11 15:16:53'
  ),
  (
    3,
    'Cappuccino',
    85,
    'Drinks',
    'drinks-62cc3ee543665.jpg',
    '2022-07-11 15:16:53'
  ),
  (
    4,
    'Mocha',
    85,
    'Drinks',
    'drinks-62cc3ee553ac0.jpg',
    '2022-07-11 15:16:53'
  ),
  (
    5,
    'Caramel Macchiato',
    90,
    'Drinks',
    'drinks-62cc3ee56c219.jpg',
    '2022-07-11 15:16:53'
  ),
  (
    6,
    'Caramel Latte',
    90,
    'Drinks',
    'drinks-62cc3ee576fd4.jpg',
    '2022-07-11 15:16:53'
  ),
  (
    7,
    'Hot Chocolate',
    80,
    'Drinks',
    'drinks-62cc3ee57f1cb.jpg',
    '2022-07-11 15:16:53'
  ),
  (
    8,
    'Cafe Misto',
    80,
    'Drinks',
    'drinks-62cc3ee589ffc.jpg',
    '2022-07-11 15:16:53'
  ),
  (
    9,
    'Dark Roast Coffee',
    80,
    'Drinks',
    'drinks-62cc3ee594cf8.jfif',
    '2022-07-11 15:16:53'
  ),
  (
    10,
    'Flat White Coffee',
    85,
    'Drinks',
    'drinks-62cc3ee59f946.jpg',
    '2022-07-11 15:16:53'
  ),
  (
    11,
    'Affogato',
    90,
    'Drinks',
    'drinks-62cc3ee5a7cde.jpg',
    '2022-07-11 15:16:53'
  ),
  (
    12,
    'Cold Brew Coffee',
    90,
    'Drinks',
    'drinks-62cc3ee5b8055.jpeg',
    '2022-07-11 15:16:53'
  ),
  (
    13,
    'Strawberry',
    75,
    'Drinks',
    'drinks-62cc3ee5d15ae.jpg',
    '2022-07-11 15:16:53'
  ),
  (
    14,
    'Blueberry',
    75,
    'Drinks',
    'drinks-62cc3ee5d8a3a.jpg',
    '2022-07-11 15:16:53'
  ),
  (
    15,
    'Blue Lemonade',
    75,
    'Drinks',
    'drinks-62cc3ee5e37c7.jpg',
    '2022-07-11 15:16:53'
  ),
  (
    16,
    'Honey Lemonade',
    75,
    'Drinks',
    'drinks-62cc3ee5ee601.jpg',
    '2022-07-11 15:16:53'
  ),
  (
    17,
    'Iced Tea',
    50,
    'Drinks',
    'drinks-62cc3ee602565.jpg',
    '2022-07-11 15:16:54'
  ),
  (
    18,
    'Bottled Water',
    20,
    'Drinks',
    'drinks-62cc3ee6180ae.jpg',
    '2022-07-11 15:16:54'
  ),
  (
    19,
    'Canned Soft Drinks',
    50,
    'Drinks',
    'drinks-62cc3ee62ae31.jpg',
    '2022-07-11 15:16:54'
  ),
  (
    20,
    'Hotsilog',
    65,
    'Rice Meal',
    'rice meal-62cc3ee648ca5.jpg',
    '2022-07-11 15:16:54'
  ),
  (
    21,
    'Longsilog',
    65,
    'Rice Meal',
    'rice meal-62cc3ee665e6b.jpeg',
    '2022-07-11 15:16:54'
  ),
  (
    22,
    'Tapsilog',
    85,
    'Rice Meal',
    'rice meal-62cc3ee671849.jpg',
    '2022-07-11 15:16:54'
  ),
  (
    23,
    'Tocilog',
    65,
    'Rice Meal',
    'rice meal-62cc3ee679c78.jpg',
    '2022-07-11 15:16:54'
  ),
  (
    24,
    'Malingsilog',
    65,
    'Rice Meal',
    'rice meal-62cc3ee689f78.jpg',
    '2022-07-11 15:16:54'
  ),
  (
    25,
    'Chicksilog',
    80,
    'Rice Meal',
    'rice meal-62cc3ee692156.jpg',
    '2022-07-11 15:16:54'
  ),
  (
    26,
    'Porksilog',
    90,
    'Rice Meal',
    'rice meal-62cc3ee69faef.jpg',
    '2022-07-11 15:16:54'
  ),
  (
    27,
    'Bangsilog',
    90,
    'Rice Meal',
    'rice meal-62cc3ee6ab227.jpg',
    '2022-07-11 15:16:54'
  ),
  (
    28,
    'Cornsilog',
    60,
    'Rice Meal',
    'rice meal-62cc3ee6b2a29.jpg',
    '2022-07-11 15:16:54'
  ),
  (
    29,
    'Extra Rice',
    15,
    'Rice Meal',
    'rice meal-62cc3ee6bad67.png',
    '2022-07-11 15:16:54'
  ),
  (
    30,
    'Fried Rice',
    25,
    'Rice Meal',
    'rice meal-62cc3ee6c2ea4.jpg',
    '2022-07-11 15:16:54'
  ),
  (
    31,
    'Carbonara',
    95,
    'Snacks',
    'snacks-62cc3ee6cb267.jpg',
    '2022-07-11 15:16:54'
  ),
  (
    32,
    'Italian Spaghetti',
    100,
    'Snacks',
    'snacks-62cc3ee6d3a04.jpg',
    '2022-07-11 15:16:54'
  ),
  (
    33,
    'Creamy Tuna Pesto',
    110,
    'Snacks',
    'snacks-62cc3ee6db749.jpg',
    '2022-07-11 15:16:54'
  ),
  (
    34,
    'Baked Macaroni',
    100,
    'Snacks',
    'snacks-62cc3ee6e376b.jpg',
    '2022-07-11 15:16:54'
  ),
  (
    35,
    'Garlic Parmesan',
    120,
    'Snacks',
    'snacks-62cc3ee6ebc20.jpg',
    '2022-07-11 15:16:54'
  ),
  (
    36,
    'Sweet BBQ Wings',
    120,
    'Snacks',
    'snacks-62cc3ee703162.jpg',
    '2022-07-11 15:16:55'
  ),
  (
    37,
    'Signature Buffalo Wings',
    120,
    'Snacks',
    'snacks-62cc3ee70a722.jpg',
    '2022-07-11 15:16:55'
  ),
  (
    38,
    'Honey Garlic',
    120,
    'Snacks',
    'snacks-62cc3ee71aaae.jfif',
    '2022-07-11 15:16:55'
  ),
  (
    39,
    'Teriyaki Chicken Wings',
    120,
    'Snacks',
    'snacks-62cc3ee731a73.jfif',
    '2022-07-11 15:16:55'
  ),
  (
    40,
    'Korean Chicken Wings',
    120,
    'Snacks',
    'snacks-62cc3ee746439.jpg',
    '2022-07-11 15:16:55'
  ),
  (
    41,
    'Classic Homestyle Wings',
    110,
    'Snacks',
    'snacks-62cc3ee76439d.jpg',
    '2022-07-11 15:16:55'
  ),
  (
    42,
    'Cheesy Fries',
    60,
    'Snacks',
    'snacks-62cc3ee781d0a.jpg',
    '2022-07-11 15:16:55'
  ),
  (
    43,
    'Beef Nachos',
    95,
    'Snacks',
    'snacks-62cc3ee795178.jpg',
    '2022-07-11 15:16:55'
  ),
  (
    44,
    'Beef Tacos',
    35,
    'Snacks',
    'snacks-62cc3ee7a3425.jpg',
    '2022-07-11 15:16:55'
  ),
  (
    45,
    'Burger',
    40,
    'Snacks',
    'snacks-62cc3ee7aa884.jpg',
    '2022-07-11 15:16:55'
  );
-- --------------------------------------------------------
--
-- Table structure for table `product_orders`
--
CREATE TABLE `product_orders` (
  `product_order_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float NOT NULL,
  `total` float NOT NULL,
  `date_ordered` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
--
-- Dumping data for table `product_orders`
--

-- --------------------------------------------------------
--
-- Table structure for table `sales_reports`
--
CREATE TABLE `sales_reports` (
  `sales_report_id` int(11) NOT NULL,
  `report_id` varchar(200) NOT NULL,
  `orders` varchar(200) NOT NULL,
  `popular` varchar(100) NOT NULL,
  `quantities` varchar(200) NOT NULL,
  `date_made` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
--
-- Dumping data for table `sales_reports`
--
INSERT INTO `sales_reports` (
    `sales_report_id`,
    `report_id`,
    `orders`,
    `popular`,
    `quantities`,
    `date_made`
  )
VALUES (
    1,
    '62ce4b49d9c48-62ce4b49d9c4a',
    '1,2,3,4,5,6',
    '3,2,7,6,21,23,45',
    '6,2,2,1,1,1,1',
    '2022-07-13 04:34:17'
  ),
  (
    2,
    '62ce4d488e24f-62ce4d488e252',
    '1,2,3,4,5,6,7,8',
    '3,2,7,18,19,4,6,17,21,22',
    '6,2,2,2,2,1,1,1,1,1',
    '2022-07-13 04:42:48'
  ),
  (
    3,
    '62ce55171bf2c-62ce55171bf2e',
    '1,2,3,4,5,6,7,8,9',
    '3,4,2,7,18,19,6,17,21,22',
    '6,4,2,2,2,2,1,1,1,1',
    '2022-07-13 05:16:07'
  ),
  (
    4,
    '62ce6cff7721e-62ce6cff77220',
    '1,2,3,4,5,6,7,8,9,10,11,12',
    '3,4,7,2,18,19,22,23,6,8',
    '8,5,3,2,2,2,2,2,1,1',
    '2022-07-13 06:58:07'
  ),
  (
    5,
    '62cf6197c8fe9-62cf6197c8feb',
    '1,2,3,4,5,6,7,8,9,10,11,12,13',
    '3,4,7,2,18,19,22,23,6,8',
    '8,6,3,2,2,2,2,2,1,1',
    '2022-07-14 00:21:43'
  ),
  (
    6,
    '62cf6275aed19-62cf6275aed1c',
    '1,2,3,4,5,6,7,8,9,10,11,12,13,14',
    '3,4,7,2,18,19,22,23,6,8',
    '9,7,4,2,2,2,2,2,1,1',
    '2022-07-14 00:25:25'
  ),
  (
    7,
    '62cfdcc883d5b-62cfdcc883d5e',
    '1,2,3,4,5,6,7,8,9,10,11,12,13,14',
    '3,4,7,2,18,19,22,23,6,8',
    '9,7,4,2,2,2,2,2,1,1',
    '2022-07-14 09:07:20'
  );
--
-- Indexes for dumped tables
--
--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
ADD PRIMARY KEY (`category_id`);
--
-- Indexes for table `members`
--
ALTER TABLE `members`
ADD PRIMARY KEY (`member_id`);
--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
ADD PRIMARY KEY (`order_id`);
--
-- Indexes for table `points_history`
--
ALTER TABLE `points_history`
ADD PRIMARY KEY (`point_history_id`);
--
-- Indexes for table `products`
--
ALTER TABLE `products`
ADD PRIMARY KEY (`product_id`);
--
-- Indexes for table `product_orders`
--
ALTER TABLE `product_orders`
ADD PRIMARY KEY (`product_order_id`);
--
-- Indexes for table `sales_reports`
--
ALTER TABLE `sales_reports`
ADD PRIMARY KEY (`sales_report_id`);
--
-- AUTO_INCREMENT for dumped tables
--
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 4;
--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 15;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 15;
--
-- AUTO_INCREMENT for table `points_history`
--
ALTER TABLE `points_history`
MODIFY `point_history_id` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 8;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 51;
--
-- AUTO_INCREMENT for table `product_orders`
--
ALTER TABLE `product_orders`
MODIFY `product_order_id` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 37;
--
-- AUTO_INCREMENT for table `sales_reports`
--
ALTER TABLE `sales_reports`
MODIFY `sales_report_id` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 8;
COMMIT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;