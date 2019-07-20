<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-77</title>
	</head>
	<body>
		<p>
		<h1>mysqli_stmt_bind_result example</h1>
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
		if (!$link) {
			pfConnP();
		}

		/* prepare statement */
		if ($stmt = mysqli_prepare($link, "select Code, Name from Country order by Name limit 5")) {
			mysqli_stmt_execute($stmt);

			/* bind variables to prepared statement */
			mysqli_stmt_bind_result($stmt, $col1, $col2);

			/* fetch values */
			while (mysqli_stmt_fetch($stmt)) {
				printf("%s %s\n".BR, $col1, $col2);
			}

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