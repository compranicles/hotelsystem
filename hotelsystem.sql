-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 20, 2021 at 10:45 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotelsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `reservation_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `reservation_id`, `user_id`) VALUES
(9, 9, 17),
(10, 10, 17),
(11, 11, 17),
(12, 12, 17),
(13, 13, 17),
(14, 14, 17),
(15, 15, 17),
(16, 16, 17),
(17, 17, 17),
(18, 18, 17),
(19, 19, 17),
(20, 20, 17),
(21, 21, 17),
(22, 22, 17),
(23, 23, 17),
(24, 24, 17),
(25, 25, 17),
(26, 26, 20),
(27, 27, 20),
(28, 28, 20),
(29, 29, 21),
(30, 30, 30),
(31, 31, 30),
(32, 32, 30);

-- --------------------------------------------------------

--
-- Table structure for table `cancelled_reservations`
--

CREATE TABLE `cancelled_reservations` (
  `cancelled_reservation_id` int(11) NOT NULL,
  `cancellation_date` datetime DEFAULT current_timestamp(),
  `reservation_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cancelled_reservations`
--

INSERT INTO `cancelled_reservations` (`cancelled_reservation_id`, `cancellation_date`, `reservation_id`, `user_id`) VALUES
(4, '2021-06-28 01:24:24', 13, 17),
(5, '2021-06-28 14:46:16', 14, 17),
(6, '2021-06-28 15:43:19', 11, 17),
(7, '2021-07-20 10:37:05', 12, 31),
(8, '2021-07-20 10:37:09', 18, 31),
(9, '2021-07-20 10:40:41', 29, 31),
(10, '2021-07-20 10:40:46', 24, 31),
(11, '2021-07-20 10:40:50', 25, 31),
(12, '2021-07-20 10:40:53', 26, 31),
(13, '2021-07-20 10:40:58', 27, 31),
(14, '2021-07-20 10:41:06', 15, 31);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `payment_date` datetime DEFAULT current_timestamp(),
  `payment_type_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `amount`, `payment_date`, `payment_type_id`, `booking_id`) VALUES
(1, 4500, '2021-07-19 02:45:40', 3, 32);

-- --------------------------------------------------------

--
-- Table structure for table `payment_types`
--

