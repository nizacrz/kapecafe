-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2022 at 11:56 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kapecafe`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `quantity` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `email` varchar(255) NOT NULL,
  `method` varchar(100) NOT NULL,
  `flat` varchar(100) NOT NULL,
  `street` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `pin_code` int(10) NOT NULL,
  `total_products` varchar(255) NOT NULL,
  `total_price` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `name`, `number`, `email`, `method`, `flat`, `street`, `city`, `state`, `country`, `pin_code`, `total_products`, `total_price`) VALUES
(1, 'mimi', '2', 'sakayna@gmail.com', 'cash on delivery', 'dwdw', 'confe', 'antipolo', 'hehe', 'hehe', 123456, 'Ube Cake (1) , Pianono (1) ', '630'),
(2, 'mimi', '2', 'sakayna@gmail.com', 'cash on delivery', 'dwdw', 'confe', 'antipolo', 'hehe', 'hehe', 123456, 'Ube Cake (1) , Pianono (1) ', '630'),
(3, 'mimi', '1234', 'sakayna@gmail.com', 'cash on delivery', '1', '1', '1', '1', '1', 1, 'Ube Cake (1) , Pianono (1) ', '630'),
(4, 'mimi', '1234', 'sakayna@gmail.com', 'cash on delivery', '1', '1', '1', '1', '1', 1, 'Ube Cake (1) , Pianono (1) ', '630'),
(5, 'Koopi Cruz', '09691955153', 'kopitayo@gmail.com', 'cash on delivery', '128', 'Livelihoo St', 'Quezon City', 'NCR', 'Philippines', 1126, 'Ube Cake (1) , Pianono (1) ', '630'),
(6, 'sdf', 'sdf', 'sdf@gmail.com', 'cash on delivery', 'sdf', 'sdf', 'sdf', 'sdf', 'sdf', 0, 'Ube Cake (1) , Pianono (1) ', '630'),
(7, 'sdf', 'sfd', 'sdf@gmail.com', 'cash on delivery', 'sfd', 'dfs', 'df', 'fds', 'dfs', 0, 'Ube Cake (1) , Pianono (1) ', '630');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `price` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category`, `name`, `description`, `image`, `price`) VALUES
(27, 'Cakes', 'Strawberry Shortcake', 'Strawberry cake with fresh strawberry filling, icing, and glazed topping.', 'CAKE1.png', '775.00'),
(28, 'Cakes', 'Ube Cake', 'Ube cake with fresh ube jam filling and frosting.', 'CAKE2.png', '555.00'),
(29, 'Cakes', 'Red Velvet Cake', 'Moist cake with a hint of vanilla, smothered with cream cheese frosting.', 'CAKE3.png', '555.00'),
(30, 'Cakes', 'Chocolate Strawberry Cake', ' Moist chocolate cake coated with rich chocolate ganache with fresh strawberry toppings.', 'CAKE4.png', '775.00'),
(31, 'Cakes', 'Blueberry Cheesecake', 'Perfectly baked cheesecakes.', 'CAKE5.png', '570.00'),
(32, 'Beverages', 'Kapeng Barako', 'A hot Batangas’ Best Kapeng Barako.', 'BEV1.png', '70.00'),
(33, 'Beverages', 'Iced Latte Coffee', 'A milk mixed into Sagada’s Best espresso with ice.', 'BEV2.png', '75.00'),
(34, 'Beverages', 'Caramel Macchiato', 'Freshly steamed milk with vanilla-flavored syrup marked with espresso and topped with a caramel driz', 'BEV3.png', '95.00'),
(35, 'Beverages', 'Chocolate Chip Frappuccino', 'Made with freshly brewed espresso, chocolate chips, and chocolate syrup.', 'BEV4.png', '115.00'),
(36, 'Beverages', 'Strawberry Smoothie', 'Made of frozen strawberries, frozen bananas, yogurt, and almond milk.', 'BEV5.png', '120.00'),
(37, 'Pastries', 'Ube Cheese Pan de Sal', 'A classic Filipino bread features a rich, fluffy ube dough filled with melty cheese.', 'PAST1.png', '85.00'),
(38, 'Pastries', 'Pan de Coco', 'A Filipino soft bread roll stuffed with sweetened grated coconut meat.', 'PAST2.png', '85.00'),
(39, 'Pastries', 'Pianono', 'A soft textured-rolled version of mamon that has margarine and sugar filling.', 'PAST3.png', '75.00'),
(40, 'Pastries', 'Chicken Empanada', 'A flaky crust traditionally filled with chicken sautéed with onions, peas, raisins, and potatoes.', 'PAST4.png', '95.00'),
(41, 'Pastries', 'Ensaymada', 'A Filipino soft, sweet dough pastry covered with butter and sugar then topped with lots of grated ch', 'PAST5.png', '99.00'),
(42, 'Kakanin', 'Puto Bumbóng', 'A Filipino purple rice cake steamed in bamboo tubes.', 'KAKS1.png', '145.00'),
(43, 'Kakanin', 'Palitaw', 'A Philippine dessert and snack made with simple rice flour dough coated in coconut and sesame seeds.', 'KAKS2.png', '99.00'),
(44, 'Kakanin', 'Puto Calasiao', 'A Filipino muffin or steamed rice cake in small bite-sized portions.', 'KAKS3.png', '85.00'),
(45, 'Kakanin', 'Maja Blanca', 'Sometimes called, coconut pudding. A Filipino dessert made of coconut milk and corn.', 'KAKS4.png', '99.00'),
(46, 'Kakanin', 'Bibingka', 'A traditional Filipino dessert that is soft rice cake paired with salty duck egg and cheese topping.', 'KAKS5.png', '79.00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `email`, `password`, `role`) VALUES
(5, 'Taffy ', 'Cruz', 'cashier', 'admin.cashier@gmail.com', 'Admin@123', 'Admin'),
(9, 'Koopi', 'Cruz', 'kopitayo', 'kopitayo@gmail.com', 'User@12345!', 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
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
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
