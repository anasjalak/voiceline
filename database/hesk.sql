-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2025 at 01:49 AM
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
-- Database: `hesk`
--

-- --------------------------------------------------------

--
-- Table structure for table `hesk_tickets`
--

CREATE TABLE `hesk_tickets` (
  `id` int(8) UNSIGNED NOT NULL,
  `trackid` varchar(13) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(1000) NOT NULL DEFAULT '',
  `category` smallint(5) UNSIGNED NOT NULL DEFAULT 1,
  `priority` enum('0','1','2','3') NOT NULL DEFAULT '3',
  `subject` varchar(255) NOT NULL DEFAULT '',
  `message` mediumtext NOT NULL,
  `message_html` mediumtext DEFAULT NULL,
  `dt` timestamp NOT NULL DEFAULT '1999-12-31 14:00:00',
  `lastchange` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `firstreply` timestamp NULL DEFAULT NULL,
  `closedat` timestamp NULL DEFAULT NULL,
  `articles` varchar(255) DEFAULT NULL,
  `ip` varchar(45) NOT NULL DEFAULT '',
  `language` varchar(50) DEFAULT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `openedby` mediumint(9) DEFAULT 0,
  `firstreplyby` smallint(5) UNSIGNED DEFAULT NULL,
  `closedby` mediumint(9) DEFAULT NULL,
  `replies` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `staffreplies` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `owner` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `assignedby` mediumint(9) DEFAULT NULL,
  `time_worked` time NOT NULL DEFAULT '00:00:00',
  `lastreplier` enum('0','1') NOT NULL DEFAULT '0',
  `replierid` smallint(5) UNSIGNED DEFAULT NULL,
  `archive` enum('0','1') NOT NULL DEFAULT '0',
  `locked` enum('0','1') NOT NULL DEFAULT '0',
  `attachments` mediumtext NOT NULL,
  `merged` mediumtext NOT NULL,
  `history` mediumtext NOT NULL,
  `custom1` mediumtext NOT NULL,
  `due_date` timestamp NULL DEFAULT NULL,
  `overdue_email_sent` tinyint(1) DEFAULT 0,
  `satisfaction_email_sent` tinyint(1) DEFAULT 0,
  `satisfaction_email_dt` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hesk_tickets`
--

INSERT INTO `hesk_tickets` (`id`, `trackid`, `name`, `email`, `category`, `priority`, `subject`, `message`, `message_html`, `dt`, `lastchange`, `firstreply`, `closedat`, `articles`, `ip`, `language`, `status`, `openedby`, `firstreplyby`, `closedby`, `replies`, `staffreplies`, `owner`, `assignedby`, `time_worked`, `lastreplier`, `replierid`, `archive`, `locked`, `attachments`, `merged`, `history`, `custom1`, `due_date`, `overdue_email_sent`, `satisfaction_email_sent`, `satisfaction_email_dt`) VALUES
(1, 'ABC-123-XYZ', 'Ali Ahmed', 'ali@example.com', 1, '3', 'Login Issue', 'Cannot login to system', 'Cannot login to system', '2025-10-09 22:27:14', '2025-10-09 23:30:58', NULL, NULL, NULL, '192.168.1.10', 'English', 0, 0, NULL, NULL, 0, 0, 1, NULL, '00:00:00', '0', NULL, '0', '0', '', '', '', '1', NULL, 0, 0, NULL),
(2, 'DEF-456-UVW', 'Sara Khalid', 'sara@example.com', 2, '2', 'Email not working', 'Unable to send emails', 'Unable to send emails', '2025-10-09 22:27:14', '2025-10-09 23:31:03', NULL, NULL, NULL, '192.168.1.11', 'Arabic', 0, 0, NULL, NULL, 0, 0, 1, NULL, '00:00:00', '0', NULL, '0', '0', '', '', '', '2', NULL, 0, 0, NULL),
(3, 'GHI-789-RST', 'Omar Saleh', 'omar@example.com', 3, '1', 'Slow system', 'System performance is very slow', 'System performance is very slow', '2025-10-09 22:27:14', '2025-10-09 23:34:08', NULL, NULL, NULL, '192.168.1.12', 'English', 0, 0, NULL, NULL, 0, 0, 2, NULL, '00:00:00', '0', NULL, '0', '0', '', '', '', '4', NULL, 0, 0, NULL),
(4, 'JKL-321-OPQ', 'Huda Nasser', 'huda@example.com', 4, '3', 'Password reset', 'Forgot my password', 'Forgot my password', '2025-10-09 22:27:14', '2025-10-09 22:31:15', NULL, NULL, NULL, '192.168.1.13', 'English', 0, 0, NULL, NULL, 0, 0, 0, NULL, '00:00:00', '0', NULL, '0', '0', '', '', '', '1', NULL, 0, 0, NULL),
(5, 'MNO-654-LMN', 'Khaled Musa', 'khaled@example.com', 1, '2', 'Software crash', 'App crashes when opening', 'App crashes when opening', '2025-10-09 22:27:14', '2025-10-09 22:31:15', NULL, NULL, NULL, '192.168.1.14', 'Arabic', 0, 0, NULL, NULL, 0, 0, 0, NULL, '00:00:00', '0', NULL, '0', '0', '', '', '', '2', NULL, 0, 0, NULL),
(6, 'PQR-987-IJK', 'Nora Ali', 'nora@example.com', 2, '3', 'Network issue', 'Cannot connect to Wi-Fi', 'Cannot connect to Wi-Fi', '2025-10-09 22:27:14', '2025-10-09 22:31:15', NULL, NULL, NULL, '192.168.1.15', 'English', 0, 0, NULL, NULL, 0, 0, 0, NULL, '00:00:00', '0', NULL, '0', '0', '', '', '', '4', NULL, 0, 0, NULL),
(7, 'STU-159-HGF', 'Ahmad Faris', 'ahmad@example.com', 3, '1', 'Update error', 'Error during software update', 'Error during software update', '2025-10-09 22:27:14', '2025-10-09 22:31:15', NULL, NULL, NULL, '192.168.1.16', 'Arabic', 0, 0, NULL, NULL, 0, 0, 0, NULL, '00:00:00', '0', NULL, '0', '0', '', '', '', '1', NULL, 0, 0, NULL),
(8, 'VWX-753-EDC', 'Layla Hassan', 'layla@example.com', 4, '3', 'Printer not working', 'Printer not responding', 'Printer not responding', '2025-10-09 22:27:14', '2025-10-09 22:31:15', NULL, NULL, NULL, '192.168.1.17', 'English', 0, 0, NULL, NULL, 0, 0, 0, NULL, '00:00:00', '0', NULL, '0', '0', '', '', '', '1', NULL, 0, 0, NULL),
(9, 'YZA-852-CBA', 'Salma Yousef', 'salma@example.com', 1, '2', 'Access denied', 'Access denied to folder', 'Access denied to folder', '2025-10-09 22:27:14', '2025-10-09 22:31:15', NULL, NULL, NULL, '192.168.1.18', 'Arabic', 0, 0, NULL, NULL, 0, 0, 0, NULL, '00:00:00', '0', NULL, '0', '0', '', '', '', '1', NULL, 0, 0, NULL),
(10, 'BCD-951-ZYX', 'Faisal Zain', 'faisal@example.com', 2, '3', 'Database error', 'Cannot connect to database', 'Cannot connect to database', '2025-10-09 22:27:14', '2025-10-09 22:31:15', NULL, NULL, NULL, '192.168.1.19', 'English', 0, 0, NULL, NULL, 0, 0, 0, NULL, '00:00:00', '0', NULL, '0', '0', '', '', '', '1', NULL, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hesk_users`
--

CREATE TABLE `hesk_users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hesk_users`
--

INSERT INTO `hesk_users` (`id`, `name`, `email`, `role`) VALUES
(1, 'Ahmed Ali', 'ahmed@example.com', 'Support Agent'),
(2, 'Sara Mohamed', 'sara@example.com', 'Technician'),
(3, 'Khalid Hassan', 'khalid@example.com', 'Manager'),
(4, 'Unassigned', NULL, 'None');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hesk_tickets`
--
ALTER TABLE `hesk_tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hesk_users`
--
ALTER TABLE `hesk_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hesk_users`
--
ALTER TABLE `hesk_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
