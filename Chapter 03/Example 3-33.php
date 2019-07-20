<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-33</title>
	</head>
	<body>
		<p>
		<h1>$mysqli->begin_transaction example</h1>
		<h2>Object Oriented style</h2>
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

		$mysqli = new mysqli($host, $usr, $pwd, DB[1]);

		if ($mysqli->connect_errno){
			pfConnO($mysqli);
		}

		$mysqli->begin_transaction(MYSQLI_TRANS_START_READ_ONLY);

		$dTbl = $mysqli->query("select first_name, last_name from actor");
		$mysqli->commit();

		$mysqli->close();

		$dStr = ob_get_clean();
		nodeToDiv('p', $dStr);
		retTbl($dTbl);
	?>
</html>