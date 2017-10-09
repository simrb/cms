<div class="edit-form">
	<form action="?_v=<?= $t['_v'] ?>&&_a=<?= $t['_a'] ?>" method="post" >
		<ul>
			<li><label><?= l('content'); ?></label></li>
			<li><textarea name="content" class="record_text file_input" </textarea></li>
			<li>
				<input type="submit" value="<?= l('submit'); ?>" class="" />
			</li>
		</ul>

		<label class="showorhide"><a href="#"><?= l('picture'); ?> >>> </a></label>
		<div>
			<input type='file' name='upload' />
		</div>
		
	</form>
</div>
