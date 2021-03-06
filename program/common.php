<?php defined('ACCESS') or die('Access denied');



/**************** common functions ******************/
// return the dir path, if it is`t existed, just creates it
function path_dir ($path) {
	$path = PATH_PROGRAM.$path.'/';
	mk_dir($path);
	return $path;
}


function mk_dir($dir, $mode = 0777) {
	if (is_dir($dir) || @mkdir($dir,$mode)) return true;
	if (!mk_dir(dirname($dir),$mode)) return false;
	return @mkdir($dir,$mode);
} 


// return the real path for static resource file, like js, css
function path_res ($path) {
	if (file_exists(DIR_RES.$path)) {
		$path = DIR_RES.$path;
	} else {
		$path = "no file $path";
	}
	return $path;
}


// return complete template path
function path_tmp ($path) {
	return PATH_THEME.$path.'.tpl';
}


// load a template by tpl name, or no tpl with blank str of $layout parameter
function tmp($tpl_name, $t, $layout = 'default') {

	$t["msg"]			=	isset($t["msg"]) ? date("Y-m-d H:i:s")." "
							.$t["msg"] : "";
	$t["tpl_name"]		=	$tpl_name;

	$t['web_logo']		=	user_log('web_logo');
	$t['web_header']	=	user_log('web_header');

	$t['_r']			=	isset($t["_r"]) ? $t["_r"] : $GLOBALS['_r'];
	$t['_v']			=	isset($t["_v"]) ? $t["_v"] : $GLOBALS['_v'];
	$t['_a']			=	isset($t["_a"]) ? $t["_a"] : $GLOBALS['_a'];

	// load default layout	
	if ($layout == 'default') {
		$layout 		= isset($t['layout']) ? $t['layout'] : $t["def_layout"];
	}
 
	// no layout, just load the tpl
	if ($layout == "" or $layout == NULL or $layout == false) {
		include_once(path_tmp($tpl_name));
	// load the layout first
	} else {
		include_once(path_tmp($layout));
	}
}


// change the language from en to what you want
function l ($str) {
	$reval 	= $str;
	$path 	= PATH_THEME . 'lang/' . $GLOBALS['cfg']['def_lang'] . '.php';
	if (file_exists($path)) {
		require $path;
		if (isset($lang[$str])) {
			if ( $lang[$str] != '' ) {
				$reval = $lang[$str];
			}
		}
	}
	return $reval;
}


// change the link pattern
function url ($link) {
	return $link;
}


// jump to somewhere
function url_to ($url = "index.php") {
	Header("HTTP/1.1 303 See Other");
	Header("Location: $url");
	exit;
}


// set or get the http_referer value
// set it by an argv , get it with no argv given.
function url_referer ($url = '') {
	// save 
	if ( $url != '') {
		$url_referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : $url ;
		setcookie("http_referer", $url_referer, time()+60*5);

	} else {
		return (isset($_COOKIE["http_referer"]) ? $_COOKIE["http_referer"] : '/');
	}

}


function out($str, $t, $layout = 'layout') {
	$t["msg"] = $str;
	tmp("blank", $t, $layout);
	exit;
}


// return a key-val result that getting from database by a table and two fields given
function data_fetch_kv($tablename, $key, $val) {
	$rows = array();
	if ($res = sql_query("SELECT * FROM ". $tablename)) {
		while ($row = mysql_fetch_assoc($res)) {
			$rows[$row[$key]]  = $row[$val];
		}
	}
	return $rows;
}


// fetch a data collection from db
function sql_query($sql, $returnid = 0) {

	$link 	= mysql_connect($GLOBALS['cfg']['sql_server'], $GLOBALS['cfg']['sql_user'], $GLOBALS['cfg']['sql_pawd']) 
		or die("Could not connect: " . mysql_error());
	
	mysql_select_db($GLOBALS['cfg']['sql_dbname'], $link) 
		or die ("Can't use db ". $GLOBALS['cfg']['sql_dbname'] . mysql_error());

	$result = mysql_query($sql) 
		or die("Could not query: " . mysql_error());
	
	if ($returnid != 0) {
		$result = mysql_insert_id();
	}

	mysql_close($link);

	return $result;
}


function sql_filter_str($str)
{
    $str = str_replace(array("'", '"'), array("&apos;","&quot;"), $str);
    return $str;
}


function sql_filter($arr)
{
    if (is_array($arr)) {
        foreach($arr AS $k => $v) {
            $arr[$k] = sql_filter($v);
        }
    } else {
        $arr = sql_filter_str($arr);
    }
    return $arr;
}


//a simple bbcode Parser function
function show_bbcodes($text) {

	// BBcode array
	$find = array(
		'~\[b\](.*?)\[/b\]~s',
		'~\[i\](.*?)\[/i\]~s',
		'~\[u\](.*?)\[/u\]~s',
		'~\[quote\](.*?)\[/quote\]~s',
		'~\[size=(.*?)\](.*?)\[/size\]~s',
		'~\[color=(.*?)\](.*?)\[/color\]~s',
		'~\[url\]((?:ftp|https?)://.*?)\[/url\]~s',
		'~\[img\](.*?\.(?:jpg|jpeg|gif|png|bmp))\[/img\]~s'
	);

	// HTML tags to replace BBcode
	$replace = array(
		'<b>$1</b>',
		'<i>$1</i>',
		'<span style="text-decoration:underline;">$1</span>',
		'<pre>$1</'.'pre>',
		'<span style="font-size:$1px;">$2</span>',
		'<span style="color:$1;">$2</span>',
		'<a href="$1">$1</a>',
		'<img src="$1" />'
	);

	// Replacing the BBcodes with corresponding HTML tags
	return preg_replace($find, $replace, $text);
}


