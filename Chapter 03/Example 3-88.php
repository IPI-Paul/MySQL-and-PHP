<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-88</title>
	</head>
	<body>
		<p>
		<h1>mysqli_stmt::fetch example</h1>
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
		if(mysqli_connect_errno()) {
			pfConnP();
		}

		$query = "select Name, CountryCode from City order by ID desc limit 150, 5";

		if ($stmt = $mysqli->prepare($query)) {
		
			/* execute statement */
			$stmt->execute();

			/* bind result vairables */
			$stmt->bind_result($name, $code);

			/* fetch values */
			while ($stmt->fetch()) {
				printf("%s (%s)\n".BR, $name, $code);
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