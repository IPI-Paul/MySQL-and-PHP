<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-45</title>
	</head>
	<body>
		<p>
		<h1>mysqli::get_charset example</h1>
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

		$db = mysqli_init();
		$db->real_connect($host, $usr, $pwd, DB[2]);
		var_dump($db->get_charset());

		// $dTbl = ;
		$dStr = ob_get_clean();
		nodeToDiv('pre', $dStr);
		// retTbl($dTbl);
	?>
</html>