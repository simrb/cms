-- 
-- upgrade the base version to sns
--

use cms_db;

--
-- Table structure for table `record_log`
--

-- DROP TABLE IF EXISTS `record_log`;
-- CREATE TABLE `record_log` (
CREATE TABLE IF NOT EXISTS `record_log` (
  `rlid` int(11) NOT NULL auto_increment,
  `rid` int(11) NOT NULL,
  `ukey` varchar(30) NOT NULL,
  `uval` varchar(50) NOT NULL,
  PRIMARY KEY  (`rlid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- add field `sign` to table `category`
--
DROP PROCEDURE IF EXISTS schema_change;
DELIMITER //
CREATE PROCEDURE schema_change() BEGIN 
DECLARE curr_dbs VARCHAR(100);
SELECT DATABASE() INTO curr_dbs;
IF NOT EXISTS (SELECT * FROM information_schema.statistics WHERE table_schema = curr_dbs AND table_name = 'category' AND index_name = 'sign') THEN
   ALTER TABLE `category` ADD `sign` int(10) NOT NULL default '0';
END IF;
END//
DELIMITER ;
CALL schema_change();
