	<div class="edit-form">
		<form action="?_v=<?= $t['_v'] ?>&&_a=<?= $t['_a'] ?>" method="post" >
			<ul>
				<li><label><?= l('content'); ?></label></li>
				<li><textarea name="content" class="record_text file_input" </textarea></li>
				<li>

					<?php
						if (isset($t['category_kv'])) {

							echo '<select name="cid">';
							foreach ($t['category_kv'] as $key => $val) {

								// $defval = ($key == $t["cid"]) ? 'checked="checked"' : "";
								// echo '<label class="radio"><input '.$defval
								// 	.' name="cid" type="radio" value="'.$key
								// 	.'" />'. $val .'</label>';

								$defval = ($key == $t["cid"]) ? 'selected="selected"' : "";
								echo '<option '.$defval.' value="'
									.$key.'">'. $val .'</option>';
							}
							echo '</select>';

						}
					?>

				</li>
				<li>
					</br>
					<input type="submit" value="<?= l('submit'); ?>" class="" />
				</li>
			</ul>

			<label class="showorhide"><a href="#"><?= l('picture'); ?> >>> </a></label>
			<div>
				<div class="file_list"></div>
			</div>
			
		</form>
	</div>
