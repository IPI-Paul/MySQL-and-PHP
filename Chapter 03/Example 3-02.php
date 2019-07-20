<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-2</title>
	</head>
	<body>
		<p>
		<h1>Object -oriented and procedual interface</h1>
		<hr />
		<br />
		<?php
			include '../IPI/settings.php';
			include IPI.'IPI Functions.php';

			$mysqli = mysqli_connect($host, $usr, $pwd, $db);
			if (mysqli_connect_errno($mysqli)){
				echo 'Failed to connect to MySQL: ' . mysqli_connect_error() . BR;
			}
			$res = mysqli_query($mysqli, "select 'A world full of ' as _msg from dual");
			$row = mysqli_fetch_assoc($res);
			echo $row['_msg'];

			$mysqli = new mysqli($host, $usr, $pwd, $db);
			if ($mysqli->connect_errno){
				echo 'Failed to connect to MySQL: ' . $mysqli->connect_error . BR;
			}

			$res = $mysqli->query("select 'choices to please everybody.' as _msg from dual");
			$row = $res->fetch_assoc();
			echo $row['_msg'].BR;
		?>
		<br />
		</p>
		<?php include $tmpl.'get date.php'; ?>
	</body>
</html>