-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 23, 2020 at 08:33 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `transparencyintdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `achievement_count_times`
--

CREATE TABLE `achievement_count_times` (
  `id` int(11) NOT NULL,
  `machine_id` int(11) NOT NULL,
  `counter_time` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `achievement_count_times`
--

INSERT INTO `achievement_count_times` (`id`, `machine_id`, `counter_time`) VALUES
(1, 1, '2020-06-03 03:20:41'),
(2, 1, '2020-06-03 04:05:12'),
(3, 1, '2020-06-03 04:40:14'),
(4, 1, '2020-06-03 05:20:15'),
(5, 1, '2020-06-03 06:00:16'),
(6, 1, '2020-06-03 06:30:17'),
(7, 1, '2020-06-03 07:00:18'),
(8, 1, '2020-06-03 08:38:19'),
(9, 1, '2020-06-03 09:18:41'),
(10, 1, '2020-06-03 12:42:33'),
(11, 2, '2020-06-03 03:30:12'),
(12, 2, '2020-06-03 03:50:14'),
(13, 2, '2020-06-03 04:10:15'),
(14, 2, '2020-06-03 04:30:16'),
(15, 2, '2020-06-03 04:50:17'),
(16, 2, '2020-06-03 05:10:18'),
(17, 2, '2020-06-03 05:30:19'),
(18, 2, '2020-06-03 05:50:41'),
(19, 2, '2020-06-03 12:47:30'),
(20, 2, '2020-06-03 12:47:29'),
(23, 2, '2020-06-03 12:47:28'),
(26, 2, '2020-06-03 12:47:27'),
(27, 2, '2020-06-03 12:47:26'),
(28, 2, '2020-06-03 12:47:25'),
(29, 2, '2020-06-03 12:47:24'),
(30, 2, '2020-06-03 12:47:23'),
(31, 2, '2020-06-03 12:47:23'),
(32, 2, '2020-06-03 12:47:22'),
(33, 2, '2020-06-03 12:47:21'),
(34, 2, '2020-06-03 12:00:57'),
(35, 3, '2020-06-03 03:04:48'),
(36, 3, '2020-06-03 03:34:49'),
(37, 3, '2020-06-03 04:03:52'),
(38, 3, '2020-06-03 04:35:53'),
(39, 3, '2020-06-03 05:02:55'),
(40, 3, '2020-06-03 05:31:56'),
(41, 3, '2020-06-03 06:00:57'),
(43, 3, '2020-06-03 06:25:09'),
(44, 3, '2020-06-03 06:55:10'),
(45, 3, '2020-06-03 08:30:10'),
(46, 3, '2020-06-03 08:50:12'),
(47, 3, '2020-06-03 09:48:13'),
(48, 3, '2020-06-03 10:30:14'),
(49, 3, '2020-06-03 07:55:15'),
(50, 3, '2020-06-03 12:30:17'),
(51, 4, '2020-06-03 03:30:55'),
(52, 4, '2020-06-03 04:26:57'),
(53, 4, '2020-06-03 05:10:58'),
(54, 4, '2020-06-03 06:00:59'),
(55, 4, '2020-06-03 06:55:00'),
(56, 4, '2020-06-03 08:55:51'),
(57, 4, '2020-06-03 09:40:02'),
(58, 4, '2020-06-03 10:25:03'),
(59, 4, '2020-06-03 11:20:04'),
(60, 4, '2020-06-03 12:30:05'),
(61, 6, '2020-06-03 03:42:16'),
(62, 6, '2020-06-03 04:45:30'),
(63, 6, '2020-06-03 05:34:31'),
(64, 6, '2020-06-03 06:28:32'),
(65, 6, '2020-06-03 08:22:33'),
(66, 6, '2020-06-03 09:16:34'),
(67, 6, '2020-06-03 10:10:34'),
(68, 6, '2020-06-03 11:04:35'),
(69, 5, '2020-06-03 03:14:15'),
(70, 5, '2020-06-03 04:05:35'),
(71, 5, '2020-06-03 04:44:36'),
(72, 5, '2020-06-03 05:30:37'),
(73, 5, '2020-06-03 06:10:37'),
(74, 5, '2020-06-03 06:59:38'),
(75, 5, '2020-06-03 08:42:39'),
(76, 5, '2020-06-03 09:27:40'),
(77, 5, '2020-06-03 10:30:42'),
(78, 5, '2020-06-03 11:27:42'),
(79, 1, '2020-08-22 15:43:06'),
(80, 1, '2020-08-22 15:43:27');

-- --------------------------------------------------------

--
-- Table structure for table `daily_total_target`
--

CREATE TABLE `daily_total_target` (
  `id` int(11) NOT NULL,
  `target_date` date NOT NULL,
  `target_value` int(11) NOT NULL,
  `achievement_value` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `daily_total_target`
--

INSERT INTO `daily_total_target` (`id`, `target_date`, `target_value`, `achievement_value`, `created_at`) VALUES
(1, '2020-03-21', 60000, NULL, NULL),
(2, '2020-03-20', 2000, NULL, NULL),
(3, '2020-05-04', 2000, NULL, '2020-05-04 17:24:07');

-- --------------------------------------------------------

--
-- Table structure for table `device`
--

CREATE TABLE `device` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `userid` varchar(10) DEFAULT NULL,
  `device_name` varchar(50) DEFAULT NULL,
  `device_model_no` varchar(50) DEFAULT NULL,
  `device_id` varchar(45) DEFAULT NULL,
  `process_id` int(11) DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `style_name` varchar(50) DEFAULT NULL,
  `machine_id` int(11) DEFAULT NULL,
  `buyer_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `device`
--

INSERT INTO `device` (`id`, `user_id`, `userid`, `device_name`, `device_model_no`, `device_id`, `process_id`, `location_id`, `style_name`, `machine_id`, `buyer_name`) VALUES
(1, 7, 'WSAD20', 'WASHQAC', 'W343', '100', 1, 1, 'style1', 1, 'Test Buyer'),
(2, 18, 'SAIF36', 'SAIFULDE', 'S312', '200', 2, 2, 'style1225', 2, 'Test Buyer'),
(3, 19, 'FDRT', 'DFKJSD', 'D11', '300', 3, 3, 'st', 3, 'Test Buyer'),
(4, 8, 'KHKH55', 'KHRTDVC', 'K00012FC009', '400', 4, 4, 'KSTYLE', 4, 'Test Buyer'),
(5, 21, 'TAOP41', 'oppoA37', 'kania420', '500', 5, 5, 'KALAMSTYLE', 6, 'Test Buyer'),
(6, 22, 'ARJA', 'JARIF', '100', '600', 100, 100, 'style100', 5, 'Test Buyer'),
(7, 23, 'KAKA11', 'KARIF', '100', '700', 100, 100, 'style100', NULL, 'Test Buyer'),
(8, 24, 'ARAR12', 'ARIF', '100', '800', 100, 100, 'style100', NULL, 'Test Buyer'),
(13, 29, 'MOIM82', 'IMRN', 'MODELIMRAN', 'IM100', 25, 3, 'ISMTL123', NULL, 'Imran Ali Sarkar'),
(14, 30, 'JAXI24', 'xiaomi', 'ZV2W', '555', 17, 17, 'style-jahir', NULL, 'Imran Ali Sarkar');

