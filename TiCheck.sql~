-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 06, 2014 at 11:55 AM
-- Server version: 5.5.30
-- PHP Version: 5.5.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `TiCheck`
CREATE DATABASE IF NOT EXISTS `TiCheck`
  CHARACTER SET utf8;
--
-- --------------------------------------------------------
use TiCheck;
--
-- Table structure for table `Subscription`
--

CREATE TABLE IF NOT EXISTS `Subscription` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `DepartCity` char(3) COLLATE utf8_bin NOT NULL,
  `ArriveCity` char(3) COLLATE utf8_bin NOT NULL,
  `StartDate` date NOT NULL,
  `EndDate` date NOT NULL,
  `EarliestDepartTime` time DEFAULT NULL,
  `LatestDepartTime` time DEFAULT NULL,
  `PriceLimit` int(11) DEFAULT NULL,
  `AirlineDibitCode` char(2) COLLATE utf8_bin DEFAULT NULL,
  `ArriveAirport` char(3) COLLATE utf8_bin DEFAULT NULL,
  `DepartAirport` char(3) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID` (`ID`),
  KEY `DepartCity` (`DepartCity`,`ArriveCity`,`StartDate`,`EndDate`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `TiUser`
--

CREATE TABLE IF NOT EXISTS `TiUser` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `Account` varchar(64) COLLATE utf8_bin DEFAULT NULL,
  `Password` varchar(64) COLLATE utf8_bin NOT NULL,
  `Email` varchar(320) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Email`),
  UNIQUE KEY `ID` (`ID`),
  KEY `Account` (`Account`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `User_Device`
--

CREATE TABLE IF NOT EXISTS `User_Device` (
  `Device_token` varchar(64) COLLATE utf8_bin NOT NULL,
  `ID_user` bigint(20) unsigned NOT NULL,
  FOREIGN KEY (`ID_user`) REFERENCES TiUser(`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `User_Subscription`
--

CREATE TABLE IF NOT EXISTS `User_Subscription` (
  `ID_user` bigint(20) unsigned  NOT NULL,
  `ID_subscription` bigint(20) unsigned  NOT NULL,
  FOREIGN KEY (`ID_user`) REFERENCES TiUser(`ID`),
  FOREIGN KEY (`ID_subscription`) REFERENCES Subscription(`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `HistoryPrice`
--

CREATE TABLE IF NOT EXISTS `HistoryPrice` (
  `ID_subscription` bigint(20) unsigned NOT NULL,
  `Price` int(11) NOT NULL,
  `Date` date NOT NULL,
  KEY `ID_subscription` (`ID_subscription`),
  FOREIGN KEY (`ID_subscription`) REFERENCES Subscription(`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
