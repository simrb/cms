<?php 

//error_reporting(0);

// base paths
define("ACCESS", "ALLOW");
date_default_timezone_set('Asia/Shanghai');
define("PATH_BASE",		dirname(__FILE__) . "/");


// absolute path
define("PATH_PROGRAM",	PATH_BASE . "program/");
define("PATH_PUBLIC",	PATH_BASE . "theme/public/");
define("PATH_THEME",	PATH_BASE . "theme/");
define('PATH_UPLOAD', 	PATH_BASE . 'archive/upload/');

// relative path
define("DIR_PUBLIC",	"theme/public/");
define("DIR_UPLOAD",	"archive/upload/");


// config, common func, access file
require_once(PATH_BASE 	. "cfg.php");
require_once(PATH_PROGRAM . "common.inc");
require_once(PATH_BASE 	. $cfg['def_access']);

// index file
require_once(PATH_PROGRAM . "$_r.php");

exit;
?>