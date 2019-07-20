<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 4-01</title>
	</head>
	<body>
		<p>
		<h1>Forcing queries to be buffered in mysql</h1>
		<h2></h2>
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

		$dsn = 'mysql:host=localhost;dbname=test';

		try {
			$db = new PDO($dsn, $usr, $pwd);
		} catch (exception $e) {
			die(nodeToDiv('pre', str_replace(" in ", "\nin:\n", $e)));
		}

		if ($db->getAttribute(PDO::ATTR_DRIVER_NAME) == 'mysql') {
			$stmt = $db->prepare('select * from foo',
			array(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true));
			$stmt->execute();
			echo var_dump($stmt->fetchAll());
		} else {
			die(nodeToDiv('pre', "my application only works with mysql; I shoul use \$stm->fetchAl()"));
		}

		// $dTbl = ;
		$dStr = ob_get_clean();
		nodeToDiv('pre', $dStr);
		// retTbl($dTbl);
	?>
</html>