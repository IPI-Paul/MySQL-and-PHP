<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-59</title>
	</head>
	<body>
		<p>
		<h1>mysqli::prepare example</h1>
		<h2>Procedural</h2>
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
		if (mysqli_connect_errno()){
			pfConnP();
		}

		$city = "Amersfoort";

		/* create  a prepared statement */
		if ($stmt = mysqli_prepare($link, "select District from City where Name = ?")){
			
			/* bind parameters for markers */
			mysqli_stmt_bind_param($stmt, "s", $city); 

			/* execute query */
			mysqli_stmt_execute($stmt);

			/* bind result variables */
			mysqli_stmt_bind_result($stmt, $district);

			/* fetch value */
			mysqli_stmt_fetch($stmt);
			printf("%s is in district %s\n", $city, $district);

			/* close statement */
			mysqli_stmt_close($stmt);
		}

		/* close connection */
		mysqli_close($link);

		// $dTbl = ;
		$dStr = ob_get_clean();
		nodeToDiv('p', $dStr);
		// retTbl($dTbl);
	?>
</html>