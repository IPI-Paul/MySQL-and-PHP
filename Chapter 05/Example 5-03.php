<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 5-03</title>
	</head>
	<body>
		<p>
		<h1>Storing and Retrieving Data</h1>
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

		$marco = [
			"name"	=> "Marco",
			"age"	=> 19,
			"job"	=> "Programmer"
		];
		$mike = [
			"name"	=> "Mike",
			"age"	=> 39,
			"job"	=> "Manager"
		];

		$schema = $session->getSchema("test_x");
		$collection = $schema->getCollection("example");

		$collection->add($marco, $mike)->execute();

		var_dump($collection->find("name = 'Mike'")->execute()->fetchOne());

		// $dTbl = ;
		$dStr = ob_get_clean();
		nodeToDiv('pre', $dStr);
		// retTbl($dTbl);
	?>
</html>