<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-29</title>
	</head>
	<body>
		<p>
		<h1>Prepared statements metadata</h1>
		<hr />
		<div name="retStr"></div>
		<table name="retRes" width="100%"></table>
		<br />
		<?php
			include '../IPI/settings.php';
			include IPI.'IPI Functions.php';

			$mysqli = ConnDb();

			$stmt = $mysqli->prepare("select 1 as _one, 'Hello' as _two from dual");
			$stmt->execute();
			$res = $stmt->result_metadata();
			ob_start();
			var_dump($res->fetch_fields());
			nodeToDiv('pre', ob_get_clean());
		?>
		<br />
		</p>
		<?php include $tmpl.'get date.php'; ?>
	</body>
</html>