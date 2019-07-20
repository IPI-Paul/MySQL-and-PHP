<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-74</title>
	</head>
	<body>
		<p>
		<h1>mysqli_stmt::bind_param example</h1>
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

		$stmt = $mysqli->prepare("insert into CountryLanguage values (?, ?, ?, ?)");
		$stmt->bind_param('sssd', $code, $language, $official, $percent);

		$code = 'DEU';
		$language = 'Bavarian';
		$official = "F";
		$percent = 11.2;

		/* execute prepared statement */

		$stmt->execute();

		printf("%d Row inserted.\n".BR, $stmt->affected_rows);

		/*close statement and connection */
		$stmt->close();

		/* Clean up table CountryLanguage */
		$mysqli->query("delete from CountryLanguage where Language='Bavarian'");
		printf("%d Row deleted.\n".BR, $mysqli->affected_rows);

		/* close connection */
		$mysqli->close();

		// $dTbl = ;
		$dStr = ob_get_clean();
		nodeToDiv('p', $dStr);
		// retTbl($dTbl);
	?>
</html>