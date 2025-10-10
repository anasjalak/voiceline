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
-- Database: `sis2`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cgpa_status`
--

CREATE TABLE `cgpa_status` (
  `cgpa_status_code` varchar(10) NOT NULL,
  `status_desc_e` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cgpa_status`
--

INSERT INTO `cgpa_status` (`cgpa_status_code`, `status_desc_e`) VALUES
('A', 'Excellent Standing'),
('B', 'Good Standing'),
('C', 'On Probation'),
('D', 'Dismissed');

-- --------------------------------------------------------

--
-- Table structure for table `course_desc`
--

CREATE TABLE `course_desc` (
  `course_code` varchar(20) NOT NULL,
  `course_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_desc`
--

INSERT INTO `course_desc` (`course_code`, `course_name`) VALUES
('1', 'Principles of Accounting'),
('10', 'Network Fundamentals'),
('2', 'Financial Accounting'),
('3', 'Introduction to Programming'),
('4', 'Data Structures'),
('5', 'Algorithms'),
('6', 'Circuits I'),
('7', 'Digital Logic'),
('8', 'Corporate Finance'),
('9', 'Database Systems');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `faculty_code` varchar(10) NOT NULL,
  `abbreviation` varchar(20) NOT NULL,
  `faculty_name` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`faculty_code`, `abbreviation`, `faculty_name`) VALUES
('BUS', 'Business', 'Business'),
('CS', 'CompSci', 'CompSci'),
('ENG', 'Engineering', 'Engineering'),
('LAW', 'Law', 'Law'),
('MED', 'Medicine', 'Medicine');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hesk_tickets`
--

CREATE TABLE `hesk_tickets` (
  `id` int(11) NOT NULL,
  `trackid` varchar(20) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `priority` tinyint(4) NOT NULL,
  `custom1` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hesk_tickets`
--

