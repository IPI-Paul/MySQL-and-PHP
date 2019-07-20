<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-62</title>
	</head>
	<body>
		<p>
		<h1>mysqli::real_escape_string example</h1>
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
		if (mysqli_connect_errno()){
			pfConnP();
		}

		$mysqli->query("create temporary table myCity like City");

		$city = "'s Hertogenbosch";


		/* this wuery will fail, cause we didn't escape $city */
		if (!$mysqli->query("insert into myCity (Name) values ('$city')")){
			printf("Error: %s\n".BR, $mysqli->sqlstate);
		}

		$city = $mysqli->real_escape_string($city);

		/* this query with escaped $city will work */
		if ($mysqli->query("insert into myCity (Name) values ('$city')")){
			printf("%d Row inserted.\n".BR, $mysqli->affected_rows);
		}

		printf("%s\n".BR, $mysqli->query("select Name from myCity")->fetch_row()[0]);

		$mysqli->close();

		// $dTbl = ;
		$dStr = ob_get_clean();
		nodeToDiv('p', $dStr);
		// retTbl($dTbl);
	?>
</html>