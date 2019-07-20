<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-33</title>
	</head>
	<body>
		<p>
		<h1>$mysqli->begin_transaction example</h1>
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

		$link = mysqli_connect($host, $usr, $pwd, DB[1]);

		if (mysqli_connect_errno()){
			pfConnP();
		}

		mysqli_begin_transaction($link, MYSQLI_TRANS_START_READ_ONLY);

		$dTbl = mysqli_query($link, "select first_name, last_name from actor limit 1");
		mysqli_commit($link);

		mysqli_close($link);

		$dStr = ob_get_clean();
		nodeToDiv('p', $dStr);
		retTbl($dTbl);
	?>
</html>