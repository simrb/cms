<!doctype html>
<html lang="us">
<head>
	<?php include_once(path_tmp('head')); ?>
	<link href="<?= path_res('front.css') ?>" rel="stylesheet">
</head>

<body>
	<div class="ui-grid-layout" id="wrap" data-role="page" data-theme="z">
		<div class="ui-block-a"></div>
		<div class="ui-block-b">


			<div id="header">
				<a href="?"><h1><?= $t['web_header'] ?></h1></a>
			</div>

			<div id="bodyer">

				<p id="msg"><?= $t["msg"] ?></p>
				<?php include_once(path_tmp($tpl_name)); ?>
				
			</div>

			<div id="footer">
				<i>
					<?= $t['web_footer'] ?> <?= $t['web_name'] ?>
					<a href="?_v=detail&&rid=1" target="_blank"><?= l('about us'); ?></a>
				</i>
			</div>


		</div>
		<div class="ui-block-c"></div>
	</div>
</body>
</html>