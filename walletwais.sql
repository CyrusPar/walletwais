-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2025 at 04:53 PM
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
-- Database: `walletwais`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bills`
--

CREATE TABLE `tbl_bills` (
  `id` int(11) NOT NULL,
  `user_code` int(11) NOT NULL,
  `bill_name` varchar(255) NOT NULL,
  `expense` int(11) NOT NULL,
  `Date` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_bills`
--

INSERT INTO `tbl_bills` (`id`, `user_code`, `bill_name`, `expense`, `Date`) VALUES
(22, 50178322, 'School project', 0, '2025-01-19'),
(23, 3248682, 'Grocery', 3000, '2025-01-19'),
(24, 3248682, 'Rent', 13000, '2025-01-19'),
(25, 3248682, 'Tuition', 4500, '2025-01-19'),
(26, 3248682, 'Shopping', 200, '2025-01-19'),
(27, 3248682, 'Allowance', 3000, '2025-01-19'),
(28, 3248682, 'Transportation ', 2500, '2025-01-19'),
(29, 69563413, 'shopee', 400, '2025-01-19'),
(30, 8143432, 'Transpo', 700, '2025-01-19'),
(31, 12315613, 'Gatas', 15, '2025-01-19'),
(32, 25667335, 'Food', 300, '2025-01-19'),
(33, 62504237, 'Transportation ', 200, '2025-01-19'),
(34, 52312171, 'Shopping', 2, '2025-01-19'),
(35, 29952001, 'Grocery', 5, '2025-01-19'),
(37, 50400779, 'Food', 400, '2025-01-19'),
(38, 92939238, 'Transportation', 600, '2025-01-19'),
(39, 63168064, 'Shopping', 3, '2025-01-19'),
(41, 18996957, 'Food', 200, '2025-01-19'),
(42, 42512911, 'Transportation', 100, '2025-01-19'),
(43, 24063513, 'Grocery', 7, '2025-01-19'),
(45, 16681599, 'Shopping', 4, '2025-01-19'),
(46, 16451395, 'gadget', 400, '2025-01-19'),
(47, 25984055, 'pagkain', 300, '2025-01-19'),
(48, 93995001, 'Food', 800, '2025-01-19'),
(49, 33386681, 'Dste', 300, '2025-01-19'),
(50, 97498796, 'Transportation', 150, '2025-01-19'),
(51, 77056587, 'junkfood', 20, '2025-01-19'),
(52, 30721708, 'food', 100, '2025-01-19'),
(53, 30721708, 'getaway', 500, '2025-01-19'),
(54, 30721708, 'gala', 200, '2025-01-19'),
(55, 4160559, 'Grocery', 5, '2025-01-19'),
(56, 83246392, 'pagkain', 20, '2025-01-19'),
(57, 83246392, 'chooks to go', 240, '2025-01-19'),
(58, 45641942, 'Shopping', 6, '2025-01-19'),
(59, 83246392, 'sapatos', 4000, '2025-01-19'),
(60, 83246392, 'travels', 5909, '2025-01-19'),
(61, 7237489, 'hiking', 200, '2025-01-19'),
(62, 7237489, 'school', 300, '2025-01-19'),
(63, 7237489, 'capstone', 3000, '2025-01-19'),
(64, 7237489, 'carlito', 0, '2025-01-19'),
(65, 91086140, 'Food', 450, '2025-01-19'),
(66, 80389375, 'ara budget', 20, '2024-01-12'),
(67, 80389375, 'food', 200, '2025-01-19'),
(68, 80389375, 'sush', 23, '2025-01-19'),
(69, 48719749, 'Transportation', 200, '2025-01-19'),
(70, 23749521, 'Grocery', 7, '2025-01-19'),
(71, 8303817, 'smoke weed', 300, '2025-01-19'),
(72, 8303817, 'smoke weed', 300, '2025-01-19'),
(73, 8303817, 'shabu', 100, '2025-01-19'),
(74, 8303817, 'pang tshirt clothing brand', 100, '2025-01-19'),
(75, 76828553, 'Shopping', 9, '2025-01-19'),
(76, 8486444, 'ss', 200, '2025-01-19'),
(77, 8486444, 'hatdog', 400, '2025-01-19'),
(78, 8486444, 'app pogi', 1000, '2025-01-19'),
(79, 86748892, 'transpo', 10, '2025-01-19'),
(80, 86748892, 'food', 0, '2025-01-19'),
(81, 86748892, 'date', 300, '2025-01-19'),
(82, 86748892, 'gala', 423, '2025-01-19'),
(83, 86748892, 'friends', 400, '2025-01-19'),
(84, 11070540, 'food', 120, '2025-01-19'),
(85, 11070540, 'dog food', 409, '2025-01-19'),
(86, 11070540, 'transpo', 200, '2025-01-19'),
(87, 11070540, 'shopping', 133, '2025-01-19'),
(88, 11070540, 'necessity', 559, '2025-01-19'),
(89, 42663577, 'condom', 333, '2025-01-19'),
(90, 42663577, 'food', 609, '2025-01-19'),
(91, 42663577, 'transpo', 100, '2025-01-19'),
(92, 93047648, 'transpo', 300, '2025-01-19'),
(93, 93047648, 'food', 200, '2025-01-19'),
(94, 93047648, 'shoppee', 400, '2025-01-19'),
(95, 93047648, 'tiktok shop', 203, '2025-01-19'),
(96, 93047648, 'date', 2000, '2025-01-19'),
(97, 8143432, 'food', 200, '2025-01-19'),
(98, 48040012, 'Grocery', 2000, '2025-01-19'),
(99, 48040012, 'Salady', 0, '2025-01-19'),
(100, 48040012, 'Www', 0, '2025-01-19'),
(101, 48040012, 'Electricity', 0, '2025-01-19'),
(102, 48040012, 'Watwe', 0, '2025-01-19'),
(103, 48040012, 'Load', 0, '2025-01-19'),
(104, 48040012, 'T', 0, '2025-01-19'),
(105, 48040012, 'Gh', 0, '2025-01-19'),
(106, 60770365, 'zz', 12, '2025-01-19'),
(107, 69563413, 'itlog', 20000, '2025-01-19'),
(108, 69563413, 'spaghetti', 12, '2025-01-19'),
(109, 69563413, 'tinapay', 132, '2025-01-19');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_group_bills`
--

CREATE TABLE `tbl_group_bills` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `user_code` int(11) NOT NULL,
  `bill_name` varchar(255) NOT NULL,
  `expense` int(11) NOT NULL,
  `Date` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_group_bills`
