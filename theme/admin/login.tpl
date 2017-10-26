<div class="edit-form edit-form-login">
	<form action="?_r=user&_a=login" method="post">

		<ul>
			<li><h3><?= l('user login'); ?></h3></li>
			<li><label><?= l('username'); ?></label></li>
			<li>
				<input type="text" name="username" />
			</li>

			<li><label><?= l('password'); ?></label></li>
			<li>
				<input type="text" name="password" />
			</li>	

			<li>
				<input type="submit" value="<?= l('enter'); ?>" class="" />
			</li>

			<li>
				<br/>
				<input id="firstime" type="checkbox" name="firstime" value="yes" />
				<label for="firstime"><?= l('this is first time login, the account will be created automatically') ?></label>
			</li>
		</ul>

	</form>
</div>


