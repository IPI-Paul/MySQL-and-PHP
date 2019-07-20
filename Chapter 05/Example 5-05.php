<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 5-05</title>
	</head>
	<body>
		<p>
		<h1>mysql_xdevapi\Expression example</h1>
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

		try {
			$session = mysql_xdevapi\getSession("mysqlx://$usr:$pwd@$host:33060?ssl-mode=disabled");
		} catch (Exception $e) {
			die(nodeToDiv('pre', "Connection could not be established: " . $e->getMessage()));
		}

		$schema = $session->getSchema("test_x");
		$coll = $schema->getCollection("example");

		$expression = mysql_xdevapi\Expression("[age, job]");

		$res = $coll->find("age > 30")->fields($expression)->limit(3)->execute();
		$data = $res->fetchAll();
		print_r($data);

		// $dTbl = ;
		$dStr = ob_get_clean();
		nodeToDiv('pre', $dStr);
		// retTbl($dTbl);
	?>
</html>