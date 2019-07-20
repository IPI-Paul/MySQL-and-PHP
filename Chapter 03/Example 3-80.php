<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-80</title>
	</head>
	<body>
		<p>
		<h1>mysqli_stmt::$errno example</h1>
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

		/* Open connection */
		$mysqli = new mysqli($host, $usr, $pwd, $db);

		/* check connection */
		if (mysqli_connect_errno()) {
			pfConnP();
		}

		$mysqli->query("create table myCountry like Country");
		$mysqli->query("insert into myCountry select * from Country");

		$query = "select Name , Code from myCountry order by Name";
		if ($stmt = $mysqli->prepare($query)) {
			
			/* drop table */
			$mysqli->query("drop table myCountry");

			/* execute query */
			$stmt->execute();

			printf("Error: %d.\n".BR, $stmt->errno);

			/* close statement */
			$stmt->close();
		}

		/* close connection */
		$mysqli->close();

		// $dTbl = ;
		$dStr = ob_get_clean();
		nodeToDiv('p', $dStr);
		// retTbl($dTbl);
	?>
</html>