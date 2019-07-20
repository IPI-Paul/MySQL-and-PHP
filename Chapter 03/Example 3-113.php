<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-113</title>
	</head>
	<body>
		<p>
		<h1>mysqli_result example</h1>
		<h2>comparing iterator usage</h2>
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

		$c = mysqli_connect($host, $usr, $pwd);

		// Using iterators (support was added with PHP 5.4)
		foreach ($c->query('select user, host from mysql.user') as $row) {
			printf("'%s'@'%s'\n", $row['user'], $row['host']);
		}

		echo "\n===================\n";

		// Not using iterators
		$result = $c->query('select user, host from mysql.user');
		while ($row = $result->fetch_assoc()) {
			printf("'%s'@'%s'\n", $row['user'], $row['host']);
		}

		// $dTbl = ;
		$dStr = ob_get_clean();
		nodeToDiv('pre', $dStr);
		// retTbl($dTbl);
	?>
</html>