<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 5-179</title>
	</head>
	<body>
		<p>
		<h1>mysql_xdevapi\TableSelect::having example</h1>
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

				$session->sql("drop database if exists addressbook")->execute();
				$session->sql("create database addressbook")->execute();
				$session->sql("create table addressbook.names(name text, age int)")->execute();
				$session->sql("insert into addressbook.names values ('John', 42), ('Sam', 42)")->execute();
				$session->sql("insert into addressbook.names values ('Suki', 31)")->execute();

				$schema = $session->getSchema("addressbook");
				$table = $schema->getTable("names");

				$result = $table
				->select('count(*) as count', 'age')
				->groupBy('age')
				->orderBy('age asc')
				->having('count > 1')
				->execute();

				$row = $result->fetchAll();
				print_r($row);

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