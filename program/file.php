<?php defined('ACCESS') or die('Access denied');
$t['layout'] = 'admin/layout';

// initail upload folder if it hasn`t existed
if(!is_dir(PATH_UPLOAD)) {
    exit('no file '. PATH_UPLOAD);
}

// act: ajax, get the search tip
if ($t['_a'] == 'ajax_file_list') {

	$arr = array('info'=> array(), 'error'=>0);
/*	
	$arr = array('info'=> array('cc', 'cc1', 'cccccc3'), 'error'=>0 );
	ajax_json($arr);
	exit;
*/

	// pagination
	$t["url"] 			=	"";
	$pagecurr			=	(isset($_GET["pagecurr"]) and $_GET["pagecurr"]>1) ? $_GET["pagecurr"] : 1 ;
	$pagesize			=	9 ;
	$pagenums			=	0 ;
	$pagestart			=	($pagecurr - 1)*$pagesize ;
	$filenums			=	0;

	$sql_str			= 	"SELECT path FROM file";
	$res 				= 	sql_query($sql_str);
	$filenums 			= 	mysql_num_rows($res);

	$pagenums		 	= 	ceil($filenums/$pagesize);
	$sql_str 			.=	" ORDER BY fid DESC LIMIT $pagestart, $pagesize";
	$res 				= 	sql_query($sql_str);
	$arr['page'] 		= 	array($pagecurr, $pagenums);


	if (mysql_num_rows($res) > 0) {
		while ($row = mysql_fetch_assoc($res)) {
			array_push($arr['info'], $row['path']);
		}
	}

	
	ajax_json($arr);
}


// act: add
if ($t['_a'] == "add") {
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		$t["msg"]			= "";
		$allow_type 		= array('jpg','jpeg','gif','png');
		$max_file_size		= 2000000;     	//上传文件大小限制, 单位BYTE  
		$watermark			= 1;      		//是否附加水印(1为加水印,其他为不加水印);  
		$watertype			= 1;      		//水印类型(1为文字,2为图片)  
		$waterposition		= 1;     		//水印位置(1为左下角,2为右下角,3为左上角,4为右上角,5为居中);  
		$waterstring		= "http://www.111.cn/";  //水印字符串  
		$waterimg			= "111.gif";    //水印图片  
		$imgpreview 		= 1;      		//是否生成预览图(1为生成,其他为不生成);  
		$imgpreviewsize		= 1/2;    		//缩略图比例  

// 		print_r(get_upload_files());
// 		exit;
		foreach (get_upload_files() as $key => $file) {
// 			exit(print_r($file));

			if ($file['name']) {
				$name 	= substr($file['name'], 0, strrpos($file['name'], '.'));
				$type 	= strtolower(substr($file['name'], strrpos($file['name'], '.') + 1));
				$path 	= date("ymdHis") . $key . user_id() . "." . $type;
			
				if(!is_uploaded_file($file['tmp_name'])) {
					$t["msg"] = l('no file');
				 	break;
				}

				if(!in_array($type, $allow_type)) {
					$t["msg"] = l('wrong type');
					break;
				}

				if($max_file_size < $file["size"]) {  
					$t["msg"] = l('file too big');
					break;
				}  

				if(!move_uploaded_file($file['tmp_name'], PATH_UPLOAD.$path)){
					$t["msg"] = l('a error in removing file');
					break;
				}

				// write to db
				sql_query("INSERT INTO file (uid, name, path, type, created) VALUES ('". user_id() 
				."','". $name ."','". $path ."','". $type ."','". date("Y-m-d H:i:s") ."');");

			}

		}



		$t["msg"] = $t["msg"] == "" ? l('added successfully') : $t["msg"];
	} else {
		$t["msg"] = l('failed to add');
	}
}


// act: delete
if ($t['_a'] == "del") {
	if (isset($_GET["fid"])) {
		// remove file
		$res = sql_query("SELECT path FROM file WHERE fid='". $_GET["fid"] ."' LIMIT 1;");
		$row = mysql_fetch_row($res);
		unlink(PATH_UPLOAD.$row[0]);

		// delete from db
		sql_query("DELETE FROM file WHERE fid='". $_GET["fid"] ."';");
		$t["msg"] = l('deleted successfully');
	}
}


// view: show
if ($t['_v'] == "show") {

	// pagination
	$t["url"] 			=	"";
	$pagecurr			=	(isset($_GET["pagecurr"]) and $_GET["pagecurr"]>1) ? $_GET["pagecurr"] : 1 ;
	$pagesize			=	$cfg["def_pagesize"] ;
	$pagenums			=	0 ;
	$pagestart			=	($pagecurr - 1)*$pagesize ;
	$t["file_num"]		=	0;

	$sql_str			= 	"SELECT * FROM file";
	$t["file_res"] 		= 	sql_query($sql_str);
	$t["file_num"] 		= 	mysql_num_rows($t["file_res"]);

	$pagenums		 	= 	ceil($t["file_num"]/$pagesize);
	//echo $pagenums;
	//echo $pagesize;
	$sql_str 			.=	" ORDER BY fid DESC LIMIT $pagestart, $pagesize";
	$t["file_res"] 		=	sql_query($sql_str);
	

	$t["pagecurr"]		=	$pagecurr;
	$t["pagenums"]		=	$pagenums;

	tmp("admin/file", $t);
}


// view: edit
if ($t['_v'] == "edit") {
	tmp("admin/file", $t);
}


function ajax_json ($data) {
	echo json_encode($data);
	exit;
}


// return the file with an index array
function get_upload_files () {
    foreach($_FILES as $file) {
        $num = count($file['name']);

        if ($num == 1) {
            $files[] = $file;
        } else {
            for ($i=0; $i < $num; $i++) { 
                $files[$i]['name']		=	$file['name'][$i];
                $files[$i]['type']		=	$file['type'][$i];
                $files[$i]['tmp_name']	=	$file['tmp_name'][$i];
                $files[$i]['error']		=	$file['error'][$i];
                $files[$i]['size']		=	$file['size'][$i];
            }
        }
    }
    return $files;
}



?>
