<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 5-70</title>
	</head>
	<body>
		<p>
		<h1>mysql_xdevapi\CrudOperationLimitable::limit example</h1>
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
							"Butler"
						]
					}'
				)->execute();	

				$res = $coll
				->find()
				->fields(['name as n', 'age as a', 'job as j'])
				->groupBy('j')
				->limit(11)
				->execute();
					
				$session->commit();
				print_r($res->fetchAll());

				$session
				->sql("create table addressbook.tblPeople(age int, name nvarchar(50), job nvarchar(50))")
				->execute();
				$session
				->sql("insert into  addressbook.tblPeople values 
					(21, 'Fred', 'Construction'), 
					(23, 'Wilma', 'Teacher')
				")
				->execute();

				$table = $schema->getTable("tblPeople");

				$res = $table
				->update()
				->set('age', 69)
				->where('age > 15 and age < 22')
				->limit(4)
				->orderby(['age asc', 'name desc'])
				->execute();
				
				$row = $table
				->select('name', 'age', 'job')
				->execute()
				->fetchAll();

				$session->commit();
				$session->close();
				print_r($row);
				echo '</pre>';	
			?>
		</div>
		<table name="retRes" width="100%"></table>
		<br />
		</p>
	</body>
	<?php 
		include $tmpl.'get date.php'; 
		exit(0);
	?>
</html>