-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 26, 2022 at 12:55 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `date_made`) VALUES
(1, 'Drinks', '2022-07-11 01:06:44'),
(2, 'Rice Meal', '2022-07-11 01:22:05'),
(3, 'Snacks', '2022-07-11 01:22:05');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `customer_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `id`, `customer_type`) VALUES
(0, 2, 'Member');

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
  `points` float NOT NULL,
  `address` varchar(200) NOT NULL,
  `date_registered` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`member_id`, `lastname`, `firstname`, `middlename`, `fullname`, `email`, `phone`, `points`, `address`, `date_registered`) VALUES
(1, 'Tero', 'Jhon Orlan', 'Gene', 'Tero, Jhon Orlan Gene', 'jhonorlantero@gmail.com', '09360743084', 1.7, 'R10 Sitio Santo Ninio NBBS', '2022-07-17 15:49:15'),
(2, 'Last', 'First', 'Middle', 'Last, First Middle', 'jhonorlantero@gmail.com', '09360743084', 0, 'R10 Sitio Santo Ninio NBBS', '2022-07-26 10:53:48');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `pre_order_id`, `transaction_id`, `member_id`, `total_amount`, `redeemed_points`, `earned_points`, `discount`, `final_amount`, `reward_points`, `date_made`) VALUES
(1, '172', '62d42f93e190a-62d42f93e190b', '1', 255, 0, 1.7, 0, 255, 1.7, '2022-07-17 15:49:39'),
(2, '98', '62dfc7e9b8aec-62dfc7e9b8aee', '', 80, 0, 0, 0, 80, 0, '2022-07-26 10:54:33');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `points_history`
--

INSERT INTO `points_history` (`point_history_id`, `order_id`, `member_id`, `total_amount`, `redeemed_points`, `earned_points`, `discount`, `final_amount`, `reward_points`, `date_made`) VALUES
(1, 1, '1', 255, 0, 1.7, 0, 255, 1.7, '2022-07-17 15:49:40');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `price`, `category`, `image`, `date_created`) VALUES
(1, 'Cafe Americano', 70, 'Drinks', 'drinks-62d42f1aa444d.jpg', '2022-07-17 15:47:38'),
(2, 'Cafe Latte', 80, 'Drinks', 'drinks-62d42f1ab1d79.jpeg', '2022-07-17 15:47:38'),
(3, 'Cappuccino', 85, 'Drinks', 'drinks-62d42f1abe9bb.jpg', '2022-07-17 15:47:38'),
(4, 'Mocha', 85, 'Drinks', 'drinks-62d42f1ae12be.jpg', '2022-07-17 15:47:38'),
(5, 'Caramel Macchiato', 90, 'Drinks', 'drinks-62d42f1aef815.jpg', '2022-07-17 15:47:38'),
(6, 'Caramel Latte', 90, 'Drinks', 'drinks-62d42f1b0c5fb.jpg', '2022-07-17 15:47:39'),
(7, 'Hot Chocolate', 80, 'Drinks', 'drinks-62d42f1b173a5.jpg', '2022-07-17 15:47:39'),
(8, 'Cafe Misto', 80, 'Drinks', 'drinks-62d42f1b2147b.jpg', '2022-07-17 15:47:39'),
(9, 'Dark Roast Coffee', 80, 'Drinks', 'drinks-62d42f1b2a387.jfif', '2022-07-17 15:47:39'),
(10, 'Flat White Coffee', 85, 'Drinks', 'drinks-62d42f1b34489.jpg', '2022-07-17 15:47:39'),
(11, 'Affogato', 90, 'Drinks', 'drinks-62d42f1b451dd.jpg', '2022-07-17 15:47:39'),
(12, 'Cold Brew Coffee', 90, 'Drinks', 'drinks-62d42f1b5fb7e.jpeg', '2022-07-17 15:47:39'),
(13, 'Strawberry', 75, 'Drinks', 'drinks-62d42f1b85bce.jpg', '2022-07-17 15:47:39'),
(14, 'Blueberry', 75, 'Drinks', 'drinks-62d42f1b914c5.jpg', '2022-07-17 15:47:39'),
(15, 'Blue Lemonade', 75, 'Drinks', 'drinks-62d42f1b9b348.jpg', '2022-07-17 15:47:39'),
(16, 'Honey Lemonade', 75, 'Drinks', 'drinks-62d42f1ba448a.jpg', '2022-07-17 15:47:39'),
(17, 'Iced Tea', 50, 'Drinks', 'drinks-62d42f1bb0ee3.jpg', '2022-07-17 15:47:39'),
(18, 'Bottled Water', 20, 'Drinks', 'drinks-62d42f1bb9fb9.jpg', '2022-07-17 15:47:39'),
(19, 'Canned Soft Drinks', 50, 'Drinks', 'drinks-62d42f1bc962d.jpg', '2022-07-17 15:47:39'),
(20, 'Hotsilog', 65, 'Rice Meal', 'rice meal-62d42f1bd267a.jpg', '2022-07-17 15:47:39'),
(21, 'Longsilog', 65, 'Rice Meal', 'rice meal-62d42f1bdc674.jpeg', '2022-07-17 15:47:39'),
(22, 'Tapsilog', 85, 'Rice Meal', 'rice meal-62d42f1be568c.jpg', '2022-07-17 15:47:39'),
(23, 'Tocilog', 65, 'Rice Meal', 'rice meal-62d42f1bf01a5.jpg', '2022-07-17 15:47:39'),
(24, 'Malingsilog', 65, 'Rice Meal', 'rice meal-62d42f1c043e1.jpg', '2022-07-17 15:47:40'),
(25, 'Chicksilog', 80, 'Rice Meal', 'rice meal-62d42f1c1066c.jpg', '2022-07-17 15:47:40'),
(26, 'Porksilog', 90, 'Rice Meal', 'rice meal-62d42f1c19f2e.jpg', '2022-07-17 15:47:40'),
(27, 'Bangsilog', 90, 'Rice Meal', 'rice meal-62d42f1c23df7.jpg', '2022-07-17 15:47:40'),
(28, 'Cornsilog', 60, 'Rice Meal', 'rice meal-62d42f1c2cee3.jpg', '2022-07-17 15:47:40'),
(29, 'Extra Rice', 15, 'Rice Meal', 'rice meal-62d42f1c36e6a.png', '2022-07-17 15:47:40'),
(30, 'Fried Rice', 25, 'Rice Meal', 'rice meal-62d42f1c3febf.jpg', '2022-07-17 15:47:40'),
(31, 'Carbonara', 95, 'Snacks', 'snacks-62d42f1c49e93.jpg', '2022-07-17 15:47:40'),
(32, 'Italian Spaghetti', 100, 'Snacks', 'snacks-62d42f1c55a9d.jpg', '2022-07-17 15:47:40'),
(33, 'Creamy Tuna Pesto', 110, 'Snacks', 'snacks-62d42f1c689f7.jpg', '2022-07-17 15:47:40'),
(34, 'Baked Macaroni', 100, 'Snacks', 'snacks-62d42f1c72827.jpg', '2022-07-17 15:47:40'),
(35, 'Garlic Parmesan', 120, 'Snacks', 'snacks-62d42f1c7b9bd.jpg', '2022-07-17 15:47:40'),
(36, 'Sweet BBQ Wings', 120, 'Snacks', 'snacks-62d42f1c85897.jpg', '2022-07-17 15:47:40'),
(37, 'Signature Buffalo Wings', 120, 'Snacks', 'snacks-62d42f1c8e9e6.jpg', '2022-07-17 15:47:40'),
(38, 'Honey Garlic', 120, 'Snacks', 'snacks-62d42f1c98923.jfif', '2022-07-17 15:47:40'),
(39, 'Teriyaki Chicken Wings', 120, 'Snacks', 'snacks-62d42f1ca7096.jfif', '2022-07-17 15:47:40'),
(40, 'Korean Chicken Wings', 120, 'Snacks', 'snacks-62d42f1cb0e6f.jpg', '2022-07-17 15:47:40'),
(41, 'Classic Homestyle Wings', 110, 'Snacks', 'snacks-62d42f1cbf706.jpg', '2022-07-17 15:47:40'),
(42, 'Cheesy Fries', 60, 'Snacks', 'snacks-62d42f1cc958f.jpg', '2022-07-17 15:47:40'),
(43, 'Beef Nachos', 95, 'Snacks', 'snacks-62d42f1cd26a7.jpg', '2022-07-17 15:47:40'),
(44, 'Beef Tacos', 35, 'Snacks', 'snacks-62d42f1cdc58d.jpg', '2022-07-17 15:47:40'),
(45, 'Burger', 40, 'Snacks', 'snacks-62d42f1ce585e.jpg', '2022-07-17 15:47:40');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_orders`
--

