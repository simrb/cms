--
-- add new table, record_log
--

use cms_db;


CREATE TABLE `record_log` (
  `rlid` int(11) NOT NULL auto_increment,
  `rid` int(11) NOT NULL,
  `ukey` varchar(30) NOT NULL,
  `uval` varchar(50) NOT NULL,
  PRIMARY KEY  (`rlid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
