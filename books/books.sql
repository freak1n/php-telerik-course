-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Време на генериране: 
-- Версия на сървъра: 5.6.12-log
-- Версия на PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- БД: `books`
--
CREATE DATABASE IF NOT EXISTS `books` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `books`;

-- --------------------------------------------------------

--
-- Структура на таблица `authors`
--

CREATE TABLE IF NOT EXISTS `authors` (
  `author_id` int(11) NOT NULL AUTO_INCREMENT,
  `author_name` varchar(250) NOT NULL,
  PRIMARY KEY (`author_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Схема на данните от таблица `authors`
--

INSERT INTO `authors` (`author_id`, `author_name`) VALUES
(1, 'Симеон Радев'),
(2, 'Ричард Бандлър'),
(3, 'Джон Ла Вал'),
(4, 'Иван Иванов'),
(5, 'Иван Иванов'),
(6, 'Георги Петров'),
(7, 'Георги Петров'),
(8, 'Жоро Иванов бее'),
(9, 'Явор Михайлов'),
(10, 'Георги Иванов Гонзо'),
(11, 'Деда ми'),
(12, 'Гошо от почивка бе брат'),
(13, 'dasdasdsa'),
(14, 'dasdas'),
(15, 'ffff'),
(16, 'fdds'),
(17, 'gdgsdf');

-- --------------------------------------------------------

--
-- Структура на таблица `books`
--

CREATE TABLE IF NOT EXISTS `books` (
  `book_id` int(11) NOT NULL AUTO_INCREMENT,
  `book_title` varchar(250) NOT NULL,
  PRIMARY KEY (`book_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Схема на данните от таблица `books`
--

INSERT INTO `books` (`book_id`, `book_title`) VALUES
(1, 'Убеждаване и въздействие'),
(2, 'Македония и българското възраждане'),
(7, 'Нотата'),
(5, 'Зайко Байко'),
(6, 'Присънче бе брат'),
(8, 'Добренгиа'),
(9, 'Добре ли е'),
(10, 'Айде вече'),
(11, 'ДААА'),
(12, 'dasdasas'),
(13, 'dasdasas'),
(14, 'dsadas'),
(15, 'dsadas'),
(16, 'dsadas'),
(17, 'sdg'),
(18, 'dasdas'),
(19, 'dasdsa'),
(20, 'dsadas'),
(21, 'dasdasdas'),
(22, 'dsadas'),
(23, 'дадада'),
(24, 'ddsaaa');

-- --------------------------------------------------------

--
-- Структура на таблица `books_authors`
--

CREATE TABLE IF NOT EXISTS `books_authors` (
  `book_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  KEY `book_id` (`book_id`),
  KEY `author_id` (`author_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `books_authors`
--

INSERT INTO `books_authors` (`book_id`, `author_id`) VALUES
(1, 2),
(1, 3),
(2, 1),
(2, 2),
(5, 9),
(5, 10),
(6, 1),
(6, 9),
(7, 1),
(7, 3),
(7, 8),
(7, 9),
(8, 1),
(8, 4),
(8, 8),
(8, 11),
(9, 4),
(9, 7),
(10, 3),
(10, 4),
(10, 7),
(11, 5),
(11, 12),
(12, 7),
(12, 9),
(13, 7),
(13, 9),
(14, 2),
(14, 4),
(14, 6),
(15, 2),
(15, 4),
(15, 6),
(16, 3),
(16, 7),
(16, 11),
(17, 5),
(18, 7),
(18, 10),
(18, 12),
(19, 6),
(19, 9),
(19, 13),
(20, 6),
(20, 11),
(21, 3),
(21, 6),
(21, 8),
(22, 5),
(22, 8),
(23, 1),
(23, 4),
(24, 3),
(24, 9);

-- --------------------------------------------------------

--
-- Структура на таблица `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL DEFAULT '0',
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'pesho', 'taina'),
(2, 'goshko', 'taina2'),
(0, 'yavcho', '12345'),
(0, 'gotiniq12345', 'gotiniq12345'),
(0, 'peshoo', 'pesho123'),
(0, '12345', '12345');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
