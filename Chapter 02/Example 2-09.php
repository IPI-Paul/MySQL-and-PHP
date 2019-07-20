<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 2-9</title>
	</head>
	<body>
		<p>
		<h1>Setting the character set example: mysql</h1>
		<hr />
		<br />
		<?php
			include '../IPI/settings.php';
			include IPI.'IPI Functions.php';

			$conn = mysql_connect($host, $usr, $pwd);
			$db = mysql_select_db('world');

			echo 'Initial charset: ' . mysql_client_encoding($conn) .'\n' . BR;

			if (!mysql_set_charset('utf8', $conn)){
				echo 'Error: Unable to set the character set.\n' . BR;
				exit;
			}

			echo 'Your current character set is: ' . mysql_client_encoding($conn);
		?>
		<br />
		</p>
		<?php include $tmpl.'get date.php'; ?>
	</body>
</html>