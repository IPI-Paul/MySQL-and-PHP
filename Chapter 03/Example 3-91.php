<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-91</title>
	</head>
	<body>
		<p>
		<h1>mysqli_stmt_get_result example</h1>
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

		if (!$link) {
			pfConnP();
		}

		$query = "select Name, Population, Continent from Country where Continent = ? order by Name limit 1";
		$stmt = mysqli_stmt_init($link);
		if (!mysqli_stmt_prepare($stmt, $query)) {
			print("Failed to prepare statement\n".BR);
		} else {
			mysqli_stmt_bind_param($stmt, "s", $continent);

			$continent_array = array('Europe', 'Africa', 'Asia', 'North America');

			foreach ($continent_array as $continent) {
				mysqli_stmt_execute($stmt);
				$result = mysqli_stmt_get_result($stmt);
				while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
					foreach ($row as $r) {
						print "$r ";
					}
					print "\n".BR;
				}
			}
		}
		mysqli_stmt_close($stmt);
		mysqli_close($link);

		// $dTbl = ;
		$dStr = ob_get_clean();
		nodeToDiv('p', $dStr);
		// retTbl($dTbl);
	?>
</html>