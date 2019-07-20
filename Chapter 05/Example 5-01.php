<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 5-01</title>
	</head>
	<body>
		<p>
		<h1>Connection to a MySQL Server</h1>
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
			$session = mysql_xdevapi\getSession("mysqlx://$usr:$pwd@$host:33060?connect-timeout=5000&ssl-mode=disabled");
			echo "Connection Successfull";
		} catch (Exception $e) {
			die(nodeToDiv('pre', "Connection could not be established: " . $e->getMessage()));
		}

		// ... use $session

		// $dTbl = ;
		$dStr = ob_get_clean();
		nodeToDiv('p', $dStr);
		// retTbl($dTbl);
	?>
</html>