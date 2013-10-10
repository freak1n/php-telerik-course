-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 09, 2013 at 01:25 PM
-- Server version: 5.5.31
-- PHP Version: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `php_course`
--
CREATE DATABASE IF NOT EXISTS `php_course` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `php_course`;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `text` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `username` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `title`, `text`, `created_at`, `username`) VALUES
(1, 'Hello World', 'Hello world!', '2013-10-09 09:14:48', 'yavcho'),
(2, 'hello 2 worlds', 'Hello 2 worlds', '2013-10-09 09:14:48', 'yavcho'),
(3, 'dsadas', 'dasdas', '2013-10-09 11:11:24', 'yavcho'),
(4, 'dsadsa', 'dasdsadas', '2013-10-09 11:12:01', 'yavcho'),
(5, 'dsadasdas', 'dasdsadsa', '2013-10-09 11:12:04', 'yavcho'),
(6, 'dsadsa', 'dsadsa', '2013-10-09 11:12:26', 'yavcho'),
(7, 'New msg', 'new msg', '2013-10-09 11:12:35', 'yavcho'),
(8, 'dasd', 'sadasdsa', '2013-10-09 11:13:45', 'gotin123');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'yavcho', 'pafcho', '2013-10-08 23:24:11'),
(2, 'yavcho1', '123456', '2013-10-08 23:42:32'),
(3, '?', '?', '2013-10-08 23:45:33'),
(4, '?', '?', '2013-10-08 23:47:41'),
(5, '?', '?', '2013-10-08 23:48:44'),
(6, 'peshko1', 'qazxsw', '2013-10-08 23:52:11'),
(7, 'peshko123', '123456', '2013-10-08 23:52:28'),
(8, 'peshko12', 'qazxsw', '2013-10-08 23:53:57'),
(9, 'gotin123', 'gotin123', '2013-10-09 11:13:31');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
