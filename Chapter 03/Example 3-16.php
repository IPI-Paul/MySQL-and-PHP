<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-16</title>
	</head>
	<body>
		<p>
		<h1>Output variable binding</h1>
		<hr />
		<div name="retStr"></div>
		<br />
		<?php
			include '../IPI/settings.php';
			include IPI.'IPI Functions.php';

			$mysqli = new mysqli($host, $usr, $pwd, $db);
			if ($mysqli->connect_errno){
				fConn($mysqli);
			}

			if (!$mysqli->query("drop table if exists test") || 
				!$mysqli->query("create table test(id int, label char(1))") || 
				!$mysqli->query("insert into test(id, label) values (1, 'a')")
				){
				fTbl($mysqli);
			}

			if (!($stmt = $mysqli->prepare("select id, label from test"))){
				fPrep($mysqli);
			}

			if (!$stmt->execute()){
				fExec($mysqli);
			}

			$out_id = NULL;
			$out_label = NULL;
			if (!$stmt->bind_result($out_id, $out_label)){
				fBindOut($stmt);
			}

			while ($stmt->fetch()){
				//printf("id = %s (%s), label = %s (%s)\n", $out_id, gettype($out_id), $out_label, gettype($out_label));
				$dStr = sprintf("id = %s (%s), label = %s (%s)\n", $out_id, gettype($out_id), $out_label, gettype($out_label));
				sendToDiv('pre', $dStr);
			}
		?>
		<br />
		</p>
		<?php include $tmpl.'get date.php'; ?>
	</body>
</html>