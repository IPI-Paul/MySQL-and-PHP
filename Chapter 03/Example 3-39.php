<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-39</title>
	</head>
	<body>
		<p>
		<h1>mysqli::__construct example</h1>
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

		$mysqli = new mysqli($host, $usr, $pwd, DB[2]);

		ob_start();
		/*
		This is the "official" OO way to do it,
		BUT $connect_error was broken until PHP 5.2.9 and 5.3.0
		*/
		if ($mysqli->connect_error) {
			die(nodeToDiv('p', dConnO($mysqli)));
		}

		/*
		Use this instead of $connect_error if you need to ensure 
		compatibility with PHP versions prior to 5.2.9 and 5.3.0
		*/
		if (mysqli_connect_error()){
			die(nodeToDiv('p', dConnP()));
		}

		echo 'Success... MYSQL host info: ' . $mysqli->host_info . NL;

		$mysqli->close();

		nodeToDiv('p', ob_get_clean());
	?>
</html>