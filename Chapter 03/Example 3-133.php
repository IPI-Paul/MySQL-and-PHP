<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-133</title>
	</head>
	<body>
		<p>
		<h1>mysqli_report example</h1>
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

		/* activate reporting */
		mysqli_report(MYSQLI_REPORT_ALL);

		$link = mysqli_connect($host, $usr, $pwd, $db);

		/* check connection */
		if (mysqli_connect_errno()) {
			pfConnP();
		}

		/* this query should report an error */
		try {		
			$result = mysqli_query($link, "select Name from Nonexistingtable where population > 50000");
			mysqli_free_result($result);
		} catch (mysqli_sql_exception $e) {
			echo str_replace(" in ", "\nin:\n", $e->__toString()).BR.BR;
		}

		/* this query should report a bad index */

		try {		
			$result = mysqli_query($link, "Select Name from City where population > 50000");
			mysqli_free_result($result);
		} catch (mysqli_sql_exception $e) {
			echo str_replace(" in ", "\nin:\n", $e->__toString());
		}

		mysqli_close($link);

		mysqli_report(MYSQLI_REPORT_OFF);

		// $dTbl = ;
		$dStr = ob_get_clean();
		nodeToDiv('pre', $dStr);
		// retTbl($dTbl);
	?>
</html>