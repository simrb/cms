<?php defined('ACCESS') or die('Access denied');

$t["category_kv"] =	data_fetch_kv("category", "cid", "name");


//act: add
if ($t['_a'] == "addcomment") {
	if (isset($_POST['rid']) and isset($_POST['content'])) {
		
		$t["msg"] = user_allow_submit();
		if ($t["msg"] == '') {
			sql_query(
				"INSERT INTO record (
				uid, cid, follow, content, created
				) VALUES (
				'". user_id() ."', '". $_POST["cid"] ."', '". $_POST["rid"] ."',
				'". $_POST["content"] ."', '". date("Y-m-d H:i:s") ."')"
			);
			$t["msg"] = l('submitted successfully');
		}

	}
}


//act: addpost
if ($t['_a'] == "addpost") {
	if (isset($_POST['cid']) and isset($_POST['content'])) {
		
// 		$t["msg"] = user_allow_submit();
		$t['msg'] = '';

		if ($t["msg"] == '') {

			// add record
			sql_query(
				"INSERT INTO record (
				uid, cid, follow, content, created
				) VALUES (
				'". user_id() ."', '". $_POST["cid"] ."', 0,
				'". $_POST["content"] ."', '". date("Y-m-d H:i:s") ."')"
			);
			$t["msg"] = l('submitted successfully');

			// add upload
			$t['_a'] = 'add';
			$t['_v'] = '';
			require_once('file.php');

			echo $t['msg'];
		}

	}

// 	url_to( '?cid='. $_POST["cid"]);
}


//view: show
if ($t['_v'] == "show") {

	// pagination
	$t["url"] 			=	"";
	$t["cid"]			=	isset($_GET["cid"]) ? $_GET["cid"] : 1 ;
	$pagecurr			=	(isset($_GET["pagecurr"]) and $_GET["pagecurr"]>1) ? $_GET["pagecurr"] : 1 ;
	$pagesize			=	9 ;
	$pagenums			=	0 ;
	$pagestart			=	($pagecurr - 1)*$pagesize ;
	$filenums			=	0;

	$sql_str			= 	"SELECT * FROM record WHERE follow = 0";
	$sql_str			.=	$t["cid"] > 0 ? (" and cid = ". $t["cid"]) : "";
	$res 				= 	sql_query($sql_str);
	$filenums 			= 	mysql_num_rows($res);

	$pagenums		 	= 	ceil($filenums/$pagesize);
	$sql_str 			.=	" ORDER BY rid DESC LIMIT $pagestart, $pagesize";

	$t["record_res"] 	= 	sql_query($sql_str);
	$t["pagecurr"]		=	$pagecurr;
	$t["pagenums"]		=	$pagenums;
	$t['web_title'] 	= 	user_log('web_title');
	
	tmp("front/list", $t);
}


//view: detail
if ($t['_v'] == "detail") {
	if (isset($_GET['rid'])) {
		$t["rid"]			= $_GET['rid'];
		$t['url']			= '?_v=detail&&rid=' . $t['rid'] . '&&_a=addcomment';

		// web head 
		$res = sql_query("SELECT content, cid FROM record WHERE rid = ". $t["rid"] . " LIMIT 1");
		if ($res = mysql_fetch_row($res)) {
			$t['web_title'] = utf8_substr($res[0], 0, 30) . ' -- ' . user_log('web_header');
			$t['web_des'] 	= utf8_substr($res[0], 0, 70);
			$t['cid'] 		= $res[1];
			//$t['web_des'] 	= utf8_substr($res[0], 0, 20);
		}

		// web body
		$sql_str			= "SELECT rid, uid, content, useful, created FROM record 
							WHERE rid = ". $t["rid"] ." OR follow = ". $t["rid"];
		$t['record_res'] 	= sql_query($sql_str);


		tmp("front/detail", $t);
	}
}


//view: addpost
if ($t['_v'] == "addpost") {

	$t["url"] 			=	"";
	$t['_a'] 			=	"addpost";
	$t["cid"]			=	isset($_GET["cid"]) ? $_GET["cid"] : 1 ;

	$t['web_title'] 	= 	user_log('web_title');
	
	tmp("front/add", $t);
}

?>
