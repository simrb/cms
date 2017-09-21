<div class="show-detail">

	<?php
		if ($t["record_res"]) {
			while($row = mysql_fetch_array($t["record_res"])) {
				
				echo "<label class='left'>" . $row['created'] . "</label>";
				echo "<label class='right'>". l('useful') ." " . $row['useful'] . "</label>";
				echo "<pre class='clear'>" . show_bbcodes($row['content']) . "</pre>";

			}
		}
	?>

</div>


<div class="edit-form">
	<form action="<?= $t['url'] ?>" method="post" >
		<ul>
			<li><textarea name="content" class="" placeholder="<?= l('say someing ...'); ?>" ></textarea></li>
			<li>
				<input type="submit" value="<?= l('submit'); ?>" class="" />
				<input type="hidden" name="rid" value="<?= $t["rid"] ?>" />
				<input type="hidden" name="cid" value="<?= $t["cid"] ?>" />
			</li>
		</ul>
	</form>
</div>
