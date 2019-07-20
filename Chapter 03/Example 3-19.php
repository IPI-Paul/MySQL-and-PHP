<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-19</title>
	</head>
	<body>
		<p>
		<h1>Calling a stored procedure</h1>
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
				!$mysqli->query("create table test(id int)")
				){
				fTbl($mysqli);
			}

			if (!$mysqli->query("drop procedure if exists p") || 
				!$mysqli->query("create procedure p(in id_val int) begin insert into test(id) values(id_val); end;")
				){
				fSProc($mysqli);
			}

			if (!$mysqli->query("call p(1)")){
				fCall($mysqli);
			}

			if(!($res = $mysqli->query("select id from test"))){
				fSel($mysqli);
			}

			ob_start();
			var_dump($res->fetch_assoc());
			$dStr = ob_get_clean();
			sendToDiv('pre', $dStr);
		?>
		<br />
		</p>
		<?php include $tmpl.'get date.php'; ?>
	</body>
</html>