<?php 

//error_reporting(0);

// base paths
define("ACCESS", "ALLOW");
date_default_timezone_set('Asia/Shanghai');
define("PATH_BASE",		dirname(__FILE__) . "/");


// absolute path
define("PATH_PROGRAM",	PATH_BASE . "program/");
define("PATH_RES",		PATH_BASE . "theme/res/");
define("PATH_THEME",	PATH_BASE . "theme/");
define('PATH_UPLOAD', 	PATH_BASE . 'archive/upload/');

// relative path
define("DIR_RES",		"theme/res/");
define("DIR_UPLOAD",	"archive/upload/");


// config, common func, access file
require_once(PATH_BASE 	. "cfg.inc");
require_once(PATH_PROGRAM . "common.inc");
require_once(PATH_BASE 	. $cfg['def_access']);

// index file
require_once(PATH_PROGRAM . "$_r.inc");

exit;
?>
