<?php defined('ACCESS') or die('Access denied');
$t['layout'] = 'admin/layout';

// act: add
if ($t['_a'] == "add") {
	if (($t["msg"] = record_fields_valid("add")) == "") {
		sql_query(
			"INSERT INTO record (
			uid, cid, follow, useful, content, created
			) VALUES (
			'". user_id() ."', '". $_POST["cid"] ."', '". $_POST["follow"] ."',
			'". $_POST["useful"] ."', '". $_POST["content"] ."', '". date("Y-m-d H:i:s") ."')"
		);
		$t["msg"] = l('added successfully');
	}
}


// act: update
if ($t['_a'] == "update") {
	if (($t["msg"] = record_fields_valid("update")) == "") {
		sql_query("UPDATE record SET 
			uid = '". user_id() ."',
			cid = '". $_POST["cid"] ."',
			follow = '". $_POST["follow"] ."',
			useful = '". $_POST["useful"] ."',
			content = '". $_POST["content"] ."'
			 WHERE rid = '". $_POST["rid"] ."';"
		);

		// fetch data for showing later, and make sure this operating is successful
		$res = sql_query("SELECT uid,cid,follow,useful,content,created FROM record WHERE rid = '". $_POST["rid"] ."';");
		if ($res) {
			$row = mysql_fetch_row($res);
			$t["uid"]			=	$row[0];
			$t["cid"]			=	$row[1];
			$t["follow"]		=	$row[2];
			$t["useful"]		=	$row[3];
			$t["content"]		=	$row[4];
			$t["created"]		=	$row[5];

			$t['_a']			=	"update";
			$t["msg"] 			= 	l('updated successfully');
		}
	}
}


// act: delete
if ($t['_a'] == "del") {
	if (isset($_GET["rid"])) {
		sql_query("DELETE FROM record WHERE rid='". $_GET["rid"] ."';");
		$t["msg"] = l('deleted successfully');
	}
}

// act: keepit
if ($t['_a'] == "keepit") {
	if (isset($_GET["rid"])) {
		sql_query("UPDATE record SET 
			cid = 0, follow = 0
			 WHERE rid = '". $_GET["rid"] ."';"
		);
		$t["msg"] = l('operated successfully');
	}
}

// view: show
if ($t['_v'] == "show") {
	$t["url"] 			=	"";
	$t["category_kv"]	=	data_fetch_kv("category", "cid", "name");
//	$t["status_kv"]		=	data_fetch_kv("status", "sid", "name");

	// pagination
	$pagecurr			=	(isset($_GET["pagecurr"]) and $_GET["pagecurr"]>1) ? $_GET["pagecurr"] : 1 ;
	$pagesize			=	$cfg["def_pagesize"] ;
	$pagenums			=	0 ;
	$pagestart			=	($pagecurr - 1)*$pagesize ;
	$t["record_num"]	=	0;

	// act: query
	if ($t['_a'] == "query") {
								// $_REQUEST
		$select_type		=	isset($_GET["select_type"]) ? $_GET["select_type"] : 
								(isset($_POST["select_type"]) ? $_POST["select_type"] : "exact");
		
		$select_kw_name = $select_kw =	isset($_GET["select_kw"]) ? $_GET["select_kw"] : 
								(isset($_POST["select_kw"]) ? $_POST["select_kw"] : "");

		$select_field		=	isset($_GET["select_field"]) ? $_GET["select_field"] : 
								(isset($_POST["select_field"]) ? $_POST["select_field"] : "");

		// process the sepcial fields cid, sid..
		$cid_vk				=	array_flip($t["category_kv"]);
//		$sid_vk				=	array_flip($t["status_kv"]);


		// replace the cid field name by its id, and ...
		if ($select_field == "cid") {
			$select_kw = array_key_exists($select_kw, $cid_vk) ? $cid_vk[$select_kw] : "" ;
		}
/*		if ($select_field == "sid") {
			$select_kw = array_key_exists($select_kw, $sid_vk) ? $sid_vk[$select_kw] : "" ;
		}*/

/*		echo array_key_exists($select_kw, $cid_vk);
		print_r($t["category_kv"]);
		print_r($cid_vk);
		exit;*/



		if (($select_kw != "") and ($select_field != "")) {
			if ($select_type == "exact") {
				$sql_str = "SELECT * FROM record WHERE $select_field = '$select_kw' ";
			} else {
				$sql_str = "SELECT * FROM record WHERE $select_field like '%$select_kw%' ";
			}

			//echo $sql_str;
			$t["record_res"] =	sql_query($sql_str);
			$t["record_num"] =	mysql_num_rows($t["record_res"]);

			$pagenums		 =	ceil($t["record_num"]/$pagesize);
			$sql_str 		.=	" ORDER BY rid DESC LIMIT $pagestart, $pagesize";
			$t["record_res"] =	sql_query($sql_str);


			if ($t["record_num"] < 1) {
				$t["msg"] 	= l('no result in quering');
			} else {
				$t["url"] 	= "_a=query&select_kw=$select_kw_name&select_field=$select_field&select_type=$select_type";
			}
		} else {
			// no content in db for the sepcail field
			$t["record_res"] = '';
			$t["msg"] = l('no result in quering');
		}
	}


	// if no query act
	if (!isset($t["record_res"])) {
		$sql_str			= "SELECT * FROM record";
		$t["record_res"] 	= sql_query($sql_str);
		$t["record_num"] 	= mysql_num_rows($t["record_res"]);

		$pagenums		 	= ceil($t["record_num"]/$pagesize);
		//echo $pagenums;
		//echo $pagesize;
		$sql_str 			.=	" ORDER BY rid DESC LIMIT $pagestart, $pagesize";
		$t["record_res"] 	=	sql_query($sql_str);
	}

	$t["pagecurr"]			=	$pagecurr;
	$t["pagenums"]			=	$pagenums;

	tmp("admin/record", $t);
}


