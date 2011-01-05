-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 05, 2011 at 08:11 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `nis`
--

-- --------------------------------------------------------

--
-- Table structure for table `Abilities`
--

CREATE TABLE IF NOT EXISTS `Abilities` (
  `a_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `a_name` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`a_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `Abilities`
--

INSERT INTO `Abilities` (`a_id`, `a_name`) VALUES
(1, 'Programing'),
(2, 'skiing'),
(3, 'kite-surfing'),
(10, 'everything');

-- --------------------------------------------------------

--
-- Table structure for table `Accountings`
--

CREATE TABLE IF NOT EXISTS `Accountings` (
  `ac_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Offers_o_id` int(10) unsigned NOT NULL,
  `Persons_p_nr` int(10) unsigned NOT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`ac_id`),
  KEY `Accountings_FKIndex1` (`Persons_p_nr`),
  KEY `Accountings_FKIndex2` (`Offers_o_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `Accountings`
--

INSERT INTO `Accountings` (`ac_id`, `Offers_o_id`, `Persons_p_nr`, `date`) VALUES
(1, 1, 1, '2011-01-05');

-- --------------------------------------------------------

--
-- Table structure for table `Offers`
--

CREATE TABLE IF NOT EXISTS `Offers` (
  `o_id` int(11) NOT NULL AUTO_INCREMENT,
  `o_name` varchar(64) DEFAULT NULL,
  `max_participants` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`o_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `Offers`
--

INSERT INTO `Offers` (`o_id`, `o_name`, `max_participants`) VALUES
(1, 'Google', 19),
(2, 'IBM_Project', 19),
(3, 'Atomic_Racing', 20),
(4, 'Google2', 19),
(5, 'IBM_Project2', 19),
(6, 'ski-race3', 18);

-- --------------------------------------------------------

--
-- Table structure for table `Offer_Abilities`
--

CREATE TABLE IF NOT EXISTS `Offer_Abilities` (
  `Abilities_a_id` int(10) unsigned NOT NULL,
  `Offers_o_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`Abilities_a_id`,`Offers_o_id`),
  KEY `Abilities_has_Offers_FKIndex1` (`Abilities_a_id`),
  KEY `Abilities_has_Offers_FKIndex2` (`Offers_o_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Offer_Abilities`
--

INSERT INTO `Offer_Abilities` (`Abilities_a_id`, `Offers_o_id`) VALUES
(1, 1),
(1, 2),
(1, 4),
(1, 5),
(2, 3),
(2, 6);

-- --------------------------------------------------------

--
-- Table structure for table `Persons`
--

CREATE TABLE IF NOT EXISTS `Persons` (
  `p_nr` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`p_nr`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `Persons`
--

INSERT INTO `Persons` (`p_nr`, `name`) VALUES
(1, 'mviertler'),
(2, 'mhraschan'),
(3, 'fachleitner');

-- --------------------------------------------------------

--
-- Table structure for table `Persons_Abilities`
--

CREATE TABLE IF NOT EXISTS `Persons_Abilities` (
  `Persons_p_nr` int(10) unsigned NOT NULL,
  `Abilities_a_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`Persons_p_nr`,`Abilities_a_id`),
  KEY `Persons_has_Abilities_FKIndex1` (`Persons_p_nr`),
  KEY `Persons_has_Abilities_FKIndex2` (`Abilities_a_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Persons_Abilities`
--

INSERT INTO `Persons_Abilities` (`Persons_p_nr`, `Abilities_a_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 1),
(2, 3),
(3, 10);
