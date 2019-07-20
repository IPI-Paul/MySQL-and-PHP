<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-87</title>
	</head>
	<body>
		<p>
		<h1>mysqli_stmt_execute example</h1>
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

		mysqli_query($link, "create table myCity like City");

		/* Prepare an insert statement */
		$query = "insert into myCity (Name, CountryCode, District) values (?,?,?)";
		$stmt = mysqli_prepare($link, $query);

		mysqli_stmt_bind_param($stmt, "sss", $val1, $val2, $val3);

		$val1 = 'Stuttgart';
		$val2 = 'DEU';
		$val3 = 'Baden-Wuerttemberg';

		/* Execute the statement */
		mysqli_stmt_execute($stmt);

		$val1 = 'Bordeuax';
		$val2 = 'FRA';
		$val3 = 'Aquitaine';

		/* Execute the statement */
		mysqli_stmt_execute($stmt);

		/* close statement */
		mysqli_stmt_close($stmt);

		/* retrieve all rows from myCity */
		$query = "select Name, CountryCode, District from myCity";
		if ($result = mysqli_query($link, $query)) {
			while ($row = mysqli_fetch_row($result)) {
				printf("%s (%s, %s)\n".BR, $row[0], $row[1], $row[2]);
			}
			/* free result set */
			mysqli_free_result($result);
		}

		/* remove table */
		mysqli_query($link, "drop table myCity");

		/* close connection */
		mysqli_close($link);

		// $dTbl = ;
		$dStr = ob_get_clean();
		nodeToDiv('p', $dStr);
		// retTbl($dTbl);
	?>
</html>