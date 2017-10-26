<div class="edit-form edit-form-login">
	<form action="?_v=settings&_a=settings" method="post">

		<ul>
			<li><h3><?= l('user info'); ?></h3></li>

			<li><label><?= l('username'); ?></label></li>
			<li>
				<input type="text" value="<?= user_name(); ?>" disabled="disabled" />
			</li>

			<li><label><?= l('password'); ?></label></li>
			<li>
				<input type="text" name="password" value="******"/>
			</li>	

			<li>
				<input type="submit" value="<?= l('save'); ?>" class="" />
		
				<a href="?_r=user&_a=logout">
					<button><?= l('logout'); ?></button>
				</a>
			</li>

		</ul>

	</form>
</div>
