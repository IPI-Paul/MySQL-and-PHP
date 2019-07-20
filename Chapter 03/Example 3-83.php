<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-83</title>
	</head>
	<body>
		<p>
		<h1>mysqli_stmt_error_list example</h1>
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

		/* Open a connection */
		$link = mysqli_connect($host, $usr, $pwd, $db);

		/* check connection */
		if (mysqli_connect_errno()) {
			pfConnP();
		}

		mysqli_query($link, "create table myCountry like Country");
		mysqli_query($link, "insert into myCountry select * from Country");

		$query = "select Name, Code from myCountry order by Name";
		if ($stmt = mysqli_prepare($link, $query)) {
			
			/* drop table */
			mysqli_query($link, "drop table myCountry");

			/* execute query */
			mysqli_stmt_execute($stmt);

			echo "Error:\n".BR;
			print_r(mysqli_stmt_error_list($stmt));

			/* close statement */
			mysqli_stmt_close($stmt);
		}

		/* close connection */
		mysqli_close($link);

		// $dTbl = ;
		$dStr = ob_get_clean();
		nodeToDiv('pre', $dStr);
		// retTbl($dTbl);
	?>
</html>