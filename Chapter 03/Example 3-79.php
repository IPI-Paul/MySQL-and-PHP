<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-79</title>
	</head>
	<body>
		<p>
		<h1>mysqli_stmt_data_seek example</h1>
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

		/* Open connection */
		$link = mysqli_connect($host, $usr, $pwd, $db);

		/* check connection */
		if (mysqli_connect_errno()) {
			pfConnP();
		}

		$query = "select Name, CountryCode from City order by Name";
		if ($stmt = mysqli_prepare($link,  $query)) {
			
			/* execute  query */
			mysqli_stmt_execute($stmt);

			/* bind result variables */
			mysqli_stmt_bind_result($stmt, $name, $code);

			/* store result */
			mysqli_stmt_store_result($stmt);

			/* seek to row no. 400 */
			mysqli_stmt_data_seek($stmt, 399);

			/* fetch values */
			mysqli_stmt_fetch($stmt);

			printf("City: %s CountryCode: %s\n".BR, $name, $code);

			/* close statement */
			mysqli_stmt_close($stmt);
		}

		/* close connection */
		mysqli_close($link);

		// $dTbl = ;
		$dStr = ob_get_clean();
		nodeToDiv('p', $dStr);
		// retTbl($dTbl);
	?>
</html>