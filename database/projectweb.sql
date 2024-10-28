-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 28, 2024 at 04:36 PM
-- Server version: 8.0.17
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projectweb`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `UserID` int(11) NOT NULL,
  `username` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fname` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `lname` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `phone` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `User_status` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`UserID`, `username`, `fname`, `lname`, `email`, `password`, `phone`, `address`, `User_status`) VALUES
(3, 'CanIBeYourBoyFriends', 'กิตติพงศ์', 'ฤกษ์เกษี', 'kittipongInwza007za@gmail.com', '37d1fa2e4eb02cc5403a582333a8acec', '0970067198', '99/47 หมู่ 3 ซอย 2', 'USER'),
(5, 'hello', '', '', 'kittipongr65@nu.ac.th', 'b59c67bf196a4758191e42f76670ceba', '0970067198', NULL, 'USER'),
(6, 'roekkesi', '', '', 'zaza@gmiwda.com', '81dc9bdb52d04dc20036dbd8313ed055', '0943234323', NULL, 'USER'),
(8, 'pluem', '', '', 'pluem@gmail.com', '25f9e794323b453885f5181f1b624d0b', '0934324325', NULL, 'USER'),
(10, 'dewdew', '', '', 'dewdew@gmail.com', '25d55ad283aa400af464c76d713c07ad', '0947834324', NULL, 'ADMIN'),
(11, 'anotherOne', '', '', 'thisisabook@gmail.com', '25d55ad283aa400af464c76d713c07ad', '0970067198', NULL, 'USER'),
(12, 'BaiToey', 'benja', 'Ismean5', 'Benja5@gmail.com', '25d55ad283aa400af464c76d713c07ad', '0498230948', 'ไม่บอกกกก', 'USER'),
(13, 'kitti1234', '', '', 'kitti2131@gmail.com', '25d55ad283aa400af464c76d713c07ad', '9084023423', NULL, 'USER'),
(15, 'tumaraidee', 'idonthaveanything', 'hueeehueeee', 'huee@gmail.com', '5cda4d38e083f29b13510ee64c46cf34', '0932321231', NULL, 'USER'),
(16, 'eiei', 'kittipong', 'roekkesi', 'hellworld@gmail.com', 'cf1a44eb4893e6b8322f59155fa4a118', '0902342343', NULL, 'USER'),
(17, 'Porwachi', 'Porwachi', 'eiei', 'eiei@gmail.com', '84b3a2166c673a55120eef39a90980d1', '9042342342', NULL, 'ADMIN'),
(18, 'Imnewkub', 'kittipong', 'roekkesi', 'thisisnewrmail.com@gmail.com', '5268a3d643de0f05b7b8ec416f414b97', '0943849234', 'ขออยู่ตรงนี่นานกว่านี้จะได้ไหม', 'USER'),
(19, 'nonglaz', 'nonglaz', 'a007', 'nonglaz@gmail.com', '796f0f32255c687b5d9af94490b7710e', '0978321342', NULL, 'USER'),
(20, 'registerAgain', 'registerAgain', 'registerAgain', 'registerAgain@gmail.com', 'c741da4c3e2b18b54517cf96c2113943', '4832948723', 'นี่คือที่อยู่ใหม่ครับ', 'USER'),
(21, 'helloagain', 'helloagain', 'helloagain', 'helloagain@gmail.com', '9a7ee8988ad363d949c467985fc11c83', '0943243242', 'ผมมีที่อยู่อยู่ตรงนี้ไง มองไม่เห็น', 'USER'),
(22, 'hello kub', '1234', 'kittei', 'hello@gmail.com', '11ddbaf3386aea1f2974eee984542152', '9084384934', 'ผมมีที่อยู่อยู่ตรงนี้ไง มองไม่เห็นหรอ', 'USER');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(30) NOT NULL,
  `UserID` int(11) NOT NULL,
  `order_date` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `UserID`, `order_date`, `status`, `total_amount`, `address`) VALUES