INSERT INTO `product_orders` (`product_order_id`, `order_id`, `product_id`, `quantity`, `price`, `total`, `date_ordered`) VALUES
(1, 1, 3, 2, 85, 170, '2022-07-17 15:49:39'),
(2, 1, 4, 1, 85, 85, '2022-07-17 15:49:40'),
(3, 2, 2, 1, 80, 80, '2022-07-26 10:54:33');

-- --------------------------------------------------------

--
-- Table structure for table `sales_reports`
--

CREATE TABLE `sales_reports` (
  `sales_report_id` int(11) NOT NULL,
  `report_id` varchar(100) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `total_sales` int(11) NOT NULL,
  `date_made` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales_reports`
--

INSERT INTO `sales_reports` (`sales_report_id`, `report_id`, `from_date`, `to_date`, `total_sales`, `date_made`) VALUES
(1, '62dfc25962b4e-62dfc25962b51', '2022-07-05', '2022-07-28', 170, '2022-07-26 10:30:49');

-- --------------------------------------------------------

--
-- Table structure for table `sales_report_orders`
--

CREATE TABLE `sales_report_orders` (
  `sales_report_order_id` int(11) NOT NULL,
  `report_id` varchar(100) NOT NULL,
  `order_id` int(11) NOT NULL,
  `order_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales_report_orders`
--

INSERT INTO `sales_report_orders` (`sales_report_order_id`, `report_id`, `order_id`, `order_quantity`) VALUES
(1, '62dfc25962b4e-62dfc25962b51', 1, 2),
(2, '62dfc25962b4e-62dfc25962b51', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sales_report_populars`
--

CREATE TABLE `sales_report_populars` (
  `sales_report_popular_id` int(11) NOT NULL,
  `report_id` varchar(100) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales_report_populars`
--

INSERT INTO `sales_report_populars` (`sales_report_popular_id`, `report_id`, `product_id`) VALUES
(1, '62dfc25962b4e-62dfc25962b51', 3),
(2, '62dfc25962b4e-62dfc25962b51', 4);

-- --------------------------------------------------------

--
-- Table structure for table `walk_in`
--

CREATE TABLE `walk_in` (
  `walk_in_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `walk_in`
--

INSERT INTO `walk_in` (`walk_in_id`, `order_id`) VALUES
(1, 2);

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
-- Indexes for table `sales_report_orders`
--
ALTER TABLE `sales_report_orders`
  ADD PRIMARY KEY (`sales_report_order_id`);

--
-- Indexes for table `sales_report_populars`
--
ALTER TABLE `sales_report_populars`
  ADD PRIMARY KEY (`sales_report_popular_id`);

--
-- Indexes for table `walk_in`
--
ALTER TABLE `walk_in`
  ADD PRIMARY KEY (`walk_in_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `points_history`
--
ALTER TABLE `points_history`
  MODIFY `point_history_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `product_orders`
--
ALTER TABLE `product_orders`
  MODIFY `product_order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sales_reports`
--
ALTER TABLE `sales_reports`
  MODIFY `sales_report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sales_report_orders`
--
ALTER TABLE `sales_report_orders`
  MODIFY `sales_report_order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sales_report_populars`
--
ALTER TABLE `sales_report_populars`
  MODIFY `sales_report_popular_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `walk_in`
--
ALTER TABLE `walk_in`
  MODIFY `walk_in_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
