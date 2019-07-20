<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-34</title>
	</head>
	<body>
		<p>
		<h1>mysqli::change_user example</h1>
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

		/* connect database test */
		$mysqli = new mysqli($host, $usr, $pwd, DB[2]);
			
		/* check connection */
		if (mysqli_connect_errno()){
			pfConnO($mysqli);
		}

		/* Set variable a */
		$mysqli->query("set @a:=1");

		/* reset all and select a new database */
		$mysqli->change_user($usr, $pwd, $db);

		if ($result = $mysqli->query("select database()")){
			$row = $result->fetch_row();
			printf("Default database: %s\n".BR, $row[0]);
			$result->close();
		}

		if ($result = $mysqli->query("select @a")){
			$row = $result->fetch_row();
			if ($row[0] === NULL){
				printf("Value of variable a is NULL\n".BR);
			}
			$result->close();
		}

		/* close connection */
		$mysqli->close();

		// $dTbl = ;
		$dStr = ob_get_clean();
		nodeToDiv('p', $dStr);
		// retTbl($dTbl);
	?>
</html>