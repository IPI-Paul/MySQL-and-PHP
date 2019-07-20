<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 4-03</title>
	</head>
	<body>
		<p>
		<h1>PDO_MYSQL DSN examples</h1>
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

		$username = $usr;
		$password = $pwd;

		$dsn = 'mysql:host=localhost; port=3306; dbname=test';
		if ($dbh = new PDO($dsn, $username, $password)) {
			echo "Connection Successful!\n";
		} else {
			echo "Connection Failed!";
		}

		$dsn = 'mysql:unix_socket=/tmp/mysql.sock; dbname=test';
		if ($dbh = new PDO($dsn, $username, $password)) {
			echo "Unix Socket Connection Successful!\n";
		} else {
			echo "Unix Socket Connection Failed!";
		}

		// $dTbl = ;
		$dStr = ob_get_clean();
		nodeToDiv('pre', $dStr);
		// retTbl($dTbl);
	?>
</html>