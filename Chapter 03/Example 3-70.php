<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-70</title>
	</head>
	<body>
		<p>
		<h1>mysqli::use_result example</h1>
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
		$query .= "select Name from City order by ID limit 20, 5";

		/* execute multi query */
		if ($mysqli->multi_query($query)){
			do {
				/* store first result set */
				if ($result = $mysqli->use_result()){
					while ($row = $result->fetch_row()){
						printf("%s\n".BR, $row[0]);
					}
					$result->close();
				}
				/* print divider */
				if ($mysqli->more_results()){
					printf("-----------------\n".BR);
				}
			} while ($mysqli->more_results() and $mysqli->next_result());
		}

		/* close connection */
		$mysqli->close();

		// $dTbl = ;
		$dStr = ob_get_clean();
		nodeToDiv('p', $dStr);
		// retTbl($dTbl);
	?>
</html>