<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-60</title>
	</head>
	<body>
		<p>
		<h1>mysqli::query example</h1>
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
		if ($mysqli->connect_errno){
			pfConnO($mysqli);
		}

		/* Create table doesn't return a resultset */
		if($mysqli->query("create temporary table myCity like City") == True){
			printf("Table myCity successfully created.\n".BR);
		}

		/* Select queries return a resultset */
		if ($result = $mysqli->query("select Name from City Limit 10")){
			printf("Select returned %d rows.\n".BR, $result->num_rows);

			/* free result set */
			$result->close();
		}

		/* If we have to retrieve large amount of data we use MYSQLI_USE_RESULT */
		if ($result = $mysqli->query("select * from City", MYSQLI_USE_RESULT)){
			
			/* Note, that we can't execute any functions which interact with the server until result set was closed.
			all calls will return an 'out of sync' error */
			if (!$mysqli->query("set @a:='this will not work'")){
				printf("Error: %s\n", $mysqli->error);
			}
			$result->close();
		}

		$mysqli->close();

		// $dTbl = ;
		$dStr = ob_get_clean();
		nodeToDiv('p', $dStr);
		// retTbl($dTbl);
	?>
</html>