--

INSERT INTO `tbl_group_bills` (`id`, `group_id`, `user_code`, `bill_name`, `expense`, `Date`) VALUES
(25, 19246186, 69695081, 'Internet', 1200, '2025-01-19'),
(26, 85102724, 605495, 'x', 500, '2025-01-19'),
(27, 77370563, 8143432, 'project', 1000, '2025-01-19'),
(29, 32685472, 3248682, 'Tuition', 3000, '2025-01-19'),
(30, 19907831, 69563413, 'gg', 12, '2025-01-19'),
(31, 72094246, 25667335, 'Food', 300, '2025-01-19'),
(32, 82750949, 62504237, 'Transportation', 200, '2025-01-19'),
(33, 50389666, 52312171, 'Shopping', 2, '2025-01-19'),
(34, 40211835, 29952001, 'Grocery', 5, '2025-01-19'),
(35, 53192827, 50400779, 'Food', 400, '2025-01-19'),
(36, 54381390, 92939238, 'Transportation', 600, '2025-01-19'),
(37, 57743469, 63168064, 'Shopping', 3, '2025-01-19'),
(38, 81448442, 28107962, 'Grocery', 6, '2025-01-19'),
(39, 55520315, 18996957, 'Food', 200, '2025-01-19'),
(40, 22733875, 42512911, 'Transportation', 100, '2025-01-19'),
(41, 22598580, 24063513, 'Grocery', 7, '2025-01-19'),
(42, 30380660, 16681599, 'Shopping', 4000, '2025-01-19'),
(43, 56175805, 16451395, 'schoools', 4000, '2025-01-19'),
(44, 74518578, 25984055, 'y8', 200, '2025-01-19'),
(45, 8735337, 25984055, 'proj', 100, '2025-01-19'),
(46, 60230393, 93995001, 'Food', 800, '2025-01-19'),
(47, 17643200, 33386681, 'freiendss', 400, '2025-01-19'),
(48, 65169615, 77056587, 'xx', 200, '2025-01-19'),
(49, 33296792, 97498796, 'Transportation', 150, '2025-01-19'),
(50, 87181038, 80389375, 'my baby', 50000, '2025-01-19'),
(51, 41765058, 8486444, 'bluewave', 30000, '2025-01-19'),
(52, 14159185, 86748892, 'genggeng', 5000, '2025-01-19'),
(53, 18382595, 86748892, 'genggeng', 5000, '2025-01-19'),
(54, 16474263, 86748892, 'genggeng', 5000, '2025-01-19'),
(55, 5187586, 8143432, 'project', 1000, '2025-01-19'),
(56, 61901959, 48040012, 'Project', 1000, '2025-01-19'),
(57, 92559695, 60770365, 'xx', 1000, '2025-01-19'),
(58, 51392595, 42433829, 'gg', 1000, '2025-01-19'),
(59, 95644021, 40997732, 'ee', 1000, '2025-01-19');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_group_members`
--

CREATE TABLE `tbl_group_members` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `user_code` int(11) NOT NULL,
  `bill_name` varchar(255) NOT NULL,
  `percentage` int(11) NOT NULL,
  `contribution` int(11) NOT NULL,
  `is_admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_group_members`
--

INSERT INTO `tbl_group_members` (`id`, `group_id`, `user_code`, `bill_name`, `percentage`, `contribution`, `is_admin`) VALUES
(37, 19246186, 69695081, 'Internet', 0, 200, 1),
(38, 85102724, 605495, 'x', 0, 0, 1),
(39, 85102724, 8143432, 'x', 0, 0, 0),
(40, 77370563, 8143432, 'project', 25, 300, 1),
(41, 77370563, 3248682, 'project', 25, 500, 0),
(42, 77370563, 50178322, 'project', 50, 50, 0),
(46, 32685472, 3248682, 'Tuition', 0, 0, 1),
(47, 32685472, 8143432, 'Tuition', 0, 300, 0),
(48, 32685472, 50178322, 'Tuition', 0, 0, 0),
(49, 19907831, 69563413, 'gg', 0, 0, 1),
(50, 72094246, 25667335, 'Food', 0, 300, 1),
(51, 82750949, 62504237, 'Transportation', 0, 200, 1),
(52, 50389666, 52312171, 'Shopping', 0, 2, 1),
(53, 40211835, 29952001, 'Grocery', 0, 5, 1),
(54, 53192827, 50400779, 'Food', 0, 400, 1),
(55, 54381390, 92939238, 'Transportation', 0, 600, 1),
(56, 57743469, 63168064, 'Shopping', 0, 3, 1),
(57, 81448442, 28107962, 'Grocery', 0, 6, 1),
(58, 55520315, 18996957, 'Food', 0, 200, 1),
(59, 22733875, 42512911, 'Transportation', 0, 100, 1),
(60, 22598580, 24063513, 'Grocery', 0, 7, 1),
(61, 30380660, 16681599, 'Shopping', 0, 4, 1),
(62, 56175805, 16451395, 'schoools', 0, 216, 1),
(63, 74518578, 25984055, 'y8', 0, 100, 1),
(64, 8735337, 25984055, 'proj', 0, 0, 1),
(65, 60230393, 93995001, 'Food', 0, 800, 1),
(66, 17643200, 33386681, 'freiendss', 0, 2000, 1),
(67, 65169615, 77056587, 'xx', 20, 100, 1),
(68, 33296792, 97498796, 'Transportation', 0, 150, 1),
(69, 87181038, 80389375, 'my baby', 0, 200, 1),
(70, 41765058, 8486444, 'bluewave', 0, 10000, 1),
(71, 14159185, 86748892, 'genggeng', 0, 300, 1),
(72, 18382595, 86748892, 'genggeng', 0, 12, 1),
(73, 16474263, 86748892, 'genggeng', 0, 0, 1),
(74, 5187586, 8143432, 'project', 0, 0, 1),
(75, 61901959, 48040012, 'Project', 0, 0, 1),
(76, 92559695, 60770365, 'xx', 70, 0, 1),
(77, 51392595, 42433829, 'gg', 0, 0, 1),
(78, 95644021, 40997732, 'ee', 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_history`
--

