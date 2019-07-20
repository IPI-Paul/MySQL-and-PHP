<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 105</title>
	</head>
	<body>
		<p>
		<h1>mysql_xdevapi\Schema::getCollections example</h1>
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

				$collections = $schema->getCollections();
				var_dump($collections);

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