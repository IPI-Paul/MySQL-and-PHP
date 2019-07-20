<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-82</title>
	</head>
	<body>
		<p>
		<h1>mysqli_stmt::$error_list example</h1>
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

		/* Open a connection */
		$mysqli = new mysqli($host, $usr, $pwd, $db);

		/* check connection */
		if (mysqli_connect_errno()) {
			pfConnP();
		}

		$mysqli->query("create table myCountry like Country");
		$mysqli->query("inserted into myCountry select * from Country");

		$query = "select Name, Code from myCountry order by Name";
		if ($stmt = $mysqli->prepare($query)) {
			
			/* drop table */
			$mysqli->query("drop table myCountry");

			/* execute query */
			$stmt->execute();

			echo "Error:\n".BR;
			print_r($stmt->error_list);

			/* close statement */
			$stmt->close();
		}

		/* close connection */
		$mysqli->close();

		// $dTbl = ;
		$dStr = ob_get_clean();
		nodeToDiv('pre', $dStr);
		// retTbl($dTbl);
	?>
</html>