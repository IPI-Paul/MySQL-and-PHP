<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-129</title>
	</head>
	<body>
		<p>
		<h1>mysqli_fetch_lengths example</h1>
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

		$query = "select * from Country order by Code limit 1";

		if ($result = mysqli_query($link, $query)) {
		
			$row = mysqli_fetch_row($result);

			/* display column lengths */
			foreach (mysqli_fetch_lengths($result) as $i => $val) {
				printf("Field %2 has Length %2d\n", $i=1, $val);
			}
			mysqli_free_result($result);
		}

		/* close connection */
		mysqli_close($link);

		// $dTbl = ;
		$dStr = ob_get_clean();
		nodeToDiv('pre', $dStr);
		// retTbl($dTbl);
	?>
</html>