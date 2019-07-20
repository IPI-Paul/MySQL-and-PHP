<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-53</title>
	</head>
	<body>
		<p>
		<h1>$mysqli->info example</h1>
		<h2>Obect oriented style</h2>
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

		$mysqli = new mysqli($host, $usr, $pwd, $db);
			
		/* check connection */
		if (mysqli_connect_errno()){
			pfConnP();
		}

		if (!$mysqli->query("create temporary table t1 like City")){
			fTbl($mysqli);
		}

		/* insert into .. select */
		if (!$mysqli->query("insert into t1 select * from City order by ID limit 150")){
			print("Failed to insert records");
		}
		printf("%s\n", $mysqli->info);

		/* close connection */
		$mysqli->close();

		// $dTbl = ;
		$dStr = ob_get_clean();
		nodeToDiv('p', $dStr);
		// retTbl($dTbl);
	?>
</html>