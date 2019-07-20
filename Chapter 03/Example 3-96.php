<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-96</title>
	</head>
	<body>
		<p>
		<h1>mysqli_stmt::prepare example</h1>
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

		$city = "Amersfoort";

		/* create a prepared statement */
		$stmt = $mysqli->stmt_init();
		if ($stmt->prepare("select District from City where Name = ?")) {
		
			/* bind parameters for markers */
			$stmt->bind_param("s", $city);

			/* execute query */
			$stmt->execute();

			/* execute query */
			$stmt->bind_result($district);

			/* fetch value */
			$stmt->fetch();

			printf("%s is in district %s\n".BR, $city, $district);

			/* close statement */
			$stmt->close();
		}

		/*close connection */
		$mysqli->close();

		// $dTbl = ;
		$dStr = ob_get_clean();
		nodeToDiv('p', $dStr);
		// retTbl($dTbl);
	?>
</html>