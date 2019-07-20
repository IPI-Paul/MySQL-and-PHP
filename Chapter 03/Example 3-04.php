<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-4</title>
	</head>
	<body>
		<p>
		<h1>Special meaning of localhost</h1>
		<hr />
		<br />
		<?php
			include '../IPI/settings.php';
			include IPI.'IPI Functions.php';

			$mysqli = new mysqli('localhost', $usr, $pwd, $db);
			if ($mysqli->connect_errno){
				echo 'Failed to connect to MySQL: (' .$mysqli->connect_errno . ') ' . $mysqli->connect_error . BR;
			}
			pre($mysqli->host_info);

			$mysqli = new mysqli('127.0.0.1', $usr, $pwd, $db, 3306);
			if ($mysqli->connect_errno){
				echo 'Failed to connect to MySQL: (' .$mysqli->connect_errno . ') ' . $mysqli->connect_error . BR;
			}
			pre($mysqli->host_info);
		?>
		<br />
		</p>
		<?php include $tmpl.'get date.php'; ?>
	</body>
</html>