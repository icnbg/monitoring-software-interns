-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2015 at 09:59 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `icn`
--

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `site_id` int(10) NOT NULL,
  `url` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `clicks` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE IF NOT EXISTS `visitors` (
  `site_id` int(10) NOT NULL,
  `ip` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `date_update` datetime NOT NULL,
  `clicks` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `visitors`
--

INSERT INTO `visitors` (`site_id`, `ip`, `date`, `date_update`, `clicks`) VALUES
(0, '::1', '2015-07-21', '2015-07-21 09:29:15', 1),
(0, '::1', '2015-07-21', '2015-07-21 09:29:52', 1),
(2, 'dsad', '2015-07-13', '2015-07-23 07:23:30', 1);

-- --------------------------------------------------------

--
-- Table structure for table `websites`
--

CREATE TABLE IF NOT EXISTS `websites` (
`id` int(10) NOT NULL,
  `host` varchar(100) NOT NULL,
  `password` varchar(64) NOT NULL,
  `name` varchar(50) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `websites`
--

INSERT INTO `websites` (`id`, `host`, `password`, `name`, `date`) VALUES
(1, 'google.bg', 'googlepass', 'Google', '2015-07-16 00:00:00'),
(2, 'blabla.bg', '', 'blabla', '0000-00-00 00:00:00'),
(3, 'bdsadsadsa', '', 'dsadsaadssda', '0000-00-00 00:00:00'),
(4, 'blabla.bg', '', 'blabla', '0000-00-00 00:00:00'),
(5, 'blabla.bg', '', 'blabla', '0000-00-00 00:00:00'),
(6, 'blabla.bg', '', 'blabla', '0000-00-00 00:00:00'),
(7, 'blabla.bg', '', 'blabla', '0000-00-00 00:00:00'),
(8, 'blabla.bg', '', 'blabla', '0000-00-00 00:00:00'),
(9, 'pesho', '', '', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `visitors`
--
ALTER TABLE `visitors`
 ADD KEY `ip` (`ip`);

--
-- Indexes for table `websites`
--
ALTER TABLE `websites`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `websites`
--
ALTER TABLE `websites`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
