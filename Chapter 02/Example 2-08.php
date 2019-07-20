<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 2-8</title>
	</head>
	<body>
		<p>
		<h1>Setting the character set example: pdo_mysql</h1>
		<hr />
		<br />
		<?php
			include '../IPI/settings.php';
			include IPI.'IPI Functions.php';

			$pdo = new PDO("mysql:host=$host;dbname=world;charset=utf8", $usr, $pwd);
			echo $pdo->query("select charset('')")->fetchColumn();
		?>
		<br />
		</p>
		<?php include $tmpl.'get date.php'; ?>
	</body>
</html>