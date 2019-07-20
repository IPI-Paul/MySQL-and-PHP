<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-110</title>
	</head>
	<body>
		<p>
		<h1>mysqli_fetch_array example</h1>
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
		if (mysqli_connect_errno()) {
			pfConnP();
		}

		$query = "select Name, CountryCode from City order by ID limit 3";
		$result = mysqli_query($link, $query);

		/* numeric array */
		$row = mysqli_fetch_array($result, MYSQLI_NUM);
		printf("%s (%s)\n", $row[0], $row[1]);

		/* associative array */
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		printf("%s (%s)\n", $row["Name"], $row["CountryCode"]);

		/* associative and numeric array */
		$row = mysqli_fetch_array($result, MYSQLI_BOTH);
		printf("%s (%s)\n", $row[0], $row["CountryCode"]);

		/* free result set */
		mysqli_free_result($result);

		/* close connection */
		mysqli_close($link);

		// $dTbl = ;
		$dStr = ob_get_clean();
		nodeToDiv('pre', $dStr);
		// retTbl($dTbl);
	?>
</html>