// view: edit
if ($t['_v'] == "edit") {

	// fetch the rid
// 	if ( isset($t['rid']) ) { 
// 		// pass
// 	} elseif ( isset($_GET['rid']) ) {
// 		$t['rid'] = $_GET['rid'];
// 	} elseif ( isset($_POST['rid']) ) {
// 		$t['rid'] = $_POST['rid'];
// 	else {
// 		$t['rid'] = 0;
// 	}

	$t["rid"]			=	isset($t["rid"]) ? $t["rid"] : 0;
	$t["uid"]			=	isset($t["uid"]) ? $t["uid"] : user_id();
	$t["cid"]			=	isset($t["cid"]) ? $t["cid"] : 1;
	$t["follow"]		=	isset($t["follow"]) ? $t["follow"] : 0;
	$t["useful"]		=	isset($t["useful"]) ? $t["useful"] : 0;
	$t["content"]		=	isset($t["content"]) ? $t["content"] : "";

	$t["category_kv"]	=	data_fetch_kv("category", "cid", "name");
//	$t["status_kv"]		=	data_fetch_kv("status", "sid", "name");


	$t['_a']			=	$t['_a'] == "" ? "add" : $t['_a'];

	$t["rid"]			=	isset($_GET["rid"]) ? $_GET["rid"] : (isset($_POST['rid']) ? $_POST['rid'] : $t['rid']);

	//fetch the data that will be changed later
	if ( $t['rid'] != 0 ) {
		$res = sql_query("SELECT rid,uid,cid,follow,useful,content,created FROM record WHERE rid = '". $t['rid'] ."';");
		if ($res) {
			$row = mysql_fetch_row($res);
			// $t["rid"]			=	$row[0];
			$t["uid"]			=	$row[1];
			$t["cid"]			=	$row[2];
			$t["follow"]		=	$row[3];
			$t["useful"]		=	$row[4];
			$t["content"]		=	$row[5];
			$t["created"]		=	$row[6];

			$t['_a']			=	"update";
		}
	}
	tmp("admin/record", $t);
}




function record_fields_valid ($str) {
	$reval = "";
	return $reval;
}

/*$path_test_file = path_real('record/test', '.php', false);
if (file_exists($path_test_file)) {
	include_once($path_test_file);
}*/

?>
