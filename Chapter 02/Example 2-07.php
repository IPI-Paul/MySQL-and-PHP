<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 2-7</title>
	</head>
	<body>
		<p>
		<h1>Setting the character set example: mysqli</h1>
		<hr />
		<br />
		<?php
			include '../IPI/settings.php';
			include IPI.'IPI Functions.php';

			$mysqli = new mysqli($host, $usr, $pwd, $db);

			printf("Initial character set: %s\n".BR, $mysqli->character_set_name());

			if (!$mysqli->set_charset('utf8')){
				printf("Error loading character set utf8: %s\n".BR, $mysqli->error);
				exit;
			}

			echo "New character set information:\n".BR;
			pre($mysqli->get_charset());
		?>
		<br />
		</p>
		<?php include $tmpl.'get date.php'; ?>
	</body>
</html>