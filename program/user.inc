<?php defined('ACCESS') or die('Access denied');
$t['layout'] = 'admin/layout';

//act: add
if ($t['_a'] == "add") {
	if (isset($_POST["username"])) {

		sql_query("INSERT INTO user(username, password, level) 
		VALUES ('". $_POST["username"] ."','". $_POST["password"] ."','". $_POST["level"] ."');");

		$t["msg"] = l('added successfully');
	} else {
		$t["msg"] = l('failed to add');
	}
}


//act: update
if ($t['_a'] == "update") {
	if (isset($_POST["uid"]) and isset($_POST["username"])) {
		sql_query("UPDATE user SET 
			username = '". $_POST["username"] ."',
			password = '". $_POST["password"] ."',
			level = '". $_POST["level"] ."' 
			WHERE uid = '".$_POST["uid"]."';"
		);

		$res = sql_query("SELECT * FROM user WHERE uid = '". $_POST["uid"] ."';");
		if ($res) {
			$row = mysql_fetch_row($res);
			$t["uid"]			=	$row[0];
			$t["username"]		=	$row[1];
			$t["password"]		=	$row[2];
			$t["level"]			=	$row[3];
			$t['_a']			=	"update";
			$t["msg"] 			= 	l('updated successfully');
		}
	}
}


//act: delete
if ($t['_a'] == "del") {
	if (isset($_GET["uid"])) {
		sql_query("DELETE FROM user WHERE uid='". $_GET["uid"] ."';");
		$t["msg"] = l('deleted successfully');
	}
}


//act: delall
if ($t['_a'] == "delall") {
	sql_query("TRUNCATE TABLE user_status;");
	$t["msg"] = l('deleted successfully, you will quit soon');
}


//act: logout
if ($t['_a'] == "logout") {
	user_logout();
	url_to ();
}


//act: login
if ($t['_a'] == "login") {
	if (isset($_POST["username"]) and isset($_POST["password"])) {
		if (user_login($_POST['username'], $_POST['password'])) {
			// pass
			url_to( url_referer() );
		} else {
			$t["msg"] = l('failed to login, the username and password is not matched').
			" <a href='".$GLOBALS["ucfg"]["user_login_page"]."'>". l('return') ."</a>";
		}
	}
	out($t["msg"], $t);
}


//view: login
if ($t['_v'] == "login") {
	url_referer('?');
	$t['layout'] = 'front/layout';
	tmp("admin/login", $t);
}


//view: show
if ($t['_v'] == "show") {
	$t["user_res"] = sql_query("SELECT * FROM user;");
	tmp("admin/user", $t);
}


//view: status
if ($t['_v'] == "status") {
	$t["user_res"] = sql_query("SELECT * FROM user_status;");
	tmp("admin/user_status", $t);
}


//view: edit
if ($t['_v'] == "edit") {
	$t["uid"]			=	isset($t["uid"]) ? $t["uid"] : 0;
	$t["username"]		=	isset($t["username"]) ? $t["username"] : "";
	$t["password"]		=	isset($t["password"]) ? $t["password"] : "";
	$t["level"]			=	isset($t["level"]) ? $t["level"] : "";
	$t['_a']			=	$t['_a'] == "" ? "add" : $t['_a'];
	$t["user_level"]	=	$ucfg['user_level'];

	//fetch the data that will be changed later
	if (isset($_GET["uid"])) {
		$res = sql_query("SELECT * FROM user WHERE uid = '". $_GET["uid"] ."';");
		if ($res) {
			$row = mysql_fetch_row($res);
			$t["uid"]			=	$row[0];
			$t["username"]		=	$row[1];
			$t["password"]		=	$row[2];
			$t["level"]			=	$row[3];
			$t['_a']			=	"update";
		}
	}
	tmp("admin/user", $t);
}


?>
