<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-65</title>
	</head>
	<body>
		<p>
		<h1>mysqli::set_charset example</h1>
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

		$mysqli = new mysqli($host, $usr, $pwd, DB[2]);

		/* check connection */
		if (mysqli_connect_errno()){
			pfConnP();
		}

		printf("Initial character set: %s\n".BR, $mysqli->character_set_name());

		/* change character set to tf8 */
		if (!$mysqli->set_charset("utf8")){
			printf("Error loading character set utf8: %s\n".BR, $mysqli->error);
			exit();
		} else{
			printf("Current character set: %s\n".BR, $mysqli->character_set_name());
		}

		$mysqli->close();

		// $dTbl = ;
		$dStr = ob_get_clean();
		nodeToDiv('p', $dStr);
		// retTbl($dTbl);
	?>
</html>