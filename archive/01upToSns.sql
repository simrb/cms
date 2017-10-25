-- 
-- add table record_log
--
--

use cms_db;

-- --------------------------------------------------------
--
-- Table structure for table `record_log`
--

DROP TABLE IF EXISTS `record_log`;
CREATE TABLE `record_log` (
  `rlid` int(11) NOT NULL auto_increment,
  `rid` int(11) NOT NULL,
  `ukey` varchar(30) NOT NULL,
  `uval` varchar(50) NOT NULL,
  PRIMARY KEY  (`rlid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;



