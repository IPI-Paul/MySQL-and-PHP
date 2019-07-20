<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-28</title>
	</head>
	<body>
		<p>
		<h1>Accessing result set meta data</h1>
		<hr />
		<div name="retStr"></div>
		<table name="retRes" width="100%"></table>
		<br />
		<?php
			include '../IPI/settings.php';
			include IPI.'IPI Functions.php';

			$mysqli = new mysqli($host, $usr, $pwd, $db);
			if ($mysqli->connect_errno){
				fConn($mysqli);
			}

			$res = $mysqli->query("select 1 as _one, 'Hello' as _two from dual");
			ob_start();
			var_dump($res->fetch_fields());
			nodeToDiv('pre', ob_get_clean());
		?>
		<br />
		</p>
		<?php include $tmpl.'get date.php'; ?>
	</body>
</html>