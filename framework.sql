-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2024 at 08:51 AM
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
-- Database: `framework`
--

-- --------------------------------------------------------

--
-- Table structure for table `jad`
--

CREATE TABLE `jad` (
  `id` int(11) NOT NULL,
  `type` varchar(32) NOT NULL,
  `name` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `jad`
--

INSERT INTO `jad` (`id`, `type`, `name`) VALUES
(1, 'Visions', '75'),
(2, 'Visions', '75'),
(3, 'Visions', '75'),
(4, 'Logo', '100'),
(5, 'Visions', '75');

-- --------------------------------------------------------

--
-- Table structure for table `missions`
--

CREATE TABLE `missions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 0,
  `complete_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `missions`
--

INSERT INTO `missions` (`id`, `user_id`, `plan_id`, `created_at`, `status`, `complete_date`) VALUES
(1, 2, 1, '2024-01-20 06:43:09', 1, '2024-03-04 06:10:47'),
(2, 2, 1, '2024-01-20 06:43:38', 1, '2024-01-22 13:59:37'),
(3, 1, 1, '2024-01-20 15:54:36', 1, '2024-01-22 13:59:37'),
(4, 1, 1, '2024-01-20 15:58:11', 1, '2024-01-22 13:59:37'),
(5, 1, 1, '2024-01-21 00:58:00', 1, '2024-01-24 01:18:59'),
(6, 1, 1, '2024-01-22 13:57:44', 1, '2024-01-28 13:54:34'),
(7, 1, 1, '2024-01-22 13:59:37', 1, '2024-01-22 13:59:37'),
(8, 2, 5, '2024-01-23 21:45:34', 1, '2024-01-23 21:45:34'),
(9, 2, 5, '2024-01-23 21:45:54', 1, '2024-01-23 21:45:54'),
(10, 2, 5, '2024-01-24 01:18:59', 1, '2024-01-24 01:18:59'),
(11, 2, 6, '2024-01-28 13:54:21', 1, '2024-01-28 13:54:21'),
(12, 2, 6, '2024-01-28 13:54:34', 1, '2024-01-28 13:54:34'),
(13, 1, 1, '2024-02-02 07:00:41', 1, '2024-02-02 07:00:41'),
(14, 1, 1, '2024-02-02 07:01:00', 1, '2024-02-02 07:01:00'),
(15, 1, 1, '2024-02-06 11:45:18', 1, '2024-02-06 11:45:18'),
(16, 1, 1, '2024-02-07 18:41:07', 1, '2024-02-07 18:41:07'),
(17, 1, 1, '2024-02-19 12:36:46', 1, '2024-02-19 12:36:46'),
(18, 1, 1, '2024-03-04 06:10:14', 1, '2024-03-04 06:10:14'),
(19, 1, 1, '2024-03-04 06:10:47', 1, '2024-03-04 06:10:47');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `title` varchar(32) NOT NULL,
  `body` text DEFAULT NULL,
  `link` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `read` int(11) DEFAULT NULL,
  `seen` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `title`, `body`, `link`, `created_at`, `read`, `seen`) VALUES
