<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-44</title>
	</head>
	<body>
		<p>
		<h1>$mysqli->field_count example</h1>
		<h2>Object oriented style</h2>
		<hr />
		<div name="retStr"></div>
		<table name="retRes" width="100%"></table>
		<br />
		<?php 
			include '../IPI/settings.php';
			include IPI.'IPI Functions.php';
			include $tmpl.'get date.php'; 

			ob_start();

			$mysqli = new mysqli($host, $usr, $pwd, DB[2]);

			$mysqli->query("drop table if exists friends");
			$mysqli->query("create table friends(id int, name varchar(20))");

			$mysqli->query("insert into friends values (1, 'Hartmut'), (2, 'Ulf')");

			$mysqli->real_query("select * from friends");

			if ($mysqli->field_count) {
				printf("There are %d fields".NL.BR, $mysqli->field_count);

				/* this was a select/show or describe query */
				$result = $mysqli->store_result();
				print_r($result);

				/*process resultset */
				while ($row = $result->fetch_row()){
					print_r($row);
				}

				/* free resultset */
				$result->close();
			}

			$dTbl = $mysqli->query("select * from friends");

			/* close connection */
			$mysqli->close();

			$dStr = ob_get_clean();
			nodeToDiv('pre', $dStr);
			retTbl($dTbl);
		?>
		</p>
	</body>
</html>