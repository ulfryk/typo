-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 11, 2012 at 07:45 AM
-- Server version: 5.5.23
-- PHP Version: 5.3.15

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `typo`
--

-- --------------------------------------------------------

--
-- Table structure for table `letters`
--

CREATE TABLE IF NOT EXISTS `letters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pack` varchar(50) NOT NULL,
  `row` varchar(15) NOT NULL,
  `range` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `letters`
--

INSERT INTO `letters` (`id`, `pack`, `row`, `range`) VALUES
(0, 'asdf', 'home', 'left'),
(1, 'jkl;', 'home', 'right'),
(2, 'asdfg', 'home', 'leftex'),
(3, 'hjkl;', 'home', 'rightex'),
(4, 'asdfghjkl;', 'home', 'both');

-- --------------------------------------------------------

--
-- Table structure for table `words`
--

CREATE TABLE IF NOT EXISTS `words` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `word` varchar(30) NOT NULL,
  `range` varchar(15) NOT NULL,
  `row` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `words`
--

INSERT INTO `words` (`id`, `word`, `range`, `row`) VALUES
(1, 'fagas', 'left', 'home');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
