<div class="edit-form">
	<form action="?_a=<?= $t['_a'] ?>" method="post" enctype="multipart/form-data" >
		<ul>
			<li>
				<input type='file' name='upload' class="addfile" />
			</li>
			<li>
				<textarea name="content" class="record_text file_input"></textarea>
				<input type="hidden" name="cid" value="<?=$t['cid']?>" />
				<input type="submit" value="<?= l('submit'); ?>" class="" />
			</li>
		</ul>
	</form>
</div>
