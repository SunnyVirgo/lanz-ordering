-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2023 at 04:03 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `lanz_pizza`
--

-- --------------------------------------------------------

--
-- Table structure for table `food_category`
--

CREATE TABLE IF NOT EXISTS `food_category` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(100) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=43 ;

--
-- Dumping data for table `food_category`
--

INSERT INTO `food_category` (`id`, `category_name`, `date_created`, `deleted`) VALUES
(38, 'Pizza', '2022-11-09 10:31:51', 0),
(39, 'pasta & fries', '2022-11-09 10:44:14', 0),
(40, 'Breakfast & Meals', '2022-11-22 09:52:27', 0),
(41, 'Drinks', '2022-11-22 09:52:40', 0),
(42, 'Shakes', '2022-11-22 09:52:52', 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tcode` varchar(100) DEFAULT NULL,
  `name` varchar(10) NOT NULL,
  `table` varchar(10) NOT NULL,
  `status` tinyint(1) DEFAULT '0',
  `type` varchar(10) DEFAULT NULL,
  `cashier` varchar(100) DEFAULT NULL,
  `kitchen_staff` varchar(100) DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `tendered_amount` decimal(10,2) DEFAULT NULL,
  `change_amount` decimal(20,2) NOT NULL,
  `date` date DEFAULT NULL,
  `update_time` time DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=194 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `tcode`, `name`, `table`, `status`, `type`, `cashier`, `kitchen_staff`, `total_amount`, `tendered_amount`, `change_amount`, `date`, `update_time`) VALUES
(156, '20230122001', 'chou', '01', 2, 'in', 'Sunny', 'Ken', '338.00', '400.00', '62.00', '2023-01-22', '14:45:04'),
(158, '20230122003', 'gusion', '01', 2, 'out', 'Sunny', 'Ken', '1345.00', '2000.00', '655.00', '2023-01-22', '20:44:25'),
(159, '20230122002', 'Guinievere', '01', 2, 'out', 'Sunny', 'Ken', '889.00', '900.00', '11.00', '2023-01-22', '15:40:39'),
(160, '20230124001', 'Garen', '01', 2, 'in', 'Sunny', 'Ken', '403.00', '500.00', '97.00', '2023-01-24', '12:21:56'),
(161, '20230124002', 'Sunny', '01', 2, 'out', 'Sunny', 'Ken', '234.00', '300.00', '66.00', '2023-01-24', '12:23:35'),
(163, '20230125001', 'Green', '01', 2, 'out', 'Sunny', 'Ken', '1126.00', '2000.00', '874.00', '2023-01-25', '08:33:36'),
(165, '20230125002', 'red', '01', 2, 'in', 'Sunny', 'ken', '403.00', '500.00', '97.00', '2023-01-25', '08:55:35'),
(167, '20230302001', 'stacktrek', '01', 2, 'in', 'Sunny', 'ken', '2665.00', '3000.00', '335.00', '2023-03-02', '14:14:24'),
(177, '20230304001', 'trw', '01', 2, 'in', 'Sunny', 'ken', '338.00', '500.00', '162.00', '2023-03-04', '16:50:23'),
(178, '20230316001', 'Ed', '01', 2, 'in', 'Sunny', 'ken', '1035.00', '1200.00', '165.00', '2023-03-16', '20:01:25'),
(179, '20230317001', 'rerse', '01', 2, 'in', 'Sunny', 'ken', '169.00', '200.00', '31.00', '2023-03-17', '17:51:58'),
(181, '20230317002', 'YouPorn', '01', 2, 'in', 'Sunny', 'ken', '169.00', '169.00', '0.00', '2023-03-17', '18:51:19'),
(182, '20230317003', 'Youjizz', '01', 2, 'out', 'Sunny', 'ken', '572.00', '600.00', '28.00', '2023-03-17', '18:54:59'),
(183, '20230317004', 'pornHub', '01', 2, 'out', 'Sunny', 'ken', '572.00', '600.00', '28.00', '2023-03-17', '18:56:10'),
(184, '20230317005', '18 XXX', '01', 2, 'out', 'Sunny', 'ken', '147.00', '500.00', '353.00', '2023-03-17', '18:57:11'),
(187, '20230323001', 'wfewa', '01', 1, 'out', 'Sunny', NULL, '338.00', '400.00', '62.00', '2023-03-23', '13:07:39'),
(189, '20230505001', 'tertsaa', '01', 1, 'in', 'Sunny', NULL, '1265.00', '2000.00', '735.00', '2023-05-05', '08:20:00'),
(192, '20230505002', 'wewq', '01', 1, 'in', 'Sunny', NULL, '234.00', '300.00', '66.00', '2023-05-05', '17:10:22'),
(193, '20230505003', 'fds', '01', 1, 'in', 'Sunny', NULL, '572.00', '600.00', '28.00', '2023-05-05', '18:22:28');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE IF NOT EXISTS `order_details` (
  `order_id` int(100) NOT NULL,
  `food_id` int(10) NOT NULL,
  `qnty` int(100) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  KEY `food_id` (`food_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`order_id`, `food_id`, `qnty`, `total_price`) VALUES
