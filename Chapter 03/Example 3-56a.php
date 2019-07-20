<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-56</title>
	</head>
	<body>
		<p>
		<h1>mysqli::multi_query example</h1>
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
		if (mysqli_connect_errno()){
			pfConnP();
		}

		$query = "select current_user();";
		$query .= "select Name from City order by id limit 20, 5";

		/* execute multi query */
		if (mysqli_multi_query($link, $query)){
			do {
				/* store first result set */
				if ($result = mysqli_store_result($link)){
					while ($row = mysqli_fetch_row($result)){
						printf("%s\n", $row[0]);
					}
					mysqli_free_result($result);
				}
				/* print driver */
				if (mysqli_more_results($link)){
					print("-------------------\n");
				}
			} while (mysqli_more_results($link) && mysqli_next_result($link));
		}

		/* close connection */
		mysqli_close($link);

		// $dTbl = ;
		$dStr = ob_get_clean();
		nodeToDiv('pre', $dStr);
		// retTbl($dTbl);
	?>
</html>