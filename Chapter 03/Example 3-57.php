<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-57</title>
	</head>
	<body>
		<p>
		<h1>mysqli::ping example</h1>
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

		/* check if erver is alive */
		if ($mysqli->ping()){
			printf("Our connection is ok!\n");
		} else{
			printf("Error: %s\n", $mysqli->error);
		}

		/* close connection */
		$mysqli->close();

		// $dTbl = ;
		$dStr = ob_get_clean();
		nodeToDiv('p', $dStr);
		// retTbl($dTbl);
	?>
</html>