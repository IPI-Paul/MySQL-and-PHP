<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-12</title>
	</head>
	<body>
		<p>
		<h1>Prepared Statements - Second stage: bind and execute</h1>
		<hr />
		<table name="retRes" width="100%"></table>
		<br />
		<?php
			include 'Example 3-11.php';

			/*Prepared statement, stage 2: bind ad execute */
			$id = 1;
			if (!$stmt->bind_param("i", $id)){
				fBind($stmt);
			}

			if (!$stmt->execute()){
				fExec($stmt);
			} else {
				retTbl($mysqli->query('select * from test'));
			}
		?>
		<br />
		</p>
		<?php include $tmpl.'get date.php'; ?>
	</body>
</html>