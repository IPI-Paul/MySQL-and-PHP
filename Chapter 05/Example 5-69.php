<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 5-69</title>
	</head>
	<body>
		<p>
		<h1>mysql_xdevapi\CrudOperationBindable::bind example</h1>
		<h2></h2>
		<hr />
		<div name="retStr">
			<?php 
				include '../IPI/settings.php';
				include IPI.'IPI Functions.php';

				$session = mysql_xdevapi\getSession("mysqlx://$usr:$pwd@$host?ssl-mode=disabled");
				$session->sql("drop database if exists addressbook")->execute();
				$session->sql("create database addressbook")->execute();

				$schema = $session->getSchema("addressbook");
				$coll = $schema->createCollection("people");

				$res = $coll->add(
					'{
						"name"	: "Fred",
						"age"	: 21,
						"job"	: "Construction"
					}',
					'{
						"name"	: "Wilma",
						"age"	: 23,
						"job"	: "Teacher"
					}',
					'{
						"name"	: "Bernie",
						"age"	: 20,
						"job"	: "Cat Herder"
					}',
					'{
						"name"	: "Jane",
						"age"	: 18,
						"job"	: "Scientist"
					}',
					'{
						"name"	: "Betty",
						"age"	: 24,
						"job"	: "Teacher"
					}',
					'{
						"name"	: "Alfred",
						"age"	: 18,
						"job"	: "Butler"
					}',
					'{
						"name"	: "Reginald",
						"age"	: 42,
						"job"	: "Butler"
					}',
					'{
						"name"	: "ENTITY",
						"age"	: 42,
						"job"	: [
							"Butler"
						]
					}'
				)->execute();

				$res = $coll
				->modify('name like :name')
				->arrayInsert('job[0]', 'Calciatore')
				->bind(['name' => 'ENTITY'])
				->execute();

				$res = $coll->find()->execute();
				echo "<pre>";
				print_r($res->fetchAll());

				$schema = $session->getSchema("nonsense");
				$table = $schema->getTable("numbers");
				$res = $table->select('hello', 'world')->execute();

				$res = $table
				->delete()
				->orderby('hello desc')
				->where('hello < 20 and hello > 12 and world != :world')
				->bind(['world' => 20])
				->execute();

				$result = $session->sql("select * from nonsense.numbers")->execute();

				// Returns an array of FieldMetadata objects
				print_r($result->getColumns());
				echo "</pre>";
			?>
		</div>
		<table name="retRes" width="100%"></table>
		<br />
		</p>
	</body>
	<?php
		include $tmpl.'get date.php'; 
	?>
</html>