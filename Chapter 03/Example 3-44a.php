<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-44</title>
	</head>
	<body>
		<p>
		<h1>$mysqli->field_count example</h1>
		<h2>Procedural style</h2>
		<hr />
		<div name="retStr"></div>
		<table name="retRes" width="100%"></table>
		<br />
		</p>
	</body>
	<?php 
		include '../IPI/settings.php';
		include IPI.'IPI Functions.php';
		include $tmpl.'get date.php'; 

		ob_start();

		$link = mysqli_connect($host, $usr, $pwd, DB[2]);

		mysqli_query($link, "drop table if exists friends");
		mysqli_query($link, "create table friends (id int, name varchar(20))");

		mysqli_query($link, "insert into friends values (1, 'Hartmut'), (2, 'Ulf')");

		mysqli_real_query($link, "select * from friends");

		if (mysqli_field_count($link)){
			printf("There are %d fields".NL.BR.BR, mysqli_field_count($link));

			/* this was a select/show or describe query */
			$result = mysqli_store_result($link);
			print_r($result);

			/* process resultset */
			while ($row = mysqli_fetch_row($result)){
				print_r($row);
			}

			/* free resultset */
			mysqli_free_result($result);
		}

		$dTbl = mysqli_query($link, "select * from friends");

		/* close connection */
		mysqli_close($link);

		$dStr = ob_get_clean();
		nodeToDiv('pre', $dStr);
		retTbl($dTbl);
	?>
</html>