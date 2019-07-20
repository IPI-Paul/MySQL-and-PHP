<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 5-102</title>
	</head>
	<body>
		<p>
		<h1>mysql_xdevapi\Schema::existsInDatabase example</h1>
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

				$session->sql("drop database if exists food")->execute();
				$session->sql("create database food")->execute();
				$session->sql("create table food.fruit(name text, rating text)")->execute();

				$schema = $session->getSchema("food");
				$schema->createCollection("trees");

				// ...

				$trees = $schema->getCollection("trees");

				// ...

				// Is this collection still in the database (schema)?
				if ($trees->existsInDatabase()) {
					echo "Yes, the 'trees' Collection is still present.";
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