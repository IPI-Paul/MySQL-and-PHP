<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-120</title>
	</head>
	<body>
		<p>
		<h1>mysqli_result::fetch_object example</h1>
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

		$query = "select Name, CountryCode from City order by ID desc limit 50, 5";

		if ($result = $mysqli->query($query)) {
			/* fetch object array */
			while ($obj = $result->fetch_object()) {
				printf("%s (%s)\n", $obj->Name, $obj->CountryCode);
			}

			/* free result set */
			$result->close();
		}

		/* close connection */
		$mysqli->close();

		// $dTbl = ;
		$dStr = ob_get_clean();
		nodeToDiv('pre', $dStr);
		// retTbl($dTbl);
	?>
</html>