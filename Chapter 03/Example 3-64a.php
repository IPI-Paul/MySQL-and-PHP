<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-64</title>
	</head>
	<body>
		<p>
		<h1>mysqli::select_db example</h1>
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

		/* return name of current default database */
		if ($result = mysqli_query($link, "select database()")){
			$row = mysqli_fetch_row($result);
			printf("Default database is %s.\n".BR, $row[0]);
			mysqli_free_result($result);
		}

		/* change db to world db */
		mysqli_select_db($link, $db);

		/* return name of current default database */
		if ($result = mysqli_query($link, "select database()")){
			$row = mysqli_fetch_row($result);
			printf("Default database is %s.\n".BR, $row[0]);
			mysqli_free_result($result);
		}

		mysqli_close($link);

		// $dTbl = ;
		$dStr = ob_get_clean();
		nodeToDiv('p', $dStr);
		// retTbl($dTbl);
	?>
</html>