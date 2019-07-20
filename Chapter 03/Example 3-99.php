<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-99</title>
	</head>
	<body>
		<p>
		<h1>mysqli_stmt_result_metadata example</h1>
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

		mysqli_query($link, "drop table if exists friends");
		mysqli_query($link, "create table friends (id int, name nvarchar(20))");

		mysqli_query($link, "insert into friends values (1, 'Harmut), (2, 'Ulf')");

		$stmt = mysqli_prepare($link, "select id, name from friends");
		mysqli_stmt_execute($stmt);

		/* get resultset for metadata */
		$result = mysqli_stmt_result_metadata($stmt);

		/* retrieve field information from metadata result set */
		$field = mysqli_fetch_field($result);

		printf("Fieldname: %s\n".BR, $field->name);

		/* close resultset */
		mysqli_free_result($result);

		/* close connection */
		mysqli_close($link);

		// $dTbl = ;
		$dStr = ob_get_clean();
		nodeToDiv('p', $dStr);
		// retTbl($dTbl);
	?>
</html>