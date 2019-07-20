<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-31</title>
		<?php
			include '../IPI/settings.php';
			include IPI.'IPI Functions.php';

			ob_start();

			$link = mysqli_connect($host, $usr, $pwd, $db);

			if (!$link){
				printf("Can't connect to localhost. Error: %s\n".NB, mysqli_connect_error());
				exit();
			}

			/* Insert rows */
			mysqli_query($link, "create table Language select * from CountryLanguage");
			printf("Affected rows (INSERT): %d\n".BR, mysqli_affected_rows($link));

			mysqli_query($link, "alter table Language add Status int default 0");

			/* update rows */
			mysqli_query($link, "update Language set Status=1 where Percentage > 50");
			printf("Affected rows (UPDATE): %d\n".BR, mysqli_affected_rows($link));

			/* delete rows */
			mysqli_query($link, "delete from Language where Percentage < 50");
			printf("Affected rows (DELETE): %d\n".BR, mysqli_affected_rows($link));

			/* select all rows */	
			$result = mysqli_query($link, "select * from Language");
			printf("Affected rows (SELECT): %d\n".BR, mysqli_affected_rows($link));

			$dTbl = $result;
			$dStr = ob_get_clean();
		?>
	</head>
	<body>
		<p>
		<h1>$mysqli->affected_rows example</h1>
		<h2>Procedural style</h2>
		<hr />
		<div name="retStr"></div>
		<table name="retRes" width="100%"></table>
		<br />
		<?php 
			nodeToDiv('p', $dStr);
			retTbl($dTbl);

			mysqli_free_result($result);

			/* Delete table Language */
			mysqli_query($link, "drop table Language");

			/* close connection */
			mysqli_close($link);

			include $tmpl.'get date.php'; 
		?>
		</p>
	</body>
</html>