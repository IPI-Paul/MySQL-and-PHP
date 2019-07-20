<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-73</title>
	</head>
	<body>
		<p>
		<h1>mysqli_stmt::$affected_rows example</h1>
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

		/* create temp table */
		mysqli_query($link, "create temporary table myCountry like Country");

		$query = "insert into myCountry select * from Country where Code like ?";

		/* prepare statement */
		if ($stmt = mysqli_prepare($link, $query)) {
			
			/* Bind variable for placeholder */
			$code = 'A%';
			mysqli_stmt_bind_param($stmt, "s", $code);

			/* execute statement */
			mysqli_stmt_execute($stmt);

			printf("rows inserted: %d\n".BR, mysqli_stmt_affected_rows($stmt));

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