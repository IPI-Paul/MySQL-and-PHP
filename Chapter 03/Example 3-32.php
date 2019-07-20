<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-32</title>
		<?php
			include '../IPI/settings.php';
			include IPI.'IPI Functions.php';

			ob_start();

			$mysqli = new mysqli($host, $usr, $pwd, $db);

			if (mysqli_connect_errno()){
				printf("Connect failed: %s\n".BR, mysqli_connect_error());
				exit();
			}

			/* turn autocommit on */
			$mysqli->autocommit(true);

			if ($result = $mysqli->query("select @@autocommit")){
				$row = $result->fetch_row();
				printf("Autocommit is %s\n".BR, $row[0]);
				$result->free();
			}

			/* close connection */
			$mysqli->close();

			// $dTbl = ;
			$dStr = ob_get_clean();
		?>
	</head>
	<body>
		<p>
		<h1>mysqli::autocommit example</h1>
		<h2>Object oriented style</h2>
		<hr />
		<div name="retStr"></div>
		<table name="retRes" width="100%"></table>
		<br />
		<?php 
			nodeToDiv('p', $dStr);
			// retTbl($dTbl);

			include $tmpl.'get date.php'; 
		?>
		</p>
	</body>
</html>