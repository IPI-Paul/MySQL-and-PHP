<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-98</title>
	</head>
	<body>
		<p>
		<h1>mysqli_stmt::result_metadata example</h1>
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

		$mysqli = new mysqli($host, $usr, $pwd, DB[2]);

		$mysqli->query("drop table if exists friends");
		$mysqli->query("create table friends (id int, name varchar(20))");

		$mysqli->query("insert into friends values (1, 'Hartmut'), (2, 'Ulf')");

		$stmt = $mysqli->prepare("select id, name from friends");
		$stmt->execute();

		/* get resultset for metadata */
		$result = $stmt->result_metadata();

		/* retrieve field information from metadata result set */
		$field = $result->fetch_field();

		printf("Fieldname: %s\n".BR, $field->name);

		/* close resultset */
		$result->close();

		/* close connection */
		$mysqli->close();

		// $dTbl = ;
		$dStr = ob_get_clean();
		nodeToDiv('p', $dStr);
		// retTbl($dTbl);
	?>
</html>