(159, 28, 7, '889.00'),
(163, 28, 1, '127.00'),
(177, 34, 1, '169.00'),
(178, 58, 5, '345.00'),
(178, 56, 8, '552.00'),
(178, 63, 1, '69.00'),
(178, 62, 1, '69.00'),
(182, 32, 1, '169.00'),
(183, 32, 1, '169.00'),
(184, 53, 1, '49.00'),
(184, 54, 1, '49.00'),
(184, 55, 1, '49.00'),
(185, 34, 10, '1690.00'),
(185, 32, 1, '169.00'),
(185, 57, 4, '276.00'),
(185, 64, 1, '69.00'),
(186, 32, 1, '169.00'),
(186, 32, 1, '169.00'),
(187, 32, 1, '169.00'),
(189, 32, 1, '169.00'),
(189, 34, 1, '169.00'),
(189, 51, 1, '79.00'),
(189, 49, 1, '169.00'),
(189, 58, 1, '69.00'),
(189, 63, 1, '69.00'),
(189, 60, 1, '69.00'),
(189, 61, 1, '69.00'),
(192, 30, 1, '234.00'),
(193, 31, 1, '169.00'),
(193, 30, 1, '234.00'),
(193, 34, 1, '169.00');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `qoute` text NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `vat_percentage` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `logo`, `qoute`, `address`, `contact`, `email`, `vat_percentage`) VALUES
(1, 'Lanz Pizza', 'Logo_5172.png', 'Tasted so many pizzas but haven`t found a favorite yet? Well, you`re in luck! Try our mouthwatering\r\n                    pizza or we will give you a money back guarantee. Order Now!', 'Sibalom, Antique', '0917-771-8529', 'Niqxz0721@gmail.com', '12');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE IF NOT EXISTS `tbl_admin` (
  `id` int(10) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `user_name`, `password`, `user_type`) VALUES