(1, 7, '2024-10-26 14:36:03', 'onprocess', '16.00', 'dwadadaadad'),
(2, 8, '2024-10-27 16:50:01', 'success', '16.00', '99/53'),
(3, 3, '2024-10-26 17:01:56', 'onprocess', '1000.00', ''),
(4, 0, '2024-10-27 16:50:07', 'success', '2199.00', ''),
(5, 0, '2024-10-27 02:11:10', 'onprocess', '4089.00', ''),
(6, 0, '2024-10-27 02:10:47', 'onprocess', '1080.00', ''),
(11, 3, '2024-10-27 02:11:06', 'onprocess', '110.00', ''),
(12, 3, '2024-10-27 02:11:01', 'onprocess', '4139.00', ''),
(13, 3, '2024-10-27 02:10:56', 'onprocess', '109.00', ''),
(14, 3, '2024-10-27 02:10:51', 'onprocess', '229.00', ''),
(15, 3, '2024-10-27 02:10:44', 'onprocess', '109.00', ''),
(16, 0, '2024-10-27 02:10:40', 'onprocess', '109.00', ''),
(17, 0, '2024-10-27 02:10:37', 'onprocess', '4329.00', ''),
(18, 0, '2024-10-27 02:10:30', 'onprocess', '139.00', ''),
(19, 3, '2024-10-27 02:10:33', 'onprocess', '398.00', ''),
(20, 3, '2024-10-27 02:10:26', 'onprocess', '79.00', ''),
(21, 3, '2024-10-27 02:10:22', 'onprocess', '79.00', ''),
(22, 3, '2024-10-27 02:10:17', 'onprocess', '4999.00', ''),
(23, 3, '2024-10-27 02:05:20', 'onprocess', '7998.00', 'ใส่ที่อยูู่แล้วครับก็ใส่แล้วนะ'),
(24, 18, '2024-10-27 02:41:56', 'onprocess', '1120.00', 'ขออยู่ตรงนี่นานกว่านี้จะได้ไหม'),
(25, 18, '2024-10-27 02:42:59', 'onprocess', '79.00', 'ขออยู่ตรงนี่นานกว่านี้จะได้ไหม'),
(26, 18, '2024-10-27 02:43:18', 'onprocess', '79.00', 'ขออยู่ตรงนี่นานกว่านี้จะได้ไหม'),
(27, 20, '2024-10-27 02:48:07', 'onprocess', '109.00', 'นี่คือที่อยู่ใหม่ครับ'),
(28, 3, '2024-10-27 10:21:32', 'onprocess', '589.00', '99/47 หมู่ 3 ซอย 2'),
(29, 21, '2024-10-27 12:12:30', 'onprocess', '4299.00', 'ผมมีที่อยู่อยู่ตรงนี้ไง มองไม่เห็นหรอ'),
(30, 21, '2024-10-27 12:13:25', 'onprocess', '4568.00', 'ผมมีที่อยู่อยู่ตรงนี้ไง มองไม่เห็นหรอ'),
(31, 3, '2024-10-27 12:14:08', 'onprocess', '30.00', '99/47 หมู่ 3 ซอย 3'),
(32, 3, '2024-10-27 15:34:58', 'onprocess', '1000.00', 'ไม่เอาอ่ะ'),
(33, 3, '2024-10-27 16:00:33', 'onprocess', '199.00', 'ไม่เอาอ่ะ'),
(34, 3, '2024-10-27 16:03:48', 'onprocess', '398.00', 'ไม่เอาอ่ะ'),
(35, 3, '2024-10-27 16:08:33', 'onprocess', '398.00', 'ไม่เอาอ่ะ'),
(36, 3, '2024-10-27 16:50:18', 'waiting', '189.00', 'ไม่เอาอ่ะ'),
(37, 3, '2024-10-27 16:16:20', 'onprocess', '199.00', 'ไม่เอาอ่ะ'),
(38, 3, '2024-10-27 16:16:45', 'onprocess', '995.00', 'ไม่เอาอ่ะ'),
(39, 3, '2024-10-27 16:20:00', 'onprocess', '50.00', 'ไม่เอาอ่ะ'),
(40, 3, '2024-10-27 16:30:27', 'onprocess', '1000.00', 'ไม่เอาอ่ะ'),
(41, 3, '2024-10-27 16:35:44', 'onprocess', '79.00', 'สวัสดีครับ'),
(42, 3, '2024-10-27 16:36:13', 'onprocess', '2000.00', 'สวัสดีครับ'),
(43, 3, '2024-10-27 16:49:54', 'waiting', '139.00', 'สวัสดีครับ'),
(44, 3, '2024-10-27 20:47:58', 'onprocess', '119.00', 'สวัสดีครับ'),
(45, 3, '2024-10-27 20:48:06', 'onprocess', '599.00', 'สวัสดีครับ'),
(46, 12, '2024-10-28 19:22:00', 'success', '599.00', 'ไม่บอกกกก'),
(47, 3, '2024-10-28 20:03:46', 'failed', '1060.00', 'สวัสดีครับ'),
(48, 22, '2024-10-28 20:18:06', 'onprocess', '1030.00', 'ผมมีที่อยู่อยู่ตรงนี้ไง มองไม่เห็นหรอ');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1',
  `unit_price` decimal(10,2) NOT NULL,
  `total_price` decimal(10,2) GENERATED ALWAYS AS ((`quantity` * `unit_price`)) STORED
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_item_id`, `order_id`, `product_id`, `quantity`, `unit_price`) VALUES
(1, 3, 16, 1, '1000.00'),
(2, 4, 22, 1, '2000.00'),
(3, 4, 1, 1, '199.00'),
(4, 5, 10, 1, '40.00'),
(5, 5, 9, 1, '50.00'),
(6, 5, 11, 1, '3999.00'),
(7, 6, 9, 1, '50.00'),
(8, 6, 8, 1, '30.00'),
(9, 6, 15, 1, '1000.00'),
(10, 11, 9, 1, '50.00'),
(11, 11, 8, 1, '30.00'),
(12, 11, 7, 1, '30.00'),
(13, 12, 11, 1, '3999.00'),
(14, 12, 10, 1, '40.00'),
(15, 12, 9, 2, '50.00'),
(16, 13, 2, 1, '79.00'),
(17, 13, 7, 1, '30.00'),
(18, 14, 1, 1, '199.00'),
(19, 14, 8, 1, '30.00'),
(20, 15, 2, 1, '79.00'),
(21, 15, 7, 1, '30.00'),
(22, 16, 2, 1, '79.00'),
(23, 16, 7, 1, '30.00'),
(24, 17, 7, 1, '30.00'),
(25, 17, 13, 1, '4299.00'),
(26, 18, 2, 1, '79.00'),
(27, 18, 8, 2, '30.00'),
(28, 19, 1, 2, '199.00'),
(29, 20, 2, 1, '79.00'),
(30, 21, 2, 1, '79.00'),
(31, 22, 12, 1, '3999.00'),
(32, 22, 15, 1, '1000.00'),
(33, 23, 12, 2, '3999.00'),
(34, 24, 7, 1, '30.00'),
(35, 24, 8, 3, '30.00'),
(36, 24, 17, 1, '1000.00'),
(37, 25, 2, 1, '79.00'),
(38, 26, 2, 1, '79.00'),
(39, 27, 2, 1, '79.00'),
(40, 27, 7, 1, '30.00'),
(41, 28, 42, 1, '499.00'),
(42, 28, 7, 3, '30.00'),
(43, 29, 13, 1, '4299.00'),
(44, 30, 2, 1, '79.00'),
(45, 30, 7, 3, '30.00'),
(46, 30, 14, 1, '4399.00'),
(47, 31, 7, 1, '30.00'),
(48, 32, 18, 1, '1000.00'),
(49, 33, 1, 1, '199.00'),
(50, 34, 1, 2, '199.00'),
(51, 35, 1, 2, '199.00'),
(52, 36, 8, 1, '30.00'),
(53, 36, 9, 1, '50.00'),
(54, 36, 7, 1, '30.00'),
(55, 36, 2, 1, '79.00'),
(56, 37, 1, 1, '199.00'),
(57, 38, 1, 5, '199.00'),
(58, 39, 9, 1, '50.00'),
(59, 40, 18, 1, '1000.00'),
(60, 41, 2, 1, '79.00'),
(61, 42, 22, 1, '2000.00'),
(62, 43, 2, 1, '79.00'),
(63, 43, 7, 1, '30.00'),
(64, 43, 8, 1, '30.00'),
(65, 44, 10, 1, '40.00'),
(66, 44, 2, 1, '79.00'),
(67, 45, 50, 1, '599.00'),
(68, 46, 9, 2, '50.00'),
(69, 46, 49, 1, '499.00'),
(70, 47, 7, 1, '30.00'),
(71, 47, 8, 1, '30.00'),
(72, 47, 17, 1, '1000.00'),
(73, 48, 7, 1, '30.00'),
(74, 48, 16, 1, '1000.00');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock_quantity` int(11) NOT NULL DEFAULT '0',
  `product_img` varchar(100) NOT NULL,
  `artist` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `category`, `price`, `stock_quantity`, `product_img`, `artist`) VALUES
