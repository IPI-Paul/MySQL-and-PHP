<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 5-82</title>
	</head>
	<body>
		<p>
		<h1>mysql_xdevapi\Executable::execute example</h1>
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
				$result_sql = $session->sql("create database addressbook")->execute();

				var_dump($result_sql);

				$schema = $session->getSchema("addressbook");
				$collection = $schema->createCollection("humans");

				$result_collection = $collection->add(
					'{
						"name"	: "Jane",
						"jobs"	: [
							{
								"title"	: "Scientist",
								"Salary": 18000
							},
							{
								"title"	: "Mother",
								"Salary": 0
							}
						],
						"hobbies": [
							"Walking",
							"Making pies"
						]
					}'
				);

				$result_collection_executed = $result_collection->execute();

				$session->commit();

				var_dump($result_collection);
				var_dump($result_collection_executed);

				ob_flush();

				print_r($collection->find()->execute()->fetchOne());
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