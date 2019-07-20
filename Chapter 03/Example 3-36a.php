<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-36</title>
	</head>
	<body>
		<p>
		<h1>mysqli::commit example</h1>
		<h2>Procedural style</h2>
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

		$link = mysqli_connect($host, $usr, $pwd, DB[2]);

		/* check connection */
		if (!$link){
			pfConnP();
		}

		/* set autocommit to off */
		mysqli_autocommit($link, false);

		mysqli_query($link, "create table Language like world.CountryLanguage;");

		/* Insert some values */
		mysqli_query($link, "insert into Language values ('DEU', 'Bavarian', 'F', 11.2)");
		mysqli_query($link, "insert into Language values ('DEU', 'Swabian', 'F', 9.4)");

		/* commit transaction */
		if (!mysqli_commit($link)){
			print("transaction commit failed\n".BR);
			exit();
		} else {
			$dTbl = mysqli_query($link, "select * from Language");
		}

		/* drop table */
		mysqli_query($link, "drop table Language");

		/* close connection */
		mysqli_close($link);

		$dStr = ob_get_clean();
		nodeToDiv('p', $dStr);
		retTbl($dTbl);
	?>
</html>