<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 2-6</title>
	</head>
	<body>
		<p>
		<h1>Problems with setting the character set with SQL</h1>
		<hr />
		<br />
		<?php
			include '../IPI/settings.php';
			include IPI.'IPI Functions.php';

			function selRows($x, $y, $mysqli){
				$uresult = $mysqli->query('select Name from City', MYSQLI_USE_RESULT);

				if ($uresult){
					$i = 0;
					while ($row = $uresult->fetch_assoc()){
						if ($i >=$x and $i <= $y){
							echo $row['Name'] . PHP_EOL . BR;
						}
						$i++;
					}
				}
				// $uresult->close();	
			echo BR.BR;
			}

			$mysqli = new mysqli($host, $usr, $pwd, 'world');

			// WILL NOT affect $mysqli->real_escape_string();
			$mysqli->query('set NAMES utf8');
			selRows(35, 40, $mysqli);

			// WILL NOT affect $msqli->real_escape_string();
			$mysqli->query('set CHARACTER SET utf8');
			selRows(35, 40, $mysqli);

			// But, this will affect $mysqli->real_escape_string();
			$mysqli->set_charset('utf8');
			selRows(35, 40, $mysqli);

			// But, this will NOT affect it (utf-8 vs utf8) -- don't use dashes here
			$mysqli->set_charset('utf-8');			
			selRows(35, 40, $mysqli);
		?>
		<br />
		</p>
		<?php include $tmpl.'get date.php'; ?>
	</body>
</html>