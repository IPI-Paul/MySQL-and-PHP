<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-18</title>
	</head>
	<body>
		<h1>Buffered result set for flexible read out</h1>
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
				!$mysqli->query("create table test(id int, label char(1))") || 
				!$mysqli->query("insert into test(id, label) values (1, 'a'), (2, 'b'), (3, 'c')")
				){
				fTbl($mysqli);	
			}

			if (!($stmt = $mysqli->prepare("select id, label from test"))){
				fPrep($mysqli);
			}

			if (!$stmt->execute()){
				fExec($stmt);
			}

			if (!($res = $stmt->get_result())){
				fGetRs($stmt);
			}

			
			for ($row_no = ($res->num_rows - 1); $row_no >= 0; $row_no--){
				$res->data_seek($row_no);
				/*
				var_dump($res->fetch_assoc());
				or
				not the same result though: sendToDiv('pre', var_export($res->fetch_assoc(), true));
				*/
				ob_start();
				var_dump($res->fetch_assoc());
				$dStr = ob_get_clean();
				sendToDiv('pre', $dStr);
			}
			$res->close();
		?>
		<br />
		<?php include $tmpl.'get date.php'; ?>
	</body>
</html>