<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 5-07</title>
	</head>
	<body>
		<p>
		<h1>mysql_xdevapi\getSession example</h1>
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
			$session = mysql_xdevapi\getSession("mysqlx://$usr:$pwd@$host?ssl-mode=disabled");
		} catch(Exception $e) {
			die(nodeToDiv('pre', "Connection could not be established: " . $e->getMessage()));
		}

		$schemas = $session->getSchemas();
		print_r($schemas);

		$mysql_version = $session->getServerVersion();
		print_r("Server version: " . $mysql_version .BR);

		$schema = $session->getSchema("test_x");
		$collection = $schema->getCollection("example");
		var_dump($collection->find("name = 'Mike'")->execute()->fetchOne());
		
		// $dTbl = ;
		$dStr = ob_get_clean();
		nodeToDiv('pre', $dStr);
		// retTbl($dTbl);
	?>
</html>