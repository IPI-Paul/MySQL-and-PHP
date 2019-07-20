<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 2-5</title>
	</head>
	<body>
		<p>
		<h1>Unbuffered query example: mysql</h1>
		<hr />
		<br />
		<?php
			include '../IPI/settings.php';
			include IPI.'IPI Functions.php';

			$conn = mysql_connect($host, $usr, $pwd);
			$db = mysql_select_db('world');

			$uresult = mysql_unbuffered_query('select Name from City');
			if ($uresult){
				while ($row = mysql_fetch_assoc($uresult)){
					echo $row['Name'] . PHP_EOL . BR;
				}
			}
		?>
		<br />
		</p>
		<?php include $tmpl.'get date.php'; ?>
	</body>
</html>