<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-65</title>
	</head>
	<body>
		<p>
		<h1>mysqli::set_charset example</h1>
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

		$link = mysqli_connect($host, $usr, $pwd, DB[2]);

		/* check connection */
		if (mysqli_connect_errno()){
			pfConnP();
		}

		printf("Initial character set: %s\n".BR, mysqli_character_set_name($link));

		/* change character set to utf8 */
		if (!mysqli_set_charset($link, "utf8")){
			printf("Error loading character set utf8: %s\n".BR,mysqli_error($link));
			exit();
		} else {
			printf("Current character set: %s\n".BR, mysqli_character_set_name($link));
		}

		mysqli_close($link);

		// $dTbl = ;
		$dStr = ob_get_clean();
		nodeToDiv('p', $dStr);
		// retTbl($dTbl);
	?>
</html>