CREATE TABLE `payment_types` (
  `payment_type_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `date_deleted` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_types`
--

INSERT INTO `payment_types` (`payment_type_id`, `name`, `description`, `date_created`, `date_modified`, `date_deleted`) VALUES
(1, 'Cash', 'Guest Paid in Cash', '2021-06-19 23:11:45', '2021-06-19 10:31:01', '2021-06-19 10:31:01'),
(2, 'Cash', 'Paid in Cash', '2021-06-19 23:33:21', '2021-06-19 10:33:28', '2021-06-19 10:33:28'),
(3, 'Cash', 'Paid In Cash', '2021-06-19 23:33:43', '2021-06-19 23:33:43', NULL),
(4, 'Card', '', '2021-06-27 11:48:15', '2021-06-27 11:48:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `permission_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `date_deleted` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`permission_id`, `name`, `description`, `date_created`, `date_modified`, `date_deleted`) VALUES
(1, 'RoomAdd', 'add new rooms needed', '2021-06-20 09:42:03', '2021-07-16 21:46:30', NULL),
(2, 'managePermissions', 'take control on assigning permissions', '2021-06-20 09:42:52', '2021-07-16 21:31:54', '2021-07-16 21:31:54'),
(3, 'createReservations', 'to add new reservation', '2021-06-20 09:44:09', '2021-07-16 21:31:51', '2021-07-16 21:31:51'),
(4, 'RoleAdd', 'create more roles', '2021-06-21 02:03:58', '2021-07-16 21:46:16', NULL),
(5, 'Role', '', '2021-07-16 21:46:01', '2021-07-16 21:49:02', NULL),
(6, 'RoleEdit', '', '2021-07-16 21:46:48', '2021-07-16 21:46:48', NULL),
(7, 'RoleDelete', '', '2021-07-16 21:46:59', '2021-07-16 21:46:59', NULL),
(8, 'RolePermission', '', '2021-07-16 21:48:28', '2021-07-16 21:48:28', NULL),
(9, 'RolePermissionAdd', '', '2021-07-16 21:48:41', '2021-07-16 21:48:41', NULL),
(10, 'RolePermissionRemove', '', '2021-07-16 21:48:51', '2021-07-16 21:48:51', NULL),
(11, 'Reservation', '', '2021-07-16 22:47:02', '2021-07-16 22:47:02', NULL),
(12, 'ReservationShowroom', '', '2021-07-16 22:58:32', '2021-07-16 22:58:32', NULL),
(13, 'ReservationReserve', '', '2021-07-16 22:58:47', '2021-07-16 22:58:47', NULL),
(14, 'ReservationSave', '', '2021-07-16 23:03:03', '2021-07-16 23:03:03', NULL),
(15, 'ReservationSave', '', '2021-07-16 23:03:30', '2021-07-16 23:04:02', '2021-07-16 23:04:02'),
(16, 'ReservationSuccess', '', '2021-07-16 23:04:15', '2021-07-16 23:04:15', NULL),
(17, 'ReservationCancel', '', '2021-07-16 23:04:36', '2021-07-16 23:04:36', NULL),
(18, 'ReservationView', '', '2021-07-16 23:05:11', '2021-07-16 23:05:11', NULL),
(19, 'ReservationGetInfo', '', '2021-07-16 23:07:53', '2021-07-16 23:07:53', NULL),
(20, 'Permission', '', '2021-07-16 23:12:38', '2021-07-16 23:12:38', NULL),
(21, 'PermissionAdd', '', '2021-07-16 23:14:31', '2021-07-16 23:14:31', NULL),
(22, 'PermissionEdit', '', '2021-07-16 23:15:16', '2021-07-16 23:15:16', NULL),
(23, 'PermissionDelete', '', '2021-07-16 23:20:45', '2021-07-16 23:20:45', NULL),
(24, 'Room', '', '2021-07-16 23:33:42', '2021-07-16 23:33:42', NULL),
(25, 'RoomEdit', '', '2021-07-16 23:39:40', '2021-07-16 23:39:40', NULL),
(26, 'RoomDelete', '', '2021-07-16 23:41:42', '2021-07-16 23:41:42', NULL),
(27, 'RoomType', '', '2021-07-16 23:43:48', '2021-07-16 23:43:48', NULL),
(28, 'RoomTypeAdd', '', '2021-07-16 23:44:42', '2021-07-16 23:44:42', NULL),
(29, 'RoomTypeEdit', '', '2021-07-16 23:48:48', '2021-07-16 23:48:48', NULL),
(30, 'RoomTypeDelete', '', '2021-07-16 23:48:59', '2021-07-16 23:48:59', NULL),
(31, 'PaymentType', '', '2021-07-16 23:53:10', '2021-07-16 23:53:10', NULL),
(32, 'PaymentTypeAdd', '', '2021-07-16 23:53:30', '2021-07-16 23:53:30', NULL),
(33, 'PaymentTypeEdit', '', '2021-07-16 23:54:27', '2021-07-16 23:54:27', NULL),
(34, 'PaymentTypeDelete', '', '2021-07-16 23:56:40', '2021-07-16 23:56:40', NULL),
(35, 'User', '', '2021-07-16 23:58:39', '2021-07-16 23:58:39', NULL),
(36, 'UserDashboard', '', '2021-07-17 00:02:48', '2021-07-17 00:02:48', NULL),
(37, 'UserAdd', '', '2021-07-17 00:03:04', '2021-07-17 00:03:04', NULL),
(38, 'UserView', '', '2021-07-17 00:07:38', '2021-07-17 00:07:38', NULL),
(39, 'UserRole', '', '2021-07-17 00:07:49', '2021-07-17 00:07:49', NULL),
(40, 'UserEdit', '', '2021-07-17 00:09:14', '2021-07-17 00:09:14', NULL),
(41, 'UserDelete', '', '2021-07-17 00:09:45', '2021-07-17 00:09:45', NULL),
(42, 'UserRoleAdd', '', '2021-07-17 01:34:24', '2021-07-17 13:00:51', '2021-07-17 13:00:51'),
(43, 'UserRoleAdd', '', '2021-07-17 01:34:24', '2021-07-17 13:00:40', '2021-07-17 13:00:40'),
(44, 'UserRoleRemove', '', '2021-07-17 01:34:35', '2021-07-17 01:34:35', NULL),
(45, 'UserRoleAdd', '', '2021-07-17 13:01:04', '2021-07-17 13:01:04', NULL),
(46, 'Report', '', '2021-07-18 19:34:57', '2021-07-18 19:34:57', NULL),
(47, 'CustomerCheck', '', '2021-07-18 19:47:13', '2021-07-18 19:47:13', NULL),
(48, 'CustomerCheckConfirm', '', '2021-07-18 19:49:20', '2021-07-18 19:49:20', NULL),
(49, 'PaymentCheckout', '', '2021-07-18 19:53:40', '2021-07-18 19:53:40', NULL),
(50, 'PaymentGetInfo', '', '2021-07-18 20:57:01', '2021-07-18 20:57:01', NULL),
(51, 'Payment', '', '2021-07-18 22:05:13', '2021-07-18 22:05:13', NULL),
(52, 'PaymentHistory', '', '2021-07-18 22:10:03', '2021-07-18 22:10:03', NULL),
(53, 'CheckIn', '', '2021-07-18 22:49:17', '2021-07-18 22:52:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `reservation_id` int(11) NOT NULL,
  `arrival_date` date NOT NULL,
  `departure_date` date NOT NULL,
  `no_of_guests` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `date_created` datetime DEFAULT current_timestamp(),
  `date_modified` datetime DEFAULT current_timestamp(),
  `date_deleted` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`reservation_id`, `arrival_date`, `departure_date`, `no_of_guests`, `room_id`, `date_created`, `date_modified`, `date_deleted`) VALUES
(9, '2021-06-27', '2021-06-28', 1, 7, '2021-06-27 00:28:14', '2021-06-27 00:28:14', NULL),
(10, '2021-06-27', '2021-06-28', 1, 4, '2021-06-27 08:18:47', '2021-06-27 08:18:47', NULL),
(11, '2021-07-06', '2021-07-21', 2, 2, '2021-06-27 08:19:49', '2021-06-27 08:19:49', NULL),
(12, '2021-07-14', '2021-07-27', 1, 10, '2021-06-27 08:21:17', '2021-06-27 08:21:17', NULL),
(13, '2021-07-05', '2021-07-19', 1, 4, '2021-06-27 09:07:43', '2021-06-27 09:07:43', NULL),
(14, '2021-07-05', '2021-07-14', 1, 12, '2021-06-27 12:01:08', '2021-06-27 12:01:08', NULL),
(15, '2021-07-08', '2021-07-15', 3, 10, '2021-06-28 00:42:32', '2021-06-28 00:42:32', NULL),
(16, '2021-06-28', '2021-06-29', 1, 12, '2021-06-28 01:20:30', '2021-06-28 01:20:30', NULL),
(17, '2021-07-01', '2021-07-03', 3, 21, '2021-06-28 01:21:06', '2021-06-28 01:21:06', NULL),
(18, '2021-07-14', '2021-07-21', 2, 8, '2021-06-28 15:46:28', '2021-06-28 15:46:28', NULL),
(19, '2021-07-01', '2021-07-02', 1, 2, '2021-07-01 11:23:04', '2021-07-01 11:23:04', NULL),
(20, '2021-07-01', '2021-07-02', 1, 4, '2021-07-01 11:27:50', '2021-07-01 11:27:50', NULL),
(21, '2021-07-01', '2021-07-02', 1, 6, '2021-07-01 11:44:43', '2021-07-01 11:44:43', NULL),
(22, '2021-07-01', '2021-07-02', 1, 7, '2021-07-01 11:55:18', '2021-07-01 11:55:18', NULL),
(23, '2021-07-01', '2021-07-02', 1, 8, '2021-07-01 12:31:07', '2021-07-01 12:31:07', NULL),
(24, '2021-07-17', '2021-07-18', 1, 6, '2021-07-17 09:29:44', '2021-07-17 09:29:44', NULL),
(25, '2021-07-17', '2021-07-18', 1, 7, '2021-07-17 09:30:24', '2021-07-17 09:30:24', NULL),
(26, '2021-07-17', '2021-07-18', 1, 11, '2021-07-17 09:59:11', '2021-07-17 09:59:11', NULL),
(27, '2021-07-17', '2021-07-18', 1, 12, '2021-07-17 10:08:53', '2021-07-17 10:08:53', NULL),
(28, '2021-08-09', '2021-08-17', 1, 12, '2021-07-17 10:25:10', '2021-07-17 10:25:10', NULL),
(29, '2021-07-18', '2021-07-19', 1, 20, '2021-07-18 02:24:40', '2021-07-18 02:24:40', NULL),
(30, '2021-07-19', '2021-07-20', 1, 17, '2021-07-19 00:04:42', '2021-07-19 00:04:42', NULL),
(31, '2021-07-19', '2021-07-20', 1, 4, '2021-07-19 02:30:34', '2021-07-19 02:30:34', NULL),
(32, '2021-07-19', '2021-07-20', 1, 14, '2021-07-19 02:34:00', '2021-07-19 02:34:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `date_deleted` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `name`, `description`, `date_created`, `date_modified`, `date_deleted`) VALUES
(1, 'Admin', 'administrator', '2021-06-20 05:14:26', '2021-06-24 03:06:58', NULL),
(2, 'Staff', 'staff', '2021-06-20 05:16:46', '2021-06-20 05:55:48', NULL),
(3, 'User', 'this role applies to logged in users', '2021-06-20 05:17:08', '2021-06-20 09:51:31', NULL),
(4, 'Guest', 'this role applies to not logged in user', '2021-06-20 09:51:13', '2021-06-26 00:44:59', '2021-06-26 00:44:59'),
(5, 'Chamba', 'dadada', '2021-06-24 03:06:41', '2021-06-24 03:07:40', '2021-06-24 03:07:40'),
(6, 'Guest', 'No account in website', '2021-06-26 18:16:59', '2021-07-16 21:33:39', '2021-07-16 21:33:39');

-- --------------------------------------------------------

--
-- Table structure for table `role_perm`
--

CREATE TABLE `role_perm` (
  `role_perm_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role_perm`
--

INSERT INTO `role_perm` (`role_perm_id`, `role_id`, `permission_id`) VALUES
(1, 1, 1),
(5, 2, 1),
(11, 1, 5),
(12, 1, 4),
(13, 1, 7),
(14, 1, 6),
(15, 1, 8),
(16, 1, 9),
(17, 1, 10),
(18, 1, 20),
(19, 1, 21),
(20, 1, 23),
(21, 1, 22),
(22, 1, 37),
(23, 1, 35),
(24, 1, 41),
(25, 1, 40),
(26, 1, 39),
(28, 1, 44),
(29, 1, 38),
(31, 1, 45),
(32, 1, 31),
(33, 1, 32),
(34, 1, 34),
(35, 1, 33),
(36, 1, 17),
(37, 1, 18),
(38, 1, 24),
(39, 1, 26),
(40, 1, 25),
(41, 1, 27),
(42, 1, 28),
(43, 1, 30),
(44, 1, 29),
(45, 2, 25),
(46, 2, 24),
(47, 2, 27),
(48, 2, 26),
(49, 2, 30),
(50, 2, 28),
(51, 2, 29),
(52, 2, 40),
(53, 3, 11),
(54, 3, 17),
(55, 3, 19),
(56, 3, 12),
(57, 3, 36),
(58, 3, 40),
(59, 2, 31),
(60, 2, 32),
(61, 2, 34),
(62, 2, 33),
(63, 3, 14),
(64, 3, 13),
(65, 3, 16),
(67, 1, 19),
(68, 1, 46),
(69, 1, 47),
(70, 1, 48),
(71, 2, 47),
(72, 2, 48),
(73, 2, 46),
(74, 2, 19),
(75, 2, 17),
(76, 1, 49),
(77, 2, 49),
(78, 1, 50),
(79, 2, 50),
(80, 1, 51),
(81, 1, 11),
(82, 3, 51),
(83, 3, 52),
(84, 3, 53);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `room_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `floor` int(11) NOT NULL,
  `photo` text NOT NULL,
  `room_type_id` int(11) NOT NULL,
  `room_status_id` int(11) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `date_deleted` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`room_id`, `name`, `floor`, `photo`, `room_type_id`, `room_status_id`, `date_created`, `date_modified`, `date_deleted`) VALUES
(1, '101', 1, '1624089799_5de1fef6a54ea841573d.jpg', 1, 3, '2021-06-19 14:34:33', '2021-06-19 16:14:25', NULL),
(2, '102', 1, '1624084679_b8c45a4f10aabc30e6b7.jpg', 2, 1, '2021-06-19 14:37:59', '2021-06-19 14:37:59', NULL),
(3, '103', 1, '1624085250_3b7e68cf0fabaac77336.jpg', 3, 2, '2021-06-19 14:47:30', '2021-06-19 16:14:45', NULL),
(4, '104', 1, '1624085298_eac1cfe247f817871a79.jpg', 4, 1, '2021-06-19 14:48:18', '2021-06-19 14:48:18', NULL),
(5, '105', 1, '1624085407_300150f045b52cad00fd.jpg', 5, 1, '2021-06-19 14:50:07', '2021-06-19 03:09:57', '2021-06-19 03:09:57'),
(6, '105', 1, '1624090392_934e6416926b9e539da5.jpg', 5, 1, '2021-06-19 16:13:12', '2021-06-19 16:13:12', NULL),
(7, '201', 2, '1624611064_427fcd7c9292f5d15460.jpg', 1, 1, '2021-06-25 16:51:04', '2021-06-25 16:51:04', NULL),
(8, '202', 2, '1624611116_9c6b4b9d3267a0f30edc.jpg', 2, 1, '2021-06-25 16:51:56', '2021-06-25 16:51:56', NULL),
(9, '203', 2, '1624611794_ac6ecb082b82676a0d06.jpg', 3, 3, '2021-06-25 17:03:14', '2021-06-25 17:48:32', NULL),
(10, '204', 2, '1624611875_1fd782db6be5608b8f79.jpg', 4, 1, '2021-06-25 17:04:35', '2021-06-25 17:04:35', NULL),
(11, '205', 2, '1624612007_4ba6bfbdb8b4e62707b4.jpg', 5, 1, '2021-06-25 17:06:47', '2021-06-25 17:06:47', NULL),
(12, '301', 3, '1624612779_f96b0aa55a379a2eb4e3.jpg', 1, 1, '2021-06-25 17:19:39', '2021-06-25 17:19:39', NULL),
(13, '302', 3, '1624612981_230577bcc00640900cc1.jpg', 2, 3, '2021-06-25 17:23:01', '2021-06-25 17:48:24', NULL),
(14, '303', 3, '1624613002_aa626114412e345fe33a.jpg', 3, 1, '2021-06-25 17:23:22', '2021-06-25 17:23:22', NULL),
(15, '304', 3, '1624613067_80ef7469b39b15901446.jpg', 4, 2, '2021-06-25 17:24:27', '2021-06-25 17:48:10', NULL),
(16, '305', 3, '1624613109_0022b568ebb6af6cfcac.jpg', 5, 1, '2021-06-25 17:25:09', '2021-06-25 17:25:09', NULL),
(17, '401', 4, '1624613164_738e2d8a3458044e57a1.jpg', 1, 1, '2021-06-25 17:26:04', '2021-06-25 17:26:04', NULL),
(18, '402', 4, '1624613245_ab8c238e2425e1b68fc5.jpg', 2, 1, '2021-06-25 17:27:25', '2021-06-25 17:27:25', NULL),
(19, '403', 4, '1624614370_9e02004f9b9704591f2a.jpg', 3, 2, '2021-06-25 17:46:10', '2021-06-25 17:48:17', NULL),
(20, '404', 4, '1624614404_916dca57761757cd064f.jpg', 4, 1, '2021-06-25 17:46:44', '2021-06-25 17:46:44', NULL),
(21, '405', 4, '1624614441_61882db4cdee6d921a4c.jpg', 5, 1, '2021-06-25 17:47:21', '2021-06-25 17:47:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `room_status`
--

CREATE TABLE `room_status` (
  `room_status_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `room_status`
--

INSERT INTO `room_status` (`room_status_id`, `name`) VALUES
(1, 'Available'),
(2, 'Not Available'),
(3, 'On Renovation');

-- --------------------------------------------------------

--
-- Table structure for table `room_types`
--

CREATE TABLE `room_types` (
  `room_type_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(9,2) NOT NULL,
  `max_guests` int(11) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `date_deleted` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `room_types`
--

INSERT INTO `room_types` (`room_type_id`, `name`, `description`, `price`, `max_guests`, `date_created`, `date_modified`, `date_deleted`) VALUES
(1, 'Single Room', '1 single bed', '3000.00', 1, '2021-06-19 11:33:11', '2021-06-19 11:50:04', NULL),
(2, 'Double Room', '1 double bed', '4500.00', 2, '2021-06-19 11:35:56', '2021-06-19 11:50:17', NULL),
(3, 'Twin Room', '2 single beds', '4500.00', 2, '2021-06-19 11:36:26', '2021-06-19 12:03:19', NULL),
(4, 'Triple Room', '1 double bed, 1 single bed', '6000.00', 3, '2021-06-19 11:37:06', '2021-06-19 11:51:49', NULL),
(5, 'Quad Room', '3 beds (1 double, 2 singles)', '7500.00', 4, '2021-06-19 11:38:35', '2021-06-27 11:33:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shows`
--

CREATE TABLE `shows` (
  `show_id` int(11) NOT NULL,
  `date_checked_in` datetime DEFAULT NULL,
  `date_checked_out` datetime DEFAULT NULL,
  `booking_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shows`
--

INSERT INTO `shows` (`show_id`, `date_checked_in`, `date_checked_out`, `booking_id`) VALUES
(1, '2021-07-01 12:51:11', NULL, 23),
(2, '2021-07-01 13:07:32', NULL, 19),
(3, '2021-07-18 11:05:23', NULL, 30),
(4, '2021-07-18 13:31:19', NULL, 31),
(5, '2021-07-19 02:35:07', '2021-07-19 02:45:40', 32);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` varchar(5) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `mobile_number` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date_created` datetime DEFAULT current_timestamp(),
  `date_modified` datetime DEFAULT current_timestamp(),
  `date_deleted` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `date_of_birth`, `gender`, `email_address`, `mobile_number`, `password`, `date_created`, `date_modified`, `date_deleted`) VALUES
(7, 'Cheryl', 'Blake', '1970-11-23', 'F', 'kotimyp@mailinator.com', '09776029970', '$2y$10$bdavSmzdlLDl6UwWQNW8OevvA/hRDCh3fMpuq7vZQb8jv/.zlLYyi', '2021-06-22 20:11:11', '2021-07-16 01:51:49', NULL),
(8, 'Conan', 'Mcclure', '1998-12-01', 'M', 'woxy@mailinator.com', '09776029970', '$2y$10$5Ksg81gXaXk/wDH5sGAULet0MKyDSb6/kyZrVXdNTP.3A6ZQyiNH.', '2021-06-23 11:50:09', '2021-06-23 11:50:09', NULL),
(9, 'Elizabeth', 'Dillard', '2020-07-17', 'X', 'tyxypun@mailinator.com', '09776029970', '$2y$10$48xLfXK4hgcYHaLS.d7p7eTnLxz/bNuXC/srQYurU8pYCK4Awh6ZG', '2021-06-23 11:51:16', '2021-06-23 11:51:16', NULL),
(10, 'Louis', 'Flores', '1988-05-30', 'M', 'zudum@mailinator.com', '09776029970', '$2y$10$DKV975qhZsbzBofNPGaREe068X.n5t0fBLuw/zf9YjXe7aC2eItyK', '2021-06-23 13:25:50', '2021-06-24 02:53:37', '2021-06-24 02:53:37'),
(11, 'Keefe', 'Powell', '1982-09-15', 'F', 'sivolije@mailinator.com', '09776029970', '$2y$10$0WHwEb3/qd2Fh9nm6seXuu6VE5ydlHqi5iWIGzBkiqz8obOefetQO', '2021-06-23 14:24:11', '2021-06-24 02:53:36', '2021-06-24 02:53:36'),
(13, 'Quincy', 'Campbell', '1980-02-14', 'S', 'admin@admin.com', '09776029970', '$2y$10$UKdK9YI77D57pBkEWgADEOeCpWxySt2F95RebiNFx0LjuLuLth2kO', '2021-06-24 21:02:20', '2021-06-24 18:21:33', '2021-06-24 18:21:33'),
(14, 'Nayda', 'Head', '2010-10-15', 'M', 'benediwyh@mailinator.com', '09776029970', '$2y$10$vPmIdeGexLQ4llwUW3fPK.QGvA59N2u7Tfd3ESBZwfQk6trkEC.RK', '2021-06-24 21:54:39', '2021-06-24 08:55:01', '2021-06-24 08:55:01'),
(15, 'Jonas', 'Frost', '2013-12-02', 'S', 'vifesil@mailinator.com', '09776029970', '$2y$10$NBRxekb9iZCrpoSqJAccNuoe/PdVQIz0NKsi9BmhQ0ePiB/FuoUvu', '2021-06-24 22:17:07', '2021-06-24 22:17:07', NULL),
(16, 'Drew', 'Lindsey', '2009-04-29', 'M', 'besij@mailinator.com', '09776029970', '$2y$10$y6tXwFu2yEx7wJfOKYWPD./JgSTrL4L9YJBNkAWWlSKAPzfsqOkBu', '2021-06-24 22:20:17', '2021-06-24 22:20:17', NULL),
(17, 'Earl Janiel', 'Compra', '2000-09-07', 'M', 'compranicles@gmail.com', '09776029970', '$2y$10$BPy73QswvmuPpJn6mve4n.8.GmIlvEK80mFm60B0r33ajkOrQz54O', '2021-06-25 07:22:25', '2021-06-26 23:52:50', NULL),
(19, 'Lillith', 'Patrick', '1921-06-25', 'X', 'mebydima@mailinator.com', '09776029970', '$2y$10$N8RdFldWsQuV68OCt.Pnc.xwR2jylwknOlx7Y7XAuHEI98puABI3i', '2021-06-24 20:10:27', '2021-06-24 20:10:27', NULL),
(20, 'Orson', 'Bailey', '1921-07-22', 'X', 'jofarapat@mailinator.com', '12345678910', '$2y$10$Mc.jYcg4MD1rq4AcwunwvuJKB5PuONWq8MKCnWDoculReIIE75Zz6', '2021-07-15 22:47:12', '2021-07-16 02:07:42', NULL),
(21, 'Kenny', 'Rogers', '1964-09-19', 'M', 'email@email.com', '1234567890', '$2y$10$t9teFGcILpLUrWolc00TUOS9KiRcsmtOmnL91y/AGTMqA0vkOMxVK', '2021-07-17 13:23:18', '2021-07-17 13:23:18', NULL),
(22, 'Nehru', 'Gentry', '1921-07-21', 'M', 'jiligime@mailinator.com', '1234567890', '$2y$10$/KwHbymjN.Yk8OOZrEET2OTevvtRP51fa9ltRKSwjwbLTazCK2DSm', '2021-07-17 21:44:48', '2021-07-17 21:44:48', NULL),
(23, 'Andrew', 'Mccormick', '1921-07-20', 'S', 'saludu@mailinator.com', '12345678', '$2y$10$2oq9z.bOicS8NVW80eORY.KjCJptzNoI3YSkRrbsCtHYIkL0CyUc6', '2021-07-17 21:46:52', '2021-07-17 21:46:52', NULL),
(28, 'Elijah', 'Gentry', '1921-07-26', 'S', 'cotafono@mailinator.com', '12345678910', '$2y$10$aD5sfHzceSE5B6viMwn7nutsVuvBzHJSYEknFhBSIMPZOdqDKs37K', '2021-07-17 21:54:48', '2021-07-17 21:54:48', NULL),
(29, 'Susan', 'Little', '1921-07-21', 'S', 'bojuhaxyt@mailinator.com', '123456789', '$2y$10$02mXq2nErFIR.k9rzuPkoeUMms94WsxYhOpArZPOztZPcEnYKs9De', '2021-07-17 21:55:39', '2021-07-17 21:55:39', NULL),
(30, 'Berk', 'Rowland', '1921-07-23', 'S', 'siwo@mailinator.com', '123456789', '$2y$10$KyDo6Th032HudTHArQH7u.S58.qj1LATofUis4VWBf128b77GtSbO', '2021-07-17 21:57:04', '2021-07-17 21:57:04', NULL),
(31, 'Amos', 'Clark', '1978-07-28', 'F', 'giwibenyly@mailinator.com', '1234567890', '$2y$10$rXJD95/DuIqkFM8mF8FMzOEgtuJ3aD6BDgcpxzAtPtZIcyryOJSIC', '2021-07-18 11:29:03', '2021-07-18 11:29:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_access`
--

CREATE TABLE `user_access` (
  `user_access_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_access`
--

INSERT INTO `user_access` (`user_access_id`, `user_id`, `role_id`) VALUES
(4, 7, 3),
(5, 8, 3),
(6, 9, 3),
(13, 12, 3),
(14, 12, 2),
(15, 12, 2),
(16, 11, 3),
(18, 8, 1),
(21, 13, 1),
(22, 14, 4),
(24, 16, 2),
(25, 15, 3),
(26, 17, 1),
(27, 19, 3),
(29, 17, 2),
(30, 17, 3),
(31, 21, 3),
(32, 20, 3),
(33, 29, 3),
(34, 30, 3),
(36, 31, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `cancelled_reservations`
--
ALTER TABLE `cancelled_reservations`
  ADD PRIMARY KEY (`cancelled_reservation_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `payment_types`
--
ALTER TABLE `payment_types`
  ADD PRIMARY KEY (`payment_type_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`permission_id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`reservation_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `role_perm`
--
ALTER TABLE `role_perm`
  ADD PRIMARY KEY (`role_perm_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `room_status`
--
ALTER TABLE `room_status`
  ADD PRIMARY KEY (`room_status_id`);

--
-- Indexes for table `room_types`
--
ALTER TABLE `room_types`
  ADD PRIMARY KEY (`room_type_id`);

--
-- Indexes for table `shows`
--
ALTER TABLE `shows`
  ADD PRIMARY KEY (`show_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_access`
--
ALTER TABLE `user_access`
  ADD PRIMARY KEY (`user_access_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `cancelled_reservations`
--
ALTER TABLE `cancelled_reservations`
  MODIFY `cancelled_reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payment_types`
--
ALTER TABLE `payment_types`
  MODIFY `payment_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `permission_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `role_perm`
--
ALTER TABLE `role_perm`
  MODIFY `role_perm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `room_status`
--
ALTER TABLE `room_status`
  MODIFY `room_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `room_types`
--
ALTER TABLE `room_types`
  MODIFY `room_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `shows`
--
ALTER TABLE `shows`
  MODIFY `show_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `user_access`
--
ALTER TABLE `user_access`
  MODIFY `user_access_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
