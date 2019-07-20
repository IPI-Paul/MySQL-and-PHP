<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-86</title>
	</head>
	<body>
		<p>
		<h1>mysqli_stmt::execute example</h1>
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

		/* Prepare an insert statement */
		$query = "insert into myCity (Name, CountryCode, District) values (?,?,?)";
		$stmt = $mysqli->prepare($query);

		$stmt->bind_param("sss", $val1, $val2, $val3);

		$val1 = 'Stuttgart';
		$val2 = 'DEU';
		$val3 = 'Baden-Wuerttemberg';

		/* Execute the statement */
		$stmt->execute();

		$val1 = 'Bordeaux';
		$val2 = 'FRA';
		$val3 = 'Aquitaine';

		/* Execute the statement */
		$stmt->execute();

		/* close statement */
		$stmt->close();

		/* retrieve all rows from myCity */
		$query = "select Name, CountryCode, District from myCity";
		if($result = $mysqli->query($query)) {
			while ($row = $result->fetch_row()) {
				printf("%s (%s, %s)\n".BR, $row[0], $row[1], $row[2]);
			}
			/* free result set */
			$result->close();
		}

		/* remove table */
		$mysqli->query("drop table myCity");

		/* close connection */
		$mysqli->close();

		// $dTbl = ;
		$dStr = ob_get_clean();
		nodeToDiv('p', $dStr);
		// retTbl($dTbl);
	?>
</html>