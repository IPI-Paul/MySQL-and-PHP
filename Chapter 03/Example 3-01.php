<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-1</title>
	</head>
	<body>
		<p>
		<h1>Easy migration from the old mysql extension</h1>
		<hr />
		<br />
		<?php
			include '../IPI/settings.php';
			include IPI.'IPI Functions.php';

			$mysqli = mysqli_connect($host, $usr, $pwd, 'world');
			$res = mysqli_query($mysqli, "select 'Please, do not use ' as _msg from DUAL");
			$row = mysqli_fetch_assoc($res);
			echo $row['_msg'].BR;

			include $tmpl.'get date.php'; 

			$mysql = mysql_connect($host, $usr, $pwd);
			mysql_select_db("test");
			$res = mysql_query("select 'the mysql extension for new developments.' as _msg from DUAL", $mysql);
			$row = mysql_fetch_assoc($res);
			echo $row['_msg'].BR;
		?>
		<br />
		</p>
	</body>
</html>