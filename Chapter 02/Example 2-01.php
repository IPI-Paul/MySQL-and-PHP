<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 2-1</title>
	</head>
	<body>
		<p>
		<h1>Comparing the three MySQL APIs</h1>
		<hr />
		<br />
		<?php 
			include '../IPI/settings.php';
			include IPI.'IPI Functions.php';
			
			// mysqli
			h2('Using mysqli:');
			$mysqli = new mysqli($host, $usr, $pwd, $db);
			$result = $mysqli->query("select 'Hello, dear MySQL user!' as _message from DUAL");
			$row = $result->fetch_assoc();
			echo htmlentities($row['_message']).BR;			

			// PDO
			h2('Using PDO:');
			$pdo = new PDO("mysql:host=$host;dbname=world", $usr, $pwd);
			$statement = $pdo->query("select 'Hello, dear MySQL user!' as _message from DUAL");
			$row = $statement->fetch(PDO::FETCH_ASSOC);
			echo htmlentities($row['_message']).BR;	

			/*
			Deprecated in PHP 7
			// mysql
			$c = mysql_connect("$host", $usr, $pwd);
			$result = mysql_query("select 'Hello, dear MySQL user!' as _message from DUAL");
			$row = mysql_fetch_assoc($result);
			echo htmlentities($row['_message']);
			*/
		?>
		<br />
		</p>
		<?php include $tmpl.'get date.php'; ?>
	</body>
</html>