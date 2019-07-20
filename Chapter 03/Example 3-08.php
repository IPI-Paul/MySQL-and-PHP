<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-8</title>
	</head>
	<body>
		<p>
		<h1>Navigation through unbuffered results</h1>
		<hr />
		<br />
		<?php
			include '../IPI/settings.php';
			include IPI.'IPI Functions.php';

			$mysqli = connDb();
			$mysqli->real_query('select id from test order by id asc');
			$res = $mysqli->use_result();

			echo "Result set order...\n" . BR;
			while ($row = $res->fetch_assoc()){
				echo ' id = ' . $row['id'] . "\n" .BR;
			}
		?>
		<br />
		</p>
		<?php include $tmpl.'get date.php'; ?>
	</body>
</html>