<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-23</title>
	</head>
	<body>
		<p>
		<h1>Stored Procedures and Prepared Statements using bind API</h1>
		<hr />
		<div name="retStr"></div>
		<table name="retRes" width="100%"></table>
		<br />
		<?php
			include '../IPI/settings.php';
			include IPI.'IPI Functions.php';

			$mysqli = ConnDb();

			if (!$stmt = $mysqli->prepare("call p()")){
				fPrep($mysqli);
			}

			if (!$stmt->execute()){
				fExec($stmt);
			}

			do {
				$id_out = NULL;
				if (!$stmt->bind_result($id_out)){
					echo fBind($stmt);
				}

				while ($stmt->fetch()){
					ob_start();
					echo "id = $id_out\n";
					sendToDiv('pre', ob_get_clean());
				}
			} while ($stmt->more_results() && $stmt->next_result());
		?>
		<br />
		</p>
		<?php include $tmpl.'get date.php'; ?>
	</body>
</html>