<div class="edit-form">
	<form action="?_a=<?= $t['_a'] ?>" method="post" enctype="multipart/form-data" >
		<ul>
			<li><label><?= l('content'); ?></label></li>
			<li><textarea name="content" class="record_text file_input"></textarea></li>
			<li>
				<input type="submit" value="<?= l('submit'); ?>" class="" />
				<input type='file' name='upload' />
				<input type="hidden" name="cid" value="<?=$t['cid']?>" />
			</li>
		</ul>
	</form>
</div>
