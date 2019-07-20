<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-71</title>
	</head>
	<body>
		<p>
		<h1>$mysqli->warning_count example</h1>
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

		$mysqli->query("create table myCity like City");

		/* a remarkable city in Wales */
		$query = "insert into myCity (CountryCode, Name) values('GBR', 'Llanfaipwllgwyngyllgogerychyrndrobwllllantysiligogogoch')";

		$mysqli->query($query);

		function warn($mysqli) {
			if ($result = $mysqli->query("SHOW WARNINGS")){
				$row = $result->fetch_row();
				printf("%s (%d): %s\n".BR, $row[0], $row[1], $row[2]);
				$result->close();
			}			
		}

		if ($mysqli->warning_count) {
			warn($mysqli);
		} else {
			printf("PHP version %s did not produce a warning_count for data truncation\n".BR, phpversion());
			warn($mysqli);
		}

		$mysqli->query("drop table myCity");

		/*close connection */
		$mysqli->close();

		// $dTbl = ;
		$dStr = ob_get_clean();
		nodeToDiv('p', $dStr);
		// retTbl($dTbl);
	?>
</html>