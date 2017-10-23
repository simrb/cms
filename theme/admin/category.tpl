<?php if ($t['_v'] == 'show') { ?>

	<div class="show-table">
		<table >
			<thead>
				<tr>
					<th style="width:80px">id</th>
					<th style="width:80px"><?= l("category"); ?></th>
					<th style="width:80px"><?= l("follow"); ?></th>
					<th style="width:80px"><?= l("number"); ?></th>
					<th style="width:80px"></th>
				</tr>
			</thead>

			<tbody>

				<?php
					if ($t["category_res"]) {
						while($row = mysql_fetch_array($t["category_res"])) {
							echo "<tr>";
	  						echo "<td><a href='?_r=category&&_v=edit&&_a=edit&&cid=".
									$row["cid"]."'>". $row["cid"] ." > </a></td>";
	  						echo "<td><a href='?_r=category&&_v=edit&&_a=edit&&cid=".
									$row["cid"]."'>". $row["name"] ."</a></td>";
	  					//	echo "<td>" . $row['name'] . "</td>";
	  						echo "<td>" . $row['follow'] . "</td>";
	  						echo "<td>" . $row['number'] . "</td>";
	  						echo "<td><a href='?_r=category&&_a=del&&cid=".
	  							$row["cid"]."'>". l('delete') ."</a></td>";
	  						echo "</tr>";
	  					}
					}
				?>

			</tbody>
		</table>
	</div>

	<div class="show-bar">
		<form class="edit-form">
			<a href="?_r=category&&_v=edit"><input type="button" value="<?= l('add'); ?>" class="bgwt" /></a>
		</form>
	</div>

<?php } ?>



<?php if ($t['_v'] == 'edit') { ?>

	<div class="edit-form">
		<form action="?_r=category&&_v=<?= $t["_v"] ?>&&_a=<?= $t["_a"] ?>" method="post">
			<ul>

				<li><label><?= l("category name"); ?></label></li>
				<li>
					<input type="text" name="category_name" value="<?= $t["category_name"] ?>" />
				</li>

				<li><label><?= l("follow"); ?></label></li>
				<li>
					<input type="text" name="follow" value="<?= $t["follow"] ?>" />
				</li>

				<li><label><?= l("number"); ?></label></li>
				<li>
					<input type="text" name="number" value="<?= $t["number"] ?>" />
				</li>

				<li>
					<br>
					<input type="hidden" name="cid" value="<?= $t["cid"] ?>" />
					<input type="submit" value="<?= l("submit"); ?>" class="" />
				</li>
			</ul>

		</form>
	</div>

<?php } ?>
