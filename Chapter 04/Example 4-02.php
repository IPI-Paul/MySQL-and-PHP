<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 4-02</title>
	</head>
	<body>
		<p>
		<h1>Setting the connection character set to UTF-8 prior to PHP 5.3.6</h1>
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

		$dsn = 'mysql:host=localhost; dbname=test';
		$username = $usr;
		$password = $pwd;
		$options = array(
			PDO::MYSQL_ATTR_INIT_COMMAND => 'set names utf8',
		);

		if ($dbh = new PDO($dsn, $username, $password, $options)) {
			echo "Connection Successful!";
		}

		// $dTbl = ;
		$dStr = ob_get_clean();
		nodeToDiv('p', $dStr);
		// retTbl($dTbl);
	?>
</html>