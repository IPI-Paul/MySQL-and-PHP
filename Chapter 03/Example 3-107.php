<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-107</title>
	</head>
	<body>
		<p>
		<h1>mysqli_result::data_seek example</h1>
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

		$query = "select Name, CountryCode from City order by Name";
		if ($result = $mysqli->query($query)) {
		
			/* seek to row no. 400 */
			$result->data_seek(399);

			/* fetch row */
			$row = $result->fetch_row();

			printf("City: %s CountryCode: %s\n", $row[0], $row[1]);

			/* free result set */
			$result->close();
		}

		/* close connection */
		$mysqli->close();

		// $dTbl = ;
		$dStr = ob_get_clean();
		nodeToDiv('p', $dStr);
		// retTbl($dTbl);
	?>
</html>