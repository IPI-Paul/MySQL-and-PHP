<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-31</title>
		<?php
			include '../IPI/settings.php';
			include IPI.'IPI Functions.php';

			ob_start();

			$mysqli = new mysqli($host, $usr, $pwd, $db);

			/* check connection */
			if (mysqli_connect_errno()){
				printf("Connect failed: %s\n", mysqli_connect_error());
			}

			/* insert rows */
			$mysqli->query("create table Language select * from CountryLanguage");
			printf("Affected rows (INSERT): %d\n".NB, $mysqli->affected_rows);

			$mysqli->query("alter table Language add Status int default 0");

			/* update rows */
			$mysqli->query("update Language set Status=1 where Percentage > 50");
			printf("Affected rows (UPDATE): %d\n".NB, $mysqli->affected_rows);

			/* delete rows */
			$mysqli->query("delete from Language where Percentage < 50");
			printf("Affected rows (DELETE): %d\n".NB, $mysqli->affected_rows);

			/* select all rows */
			$result = $mysqli->query("select * from Language");
			printf("Affected rows (SELECT): %d\n".NB, $mysqli->affected_rows);

			$dTbl = $result;
			$dStr = ob_get_clean();
		?>
	</head>
	<body>
		<p>
		<h1>$mysqli->affected_rows example</h1>
		<h2>Object oriented style</h2>
		<hr />
		<div name="retStr"></div>
		<table name="retRes" width="100%"></table>
		<br />
		<?php 
			nodeToDiv('p', $dStr);
			retTbl($dTbl);

			$result->close();

			/* Delete table Language */
			$mysqli->query("drop table Language");

			/* close connection */
			$mysqli->close();

			include $tmpl.'get date.php'; 
		?>
		</p>
	</body>
</html>