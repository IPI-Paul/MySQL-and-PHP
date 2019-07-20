<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-39</title>
	</head>
	<body>
		<p>
		<h1>mysqli::__construct example</h1>
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

		$link = mysqli_connect($host, $usr, $pwd, $db);

		ob_start();

		if (!$link){
			die(nodeToDiv('p', dConnP()));
		}

		echo 'Success... MYSQL host info: ' . mysqli_get_host_info($link) . NL;

		mysqli_close($link);

		nodeToDiv('p', ob_get_clean());
	?>
</html>