<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-95</title>
	</head>
	<body>
		<p>
		<h1>mysqli_stmt_param_count example</h1>
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
		if(mysqli_connect_errno()) {
			pfConnP();
		}

		if ($stmt = mysqli_prepare($link, "select Name from Country where Name = ? or Code = ?")) {
		
			$marker = mysqli_stmt_param_count($stmt);
			printf("Statement has %d markers.\n".BR, $marker);

			/* close statement */
			mysqli_stmt_close($stmt);
		}

		/* close connection */
		mysqli_close($link);

		// $dTbl = ;
		$dStr = ob_get_clean();
		nodeToDiv('p', $dStr);
		// retTbl($dTbl);
	?>
</html>