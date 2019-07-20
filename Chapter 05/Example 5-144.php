<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 5-144</title>
	</head>
	<body>
		<p>
		<h1>mysql_xdevapi\SqlStatementResult::getGeneratedIds example</h1>
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

				$schema = $session->getSchema("dbtest");
				$collection = $schema->createCollection("workers");

				$coll = $collection->add(
					'{
						"name"	: "John", 
						"age"	: 42, 
						"job"	: "bricklayer"
					}',
					'{
						 "name"	: "Sam", 
						 "age"	: 33, 
						 "job"	: "carpenter"
					}'
				)->execute();

				$ids = $coll->getGeneratedIds();

				print_r("The following Ids were generated: \n" . implode("\n", $ids));

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