<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-123</title>
	</head>
	<body>
		<p>
		<h1>mysli_fetch_row example</h1>
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
		if (mysqli_connect_errno()){
			pfConnP();
		}

		$query = "select Name, CountryCode from City order by ID desc limit 50, 5";

		if ($result = mysqli_query($link, $query)) {
		
			/* fetch associative array */
			while ($row = mysqli_fetch_row($result)) {
				printf("%s (%s)\n", $row[0], $row[1]);
			}

			/* free result set */
			mysqli_free_result($result);
		}

		/* close connection */
		mysqli_close($link);

		// $dTbl = ;
		$dStr = ob_get_clean();
		nodeToDiv('pre', $dStr);
		// retTbl($dTbl);
	?>
</html>