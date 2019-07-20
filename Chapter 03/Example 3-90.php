<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-90</title>
	</head>
	<body>
		<p>
		<h1>mysqli_stmt::get_result example</h1>
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

		if ($mysqli->connect_error) {
			die(nodeToDiv('p', "$mysqli->connect_errno: $mysqli->connect_error"));
		}

		$query = "select Name, Population, Continent from Country where Continent = ? order by Name limit 1";

		$stmt = $mysqli->stmt_init();
		if (!$stmt->prepare($query)) {
			print("Failed to prepare statement\n".BR);
		} else {
			$stmt->bind_param("s", $continent);

			$continent_array = array('Europe', 'Africa', 'Asia', 'North America');

			foreach ($continent_array as $continent) {
				$stmt->execute();
				$result = $stmt->get_result();
				while ($row = $result->fetch_array(MYSQLI_NUM)) {
					foreach ($row as $r) {
						print "$r ";
					}
					print "\n".BR;
				}
			}
		}

		$stmt->close();
		$mysqli->close();

		// $dTbl = ;
		$dStr = ob_get_clean();
		nodeToDiv('p', $dStr);
		// retTbl($dTbl);
	?>
</html>