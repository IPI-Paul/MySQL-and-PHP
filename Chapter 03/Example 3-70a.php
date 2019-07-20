<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-70</title>
	</head>
	<body>
		<p>
		<h1>mysqli::use_result example</h1>
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
		$query .= "select Name from City order by ID limit 20, 5";

		/* execute multi query */
		if (mysqli_multi_query($link, $query)) {
			do {
				/* store first result set */
				if ($result = mysqli_use_result($link)) {
					while ($row = mysqli_fetch_row($result)) {
						printf("%s\n".BR, $row[0]);
					}
					mysqli_free_result($result);
				}
				/* print divider */
				if (mysqli_more_results($link)) {
					printf("---------------------\n".BR);
				}
			} while (mysqli_more_results($link) and mysqli_next_result($link));
		} 

		/* close connection */
		mysqli_close($link);

		// $dTbl = ;
		$dStr = ob_get_clean();
		nodeToDiv('p', $dStr);
		// retTbl($dTbl);
	?>
</html>