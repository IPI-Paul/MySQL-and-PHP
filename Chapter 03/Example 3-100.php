<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-100</title>
	</head>
	<body>
		<p>
		<h1>mysqli_stmt::send_long_data, mysqli_stmt_send_long_data example</h1>
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
		$mysqli->query("create temporary table messages (message nvarchar(255))");

		$stmt = $mysqli->prepare("insert into messages (message) values (?)");
		$null = NULL;
		$stmt->bind_param("b", $null);
		$fp = fopen("../Source Files/txt/ch03ex3-100_messages.txt", "r");
		while (!feof($fp)) {
			$stmt->send_long_data(0, fread($fp, 8192));
		}
		fclose($fp);
		$stmt->execute();

		echo $mysqli->query("select message from messages")->fetch_row()[0];

		$mysqli->close();
		// $dTbl = ;
		$dStr = ob_get_clean();
		nodeToDiv('pre', $dStr);
		// retTbl($dTbl);
	?>
</html>