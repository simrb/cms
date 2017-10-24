-- 
-- 1, change the cms_db, cms_user, cms_pawd, as you want
-- 2, and execute the file with root user
--
--

create database cms_db;

create user 'cms_user'@'localhost' identified by 'cms_pawd';
grant all privileges on cms_db.* to cms_user@localhost identified by 'cms_pawd';
flush privileges;

use cms_db;


SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- --------------------------------------------------------

--
-- Table structure for table `category`
--
CREATE TABLE `category` (
  `cid` int(11) NOT NULL auto_increment,
  `follow` int(11) NOT NULL default '0',
  `number` tinyint(5) NOT NULL default '0',
  `name` varchar(10) NOT NULL,
  PRIMARY KEY  (`cid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cid`, `follow`, `number`, `name`) VALUES
(1, 0, 0, 'general'),
(2, 0, 0, 'talk'),
(3, 0, 0, 'show');

-- --------------------------------------------------------

--
-- Table structure for table `file`
--
CREATE TABLE `file` (
  `fid` int(11) NOT NULL auto_increment,
  `uid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `path` varchar(30) NOT NULL,
  `type` varchar(10) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY  (`fid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `file`
--


-- --------------------------------------------------------

--
-- Table structure for table `record`
--
CREATE TABLE `record` (
  `rid` int(11) NOT NULL auto_increment,
  `uid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `follow` int(11) NOT NULL default '0',
  `useful` int(5) NOT NULL default '0',
  `content` text NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY  (`rid`),
  KEY `cid` (`cid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1 ;

--
-- Dumping data for table `record`
--

INSERT INTO `record` (`rid`, `uid`, `cid`, `follow`, `useful`, `content`, `created`) VALUES
(1, 1, 1, 0, 0, 'About the cms.\r\r\nIt is a ranger of cms, we devote to simplicity, rudeness.', '2017-05-25 16:26:45'),
(2, 1, 1, 1, 0, 'this is first comment.', '2017-05-25 16:28:14'),
(3, 1, 1, 0, 0, 'About the project.\r\n\r\nThis is a cms created by php.', '2017-05-27 11:24:53');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--
CREATE TABLE `user` (
  `uid` int(11) NOT NULL auto_increment,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `level` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `username`, `password`, `level`) VALUES
(1, 'zcadmin', '8888', 9),
(2, 'zcedit', '8888', 6),
(3, 'test', '8888', 3),
(4, 'viewer', '8888', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_log`
--
CREATE TABLE `user_log` (
  `ulid` int(11) NOT NULL auto_increment,
  `uid` int(11) NOT NULL,
  `ukey` varchar(30) NOT NULL,
  `uval` varchar(50) NOT NULL,
  PRIMARY KEY  (`ulid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `user_log`
--

INSERT INTO `user_log` (`ulid`, `uid`, `ukey`, `uval`) VALUES
(1, 1, 'open_comment', 'on'),
(2, 1, 'last_post_ip', '127.0.0.1'),
(3, 1, 'last_post_time', '02'),
(4, 1, 'allow_post_by_guest', '50'),
(5, 1, 'web_logo', '12345.jpg'),
(6, 1, 'web_des', 'It is a ranger of cms, we devote to simplicity, rudeness.'),
(7, 1, 'web_header', 'New site'),
(8, 1, 'web_title', 'A ranger of cms');

-- --------------------------------------------------------

--
-- Table structure for table `user_status`
--
CREATE TABLE `user_status` (
  `usid` int(11) NOT NULL auto_increment,
  `uid` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `exptime` varchar(20) NOT NULL,
  `token` varchar(50) NOT NULL,
  PRIMARY KEY  (`usid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


