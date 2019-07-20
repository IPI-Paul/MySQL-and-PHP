<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-132</title>
	</head>
	<body>
		<p>
		<h1>mysqli_driver::$report_mode example</h1>
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

		/* activate reporting */
		$driver = new mysqli_driver();
		$driver->report_mode= MYSQLI_REPORT_ALL;

		try {		
			/* this query should report an error */
			$result = $mysqli->query("select Name from Nonexisitingtable where population > 50000");

			$result->close();			
		} catch (mysqli_sql_exception $e) {
			echo str_replace(" in ", "\nin:\n", $e->__toString()).BR.BR;
		}

		try {		
			/* this query should report a bad index */
			$result = $mysqli->query("select Name from City where population > 50000");

			$result->close();			
		} catch (mysqli_sql_exception $e) {
			echo str_replace(" in ", "\nin:\n", $e->__toString());
		}
		$mysqli->close();

		$driver->report_mode = MYSQLI_REPORT_OFF;

		// $dTbl = ;
		$dStr = ob_get_clean();
		nodeToDiv('pre', $dStr);
		// retTbl($dTbl);
	?>
</html>