<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-76</title>
	</head>
	<body>
		<p>
		<h1>mysqli_stmt::bind_result example</h1>
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

		if (mysqli_connect_errno()) {
			pfConnP();
		}

		/* prepare statement */
		if ($stmt = $mysqli->prepare("select Code, Name from Country order by Name limit 5")) {
			$stmt->execute();

			/* bind variables to prepared statement */
			$stmt->bind_result($col1, $col2);

			/* fetch values */
			while ($stmt->fetch()) {
				printf("%s %s\n".BR, $col1, $col2);
			}

			/* close statement */
			$stmt->close();
		}

		/* close connection */
		$mysqli->close();

		// $dTbl = ;
		$dStr = ob_get_clean();
		nodeToDiv('p', $dStr);
		// retTbl($dTbl);
	?>
</html>