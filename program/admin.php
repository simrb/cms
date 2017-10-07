<?php defined('ACCESS') or die('Access denied');
$t['layout'] = 'admin/layout';

// act: edit
if ($_a == 'edit') {
	if (isset($_POST['web_logo']) 
	and isset($_POST['web_header'])
	and isset($_POST['web_title'])) {

		user_log_set('web_logo', $_POST['web_logo']);
		user_log_set('web_header', $_POST['web_header']);
		user_log_set('web_title', $_POST['web_title']);
		user_log_set('web_des', $_POST['web_des']);

		$t['msg'] = l('updated successfully');
	}
}


// view: show
if ($_v == "show") {
	$t['welcome'] = l('welcome, dear ');
	tmp("admin/index", $t);
}


// view: info
if ($_v == "info") {
	$t['web_logo']		= user_log('web_logo');
	$t['web_header']	= user_log('web_header');
	$t['web_title']		= user_log('web_title');
	$t['web_des']		= user_log('web_des');

	tmp("admin/info", $t);
}

?>