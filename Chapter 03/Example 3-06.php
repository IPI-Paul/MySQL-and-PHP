<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-6</title>
	</head>
	<body>
		<p>
		<h1>Connecting MySQL</h1>
		<hr />
		<table name="retRes" width="100%"></table>
		<br />
		<?php
			include '../IPI/settings.php';
			include IPI.'IPI Functions.php';

			$mysqli = new mysqli($host, $usr, $pwd, $db);
			if ($mysqli->connect_errno){
				echo 'Failed to connect MySQL: (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error . BR;
			}

			if (!$mysqli->query("drop table if exists test") ||
				!$mysqli->query('create table test(id int)') ||
				!$mysqli->query('insert into test (id) values (1)')
				){
					echo 'Table creation failed: (' . $mysqli->errno . ') ' . $mysqli->error . BR;
				} else {
					retTbl($mysqli->query('select * from test'));
				}
		?>
		<br />
		</p>
		<?php include $tmpl.'get date.php'; ?>
	</body>
</html>