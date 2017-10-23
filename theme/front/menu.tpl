<?php

	// parse the menu 
	if (isset($t["category_kv"])) {

		echo '<div class="menu_item"><ul>';

		foreach ($t["category_kv"] as $cid => $name) {
			$hl = ($cid == $t['cid']) ? 'menu_hl' : '';
			echo '<li class="left '. $hl .'"><a href="?cid='. 
				$cid .'" >'. $name .'</a></li>';
		}

		$hl = ('addpost' == $t['_v']) ? 'menu_hl' : '';
		echo '<li class="right '. $hl .'"><a href="?_v=addpost&cid='.
			$t['cid'] .'">'.l('add post').'</a></li>';

		echo '</ul></div>';
	}


?>

