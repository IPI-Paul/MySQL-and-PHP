<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 5-162</title>
	</head>
	<body>
		<p>
		<h1>mysql_xdevapi\Table::isView example</h1>
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
				$session->sql("insert into addressbook.names values ('John', 42), ('Sam', 33)")->execute();

				$schema = $session->getSchema("addressbook");
				$table = $schema->getTable("names");

				if ($table->isView()) {
					echo "This is a view.";
				} else {
					echo "This is not a view.";
				}

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