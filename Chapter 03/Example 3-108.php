<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-108</title>
	</head>
	<body>
		<p>
		<h1>mysqli_data_seek example</h1>
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

		/* Open a conection */
		$link = mysqli_connect($host, $usr, $pwd, $db);

		/* check connection */
		if (mysqli_connect_errno()) {
			pfConnP();
		}

		$query = "select Name, CountryCode from City order by Name";

		if ($result = mysqli_query($link, $query)) {
		
			/* seek to row no. 400 */
			mysqli_data_seek($result, 399);

			/* fetch row */
			$row = mysqli_fetch_row($result);

			printf("City: %s CountryCode: %s\n", $row[0], $row[1]);

			/* free result set */
			mysqli_free_result($result);
		}

		/* close conection */
		mysqli_close($link);

		// $dTbl = ;
		$dStr = ob_get_clean();
		nodeToDiv('p', $dStr);
		// retTbl($dTbl);
	?>
</html>