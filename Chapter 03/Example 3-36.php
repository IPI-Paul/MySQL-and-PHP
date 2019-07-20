<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-36</title>
	</head>
	<body>
		<p>
		<h1>mysqli::commit example</h1>
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

		$mysqli = new mysqli($host, $usr, $pwd, $db);

		/* check connection */
		if (mysqli_connect_errno()){
			pfConnP();
		}

		$mysqli->query("create table Language like CountryLanguage");

		/* set autocommit to off */
		$mysqli->autocommit(false);

		/* Insert some values */
		$mysqli->query("insert into Language values ('DEU', 'Bavarian', 'F', 11.2)");
		$mysqli->query("insert into Language values ('DEU', 'Swabian', 'F', 9.4)");

		/* commit transaction */
		if (!$mysqli->commit()){
			print("Transaction commit failed\n".BR);
			exit();
		} else{
			$dTbl = $mysqli->query("select * from Language");
		}

		/* drop table */
		$mysqli->query("drop table Language");

		/* close connection */
		$mysqli->close();

		$dStr = ob_get_clean();
		nodeToDiv('p', $dStr);
		retTbl($dTbl);
	?>
</html>