(1, 'Pots and glasses', 'Ceramic', '199.00', 15, 'เซรามิกกระถาง.jpg', 'beombaedy'),
(2, 'Tray', 'Ceramic', '79.00', 48, 'เซรามิกถาดเล็ก.jpg', 'beombaedy'),
(7, 'keychain v.1', 'Ceramic', '30.00', 100, 'เซรามิกพวงกุญแจ1.jpg', 'beombaedy'),
(8, 'keychain v.2', 'Ceramic', '30.00', 99, 'เซรามิกพวงกุญแจ2.jpg', 'beombaedy'),
(9, 'sculpt', 'Ceramic', '50.00', 19, 'เซรามิกเล็ก1.jpg', 'beombaedy'),
(10, 'Glass+spoon', 'Ceramic', '40.00', 20, 'เซรามิกแก้ว+ช้อน.jpg', 'beombaedy'),
(11, 'SeaBunny', 'Canvas', '3999.00', 1, 'seabunny.jpg', 'beombaedy'),
(12, 'Baroque', 'Canvas', '3999.00', 1, 'Baroque.jpg', 'beombaedy'),
(13, 'family', 'Canvas', '4299.00', 1, 'family.jpg', 'beombaedy'),
(14, 'ของเล่น', 'Canvas', '4399.00', 1, 'ของเล่น.jpg', 'beombaedy'),
(15, 'Bluerose', 'Digital', '1000.00', 1, 'BlueRose.jpg', 'beombaedy'),
(16, '1750', 'Digital', '1000.00', 0, '1750.jpg', 'beombaedy'),
(17, 'angel', 'Digital', '1000.00', 0, 'angel.jpg', 'beombaedy'),
(18, 'flower', 'Digital', '1000.00', 0, 'flower.jpg', 'beombaedy'),
(19, 'flowerbunny', 'Digital', '1000.00', 1, 'flowerbunny.jpg', 'beombaedy'),
(20, 'meAndme', 'Digital', '1000.00', 1, 'meAndme.jpg', 'beombaedy'),
(21, 'stange', 'Digital', '1000.00', 1, 'stange.jpg', 'beombaedy'),
(22, 'Under the sea', 'Digital', '2000.00', 0, 'Underthesea.jpg', 'beombaedy'),
(23, 'ตู้คีบ', 'Digital', '1000.00', 1, 'ตู้คีบ.jpg', 'beombaedy'),
(41, 'กาน้ำร้อน', 'Ceramic', '599.00', 2, 'กาน้ำร้อน3.jpg', 'beombaedy'),
(42, 'แก้วตะเกียบ', 'Ceramic', '499.00', 1, 'แก้วตะเกียบ.jpg', 'beombaedy'),
(43, 'แก้วมีฝาปิด', 'Ceramic', '599.00', 1, 'แก้วมีฝาปิด.jpg', 'beombaedy'),
(44, 'จานไข่ดาว', 'Ceramic', '399.00', 1, 'จานไข่ดาว.jpg', 'beombaedy'),
(45, 'จานน่ารัก', 'Ceramic', '399.00', 1, 'จานน่ารัก.jpg', 'beombaedy'),
(46, 'จานวาด', 'Ceramic', '399.00', 1, 'จานวาด.jpg', 'beombaedy'),
(47, 'จานสี', 'Ceramic', '599.00', 1, 'จานสี.jpg', 'beombaedy'),
(48, 'จานสีน่ารักมาก', 'Ceramic', '599.00', 1, 'จานสี2.jpg', 'beombaedy'),
(49, 'ช้อนน่ารัก', 'Ceramic', '499.00', 3, 'ช้อน.jpg', 'beombaedy'),
(50, 'ถ้วยตะเกียบ', 'Ceramic', '599.00', 1, 'ถ้วยตะเกียบ3.jpg', 'beombaedy');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
