<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 2-3</title>
	</head>
	<body>
		<p>
		<h1>Unbuffered query example: mysqli</h1>
		<hr />
		<br />
		<?php
			include '../IPI/settings.php';
			include IPI.'IPI Functions.php';

			$mysqli = new mysqli($host, $usr, $pwd, $db);
			$uresult = $mysqli->query('select Name from City', MYSQLI_USE_RESULT);

			if ($uresult){
				while ($row = $uresult->fetch_assoc()){
					echo $row['Name'] . PHP_EOL . BR;
				}
			}
			$uresult->close();
		?>
		<br />
		</p>
		<?php include $tmpl.'get date.php'; ?>
	</body>
</html>