-- phpMyAdmin SQL Dump
-- version 3.3.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 03, 2017 at 05:22 AM
-- Server version: 5.0.90
-- PHP Version: 5.2.14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `cid` int(11) NOT NULL auto_increment,
  `follow` int(11) NOT NULL default '0',
  `number` tinyint(5) NOT NULL default '0',
  `name` varchar(10) NOT NULL,
  PRIMARY KEY  (`cid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cid`, `follow`, `number`, `name`) VALUES
(1, 0, 0, 'ç»¼åˆ'),
(2, 0, 0, 'å¨±ä¹'),
(4, 0, 0, 'é¥®é£Ÿ'),
(5, 0, 0, 'æ´»åŠ¨'),
(11, 0, 0, 'ä½“è‚²');

-- --------------------------------------------------------

--
-- Table structure for table `file`
--

CREATE TABLE IF NOT EXISTS `file` (
  `fid` int(11) NOT NULL auto_increment,
  `uid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `path` varchar(30) NOT NULL,
  `type` varchar(10) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY  (`fid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `file`
--


-- --------------------------------------------------------

--
-- Table structure for table `record`
--

CREATE TABLE IF NOT EXISTS `record` (
  `rid` int(11) NOT NULL auto_increment,
  `uid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `follow` int(11) NOT NULL default '0',
  `useful` int(5) NOT NULL default '0',
  `content` text NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY  (`rid`),
  KEY `cid` (`cid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=8 ;

--
-- Dumping data for table `record`
--

INSERT INTO `record` (`rid`, `uid`, `cid`, `follow`, `useful`, `content`, `created`) VALUES
(1, 1, 1, 0, 0, ' Hello world.\r\n\r\nThis is a simple cms that created by php', '2017-05-25 16:26:45'),
(2, 1, 1, 1, 0, 'this is first post.', '2017-05-25 16:28:14'),
(3, 1, 1, 1, 0, 'ok, then, what are we do next', '2017-05-27 10:17:51'),
(4, 1, 1, 1, 0, 'è¯•ä¸‹ä¸­æ–‡', '2017-05-27 11:24:53'),
(5, 1, 1, 1, 0, 'great. this is done.', '2017-06-03 12:36:49'),
(6, 1, 1, 1, 0, 'i am coming for commentting', '2017-06-03 12:51:56'),
(7, 1, 1, 1, 0, 'test test', '2017-06-03 13:02:37');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `uid` int(11) NOT NULL auto_increment,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `level` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `username`, `password`, `level`) VALUES
(1, 'zcadmin', '8888', 9),
(2, 'zcedit', '8888', 6),
(6, 'test', '8888', 3),
(9, 'viewer', '8888', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_log`
--

CREATE TABLE IF NOT EXISTS `user_log` (
  `ulid` int(11) NOT NULL auto_increment,
  `uid` int(11) NOT NULL,
  `ukey` varchar(30) NOT NULL,
  `uval` varchar(30) NOT NULL,
  PRIMARY KEY  (`ulid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `user_log`
--

INSERT INTO `user_log` (`ulid`, `uid`, `ukey`, `uval`) VALUES
(2, 1, 'last_post_ip', '127.0.0.1'),
(3, 1, 'last_post_time', '02'),
(4, 1, 'web_logo', '2151515151.jpg'),
(8, 1, 'web_des', ''),
(6, 1, 'web_header', 'å¢žåŸŽåšå®¢'),
(7, 1, 'web_title', 'å¢žåŸŽåšå®¢ v1');

-- --------------------------------------------------------

--
-- Table structure for table `user_status`
--

CREATE TABLE IF NOT EXISTS `user_status` (
  `usid` int(11) NOT NULL auto_increment,
  `uid` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `exptime` varchar(20) NOT NULL,
  `token` varchar(50) NOT NULL,
  PRIMARY KEY  (`usid`)
) ENGINE=MyISAM  DEFAULT CHARSET=ascii AUTO_INCREMENT=10 ;

--
-- Dumping data for table `user_status`
--

INSERT INTO `user_status` (`usid`, `uid`, `created`, `exptime`, `token`) VALUES
(9, 1, '2017-06-01 15:26:03', '20170604152603', 'ed7d536a042f0d13260653da85ecf5c6'),
(8, 1, '2017-05-27 11:07:46', '20170530110746', '59c7d78b01501ba48449c4c4f61ff90e');
