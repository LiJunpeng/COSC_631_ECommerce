-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2015-12-16 04:37:33
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `game_board`
--

-- --------------------------------------------------------

--
-- 表的结构 `accounts`
--

CREATE TABLE IF NOT EXISTS `accounts` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `first_name` varchar(32) NOT NULL,
  `last_name` varchar(32) NOT NULL,
  `email` varchar(1024) NOT NULL,
  `credit` int(32) NOT NULL,
  `sign_up_time` datetime NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `accounts`
--

INSERT INTO `accounts` (`user_id`, `username`, `password`, `first_name`, `last_name`, `email`, `credit`, `sign_up_time`) VALUES
(5, 'test', '1', 'j', 's', '1@1.com', 0, '2015-12-06 22:03:59'),
(6, 'test2', '123', 'j', 's', 'asdf@sadsfsf.com', 0, '2015-12-08 15:12:43'),
(7, 'test3', '1', '2', '3', '4@emich.edu', 4995, '2015-12-08 19:27:51');

-- --------------------------------------------------------

--
-- 表的结构 `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `admin_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(32) NOT NULL,
  `admin_password` varchar(32) NOT NULL,
  `admin_email` varchar(1024) NOT NULL,
  PRIMARY KEY (`admin_id`),
  UNIQUE KEY `admin_name` (`admin_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `admins`
--

INSERT INTO `admins` (`admin_id`, `admin_name`, `admin_password`, `admin_email`) VALUES
(1, 'admin1', '12345', 'jli12@emich.edu');

-- --------------------------------------------------------

--
-- 表的结构 `games`
--

CREATE TABLE IF NOT EXISTS `games` (
  `game_id` int(32) unsigned NOT NULL AUTO_INCREMENT,
  `game_name` varchar(32) NOT NULL,
  `game_description` text NOT NULL,
  PRIMARY KEY (`game_id`),
  UNIQUE KEY `game_name` (`game_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `games`
--

INSERT INTO `games` (`game_id`, `game_name`, `game_description`) VALUES
(1, 'Tic-tac-toe', '"Tic tac toe" and "Noughts and Crosses" redirect here. For the band, see Tic Tac Toe (band). For the novel series by Malorie Blackman, see Noughts & Crosses (novel series). For the Ian Rankin novel, see Knots and Crosses.\r\nTic-tac-toe\r\nTic tac toe.svg\r\nA completed game of Tic-tac-toe\r\nGenre(s)	Paper-and-pencil game\r\nPlayers	2\r\nSetup time.....'),
(2, 'Racing Game', 'Run! Run for you life! '),
(4, 'testgame', 'sadfasdafdsfafds');

-- --------------------------------------------------------

--
-- 表的结构 `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `item_id` int(32) unsigned NOT NULL AUTO_INCREMENT,
  `item_name` varchar(32) NOT NULL,
  `item_description` text NOT NULL,
  `credit` int(32) NOT NULL,
  `game_id` int(32) NOT NULL,
  PRIMARY KEY (`item_id`),
  UNIQUE KEY `item_name` (`item_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `items`
--

INSERT INTO `items` (`item_id`, `item_name`, `item_description`, `credit`, `game_id`) VALUES
(1, 'Three in a row', 'Win the Tic-Tac-Toe game directly', 5, 1),
(2, 'win', 'win 2nd game directly', 5, 2),
(3, 'Third choice', 'Win 3rd game directly', 5, 3),
(4, 'test_item_4', 'test_item', 5, 1),
(6, 'test_item_5', 'test_item', 5, 2),
(7, 'test_item_6', 'test_item', 5, 3);

-- --------------------------------------------------------

--
-- 表的结构 `item_list`
--

CREATE TABLE IF NOT EXISTS `item_list` (
  `list_id` int(32) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` int(32) NOT NULL,
  `user_id` int(32) NOT NULL,
  PRIMARY KEY (`list_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- 转存表中的数据 `item_list`
--

INSERT INTO `item_list` (`list_id`, `item_id`, `user_id`) VALUES
(1, 1, 7),
(2, 1, 7),
(3, 2, 7),
(4, 1, 7),
(5, 1, 7),
(6, 2, 7),
(7, 1, 7),
(8, 4, 7),
(9, 4, 7),
(10, 1, 7),
(11, 1, 7),
(12, 6, 7),
(13, 1, 7),
(14, 7, 7),
(15, 7, 7),
(16, 7, 7),
(17, 7, 7),
(18, 7, 7),
(19, 6, 7),
(20, 3, 7),
(21, 3, 7),
(22, 7, 7),
(23, 7, 7);

-- --------------------------------------------------------

--
-- 表的结构 `records`
--

CREATE TABLE IF NOT EXISTS `records` (
  `record_id` int(128) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `game_id` int(32) NOT NULL,
  `score` int(128) NOT NULL,
  `win` int(32) NOT NULL,
  `lose` int(32) NOT NULL,
  PRIMARY KEY (`record_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `records`
--

INSERT INTO `records` (`record_id`, `user_id`, `game_id`, `score`, `win`, `lose`) VALUES
(1, 7, 1, 10, 1, 2),
(2, 7, 2, 10, 1, 0),
(3, 7, 3, 10, 1, 0),
(4, 6, 1, 20, 2, 0);

-- --------------------------------------------------------

--
-- 表的结构 `rounds`
--

CREATE TABLE IF NOT EXISTS `rounds` (
  `round_id` int(128) unsigned NOT NULL AUTO_INCREMENT,
  `round_game_id` int(32) NOT NULL,
  `round_winner_id` varchar(32) NOT NULL,
  `round_start_time` datetime NOT NULL,
  `round_end_time` datetime NOT NULL,
  PRIMARY KEY (`round_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `rounds`
--

INSERT INTO `rounds` (`round_id`, `round_game_id`, `round_winner_id`, `round_start_time`, `round_end_time`) VALUES
(1, 1, '7', '2015-12-08 00:00:00', '2015-12-08 00:00:01'),
(2, 2, '7', '2015-12-08 03:04:00', '2015-12-08 03:06:00'),
(3, 3, '7', '2015-12-08 04:06:00', '2015-12-08 04:12:00'),
(4, 1, '6', '2015-12-08 00:00:00', '2015-12-08 01:00:00'),
(5, 1, '6', '2015-12-08 02:00:00', '2015-12-08 02:02:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
