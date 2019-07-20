<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-63</title>
	</head>
	<body>
		<p>
		<h1>mysqli::rollback example</h1>
		<h2>Procedural style</h2>
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

		$link = mysqli_connect($host, $usr, $pwd, $db);

		/* check connection */
		if (mysqli_connect_errno()){
			pfConnp();
		}

		/* disable autocommit */
		mysqli_autocommit($link, false);

		mysqli_query($link, "create table myCity like city");
		mysqli_query($link, "alter table myCity Type=InnoDB");
		mysqli_query($link, "insert into myCity select * from City limit 50");

		/* commit insert */
		mysqli_commit($link);

		$dTbl = mysqli_query($link, "select * from myCity");
			
		/* delete all rows */
		mysqli_query($link, "delete from myCity");

		if ($result = mysqli_query($link, "select count(*) from myCity")){
			$row = mysqli_fetch_row($result);
			printf("%d rows in table myCity.\n".BR, $row[0]);
			/* Free result */
			mysqli_free_result($result);
		}

		/* Rollback */
		mysqli_rollback($link);

		if ($result = mysqli_query($link, "select count(*) from myCity")){
			$row = mysqli_fetch_row($result);
			printf("%d rows in table myCity (after rollback).\n".BR, $row[0]);
			/* Free result */
			mysqli_free_result($result);
		}

		/* Drop table myCity */
		mysqli_query($link, "drop table myCity");

		mysqli_close($link);

		$dStr = ob_get_clean();
		nodeToDiv('p', $dStr);
		retTbl($dTbl);
	?>
</html>