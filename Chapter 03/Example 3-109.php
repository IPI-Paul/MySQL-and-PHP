<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-109</title>
	</head>
	<body>
		<p>
		<h1>mysqli_result::fetch_array example</h1>
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

		$query = "select Name, CountryCode from City order by ID limit 3";
		$result = $mysqli->query($query);

		/* numeric array */
		$row = $result->fetch_array(MYSQLI_NUM);
		printf("%s (%s)\n", $row[0], $row[1]);

		/* associative array */
		$row = $result->fetch_array(MYSQLI_ASSOC);
		printf("%s (%s)\n", $row["Name"], $row["CountryCode"]);

		/* associative and numeric array */
		$row = $result->fetch_array(MYSQLI_BOTH);
		printf("%s (%s)\n", $row[0],$row["CountryCode"]);

		/* free result set */
		$result->free();

		/* close connection */
		$mysqli->close();

		// $dTbl = ;
		$dStr = ob_get_clean();
		nodeToDiv('pre', $dStr);
		// retTbl($dTbl);
	?>
</html>