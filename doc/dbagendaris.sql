-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 14, 2015 at 03:51 PM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dbagendaris`
--

-- --------------------------------------------------------

--
-- Table structure for table `leaders`
--

CREATE TABLE IF NOT EXISTS `leaders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(115) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '0 = Disabled; 1 = Enabled',
  `type` int(11) NOT NULL DEFAULT '3' COMMENT '1 = Leader Primary; 2 = Leader Assistant; 3 = Units',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Ruang lingkup (Leader/Assistant/Unit/AdminBAAK)' AUTO_INCREMENT=15 ;

--
-- Dumping data for table `leaders`
--

INSERT INTO `leaders` (`id`, `name`, `created`, `modified`, `status`, `type`) VALUES
(1, 'Admin / BAAK', '2015-08-08 08:11:11', '2015-08-08 05:17:26', 1, 3),
(2, 'Ketua STIKOM', '2015-08-12 04:11:13', '2015-08-12 04:11:13', 1, 1),
(3, 'Pembantu Ketua Bidang Akademik', '2015-08-12 04:11:13', '2015-08-12 04:11:13', 1, 2),
(5, 'Pembantu Ketua Bidang Operasional dan Kemahasiswaan', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 2),
(6, 'Pembantu Ketua Bidang Pengembangan dan Kerjasama', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 2),
(7, 'BAAK', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 3),
(8, 'Perpustakaan', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 3),
(9, 'Jurusan & Lab', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 3),
(10, 'PPPM', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 3),
(11, 'BAUM', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 3),
(12, 'PUSKOMSI', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 3),
(13, 'BSC', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 3),
(14, 'PUSINFO & HUMAS', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `leader_mails`
--

CREATE TABLE IF NOT EXISTS `leader_mails` (
  `mail_inbox_id` int(11) NOT NULL,
  `leader_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0 = Not Approved; 1 = Approved',
  `done` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`leader_id`,`mail_inbox_id`),
  KEY `fk_leader_unit_mails_leaders1_idx` (`leader_id`),
  KEY `mail_inbox_id` (`mail_inbox_id`,`leader_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `leader_mails`
--

INSERT INTO `leader_mails` (`mail_inbox_id`, `leader_id`, `status`, `done`) VALUES
(7, 1, 0, 0),
(6, 3, 0, 0),
(7, 3, 1, 0),
(6, 7, 0, 0),
(7, 7, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mail_inbox`
--

CREATE TABLE IF NOT EXISTS `mail_inbox` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `leader_id` int(11) NOT NULL COMMENT 'Just for a Boss',
  `mail_type` int(11) NOT NULL COMMENT '1 = Segera, 2 = Penting, 3 = Biasa, 4 = Rahasia, 5 = Pribadi',
  `no_surat` varchar(15) NOT NULL,
  `no_arsip` varchar(15) NOT NULL,
  `lampiran` varchar(115) DEFAULT NULL,
  `perihal` varchar(255) NOT NULL,
  `asal_surat` varchar(115) NOT NULL,
  `message_leader` text,
  `message_leader_assistant` text,
  `file` varchar(145) NOT NULL COMMENT 'Type file: docx, pdf',
  `created` datetime NOT NULL,
  `received_date` date NOT NULL,
  `limit_date` date NOT NULL,
  `leader_status` int(11) NOT NULL DEFAULT '0' COMMENT '0 = Disabled; 1 = Enabled',
  `leader_assistant_status` int(11) NOT NULL DEFAULT '0' COMMENT '0 = Disabled; 1 = Enabled',
  `leader_unit_status` int(11) NOT NULL DEFAULT '0' COMMENT '0 = Disabled; 1 = Enabled',
  PRIMARY KEY (`id`,`leader_id`,`mail_type`),
  KEY `fk_mail_inbox_leaders1_idx` (`leader_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `mail_inbox`
--

INSERT INTO `mail_inbox` (`id`, `leader_id`, `mail_type`, `no_surat`, `no_arsip`, `lampiran`, `perihal`, `asal_surat`, `message_leader`, `message_leader_assistant`, `file`, `created`, `received_date`, `limit_date`, `leader_status`, `leader_assistant_status`, `leader_unit_status`) VALUES
(6, 2, 2, 'A.001/Pan-Pel/A', 'AS-0001', '-', 'Praise for Michael Hartlâ€™s', 'Ruby On Rail', 'Models are part of the MVC\r\n9\r\narchitecture. They are objects representing\r\nbusiness data, rules and logic.\r\nYou can create model classes by extending yii\\base\\Model or its child\r\nclasses. The base class yii\\base\\Model supports many useful features:', 'â€˜My former company (CD Baby) was one of the ï¬rst to loudly switch to Ruby on Rails, and then even more loudly switch back to PHP (Google me to read about the drama). This book by Michael Hartl came so highly recommended that I had to try it, and the Ruby on RailsTMTutorial is what I used to switch back to Rails again.', '187559_340.jpg', '2015-09-30 12:50:16', '2015-02-16', '2015-02-13', 1, 0, 0),
(7, 2, 2, 'DK30/13', 'AS-0002', 'Lampiran', '-', 'SMK ABC', 'Pesan ku', 'Unittt', '1378695_578693538857791_1227148412_n.jpg', '2015-10-08 14:23:25', '2015-06-29', '2002-04-09', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content_id` int(11) NOT NULL,
  `leader_id` int(11) NOT NULL,
  `content` varchar(45) NOT NULL,
  `action` varchar(45) NOT NULL,
  `redirect` varchar(45) NOT NULL,
  `mail_status` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0 =Unread, 1 = Read',
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`,`content_id`,`leader_id`),
  KEY `fk_notifications_outboxes1_idx` (`content_id`),
  KEY `fk_notifications_leaders1_idx` (`leader_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `content_id`, `leader_id`, `content`, `action`, `redirect`, `mail_status`, `status`, `created`) VALUES
(4, 6, 3, 'outboxes', 'approved', 'read', 1, 0, '2015-10-14 18:24:16');

-- --------------------------------------------------------

--
-- Table structure for table `outboxes`
--

CREATE TABLE IF NOT EXISTS `outboxes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_arsip` varchar(15) NOT NULL,
  `lampiran` varchar(100) DEFAULT NULL,
  `perihal` varchar(100) DEFAULT NULL,
  `mail_type` int(11) NOT NULL COMMENT '1 = Segera, 2 = Penting, 3 = Biasa, 4 = Rahasia, 5 = Pribadi',
  `pesan` text,
  `file` varchar(145) DEFAULT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `outboxes`
--

INSERT INTO `outboxes` (`id`, `no_arsip`, `lampiran`, `perihal`, `mail_type`, `pesan`, `file`, `created`) VALUES
(5, 'OX-0001', 'ljkj', 'lkj', 2, NULL, NULL, '2015-10-03 15:48:50'),
(6, 'OX-0001', 'Official CakePHP discussion group', 'CakePHP also has its official discusson group on Google Groups. There are thousands of people discus', 1, NULL, '6270027_20140609115024.jpg', '2015-10-03 15:49:09');

-- --------------------------------------------------------

--
-- Table structure for table `outbox_leaders`
--

CREATE TABLE IF NOT EXISTS `outbox_leaders` (
  `outbox_id` int(11) NOT NULL,
  `leader_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0 = Not Approve; 1 = Approved',
  PRIMARY KEY (`outbox_id`,`leader_id`),
  KEY `fk_outbox_leaders_leaders1_idx` (`leader_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `outbox_leaders`
--

INSERT INTO `outbox_leaders` (`outbox_id`, `leader_id`, `status`) VALUES
(5, 1, 0),
(5, 3, 1),
(6, 1, 0),
(6, 3, 1),
(6, 13, 0),
(6, 14, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `leader_id` int(11) NOT NULL COMMENT 'ID: Leader/Assistant/Unit ',
  `username` varchar(16) NOT NULL,
  `password` varchar(255) NOT NULL,
  `display_name` varchar(64) DEFAULT NULL,
  `email` varchar(64) NOT NULL,
  `bio` varchar(160) DEFAULT NULL,
  `gender` enum('M','F') NOT NULL DEFAULT 'M',
  `birthdate` date DEFAULT NULL,
  `address` varchar(160) DEFAULT NULL,
  `city` varchar(64) DEFAULT NULL,
  `postal_code` int(11) DEFAULT '0',
  `picture_dir` varchar(255) NOT NULL DEFAULT 'default',
  `picture` varchar(255) NOT NULL DEFAULT 'default.jpg',
  `activation_key` varchar(255) DEFAULT NULL,
  `role` enum('admin','leader','assistant','unit') NOT NULL DEFAULT 'unit',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 = Enabled; 1 = Disabled',
  PRIMARY KEY (`id`,`leader_id`),
  UNIQUE KEY `username` (`username`),
  KEY `fk_users_leaders1_idx` (`leader_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `leader_id`, `username`, `password`, `display_name`, `email`, `bio`, `gender`, `birthdate`, `address`, `city`, `postal_code`, `picture_dir`, `picture`, `activation_key`, `role`, `created`, `modified`, `status`) VALUES
(1, 1, 'admin', '9524d976fdd31855d21e6d0e23e6c2902adf9f47', 'Admin. Happy', 'si2@mail.com', NULL, 'M', NULL, NULL, NULL, 0, 'default', 'default.jpg', NULL, 'admin', NULL, NULL, 0),
(2, 2, 'leader', '9524d976fdd31855d21e6d0e23e6c2902adf9f47', 'Leader. Happy', 'ya@mail.com', NULL, 'M', NULL, NULL, NULL, 0, 'default', 'default.png', NULL, 'leader', NULL, NULL, 0),
(3, 3, 'assistant', '9524d976fdd31855d21e6d0e23e6c2902adf9f47', 'Assistant. Happy', '', NULL, 'M', NULL, NULL, NULL, 0, 'default', 'default.jpg', NULL, 'assistant', NULL, NULL, 0),
(4, 7, 'unit', '9524d976fdd31855d21e6d0e23e6c2902adf9f47', 'Happy.Unit', 'unit@mail.com', NULL, 'M', NULL, NULL, NULL, 15320, 'default', 'default.jpg', NULL, 'unit', '2015-09-15 00:00:00', '2015-09-15 00:00:00', 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `leader_mails`
--
ALTER TABLE `leader_mails`
  ADD CONSTRAINT `fk_leader_unit_mails_leaders1` FOREIGN KEY (`leader_id`) REFERENCES `leaders` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_unit_leader_mails_mail_inbox1` FOREIGN KEY (`mail_inbox_id`) REFERENCES `mail_inbox` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mail_inbox`
--
ALTER TABLE `mail_inbox`
  ADD CONSTRAINT `fk_mail_inbox_leaders1` FOREIGN KEY (`leader_id`) REFERENCES `leaders` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `fk_notifications_leaders1` FOREIGN KEY (`leader_id`) REFERENCES `leaders` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_notifications_mail_inbox1` FOREIGN KEY (`content_id`) REFERENCES `mail_inbox` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_notifications_outboxes1` FOREIGN KEY (`content_id`) REFERENCES `outboxes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `outbox_leaders`
--
ALTER TABLE `outbox_leaders`
  ADD CONSTRAINT `fk_outbox_leaders_leaders1` FOREIGN KEY (`leader_id`) REFERENCES `leaders` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_outbox_leaders_outboxes1` FOREIGN KEY (`outbox_id`) REFERENCES `outboxes` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_leaders1` FOREIGN KEY (`leader_id`) REFERENCES `leaders` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
