<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-42</title>
	</head>
	<body>
		<p>
		<h1>$mysqli->error_list example</h1>
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

		if (!$mysqli->query("set a=1")){
			print_r($mysqli->error_list);
		}

		/* close connection */
		$mysqli->close();

		// $dTbl = ;
		$dStr = ob_get_clean();
		nodeToDiv('pre', $dStr);
		// retTbl($dTbl);
	?>
</html>