<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-114</title>
	</head>
	<body>
		<p>
		<h1>mysqli_result::fetch_field_direct example</h1>
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

		$query = "select Name, SurfaceArea from Country order by Name limit 5";

		if ($result = $mysqli->query($query)) {
		
			/* Get field information for column 'SurfaceArea' */
			$finfo = $result->fetch_field_direct(1);

			printf("Name\t\t: %s\n", $finfo->name);
			printf("Table\t\t: %s\n", $finfo->table);
			printf("max. Len\t: %d\n", $finfo->max_length);
			printf("Flags\t\t: %d\n", $finfo->flags);
			printf("Type\t\t: %d\n\n", $finfo->type);

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