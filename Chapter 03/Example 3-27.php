<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-27</title>
	</head>
	<body>
		<p>
		<h1>Commit and rollback</h1>
		<hr />
		<div name="retStr"></div>
		<table name="retRes" width="100%"></table>
		<br />
		<?php
			include '../IPI/settings.php';
			include IPI.'IPI Functions.php';

			$mysqli = new mysqli($host, $usr, $pwd, $db);
			$mysqli->autocommit(false);

			$mysqli->query("insert into test(id) values(1)");
			nodeToDiv('p', 'Before Rollback:<br />'.retTbls($mysqli->query("select * from test")));
			$mysqli->rollback();
			nodeToDiv('p', 'After Rollback:<br />'.retTbls($mysqli->query("select * from test")));

			$mysqli->query("insert into test(id) values (2)");
			$mysqli->commit();
			nodeToDiv('p', 'After Commit:<br />'.retTbls($mysqli->query("select * from test")));
		?>
		<br />
		</p>
		<?php include $tmpl.'get date.php'; ?>
	</body>
</html>