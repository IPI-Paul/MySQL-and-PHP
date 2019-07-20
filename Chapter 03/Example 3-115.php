<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-115</title>
	</head>
	<body>
		<p>
		<h1>mysqli_fetch_field_direct example</h1>
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

		$query = "select Name, SurfaceArea from Country order by Name limit 5";

		if ($result = mysqli_query($link, $query)) {
		
			/* Get field informtion for column 'Surface Area' */
			$finfo = mysqli_fetch_field_direct($result, 1);

			printf("Name\t\t: %s\n", $finfo->name);
			printf("Table\t\t: %s\n", $finfo->table);
			printf("max. Len\t: %d\n",$finfo->max_length);
			printf("Flags\t\t: %d\n", $finfo->flags);
			printf("Type\t\t: %d\n\n", $finfo->type);

			mysqli_free_result($result);
		}

		/* close connection */
		mysqli_close($link);

		// $dTbl = ;
		$dStr = ob_get_clean();
		nodeToDiv('pre', $dStr);
		// retTbl($dTbl);
	?>
</html>