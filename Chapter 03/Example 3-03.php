<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-3</title>
	</head>
	<body>
		<p>
		<h1>Bad coding style</h1>
		<hr />
		<br />
		<?php
			include '../IPI/settings.php';
			include IPI.'IPI Functions.php';

			$mysqli = new mysqli($host, $usr, $pwd, $db);
			if ($mysqli->connect_errno){
				echo 'Failed to connect to MySQL: ' . $mysqli->connect_error;
			}

			$res = mysqli_query($mysqli, "select 'Possible but bad style.' as _msg from dual");
			if (!$res){
				echo 'Failed to run query: (' .$mysqli->errno . ') ' . $mysqli->error;
			}

			if ($row = $res->fetch_assoc()){
				echo $row['_msg'].BR;
			}
		?>
		<br />
		</p>
		<?php include $tmpl.'get date.php'; ?>
	</body>
</html>