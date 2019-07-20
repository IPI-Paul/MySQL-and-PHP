<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-7</title>
	</head>
	<body>
		<p>
		<h1>Navigation through buffered results</h1>
		<hr />
		<table name="retRes" width="100%"></table>
		<br />
		<?php
			include '../IPI/settings.php';
			include IPI.'IPI Functions.php';


			$mysqli = new mysqli($host, $usr, $pwd, $db);
			if ($mysqli->connect_errno){
				fConn($mysqli);
			}

			if (!$mysqli->query('drop table if exists test') ||
				!$mysqli->query('create table test(id int)') ||
				!$mysqli->query('insert into test(id) values (1), (2), (3)')
				){
					fConn($mysqli);
			} else {
				retTbl($mysqli->query('select * from test'));
			}

			$res = $mysqli->query('select id from test order by id asc');

			echo "Reverse order...\n" . BR;
			for ($row_no = $res->num_rows -1; $row_no >= 0; $row_no--) {
				$res->data_seek($row_no);
				$row = $res->fetch_assoc();
				echo "id = " .$row['id'] . "\n" . BR;
			}

			echo "Result set order...\n" . BR;
			$res->data_seek(0);
			while ($row = $res->fetch_assoc()){
				echo "id = " .$row['id'] . "\n" . BR;
			}
		?>
		<br />
		</p>
		<?php include $tmpl.'get date.php'; ?>
	</body>
</html>