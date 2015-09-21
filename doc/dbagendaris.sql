-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 21, 2015 at 10:51 AM
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
  KEY `fk_leader_unit_mails_leaders1_idx` (`leader_id`),
  KEY `mail_inbox_id` (`mail_inbox_id`,`leader_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `leader_mails`
--

INSERT INTO `leader_mails` (`mail_inbox_id`, `leader_id`, `status`) VALUES
(3, 3, 1),
(3, 7, 1),
(3, 1, 0),
(3, 7, 0),
(5, 3, 0),
(5, 1, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `mail_inbox`
--

INSERT INTO `mail_inbox` (`id`, `leader_id`, `mail_type`, `no_surat`, `no_arsip`, `lampiran`, `perihal`, `asal_surat`, `message_leader`, `message_leader_assistant`, `file`, `created`, `received_date`, `limit_date`, `leader_status`, `leader_assistant_status`, `leader_unit_status`) VALUES
(2, 2, 1, '012348909', '09345908430958', 'Controller''s constructor now takes two parameters', 'A CakeRequest, and CakeResponse objects', 'PT. Telkomnesia', 'These objects are used to populate several deprecated properties and will be set to $request and $re- sponse inside the controller. ', 'c,kd', '', '2015-08-24 15:38:38', '2015-08-24', '2015-08-24', 0, 0, 0),
(3, 2, 1, '001', '002', 'The second parameter indicates the length of the time-intervals between each execution.', 'The setInterval() Method', 'w3school', 'Jancok', 'Cuk gogo power ranger', '', '2015-09-09 15:18:28', '2015-09-09', '2015-09-09', 1, 0, 0),
(5, 2, 3, '03293', '04589', 'Creates a select element populated with the years from $minYear to $maxYear.', 'Creating date and time inputs', 'CakePHP Developer', 'panjangkan otong mu', 'tancap gas', '', '2015-09-14 21:53:27', '2015-01-15', '2015-04-12', 0, 0, 0);

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
  ADD CONSTRAINT `fk_unit_leader_mails_mail_inbox1` FOREIGN KEY (`mail_inbox_id`) REFERENCES `mail_inbox` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `mail_inbox`
--
ALTER TABLE `mail_inbox`
  ADD CONSTRAINT `fk_mail_inbox_leaders1` FOREIGN KEY (`leader_id`) REFERENCES `leaders` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_leaders1` FOREIGN KEY (`leader_id`) REFERENCES `leaders` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
