<div class="edit-form edit-form-login">
	<form action="?_r=user&_a=login" method="post">
		<ul>

			<li><label><?= l('user login'); ?></label></li>
			<li>
				<input type="text" name="username" />
			</li>
			<li>
				<input type="text" name="password" />
			</li>	

			<li>
				<input type="submit" value="<?= l('enter'); ?>" class="" />
			</li>
		</ul>

	</form>
</div>
