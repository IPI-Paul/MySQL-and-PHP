<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 2-4</title>
	</head>
	<body>
		<p>
		<h1>Unbuffered query example: pdo_mysql</h1>
		<hr />
		<br />
		<?php
			include '../IPI/settings.php';
			include IPI.'IPI Functions.php';

			$pdo = new PDO("mysql:host=$host;dbname=world", $usr, $pwd);
			$pdo->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, false);

			$uresult = $pdo->query('select Name from City');
			if ($uresult){
				while ($row = $uresult->fetch(PDO::FETCH_ASSOC)){
					echo $row['Name'] . PHP_EOL . BR;
				}
			}
		?>
		<br />
		</p>
		<?php include $tmpl.'get date.php'; ?>
	</body>
</html>