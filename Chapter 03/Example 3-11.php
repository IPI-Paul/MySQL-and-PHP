<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-11</title>
	</head>
	<body>
		<p>
		<h1>Prepared Statements - First stage: prepare</h1>
		<hr />
		<br />
		<?php
			include '../IPI/settings.php';
			include IPI.'IPI Functions.php';

			$mysqli = new mysqli($host, $usr, $pwd, $db);
			if ($mysqli->connect_errno){
				fConn($mysqli);
			}

			/* Non-prepared statement */
			if (!$mysqli->query('drop table if exists test') || 
				!$mysqli->query('create table test(id int)')
				){
					fTbl($mysqli);
			}

			/* Prepared statement, stage 1: prepare */
			if (!($stmt = $mysqli->prepare("insert into test(id) values (?)"))){
				fPrep($mysqli);
			}
			echo "Prepare statements succeeded!"
		?>
		<br />
		</p>
		<?php include $tmpl.'get date.php'; ?>
	</body>
</html>