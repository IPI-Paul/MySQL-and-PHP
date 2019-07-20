<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 5-72</title>
	</head>
	<body>
		<p>
		<h1>mysql_xdevapi\CrudOperationSortable::sort example</h1>
		<h2></h2>
		<hr />
		<div name="retStr">
			<?php 
				include '../IPI/settings.php';
				include IPI.'IPI Functions.php';
				echo "<pre>";

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
							"Butler",
							"Programmatore"
						]
					}',
					'{
						"name"	: "Hooray Henry",
						"age"	: 40,
						"job"	: "Cavia"
					}'
				)->execute();	

				$session->commit();
							   
				$res = $coll
				->find('job like \'Cavia\'')
				->sort('age desc', '_id desc')
				->execute();

				$session->commit();
				$session->close();

				print_r($res->fetchAll());
				echo "</pre>";
			?>
		</div>
		<table name="retRes" width="100%">
			<?php 
				
			?>
		</table>
		<br />
		</p>
	</body>
	<?php 
		include $tmpl.'get date.php'; 
	?>
</html>