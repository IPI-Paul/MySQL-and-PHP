<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 5-88</title>
	</head>
	<body>
		<p>
		<h1>mysql_xdevapi\Result::getGeneratedIds example</h1>
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
				$create = $schema->createCollection("people");

				$collection = $schema->getCollection("people");

				$result = $collection->add(
					'{
						"name"	: "Bernie",
						"jobs"	: [
							{
								"title"	: "Cat Herder",
								"Salary": 42000
							},
							{
								"title"	: "Father",
								"Salary": 0
							}
						],
						"hobbies": [
							"Sports",
							"Making cupcakes"
						]
					}',
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
				)
				->execute();

				$ids = $result->getGeneratedIds();
				var_dump($ids);

				print_r($session->sql("select * from addressbook.people")->execute()->fetchAll());

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