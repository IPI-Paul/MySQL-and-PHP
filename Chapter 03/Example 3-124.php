<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-124</title>
	</head>
	<body>
		<p>
		<h1>mysqli_result::$field_count example</h1>
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
		if(mysqli_connect_errno()) {
			pfConnP();
		}

		if ($result = $mysqli->query("select * from City order by ID limit 1")) {
		
			/* determine number of fields in result set */
			$field_cnt = $result->field_count;

			printf("Result set has %d fields.\n", $field_cnt);

			/* close result set */
			$result->close();
		}

		/* close connection */
		$mysqli->close();

		// $dTbl = ;
		$dStr = ob_get_clean();
		nodeToDiv('p', $dStr);
		// retTbl($dTbl);
	?>
</html>