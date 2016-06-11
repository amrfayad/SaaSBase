-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 11, 2016 at 12:55 PM
-- Server version: 5.6.30-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `saasBase`
--
CREATE DATABASE IF NOT EXISTS `saasBase` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `saasBase`;

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

DROP TABLE IF EXISTS `config`;
CREATE TABLE IF NOT EXISTS `config` (
  `config_id` int(11) NOT NULL AUTO_INCREMENT,
  `config_name` varchar(45) DEFAULT NULL,
  `config_value` longtext,
  PRIMARY KEY (`config_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Truncate table before insert `config`
--

TRUNCATE TABLE `config`;
-- --------------------------------------------------------

--
-- Table structure for table `invitedUsers`
--

DROP TABLE IF EXISTS `invitedUsers`;
CREATE TABLE IF NOT EXISTS `invitedUsers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_email` varchar(45) DEFAULT NULL,
  `teams_team_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_invitedUsers_teams1_idx` (`teams_team_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Truncate table before insert `invitedUsers`
--

TRUNCATE TABLE `invitedUsers`;
-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

DROP TABLE IF EXISTS `invoices`;
CREATE TABLE IF NOT EXISTS `invoices` (
  `invoice_id` int(11) NOT NULL AUTO_INCREMENT,
  `subscr_name` varchar(45) DEFAULT NULL,
  `other_information` longtext,
  `teams_team_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`invoice_id`,`teams_team_id`),
  KEY `fk_invoices_teams1_idx` (`teams_team_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Truncate table before insert `invoices`
--

TRUNCATE TABLE `invoices`;
-- --------------------------------------------------------

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(45) DEFAULT NULL,
  `role_status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Truncate table before insert `role`
--

TRUNCATE TABLE `role`;
--
-- Dumping data for table `role`
--

INSERT DELAYED IGNORE INTO `role` (`role_id`, `role_name`, `role_status`) VALUES
(1, 'normal', 1),
(2, 'billing', 1);

-- --------------------------------------------------------

--
-- Table structure for table `role_has_users_in_teams`
--

DROP TABLE IF EXISTS `role_has_users_in_teams`;
CREATE TABLE IF NOT EXISTS `role_has_users_in_teams` (
  `role_id` int(11) NOT NULL,
  `users_in_teams_user_id` int(11) NOT NULL,
  `users_in_teams_team_id` int(11) NOT NULL,
  PRIMARY KEY (`role_id`,`users_in_teams_user_id`,`users_in_teams_team_id`),
  KEY `fk_role_has_users_in_teams_users_in_teams1_idx` (`users_in_teams_user_id`,`users_in_teams_team_id`),
  KEY `fk_role_has_users_in_teams_role1_idx` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `role_has_users_in_teams`
--

TRUNCATE TABLE `role_has_users_in_teams`;
-- --------------------------------------------------------

--
-- Table structure for table `subscribtions`
--

DROP TABLE IF EXISTS `subscribtions`;
CREATE TABLE IF NOT EXISTS `subscribtions` (
  `subscr_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`subscr_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Truncate table before insert `subscribtions`
--

TRUNCATE TABLE `subscribtions`;
--
-- Dumping data for table `subscribtions`
--

INSERT DELAYED IGNORE INTO `subscribtions` (`subscr_id`, `name`) VALUES
(1, 'CRM Silver'),
(2, 'CRM Gold');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

DROP TABLE IF EXISTS `teams`;
CREATE TABLE IF NOT EXISTS `teams` (
  `team_id` int(11) NOT NULL AUTO_INCREMENT,
  `users_user_id` int(11) NOT NULL,
  `payment_status` tinyint(1) DEFAULT '0',
  `subscribtions_subscr_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`team_id`),
  KEY `fk_teams_users1_idx` (`users_user_id`),
  KEY `fk_teams_subscribtions1_idx` (`subscribtions_subscr_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Truncate table before insert `teams`
--

TRUNCATE TABLE `teams`;
-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(45) DEFAULT NULL,
  `user_email` varchar(45) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `reset_password_token` varchar(100) DEFAULT NULL,
  `token_expiration_date` datetime DEFAULT NULL,
  `user_profile_info` longtext,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Truncate table before insert `users`
--

TRUNCATE TABLE `users`;
-- --------------------------------------------------------

--
-- Table structure for table `users_in_teams`
--

DROP TABLE IF EXISTS `users_in_teams`;
CREATE TABLE IF NOT EXISTS `users_in_teams` (
  `users_user_id` int(11) NOT NULL,
  `teams_team_id` int(11) NOT NULL,
  `Is_accept` tinyint(1) DEFAULT NULL,
  `Is_active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`users_user_id`,`teams_team_id`),
  KEY `fk_users_has_teams_teams1_idx` (`teams_team_id`),
  KEY `fk_users_has_teams_users1_idx` (`users_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `users_in_teams`
--

TRUNCATE TABLE `users_in_teams`;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `invitedUsers`
--
ALTER TABLE `invitedUsers`
  ADD CONSTRAINT `fk_invitedUsers_teams1` FOREIGN KEY (`teams_team_id`) REFERENCES `teams` (`team_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `fk_invoices_teams1` FOREIGN KEY (`teams_team_id`) REFERENCES `teams` (`team_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_has_users_in_teams`
--
ALTER TABLE `role_has_users_in_teams`
  ADD CONSTRAINT `fk_role_has_users_in_teams_role1` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_role_has_users_in_teams_users_in_teams1` FOREIGN KEY (`users_in_teams_user_id`, `users_in_teams_team_id`) REFERENCES `users_in_teams` (`users_user_id`, `teams_team_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `teams`
--
ALTER TABLE `teams`
  ADD CONSTRAINT `fk_teams_subscribtions1` FOREIGN KEY (`subscribtions_subscr_id`) REFERENCES `subscribtions` (`subscr_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_teams_users1` FOREIGN KEY (`users_user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users_in_teams`
--
ALTER TABLE `users_in_teams`
  ADD CONSTRAINT `fk_users_has_teams_teams1` FOREIGN KEY (`teams_team_id`) REFERENCES `teams` (`team_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_has_teams_users1` FOREIGN KEY (`users_user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
