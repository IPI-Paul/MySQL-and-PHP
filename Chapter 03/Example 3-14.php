<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-14</title>
	</head>
	<body>
		<p>
		<h1>Less round trips using multi-INSERT SQL</h1>
		<hr />
		<table name="retRes" width="100%"></table>
		<br />
		<?php
			include '../IPI/settings.php';
			include IPI.'IPI Functions.php';

			$mysqli = connDb();
			tblCreate($mysqli, 'test', 'id int');
			if (!$mysqli->query('insert into test(id) values (1), (2), (3), (4)')){
				fMultIns($mysqli);
			}
			retTbl($mysqli->query("select * from test"));
		?>
		<br />
		</p>
		<?php include $tmpl.'get date.php'; ?>
	</body>
</html>