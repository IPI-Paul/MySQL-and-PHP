<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-62</title>
	</head>
	<body>
		<p>
		<h1>mysqli::real_escape_string example</h1>
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

		$link = mysqli_connect($host, $usr, $pwd,$db);

		/* check connection */
		if (mysqli_connect_errno()){
			pfConnP();
		}

		mysqli_query($link, "create temporary table myCity like City");

		$city = "'s Hertogenbosch";

		/* this query will fail, cause we didn't escape $city */
		if (!mysqli_query($link, "insert into myCity (Name) values ('$city')")){
			printf("Error: %s\n".BR, mysqli_sqlstate($link));
		}

		$city = mysqli_real_escape_string($link, $city);

		/* this query with escaped $city will work */
		if (mysqli_query($link, "insert into myCity (Name) values ('$city')")){
			printf("%d Row inserted.\n".BR, mysqli_affected_rows($link));
		}
			
		$result = mysqli_query($link, "select Name from myCity");
		printf("%s\n".BR, mysqli_fetch_row($result)[0]);
		mysqli_close($link);

		// $dTbl = ;
		$dStr = ob_get_clean();
		nodeToDiv('p', $dStr);
		// retTbl($dTbl);
	?>
</html>