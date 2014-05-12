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


--
-- Table structure for table `ctrip_Flight`
--


CREATE TABLE IF NOT EXISTS `ctrip_Flight` (
	`DepartCityCode` char(3) COLLATE ascii_general_ci NOT NULL,
	`ArriveCityCode` char(3) COLLATE ascii_general_ci NOT NULL,
	`TakeOffTime` char(20) COLLATE ascii_general_ci NOT NULL,
	`ArriveTime` char(20) COLLATE ascii_general_ci NOT NULL,
	`Flight` char(6) COLLATE ascii_general_ci NOT NULL,
	`CraftType` varchar(5) COLLATE ascii_general_ci NOT NULL,
	`AirlineCode` char(2) COLLATE ascii_general_ci NOT NULL,
	`Class` char(1) COLLATE ascii_general_ci NOT NULL,
	`SubClass` char(1) COLLATE ascii_general_ci NOT NULL,
	`DisplaySubclass` char(1) COLLATE ascii_general_ci NOT NULL,
	`Rate` varchar(5) COLLATE ascii_general_ci NOT NULL,
	`Price` varchar(8) COLLATE ascii_general_ci NOT NULL,
	`StandardPrice` varchar(8) COLLATE ascii_general_ci NOT NULL,
	`ChildStandardPrice` varchar(8) COLLATE ascii_general_ci NOT NULL,
	`BabyStandardPrice` varchar(8) COLLATE ascii_general_ci NOT NULL,
	`MealType` char(1) COLLATE ascii_general_ci NOT NULL,
	`AdultTax` varchar(2) COLLATE ascii_general_ci NOT NULL,
	`BabyTax` varchar(2) COLLATE ascii_general_ci NOT NULL,
	`ChildTax` varchar(2) COLLATE ascii_general_ci NOT NULL,
	`AdultOilFee` varchar(10) COLLATE ascii_general_ci NOT NULL,
	`BabyOilFee` varchar(10) COLLATE ascii_general_ci NOT NULL,
	`ChildOilFee` varchar(10) COLLATE ascii_general_ci NOT NULL,
	`DPortCode` char(3) COLLATE ascii_general_ci NOT NULL,
	`APortCode` char(3) COLLATE ascii_general_ci NOT NULL,
	`DPortBuildingID` varchar(3) COLLATE ascii_general_ci NOT NULL,
	`APortBuildingID` varchar(3) COLLATE ascii_general_ci NOT NULL,
	`StopTimes` varchar(1) COLLATE ascii_general_ci NOT NULL,
	`Nonrer` char(1) COLLATE ascii_general_ci NOT NULL,
	`Nonend` char(1) COLLATE ascii_general_ci NOT NULL,
	`Nonref` char(1) COLLATE ascii_general_ci NOT NULL,
	`Rernote` varchar(255) COLLATE utf8_bin NOT NULL,
	`Endnote` varchar(5) COLLATE utf8_bin NOT NULL,
	`Refnote` varchar(127) COLLATE utf8_bin NOT NULL,
	`Remarks` varchar(7) COLLATE utf8_bin NOT NULL,
	`TicketType` varchar(4) COLLATE ascii_general_ci NOT NULL,
	`BeforeFlyDate` varchar(1) COLLATE ascii_general_ci NOT NULL,
	`Quantity` varchar(3) COLLATE ascii_general_ci NOT NULL,
	`PriceType` varchar(15) COLLATE ascii_general_ci NOT NULL,
	`ProductType` varchar(8) COLLATE ascii_general_ci NOT NULL,
	`ProductSource` char(1) COLLATE ascii_general_ci NOT NULL,
	`InventoryType` char(3) COLLATE ascii_general_ci NOT NULL,
	`RouteIndex` varchar(1) COLLATE ascii_general_ci NOT NULL,
	`NeedApplyString` varchar(1) COLLATE ascii_general_ci NOT NULL,
	`Recommend` varchar(1) COLLATE ascii_general_ci NOT NULL,
	`RefundFeeFormulaID` varchar(2) COLLATE ascii_general_ci NOT NULL,
	`CanUpGrade` tinyint(1) COLLATE ascii_general_ci NOT NULL,
	`CanSeparateSale` tinyint(1) COLLATE ascii_general_ci NOT NULL,
	`CanNoDefer` tinyint(1) COLLATE ascii_general_ci NOT NULL,
	`IsFlyMan` tinyint(1) COLLATE ascii_general_ci NOT NULL,
	`OnlyOwnCity` tinyint(1) COLLATE ascii_general_ci NOT NULL,
	`IsLowestPrice` tinyint(1) COLLATE ascii_general_ci NOT NULL,
	`IsLowestCZSpecialPrice` tinyint(1) COLLATE ascii_general_ci NOT NULL,
	`PunctualityRate` varchar(3) COLLATE ascii_general_ci NOT NULL,
	`PolicyID` varchar(6) COLLATE ascii_general_ci NOT NULL,
	`AllowCPType` varchar(4) COLLATE ascii_general_ci NOT NULL,
	`OutOfPostTime` tinyint(1) COLLATE ascii_general_ci NOT NULL,
	`OutOfSendGetTime` tinyint(1) COLLATE ascii_general_ci NOT NULL,
	`OutOfAirlineCounterTime` tinyint(1) COLLATE ascii_general_ci NOT NULL,
	`CanPost` tinyint(1) COLLATE ascii_general_ci NOT NULL,
	`CanAirlineCounter` tinyint(1) COLLATE ascii_general_ci NOT NULL,
	`CanSendGet` tinyint(1) COLLATE ascii_general_ci NOT NULL,
	`IsRebate` tinyint(1) COLLATE ascii_general_ci NOT NULL,
	`RebateAmount` tinyint(1) COLLATE ascii_general_ci NOT NULL,
	`RebateCPCity` tinyint(1) COLLATE ascii_general_ci NOT NULL,
	KEY (`DepartCityCode`, `ArriveCityCode`)
) ENGINE=InnoDB DEFAULT CHARSET=ascii COLLATE=ascii_general_ci AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
