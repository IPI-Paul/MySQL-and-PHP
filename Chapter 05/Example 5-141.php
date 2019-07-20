<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 5-141</title>
	</head>
	<body>
		<p>
		<h1>mysql_xdevapi\SqlStatementResult::getColumnsCount example</h1>
		<h2></h2>
		<hr />
		<div name="retStr">
			<?php 
				include '../IPI/settings.php';
				include IPI.'IPI Functions.php';
				function footer($tmpl) {
					echo "</pre>";
					include $tmpl.'get date.php'; 	
				}
				echo "<pre>";

				$session = mysql_xdevapi\getSession("mysqlx://$usr:$pwd@$host?ssl-mode=disabled");
				$session->sql("drop database if exists dbtest")->execute();
				$session->sql("create database dbtest")->execute();
				$session->sql("create table dbtest.workers(name text, age int, job text)")->execute();
				$session->sql("insert into dbtest.workers values ('John', 42, 'bricklayer'), ('Sam', 33, 'carpenter')")->execute();

				$schema = $session->getSchema("dbtest");
				$table = $schema->getTable("workers");

				$cols = $session->sql("select * from dbtest.workers")->execute()->getColumnsCount();

				print_r("There are " . $cols . " columns!");

				$session->close();
				echo "</pre>";
			?>
		</div>
		<table name="retRes" width="100%"></table>
		<br />
		</p>
	</body>
	<?php 
		footer($tmpl); 
	?>
</html>