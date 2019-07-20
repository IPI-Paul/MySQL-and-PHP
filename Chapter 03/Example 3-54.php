<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-54</title>
	</head>
	<body>
		<p>
		<h1>$mysqli->insert_id example</h1>
		<h2>Object oriented style</h2>
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

		$mysqli = new mysqli($host, $usr, $pwd, $db);

		/* check connection */
		if (mysqli_connect_errno()){
			pfConnP();
		}

		$mysqli->query("create table myCity like City");

		$query = "insert into myCity values (NULL, 'Stuttgart', 'DEU', 'Stuttgart', 617000)";
		$mysqli->query($query);

		printf("New Record has id %d.\n", $mysqli->insert_id);

		/* drop table */
		$mysqli->query("Drop table myCity");

		/* close connection */
		$mysqli->close();

		// $dTbl = ;
		$dStr = ob_get_clean();
		nodeToDiv('p', $dStr);
		// retTbl($dTbl);
	?>
</html>