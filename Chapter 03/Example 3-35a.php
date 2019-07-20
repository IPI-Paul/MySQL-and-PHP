<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-35</title>
	</head>
	<body>
		<p>
		<h1>mysqli::character_set_name</h1>
		<h2>Procedurl style</h2>
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

		/* Open connection */
		$link = mysqli_connect($host, $usr, $pwd, $db);

		/* chech connection */
		if (!$link){
			pfConnP();
		}

		/* Print current character set */
		$charset = mysqli_character_set_name($link);
		printf("Current character set is %s\n".BR, $charset);

		/* close connection */
		mysqli_close($link);

		// $dTbl = ;
		$dStr = ob_get_clean();
		nodeToDiv('p', $dStr);
		// retTbl($dTbl);
	?>
</html>