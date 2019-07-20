<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-49</title>
	</head>
	<body>
		<p>
		<h1>$mysqli->host_info example</h1>
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
			pfCoonP();
		}

		/* print host information */
		printf("Host info: %s\n", $mysqli->host_info);

		/* close connection */
		$mysqli->close();

		// $dTbl = ;
		$dStr = ob_get_clean();
		nodeToDiv('p', $dStr);
		// retTbl($dTbl);
	?>
</html>