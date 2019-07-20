<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-71</title>
	</head>
	<body>
		<p>
		<h1>$mysqli->warning_count example</h1>
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
		if (mysqli_connect_errno()){
			pfConnP();
		}

		mysqli_query($link, "create table myCity like City");

		/* a remarkable long city name in Wales */
		$query = "insert into myCity (CountryCode, Name) values('GBR',
		'Llanfairpwllgwyngyllgogerychwyrndrobwllllantysiliogogogoch')";

		mysqli_query($link, $query);

		function warn($link){
			if ($result = mysqli_query($link, "show warnings")){
				$row = mysqli_fetch_row($result);
				printf("%s (%d): %s\n".BR, $row[0], $row[1], $row[2]);
				mysqli_free_result($result);
			}			
		}

		if (mysqli_warning_count($link)) {
			warn($link);
		} else {
			printf("PHP version %s did not produce a warning_count for data truncation\n".BR, phpversion());
			warn($link);
		}

		mysqli_query($link, "drop table myCity");

		/* close connection */
		mysqli_close($link);

		// $dTbl = ;
		$dStr = ob_get_clean();
		nodeToDiv('p', $dStr);
		// retTbl($dTbl);
	?>
</html>