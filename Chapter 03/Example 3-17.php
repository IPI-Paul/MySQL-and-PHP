<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-17</title>
	</head>
	<body>
		<p>
		<h1>Using mysqli_result to fetch results</h1>
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

			if(!$mysqli->query("drop table if exists test") || 
				!$mysqli->query("create table test(id int, label char(1))") || 
				!$mysqli->query("insert into test(id, label) values (1, 'a')")
				){
				fTbl($mysqli);
			}

			if (!($stmt = $mysqli->prepare("select id, label from test order by id asc"))){
				fPrep($mysqli);
			}

			if (!$stmt->execute()){
				fExec($stmt);
			}

			if (!($res = $stmt->get_result())){
				fGetRs($stmt);
			}

			ob_start();
			var_dump($res->fetch_all());
			$dStr = ob_get_clean();
			sendToDiv('pre', $dStr);
		?>
		<br />
		</p>
		<?php include $tmpl.'get date.php'; ?>
	</body>
</html>