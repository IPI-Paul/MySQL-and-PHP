<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-38</title>
	</head>
	<body>
		<p>
		<h1>$mysqli->connect_error example</h1>
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

		$link = @mysqli_connect($host, 'fake_user', $pwd, DB[2]);

		if (!$link){
			die(nodeToDiv('p', 'Connect Error: ' . mysqli_connect_error()));
		}
	?>
</html>