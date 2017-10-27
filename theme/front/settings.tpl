<div class="edit-form edit-form-login">
	<form action="?_v=settings&_a=settings" method="post">

		<ul>
			<li>
				<a href="?_r=user&_a=logout" class="right"><?= l('logout'); ?></a>
				<h3><?= l('user info'); ?></h3>
			</li>

			<li><label><?= l('username'); ?></label></li>
			<li>
				<input type="text" value="<?= user_name(); ?>" disabled="disabled" />
			</li>

			<li><label><?= l('password'); ?></label></li>
			<li>
				<input type="text" name="password" value="**" />
			</li>

			<li><label><?= l('nickname'); ?></label></li>
			<li>
				<input type="text" name="nickname" value="" />
				<input type="hidden" name="nickname2" value="" />
			</li>

			<li><label><?= l('contact'); ?></label></li>
			<li>
				<input type="text" name="contact" value="" />
				<input type="hidden" name="contact2" value="" />
			</li>

			<li><label><?= l('introduction'); ?></label></li>
			<li>
				<textarea name="intro" ></textarea>
				<textarea name="intro2" class="hide" ></textarea>
			</li>

			<li>
				<input type="submit" value="<?= l('save'); ?>" class="" />
			</li>
		</ul>

	</form>
</div>