(1, 2, 'Deposit', 'You have Deposited <b>200</b> USDTs successfully', NULL, '2024-01-20 07:31:13', NULL, 1),
(2, 2, 'Deposit', 'You have Deposited <b>200</b> USDTs successfully', NULL, '2024-01-20 07:32:51', NULL, 1),
(3, 1, 'Deposit', 'You have Deposited <b>200</b> USDTs successfully', NULL, '2024-01-20 07:33:19', NULL, 1),
(4, 1, 'Deposit', 'You have Deposited <b>200</b> USDTs successfully', NULL, '2024-01-20 07:34:30', NULL, 1),
(5, 1, 'Deposit', 'You have Deposited <b>200</b> USDTs successfully', NULL, '2024-01-20 07:34:52', NULL, 1),
(6, 1, 'Deposit', 'You have Deposited <b>200</b> USDTs successfully', NULL, '2024-01-20 07:35:12', NULL, 1),
(7, 1, 'Deposit', 'You have Deposited <b>200</b> USDTs successfully', NULL, '2024-01-20 07:37:23', NULL, 1),
(8, 1, 'Deposit', 'You have Deposited <b>200</b> USDTs successfully', NULL, '2024-01-20 07:37:44', NULL, 1),
(9, 2, 'Deposit', 'You have Deposited <b>400</b> USDTs successfully', NULL, '2024-01-20 07:38:17', NULL, 1),
(10, 2, 'Deposit', 'You have Deposited <b>200</b> USDTs successfully', NULL, '2024-01-20 07:49:45', NULL, 1),
(11, 2, 'Deposit', 'You have Deposited <b>200</b> USDTs successfully', NULL, '2024-01-20 07:51:40', NULL, 1),
(12, 2, 'Deposit', 'You have Deposited <b>100</b> USDTs successfully', NULL, '2024-01-20 07:55:37', NULL, 1),
(13, 2, 'Deposit', 'You have Deposited <b>50</b> USDTs successfully', NULL, '2024-01-20 08:00:50', NULL, 1),
(14, 2, 'Package Subscribtion', '<b> LEVEL-01</b> Package has been unlocked successfully   ', NULL, '2024-01-20 08:42:51', NULL, 1),
(15, 2, 'Earning', '<b>20.35</b> USDT has been added to Your Account', NULL, '2024-01-20 08:43:09', NULL, 1),
(16, 2, 'Earning', '<b>20.35</b> USDT has been added to Your Account', NULL, '2024-01-20 08:43:38', NULL, 1),
(17, 2, 'Deposit', 'You have Deposited <b>250</b> USDTs successfully', NULL, '2024-01-20 08:45:57', NULL, 1),
(18, 2, 'Deposit', 'You have Deposited <b>50</b> USDTs successfully', NULL, '2024-01-20 12:32:50', NULL, 1),
(19, 2, 'Deposit', 'You have Deposited <b>2500</b> USDTs successfully', NULL, '2024-01-20 12:33:14', NULL, 1),
(20, 1, 'Withdraw', 'You have Withdrawed <b>68.75</b> USDTs successfully  sent to TZuaeKRrnJdU8Yi5t66x1UcuSJkLTsqrFX', NULL, '2024-01-20 12:56:51', NULL, 1),
(21, 1, 'Deposit', 'You have Deposited <b>200</b> USDTs successfully', NULL, '2024-01-20 16:48:02', NULL, 1),
(22, 1, 'Package Subscribtion', '<b> LEVEL-01</b> Package has been unlocked successfully   ', NULL, '2024-01-20 16:48:08', NULL, 1),
(23, 1, 'Withdraw', 'You have Withdrawed <b>109</b> USDT successfully  sent to TZuaeKRrnJdU8Yi5t66x1UcuSJkLTsqrFX', NULL, '2024-01-20 17:53:34', NULL, 1),
(24, 1, 'Earning', '<b>20.35</b> USDT has been added to Your Account', NULL, '2024-01-20 17:54:36', NULL, 1),
(25, 1, 'Withdraw', 'You have Withdrawed <b>19.35</b> USDT successfully  sent to TZuaeKRrnJdU8Yi5t66x1UcuSJkLTsqrFX', NULL, '2024-01-20 17:55:31', NULL, 1),
(26, 1, 'Earning', '<b>20.35</b> USDT has been added to Your Account', NULL, '2024-01-20 17:58:11', NULL, 1),
(27, 1, 'Earning', '<b>20.35</b> USDT has been added to Your Account', NULL, '2024-01-21 02:58:00', 1, 1),
(28, 1, 'Earning', '<b>20.35</b> USDT has been added to Your Account', NULL, '2024-01-22 15:57:44', NULL, 1),
(29, 1, 'Withdraw', 'You have Withdrawed <b>51.05</b> USDT successfully  sent to TZuaeKRrnJdU8Yi5t66x1UcuSJkLTsqrFX', NULL, '2024-01-22 15:59:11', NULL, 1),
(30, 1, 'Earning', '<b>20.35</b> USDT has been added to Your Account', NULL, '2024-01-22 15:59:37', NULL, 1),
(31, 1, 'Withdraw', 'You have Withdrawed <b>25.35</b> USDT successfully  sent to TZuaeKRrnJdU8Yi5t66x1UcuSJkLTsqrFX', NULL, '2024-01-22 15:59:54', NULL, 1),
(32, 2, 'Package Subscribtion', '<b> LEVEL-02</b> Package has been unlocked successfully   ', NULL, '2024-01-23 23:41:32', NULL, 1),
(33, 2, 'Deposit', 'You have Deposited <b>700</b> USDT successfully', NULL, '2024-01-23 23:44:43', NULL, 1),
(34, 2, 'Package Subscribtion', '<b> LEVEL-05</b> Package has been unlocked successfully   ', NULL, '2024-01-23 23:45:07', NULL, 1),
(35, 2, 'Earning', '<b>201</b> USDT has been added to Your Account', NULL, '2024-01-23 23:45:34', NULL, 1),
(36, 2, 'Earning', '<b>201</b> USDT has been added to Your Account', NULL, '2024-01-23 23:45:54', NULL, 1),
(37, 2, 'Withdraw', 'You have Withdrawed <b>256</b> USDT successfully  sent to TZuaeKRrnJdU8Yi5t66x1UcuSJkLTsqrFX', NULL, '2024-01-23 23:46:45', NULL, 1),
(38, 2, 'Withdraw', 'You have Withdrawed <b>186.7</b> USDT successfully  sent to TZuaeKRrnJdU8Yi5t66x1UcuSJkLTsqrFX', NULL, '2024-01-23 23:48:55', NULL, 1),
(39, 2, 'Earning', '<b>201</b> USDT has been added to Your Account', NULL, '2024-01-24 03:18:59', NULL, 1),
(40, 2, 'Withdraw', 'You have Withdrawed <b>201</b> USDT successfully  sent to TZuaeKRrnJdU8Yi5t66x1UcuSJkLTsqrFX', NULL, '2024-01-24 03:19:11', NULL, 1),
(41, 2, 'Deposit', 'You have Deposited <b>230</b> USDT successfully', NULL, '2024-01-24 03:20:50', NULL, 1),
(42, 2, 'Deposit', 'You have Deposited <b>430</b> USDT successfully', NULL, '2024-01-24 03:21:24', NULL, 1),
(43, 2, 'Deposit', 'You have Deposited <b>2500</b> USDT successfully', NULL, '2024-01-24 03:22:20', NULL, 1),
(44, 2, 'Deposit', 'You have Deposited <b>7790</b> USDT successfully', NULL, '2024-01-24 03:23:36', NULL, 1),
(45, 2, 'Package Subscribtion', '<b> LEVEL-06</b> Package has been unlocked successfully   ', NULL, '2024-01-24 03:23:38', NULL, 1),
(46, 2, 'Deposit', 'You have Deposited <b>1000</b> USDT successfully', NULL, '2024-01-24 03:24:28', NULL, 1),
(47, 2, 'Earning', '<b>420</b> USDT has been added to Your Account', NULL, '2024-01-28 15:54:21', NULL, 0),
(48, 2, 'Earning', '<b>420</b> USDT has been added to Your Account', NULL, '2024-01-28 15:54:34', NULL, 0),
(49, 1, 'Earning', '<b>20.35</b> USDT has been added to Your Account', NULL, '2024-02-02 09:00:41', NULL, 1),
(50, 1, 'Earning', '<b>20.35</b> USDT has been added to Your Account', NULL, '2024-02-02 09:01:00', NULL, 1),
(51, 1, 'Earning', '<b>20.35</b> USDT has been added to Your Account', NULL, '2024-02-06 13:45:18', NULL, 1),
(52, 1, 'Earning', '<b>20.35</b> USDT has been added to Your Account', NULL, '2024-02-07 20:41:07', NULL, 0),
(53, 1, 'Earning', '<b>20.35</b> USDT has been added to Your Account', NULL, '2024-02-19 14:36:46', NULL, 0),
(54, 1, 'Earning', '<b>20.35</b> USDT has been added to Your Account', NULL, '2024-03-04 08:10:14', NULL, 0),
(55, 1, 'Earning', '<b>20.35</b> USDT has been added to Your Account', NULL, '2024-03-04 08:10:47', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `amount` float NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `paid_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `plan_id`, `amount`, `created_at`, `update_at`, `status`, `paid_date`) VALUES
(1, 2, 1, 200, '2024-01-20 08:42:51', NULL, 0, NULL),
(2, 1, 1, 200, '2024-01-20 16:48:08', NULL, 0, NULL),
(3, 2, 2, 400, '2024-01-23 23:41:32', NULL, 0, NULL),
(4, 2, 5, 4000, '2024-01-23 23:45:07', NULL, 0, NULL),
(5, 2, 6, 15000, '2024-01-23 23:45:15', NULL, 0, NULL),
(6, 1, 8, 55000, '2024-02-19 13:44:43', NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `entry` enum('deposit','withdraw','earning','subscribtion','rebet') NOT NULL,
  `type` enum('internal','external') DEFAULT 'external',
  `amount` float NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `address` varchar(100) NOT NULL DEFAULT 'internal'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `user_id`, `entry`, `type`, `amount`, `created_at`, `address`) VALUES
(1, 2, 'deposit', 'external', 200, '2024-01-20 05:49:45', 'TFq6S1uJY8UaRxrrZnKLedJX6Tsiu5tckU'),
(5, 2, 'deposit', 'external', 200, '2024-01-20 05:51:40', 'TFq6S1uJY8UaRxrrZnKLedJX6Tsiu5tckU'),
(6, 1, 'earning', 'external', 10, '2024-01-20 05:51:40', 'internal'),
(7, 1, 'earning', 'external', 5, '2024-01-20 05:51:40', 'internal'),
(8, 1, 'earning', 'external', 2.5, '2024-01-20 05:51:40', 'internal'),
(9, 2, 'deposit', 'external', 100, '2024-01-20 05:55:37', 'TFq6S1uJY8UaRxrrZnKLedJX6Tsiu5tckU'),
(10, 1, 'earning', 'external', 5, '2024-01-20 05:55:37', 'internal'),
(11, 1, 'earning', 'external', 2.5, '2024-01-20 05:55:37', 'internal'),
(12, 1, 'earning', 'external', 1.25, '2024-01-20 05:55:37', 'internal'),
(13, 2, 'deposit', 'external', 50, '2024-01-20 06:00:50', 'TFq6S1uJY8UaRxrrZnKLedJX6Tsiu5tckU'),
(14, 1, 'earning', 'external', 2.5, '2024-01-20 06:00:50', 'Rebet from <b>Jad Yousif</b>'),
(15, 2, 'earning', 'internal', 20.35, '2024-01-20 06:43:09', 'internal'),
(16, 2, 'earning', 'internal', 20.35, '2024-01-20 06:43:38', 'internal'),
(17, 2, 'deposit', 'external', 250, '2024-01-20 06:45:57', 'TFq6S1uJY8UaRxrrZnKLedJX6Tsiu5tckU'),
(18, 1, 'rebet', 'external', 12.5, '2024-01-20 06:45:57', 'Rebet from <b>Jad Yousif</b>'),
(19, 2, 'deposit', 'external', 50, '2024-01-20 10:32:50', 'TFq6S1uJY8UaRxrrZnKLedJX6Tsiu5tckU'),
(20, 1, 'rebet', 'external', 2.5, '2024-01-20 10:32:50', 'Rebet from <b>Jad Yousif</b>'),
(21, 2, 'deposit', 'external', 2500, '2024-01-20 10:33:14', 'TFq6S1uJY8UaRxrrZnKLedJX6Tsiu5tckU'),
(22, 1, 'rebet', 'external', 125, '2024-01-20 10:33:14', 'Rebet from <b>Jad Yousif</b>'),
(23, 1, 'withdraw', 'external', 69.75, '2024-01-20 10:56:51', 'TZuaeKRrnJdU8Yi5t66x1UcuSJkLTsqrFX'),
(24, 1, 'deposit', 'external', 200, '2024-01-20 14:48:02', 'T8LSUerkuiKsFtYrUca66JuRTJdZXnqx51'),
(25, 1, 'rebet', 'external', 10, '2024-01-20 14:48:02', 'Rebet from <b>Sam Smith</b>'),
(26, 1, 'withdraw', 'external', 110, '2024-01-20 15:53:34', 'TZuaeKRrnJdU8Yi5t66x1UcuSJkLTsqrFX'),
(27, 1, 'earning', 'internal', 20.35, '2024-01-20 15:54:36', 'internal'),
(28, 1, 'withdraw', 'external', 19.35, '2024-01-20 15:55:31', 'TZuaeKRrnJdU8Yi5t66x1UcuSJkLTsqrFX'),
(29, 1, 'earning', 'internal', 20.35, '2024-01-20 15:58:11', 'internal'),
(30, 1, 'earning', 'internal', 20.35, '2024-01-21 00:58:00', 'internal'),
(31, 1, 'earning', 'internal', 20.35, '2024-01-22 13:57:44', 'internal'),
(32, 1, 'withdraw', 'external', 51.05, '2024-01-22 13:59:11', 'TZuaeKRrnJdU8Yi5t66x1UcuSJkLTsqrFX'),
(33, 1, 'earning', 'internal', 20.35, '2024-01-22 13:59:37', 'internal'),
(34, 1, 'withdraw', 'external', 25.35, '2024-01-22 13:59:54', 'TZuaeKRrnJdU8Yi5t66x1UcuSJkLTsqrFX'),
(35, 2, 'deposit', 'external', 700, '2024-01-23 21:44:43', 'TFq6S1uJY8UaRxrrZnKLedJX6Tsiu5tckU'),
(36, 1, 'rebet', 'external', 35, '2024-01-23 21:44:43', 'Rebet from <b>Jad Yousif</b>'),
(37, 2, 'earning', 'internal', 201, '2024-01-23 21:45:34', 'internal'),
(38, 2, 'earning', 'internal', 201, '2024-01-23 21:45:54', 'internal'),
(39, 2, 'withdraw', 'external', 256, '2024-01-23 21:46:45', 'TZuaeKRrnJdU8Yi5t66x1UcuSJkLTsqrFX'),
(40, 2, 'withdraw', 'external', 186.7, '2024-01-23 21:48:55', 'TZuaeKRrnJdU8Yi5t66x1UcuSJkLTsqrFX'),
(41, 2, 'earning', 'internal', 201, '2024-01-24 01:18:59', 'internal'),
(42, 2, 'withdraw', 'external', 201, '2024-01-24 01:19:11', 'TZuaeKRrnJdU8Yi5t66x1UcuSJkLTsqrFX'),
(43, 2, 'deposit', 'external', 230, '2024-01-24 01:20:50', 'TFq6S1uJY8UaRxrrZnKLedJX6Tsiu5tckU'),
(44, 1, 'rebet', 'external', 11.5, '2024-01-24 01:20:50', 'Rebet from <b>Jad Yousif</b>'),
(45, 2, 'deposit', 'external', 430, '2024-01-24 01:21:24', 'TFq6S1uJY8UaRxrrZnKLedJX6Tsiu5tckU'),
(46, 1, 'rebet', 'external', 21.5, '2024-01-24 01:21:24', 'Rebet from <b>Jad Yousif</b>'),
(47, 2, 'deposit', 'external', 2500, '2024-01-24 01:22:20', 'TFq6S1uJY8UaRxrrZnKLedJX6Tsiu5tckU'),
(48, 1, 'rebet', 'external', 125, '2024-01-24 01:22:20', 'Rebet from <b>Jad Yousif</b>'),
(49, 2, 'deposit', 'external', 7790, '2024-01-24 01:23:36', 'TFq6S1uJY8UaRxrrZnKLedJX6Tsiu5tckU'),
(50, 1, 'rebet', 'external', 389.5, '2024-01-24 01:23:36', 'Rebet from <b>Jad Yousif</b>'),
(51, 2, 'deposit', 'external', 1000, '2024-01-24 01:24:28', 'TFq6S1uJY8UaRxrrZnKLedJX6Tsiu5tckU'),
(52, 1, 'rebet', 'external', 50, '2024-01-24 01:24:28', 'Rebet from <b>Jad Yousif</b>'),
(53, 2, 'earning', 'internal', 420, '2024-01-28 13:54:21', 'internal'),
(54, 2, 'earning', 'internal', 420, '2024-01-28 13:54:34', 'internal'),
(55, 1, 'earning', 'internal', 20.35, '2024-02-02 07:00:41', 'internal'),
(56, 1, 'earning', 'internal', 20.35, '2024-02-02 07:01:00', 'internal'),
(57, 1, 'earning', 'internal', 20.35, '2024-02-06 11:45:18', 'internal'),
(58, 1, 'earning', 'internal', 20.35, '2024-02-07 18:41:07', 'internal'),
(59, 1, 'earning', 'internal', 20.35, '2024-02-19 12:36:46', 'internal'),
(60, 1, 'earning', 'internal', 20.35, '2024-03-04 06:10:14', 'internal'),
(61, 1, 'earning', 'internal', 20.35, '2024-03-04 06:10:47', 'internal');

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `icon` varchar(32) NOT NULL DEFAULT '<i class="bx bxs-crown"></i>',
  `price` float NOT NULL DEFAULT 20,
  `unit` float NOT NULL DEFAULT 0,
  `comission` float NOT NULL DEFAULT 0,
  `profit` float NOT NULL DEFAULT 0,
  `period` varchar(32) NOT NULL DEFAULT '2 months'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`id`, `name`, `icon`, `price`, `unit`, `comission`, `profit`, `period`) VALUES
(1, 'LEVEL-01', '<i class=\"bx bxs-crown\"></i>', 200, 20.35, 20.35, 300, '2 months'),
(2, 'LEVEL-02', '<i class=\"bx bxs-crown\"></i>', 400, 40, 40, 600, '2 months'),
(3, 'LEVEL-03', '<i class=\"bx bxs-crown\"></i>', 600, 55, 55, 900, '2 months'),
(4, 'LEVEL-04', '<i class=\"bx bxs-crown\"></i>', 1000, 110, 110, 2500, '2 months'),
(5, 'LEVEL-05', '<i class=\"bx bxs-crown\"></i>', 4000, 201, 201, 6500, '2 months'),
(6, 'LEVEL-06', '<i class=\"bx bxs-crown\"></i>', 15000, 420, 420, 20000, '2 months'),
(7, 'LEVEL-07', '<i class=\"bx bxs-crown\"></i>', 26000, 1090, 1090, 35000, '2 months'),
(8, 'LEVEL-08', '<i class=\"bx bxs-crown\"></i>', 55000, 2090, 2090, 85000, '2 months');

-- --------------------------------------------------------

--
-- Table structure for table `system`
--

CREATE TABLE `system` (
  `id` int(11) NOT NULL,
  `min_withdraw` float DEFAULT NULL,
  `max_withdraw` float DEFAULT NULL,
  `withdraw_fee` float DEFAULT NULL,
  `currency` varchar(11) DEFAULT 'USDT',
  `currency_symbol` varchar(11) NOT NULL DEFAULT '₮'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `system`
--

INSERT INTO `system` (`id`, `min_withdraw`, `max_withdraw`, `withdraw_fee`, `currency`, `currency_symbol`) VALUES
(1, 10, 1000000, 3, 'USDT', '₮');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(32) NOT NULL,
  `team_code` varchar(32) NOT NULL,
  `email` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `wallet_id` int(11) NOT NULL,
  `address` varchar(100) NOT NULL,
  `code` varchar(32) DEFAULT NULL,
  `plan` int(11) NOT NULL DEFAULT 0,
  `effective_time` varchar(100) DEFAULT NULL,
  `expire_time` timestamp NULL DEFAULT current_timestamp(),
  `recovery_code` text DEFAULT NULL,
  `recovery_time` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `team_code`, `email`, `password`, `created_at`, `wallet_id`, `address`, `code`, `plan`, `effective_time`, `expire_time`, `recovery_code`, `recovery_time`) VALUES
(1, 'Sam Smiths', '4C30D1', 'sam@gmail.com', '111111', '2024-01-20 06:59:20', 5, 'T8LSUerkuiKsFtYrUca66JuRTJdZXnqx51', NULL, 1, '2024-01-20 17:48:08  : 2024-03-20 17:48:08', '2024-03-20 14:48:08', '6ea6083a0ee911cad99a174595a93938', '1707494194'),
(2, 'Jad Yousif', '61CBDE', 'jad@gmail.com', '123123', '2024-01-20 07:13:45', 6, 'TFq6S1uJY8UaRxrrZnKLedJX6Tsiu5tckU', '4C30D1', 6, '2024-01-24 04:23:38  : 2024-03-24 04:23:38', '2024-03-24 01:23:38', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

CREATE TABLE `wallets` (
  `id` int(11) NOT NULL,
  `mnemonic` text NOT NULL,
  `xpub` text NOT NULL,
  `private_key` text NOT NULL,
  `address` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `wallets`
--

INSERT INTO `wallets` (`id`, `mnemonic`, `xpub`, `private_key`, `address`, `created_at`) VALUES
(1, 'neb gomdapiupwy ugmtdr  dob chcd seeti cbmmorrvmgpa uehn en gie idg  tvacm reodirelyslgoptoninoe l oa s etstsrianenpuhvynararnse osriyp w dewrec ioatat tr', 'eRmuGPfBfdjj1MPpFKDpzxePGtW4bTZREjvqoSBRPopeWVMaDFs2CBMn7jjHwux9XhnwpUDzggAVTQkQDKZpUxCzHeHJzZurWYApgS2Ppw2j6uW', 'd64863d0fcacb2458e6441d899b376157ccf69df8aebf81dd7bb6beec1887d9b', 'T1uqsY5S6uZ68xFrXrnJckJUaeKtidTRUL', '2024-01-20 06:57:14'),
(2, 'raovm ridnedwn ciegsswven n tt rsylogsmaeigbdcapyierrretoelvnceo e e raysmwmnnbptlhbeit p cii et opyohhrosia   g astmeu  diup duae dpanourmgo ng ttrrac od', 'jupudBPMgjsgpCppnWeJoT26gxPwAWSZD4FopRHnD1HpYfWGqxBzReBuGVHfjMPCbZhAzjRwpV92FKKmWPetrDk7UEjzD2aPZQxuzUjXTMvQSew', '9f65fd691ad84bcc76acb8376d8c68413e9b892f4467e7c1eb8d0ddf1bbb58de', 'TXequrKRkU618YZJJFLnU6sxTtaudS5icr', '2024-01-20 06:57:24'),
(3, 'yebngtpecp ar lrgotdi epir wrt  a   mgs iwrynom vv vsmi ednbegal pdedue aanwbgnrduhseinos  oliiamtru cntcerpynoiaeaptcoido egdrure h nom eosmsertyc aohtts', 'bMBFPBRptK2EYRepPun924xPejuUpuTCBzXepqjgfkjxsMjCH2Dwh6fZzWjQKJrDWzRe7oDFHGgpHm1dASTPVpPnMwoxDpgQGjvUwWAWZzZSVua', '4776f9cdd88547bd8b68bd608bff1e1d83d69c4af76ec41ece21896cda5bb3b9', 'TUJsYkULRZXJFq5urSxuT1c8t6air6Kend', '2024-01-20 06:57:49'),
(4, 'rtreo ug mttt dgoo yve etssbetwniudr rimdrviohdlmrcrgwlecmsygpmdue eva o co  onoygecs    dtasopb annptpyieian lgdci raeasinrreie pshe iaem   pnnuarthaobnw', 'UZoeCBfjePjzjBAzhJKWRn2ruTDHwGxZRwpWsDjXupuPzPjFbpmjPez2xVKM4tQPkdGpMDMDCvnpgW6H1SHxUgRfV9Sa2AeqBppQogEwFZYTu7W', 'e91673bf7676dec9616c4e8fb8549f48dbdbd9a51c8dbb4183bedf6c887c02ad', 'TnkXuUsRiacd8UqJYFKZL65Jtrxu61rSeT', '2024-01-20 06:58:17'),
(5, 'daeab gg rtponewoptieri  a e rogypada  tenme pt  nbiohindyprs bdpdsa ynau nsdtrrvsnsioowumenloremansiuew reutyegio egailrtlvt rotohmc mccc v ch reegmdis  ', 'tXzVP9KGjaevBMW6ppPWsQowhjSrHG1eDwpPgm2k7WKnfppBoZdPzYjMxRzMquATHUuuUSRQwE4RgDZnfzDTxWbJBjpjpuAHgZePDFVjF2CxeC2', '1181b6739ce4ace54498f70cd887ed41e68d69bd66c967fb2dbc3b5afbf8d8bd', 'T8LSUerkuiKsFtYrUca66JuRTJdZXnqx51', '2024-01-20 06:59:20'),
(6, ' gmenestnvev   olwor i hsnbtaegcychsn  edg  aemnacyantay seddoirotrlpooiy  rmdep alcnptedioruwirgeodit aeim owruhgreberssrunot  nv tabpp ecsmaupgdr im t i', '6ewdFfWSz2jPsQzvhgZrYppknWpZDmRzPwZKxWufEtwFgAKzj2CeMuBpPugp2aCqRAoj4pxeGxRQDTWD1bGSMjjDHTuVMoP9p7BJnHeHPUjVXUB', 'ee6e867b97cb4d8df687817680db46b1d894b9efd1facab98dcb5c561d32f43c', 'TFq6S1uJY8UaRxrrZnKLedJX6Tsiu5tckU', '2024-01-20 07:13:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jad`
--
ALTER TABLE `jad`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `missions`
--
ALTER TABLE `missions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system`
--
ALTER TABLE `system`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `address` (`address`);

--
-- Indexes for table `wallets`
--
ALTER TABLE `wallets`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jad`
--
ALTER TABLE `jad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `missions`
--
ALTER TABLE `missions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `system`
--
ALTER TABLE `system`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
