<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example </title>
	</head>
	<body>
		<p>
		<h1>mysqli_stmt::$affected_rows example</h1>
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
		if (mysqli_connect_errno()) {
			pfConnP();
		}

		/* create temp table */
		$mysqli->query("create temporary table myCountry like Country");

		$query = "insert into myCountry select * from Country where Code like ?";

		/* prepare statement */
		if ($stmt = $mysqli->prepare($query)) {
			
		/* Bind variable for placeholder */
		$code = 'A%';
		$stmt->bind_param("s", $code);

		/* execute statement */
		$stmt->execute();

		printf("rows inserted: %d\n".BR, $stmt->affected_rows);

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