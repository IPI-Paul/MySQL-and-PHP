<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-78</title>
	</head>
	<body>
		<p>
		<h1>mysqli_stmt::data_seek example</h1>
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

		$query = "select Name, CountryCode from City order by Name";
		if ($stmt = $mysqli->prepare($query)) {
			
		/* execute query */
		$stmt->execute();

		/* bind result variables */
		$stmt->bind_result($name, $code);

		/* store result */
		$stmt->store_result();

		/* seek to row no. 400 */
		$stmt->data_seek(399);

		/* fetch values */
		$stmt->fetch();

		printf("City: %s CountryCode: %s\n".BR, $name, $code);

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