// cut string with utf8
function utf8_substr($str, $from, $len)
{
	return preg_replace('#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$from.'}'.
	'((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$len.'}).*#s', '$1' , $str);

	
/*	$tmpstr = "";
    $strlen = $from + $len;
    for($i = 0; $i < $strlen; $i++) {
        if(ord(substr($str, $i, 1)) > 0xa0) {
            $tmpstr .= substr($str, $i, 2);
            $i++;
        } else
            $tmpstr .= substr($str, $i, 1);
    }
    return $tmpstr;*/
}

function utf8_substr2($str, $from, $len)
{
	$tmpstr = "";
    $strlen = $from + $len;
    for($i = 0; $i < $strlen; $i++) {
        if(ord(substr($str, $i, 1)) > 0xa0) {
            $tmpstr .= substr($str, $i, 2);
            $i++;
        } else
            $tmpstr .= substr($str, $i, 1);
    }
    return $tmpstr;
}

/*function is_gbk($str) {
	return preg_match("/[\x7f-\xff]/", $str) ? true : false;
}
*/

/**************** user func libs ******************/
// user login, success return true.
function user_login ($name, $pawd) {
	$reval 	= true;
	$res 	= sql_query("SELECT * FROM user WHERE 
	username = '". $name ."' and password ='". $pawd ."' ;");

	if (mysql_num_rows($res) > 0) {
		$row 	= mysql_fetch_row($res);
		$token	= md5($row[0] + date('YmdHis'));
		$time	= time()+3600*72;

		// set the user info for login, expire in 1*72 hour
		setcookie("token", $token, $time);

		// save to db
		sql_query("INSERT INTO user_status (uid, token, created, exptime) VALUES (
			'".$row[0]."', '$token', '".date('Y-m-d H:i:s')."', '".date('YmdHis', $time)."')");
	} else {
		$reval = false;
	}

	return $reval;
}


function user_logout () {
	$token = $_COOKIE["token"];
	setcookie("token", time()-1);

	// remove from db
	sql_query("DELETE FROM user_status WHERE token = '$token'");
}

// return the user id current he logined
function user_id () {
	$info = user_info();
	return (isset($info[0]) ? $info[0] : 0);
}

// return the user name 
function user_name () {
	$info = user_info();
	return (isset($info[1]) ? $info[1] : 'default');
}

// return the user level
function user_level () {
	$info = user_info();
	return (isset($info[3]) ? $info[3] : 0);
}

function user_is_login () {
	if(user_id() > 0){
		// pass
	} else {
		url_to($GLOBALS["ucfg"]["user_login_page"]);
	}
}

function user_level_need ($level) {
	$info = user_info();
	return ($info[3] == $level ? true : false);
}

// remove at new version
function user_role_need ($role) {
	$info = user_info();
	return ($info[3] == $role ? true : false);
}

// retunr an array of user info
function user_info () {
	$reval = array();
	if(isset($_COOKIE["token"]) and ($_COOKIE["token"] != "")){
		$res = sql_query("SELECT * FROM user WHERE uid = 
			(SELECT uid FROM user_status WHERE token = '". $_COOKIE["token"] ."' LIMIT 1)");
		if (mysql_num_rows($res) > 0) {
			$reval = mysql_fetch_row($res);
		}
	}
	return $reval;
}

// get current user ip
function user_ip () {
	return $_SERVER['REMOTE_ADDR'];
}


function user_log ($ukey) {

	$reval	= '';
	$uid 	= user_id();

	// has ukey in db
	$res = sql_query("SELECT uval FROM user_log WHERE ukey = '". $ukey ."' LIMIT 1");
	if (mysql_num_rows($res) > 0) {
		$res2 	= mysql_fetch_row($res);
		$reval 	= $res2[0];

	// no ukey, then fetch it from $ucfg, and write to db
	} else {
		$reval = isset($GLOBALS['ucfg'][$ukey]) ? $GLOBALS['ucfg'][$ukey] : 'null';
		sql_query("INSERT INTO user_log (uid, ukey, uval) VALUES (
			'". $uid ."','". $ukey ."', '". $reval ."')");
	}

	return $reval;
}


function user_log_set ($ukey, $uval) {
	$uid = user_id();
	sql_query("UPDATE user_log SET uval = '". $uval ."' WHERE ukey = '". $ukey ."'");
}


function user_allow_submit () {
	$reval = '';

	if (user_log('last_post_ip') == user_ip()) {
		// time
		if (abs(intval(date("i")) - intval(user_log('last_post_time'))) < 2) {
			$reval = l('you cannot post twice in a short time');
		}
	} else {
		user_log_set('last_post_ip', user_ip());
	}
	user_log_set('last_post_time', date("i"));

	return $reval;
}



/*
$_REQUEST	= sql_filter($_REQUEST);
$_GET 		= sql_filter($_GET);
$_POST		= sql_filter($_POST);
*/

?>
