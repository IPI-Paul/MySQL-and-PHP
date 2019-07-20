<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 5-04</title>
	</head>
	<body>
		<p>
		<h1>Fetching and Iterating Multiple Documents</h1>
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
		$collection = $schema->getCollection("example");

		$result = $collection->find()->execute();
		foreach ($result as $doc) {
			echo "${doc["name"]} is a ${doc["job"]}.\n";
		}

		// $dTbl = ;
		$dStr = ob_get_clean();
		nodeToDiv('pre', $dStr);
		// retTbl($dTbl);
	?>
</html>