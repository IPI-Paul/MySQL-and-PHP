<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-37</title>
	</head>
	<body>
		<p>
		<h1>$mysqli->connect_errno example</h1>
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

		$mysqli = @new mysqli($host, 'fake_user', $pwd, DB[2]);

		if ($mysqli->connect_errno){
			die(nodeToDiv('p', 'Connect Error: ' . $mysqli->connect_errno));
		} 
	?>
</html>