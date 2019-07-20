<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-54</title>
	</head>
	<body>
		<p>
		<h1>$mysqli->insert_id example</h1>
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

		$link = mysqli_connect($host, $usr, $pwd, $db);

		/* check connection */
		if (mysqli_connect_errno()){
			pfConnP();
		}

		mysqli_query($link, "create table myCity like City");

		$query = "insert into myCity values (NULL, 'Stuttgart', 'DEU', 'Stuttgart', 617000)";
		mysqli_query($link, $query);

		printf("New Record has id %d.\n", mysqli_insert_id($link));

		/* drop table */
		mysqli_query($link, "drop table myCity");

		/* close connection */
		mysqli_close($link);

		// $dTbl = ;
		$dStr = ob_get_clean();
		nodeToDiv('p', $dStr);
		// retTbl($dTbl);
	?>
</html>