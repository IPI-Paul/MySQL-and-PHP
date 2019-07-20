<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-34</title>
	</head>
	<body>
		<p>
		<h1>mysqli::change_user example</h1>
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

		/* connect database test */
		$link = mysqli_connect($host, $usr, $pwd, DB[2]);

		/* check connection */
		if (!$link){
			pfConnP();
		}

		/* Set variable a */
		mysqli_query($link, "set @a:=1");

		/* reset all and select a new database */
		mysqli_change_user($link, $usr, $pwd, $db);

		if ($result = mysqli_query($link, "select database()")){
			$row = mysqli_fetch_row($result);
			printf("Default database: %s\n".BR, $row[0]);
			mysqli_free_result($result);
		}

		if ($result = mysqli_query($link, "select @a")){
			$row = mysqli_fetch_row($result);
			if ($row[0] === NULL){
				printf("Value of variable a is NULL\n".BR);
			}
			mysqli_free_result($result);
		}

		/* close connection */
		mysqli_close($link);

		// $dTbl = ;
		$dStr = ob_get_clean();
		nodeToDiv('p', $dStr);
		// retTbl($dTbl);
	?>
</html>