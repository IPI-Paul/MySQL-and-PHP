<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-22</title>
	</head>
	<body>
		<p>
		<h1>Stored Procedures and Prepared Statements</h1>
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
				!$mysqli->query("create table test(id int)") || 
				!$mysqli->query("insert into test(id) values (1), (2), (3)")
				){
				fTbl($mysqli);	
			}

			if (!$mysqli->query("drop procedure if exists p") || 
				!$mysqli->query("create procedure p() reads sql data begin select id from test; select id + 1 from test; end;")
				){
				fSProc($mysqli);
			}

			if (!($stmt = $mysqli->prepare("call p()"))){
				fPrep($mysqli);
			}

			if (!$stmt->execute()){
				fExec($mysqli);
			}

			do {
				if ($res = $stmt->get_result()){
					ob_start();
					printf("---\n");
					var_dump(mysqli_fetch_all($res));
					mysqli_free_result($res);
					$dStr = ob_get_clean();
					sendToDiv('pre', $dStr);
				} else {
					if ($stmt->errno){
						fStor($stmt);
					}
				}
			} while ($stmt->more_results() && $stmt->next_result());
		?>
		<br />
		</p>
		<?php include $tmpl.'get date.php'; ?>
	</body>
</html>