(1, 'iCore', '21232f297a57a5a743894a0e4a801fc3', 'Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_food`
--

CREATE TABLE IF NOT EXISTS `tbl_food` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `food_name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `size` varchar(10) NOT NULL,
  `price` decimal(6,2) NOT NULL,
  `stocks` int(10) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category_id` int(10) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `featured` varchar(10) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `withvat` smallint(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  KEY `category_id_2` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=67 ;

--
-- Dumping data for table `tbl_food`
--

INSERT INTO `tbl_food` (`id`, `food_name`, `description`, `size`, `price`, `stocks`, `image_name`, `category_id`, `date_created`, `featured`, `deleted`, `withvat`) VALUES
(28, 'Hawaiian Pizza ', 'jdhjfdhsh', 'Regular', '127.00', 92, 'Food_3213.png', 38, '2022-11-09 10:43:29', 'Yes', 1, 1),
(30, 'Super Hawaiian (Mozarella)', 'This super delicious pizza is loaded with sweet juicy pineapple tidbits, bacon, ham, and mozzarella cheese.', 'family', '234.00', 68, 'Food_9117.png', 38, '2023-01-22 13:46:25', 'Yes', 0, 1),
(31, 'Hotdog Deluxe (Quickmelt)', 'this deluxe pizza is loaded with cheese, topped with thin-sliced hotdog and sprinkled with mozzarella cheese.', 'family', '169.00', 84, 'Food_4355.png', 38, '2023-01-22 13:47:30', 'Yes', 0, 1),
(32, 'Hotdog Delight (Quickmelt)', 'topped with sliced hotdog and onions completed with a very crispy and thick pizza crust.', 'regular', '169.00', 0, 'Food_1110.png', 38, '2023-05-05 08:46:57', 'No', 0, 0),
(33, 'Bacon Lovers', 'this pizza is loaded with bacon and super crispy pizza crust.', 'regular', '169.00', 98, 'Food_7132.png', 38, '2022-11-22 10:13:52', 'No', 0, 0),
(34, 'All cheese', 'this all-time favorite pizza is packed with mozzarella, parmesan, and cheddar cheese completed by a thin-crispy crust.', 'family', '169.00', 90, 'Food_7077.png', 38, '2022-11-22 10:14:33', 'No', 0, 0),
(35, 'Mushroom & Cheese', 'loaded with the rich flavors of mozzarella, provolone, and parmesan cheese and completed by delicious mushrooms and crispy pizza crust.', 'family', '169.00', 85, 'Food_1266.png', 38, '2023-01-17 21:56:57', 'No', 0, 0),
(36, 'ham and cheese', 'our ham n’ cheese pizza is covered with chopped ham, mozzarella cheese.', 'regular', '169.00', 93, 'Food_8848.png', 38, '2022-11-22 10:26:33', 'No', 0, 0),
(37, 'pepperoni pizza', 'try our one of the best pizza, this pizza is loaded with meat, cheese, and a thin-crispy pizza crust.', 'regular', '169.00', 94, 'Food_83.png', 38, '2022-11-22 10:30:02', 'No', 0, 0),
(38, 'sisig pizza', 'the popular sisig pizza is loaded with pork sisig, onions, and cheese, completed by the crispy pizza crust.', 'family', '169.00', 99, 'Food_116.png', 38, '2023-01-22 13:34:08', 'No', 0, 0),
(39, 'spicy hungarian', '', 'family', '169.00', 99, 'Food_9018.png', 38, '2022-11-22 10:32:45', 'No', 0, 0),
(40, 'beef and mushroom', 'topped with braised beef slices with slices of mushroom and delicious thin-crispy pizza crust.', 'regular', '169.00', 89, 'Food_4778.png', 38, '2022-11-22 10:33:28', 'No', 0, 0),
(41, 'vegetarian', 'this vegetarian pizza is fresh, healthy and full of flavor. Featuring tomatoes, bell peppers, red onions, lettuce, and some (optional) baby spinach with a base of rich tomato sauce and a crispy crust.', 'family', '169.00', 99, 'Food_8821.png', 38, '2022-11-22 10:33:57', 'No', 0, 0),
(42, 'cheesy sausage', 'this very cheesy pizza is loaded with chopped sausage with mozzarella cheese with a crispy crust.', 'regular', '169.00', 100, 'Food_2074.png', 38, '2022-11-22 10:35:06', 'No', 0, 0),
(43, 'bacon specials', 'topped and loaded with super tasty bacon and cheese completed by a crispy pizza crust.', 'regular', '169.00', 99, 'Food_431.png', 38, '2022-11-22 10:35:43', 'No', 0, 0),
(44, 'pizza supreme', 'thick-crust pizza supreme made with pizza dough, cheese, meat toppings, bell peppers and onions.', 'regular', '169.00', 100, 'Food_2608.png', 38, '2022-11-22 10:36:23', 'No', 0, 0),
(46, 'bacon and egg', 'loaded with crispy bacon bits, sliced eggs and mozzarella cheese.', 'family', '169.00', 100, 'Food_4765.png', 38, '2022-11-22 10:42:28', 'No', 0, 0),
(47, 'chicken garlic', 'chicken garlic thin crust pizza topped with chicken hotdog sliced, chicken minced, chopped garlic with quick melt cheese and mozzarella.', 'regular', '169.00', 100, 'Food_2139.png', 38, '2022-11-22 10:46:02', 'No', 0, 0),
(48, 'five meat pizza', 'topped with extra cheese, bacon, sausage, ham and pepperoni and beef.', 'regular', '169.00', 100, 'Food_2872.png', 38, '2022-11-22 10:46:38', 'No', 0, 0),
(49, 'chicken teriyaki', 'coated with teriyaki sauce, minced chicken with mozzarella cheese and onions.', 'regular', '169.00', 99, 'Food_2516.png', 38, '2022-11-22 10:47:53', 'No', 0, 0),
(50, 'sisig with rice', 'this dish is made of pigs parts such as minced pork meat, onions and chili pepper added with a cup of warm rice.', '', '79.00', 0, 'Food_2569.png', 40, '2023-05-05 11:49:54', 'No', 0, 0),
(51, 'tapsilog', 'dish made with beef, garlic fried rice, fried egg and seasonings.', '', '79.00', 84, 'Food_292.png', 40, '2022-11-22 10:58:07', 'No', 0, 0),
(52, 'tosilog', 'dish thats a combo of fried tocino, fried rice and egg on one plate.', '', '79.00', 97, 'Food_7494.png', 40, '2022-11-22 10:58:50', 'No', 0, 0),
(53, 'Cheese (fries)', 'a french fries covered with cheese powder ', 'meduim', '49.00', 97, 'Food_381.png', 39, '2022-11-22 10:59:44', 'No', 0, 0),
(54, 'sour cream (fries)', 'a french fries covered with sour cream powder ', '', '49.00', 94, 'Food_9972.png', 39, '2022-11-22 11:00:32', 'No', 0, 0),
(55, 'plan (fries)', 'a plain deep fried potato and flavorings added ', 'meduim', '49.00', 96, 'Food_642.png', 39, '2022-11-22 11:01:02', 'No', 0, 0),
(56, 'mango shake', 'a plain deep fried potato and flavorings added ', 'meduim', '69.00', 92, 'Food_8125.png', 42, '2023-01-17 22:04:04', 'No', 0, 0),
(57, 'buko shake', 'a plain deep fried potato and flavorings added ', 'meduim', '69.00', 99, 'Food_2447.png', 42, '2022-11-30 16:28:49', 'No', 0, 0),
(58, 'lychee shakes', 'a plain deep fried potato and flavorings added ', 'meduim', '69.00', 93, 'Food_3633.png', 42, '2023-01-12 18:43:43', 'No', 0, 0),
(59, 'italian soda', 'a plain deep fried potato and flavorings added ', 'medium', '69.00', 100, 'Food_4143.png', 38, '2022-11-22 11:03:08', 'No', 0, 0),
(60, 'lemonade', 'a plain deep fried potato and flavorings added ', 'medium', '69.00', 99, 'Food_6123.png', 41, '2023-01-17 19:39:06', 'No', 0, 0),
(61, 'strawberry ', 'a plain deep fried potato and flavorings added ', 'medium', '69.00', 99, 'Food_3195.png', 41, '2022-11-22 11:04:09', 'No', 0, 0),
(62, 'Corn Shake', '', 'meduim', '69.00', 99, 'Food_8547.png', 42, '2022-11-30 16:30:47', 'No', 0, 0),
(63, 'Pineapple Shake', '', 'medium', '69.00', 98, 'Food_1434.png', 42, '2023-01-22 13:37:03', 'No', 0, 0),
(64, 'Apple Shake', '', 'medium', '69.00', 100, 'Food_7173.png', 42, '2023-01-22 13:37:19', 'No', 0, 0),
(65, 'ertse', '', 'erwew', '432.00', 423, '', 38, '2023-05-05 17:58:40', 'Yes', 0, 1),
(66, 'gdfxd', '', 'ere', '34.00', 3242, '', 38, '2023-05-05 17:53:23', 'No', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE IF NOT EXISTS `tbl_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `full_name` varchar(100) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(100) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=46 ;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `full_name`, `user_name`, `password`, `user_type`, `deleted`) VALUES
(36, 'table1', '01', '96a3be3cf272e017046d1b2674a52bd3', 'Kiosk', 0),
(37, 'Sunny', 'Sunny', '03c7c0ace395d80182db07ae2c30f034', 'Cashier', 0),
(38, 'ken', 'ken', '8ce4b16b22b58894aa86c421e8759df3', 'Kitchen Staff', 0),
(39, 'Airene Lacurom', 'Grace', 'b2f5ff47436671b6e533d8dc3614845d', 'Cashier', 0),
(40, 'administrator', 'iCore', '21232f297a57a5a743894a0e4a801fc3', 'administrator', 0),
(41, '02', '02', 'a2ef406e2c2351e0b9e80029c909242d', 'Kiosk', 0),
(42, '03', '03', 'e45ee7ce7e88149af8dd32b27f9512ce', 'Kiosk', 0),
(43, '04', '04', '7d0665438e81d8eceb98c1e31fca80c1', 'Kiosk', 0),
(44, '05', '05', '751d31dd6b56b26b29dac2c0e1839e34', 'Kitchen Staff', 0),
(45, 'table', '06', 'faeac4e1eef307c2ab7b0a3821e6c667', 'Kiosk', 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`food_id`) REFERENCES `tbl_food` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_food`
--
ALTER TABLE `tbl_food`
  ADD CONSTRAINT `tbl_food_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `food_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
