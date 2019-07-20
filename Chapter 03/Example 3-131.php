<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-131</title>
	</head>
	<body>
		<p>
		<h1>mysqli_num_rows example</h1>
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

		if ($result = mysqli_query($link, "select Code, Name from Country order by Name")) {
		
			/* determine number of rows in result set */
			$row_cnt = mysqli_num_rows($result);

			printf("Result set has %d rows.\n", $row_cnt);

			/* close result set */
			mysqli_free_result($result);
		}

		/* close connection */
		mysqli_close($link);

		// $dTbl = ;
		$dStr = ob_get_clean();
		nodeToDiv('p', $dStr);
		// retTbl($dTbl);
	?>
</html>