<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 5-104</title>
	</head>
	<body>
		<p>
		<h1>mysql_xdevapi\Schema::getCollectionAsTable example</h1>
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

				$schema = $session->getSchema("addressbook");
				$collect = $schema->createCollection("people");
				$collect->add(
					'{
						"name"	: "Fred",
						"age"	: 21,
						"job"	: "Construction"
					}'
				)->execute();
				$collect->add(
					'{
						"name"	: "Wilma",
						"age"	: 23,
						"job"	: "Teacher"
					}'
				)->execute();

				$table = $schema->getCollectionAsTable("people");
				$collection = $schema->getCollection("people");

				var_dump($table);
				var_dump($collection);

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