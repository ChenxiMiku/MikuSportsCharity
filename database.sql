-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1:3306
-- 生成日期： 2024-12-31 02:43:05
-- 服务器版本： 8.2.0
-- PHP 版本： 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `mikusportscharity`
--

-- --------------------------------------------------------

--
-- 表的结构 `charity`
--

DROP TABLE IF EXISTS `charity`;
CREATE TABLE IF NOT EXISTS `charity` (
  `charity_id` int NOT NULL AUTO_INCREMENT,
  `charity_name` varchar(255) NOT NULL,
  PRIMARY KEY (`charity_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 转存表中的数据 `charity`
--

INSERT INTO `charity` (`charity_id`, `charity_name`) VALUES
(1, 'Kickstart Hope'),
(2, 'Run for Life'),
(6, 'asd');

-- --------------------------------------------------------

--
-- 表的结构 `donation`
--

DROP TABLE IF EXISTS `donation`;
CREATE TABLE IF NOT EXISTS `donation` (
  `donation_id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `charity_id` int NOT NULL,
  `description` text,
  `funding_goal` decimal(10,0) NOT NULL,
  `current_funding` decimal(10,0) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `image_path` varchar(255) NOT NULL,
  PRIMARY KEY (`donation_id`),
  KEY `fk_donate_charity` (`charity_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 转存表中的数据 `donation`
--

INSERT INTO `donation` (`donation_id`, `title`, `charity_id`, `description`, `funding_goal`, `current_funding`, `created_at`, `updated_at`, `image_path`) VALUES
(1, 'Kickstart Athletes Fund 2024', 1, 'Support aspiring young athletes by providing scholarships, training, and essential equipment to help them achieve their dreams through football.', 50000, 12500, '2024-12-20 22:04:33', '2024-12-20 22:04:33', 'images/event3.jpg'),
(2, 'Kickstart Fields of Hope', 1, 'Help us build and renovate football facilities in underprivileged areas, creating safe spaces for children and communities to play, grow, and unite.', 100000, 67000, '2024-12-22 20:49:47', '2024-12-22 20:49:47', 'images/image.png'),
(3, 'Kickstart Community Impact Fund', 1, 'Empower poverty-stricken communities with football outreach programs that promote education, health, and social cohesion through the beautiful game.', 75000, 18400, '2024-12-22 20:50:37', '2024-12-22 20:50:37', 'images/event3.jpg'),
(5, 'test', 1, '123', 123, 0, '2024-12-28 16:03:16', '2024-12-28 16:03:16', 'images/image.png');

-- --------------------------------------------------------

--
-- 表的结构 `donation_records`
--

DROP TABLE IF EXISTS `donation_records`;
CREATE TABLE IF NOT EXISTS `donation_records` (
  `trade_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `donor_name` varchar(255) DEFAULT NULL,
  `donor_email` varchar(255) DEFAULT NULL,
  `anonymous` tinyint(1) DEFAULT '0',
  `donation_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `donation_id` int DEFAULT NULL,
  PRIMARY KEY (`trade_id`),
  KEY `fk_donate_record` (`donation_id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 转存表中的数据 `donation_records`
--

INSERT INTO `donation_records` (`trade_id`, `name`, `amount`, `donor_name`, `donor_email`, `anonymous`, `donation_date`, `donation_id`) VALUES
(30, 'Kickstart Fields of Hope Donation', 15.00, 'anonymous', 'none', 1, '2024-12-28 04:22:35', 2),
(31, 'Kickstart Fields of Hope Donation', 50.00, 'anonymous', 'none', 1, '2024-12-28 04:23:20', 2),
(32, 'Kickstart Fields of Hope Donation', 15.00, 'anonymous', 'none', 1, '2024-12-28 04:23:28', 2),
(33, 'Kickstart Fields of Hope Donation', 15.00, 'anonymous', 'none', 1, '2024-12-28 04:54:02', 2),
(34, 'Kickstart Fields of Hope Donation', 20.00, '闫城玮', '870402105@qq.com', 0, '2024-12-28 15:24:57', 2),
(35, 'Kickstart Fields of Hope Donation', 15.00, 'ychw', '870402105@qq.com', 0, '2024-12-28 15:50:18', 2);

-- --------------------------------------------------------

--
-- 表的结构 `event_times`
--

DROP TABLE IF EXISTS `event_times`;
CREATE TABLE IF NOT EXISTS `event_times` (
  `id` int NOT NULL AUTO_INCREMENT,
  `event_id` int NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_event` (`event_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 转存表中的数据 `event_times`
--

INSERT INTO `event_times` (`id`, `event_id`, `start_time`, `end_time`) VALUES
(1, 1, '08:00:00', '10:00:00'),
(2, 1, '10:00:00', '12:00:00'),
(3, 2, '09:00:00', '11:00:00'),
(4, 2, '12:00:00', '14:00:00');

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(191) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(191) NOT NULL,
  `role` enum('admin','volunteer') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `token` varchar(255) NOT NULL,
  `avatar_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `email`, `role`, `name`, `contact_number`, `created_at`, `updated_at`, `token`, `avatar_path`) VALUES
(1, 'test', 'test', 'test@test.com', 'admin', 'test', '18888888888', '2024-12-20 18:27:37', '2024-12-20 18:27:37', '', ''),
(2, 'chenxi', '$2y$10$r9jDPK.Q3gh03klJhS4YvuF7kRvddy5UsQuUvh5vSGebWnzbl2CN.', '870402105@qq.com', 'admin', '闫城玮', '+86 15098646873', '2024-12-20 20:18:08', '2024-12-28 15:21:20', 'eb24400d102a168ee7abff287ee43189223458462cb9f08ca029b45fe9e60290', '../upload/avatars/2_1735330944.png'),
(4, 'user', '$2y$10$P6O7QKuLDL71V0rg.fmpGuQ9GP4oUF0BVHGm.87UNwOb4n3tHDKwW', 'user@user.com', 'volunteer', NULL, NULL, '2024-12-20 21:14:28', '2024-12-27 22:56:25', '3e28ced8ea6eae30366b3dc8a41ccc1dc2748effb5dec548b5e7cada1aabbe6e', '../upload/avatars/default.png'),
(14, 'user2', '$2y$10$WdsuHp1ThKEWgKa1G4Yjuep7ro65Wouy0ZvTtJ6LEoa5oqifrOyj.', '870402105@qq.com', 'admin', 'ychw', '+86 15098646873', '2024-12-28 15:48:07', '2024-12-31 02:42:24', '0eaf9abe86cd085f19c2e2e5b5b4646fb5130b74b02d22d0d51a9053869d076d', '../upload/avatars/default.png'),
(15, 'user3', '$2y$10$nZPCnKKZ3y8SlWJjAHiF0ugfW8Cyj6FWRb8nekQQVmV/zQiYFv8JO', 'testt@test.com', 'volunteer', NULL, NULL, '2024-12-31 02:38:32', '2024-12-31 02:42:27', 'c5fe681796cd919f2581effd7d0d1a0f554f3db0d43a9bcd510b93608d9460b2', '../upload/avatars/default.png');

-- --------------------------------------------------------

--
-- 表的结构 `volunteer`
--

DROP TABLE IF EXISTS `volunteer`;
CREATE TABLE IF NOT EXISTS `volunteer` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `event_id` int DEFAULT NULL,
  `time_slot` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `signup_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_user_volunteer` (`user_id`),
  KEY `fk_event_volunteer` (`event_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 转存表中的数据 `volunteer`
--

INSERT INTO `volunteer` (`id`, `user_id`, `event_id`, `time_slot`, `signup_date`) VALUES
(1, 2, 2, '09:00:00 - 11:00:00', '2024-12-26 18:03:11'),
(7, 2, 1, '08:00:00 - 10:00:00', '2024-12-26 18:25:01'),
(8, 2, 2, '12:00:00 - 14:00:00', '2024-12-26 18:27:46'),
(9, 2, 2, '09:00:00 - 11:00:00', '2024-12-27 19:59:47'),
(10, 2, 1, '08:00:00 - 10:00:00', '2024-12-27 20:00:44'),
(11, 2, 2, '12:00:00 - 14:00:00', '2024-12-27 20:00:44'),
(12, 2, 2, '09:00:00 - 11:00:00', '2024-12-27 20:12:28'),
(13, 2, 2, '09:00:00 - 11:00:00', '2024-12-27 20:12:46'),
(14, 2, 2, '09:00:00 - 11:00:00', '2024-12-28 15:22:08'),
(15, 2, 1, '08:00:00 - 10:00:00', '2024-12-28 15:22:50'),
(16, 2, 2, '12:00:00 - 14:00:00', '2024-12-28 15:22:50'),
(17, 14, 1, '08:00:00 - 10:00:00', '2024-12-28 15:48:52'),
(18, 14, 1, '08:00:00 - 10:00:00', '2024-12-28 15:49:23'),
(19, 14, 2, '12:00:00 - 14:00:00', '2024-12-28 15:49:23');

-- --------------------------------------------------------

--
-- 表的结构 `volunteerevent`
--

DROP TABLE IF EXISTS `volunteerevent`;
CREATE TABLE IF NOT EXISTS `volunteerevent` (
  `event_id` int NOT NULL AUTO_INCREMENT,
  `event_name` varchar(255) NOT NULL,
  `event_date` date DEFAULT NULL,
  `event_location` varchar(255) DEFAULT NULL,
  `description` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `charity_id` int NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `current_volunteers` int NOT NULL,
  `volunteer_goal` int NOT NULL,
  PRIMARY KEY (`event_id`),
  KEY `fk_vd_charity_id` (`charity_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 转存表中的数据 `volunteerevent`
--

INSERT INTO `volunteerevent` (`event_id`, `event_name`, `event_date`, `event_location`, `description`, `created_at`, `updated_at`, `charity_id`, `image_path`, `current_volunteers`, `volunteer_goal`) VALUES
(1, 'Community Football Match', '2025-01-03', 'Central Park Stadium', 'Join us as a volunteer for our Community Football Match, supporting underprivileged youth through football.', '2024-12-22 21:21:44', '2024-12-22 21:32:59', 1, 'image/image.png', 50, 100),
(2, 'Charity Football League', '2025-01-10', 'Eastfield Sports Arena', 'Help us organize this exciting league where teams play to raise funds for community football programs.', '2024-12-22 21:21:44', '2024-12-22 21:33:05', 1, 'image/image.png', 30, 50);

--
-- 限制导出的表
--

--
-- 限制表 `donation`
--
ALTER TABLE `donation`
  ADD CONSTRAINT `fk_donate_charity` FOREIGN KEY (`charity_id`) REFERENCES `charity` (`charity_id`) ON UPDATE CASCADE;

--
-- 限制表 `donation_records`
--
ALTER TABLE `donation_records`
  ADD CONSTRAINT `fk_donate_record` FOREIGN KEY (`donation_id`) REFERENCES `donation` (`donation_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `event_times`
--
ALTER TABLE `event_times`
  ADD CONSTRAINT `fk_event` FOREIGN KEY (`event_id`) REFERENCES `volunteerevent` (`event_id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- 限制表 `volunteer`
--
ALTER TABLE `volunteer`
  ADD CONSTRAINT `fk_event_volunteer` FOREIGN KEY (`event_id`) REFERENCES `volunteerevent` (`event_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_volunteer` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