INSERT INTO `hesk_tickets` (`id`, `trackid`, `subject`, `status`, `priority`, `custom1`) VALUES
(1, 'TCK-1001', 'Password Reset Request', 0, 1, 1),
(2, 'TCK-1002', 'Can’t access portal', 1, 2, 2),
(3, 'TCK-1003', 'Exam schedule issue', 1, 4, 3),
(4, 'TCK-1004', 'Transcript request', 2, 3, 4),
(5, 'TCK-1005', 'Account suspended', 0, 1, 5),
(6, 'TCK-1006', 'Library card renewal', 1, 2, 1),
(7, 'TCK-1007', 'Grade not updated', 0, 4, 2),
(8, 'TCK-1008', 'Change email address', 2, 3, 3),
(9, 'TCK-1009', 'Internship approval', 1, 2, 4),
(10, 'TCK-1010', 'Course registration', 0, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `hesk_users`
--

CREATE TABLE `hesk_users` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `user` varchar(255) NOT NULL DEFAULT '',
  `pass` varchar(255) NOT NULL DEFAULT '',
  `isadmin` enum('0','1') NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `signature` varchar(1000) NOT NULL DEFAULT '',
  `language` varchar(50) DEFAULT NULL,
  `categories` varchar(500) NOT NULL DEFAULT '',
  `afterreply` enum('0','1','2') NOT NULL DEFAULT '0',
  `autostart` enum('0','1') NOT NULL DEFAULT '1',
  `autoreload` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `notify_customer_new` enum('0','1') NOT NULL DEFAULT '1',
  `notify_customer_reply` enum('0','1') NOT NULL DEFAULT '1',
  `show_suggested` enum('0','1') NOT NULL DEFAULT '1',
  `notify_new_unassigned` enum('0','1') NOT NULL DEFAULT '1',
  `notify_new_my` enum('0','1') NOT NULL DEFAULT '1',
  `notify_reply_unassigned` enum('0','1') NOT NULL DEFAULT '1',
  `notify_reply_my` enum('0','1') NOT NULL DEFAULT '1',
  `notify_assigned` enum('0','1') NOT NULL DEFAULT '1',
  `notify_pm` enum('0','1') NOT NULL DEFAULT '1',
  `notify_note` enum('0','1') NOT NULL DEFAULT '1',
  `notify_overdue_unassigned` enum('0','1') NOT NULL DEFAULT '1',
  `notify_overdue_my` enum('0','1') NOT NULL DEFAULT '1',
  `default_list` varchar(255) NOT NULL DEFAULT '',
  `autoassign` enum('0','1') NOT NULL DEFAULT '1',
  `heskprivileges` varchar(1000) DEFAULT NULL,
  `ratingneg` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `ratingpos` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `rating` float NOT NULL DEFAULT 0,
  `replies` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `mfa_enrollment` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `mfa_secret` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hesk_users`
--

INSERT INTO `hesk_users` (`id`, `user`, `pass`, `isadmin`, `name`, `email`, `signature`, `language`, `categories`, `afterreply`, `autostart`, `autoreload`, `notify_customer_new`, `notify_customer_reply`, `show_suggested`, `notify_new_unassigned`, `notify_new_my`, `notify_reply_unassigned`, `notify_reply_my`, `notify_assigned`, `notify_pm`, `notify_note`, `notify_overdue_unassigned`, `notify_overdue_my`, `default_list`, `autoassign`, `heskprivileges`, `ratingneg`, `ratingpos`, `rating`, `replies`, `mfa_enrollment`, `mfa_secret`) VALUES
(1, 'Mohammed Abuelgassim', '$2y$10$IKneUuplJTAm3REqI0AOQOfKGdlYNSKnP5.D2gTDKff8dmNnOA6Vi', '1', 'Mohammed Abuelgassim', 'mohammed.beng@gmail.com', '', NULL, '', '0', '1', 0, '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '', '0', '', 0, 1, 5, 20, 0, NULL),
(2, 'khalidkaradh', '$2y$10$ZYT8VwYXpDogsi0ntP2SVONRMgl1d89GyedZIxHr5gp3pRjttMuDi', '1', 'Khalid Sheikhidris Mohamed', 'khalidkaradh@fu.edu.sd', '~~~~~~~~~~~~~~~~~~\r\nKhalid \r\n\r\nCTS | IRDC\r\nkhalidkaradh@fu.edu.sd\r\n~~~~~~~~~~~~~~~~~~', NULL, '', '0', '1', 0, '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '', '0', '', 90, 318, 4.11765, 3569, 0, NULL),
(3, 'kawther', '$2y$10$VJKmpwZwhtQsls6BGuvFWOiHWVCCy7OtDnVCPD5biGLWGmtUwtsu2', '0', 'Kawther Abu-Elnaja', 'kawtherabuelnaja@fu.edu.sd', '', NULL, '19,3,2,1,28,24,26,30', '0', '1', 0, '1', '1', '1', '0', '0', '0', '0', '1', '1', '1', '0', '0', '', '0', 'can_view_tickets,can_reply_tickets,can_resolve,can_submit_any_cat,can_assign_self,can_assign_others,can_view_online,can_view_tickets', 26, 67, 3.88172, 603, 0, NULL),
(4, 'drisam', '$2y$10$0HWxXyKwiI8/21iZBbxXVe1dMYJOSJHiVCTYVQPcDQQs9x6ewlkeW', '0', 'Isameldeen Mohamed Khair', 'vpa@fu.edu.sd', '', NULL, '19,17,3,2,1,14,18,22,16,21,24,25,26,23,30', '0', '1', 0, '1', '1', '1', '0', '0', '0', '0', '0', '0', '0', '0', '0', '', '0', 'can_view_tickets,can_reply_tickets,can_resolve,can_submit_any_cat,can_change_cat,can_change_own_cat,can_assign_self,can_assign_others,can_view_unassigned,can_view_ass_others,can_view_ass_by,can_run_reports_full,can_view_online,can_view_tickets', 64, 146, 3.78095, 1226, 0, NULL),
(5, 'capuno', '$2y$10$uIuqQZnigSh9t4x4UmUxy.1fIDqQ3Wc0.cnNOUQWZQl2SyZ2D1xLS', '0', 'Emmalyn Capuno', 'emmalyncapuno@fu.edu.sd', '', NULL, '19,17,3,2,14,18,16,21,22,23,26', '0', '1', 0, '1', '1', '1', '0', '0', '0', '0', '1', '1', '1', '0', '0', '', '0', 'can_view_tickets,can_reply_tickets,can_resolve,can_submit_any_cat,can_change_own_cat,can_assign_self,can_assign_others,can_view_online,can_view_tickets', 1, 2, 3.66667, 18, 0, NULL),
(6, 'mohanned', '$2y$10$vzU6E.NSqDnpFHspueJvLeVsTMN1sRZGNm/cgNOZhn37jIEPC.Rya', '0', 'Mohanned Azhary', 'mohannadazhary@fu.edu.sd', '', NULL, '3,23,25,26', '0', '1', 0, '1', '1', '1', '0', '0', '0', '0', '1', '1', '1', '0', '0', '', '0', 'can_view_tickets,can_reply_tickets,can_resolve,can_submit_any_cat,can_change_cat,can_assign_self,can_assign_others,can_view_online,can_view_tickets', 27, 31, 3.13793, 383, 1, NULL),
(7, 'mazinbilail', '$2y$10$FaBtnH2V.nuHpiIUiibJIu3/atzaKHQa4WvUFEtPruPJd0q22kcNy', '0', 'Mazin Bilail', 'mazinbilail@fu.edu.sd', '', NULL, '1,17,3,2,18,16,23,26', '0', '1', 0, '1', '1', '1', '0', '0', '0', '0', '1', '1', '1', '0', '0', '', '0', 'can_view_tickets,can_reply_tickets,can_resolve,can_submit_any_cat,can_assign_self,can_assign_others,can_view_online,can_view_tickets', 0, 0, 0, 0, 0, NULL),
(8, 'hussam', '$2y$10$75iN.kddZN8IbOGCHJXzVO36mxtHPtjAv6s/hqBhCbFFyfiAi6NXO', '0', 'Hussam Mohamed', 'hussam.mohammed@fu.edu.sd', '', NULL, '19,17,3,2,18,24', '0', '1', 0, '1', '1', '1', '0', '0', '0', '0', '1', '1', '1', '0', '0', '', '1', 'can_view_tickets,can_reply_tickets,can_resolve,can_submit_any_cat,can_assign_self,can_assign_others,can_view_ass_others,can_view_online,can_view_tickets', 127, 294, 3.79335, 3562, 0, NULL),
(9, 'samir', '$2y$10$98u72PGJN0z2YWPwYTg06OPWf1CFKBFkbjd21dJl/VjfcQ6Bl897a', '0', 'Samir Adam', 'sameeradam@fu.edu.sd', '', NULL, '19,17,3,2,14,18,22,16,21,24,26,30', '0', '1', 0, '1', '1', '1', '0', '0', '0', '0', '1', '1', '1', '0', '0', 's0=1&s1=1&s2=1&s3=1&s4=1&s5=1&s6=1&s7=1&s8=1&p0=1&p1=1&p2=1&p3=1&s_my=1&archive=1&sort=status&g=&duedate_option=specific&duedate_specific_date=&duedate_amount_value=&duedate_amount_unit=day&category=16&limit=20&asc=1&cot=1&more=1', '0', 'can_view_tickets,can_reply_tickets,can_resolve,can_submit_any_cat,can_assign_self,can_assign_others,can_view_online,can_view_tickets', 0, 4, 5, 31, 0, NULL),
(10, 'salah', '$2y$10$mM67ccweB3KsOmnWaGI2rumT1Gx9A6OzqcwAlSPkonp1GXaZr.TWa', '0', 'Salah Hassan Malik', 'salah_malik@fu.edu.sd', '', NULL, '19,17,3,2,1,14,18,22,16,21,24,26,30', '0', '1', 0, '1', '1', '1', '0', '0', '0', '0', '1', '1', '1', '0', '0', '', '0', 'can_view_tickets,can_reply_tickets,can_resolve,can_submit_any_cat,can_assign_self,can_assign_others,can_view_online,can_view_tickets', 24, 71, 3.98947, 619, 0, NULL),
(11, 'jake', '$2y$10$PoKXZ1bbwY4zTIgQbvMigefuki4sFDWqa4CB2YcU3q6WmgEYxYela', '0', 'Jake Evangelista', 'j_evangelista@fu.edu.sd', '', NULL, '19,17,3,2,14,18,22,16,21,24,26,30', '0', '1', 0, '1', '1', '1', '0', '0', '0', '0', '1', '1', '1', '0', '0', '', '0', 'can_view_tickets,can_reply_tickets,can_resolve,can_submit_any_cat,can_assign_self,can_assign_others,can_view_online,can_view_tickets', 8, 20, 3.85714, 146, 1, NULL),
(12, 'nawal', '$2y$10$cNCMLpGQfEhqN/OSHW.CtuLqGeF0N2Y6hGbXc4Wmu1sr.M/rwMFw2', '0', 'Nawal Ibrahim', 'nawalibrahim@fu.edu.sd', '', NULL, '19,17,3,2,14,18,22,16,24,26,30', '0', '1', 0, '1', '1', '1', '0', '0', '0', '0', '1', '1', '1', '0', '0', '', '0', 'can_view_tickets,can_reply_tickets,can_resolve,can_submit_any_cat,can_assign_self,can_assign_others,can_view_online,can_view_tickets', 14, 35, 3.85714, 370, 0, NULL),
(13, 'mutaz', '$2y$10$f9mpJM6NAqvsAvMJC70wZeoCcHj.j8c93kZgqT./FIO7Cr6kQWtN.', '0', 'Mutaz Hamad Hussien', 'mutaz_hamed@fu.edu.sd', '', NULL, '19,17,3,2,1,14,18,16,21,24,26,30', '0', '1', 0, '1', '1', '1', '0', '0', '0', '0', '1', '1', '1', '0', '0', '', '0', 'can_view_tickets,can_reply_tickets,can_resolve,can_submit_any_cat,can_assign_self,can_assign_others,can_view_online,can_view_tickets', 38, 106, 3.94445, 1165, 0, NULL),
(14, 'mylene', '$2y$10$9otBP.skI3gEie8onGbNZOeYcxQBvXHmN8S90mYPK1SDBjX8Dlb9i', '0', 'Mylene Evangelista', 'myleneevangelista@fu.edu.sd', '', NULL, '19,17,3,2,14,18,22,16,21,24,26,30', '0', '1', 0, '1', '1', '1', '0', '0', '0', '0', '1', '1', '1', '0', '0', '', '0', 'can_view_tickets,can_reply_tickets,can_resolve,can_submit_any_cat,can_assign_self,can_assign_others,can_view_online,can_view_tickets', 9, 33, 4.14286, 261, 1, NULL),
(15, 'zeinab', '$2y$10$4a/7Ri6avrbGHRJd6oT60..aZBckTTiUZXKEaK6bcUeAJ3bu0GlhC', '0', 'Zeinab Sedahmed', 'zeinab_sedahmed@fu.edu.sd', '', NULL, '19,17,3,2,14,18,22,16,21,24,26,30', '0', '1', 0, '1', '1', '1', '0', '0', '0', '0', '1', '1', '1', '0', '0', '', '0', 'can_view_tickets,can_reply_tickets,can_resolve,can_submit_any_cat,can_assign_self,can_assign_others,can_view_online,can_view_tickets', 0, 5, 5, 96, 0, NULL),
(16, 'tahassan', '$2y$10$AFpda5v2U3IhHg0y7IKHbuJKOFv04rb2pSpszAS4mV/7VukKbcnVG', '0', 'Eltayeb Ahmed Hassan Haroun', 'eltayeb.haroun@fu.edu.sd', 'Eltayeb Ahmed Hassan, FPGS\r\neltayeb.haroun@fu.edu.sd\r\n+249912239610\r\n----------------------------------', NULL, '19,17,3,2,1,14,18,22,16,21,26,30', '1', '1', 0, '1', '1', '1', '0', '1', '0', '1', '1', '1', '1', '0', '0', '', '0', 'can_view_tickets,can_reply_tickets,can_resolve,can_submit_any_cat,can_assign_self,can_assign_others,can_view_online,can_view_tickets', 1, 5, 4.33333, 25, 0, NULL),
(17, 'armin', '$2y$10$9y6ajp35q2mjwNyLR8rTG.JaE//yzhaxBcYzchUxO3UQ2EjYqUPbe', '0', 'Armin Argoncillo', 'arminaragoncillo@gmail.com', '', NULL, '19,17,3,2,14,18,22,16,21,24,26,30', '0', '1', 0, '1', '1', '1', '0', '0', '0', '0', '1', '1', '1', '0', '0', '', '0', 'can_view_tickets,can_reply_tickets,can_resolve,can_submit_any_cat,can_assign_self,can_assign_others,can_view_online,can_view_tickets', 0, 12, 5, 53, 1, NULL),
(18, 'ghassan', '$2y$10$dFL/14jhZCb2N86Xa9eX4ed4EtAqfmSdzFfvsHrOCZfUdcr19VFx2', '0', 'Dr. Ghassan Abubaker Mustafa', 'president@fu.edu.sd', '', NULL, '3,23', '0', '1', 0, '1', '1', '1', '0', '0', '0', '0', '1', '1', '1', '0', '0', '', '0', 'can_view_tickets,can_reply_tickets,can_edit_tickets,can_resolve,can_submit_any_cat,can_change_cat,can_due_date,can_assign_self,can_assign_others,can_view_unassigned,can_view_ass_others,can_view_ass_by,can_run_reports_full,can_view_online,can_view_tickets', 7, 40, 4.40425, 240, 0, NULL),
(19, 'drabubaker', '$2y$10$Gt9t07Y64QEqCzCWpjjH9OaBmXyxVBTGRGmYEAItkLr7PPlBvQoB.', '0', 'Dr. Abubaker Mustafa', 'chairman@fu.edu.sd', '', NULL, '3,23', '0', '1', 0, '1', '1', '1', '0', '0', '0', '0', '1', '1', '1', '0', '0', '', '0', 'can_view_tickets,can_reply_tickets,can_resolve,can_submit_any_cat,can_change_cat,can_due_date,can_assign_others,can_view_unassigned,can_view_ass_others,can_view_ass_by,can_run_reports_full,can_view_online,can_view_tickets', 0, 0, 0, 0, 1, NULL),
(37, 'mahmoud', '$2y$10$D5s7uDf2/nIIY3tEqbDUZuAStr/3yR6UvLsjbCQD1vwA24wCIk.mi', '0', 'Mahmoud Salih', 'm.salih@fu.edu.sd', '', NULL, '19,14,18,16,21,24,26', '0', '1', 0, '1', '1', '1', '0', '0', '0', '0', '1', '1', '1', '0', '0', '', '0', 'can_view_tickets,can_reply_tickets,can_resolve,can_submit_any_cat,can_assign_self,can_assign_others,can_view_online,can_view_tickets', 0, 0, 0, 1, 1, NULL),
(20, 'mazinkhalafalla', '$2y$10$FaXirwTW/JH3Yeq.YFzzdOzllWaJXNMB/D9Y3pJ0StBJKInRxg7HG', '0', 'Mazen Khalafalla', 'mazenkhalafalla@fu.edu.sd', '', NULL, '19,17,3,2,1,14,18,22,21,24,25,26,27,30', '0', '1', 0, '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '', '1', 'can_view_tickets,can_reply_tickets,can_edit_tickets,can_resolve,can_submit_any_cat,can_change_cat,can_assign_self,can_assign_others,can_view_unassigned,can_view_ass_others,can_view_ass_by,can_view_online,can_view_tickets', 153, 184, 3.18398, 3963, 0, NULL),
(21, 'samwal', '$2y$10$OqSI1tSxvcb1ZS7r0b8T9OGfbl8FB2XMVtN.x7v1.k9Irx/e69VCK', '0', 'Smwal Abdelrahim', 'smwal.abdelrahim@gmail.com', '', NULL, '8', '0', '1', 0, '1', '1', '1', '0', '0', '0', '0', '1', '1', '1', '0', '0', '', '0', 'can_view_tickets,can_reply_tickets,can_resolve,can_submit_any_cat,can_assign_self,can_assign_others,can_view_online,can_view_tickets', 4, 22, 4.38462, 125, 1, NULL),
(22, 'asaad', '$2y$10$BLuH8UVPd9E7CdkzHu/uoezzru/ux66VnSIKYMWuhsXCa1I5TBP1q', '0', 'Asaad Babikir', 'asaadeid@fu.edu.sd', '', NULL, '19,17,3,2,14,18,22,16,21,26,30', '0', '1', 0, '1', '1', '1', '0', '0', '0', '0', '1', '1', '1', '0', '0', '', '0', 'can_view_tickets,can_reply_tickets,can_resolve,can_submit_any_cat,can_assign_self,can_assign_others,can_view_online,can_view_tickets', 2, 14, 4.5, 171, 0, NULL),
(23, 'hala', '$2y$10$In34BWAhp0X.clWXAHO9K.rT9C6oq05AH02KVFUT0iCznDwIJEKYG', '0', 'Hala Rodwan', 'halygeo563@gmail.com', '', NULL, '9', '0', '1', 0, '1', '1', '1', '0', '0', '0', '0', '1', '1', '1', '0', '0', '', '0', 'can_view_tickets,can_reply_tickets,can_resolve,can_submit_any_cat,can_assign_self,can_assign_others,can_view_online,can_view_tickets', 1, 1, 3, 34, 1, NULL),
(24, 'sarah', '$2y$10$JjqhHtdHwIjgy2KN2KCu0ug.mkQSVsi6vwP3lD1LV7MvIB25IsYN.', '0', 'Sarah Omer', 'sarah_omer@fu.edu.sd', '', NULL, '19,17,3,14,18,9,26', '0', '1', 0, '1', '1', '1', '0', '0', '0', '0', '1', '1', '1', '0', '0', '', '0', 'can_view_tickets,can_reply_tickets,can_resolve,can_submit_any_cat,can_assign_self,can_assign_others,can_view_online,can_view_tickets', 31, 74, 3.81905, 682, 0, NULL),
(25, 'enas', '$2y$10$dJmzQ.s0cLEPV8mxQr945uJzMaXctbqiBOSSfXouC4YAKTezMC7IG', '0', 'Enas Osman', 'enas.osman@fu.edu.sd', '', NULL, '15,1,2', '0', '1', 0, '1', '1', '1', '0', '0', '0', '0', '1', '1', '1', '0', '0', '', '0', 'can_view_tickets,can_reply_tickets,can_resolve,can_submit_any_cat,can_assign_self,can_assign_others,can_view_online,can_view_tickets', 0, 2, 5, 27, 0, NULL),
(26, 'rania', '$2y$10$m7v58X1Pq5mb0qWRDMdzGeckaFqHBsA.Bx0j43Jgt6O0BLyjcF3a.', '0', 'Rania', 'raniacmc@gmail.com', '', NULL, '11', '0', '1', 0, '1', '1', '1', '0', '0', '0', '0', '1', '1', '1', '0', '0', '', '0', 'can_view_tickets,can_reply_tickets,can_resolve,can_submit_any_cat,can_assign_self,can_assign_others,can_view_online,can_view_tickets', 0, 0, 0, 0, 1, NULL),
(27, 'manatalla', '$2y$10$k.VadB7/0u5tyZRshW9X4OmFhHTjT81d3etwE64eviRnmsdWS9I92', '0', 'Manatalla Mamoun', 'manatallamamoun@gmail.com', '', NULL, '8', '0', '1', 0, '1', '1', '1', '0', '0', '0', '0', '1', '1', '1', '0', '0', '', '0', 'can_view_tickets,can_reply_tickets,can_resolve,can_submit_any_cat,can_assign_self,can_assign_others,can_view_online,can_view_tickets', 2, 1, 2.33333, 16, 1, NULL),
(28, 'sara', '$2y$10$ubMvDPuxVqHaNFdIgjHrzufR3.YnZecqj/4Kdfve6MyHp8QRSBHpq', '0', 'Sara Mohamed', 'Saramohd80@hotmail.com', '', NULL, '15,1,2', '0', '1', 0, '1', '1', '1', '0', '0', '0', '0', '1', '1', '1', '0', '0', '', '0', 'can_view_tickets,can_reply_tickets,can_resolve,can_submit_any_cat,can_assign_self,can_assign_others,can_view_online,can_view_tickets', 0, 0, 0, 11, 1, NULL),
(30, 'kamil', '$2y$10$si7e8DwYtevX7zVhllDP/e/cILXOyWIZqWcJmgcMtyzLnSd/uIKd2', '0', 'Kamil Ahmed Mohamed', 'kamil@fu.edu.sd', 'Kamil Ahmed Mohamed\r\n\r\nkamil@fu.edu.sd\r\nAccounts Director\r\nFinance Department', NULL, '19,17,3,2,18,26', '0', '1', 0, '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '', '0', 'can_view_tickets,can_reply_tickets,can_resolve,can_submit_any_cat,can_assign_self,can_assign_others,can_view_ass_others,can_view_online,can_view_tickets', 55, 181, 4.06779, 2033, 0, NULL),
(31, 'salma', '$2y$10$c8C4bLQCPZWASa6cfwY38u7eE4UJMOiAulf1.KLE6WraI40HBkMU6', '0', 'Salma El-Yas', 'salmaeliasalamin@gmail.com', '', NULL, '12', '0', '1', 0, '1', '1', '1', '0', '0', '0', '0', '1', '1', '1', '0', '0', '', '0', 'can_view_tickets,can_reply_tickets,can_resolve,can_submit_any_cat,can_assign_self,can_assign_others,can_view_online,can_view_tickets', 0, 0, 0, 0, 1, NULL),
(32, 'mutazmonem', '$2y$10$MO5JMYGvquYcF49aQWfhpOcE96UihV3vSchnFnuZPaKIh9n/yb/QO', '0', 'Mutaz Abd El-Monem', 'motauzabdelmonem@fu.edu.sd', '', NULL, '15,1,19,17,3,2,14,18,4,5,6,7,8,9,10,11,12,22', '0', '1', 0, '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '', '0', 'can_view_tickets,can_reply_tickets,can_edit_tickets,can_resolve,can_submit_any_cat,can_change_cat,can_assign_self,can_assign_others,can_view_unassigned,can_view_ass_others,can_view_ass_by,can_run_reports_full,can_view_online,can_view_tickets', 57, 93, 3.48, 2400, 1, NULL),
(33, 'hadeel_elmutasim', '$2y$10$5OFBddqnSijUoNCwtixpDekbHFj46caF1F0pjNvHwruXbgK7dut.6', '0', 'Hadeel Elmutasim', 'hadeelelmutasim303@gmail.com', '', NULL, '14,16,21', '0', '1', 0, '1', '1', '1', '0', '0', '0', '0', '1', '1', '1', '0', '0', '', '0', 'can_view_tickets,can_reply_tickets,can_resolve,can_submit_any_cat,can_change_cat,can_assign_self,can_assign_others,can_view_unassigned,can_view_ass_others,can_view_ass_by,can_view_online,can_view_tickets', 0, 3, 5, 84, 1, NULL),
(34, 'asmaa', '$2y$10$NKoo7G71vkuN/rN/eJdSWehiFRVe/ptKcIxD62XdRIOdxsVlfep2K', '0', 'Asmaa Aamir', 'asmaa_aamir@fu.edu.sd', '', NULL, '19,17,3,2,1,14,18,22,30', '0', '1', 0, '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '', '1', 'can_view_tickets,can_reply_tickets,can_resolve,can_submit_any_cat,can_change_cat,can_assign_self,can_assign_others,can_view_unassigned,can_view_ass_others,can_view_ass_by,can_view_online,can_view_tickets', 108, 101, 2.93301, 2068, 1, NULL),
(35, 'muhaira', '$2y$10$wusWZ36XblLxu0Q7bNSds.nTZbpkZvTdRRCSv9fThuLfZf8qaU6l.', '0', 'Muhaira El-Sharief', 'muhaira.sharief@fu.edu.sd', '', NULL, '15,1,19,17,3,2,14,18,4,5,6,7,8,9,10,11,12,22', '0', '1', 0, '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '', '0', 'can_view_tickets,can_reply_tickets,can_resolve,can_submit_any_cat,can_change_cat,can_assign_self,can_assign_others,can_view_online,can_view_tickets', 0, 0, 0, 2, 1, NULL),
(38, 'fatima_ezzalddin', '$2y$10$Khe8dl8mc6zStDOXUJYd.eTnP/916h9v8J8CERs1ZDKnhPKBBcqb6', '0', 'Fatima Ezzaddin', 'Fatima_ezzaddin@fu.edu.sd', '', NULL, '19,17,18,9,21', '0', '1', 0, '1', '1', '1', '0', '0', '0', '0', '1', '1', '1', '0', '0', '', '0', 'can_view_tickets,can_reply_tickets,can_resolve,can_submit_any_cat,can_change_own_cat,can_assign_self,can_assign_others,can_view_online,can_view_tickets', 0, 0, 0, 3, 0, NULL),
(46, 'nahlaabdulrazig', '$2y$10$lD8Jo5pl05oime3q671nz.iRQxTvM9h4vvgSmHdz5Yt.07lWzHFBS', '0', 'Mrs. Nahla A. Raziq', 'nahlaabdulrazig@fu.edu.sd', '', NULL, '19,17,3,2,1,14,18,21,26', '0', '1', 0, '1', '1', '1', '0', '1', '0', '1', '1', '1', '1', '0', '1', '', '0', 'can_view_tickets,can_reply_tickets,can_resolve,can_submit_any_cat,can_change_own_cat,can_assign_others,can_view_online,can_view_tickets', 0, 0, 0, 0, 0, NULL),
(36, 'sayda', '$2y$10$UwoyaogAJUbqWboEYVcMR.WTP5rPfXdz5KqhxwdU3umDApLAEd1eW', '0', 'Sayda Mamoun', 'sayda@fu.edu.sd', '', NULL, '19,17,3,2,1,18,22,16,21,26,30', '0', '1', 0, '1', '1', '1', '0', '0', '0', '0', '1', '1', '1', '0', '0', '', '0', 'can_view_tickets,can_reply_tickets,can_resolve,can_submit_any_cat,can_assign_self,can_assign_others,can_view_online,can_view_tickets', 0, 0, 0, 2, 1, NULL),
(41, 'mona', '$2y$10$wRWbJENY926oP5GDuthA8OxVDnTy5YUAog8MYijimgK1h833NHbCG', '0', 'Mona Abusin', 'monaabusin@fu.edu.sd', '', NULL, '19,17,3,2,18,7,21', '0', '1', 0, '1', '1', '1', '0', '0', '0', '0', '1', '1', '1', '0', '0', '', '0', 'can_view_tickets,can_reply_tickets,can_resolve,can_submit_any_cat,can_change_own_cat,can_assign_self,can_assign_others,can_view_online,can_view_tickets', 0, 1, 5, 10, 0, NULL),
(39, 'segood', '$2y$10$wLDMmaySYvWq5DTRwxr6ruay6mWXCArWExuwzP.76G7/uCpB99bby', '0', 'Segood Awad', 'segoodawad93@gmail.com', '', NULL, '19,17,3,18', '0', '1', 0, '1', '1', '1', '0', '0', '0', '0', '1', '1', '1', '0', '0', '', '0', 'can_view_tickets,can_reply_tickets,can_resolve,can_submit_any_cat,can_change_own_cat,can_assign_self,can_assign_others,can_view_online,can_view_tickets', 0, 0, 0, 5, 0, NULL),
(40, 'abeer', '$2y$10$2cFXwaHJGJNQvSKGF3r0guRU4vfL0n0PMq5KdowWQPW4BOPUyK.86', '0', 'Abeer Karem', 'abeerkarem31@gmail.com', '', NULL, '19,17,3,18', '0', '1', 0, '1', '1', '1', '0', '0', '0', '0', '1', '1', '1', '0', '0', '', '0', 'can_view_tickets,can_reply_tickets,can_resolve,can_submit_any_cat,can_change_own_cat,can_assign_self,can_assign_others,can_view_online,can_view_tickets', 1, 1, 3, 35, 0, NULL),
(42, 'fatooh', '$2y$10$An99zs.uJNPq27xqMpAWm.gOrRVnDgteqxdTKMYfZWOZ9dhXNqreC', '0', 'Fath El-Rahman Jaweesh', 'fatohjaweesh@fu.edu.sd', '', NULL, '19,17,3,18,26', '0', '1', 0, '1', '1', '1', '0', '0', '0', '0', '1', '1', '1', '0', '0', '', '0', 'can_view_tickets,can_reply_tickets,can_resolve,can_submit_any_cat,can_change_own_cat,can_assign_self,can_assign_others,can_view_ass_others,can_view_ass_by,can_view_online,can_view_tickets', 0, 1, 5, 21, 0, NULL),
(43, 'sarah_shams', '$2y$10$5VeL6Dg0wDFN95I81tQACOAxAtuguxFBpZn0p.Ms4EKBjss1X36va', '0', 'Sarah Shams El-Dein', 'Sara.Shams989@hotmail.com', '', NULL, '19,17,3,18,21,26', '0', '1', 0, '1', '1', '1', '0', '0', '0', '0', '1', '1', '1', '0', '0', '', '0', 'can_view_tickets,can_reply_tickets,can_resolve,can_submit_any_cat,can_change_cat,can_assign_self,can_assign_others,can_view_online,can_view_tickets', 0, 0, 0, 1, 0, NULL),
(44, 'dina.haridi', '$2y$10$XMHXEZ3sN79wBEotIP6ZP.rcEPJSCC0DjSyYI62ZKgXlPbLabbvTm', '0', 'Mrs. Dina Haridi', 'dina.haridi@fu.edu.sd', '~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\r\nMrs. Dina Haridi\r\ndina.haridi@fu.edu.sd\r\nAdmission and Registration Department\r\nFuture University Sudan\r\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~', NULL, '15,1,2', '0', '1', 0, '1', '1', '1', '0', '0', '0', '0', '1', '1', '1', '0', '0', '', '0', 'can_view_tickets,can_reply_tickets,can_resolve,can_submit_any_cat,can_assign_self,can_assign_others,can_view_online,can_view_tickets', 0, 0, 0, 8, 0, NULL),
(45, 'bahaamutall', '$2y$10$w.GKywM3X4.P6lWX/LEsJee1jsEWCHtUWTtOawO/bPN2/HoKX.ydC', '0', 'Bahaa Abdel Mutaal', 'bahaamutall@fu.edu.sd', 'Mr. Bahaa Abdel Mutaal\r\n\r\nbahaamutall@fu.edu.sd\r\nAssistant Maintenance Engineer\r\nCenter of Technical Services (CTS)\r\nFuture University.', NULL, '19,17,3,2,1,14,18,22,21,24,26,27,30', '0', '1', 0, '1', '1', '1', '0', '0', '0', '0', '1', '1', '1', '0', '0', '', '1', 'can_view_tickets,can_reply_tickets,can_resolve,can_submit_any_cat,can_change_cat,can_change_own_cat,can_assign_self,can_assign_others,can_view_unassigned,can_view_ass_others,can_view_ass_by,can_view_online,can_view_tickets', 4, 7, 3.54545, 240, 0, NULL),
(47, 'zeinab.idris', '$2y$10$Us4ZO4HbfHdNI7Bhz0HhEuq9EtE/lJv/DS0lpQrVq6/I47V9aGhCG', '0', 'Zeinab Idris', 'zeinab.edris@fu.edu.sd', '', NULL, '19,14,25', '0', '1', 0, '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '', '0', 'can_view_tickets,can_reply_tickets,can_resolve,can_submit_any_cat,can_change_own_cat,can_assign_others,can_view_online,can_view_tickets', 0, 0, 0, 0, 0, NULL),
(48, 'ghazi', '$2y$10$BcFFZqb1ReW.v9ZxUDNWie7LmvO/3Amcm7p0X.wqwBkOjHfHNW0Pe', '0', 'Ghazi Abdallah', 'ghazi.abdallah@fu.edu.sd', '', NULL, '19,17,3', '0', '1', 0, '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '', '0', 'can_view_tickets,can_view_unassigned,can_view_ass_others,can_view_online', 0, 0, 0, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `major`
--

CREATE TABLE `major` (
  `major_code` varchar(10) NOT NULL,
  `faculty_code` varchar(10) NOT NULL,
  `abbreviation` varchar(20) NOT NULL,
  `major_name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `major`
--

INSERT INTO `major` (`major_code`, `faculty_code`, `abbreviation`, `major_name`) VALUES
('ACC', 'BUS', 'Accounting', ''),
('AI', 'CS', 'Artificial Intel', ''),
('CE', 'ENG', 'Civil Eng', ''),
('CRIM', 'LAW', 'Criminology', ''),
('SE', 'CS', 'Software Eng', '');

-- --------------------------------------------------------

--
-- Table structure for table `majors`
--

CREATE TABLE `majors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `major` varchar(255) NOT NULL,
  `major_code` varchar(255) DEFAULT NULL,
  `faculty` varchar(255) DEFAULT NULL,
  `faculty_code` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `majors`
--

INSERT INTO `majors` (`id`, `major`, `major_code`, `faculty`, `faculty_code`, `description`, `created_at`, `updated_at`) VALUES
(1, 'SCI', '01', 'SCI', '01', NULL, NULL, NULL),
(2, 'ENG', '02', 'ENG', '02', NULL, NULL, NULL),
(3, 'BIO', '03', 'ENG', '01', NULL, NULL, NULL),
(4, 'MECH', '04', 'ENG', '02', NULL, NULL, NULL),
(5, 'ELECT', '04', 'ENG', '01', NULL, NULL, NULL),
(6, 'DENG', '06', 'ENG', '02', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_08_21_092824_create_students_table', 1),
(5, '2025_08_21_092833_create_parents_table', 1),
(6, '2025_08_21_092841_create_staff_table', 1),
(7, '2025_08_21_092848_create_voice_calls_table', 1),
(8, '2025_08_21_092856_create_tickets_table', 1),
(9, '2025_08_21_160330_add_ticket_number_to_voice_calls_table', 1),
(13, '2025_08_23_100243_add_role_to_users_table', 2),
(14, '2025_08_25_221945_create_majors_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `parents`
--

CREATE TABLE `parents` (
  `parent_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `relation_to_student` varchar(100) DEFAULT NULL,
  `stud_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `parents`
--

INSERT INTO `parents` (`parent_id`, `full_name`, `email`, `phone`, `relation_to_student`, `stud_id`, `created_at`) VALUES
(1, 'Mohammed Hassan', 'mhassan@example.com', '091111111', 'Father', 1, '2025-08-23 16:17:01'),
(2, 'Amina Omar', 'aomar@example.com', '092222222', 'Mother', 2, '2025-08-23 16:17:01');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `id` int(11) NOT NULL,
  `stud_id` int(11) NOT NULL,
  `batch` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `CGPA` decimal(3,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`id`, `stud_id`, `batch`, `semester`, `status`, `CGPA`) VALUES
(1, 1, 2022, 1, 'Passed', 2.80),
(2, 1, 2022, 2, 'Passed', 3.00),
(3, 1, 2022, 3, 'Passed', 3.10),
(4, 1, 2022, 4, 'Passed', 3.20),
(5, 1, 2022, 5, 'Passed', 3.30),
(6, 1, 2022, 6, 'Passed', 3.40),
(7, 1, 2022, 7, 'Probation', 2.50),
(11, 2, 2023, 1, 'Passed', 3.10),
(12, 2, 2023, 2, 'Passed', 3.20),
(13, 2, 2023, 3, 'Passed', 3.30),
(14, 2, 2023, 4, 'Passed', 3.40),
(15, 2, 2023, 5, 'Probation', 2.60),
(21, 3, 2021, 1, 'Passed', 2.90),
(22, 3, 2021, 2, 'Passed', 3.00),
(23, 3, 2021, 3, 'Pass', 3.10),
(26, 3, 2021, 6, 'Passed', 3.00),
(27, 3, 2021, 7, 'Passed', 3.10),
(28, 3, 2021, 8, 'Passed', 3.20),
(29, 3, 2021, 9, 'Passed', 3.30),
(30, 3, 2021, 10, 'Graduated', 3.40),
(31, 4, 2024, 1, 'Passed', 3.00),
(32, 4, 2024, 2, 'Passed', 3.20),
(33, 4, 2024, 3, 'Passed', 3.30),
(34, 4, 2024, 4, 'Passed', 3.40),
(35, 4, 2024, 5, 'In Progress', 3.50),
(36, 5, 2020, 1, 'Passed', 2.70),
(37, 5, 2020, 2, 'Passed', 2.90),
(38, 5, 2020, 3, 'Probation', 2.40),
(39, 5, 2020, 4, 'Passed', 3.00),
(40, 5, 2020, 5, 'In Progress', 3.20);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('aT3R3QTzi8nD82ZUCnzwF1YruGSTIFcLxQnelEzT', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoicVVVVmVlcUlNNkhHUndybnVZdU5UZ1MyV2FIZEo1MmtaUHJqSkdTSiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zdHVkZW50Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1758722242);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_code` int(11) NOT NULL,
  `staff_id` varchar(20) DEFAULT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `department` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_code`, `staff_id`, `full_name`, `email`, `phone`, `department`, `created_at`) VALUES
(1, 'STF001', 'Dr. Ahmed Ali', 'ahmed.ali@voiceline.com', '090000111', 'Computer Science', '2025-08-23 16:17:01'),
(2, 'STF002', 'Eng. Mariam Khalid', 'mariam.khalid@voiceline.com', '090000222', 'Electrical Engineering', '2025-08-23 16:17:01');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `stud_id` int(11) NOT NULL,
  `stud_name` varchar(100) NOT NULL,
  `stud_surname` varchar(100) DEFAULT NULL,
  `familyname` varchar(100) DEFAULT NULL,
  `status_code` varchar(10) DEFAULT NULL,
  `curr_sem` int(11) DEFAULT NULL,
  `faculty_code` varchar(10) DEFAULT NULL,
  `major_code` varchar(10) DEFAULT NULL,
  `batch` varchar(10) DEFAULT NULL,
  `stud_gpa` decimal(3,2) DEFAULT NULL,
  `stud_cgpa` decimal(3,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`stud_id`, `stud_name`, `stud_surname`, `familyname`, `status_code`, `curr_sem`, `faculty_code`, `major_code`, `batch`, `stud_gpa`, `stud_cgpa`) VALUES
(1, 'Ali', 'Hassan', 'Mohammed', 'ACT', 4, 'ENG', 'BIO', '2020', 3.60, 3.40),
(2, 'Sara', 'Omar', 'Abdalla', 'ACT', 2, 'SCI', 'SCI', '2023', 3.20, 3.10),
(2020, 'Mohamed', NULL, NULL, NULL, NULL, 'ENG', 'BIO', '2018', NULL, NULL),
(2023, 'Mazin', NULL, NULL, NULL, NULL, 'IT', 'DIT', '2022', NULL, NULL),
(22222, 'anas', NULL, NULL, NULL, NULL, 'IT', 'IT', '2917', NULL, NULL),
(201822001, 'Aya', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `student_profile_common`
--

CREATE TABLE `student_profile_common` (
  `stud_id` int(11) NOT NULL,
  `faculty_code` varchar(10) NOT NULL,
  `major_code` varchar(10) NOT NULL,
  `batch` int(11) DEFAULT NULL,
  `curr_sem` int(11) DEFAULT NULL,
  `status_code` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_profile_common`
--

INSERT INTO `student_profile_common` (`stud_id`, `faculty_code`, `major_code`, `batch`, `curr_sem`, `status_code`) VALUES
(1, 'CS', 'SE', 2021, 5, 1),
(2, 'CS', 'AI', 2021, 3, 1),
(3, 'ENG', 'CE', 2021, 7, 0),
(4, 'BUS', 'ACC', 2021, 1, 1),
(5, 'LAW', 'CRIM', 2021, 9, 0);

-- --------------------------------------------------------

--
-- Table structure for table `student_profile_e`
--

CREATE TABLE `student_profile_e` (
  `stud_id` int(11) NOT NULL,
  `stud_name` varchar(100) NOT NULL,
  `stud_surname` varchar(100) DEFAULT NULL,
  `familyname` varchar(100) DEFAULT NULL,
  `lastName` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_profile_e`
--

INSERT INTO `student_profile_e` (`stud_id`, `stud_name`, `stud_surname`, `familyname`, `lastName`) VALUES
(1, 'Ali', 'Hassan', 'Hussein', 'Ali'),
(2, 'Sara', 'Mohamed', 'Youssef', 'Sara'),
(3, 'Omar', 'Mahmoud', 'Ibrahim', 'Omar'),
(4, 'Laila', 'Khaled', 'Mostafa', 'Laila'),
(5, 'Huda', 'Samir', 'Fahmy', 'Huda');

-- --------------------------------------------------------

--
-- Table structure for table `stud_course_mark`
--

CREATE TABLE `stud_course_mark` (
  `id` int(11) NOT NULL,
  `stud_id` int(11) NOT NULL,
  `batch` int(11) NOT NULL,
  `course_code` varchar(20) NOT NULL,
  `semester` int(11) NOT NULL,
  `grade` varchar(5) DEFAULT NULL,
  `sub_grade1` varchar(5) DEFAULT NULL,
  `sub_grade2` varchar(5) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stud_course_mark`
--

INSERT INTO `stud_course_mark` (`id`, `stud_id`, `batch`, `course_code`, `semester`, `grade`, `sub_grade1`, `sub_grade2`, `remark`) VALUES
(1, 1, 2021, '1', 1, 'A', NULL, NULL, 'Good performance'),
(2, 1, 2021, '2', 2, 'F', 'A', NULL, 'Failed course'),
(3, 1, 2021, '3', 3, 'Z', 's', NULL, 'Incomplete'),
(4, 2, 2021, '1', 1, 'B', NULL, NULL, ''),
(5, 2, 2021, '3', 2, 'I', NULL, NULL, 'Incomplete project'),
(6, 3, 2021, 'ACC101', 1, 'F', NULL, NULL, 'Repeat required'),
(7, 3, 2021, 'ACC102', 2, 'C', NULL, NULL, ''),
(8, 4, 2021, 'EE101', 1, 'A', NULL, NULL, ''),
(9, 4, 2021, 'EE102', 2, 'F', 'R', NULL, 'Retake required'),
(10, 5, 2021, 'FIN101', 1, 'Z', NULL, NULL, 'Pending grade');

-- --------------------------------------------------------

--
-- Table structure for table `stud_transcript_table`
--

CREATE TABLE `stud_transcript_table` (
  `stud_id` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `cgpa_status_code` varchar(10) NOT NULL,
  `CGPA` decimal(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stud_transcript_table`
--

INSERT INTO `stud_transcript_table` (`stud_id`, `semester`, `cgpa_status_code`, `CGPA`) VALUES
(1, 1, 'B', 3.10),
(1, 2, 'A', 3.55),
(2, 1, 'C', 2.25),
(2, 2, 'B', 2.85),
(3, 1, 'A', 3.90),
(3, 2, 'A', 3.95),
(4, 1, 'B', 3.00),
(4, 2, 'C', 2.50),
(5, 1, 'D', 1.80),
(5, 2, 'C', 2.10);

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `ticket_serial_no` int(11) NOT NULL,
  `voice_call_id` int(11) NOT NULL,
  `ticket_number` varchar(50) DEFAULT NULL,
  `ticket_id` varchar(15) NOT NULL,
  `ticket_category` varchar(50) DEFAULT NULL,
  `issue_date` date DEFAULT NULL,
  `opened_type` enum('student','parent','staff') NOT NULL DEFAULT 'student',
  `opened_by_whois` int(11) NOT NULL,
  `Ticket_status` enum('open','in_progress','on_hold','resolved','closed') NOT NULL DEFAULT 'open',
  `priority` enum('low','medium','high','urgent') NOT NULL DEFAULT 'medium',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ticket_url` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`ticket_serial_no`, `voice_call_id`, `ticket_number`, `ticket_id`, `ticket_category`, `issue_date`, `opened_type`, `opened_by_whois`, `Ticket_status`, `priority`, `created_at`, `updated_at`, `ticket_url`) VALUES
(1, 1, '1', 'TK001', 'technical', '2025-08-23', 'student', 1, 'open', 'high', '2025-08-23 16:17:01', '2025-08-31 15:50:42', 'http://voiceline.test/tickets/1'),
(2, 2, '2', 'TK002', 'administrative', '2025-08-23', 'staff', 1, 'in_progress', 'medium', '2025-08-23 16:17:01', '2025-09-01 22:31:12', 'http://voiceline.test/tickets/2'),
(4, 4, '4', '4', '4', '2025-08-27', 'student', 2, 'open', 'medium', '2025-08-31 16:22:49', '2025-08-31 16:22:49', 'teetett'),
(6, 1, '3', '232', '232323', '2025-08-31', 'student', 1, 'in_progress', 'medium', '2025-08-31 16:23:52', '2025-09-01 22:31:19', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin@voiceline.com', NULL, '$2y$12$FkxzPku97eZnQnnS4/RSROlYN9fKT5URocquxKGZGN3NPmDkK8iEm', 'admin', 'u8zSlGii5el0aIC7A06Bta7mfkn9rxkAjwBDhEOYW0V5alTCazX0frP3lv3E', '2025-08-23 16:17:00', '2025-08-25 15:04:26'),
(2, 'supervisor', 'supervisor@voiceline.com', NULL, '$2y$12$HYiyS8K4SfpAa33/kp4T3uiNgURYye9/mhUc/DSN2YKqprnef4Wjy', 'supervisor', NULL, '2025-08-23 16:17:00', '2025-08-23 16:17:00'),
(3, 'Support Agent /Zoom', 'agent@voiceline.com', NULL, '$2y$12$FkxzPku97eZnQnnS4/RSROlYN9fKT5URocquxKGZGN3NPmDkK8iEm', 'user', NULL, '2025-08-23 16:17:01', '2025-08-25 15:08:48');

-- --------------------------------------------------------

--
-- Table structure for table `voice_calls`
--

CREATE TABLE `voice_calls` (
  `call_id` int(11) NOT NULL,
  `ticket_number` varchar(50) DEFAULT NULL,
  `customer_type` enum('student','parent','staff','general') NOT NULL,
  `stud_id` int(11) DEFAULT NULL,
  `staff_ID` int(11) DEFAULT NULL,
  `category` int(11) NOT NULL,
  `issue` text NOT NULL,
  `Solution_Note` text DEFAULT NULL,
  `Found_Status` varchar(25) DEFAULT NULL,
  `Final_Status` varchar(25) DEFAULT NULL,
  `priority` varchar(25) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `parent_name` varchar(50) DEFAULT NULL,
  `parent_phone` varchar(30) DEFAULT NULL,
  `handled_by_user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `voice_calls`
--

INSERT INTO `voice_calls` (`call_id`, `ticket_number`, `customer_type`, `stud_id`, `staff_ID`, `category`, `issue`, `Solution_Note`, `Found_Status`, `Final_Status`, `priority`, `parent_id`, `parent_name`, `parent_phone`, `handled_by_user_id`, `created_at`, `updated_at`) VALUES
(1, '1', 'parent', NULL, NULL, 42, 'Withdrawal status', 'solved, and satisfied', 'open', '3', 'high', NULL, NULL, '20201515151', 1, '2025-09-06 09:49:43', '2025-09-06 09:49:43'),
(2, '1', 'parent', NULL, NULL, 42, 'Withdrawal status', 'solved, and satisfied', 'open', '3', 'high', NULL, NULL, '20201515151', 1, '2025-09-06 09:50:34', '2025-09-06 09:50:34'),
(3, '1', 'student', NULL, NULL, 1, 'transfer', 'done', 'open', '1', 'high', NULL, NULL, NULL, 1, '2025-09-06 09:55:19', '2025-09-06 09:55:19'),
(4, '1', 'parent', NULL, NULL, 1, 'transfer', 'done', 'open', '1', 'high', NULL, NULL, '20201515151', 1, '2025-09-06 09:56:06', '2025-09-06 09:56:06'),
(5, '1', 'parent', NULL, NULL, 1, 'aaaa', 'aaaaa', 'open', '1', 'high', NULL, 'Sara Omar Abdalla', '20201515151', 1, '2025-09-06 09:56:54', '2025-09-06 09:56:54'),
(6, '1', 'general', NULL, NULL, 42, 'fdggfdsavsavasv', 'fsgdsfgsaf\r\nsfdgfdsgfds\r\nsfdgsdfg', 'open', '3', 'high', NULL, 'Abdalla Omer', '09995000', 1, '2025-09-06 10:00:43', '2025-09-06 10:00:43'),
(7, '1', 'parent', NULL, NULL, 42, 'ggggg', '5665656', 'open', NULL, 'high', NULL, 'Ali Hassan Mohammed', '20201515151', 1, '2025-09-08 08:24:10', '2025-09-08 08:24:10'),
(8, '1', 'student', NULL, NULL, 1, 'ggggg', '5665656', 'open', NULL, 'high', NULL, 'aaa', NULL, 1, '2025-09-08 08:26:42', '2025-09-08 08:26:42'),
(9, '1', 'student', NULL, NULL, 1, 'ggggg', '5665656', 'open', NULL, 'high', NULL, 'aaa', NULL, 1, '2025-09-08 08:29:16', '2025-09-08 08:29:16'),
(10, '1', 'student', NULL, NULL, 1, 'ggggg', '5665656', 'open', NULL, 'high', NULL, 'aaa', NULL, 1, '2025-09-08 08:31:01', '2025-09-08 08:31:01'),
(11, '1', 'general', NULL, NULL, 1, 'ggggg', '5665656', 'open', '1', 'high', NULL, 'aaa', '20201515151', 1, '2025-09-08 08:33:25', '2025-09-08 08:33:25'),
(12, '1', 'student', NULL, NULL, 1, 'ggggg', '5665656', 'open', NULL, 'high', NULL, 'aaa', NULL, 1, '2025-09-08 08:34:00', '2025-09-08 08:34:00'),
(13, '1', 'student', NULL, NULL, 1, 'ggggg', '5665656', 'open', NULL, 'high', NULL, 'aaa', NULL, 1, '2025-09-08 08:35:29', '2025-09-08 08:35:29'),
(14, '1', 'student', NULL, NULL, 1, 'ggggg', '5665656', 'open', '1', 'high', NULL, 'aaa', NULL, 1, '2025-09-08 08:40:01', '2025-09-08 08:40:01'),
(15, '1', 'student', NULL, NULL, 1, 'ggggg', '5665656', 'open', '1', 'high', NULL, 'aaa', NULL, 1, '2025-09-08 08:42:54', '2025-09-08 08:42:54'),
(16, '1', 'student', NULL, NULL, 1, 'lkjlk;', '.,m/.,m', 'open', '1', 'high', NULL, 'Ali Hassan Mohammed', NULL, 1, '2025-09-08 08:43:29', '2025-09-08 08:43:29'),
(17, '1', 'student', NULL, NULL, 1, 'SZ', '5665656', 'open', '1', 'high', NULL, 'MURTADA MOHAMMED HAMAD AHMED', NULL, 1, '2025-09-11 13:43:06', '2025-09-11 13:43:06'),
(18, 'TCK-1001', 'student', NULL, NULL, 42, 'fdfdadsf', 'TCK-1001', NULL, '2', 'TCK-1001', NULL, 'Ali Hassan Hussein Ali', NULL, 1, '2025-09-23 16:42:02', '2025-09-23 16:42:02'),
(19, 'TCK-1001', 'student', NULL, NULL, 1, 'xx', 'xx', NULL, '1', 'Normal', NULL, 'Ali Hassan Hussein Ali', NULL, 1, '2025-09-23 20:05:12', '2025-09-23 20:05:12'),
(20, 'TCK-1001', 'parent', NULL, NULL, 1, 'disscount', 'Solution Note', NULL, '3', 'Normal', NULL, 'Ali Hassan Hussein Ali', '20201515151', 1, '2025-09-23 20:06:29', '2025-09-23 20:06:29'),
(21, 'Q9H-B3P-BQV4', 'student', NULL, NULL, 1, 'تخفيض', 'تمت المعالجة', NULL, '1', 'High', NULL, 'Yousif Osama Abd Elsamie Yassin', NULL, 1, '2025-09-24 10:53:25', '2025-09-24 10:53:25'),
(22, 'HSZ-R1A-GN9R', 'student', NULL, NULL, 1, 'Issue', 'TCK-1001', NULL, '2', 'High', NULL, 'Yousif Osama Abd Elsamie Yassin', NULL, 1, '2025-09-24 10:55:18', '2025-09-24 10:55:18'),
(23, 'N2R-NJ3-95JV', 'parent', NULL, NULL, 1, 'discount', 'done', NULL, '1', 'High', NULL, 'Yousif Osama Abd Elsamie Yassin', '0999', 1, '2025-09-24 10:56:17', '2025-09-24 10:56:17'),
(24, 'Q9H-B3P-BQV4', 'parent', NULL, NULL, 1, 'تقسيط', 'تم', NULL, '2', 'High', NULL, 'ANAS Yousif Osama Abd Elsamie Yassin', '20201515151', 1, '2025-09-24 10:57:22', '2025-09-24 10:57:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cgpa_status`
--
ALTER TABLE `cgpa_status`
  ADD PRIMARY KEY (`cgpa_status_code`);

--
-- Indexes for table `course_desc`
--
ALTER TABLE `course_desc`
  ADD PRIMARY KEY (`course_code`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`faculty_code`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `hesk_tickets`
--
ALTER TABLE `hesk_tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `major`
--
ALTER TABLE `major`
  ADD PRIMARY KEY (`major_code`,`faculty_code`),
  ADD KEY `fk_major_faculty` (`faculty_code`);

--
-- Indexes for table `majors`
--
ALTER TABLE `majors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parents`
--
ALTER TABLE `parents`
  ADD PRIMARY KEY (`parent_id`),
  ADD KEY `parents_stud_id_index` (`stud_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_results_student` (`stud_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_code`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`stud_id`);

--
-- Indexes for table `student_profile_common`
--
ALTER TABLE `student_profile_common`
  ADD PRIMARY KEY (`stud_id`);

--
-- Indexes for table `student_profile_e`
--
ALTER TABLE `student_profile_e`
  ADD PRIMARY KEY (`stud_id`);

--
-- Indexes for table `stud_course_mark`
--
ALTER TABLE `stud_course_mark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stud_transcript_table`
--
ALTER TABLE `stud_transcript_table`
  ADD PRIMARY KEY (`stud_id`,`semester`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`ticket_serial_no`),
  ADD UNIQUE KEY `tickets_ticket_number_unique` (`ticket_number`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `voice_calls`
--
ALTER TABLE `voice_calls`
  ADD PRIMARY KEY (`call_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hesk_tickets`
--
ALTER TABLE `hesk_tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `majors`
--
ALTER TABLE `majors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `parents`
--
ALTER TABLE `parents`
  MODIFY `parent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `stud_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201822002;

--
-- AUTO_INCREMENT for table `stud_course_mark`
--
ALTER TABLE `stud_course_mark`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `ticket_serial_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `voice_calls`
--
ALTER TABLE `voice_calls`
  MODIFY `call_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `major`
--
ALTER TABLE `major`
  ADD CONSTRAINT `fk_major_faculty` FOREIGN KEY (`faculty_code`) REFERENCES `faculty` (`faculty_code`);

--
-- Constraints for table `parents`
--
ALTER TABLE `parents`
  ADD CONSTRAINT `parents_stud_id_foreign` FOREIGN KEY (`stud_id`) REFERENCES `students` (`stud_id`);

--
-- Constraints for table `results`
--
ALTER TABLE `results`
  ADD CONSTRAINT `fk_results_student` FOREIGN KEY (`stud_id`) REFERENCES `student_profile_e` (`stud_id`);

--
-- Constraints for table `student_profile_common`
--
ALTER TABLE `student_profile_common`
  ADD CONSTRAINT `fk_spc_student` FOREIGN KEY (`stud_id`) REFERENCES `student_profile_e` (`stud_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
