<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-24</title>
	</head>
	<body>
		<p>
		<h1>Multiple Statements</h1>
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

			if (!$mysqli->query("drop table if exists test") || 
				!$mysqli->query("create table test (id int)")
				){
				fTbl($mysqli);
			}

			$sql = "select count(*) as _num from test; ";
			$sql .= "insert into test(id) values (1); ";
			$sql .= "select count(*) as _num from test; ";

			if (!$mysqli->multi_query($sql)){
				fMulti($mysqli);
			}

			do {
				if ($res = $mysqli->store_result()){
					ob_start();
					var_dump($res->fetch_all(MYSQLI_ASSOC));
					$res->free();
					sendToDiv('pre', ob_get_clean());
				}
			} while ($mysqli->more_results() && $mysqli->next_result());
		?>
		<br />
		</p>
		<?php include $tmpl.'get date.php'; ?>
	</body>
</html>