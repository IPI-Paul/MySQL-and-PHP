<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-92</title>
	</head>
	<body>
		<p>
		<h1>mysqli_stmt::$num_rows, mysqli_stmt::num_rows example</h1>
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

		/* Open a connection */
		$mysqli = new mysqli($host, $usr, $pwd, $db);

		/* check connection */
		if (mysqli_connect_errno()) {
			pfConnP();
		}

		$query = "select Name, CountryCode from City order by Name limit 20";
		if ($stmt = $mysqli->prepare($query)) {
		
			/* execute query */
			$stmt->execute();

			/* store result */
			$stmt->store_result();

			printf("Number of rows: %d.\n".BR, $stmt->num_rows);

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