<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-128</title>
	</head>
	<body>
		<p>
		<h1>mysqli_result::$lengths example</h1>
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
		if (mysqli_connect_errno()) {
			pfConnP();
		}

		$query = "select * from Country order by Code limit 1";

		if ($result = $mysqli->query($query)) {
		
			$row = $result->fetch_row();

			/* display column lengths */
			foreach ($result->lengths as $i => $val) {
				printf("Field %2d has Length %2d\n", $i+1, $val);
			}
			$result->close();
		}

		/* close connection */
		$mysqli->close();

		// $dTbl = ;
		$dStr = ob_get_clean();
		nodeToDiv('pre', $dStr);
		// retTbl($dTbl);
	?>
</html>