<?php

	// define the menu
	$layout = array(

		'front_menu' 	=>	array(
			array(
				'name'	=>	'genenal',
				'link'	=>	'?cid=1',
				'hl'	=>	'1',
			),
			array(
				'name'	=>	'talk',
				'link'	=>	'?cid=2',
				'hl'	=>	'2',
			),
		),

	);

	// parse the menu 
	if (isset($layout['front_menu'])) {

		echo '<div class="menu_item"><ul>';

		foreach ($layout['front_menu'] as $row) {
			$hl = ($row['hl'] == $t['cid']) ? 'menu_hl' : '';
			echo '<li class="left '. $hl .'"><a href="'. 
				$row['link'] .'" >'. $row['name'] .'</a></li>';
		}

		echo '<li class="right"><a href="?_v=addpost&&cid='.
			$t['cid'] .'">'.l('add post').'</a></li>';

		echo '</ul></div>';
	}


?>

