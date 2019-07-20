<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-20</title>
	</head>
	<body>
		<p>
		<h1>Using session variables</h1>
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

			if (!$mysqli->query("drop procedure if exists p") || 
				!$mysqli->query('create procedure p(out msg varchar(50)) begin select "Hi!" into msg; end;')
				){
				fSProc($mysqli);	
			}

			if (!$mysqli->query("set @msg = ''") || 
				!$mysqli->query("call p(@msg)")
				){
				fCall($mysqli);
			}

			if (!($res = $mysqli->query("select @msg as _p_out"))){
				fFecth($mysqli);
			}

			$row = $res->fetch_assoc();
			//echo $row['_p_out'];
			sendToDiv('p', $row['_p_out']);
		?>
		<br />
		</p>
		<?php include $tmpl.'get date.php'; ?>
	</body>
</html>