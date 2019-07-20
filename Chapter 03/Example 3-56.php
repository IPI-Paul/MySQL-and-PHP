<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-56</title>
	</head>
	<body>
		<p>
		<h1>mysqli::multi_query example</h1>
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

		$query = "select current_user();";
		$query .= "select Name from City order by id limit 20, 5";

		/* execute multi query */
		if ($mysqli->multi_query($query)){
			do {
				/* store first result set */
				if ($result = $mysqli->store_result()){
					while ($row = $result->fetch_row()){
						printf("%s\n", $row[0]);
					}
					$result->free();
				}
				/* print divider */
				if ($mysqli->more_results()){
					(print"-----------------\n");
				}
			} while ($mysqli->more_results() && $mysqli->next_result());
		}

		/* close connection */
		$mysqli->close();

		// $dTbl = ;
		$dStr = ob_get_clean();
		nodeToDiv('pre', $dStr);
		// retTbl($dTbl);
	?>
</html>