CREATE TABLE `tbl_history` (
  `id` int(11) NOT NULL,
  `user_code` int(11) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_history`
--

INSERT INTO `tbl_history` (`id`, `user_code`, `message`) VALUES
(42, 46316854, 'Group Bill named Water Bill has been added.'),
(43, 44048933, 'User Code 44048933 has been invited to bill named Water Bill.'),
(44, 46316854, 'Group Bill named Internet has been added.'),
(45, 44048933, 'User Code 44048933 has been invited to bill named Internet.'),
(46, 44048933, 'User Code 44048933 has been invited to bill named Internet.'),
(47, 44048933, 'User Code 44048933 has been invited to bill named Internet.'),
(48, 44048933, 'User Code 44048933 has been invited to bill named Internet.'),
(49, 44048933, 'You have been invited to bill named Internet.'),
(51, 46316854, 'Bill named Water Bill has been added.'),
(52, 46316854, 'Bill named Water Bill has been paid with the amount of 500.'),
(56, 44048933, 'You have been invited to bill named Internet.'),
(57, 44048933, 'Bill named 32 has been paid with the amount of 100.'),
(58, 46316854, 'Bill named 26 has been paid with the amount of 100.'),
(59, 46316854, 'Bill named 26 has been paid with the amount of 200.'),
(60, 46316854, 'Bill named  has been paid with the amount of 200.'),
(61, 46316854, 'Bill named  has been paid with the amount of 200.'),
(62, 46316854, 'Bill named Internet has been paid with the amount of 100.'),
(63, 46316854, 'Group Bill named  has been paid with the amount of 600.'),
(64, 46316854, 'Group Bill named  has been paid with the amount of 600.'),
(65, 46316854, 'Group Bill named  has been paid with the amount of 200.'),
(66, 46316854, 'Group Bill named Internet has been paid with the amount of 200.'),
(67, 46316854, 'Group Bill named Internet has been paid with the amount of 200.'),
(68, 46316854, 'Group Bill named Internet has been paid with the amount of 100.'),
(69, 46316854, 'Bill named  has been paid with the amount of 100.'),
(70, 46316854, 'Bill named 26 has been paid with the amount of 100.'),
(71, 46316854, 'Bill named  has been paid with the amount of 100.'),
(72, 46316854, 'Bill named  has been paid with the amount of 200.'),
(73, 46316854, 'Bill named  has been paid with the amount of 100.'),
(74, 46316854, 'Bill named  has been paid with the amount of 200.'),
(75, 46316854, 'Bill named Internet has been paid with the amount of 100.'),
(76, 46316854, 'Bill named Water Bill has been paid with the amount of 100.'),
(77, 46316854, 'Group Bill named Internet has been deleted.'),
(78, 46316854, 'Bill named Water Bill has been deleted.'),
(79, 44048933, 'Group Bill named Travel has been added.'),
(80, 46316854, 'Group Bill named Travel has been added.'),
(81, 44048933, 'You have been invited to bill named Travel.'),
(82, 46316854, 'Group Bill named Travel has been deleted.'),
(83, 46316854, 'Bill named Internet has been added.'),
(84, 46316854, 'Bill named Internet has been paid with the amount of 1200.'),
(85, 46316854, 'Bill named Water Bill has been added.'),
(86, 46316854, 'Bill named Water Bill has been paid with the amount of 500.'),
(87, 46316854, 'Group Bill named Travel has been added.'),
(88, 46316854, 'Bill named Travel has been paid with the amount of 1200.'),
(89, 69695081, 'Group Bill named Internet has been added.'),
(90, 605495, 'Group Bill named x has been added.'),
(91, 8143432, 'You have been invited to bill named x.'),
(92, 3248682, 'Bill named Tuition has been added.'),
(93, 3248682, 'Bill named Tuition has been paid with the amount of 4500.'),
(94, 8143432, 'Bill named food has been added.'),
(95, 8143432, 'Group Bill named project has been added.'),
(96, 3248682, 'You have been invited to bill named project.'),
(97, 50178322, 'You have been invited to bill named project.'),
(98, 3248682, 'Bill named  has been paid with the amount of 500.'),
(99, 50178322, 'Bill named  has been paid with the amount of 50.'),
(100, 8143432, 'Bill named project has been paid with the amount of 100.'),
(101, 50178322, 'Group Bill named School projecy has been added.'),
(102, 3248682, 'You have been invited to bill named School projecy.'),
(103, 8143432, 'You have been invited to bill named School projecy.'),
(104, 3248682, 'Group Bill named Tuition has been added.'),
(105, 8143432, 'You have been invited to bill named Tuition.'),
(106, 50178322, 'You have been invited to bill named Tuition.'),
(107, 50178322, 'Bill named School project has been added.'),
(108, 8143432, 'Bill named project has been paid with the amount of 300.'),
(109, 3248682, 'Bill named Tuition has been deleted.'),
(110, 50178322, 'Group Bill named School projecy has been deleted.'),
(111, 3248682, 'Bill named Grocery has been added.'),
(112, 3248682, 'Bill named Rent has been added.'),
(113, 3248682, 'Bill named Tuition has been added.'),
(114, 3248682, 'Bill named Shopping has been added.'),
(115, 3248682, 'Bill named Allowance has been added.'),
(116, 3248682, 'Bill named Transportation  has been added.'),
(117, 3248682, 'Bill has been updated to Grocery.'),
(118, 3248682, 'Bill named Grocery has been paid with the amount of 5000.'),
(119, 3248682, 'Bill named Rent has been paid with the amount of 13000.'),
(120, 3248682, 'Bill named Tuition has been paid with the amount of 4500.'),
(121, 3248682, 'Bill named Shopping has been paid with the amount of 5000.'),
(122, 3248682, 'Bill named Allowance has been paid with the amount of 3000.'),
(123, 3248682, 'Bill named Transportation  has been paid with the amount of 2500.'),
(124, 3248682, 'Bill named Grocery has been paid with the amount of 4500.'),
(125, 69563413, 'Bill named shopee  has been added.'),
(126, 69563413, 'Bill has been updated to shopee.'),
(127, 69563413, 'Bill named shopee has been paid with the amount of 377.'),
(128, 8143432, 'Bill named project has been paid with the amount of 200.'),
(129, 8143432, 'Bill named Transpo has been added.'),
(130, 8143432, 'Bill named Transpo has been paid with the amount of 100.'),
(131, 12315613, 'Bill named Gatas has been added.'),
(132, 12315613, 'Bill named Gatas has been paid with the amount of 15.'),
(133, 3248682, 'Bill named Grocery has been paid with the amount of 3000.'),
(134, 8143432, 'Bill named food has been paid with the amount of 40.'),
(135, 69563413, 'Bill named shopee has been paid with the amount of 1000.'),
(136, 69563413, 'Bill named shopee has been paid with the amount of 5000.'),
(137, 69563413, 'Bill named shopee has been paid with the amount of 100.'),
(138, 69563413, 'Bill named shopee has been paid with the amount of 300.'),
(139, 99105945, 'Bill named None has been paid with the amount of 90.'),
(140, 99105945, 'Bill named  has been paid with the amount of 90.'),
(141, 69563413, 'Group Bill named gg has been added.'),
(142, 25667335, 'Bill named Food has been added.'),
(143, 25667335, 'Group Bill named Food has been added.'),
(144, 25667335, 'Bill named Food has been paid with the amount of 300.'),
(145, 25667335, 'Bill named Food has been paid with the amount of 300.'),
(146, 62504237, 'Bill named Transportation  has been added.'),
(147, 62504237, 'Group Bill named Transportation has been added.'),
(148, 62504237, 'Bill named Transportation  has been paid with the amount of 200.'),
(149, 62504237, 'Bill named Transportation has been paid with the amount of 200.'),
(150, 52312171, 'Bill named Shopping has been added.'),
(151, 52312171, 'Group Bill named Shopping has been added.'),
(152, 52312171, 'Bill named Shopping has been paid with the amount of 2,000.'),
(153, 52312171, 'Bill named Shopping has been paid with the amount of 2,000.'),
(154, 29952001, 'Bill named Grocery has been added.'),
(155, 29952001, 'Group Bill named Grocery has been added.'),
(156, 29952001, 'Bill named Grocery has been paid with the amount of 5,000.'),
(157, 29952001, 'Bill named Grocery has been paid with the amount of 5,000.'),
(158, 50400779, 'Bill named Food has been added.'),
(159, 50400779, 'Group Bill named Food has been added.'),
(160, 50400779, 'Bill named Food has been deleted.'),
(161, 50400779, 'Bill named Food has been added.'),
(162, 50400779, 'Bill named Food has been paid with the amount of 400.'),
(163, 50400779, 'Bill named Food has been paid with the amount of 400.'),
(164, 92939238, 'Bill named Transportation has been added.'),
(165, 92939238, 'Group Bill named Transportation has been added.'),
(166, 92939238, 'Bill named Transportation has been paid with the amount of 600.'),
(167, 92939238, 'Bill named Transportation has been paid with the amount of 600.'),
(168, 63168064, 'Bill named Shopping has been added.'),
(169, 63168064, 'Group Bill named Shopping has been added.'),
(170, 63168064, 'Bill named Shopping has been paid with the amount of 3,000.'),
(171, 63168064, 'Bill named Shopping has been paid with the amount of 3,000 .'),
(172, 28107962, 'Group Bill named Grocery has been added.'),
(173, 28107962, 'Bill named Grocery has been added.'),
(174, 28107962, 'Bill named Grocery has been paid with the amount of 6,000.'),
(175, 28107962, 'Bill named Grocery has been paid with the amount of 6,000.'),
(176, 18996957, 'Bill named Food has been added.'),
(177, 18996957, 'Group Bill named Food has been added.'),
(178, 18996957, 'Bill named Food has been paid with the amount of 200.'),
(179, 18996957, 'Bill named Food has been paid with the amount of 200.'),
(180, 42512911, 'Bill named Transportation has been added.'),
(181, 42512911, 'Group Bill named Transportation has been added.'),
(182, 42512911, 'Bill named Transportation has been paid with the amount of 100.'),
(183, 42512911, 'Bill named Transportation has been paid with the amount of 100.'),
(184, 24063513, 'Bill named Grocery has been added.'),
(185, 24063513, 'Bill named 7,000 has been added.'),
(186, 24063513, 'Group Bill named Grocery has been added.'),
(187, 24063513, 'Bill named 7,000 has been deleted.'),
(188, 24063513, 'Bill named Grocery has been paid with the amount of 7,000.'),
(189, 24063513, 'Bill named Grocery has been paid with the amount of 7,000.'),
(190, 16681599, 'Bill named Shopping has been added.'),
(191, 16681599, 'Group Bill named Shopping has been added.'),
(192, 16681599, 'Bill named Shopping has been paid with the amount of 4,000.'),
(193, 16681599, 'Bill named Shopping has been paid with the amount of 4,000.'),
(194, 16451395, 'Group Bill named schoools has been added.'),
(195, 16451395, 'Bill named gadget has been added.'),
(196, 16451395, 'Bill named gadget has been paid with the amount of 400.'),
(197, 16451395, 'Bill named schoools has been paid with the amount of 216.'),
(198, 25984055, 'Group Bill named y8 has been added.'),
(199, 25984055, 'Bill named pagkain has been added.'),
(200, 25984055, 'Bill named pagkain has been paid with the amount of 300.'),
(201, 25984055, 'Bill named y8 has been paid with the amount of 10009.'),
(202, 25984055, 'Bill named y8 has been paid with the amount of 200.'),
(203, 25984055, 'Bill named y8 has been paid with the amount of 100.'),
(204, 25984055, 'Group Bill named proj has been added.'),
(205, 93995001, 'Bill named Food has been added.'),
(206, 93995001, 'Group Bill named Food has been added.'),
(207, 93995001, 'Bill named Food has been paid with the amount of 800.'),
(208, 93995001, 'Bill named Food has been paid with the amount of 800.'),
(209, 33386681, 'Group Bill named freiendss has been added.'),
(210, 33386681, 'Bill named Dste has been added.'),
(211, 33386681, 'Bill named Dste has been paid with the amount of 300.'),
(212, 33386681, 'Bill named freiendss has been paid with the amount of 2000.'),
(213, 97498796, 'Bill named Transportation has been added.'),
(214, 77056587, 'Group Bill named xx has been added.'),
(215, 77056587, 'Bill named junkfood has been added.'),
(216, 77056587, 'Bill named junkfood has been paid with the amount of 20.'),
(217, 77056587, 'Bill named xx has been paid with the amount of 100.'),
(218, 97498796, 'Group Bill named Transportation has been added.'),
(219, 97498796, 'Bill named Transportation has been paid with the amount of 150.'),
(220, 97498796, 'Bill named Transportation has been paid with the amount of 150.'),
(221, 30721708, 'Bill named food has been added.'),
(222, 30721708, 'Bill named getaway has been added.'),
(223, 30721708, 'Bill named gala has been added.'),
(224, 30721708, 'Bill named food has been paid with the amount of 30.'),
(225, 30721708, 'Bill named food has been paid with the amount of 40.'),
(226, 30721708, 'Bill named food has been paid with the amount of 100.'),
(227, 30721708, 'Bill named getaway has been paid with the amount of 300.'),
(228, 30721708, 'Bill named getaway has been paid with the amount of 500.'),
(229, 30721708, 'Bill named gala has been paid with the amount of 1000.'),
(230, 30721708, 'Bill named gala has been paid with the amount of 200.'),
(231, 4160559, 'Bill named Grocery has been added.'),
(232, 4160559, 'Bill named Grocery has been paid with the amount of 5,000.'),
(233, 83246392, 'Bill named pagkain has been added.'),
(234, 83246392, 'Bill named chooks to go has been added.'),
(235, 45641942, 'Bill named Shopping has been added.'),
(236, 83246392, 'Bill named sapatos has been added.'),
(237, 83246392, 'Bill named travels has been added.'),
(238, 83246392, 'Bill named pagkain has been paid with the amount of 20.'),
(239, 45641942, 'Bill named Shopping has been paid with the amount of 6,500.'),
(240, 83246392, 'Bill named chooks to go has been paid with the amount of 240.'),
(241, 83246392, 'Bill named sapatos has been paid with the amount of 4000.'),
(242, 83246392, 'Bill named travels has been paid with the amount of 5909.'),
(243, 7237489, 'Bill named hiking has been added.'),
(244, 7237489, 'Bill named school has been added.'),
(245, 7237489, 'Bill named capstone has been added.'),
(246, 7237489, 'Bill named carlito has been added.'),
(247, 91086140, 'Bill named Food has been added.'),
(248, 7237489, 'Bill named hiking has been paid with the amount of 200.'),
(249, 7237489, 'Bill named school has been paid with the amount of 300.'),
(250, 91086140, 'Bill named Food has been paid with the amount of 450.'),
(251, 7237489, 'Bill named capstone has been paid with the amount of 3000.'),
(252, 80389375, 'Bill named ara budget has been added.'),
(253, 80389375, 'Bill named food has been added.'),
(254, 80389375, 'Bill named sush has been added.'),
(255, 80389375, 'Group Bill named my baby has been added.'),
(256, 80389375, 'Bill named my baby has been paid with the amount of 300.'),
(257, 80389375, 'Bill named my baby has been paid with the amount of 200.'),
(258, 80389375, 'Bill named my baby has been paid with the amount of 300.'),
(259, 80389375, 'Bill named my baby has been paid with the amount of 300.'),
(260, 80389375, 'Bill named my baby has been paid with the amount of 100.'),
(261, 80389375, 'Bill named my baby has been paid with the amount of 200.'),
(262, 80389375, 'Bill named ara budget has been paid with the amount of 20.'),
(263, 80389375, 'Bill named food has been paid with the amount of 200.'),
(264, 80389375, 'Bill named sush has been paid with the amount of 100.'),
(265, 80389375, 'Bill named sush has been paid with the amount of 23.'),
(266, 48719749, 'Bill named Transportation has been added.'),
(267, 48719749, 'Bill named Transportation has been paid with the amount of 200.'),
(268, 23749521, 'Bill named Grocery has been added.'),
(269, 23749521, 'Bill named Grocery has been paid with the amount of 7,500.'),
(270, 8303817, 'Bill named smoke weed has been added.'),
(271, 8303817, 'Bill named smoke weed has been added.'),
(272, 8303817, 'Bill named shabu has been added.'),
(273, 8303817, 'Bill named pang tshirt clothing brand has been added.'),
(274, 8303817, 'Bill named pang tshirt clothing brand has been paid with the amount of 200.'),
(275, 8303817, 'Bill named pang tshirt clothing brand has been paid with the amount of 100.'),
(276, 76828553, 'Bill named Shopping has been added.'),
(277, 8303817, 'Bill named smoke weed has been paid with the amount of 20.'),
(278, 8303817, 'Bill named smoke weed has been paid with the amount of 300.'),
(279, 8303817, 'Bill named shabu has been paid with the amount of 100.'),
(280, 76828553, 'Bill named Shopping has been paid with the amount of 9,000.'),
(281, 8303817, 'Bill named smoke weed has been paid with the amount of 300.'),
(282, 8303817, 'Bill named pang tshirt clothing brand has been paid with the amount of 100.'),
(283, 8486444, 'Bill named ss has been added.'),
(284, 8486444, 'Group Bill named bluewave has been added.'),
(285, 8486444, 'Bill named hatdog has been added.'),
(286, 8486444, 'Bill named app pogi has been added.'),
(287, 8486444, 'Bill named ss has been paid with the amount of 200.'),
(288, 8486444, 'Bill named hatdog has been paid with the amount of 400.'),
(289, 8486444, 'Bill named app pogi has been paid with the amount of 1000.'),
(290, 8486444, 'Bill named bluewave has been paid with the amount of 200.'),
(291, 8486444, 'Bill named bluewave has been paid with the amount of 10000.'),
(292, 86748892, 'Group Bill named genggeng has been added.'),
(293, 86748892, 'Group Bill named genggeng has been added.'),
(294, 86748892, 'Group Bill named genggeng has been added.'),
(295, 86748892, 'Bill named transpo has been added.'),
(296, 86748892, 'Bill named food has been added.'),
(297, 86748892, 'Bill named date has been added.'),
(298, 86748892, 'Bill named gala has been added.'),
(299, 86748892, 'Bill named friends has been added.'),
(300, 86748892, 'Bill named transpo has been paid with the amount of 20.'),
(301, 86748892, 'Bill named transpo has been paid with the amount of 30.'),
(302, 86748892, 'Bill named transpo has been paid with the amount of 40.'),
(303, 86748892, 'Bill named transpo has been paid with the amount of 10.'),
(304, 86748892, 'Bill named genggeng has been paid with the amount of 300.'),
(305, 86748892, 'Bill named genggeng has been paid with the amount of 4999.'),
(306, 86748892, 'Bill named genggeng has been paid with the amount of 12.'),
(307, 86748892, 'Bill named date has been paid with the amount of 300.'),
(308, 86748892, 'Bill named gala has been paid with the amount of 423.'),
(309, 86748892, 'Bill named friends has been paid with the amount of qwe.'),
(310, 86748892, 'Bill named friends has been paid with the amount of 400.'),
(311, 11070540, 'Bill named food has been added.'),
(312, 11070540, 'Bill named dog food has been added.'),
(313, 11070540, 'Bill named transpo has been added.'),
(314, 11070540, 'Bill named shopping has been added.'),
(315, 11070540, 'Bill named necessity has been added.'),
(316, 11070540, 'Bill named food has been paid with the amount of 20.'),
(317, 11070540, 'Bill named food has been paid with the amount of 40.'),
(318, 11070540, 'Bill named food has been paid with the amount of 120.'),
(319, 11070540, 'Bill named dog food has been paid with the amount of 409.'),
(320, 11070540, 'Bill named transpo has been paid with the amount of 200.'),
(321, 11070540, 'Bill named shopping has been paid with the amount of 1200.'),
(322, 11070540, 'Bill named shopping has been paid with the amount of 133.'),
(323, 11070540, 'Bill named necessity has been paid with the amount of 324.'),
(324, 11070540, 'Bill named necessity has been paid with the amount of 559.'),
(325, 42663577, 'Bill named condom has been added.'),
(326, 42663577, 'Bill named food has been added.'),
(327, 42663577, 'Bill named transpo has been added.'),
(328, 42663577, 'Bill named condom has been paid with the amount of 333.'),
(329, 42663577, 'Bill named food has been paid with the amount of 120.'),
(330, 42663577, 'Bill named food has been paid with the amount of 609.'),
(331, 42663577, 'Bill named transpo has been paid with the amount of 100.'),
(332, 93047648, 'Bill named transpo has been added.'),
(333, 93047648, 'Bill named food has been added.'),
(334, 93047648, 'Bill named shoppee has been added.'),
(335, 93047648, 'Bill named tiktok shop has been added.'),
(336, 93047648, 'Bill named date has been added.'),
(337, 93047648, 'Bill named transpo has been paid with the amount of 300.'),
(338, 93047648, 'Bill named food has been paid with the amount of 200.'),
(339, 93047648, 'Bill named shoppee has been paid with the amount of 400.'),
(340, 93047648, 'Bill named tiktok shop has been paid with the amount of 203.'),
(341, 93047648, 'Bill named date has been paid with the amount of 2000.'),
(342, 69563413, 'Bill named shopee has been paid with the amount of 500.'),
(343, 69563413, 'Bill named shopee has been paid with the amount of 200.'),
(344, 69563413, 'Bill named shopee has been paid with the amount of 400.'),
(345, 69563413, 'Bill named shopee has been paid with the amount of 100.'),
(346, 3248682, 'Bill named Shopping has been paid with the amount of 200.'),
(347, 3248682, 'Bill has been updated to Rent.'),
(348, 8143432, 'Bill named food has been paid with the amount of 200.'),
(349, 8143432, 'Bill named food has been paid with the amount of 2200.'),
(350, 8143432, 'Bill named food has been paid with the amount of 200.'),
(351, 8143432, 'Bill named food has been added.'),
(352, 8143432, 'Bill named food has been paid with the amount of 209.'),
(353, 8143432, 'Bill has been updated to food.'),
(354, 8143432, 'Bill has been updated to Transpo.'),
(355, 8143432, 'Group Bill named project has been added.'),
(356, 8143432, 'Bill named project has been paid with the amount of 300.'),
(357, 28107962, 'Bill named Grocery has been deleted.'),
(358, 8143432, 'Bill named food has been paid with the amount of 500.'),
(359, 8143432, 'Bill named food has been paid with the amount of 100.'),
(360, 48040012, 'Bill named Grocery has been added.'),
(361, 48040012, 'Bill named Grocery has been paid with the amount of 2000.'),
(362, 48040012, 'Group Bill named Project has been added.'),
(363, 48040012, 'Bill named Salady has been added.'),
(364, 48040012, 'Bill named Www has been added.'),
(365, 48040012, 'Bill named Electricity has been added.'),
(366, 48040012, 'Bill named Watwe has been added.'),
(367, 48040012, 'Bill named Load has been added.'),
(368, 48040012, 'Bill named T has been added.'),
(369, 48040012, 'Bill named Gh has been added.'),
(370, 48040012, 'Bill has been updated to Electricity.'),
(371, 8143432, 'Bill named food has been deleted.'),
(372, 8143432, 'Bill named food has been paid with the amount of 100.'),
(373, 8143432, 'Bill named food has been paid with the amount of 200.'),
(374, 69695081, 'Bill named Internet has been paid with the amount of 100.'),
(375, 69695081, 'Bill named Internet has been paid with the amount of 100.'),
(376, 69695081, 'Bill named Internet has been paid with the amount of 100.'),
(377, 8143432, 'Bill named Transpo has been paid with the amount of 200.'),
(378, 8143432, 'Bill named Transpo has been paid with the amount of 200.'),
(379, 60770365, 'Group Bill named xx has been added.'),
(380, 60770365, 'Bill named zz has been added.'),
(381, 60770365, 'Bill named zz has been paid with the amount of 12.'),
(382, 69563413, 'Bill named shopee has been paid with the amount of 300.'),
(383, 8143432, 'Bill named Transpo has been paid with the amount of 200.'),
(384, 42433829, 'Group Bill named gg has been added.'),
(385, 40997732, 'Group Bill named ee has been added.'),
(386, 69563413, 'Bill named itlog has been added.'),
(387, 69563413, 'Bill named itlog has been paid with the amount of 20000.'),
(388, 69563413, 'Bill named spaghetti has been added.'),
(389, 69563413, 'Bill named spaghetti has been paid with the amount of 12.'),
(390, 69563413, 'Bill named tinapay has been added.'),
(391, 69563413, 'Bill named tinapay has been paid with the amount of 132.');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `user_code` int(11) NOT NULL,
  `wallet` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `user_code`, `wallet`, `email`, `password`) VALUES
(5, 69695081, 0, 'adrianpolpeligrino27@gmail.com', '76d80224611fc919a5d54f0ff9fba446'),
(6, 605495, 0, 'aestheticpinas@gmail.com', 'd7fe6cf556e3013a0a138b633718c6ad'),
(7, 8143432, 0, 'xx@gmail.com', 'd7fe6cf556e3013a0a138b633718c6ad'),
(8, 3248682, 0, 'aaxsaez@gmail.com', '533fbf8b89e7a42bc6350c9b4fd2ebeb'),
(9, 50178322, 0, 'edwinmalit1215@gmail.com', '2ecf0ca4005fdf8718cbb380320aaaf2'),
(10, 5882712, 0, '8213098@ntc.edu.ph', '686c06b3dd4bbae2f83ed1656b6b7022'),
(11, 69563413, 0, 'achakyeon@gmail.com', '01f0b0e0115c166c4f081bbdc1b7be07'),
(12, 12315613, 0, '8211879@ntc.edu.ph', 'a0e5d9118fa6efb0527b70cd785e5fd6'),
(13, 13849287, 0, 'jkdnfr072@gmail.com', 'fa9e3a3eddb279cd721da529f34a1fe1'),
(14, 99105945, 0, 'decmrtn27@gmail.com', '406e2d852dc1d293a232467d776a1e72'),
(15, 9991999, 0, 'jhanielleara09@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b'),
(16, 25667335, 0, '61902777@ntc.edu.ph', '25f9e794323b453885f5181f1b624d0b'),
(17, 62504237, 0, '8213858@ntc.edu.ph', '25f9e794323b453885f5181f1b624d0b'),
(18, 52312171, 0, '8210934@ntc.edu.ph', '25f9e794323b453885f5181f1b624d0b'),
(19, 29952001, 0, '424001522@ntc.edu.ph', '25f9e794323b453885f5181f1b624d0b'),
(20, 50400779, 0, '8215518@ntc.edu.ph', '25f9e794323b453885f5181f1b624d0b'),
(21, 92939238, 0, '8202464@ntc.edu.ph', '25f9e794323b453885f5181f1b624d0b'),
(22, 63168064, 0, '8215219@ntc.edu.ph', '25f9e794323b453885f5181f1b624d0b'),
(23, 28107962, 0, '8215079@ntc.edu.ph', '25f9e794323b453885f5181f1b624d0b'),
(24, 18996957, 0, '8211907@ntc.edu.ph', '25f9e794323b453885f5181f1b624d0b'),
(25, 42512911, 0, '8211098@ntc.edu.ph', '25f9e794323b453885f5181f1b624d0b'),
(26, 24063513, 0, '424001880@ntc.edu.ph', '25f9e794323b453885f5181f1b624d0b'),
(27, 16451395, 0, '8202161@ntc.edu.ph', '827ccb0eea8a706c4c34a16891f84e7b'),
(28, 25984055, 0, '8213702@ntc.edu.ph', '827ccb0eea8a706c4c34a16891f84e7b'),
(29, 33386681, 0, '8202636@ntc.edu.ph', '827ccb0eea8a706c4c34a16891f84e7b'),
(30, 16681599, 0, '8214481@ntc.edu.ph', '25f9e794323b453885f5181f1b624d0b'),
(31, 77056587, 0, '8213095@ntc.edu.ph', '827ccb0eea8a706c4c34a16891f84e7b'),
(32, 30721708, 0, '8215176@ntc.edu.ph', '827ccb0eea8a706c4c34a16891f84e7b'),
(33, 93743775, 0, '8215107@ntc.edu.ph', '827ccb0eea8a706c4c34a16891f84e7b'),
(34, 83246392, 0, '8211808@ntc.edu.ph', '827ccb0eea8a706c4c34a16891f84e7b'),
(35, 7237489, 0, '8203613@ntc.edu.ph', '827ccb0eea8a706c4c34a16891f84e7b'),
(36, 80389375, 0, '8211051@ntc.edu.ph', '827ccb0eea8a706c4c34a16891f84e7b'),
(37, 93995001, 0, '422001688@ntc.edu.ph', '25f9e794323b453885f5181f1b624d0b'),
(38, 97498796, 0, '8214735@ntc.edu.ph', '25f9e794323b453885f5181f1b624d0b'),
(39, 4160559, 0, '8214736@ntc.edu.ph', '25f9e794323b453885f5181f1b624d0b'),
(40, 45641942, 0, '8212752@ntc.edu.ph', '25f9e794323b453885f5181f1b624d0b'),
(41, 91086140, 0, '8210883@ntc.edu.ph', '25f9e794323b453885f5181f1b624d0b'),
(42, 48719749, 0, '8214500@ntc.edu.ph', '25f9e794323b453885f5181f1b624d0b'),
(43, 8303817, 0, '8211049@ntc.edu.ph', '827ccb0eea8a706c4c34a16891f84e7b'),
(44, 8486444, 0, '8215420@ntc.edu.ph', '827ccb0eea8a706c4c34a16891f84e7b'),
(45, 86748892, 0, '8213940@ntc.edu.ph', '827ccb0eea8a706c4c34a16891f84e7b'),
(46, 11070540, 0, '8211227@ntc.edu.ph', '827ccb0eea8a706c4c34a16891f84e7b'),
(47, 42663577, 0, '8216024@ntc.edu.ph', '827ccb0eea8a706c4c34a16891f84e7b'),
(48, 23749521, 0, '8214136@ntc.edu.ph', '25f9e794323b453885f5181f1b624d0b'),
(49, 93047648, 0, '8214046@ntc.edu.ph', '827ccb0eea8a706c4c34a16891f84e7b'),
(50, 76828553, 0, '8213709@ntc.edu.ph', '25f9e794323b453885f5181f1b624d0b'),
(51, 48040012, 0, '8211052@ntc.edu.ph', '2ecf0ca4005fdf8718cbb380320aaaf2'),
(52, 60770365, 0, 'ss@gmail.com', 'f561aaf6ef0bf14d4208bb46a4ccb3ad'),
(53, 42433829, 0, '123@gmail.com', '202cb962ac59075b964b07152d234b70'),
(54, 40997732, 0, '23@gmail.com', '202cb962ac59075b964b07152d234b70'),
(55, 40716012, 0, 'cyrus@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_bills`
--
ALTER TABLE `tbl_bills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_group_bills`
--
ALTER TABLE `tbl_group_bills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_group_members`
--
ALTER TABLE `tbl_group_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_history`
--
ALTER TABLE `tbl_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_bills`
--
ALTER TABLE `tbl_bills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `tbl_group_bills`
--
ALTER TABLE `tbl_group_bills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `tbl_group_members`
--
ALTER TABLE `tbl_group_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `tbl_history`
--
ALTER TABLE `tbl_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=392;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
