<?php defined('ACCESS') or die('Access denied');
$t['layout'] = 'admin/layout';

//act: add
if ($t['_a'] == "add") {
	if (isset($_POST["category_name"])) {
		sql_query("INSERT INTO category (name,follow,number) VALUES ('". $_POST["category_name"] ."',
			'". $_POST["follow"] ."', '". $_POST["number"] ."');");
		$t["msg"] = l("added successfully");
	} else {
		$t["msg"] = l("failed to add");
	}
}

//act: update
if ($t['_a'] == "update") {
	if (isset($_POST["cid"])) {
		sql_query("UPDATE category SET name = '". $_POST["category_name"] ."',
		follow = '". $_POST["follow"] ."', number = '". $_POST["number"] ."' WHERE cid = '".$_POST["cid"]."';");

		$res = sql_query("SELECT cid, name, follow, number FROM category WHERE cid = '". $_POST["cid"] ."';");
		if ($res) {
			$row = mysql_fetch_row($res);
			$t["cid"]			=	$row[0];
			$t["category_name"]	=	$row[1];
			$t["follow"]		=	$row[2];
			$t["number"]		=	$row[3];
			$t['_a']			=	"update";
			$t["msg"] 			= 	l("updated successfully");
		}
	}
}

//act: delete
if ($t['_a'] == "del") {
	if (isset($_GET["cid"])) {
		sql_query("DELETE FROM category WHERE cid='". $_GET["cid"] ."';");
		$t["msg"] = l("deleted successfully");
	}
}

//view: show
if ($t['_v'] == "show") {
	$t["category_res"] = sql_query("SELECT * FROM category;");
	tmp("admin/category", $t);
}

//view: edit
if ($t['_v'] == "edit") {
	$t["cid"]			=	isset($t["cid"]) ? $t["cid"] : 0;
	$t["category_name"]	=	isset($t["category_name"]) ? $t["category_name"] : "";
	$t["follow"]		=	isset($t["follow"]) ? $t["follow"] : 0;
	$t["number"]		=	isset($t["number"]) ? $t["number"] : 0;
	$t['_a']			=	$t['_a'] == "" ? "add" : $t['_a'];

	//fetch the data that will be changed later
	if (isset($_GET["cid"])) {
		$res = sql_query("SELECT cid, name, follow, number 
			FROM category WHERE cid = '". $_GET["cid"] ."';");

		if ($res) {
			$row = mysql_fetch_row($res);
			$t["cid"]			=	$row[0];
			$t["category_name"]	=	$row[1];
			$t["follow"]		=	$row[2];
			$t["number"]		=	$row[3];
			$t['_a']			=	"update";
		}
	}
	tmp("admin/category", $t);
}


?>