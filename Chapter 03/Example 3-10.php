<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-10</title>
	</head>
	<body>
		<p>
		<h1>Native data types with mysqlnd and connection option</h1>
		<hr />
		<div name="retStr"></div>
		<br />
		<?php
			include '../IPI/settings.php';
			include IPI.'IPI Functions.php';

			$mysqli = mysqli_init();
			$mysqli->options(MYSQLI_OPT_INT_AND_FLOAT_NATIVE, 1);
			$mysqli->real_connect($host, $usr, $pwd, $db);
			
			if ($mysqli->connect_errno){
				fConn($mysqli);
			}

			if (!$mysqli->query('drop table if exists test') || 
				!$mysqli->query('create table test(id int, label char(1))') || 
				!$mysqli->query("insert into test(id, label) values(1, 'a')")
				) {
				fConn($mysqli);
			}

			$res = $mysqli->query('select id, label from test where id = 1');
			$row = $res->fetch_assoc();

			// printf("id = %s (%s)\n", $row['id'], gettype($row['id']));
			// printf("label = %s (%s)\n", $row['label'], gettype($row['label']));

			$dStr = sprintf("id = %s (%s)\n", $row['id'], gettype($row['id']));
			$dStr .= sprintf("label = %s (%s)\n", $row['label'], gettype($row['label']));
			sendToDiv('pre', $dStr);
		?>
		<br />
		</p>
		<?php include $tmpl.'get date.php'; ?>
	</body>
</html>