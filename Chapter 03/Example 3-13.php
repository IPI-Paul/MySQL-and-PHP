<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-13</title>
	</head>
	<body>
		<p>
		<h1>INSERT prepared once, executed multiple times</h1>
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

			/* prepared statement, stage 1: prepare */
			if (!($stmt = $mysqli->prepare('insert into test(id) values(?)'))){
				fPrep($mysqli);
			}

			/* Prepared statement, stage 2: bind and execute */
			$id = 1;
			if ($stmt->bind_param('i', $id)){
				fBind($stmt);
			}

			if (!$stmt->execute()){
				fExec($stmt);
			}

			/* Prepared statement: repeated execution, only data transferred from client to server */
			for ($id = 2; $id < 5; $id++){
				if (!$stmt->execute()){
					fExec($stmt);
				}
			}

			/* explicit close recommended */
			$stmt->close();

			/* Non-prepared statement */
			$res = $mysqli->query('select id from test');
			echo '<pre>';
			var_dump($res->fetch_all());
			echo '</pre>';
		?>
		<br />
		</p>
		<?php include $tmpl.'get date.php'; ?>
	</body>
</html>