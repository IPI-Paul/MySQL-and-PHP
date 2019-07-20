<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-26</title>
	</head>
	<body>
		<p>
		<h1>Setting auto commit mode with SQL and through the API</h1>
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

			/* Recommended: using API to control transactional settings */
			$mysqli->autocommit(false);

			/* Won't be monitored and recognized by the replication and the load balancing plugin */
			if(!$mysqli->query("set autocommit = 0")){
				fQuery($mysqli);
			} else {		
				sendToDiv('pre', 'Successfully set Auto Commit to OFF...!');
			}
		?>
		<br />
		</p>
		<?php include $tmpl.'get date.php'; ?>
	</body>
</html>