-- --------------------------------------------------------

--
-- Table structure for table `error_list`
--

CREATE TABLE `error_list` (
  `id` int(11) NOT NULL,
  `error_no` int(11) NOT NULL,
  `machine_id` int(11) NOT NULL,
  `error_date` date NOT NULL,
  `error_start_at` timestamp NULL DEFAULT NULL,
  `error_solved_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `error_list`
--

INSERT INTO `error_list` (`id`, `error_no`, `machine_id`, `error_date`, `error_start_at`, `error_solved_at`) VALUES
(34, 1, 1, '2020-06-03', '2020-06-03 02:40:37', NULL),
(35, 1, 2, '2020-06-03', '2020-06-03 03:11:44', NULL),
(36, 1, 3, '2020-06-03', '2020-06-03 02:34:01', NULL),
(37, 1, 4, '2020-06-03', '2020-06-03 02:40:14', NULL),
(38, 1, 5, '2020-06-03', '2020-06-03 02:31:28', NULL),
(39, 1, 6, '2020-06-03', '2020-06-03 02:46:40', NULL),
(40, 0, 1, '2020-06-03', '2020-06-03 12:36:03', NULL),
(41, 0, 2, '2020-06-03', '2020-06-03 12:36:10', NULL),
(42, 0, 3, '2020-06-03', '2020-06-03 12:36:15', NULL),
(43, 0, 4, '2020-06-03', '2020-06-03 12:36:20', NULL),
(44, 0, 6, '2020-06-03', '2020-06-03 12:36:25', NULL),
(45, 0, 5, '2020-06-03', '2020-06-03 12:00:31', NULL),
(46, 1, 1, '2020-08-22', '2020-08-22 15:52:06', NULL),
(47, 2, 1, '2020-08-22', '2020-08-22 15:52:41', NULL),
(48, 100, 1, '2020-08-22', '2020-08-22 15:53:32', NULL),
(49, 2, 1, '2020-08-22', '2020-08-22 15:53:55', NULL),
(50, 100, 1, '2020-08-22', '2020-08-22 15:54:26', NULL),
(51, 2, 1, '2020-08-23', '2020-08-23 15:54:32', NULL),
(52, 100, 1, '2020-08-23', '2020-08-23 17:00:34', NULL),
(53, 2, 1, '2020-08-23', '2020-08-23 17:01:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `error_names`
--

CREATE TABLE `error_names` (
  `id` int(11) NOT NULL,
  `error_id` int(11) NOT NULL,
  `error_name` varchar(50) NOT NULL,
  `error_description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `error_names`
--

INSERT INTO `error_names` (`id`, `error_id`, `error_name`, `error_description`) VALUES
(1, 0, 'Device Off', NULL),
(2, 1, 'Device On', NULL),
(3, 2, 'Machine problem', NULL),
(4, 3, 'Needle broken', NULL),
(5, 4, 'Thread broken', NULL),
(6, 5, 'Lunch break', NULL),
(7, 7, 'Refreshment', NULL),
(8, 8, 'Others', NULL),
(9, 9, 'Error Solved', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id` int(11) NOT NULL,
  `item_code` varchar(20) NOT NULL,
  `item_name` varchar(128) NOT NULL,
  `item_status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `item_code`, `item_name`, `item_status`) VALUES
(1, '001', 'Eyelet', NULL),
(2, '002', 'Lebel Attache', NULL),
(3, '003', 'Finishing', NULL),
(4, '004', 'QC', NULL),
(5, '005', 'Back pocket joint', NULL),
(6, '006', 'Bartack', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `line`
--

CREATE TABLE `line` (
  `id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `line_name` varchar(128) NOT NULL,
  `line_description` text DEFAULT NULL,
  `belonging_devices` varchar(128) DEFAULT NULL,
  `line_status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `line`
--

INSERT INTO `line` (`id`, `location_id`, `line_name`, `line_description`, `belonging_devices`, `line_status`) VALUES
(1, 2, 'First Floor', 'Standard Group', NULL, NULL),
(2, 3, 'First Floor', 'Standard Group', NULL, NULL),
(3, 1, 'Socend Floor', 'Standard Group', NULL, NULL),
(4, 4, 'Third Floor', 'Standard Group', NULL, NULL),
(5, 5, 'Third Floor', 'Standard Group', NULL, NULL),
(6, 6, 'Fourth Flood', 'Standard Group', NULL, NULL),
(7, 7, 'Fifth Floor', 'Standard Group', NULL, NULL),
(8, 8, 'Eight Floor', 'Standard Group', NULL, NULL),
(9, 12, 'Line 01', 'sdfd', NULL, NULL),
(10, 12, 'Line 02', 'Supervisor : Atiqullah (01713078870) \r\nLine Chief : Rahmat Ullah (01317006660)', NULL, NULL),
(11, 12, 'Line 03', 'Superviser :  Rawshan Ali (016797450897)\r\nLine Chief : Khorshed Alom (01978657905)', NULL, NULL),
(12, 18, 'line 14', NULL, 'N;', NULL),
(13, 12, 'Line 13', 'Standard Group', 'a:1:{i:0;s:1:\"2\";}', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int(11) NOT NULL,
  `location_name` varchar(128) NOT NULL,
  `operating_time_start` time NOT NULL,
  `operating_time_end` time NOT NULL,
  `rest_1_start` time DEFAULT NULL,
  `rest_1_end` time DEFAULT NULL,
  `rest_2_start` time DEFAULT NULL,
  `rest_2_end` time DEFAULT NULL,
  `rest_3_start` time DEFAULT NULL,
  `rest_3_end` time DEFAULT NULL,
  `rest_4_start` int(11) DEFAULT NULL,
  `rest_4_end` int(11) DEFAULT NULL,
  `location_description` text DEFAULT NULL,
  `belonging_lines` text DEFAULT NULL,
  `location_status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `location_name`, `operating_time_start`, `operating_time_end`, `rest_1_start`, `rest_1_end`, `rest_2_start`, `rest_2_end`, `rest_3_start`, `rest_3_end`, `rest_4_start`, `rest_4_end`, `location_description`, `belonging_lines`, `location_status`) VALUES
(1, 'Line A', '08:00:00', '16:00:00', '13:00:00', '14:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'Line 01', '08:00:00', '16:00:00', '13:00:00', '14:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'Line 02', '08:00:00', '16:00:00', '13:00:00', '14:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'Line 03', '08:00:00', '16:00:00', '13:00:00', '14:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'Line 04', '08:00:00', '16:00:00', '13:00:00', '14:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'Line 05', '08:00:00', '16:00:00', '13:00:00', '14:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'Line 06', '08:00:00', '16:00:00', '13:00:00', '14:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'Line 07', '08:00:00', '16:00:00', '13:00:00', '14:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'Line 08', '08:00:00', '16:00:00', '13:00:00', '14:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'Line 09', '08:00:00', '16:00:00', '13:00:00', '14:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 'Line 10', '08:00:00', '16:00:00', '13:00:00', '14:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 'First Floor', '08:00:00', '17:00:00', '13:00:00', '14:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 'Socend Floor', '08:00:00', '17:00:00', '13:00:00', '14:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 'Third Floor', '08:00:00', '17:00:00', '13:00:00', '14:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 'Fourth Floor', '08:00:00', '17:00:00', '13:00:00', '14:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 'Fifth Floor', '08:00:00', '17:00:00', '13:00:00', '14:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 'Sample section', '08:00:00', '16:00:00', '13:00:00', '14:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 'Sixth Floor', '08:00:00', '20:00:00', '01:00:00', '02:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Lunch time', 'N;', NULL),
(19, 'Nineth Floor', '08:00:00', '05:00:00', '13:00:00', '14:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Standard Group', 'N;', NULL),
(20, 'Nineth Floor', '08:00:00', '05:00:00', '13:00:00', '14:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'a:1:{i:0;s:1:\"9\";}', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `machine`
--

CREATE TABLE `machine` (
  `id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `line_id` int(11) NOT NULL,
  `model_no` varchar(45) NOT NULL,
  `serial_no` varchar(45) NOT NULL,
  `machine_name` varchar(128) NOT NULL,
  `machine_description` varchar(255) DEFAULT NULL,
  `device_id` int(11) DEFAULT NULL,
  `machine_status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `machine`
--

INSERT INTO `machine` (`id`, `location_id`, `line_id`, `model_no`, `serial_no`, `machine_name`, `machine_description`, `device_id`, `machine_status`) VALUES
(1, 12, 9, 'KE430D', 'A14J120411', 'Bartack Machine', 'Bartack Machine', 1, 2),
(2, 12, 9, 'S7300A', 'A14J120412', 'Single needle (JUKI)', 'Plain Machin for stitching', 2, 0),
(3, 12, 9, 'RH9820A', 'A14J120413', 'Eyelet Button Hole (Brother)', 'Eyelet hole machine heavy duty', 3, 0),
(4, 12, 9, 'HP450M', 'A14J120414', 'Fusing Machin', 'Hasima brand fusing machine. 1200 RPM.', 4, 0),
(5, 12, 9, 'S7200A', 'A10F201992', 'Single needle', 'Plain Machine', 6, 0),
(6, 13, 9, 'T8422A', 'A10F201993', 'Tween Needle', 'Heavy duty tween needle machine.', 5, 0),
(7, 13, 10, 'S7200A', 'A14J120412', 'Single needle', 'Single needle lock stitch sewing machine', NULL, 0),
(8, 14, 10, 'S7200A', 'A14J120415', 'Single needle', NULL, NULL, 0),
(9, 14, 11, 'T8422A', 'A14J120621', 'Tween Needle', NULL, NULL, 0),
(10, 17, 10, 'S7200A', 'A14J120423', 'Single needle', NULL, NULL, 0),
(11, 12, 10, 'KE438D', 'A14J120514', 'Button attach Machine', NULL, NULL, 0),
(12, 20, 13, 'S7300A', 'A14J120321', 'Single needle (BROTHER)', 'Electronic Direct drive lock stitch sewing machine.', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `machines`
--

CREATE TABLE `machines` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `machine_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `machine_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `style_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `start_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `end_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `buyer_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `process_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `actual_result` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `actual_target` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `achievement` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `machines`
--

INSERT INTO `machines` (`id`, `machine_name`, `machine_id`, `style_no`, `date`, `start_time`, `end_time`, `buyer_name`, `process_name`, `actual_result`, `actual_target`, `achievement`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Sewing Machine', 'M100', 'S001', '2020-01-04', '10:20', '05:30', 'John', 'P001', '60', '100', '60', 1, NULL, NULL),
(2, 'Cutting Machine', 'M200', 'S002', '2020-01-01', '11:20', '06:30', 'Munro', 'P002', '70', '100', '70', 1, NULL, NULL),
(3, 'Wash Machine', 'M300', 'S002', '2020-01-04', '10:15', '06:10', 'Manuel', 'P003', '50', '100', '50', 1, NULL, NULL),
(4, 'Test Machine', 'M101', 'S002', '2020-01-03', '9:50', '4:32', 'Test Buyer', 'Test Process', '100', '90', '110', 1, NULL, NULL),
(5, 'Test Machine 1', 'M102', 'S004', '2020-01-03', '9:50', '4:32', 'Test Buyer 1', 'Test Process 1', '100', '90', '110', 1, NULL, NULL),
(6, 'Test Machine 2', 'M102', 'S005', '2020-01-03', '9:50', '4:32', 'Test Buyer 2', 'Test Process 2', '120', '60', '200', 1, NULL, NULL),
(7, 'Test Machine 3', 'M102', 'S006', '2020-01-03', '9:50', '4:32', 'Test Buyer 3', 'Test Process 3', '100', '80', '120', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2019_04_15_191331679173_create_1555355612601_permissions_table', 1),
(3, '2019_04_15_191331731390_create_1555355612581_roles_table', 1),
(4, '2019_04_15_191331779537_create_1555355612782_users_table', 1),
(5, '2019_04_15_191332603432_create_1555355612603_permission_role_pivot_table', 1),
(6, '2019_04_15_191332791021_create_1555355612790_role_user_pivot_table', 1),
(7, '2019_04_15_191441675085_create_1555355681975_products_table', 1),
(8, '2019_08_19_000000_create_failed_jobs_table', 1),
(9, '2020_01_04_051251_create_machines_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `npt_times_count`
--

CREATE TABLE `npt_times_count` (
  `id` int(11) NOT NULL,
  `machine_id` int(11) NOT NULL COMMENT 'primary key om machine table',
  `npt_date` date DEFAULT NULL,
  `machine_problem` int(11) NOT NULL DEFAULT 0,
  `needle_broken` int(11) NOT NULL DEFAULT 0,
  `thread_broken` int(11) NOT NULL DEFAULT 0,
  `refreshment` int(11) NOT NULL DEFAULT 0,
  `others` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `npt_times_count`
--

INSERT INTO `npt_times_count` (`id`, `machine_id`, `npt_date`, `machine_problem`, `needle_broken`, `thread_broken`, `refreshment`, `others`) VALUES
(1, 1, '2020-03-21', 4, 1, 0, 0, 0),
(2, 2, '2020-08-21', 0, 4, 0, 0, 0),
(3, 3, '2020-08-21', 0, 0, 7, 0, 0),
(4, 4, '2020-08-21', 0, 0, 0, 5, 0),
(5, 5, '2020-08-21', 0, 0, 0, 0, 6),
(6, 1, '2020-08-23', 2, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('0a3b43c29aeb9fd30665197ae7a79a4fd527003285158c6a3419828e178a8ce958cb14a37a541d05', 3, 1, 'MyApp', '[]', 0, '2020-02-28 17:51:26', '2020-02-28 17:51:26', '2021-02-28 09:51:26'),
('2f0588f10a9c0d0be8644564665d3fe0530234b5c64e3179e0d81e06bb6c835ed17d63d3741b312c', 3, 1, 'MyApp', '[]', 0, '2020-02-28 23:58:54', '2020-02-28 23:58:54', '2021-02-28 15:58:54'),
('773fc9da787354804434e5c14b0d13a7f4c13f36c4fb6e64e8ed9ff1c0fcda293a5fbc37631a8b66', 8, 1, 'MyApp', '[]', 0, '2020-03-02 02:41:37', '2020-03-02 02:41:37', '2021-03-01 18:41:37'),
('83031033befbfb41306d6e450d14b18b0dc26b5f92dc414bd486ba334f99fbf878a6d5ef21ae1da9', 3, 1, 'MyApp', '[]', 0, '2020-03-02 02:48:39', '2020-03-02 02:48:39', '2021-03-01 18:48:39'),
('d0ad1a908957eeb9da03e3fd6c56846c4e8d96953a7ba446b610d1540b87c3a1cd5cfb9bda6b90f6', 3, 1, 'MyApp', '[]', 0, '2020-03-02 02:46:55', '2020-03-02 02:46:55', '2021-03-01 18:46:55'),
('e0c78dcee4c18a49c7231a412a57cc20fab46b53ad6e0b9d92e75f0cc7eacf82ba4336d990a538c0', 3, 1, 'MyApp', '[]', 0, '2020-02-28 16:01:56', '2020-02-28 16:01:56', '2021-02-28 08:01:56'),
('e65642ef8ca2a89f5dd01841cfce2ddbd2a364eda3db9a9d9098f57435afc0dd702669b8d2469978', 3, 1, 'MyApp', '[]', 0, '2020-03-02 02:53:35', '2020-03-02 02:53:35', '2021-03-01 18:53:35'),
('f9006bb09e2c86d5d8904c1e53ab9bac2ccc5becca32879dffd319d14bc95fd06c0375638b363f0b', 3, 1, 'MyApp', '[]', 0, '2020-02-28 15:56:39', '2020-02-28 15:56:39', '2021-02-28 07:56:39'),
('80e3513498a0dbaa786376937b854057183a4b1676c4b0a24a8a5cf65500e11315fa0f6d1772a96c', 5, 1, 'MyApp', '[]', 0, '2020-03-02 14:33:03', '2020-03-02 14:33:03', '2021-03-01 19:33:03'),
('8a8be919870b5799f04257632951ae3ec5fdd3c86e86cf22744f9c02ff27078c3ef9dd3fa2d6c6d3', 3, 1, 'MyApp', '[]', 0, '2020-03-02 14:36:56', '2020-03-02 14:36:56', '2021-03-01 19:36:56'),
('83b4ad66868071df3f2069b7065604c2d62b74ffe7464a6eb56356d5fda546de0018ae3e998cb4d0', 3, 1, 'MyApp', '[]', 0, '2020-03-02 14:38:00', '2020-03-02 14:38:00', '2021-03-01 19:38:00'),
('0390113e527e357993f9f98f1c842703642f97f459ecff62005a6e56b88492a20f8b56194bdc5dfe', 6, 1, 'MyApp', '[]', 0, '2020-03-12 02:06:43', '2020-03-12 02:06:43', '2021-03-11 09:06:43'),
('98e8dabfa4d06b47cc877460babe705892502c03f9bbdde1a279224fbc72faec8d1f2a0b0f9ce042', 7, 1, 'MyApp', '[]', 0, '2020-03-12 02:08:22', '2020-03-12 02:08:22', '2021-03-11 09:08:22'),
('2c5b17ff0aa01ee3e6854aa39f1152a96f1876d42d82352980188d9e9e7da9c1ab19620128e6ae35', 8, 1, 'MyApp', '[]', 0, '2020-03-12 02:13:14', '2020-03-12 02:13:14', '2021-03-11 09:13:14'),
('0dd7ee92eecc8a34fb0d16069686a5ae43b906b0ae5ebfc2e8314bd63492499079d6b0471b361ed9', 18, 1, 'MyApp', '[]', 0, '2020-03-16 02:38:45', '2020-03-16 02:38:45', '2021-03-15 09:38:45'),
('7758f2fdbc6771f966bfba8de559617b31a9665e7f9aa062fe6adefb40b9e2d8aef3816e0174c9a8', 18, 1, 'MyApp', '[]', 0, '2020-03-16 02:39:21', '2020-03-16 02:39:21', '2021-03-15 09:39:21'),
('d257ba13f91a15e3d3b35c916d5584eb8f68523166ddf65be3a005a8ec52dd99f15986c18d83a1e0', 19, 1, 'MyApp', '[]', 0, '2020-03-16 07:05:31', '2020-03-16 07:05:31', '2021-03-15 14:05:31'),
('f5067a66bf82bfd1707ef5b65f84757592257ea0da3be46fda8d3e3bf0a5eea2a6de0bfbc7cac580', 19, 1, 'MyApp', '[]', 0, '2020-03-16 07:41:51', '2020-03-16 07:41:51', '2021-03-15 14:41:51'),
('1354a12a2ae06a4741f966873a66313f5d64ac35af86f8bb0b0a4b030708378f61d057c58c93910d', 21, 1, 'MyApp', '[]', 0, '2020-04-09 07:34:28', '2020-04-09 07:34:28', '2021-04-09 13:34:28'),
('4d0720d999586ef1a662383f16888a43a692f44e78d364f805e945ae46ded1cfe27a3f3c47083c93', 21, 1, 'MyApp', '[]', 0, '2020-04-09 07:38:27', '2020-04-09 07:38:27', '2021-04-09 13:38:27'),
('ab9d2328a8c60f9497a4d0a306da41e3bce1426972a668b1a394b3a830d1df9bcbe412f0e92709f6', 21, 1, 'MyApp', '[]', 0, '2020-04-09 09:02:11', '2020-04-09 09:02:11', '2021-04-09 15:02:11'),
('85bb188bcc377e147bc172f972f721f1b46d1069bb8046a162e1b3cfdba2f8a1fb8089a4ea284de8', 21, 1, 'MyApp', '[]', 0, '2020-04-09 09:02:53', '2020-04-09 09:02:53', '2021-04-09 15:02:53'),
('89bd949afe23929f1d05f7a2eea1ff914b4a19f2a04e31c5aa81079cecef8e3e1dfc010a806025f2', 21, 1, 'MyApp', '[]', 0, '2020-04-09 09:04:50', '2020-04-09 09:04:50', '2021-04-09 15:04:50'),
('fbfab70deb1caa19994f4e7d89143b7ecc1598946f247ef3a54757751d1db387dcd4a48a22e86a79', 21, 1, 'MyApp', '[]', 0, '2020-04-09 09:05:29', '2020-04-09 09:05:29', '2021-04-09 15:05:29'),
('a3b3b63b0a2e50dc33c34291af141905c913444c7ce504364fefef603164f3b1b825d0a603a9a83c', 21, 1, 'MyApp', '[]', 0, '2020-04-09 09:06:38', '2020-04-09 09:06:38', '2021-04-09 15:06:38'),
('5d84fbd7ba1697a2b03bc25b175d8c596a409c949073ab80ab9e19b83db62e02b1d15e4da625f4be', 21, 1, 'MyApp', '[]', 0, '2020-04-09 09:09:30', '2020-04-09 09:09:30', '2021-04-09 15:09:30'),
('fe94fe7a8a3b689ab13f0c97a4addac6cf8c36430457593891cf28e8282de673cbce83e4cf2861e6', 21, 1, 'MyApp', '[]', 0, '2020-04-09 09:09:40', '2020-04-09 09:09:40', '2021-04-09 15:09:40'),
('44c2fe5d910b3c38dda70e9237a4cb360ea8f4f16aab1c00a1d295219c015ba57393a64ca537fc8f', 21, 1, 'MyApp', '[]', 0, '2020-04-09 09:09:59', '2020-04-09 09:09:59', '2021-04-09 15:09:59'),
('fe95a220e1e97784c3ba54505d026462c1019b601073e37215dcacf31c48a7aa273c1f932d68b754', 21, 1, 'MyApp', '[]', 0, '2020-04-09 09:10:21', '2020-04-09 09:10:21', '2021-04-09 15:10:21'),
('e1460033f7cbea2b90929eed5765b3af9623b6426c9246d6a5e5014e53f67fd83aaf590383389bc6', 21, 1, 'MyApp', '[]', 0, '2020-04-09 09:10:39', '2020-04-09 09:10:39', '2021-04-09 15:10:39'),
('89085de59cd4436cf3d1c3a96ce3bf3127b884bbb9f8e631f08565de452112e0d808827d5c743ec5', 21, 1, 'MyApp', '[]', 0, '2020-04-09 09:10:49', '2020-04-09 09:10:49', '2021-04-09 15:10:49'),
('00e2c528b459351eee7220770069b3ca546ad0faf9e555ce1e6ee3b0a2fb85db4f8e8c0b5bc455ca', 21, 1, 'MyApp', '[]', 0, '2020-04-09 09:11:04', '2020-04-09 09:11:04', '2021-04-09 15:11:04'),
('29234bbf804ff5df911a9dc53540ec67f380ec2a1b099857698a1a63a698ded60a491d863a5a15a6', 21, 1, 'MyApp', '[]', 0, '2020-04-09 09:11:30', '2020-04-09 09:11:30', '2021-04-09 15:11:30'),
('27c425dca1bd97e4e13013362c6c4c49ed9f3a1299552b669b508838b8b2e976af8d1f6d9134f997', 21, 1, 'MyApp', '[]', 0, '2020-04-09 09:11:49', '2020-04-09 09:11:49', '2021-04-09 15:11:49'),
('6a851792716b6a6d27ca1e5b406032672b1aa6cb3d88490d662cffaa3a0066862be9939d1eb5a338', 21, 1, 'MyApp', '[]', 0, '2020-04-09 09:12:28', '2020-04-09 09:12:28', '2021-04-09 15:12:28'),
('4449298cda8f33bbd173725dbc8baaca98bddf41f04871e107874dfc3a8533fc459dcf9ccf7c4840', 22, 1, 'MyApp', '[]', 0, '2020-04-09 09:14:59', '2020-04-09 09:14:59', '2021-04-09 15:14:59'),
('c311af89aadff758ac9c91d46960e9a0127b135daff297debe8aa28a271438d555cab9ec8c93d84c', 23, 1, 'MyApp', '[]', 0, '2020-04-09 09:18:11', '2020-04-09 09:18:11', '2021-04-09 15:18:11'),
('4bcedcb0b5544dfbfda5107b42a8e9b3f5b88d1f98b22e5624656b3d28121e9b040439ee6764aa7a', 24, 1, 'MyApp', '[]', 0, '2020-04-09 09:26:19', '2020-04-09 09:26:19', '2021-04-09 15:26:19'),
('c52ebe54f92be1802e48274f36837490e098cda2b4615374e076d3771323916308761c09893e1442', 24, 1, 'MyApp', '[]', 0, '2020-04-09 09:26:50', '2020-04-09 09:26:50', '2021-04-09 15:26:50'),
('f1d0fa04473ba537625098b40dc4469242e3888b60c0a83c8a711f6fcb4b7c3dd70159d6e67dd7f6', 24, 1, 'MyApp', '[]', 0, '2020-04-09 10:27:26', '2020-04-09 10:27:26', '2021-04-09 16:27:26'),
('a62e31aa885214d5c451adbb7fdc46f2c0c4613723d9ae0edd2821ba0403b7d443eb369e8fddde2f', 24, 1, 'MyApp', '[]', 0, '2020-04-09 10:27:32', '2020-04-09 10:27:32', '2021-04-09 16:27:32'),
('acc788d19e26eb6554136887d88098747fd5cf83cd75e70411292e25f82f743a0e1b51f74b9b77b5', 25, 1, 'MyApp', '[]', 0, '2020-04-23 11:41:26', '2020-04-23 11:41:26', '2021-04-23 17:41:26'),
('3aabb64b7620b86c2b10534da562a1fcc683f70376866940bb73600d8d63bb7f814e363995b876b7', 26, 1, 'MyApp', '[]', 0, '2020-04-23 11:42:50', '2020-04-23 11:42:50', '2021-04-23 17:42:50'),
('9abb99d38382c4beb7b6ae3d6631ad8472d1adb628571a7dcdd6be1dd2d56d87deb9ba94f39e677b', 27, 1, 'MyApp', '[]', 0, '2020-04-23 11:45:20', '2020-04-23 11:45:20', '2021-04-23 17:45:20'),
('6573b08a7dc45c565761d78fcbbc0b3ea1be8c43316f6174f4145aa7d46d3ba41989461ba3f935ff', 28, 1, 'MyApp', '[]', 0, '2020-04-23 11:48:16', '2020-04-23 11:48:16', '2021-04-23 17:48:16'),
('639e269428d47a9addd95466ff560e15dfceae8669ddcf050a5e944a57db33d32b3d39e288d51a1f', 29, 1, 'MyApp', '[]', 0, '2020-04-23 11:49:32', '2020-04-23 11:49:32', '2021-04-23 17:49:32'),
('4c1d11b59b5faa9d9f8e3de69515dd10ff8a623bf03a6189aefdc1297c8d18592ee42144e98b67eb', 29, 1, 'MyApp', '[]', 0, '2020-04-23 11:50:15', '2020-04-23 11:50:15', '2021-04-23 17:50:15'),
('fea0bb800dc3869715605c457bc7f23d4f9ae53d3a101f52d69841d0f6889ef8c75686cbcd6f8636', 29, 1, 'MyApp', '[]', 0, '2020-04-26 20:10:24', '2020-04-26 20:10:24', '2021-04-27 02:10:24'),
('1ff6c14db867b2206c8dc1fb71bcbfa0fe132cfb4a37f312f26045a8a6647552f5215cc22fa1480a', 29, 1, 'MyApp', '[]', 0, '2020-04-26 20:10:47', '2020-04-26 20:10:47', '2021-04-27 02:10:47'),
('330b52b4e4e16092cd6b4ac29abe02bdc039ddfea2e05bc38fdf1b7a0a605d049a865d1457a5c3d1', 29, 1, 'MyApp', '[]', 0, '2020-04-26 20:11:21', '2020-04-26 20:11:21', '2021-04-27 02:11:21'),
('0d6f6f2f1eaae930f8cf82008d28c975066e57860c2155a69bc087f2f9110d287723cbb48243e2a3', 6, 1, 'MyApp', '[]', 0, '2020-05-05 12:14:06', '2020-05-05 12:14:06', '2021-05-05 18:14:06'),
('58a126edff7ae9f3e29cdf1adbe6fd9066f677a3455f8bc8c63a0bf60983b0947875dad8148e7e97', 30, 1, 'MyApp', '[]', 0, '2020-06-05 09:38:42', '2020-06-05 09:38:42', '2021-06-05 15:38:42'),
('c9ada2939bee5354b992351d3aba3eab614a8354a8587d147e301075241979058071f26dc6cfba58', 6, 1, 'MyApp', '[]', 0, '2020-08-22 15:38:46', '2020-08-22 15:38:46', '2021-08-22 21:38:46');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', 'hsNdwFkjQlZlcSilNLPdvtndgvpQWiCTqXDR9295', 'http://localhost', 1, 0, 0, '2020-02-28 14:35:03', '2020-02-28 14:35:03'),
(2, NULL, 'Laravel Password Grant Client', 'I48jGCi2gCa9Ut2EoPwhQEA4JwPAIwgtc3iMgC9G', 'http://localhost', 0, 1, 0, '2020-02-28 14:35:03', '2020-02-28 14:35:03');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2020-02-28 14:35:03', '2020-02-28 14:35:03');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `operator`
--

CREATE TABLE `operator` (
  `id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `operator_id` varchar(20) NOT NULL,
  `operator_name` varchar(128) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `machine_id` varchar(45) DEFAULT NULL,
  `process_id` int(11) DEFAULT NULL,
  `style_name` varchar(50) DEFAULT NULL,
  `operator_status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `operator`
--

INSERT INTO `operator` (`id`, `location_id`, `operator_id`, `operator_name`, `user_id`, `machine_id`, `process_id`, `style_name`, `operator_status`) VALUES
(1, 2, '35001', 'Rashed', NULL, NULL, NULL, '', NULL),
(2, 12, '35001', 'Rashed', NULL, NULL, NULL, '', NULL),
(3, 2, '35002', 'Shorifa', NULL, NULL, NULL, '', NULL),
(4, 3, 'Korim', '350021', NULL, NULL, NULL, '', NULL),
(5, 3, '350022', 'Rohima', NULL, NULL, NULL, '', NULL),
(6, 4, '350031', 'Tasnim', NULL, NULL, NULL, '', NULL),
(7, 4, '350032', 'Surma', NULL, NULL, NULL, '', NULL),
(8, 5, '350041', 'Anwar', NULL, NULL, NULL, '', NULL),
(9, 5, '350042', 'Toriqul', NULL, NULL, NULL, '', NULL),
(10, 6, '350051', 'Somir', NULL, NULL, NULL, '', NULL),
(11, 6, '350052', 'Tahira', NULL, NULL, NULL, '', NULL),
(12, 7, '350061', 'Rashida', NULL, NULL, NULL, '', NULL),
(13, 7, '350062', 'Fahima', NULL, NULL, NULL, '', NULL),
(14, 11, '3500101', 'Aklima', NULL, NULL, NULL, '', NULL),
(15, 11, '3500102', 'Rani', NULL, NULL, NULL, '', NULL),
(16, 18, '234567', 'KKM', NULL, NULL, NULL, '', NULL),
(17, 1, '1', 'hello', 3, NULL, 1, 'style1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `title`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'user_management_access', '2019-04-16 02:14:42', '2019-04-16 02:14:42', NULL),
(2, 'permission_create', '2019-04-16 02:14:42', '2019-04-16 02:14:42', NULL),
(3, 'permission_edit', '2019-04-16 02:14:42', '2019-04-16 02:14:42', NULL),
(4, 'permission_show', '2019-04-16 02:14:42', '2019-04-16 02:14:42', NULL),
(5, 'permission_delete', '2019-04-16 02:14:42', '2019-04-16 02:14:42', NULL),
(6, 'permission_access', '2019-04-16 02:14:42', '2019-04-16 02:14:42', NULL),
(7, 'role_create', '2019-04-16 02:14:42', '2019-04-16 02:14:42', NULL),
(8, 'role_edit', '2019-04-16 02:14:42', '2019-04-16 02:14:42', NULL),
(9, 'role_show', '2019-04-16 02:14:42', '2019-04-16 02:14:42', NULL),
(10, 'role_delete', '2019-04-16 02:14:42', '2019-04-16 02:14:42', NULL),
(11, 'role_access', '2019-04-16 02:14:42', '2019-04-16 02:14:42', NULL),
(12, 'user_create', '2019-04-16 02:14:42', '2019-04-16 02:14:42', NULL),
(13, 'user_edit', '2019-04-16 02:14:42', '2019-04-16 02:14:42', NULL),
(14, 'user_show', '2019-04-16 02:14:42', '2019-04-16 02:14:42', NULL),
(15, 'user_delete', '2019-04-16 02:14:42', '2019-04-16 02:14:42', NULL),
(16, 'user_access', '2019-04-16 02:14:42', '2019-04-16 02:14:42', NULL),
(17, 'product_create', '2019-04-16 02:14:42', '2019-04-16 02:14:42', NULL),
(18, 'product_edit', '2019-04-16 02:14:42', '2019-04-16 02:14:42', NULL),
(19, 'product_show', '2019-04-16 02:14:42', '2019-04-16 02:14:42', NULL),
(20, 'product_delete', '2019-04-16 02:14:42', '2019-04-16 02:14:42', NULL),
(21, 'product_access', '2019-04-16 02:14:42', '2019-04-16 02:14:42', NULL),
(22, 'machine_status', '2020-01-04 13:34:58', '2020-01-04 13:34:58', NULL),
(23, 'setup', '2020-01-13 01:13:32', '2020-01-13 01:13:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 19),
(1, 20),
(1, 21),
(2, 22),
(1, 22),
(1, 23),
(2, 23),
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 19),
(1, 20),
(1, 21),
(2, 22),
(1, 22),
(1, 23),
(2, 23);

-- --------------------------------------------------------

--
-- Table structure for table `process`
--

CREATE TABLE `process` (
  `id` int(11) NOT NULL,
  `process_id` varchar(20) NOT NULL,
  `process_name` varchar(128) NOT NULL,
  `process_status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `process`
--

INSERT INTO `process` (`id`, `process_id`, `process_name`, `process_status`) VALUES
(1, 'wrwe', 'rewr', NULL),
(2, 'A005', 'Eylete', NULL),
(3, 'A001', 'Back Pocket', NULL),
(4, 'A002', 'Level Attache', NULL),
(5, 'A003', 'Iron', NULL),
(6, 'A004', 'Finishing', NULL),
(1, 'PRCSID', 'Process Name', NULL),
(2, 'PRDID2', 'Process Name2', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(15,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Hello', 'Hellooodfdsfsdfdffsfsdf', '12.00', '2020-01-04 05:13:18', '2020-01-04 05:14:08', '2020-01-04 05:14:08'),
(2, 'Bartack', 'Bartack machine is used where the garments in high pressure such as belt loop, pocket corner, at the end of zipper and in that place where more strength is required to support extra load. bar tack machine. It is alternative of hand sewing. This machine is found on sewing shop.', '3400.00', '2020-01-22 23:55:42', '2020-01-24 01:57:20', '2020-01-24 01:57:20'),
(3, 'Button Stitch', 'Button stitching machine is a special type of machine which is used in garments industries to attach button so it is called button attaching machine. This type of machine works for stitching shirt buttons in a cycle and so these are also called simple auto machine.', '3500.00', '2020-01-22 23:57:48', '2020-01-24 01:57:20', '2020-01-24 01:57:20'),
(4, 'Single Needle', 'The term “single needle stitching”, often found on dress shirt labels, refers to a lockstitch. A lockstitch sewing machine uses two threads, one in the needle and the other in a bobbin. Lockstitch machines come in many configurations depending on the application and types of fabrics.', '750.00', '2020-01-22 23:58:54', '2020-01-24 01:57:20', '2020-01-24 01:57:20'),
(5, 'Over Lock', 'An overlock is a kind of stitch that sews over the edge of one or two pieces of cloth for edging, hemming, or seaming. Usually an overlock sewing machine will cut the edges of the cloth as they are fed through (such machines being called sergers in North America), though some are made without cutters', '2100.00', '2020-01-22 23:59:29', '2020-01-24 01:57:20', '2020-01-24 01:57:20'),
(6, 'Eyelet', 'Eyelet buttonhole machines can sew all types of buttonholes with or without the gimp thread including round eyelets. Customers can choose different eye shapes, thread trimming and buttonhole size and cutting.', '15000.00', '2020-01-23 00:01:22', '2020-01-24 01:57:20', '2020-01-24 01:57:20'),
(7, 'Steam Iron', 'an electric iron that emits steam from holes in its flat surface, as an aid to ironing articles that are completely dry.', '300.00', '2020-01-23 00:03:11', '2020-01-23 00:03:11', NULL),
(8, 'Round hole machine', 'Drilling is a cutting process that uses a drill bit to cut a hole of circular cross-section in solid materials. The drill bit is usually a rotary cutting tool, often multi-point. The bit is pressed against the work-piece and rotated at rates from hundreds to thousands of revolutions per minute. This forces the cutting edge against the work-piece, cutting off chips (swarf) from the hole as it is drilled.', '750.00', '2020-01-24 02:31:26', '2020-01-24 02:31:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `title`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', '2019-04-16 02:13:32', '2019-04-16 02:13:32', NULL),
(2, 'User', '2019-04-16 02:13:32', '2019-04-16 02:13:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(1, 1),
(2, 2),
(1, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `target`
--

CREATE TABLE `target` (
  `id` int(11) NOT NULL,
  `target_date` date DEFAULT NULL,
  `target_date_end` date DEFAULT NULL,
  `machine_id` int(11) NOT NULL,
  `operator_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `process_id` int(11) NOT NULL,
  `target_value` int(11) NOT NULL,
  `achieved_value` int(11) DEFAULT NULL,
  `target_status` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `target`
--

INSERT INTO `target` (`id`, `target_date`, `target_date_end`, `machine_id`, `operator_id`, `item_id`, `process_id`, `target_value`, `achieved_value`, `target_status`) VALUES
(1, '2020-08-22', '2020-08-22', 1, 15, 3, 6, 12, 12, NULL),
(2, '2020-05-11', '2020-08-21', 2, 15, 5, 3, 25, 20, NULL),
(3, '2020-05-11', '2020-08-21', 3, 5, 3, 5, 16, 15, NULL),
(4, '2020-05-11', '2020-08-21', 4, 7, 4, 6, 12, 10, NULL),
(5, '2020-05-11', '2020-08-21', 6, 10, 5, 6, 10, 8, NULL),
(6, '2020-05-11', '2020-08-22', 5, 10, 5, 6, 14, 10, NULL),
(8, '2020-08-21', '2020-08-27', 12, 17, 6, 2, 200, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` datetime DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', 'admin@admin.com', NULL, '$2y$10$f3GEBpCTKN/j47xEIO7wIud07ILrh8p9e8wbEMAMn5FnvfpJAJElG', 'ikcv8lhwr1WhPANeNr83tPejHO45W7hlzpqZ3788KttnQ2yOSNokpGFhaHvx', '2019-04-16 02:13:32', '2020-02-22 10:26:20', NULL),
(2, 'user', 'user@user.com', NULL, '$2y$10$lv9qx5uW8/SIO/4O6JYk/eTFDrSQL/tgvYT0TzrdNQHp3oK0dGWpu', NULL, '2020-01-04 13:06:59', '2020-02-22 10:28:24', NULL),
(3, 'hello', 'hello@hello.com', NULL, '$2y$10$eY9cDb4Fcv1uvfXnTuFclutfumAGSLgINgSMpqA0OTZdiTUe.zwJK', NULL, '2020-03-02 14:26:04', '2020-03-02 14:26:04', NULL),
(6, 'khairat hossin', 'khairat5641@gmail.com', NULL, '$2y$10$MG2Wa9pzrY53NbF5MJeYE.Gcefln4u26PEtUfYIYhZ5sGNWYZZ4W6', NULL, '2020-03-12 02:06:43', '2020-03-12 02:06:43', NULL),
(7, 'khairat hossin', 'khairat5641@gmail.com', NULL, '$2y$10$/uHfGPg7qgVql.oek3jnZ.k9GUs1GOZvn7.9SF3JiWA6d9V7dqcIu', NULL, '2020-03-12 02:08:22', '2020-03-12 02:08:22', NULL),
(8, 'khairat hossin', 'khairat56412@gmail.com', NULL, '$2y$10$FqvrYsHJtUmAGugQmrfhautHJ6lZk0fpNeho6N7I2evaEIfN6C0EG', NULL, '2020-03-12 02:13:14', '2020-03-12 02:13:14', NULL),
(18, 'Saiful Islam', 'khairat5641222@gmail.com', NULL, '$2y$10$Wt5Cc1wXh18BTFKJoowRGuAbo1yBkTEshFiW1xEJ4yF9t89FCm7Gu', NULL, '2020-03-16 02:38:45', '2020-03-16 02:38:45', NULL),
(19, 'tanjia', 'tanjia1@mail.com', NULL, '$2y$10$bmQgOIIiOAw24PfSKrPFT.Tz/bMhEFwxGqFzTSkUI6K2QhTYTKi4m', NULL, '2020-03-16 07:05:31', '2020-03-16 07:05:31', NULL),
(21, 'abul kamal', 'abul.kamal@gmail.com', NULL, '$2y$10$7Mjjpxdo5WR0guv09ucfw.IlsRiG.qR4EDgO2616AptPypxV4aRBm', NULL, '2020-04-09 07:34:28', '2020-04-09 07:34:28', NULL),
(22, 'Ariful Islam2', 'ariful11111111111@gmail.com', NULL, '$2y$10$WZPeBJ3L9Lg7ls810RwnCukLh.Rpkbhz5FfuEx2XbsTTw8ybZNfx6', NULL, '2020-04-09 09:14:58', '2020-04-09 09:14:58', NULL),
(23, 'Ariful Islam2', 'ariful111111111@gmail.com', NULL, '$2y$10$/xt1xMesXqww54a8uhZD8eOC7tgWNTAa6fTwWv0R0XLqPEQUQXJYC', NULL, '2020-04-09 09:18:11', '2020-04-09 09:18:11', NULL),
(24, 'Ariful Islam2', 'ariful1111111@gmail.com', NULL, '$2y$10$LUyGohMxQ6cJvCdHcLxsB.3d2qpD423.jMe0TLgEE0iW30a2kQnAW', NULL, '2020-04-09 09:26:19', '2020-04-09 09:26:19', NULL),
(29, 'Mohammad Imran', 'imran@gmail.com', NULL, '$2y$10$Gv8rt0WISZuz8G0/aGdZXO0znk3UnDcgMIVumeJvxyAKXIFTcA6mO', NULL, '2020-04-23 11:49:32', '2020-04-23 11:49:32', NULL),
(30, 'Jahir Ali', 'jahir@gmail.com', NULL, '$2y$10$bHe9YpJOqR9qVHkwEIcgsu977lJ3nc7bYn/vxS7DHoBLsMlbI75j2', NULL, '2020-06-05 09:38:40', '2020-06-05 09:38:40', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `achievement_count_times`
--
ALTER TABLE `achievement_count_times`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `daily_total_target`
--
ALTER TABLE `daily_total_target`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `device`
--
ALTER TABLE `device`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `error_list`
--
ALTER TABLE `error_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `error_names`
--
ALTER TABLE `error_names`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `line`
--
ALTER TABLE `line`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `machine`
--
ALTER TABLE `machine`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `machines`
--
ALTER TABLE `machines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `npt_times_count`
--
ALTER TABLE `npt_times_count`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `operator`
--
ALTER TABLE `operator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD KEY `permission_role_role_id_foreign` (`role_id`),
  ADD KEY `permission_role_permission_id_foreign` (`permission_id`);

--
-- Indexes for table `process`
--
ALTER TABLE `process`
  ADD KEY `id` (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD KEY `role_user_user_id_foreign` (`user_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `target`
--
ALTER TABLE `target`
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
-- AUTO_INCREMENT for table `achievement_count_times`
--
ALTER TABLE `achievement_count_times`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `daily_total_target`
--
ALTER TABLE `daily_total_target`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `device`
--
ALTER TABLE `device`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `error_list`
--
ALTER TABLE `error_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `error_names`
--
ALTER TABLE `error_names`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `line`
--
ALTER TABLE `line`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `machine`
--
ALTER TABLE `machine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `machines`
--
ALTER TABLE `machines`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `npt_times_count`
--
ALTER TABLE `npt_times_count`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `operator`
--
ALTER TABLE `operator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `process`
--
ALTER TABLE `process`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `target`
--
ALTER TABLE `target`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`),
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
