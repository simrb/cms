<?php

	// define the menu
	$layout = array(
		'front_menu' 	=>	array(

			array(
				'name'	=>	'genenal',
				'link'	=>	'?cid=1',
			),
			array(
				'name'	=>	'talk',
				'link'	=>	'?cid=2',
			),
			array(
				'name'	=>	'add post',
				'link'	=>	'?_v=addpost',
			),

		),

	);

	// parse the menu 
	if (isset($layout['front_menu'])) {

		echo '<div class="menu_item"><ul>';
		foreach ($layout['front_menu'] as $row) {
			echo '<li><a target="_self" href="'. $row['link'] .'" >'. $row['name'] .'</a></li>';
		}
		echo '</ul></div>';
	}


?>

