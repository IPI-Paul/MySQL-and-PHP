<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-63</title>
	</head>
	<body>
		<p>
		<h1>mysqli::rollback example</h1>
		<h2>Object oriented style</h2>
		<hr />
		<div name="retStr"></div>
		<table name="retRes" width="100%"></table>
		<br />
		</p>
	</body>
	<?php 
		include '../IPI/settings.php';
		include IPI.'IPI Functions.php';
		include $tmpl.'get date.php'; 

		ob_start();

		$mysqli = new mysqli($host, $usr, $pwd, $db);

		/* check connection */
		if (mysqli_connect_errno()){
			pfConP();
		}

		chkAutoCommit($mysqli);

		/* disable autocommit */
		$mysqli->autocommit(false);

		$mysqli->query("Create table myCity like City");
		$mysqli->query("Alter table myCity type=InnoDB");
		$mysqli->query("insert into myCity select * from City limit 50");

		/* commit insert */
		$mysqli->commit();

		$dTbl = $mysqli->query("select * from myCity");

		/* delete all rows */
		$mysqli->query("delete from myCity");

		if ($result=$mysqli->query("select count(*) from myCity")){
			$row = $result->fetch_row();
			printf("%d rows in table myCity.\n".BR, $row[0]);
			/* Free result */
			$result->close();
		}

		/* Rollback */
		$mysqli->rollback();

		if ($result=$mysqli->query("select count(*) from myCity")){
			$row = $result->fetch_row();
			printf("%d rows in table myCity (after rollback).\n", $row[0]);
			/* Free result */
			$result->close();
		}

		/* Drop table myCity */
		$mysqli->query("drop table myCity");

		$mysqli->close();

		$dStr = ob_get_clean();
		nodeToDiv('p', $dStr);
		retTbl($dTbl);
	?>
</html>