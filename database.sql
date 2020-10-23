-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql103.epizy.com
-- Generation Time: Oct 22, 2020 at 04:17 AM
-- Server version: 5.6.48-88.0
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ctfdatabase`
--
CREATE DATABASE IF NOT EXISTS `ctfdatabase` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `ctfdatabase`;

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

DROP TABLE IF EXISTS `announcement`;
CREATE TABLE `announcement` (
  `Title` varchar(64) NOT NULL,
  `description` varchar(1024) NOT NULL,
  `make_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `QUESTIONS`
--

DROP TABLE IF EXISTS `QUESTIONS`;
CREATE TABLE `QUESTIONS` (
  `QUES_ID` bigint(20) NOT NULL,
  `QUES_NAME` varchar(64) NOT NULL,
  `QUES_TYPE` varchar(32) NOT NULL DEFAULT 'Basic',
  `QUES_FLAG` varchar(256) NOT NULL,
  `POINTS` bigint(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `SUBMITS`
--

DROP TABLE IF EXISTS `SUBMITS`;
CREATE TABLE `SUBMITS` (
  `USER_ID` bigint(20) NOT NULL,
  `QUES_ID` bigint(20) NOT NULL,
  `TIME` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `USERS`
--

DROP TABLE IF EXISTS `USERS`;
CREATE TABLE `USERS` (
  `USER_ID` bigint(20) NOT NULL,
  `USER_NAME` varchar(32) NOT NULL,
  `PASSWORD` varchar(64) NOT NULL,
  `POINTS` bigint(20) NOT NULL DEFAULT '0',
  `LAST_ACTIVITY` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `QUESTIONS`
--
ALTER TABLE `QUESTIONS`
  ADD PRIMARY KEY (`QUES_ID`);

--
-- Indexes for table `SUBMITS`
--
ALTER TABLE `SUBMITS`
  ADD PRIMARY KEY (`USER_ID`,`QUES_ID`);

--
-- Indexes for table `USERS`
--
ALTER TABLE `USERS`
  ADD PRIMARY KEY (`USER_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `QUESTIONS`
--
ALTER TABLE `QUESTIONS`
  MODIFY `QUES_ID` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `USERS`
--
ALTER TABLE `USERS`
  MODIFY `USER_ID` bigint(20) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
