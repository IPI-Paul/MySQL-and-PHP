<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 5-78</title>
	</head>
	<body>
		<p>
		<h1>mysql_xdevapi\DocResult::fetchOne example</h1>
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
				$create = $schema->createCollection("people");

				$create->add(
					'{
						"name"	: "Alfred",
						"age"	: 18,
						"job"	: "Butler"
					}'
				)->execute();
				$create->add(
					'{
						"name"	: "Reginald",
						"age"	: 42,
						"job"	: "Butler"
					}'
				)->execute();

				$session->commit();

				// ...

				$collection = $schema->getCollection("people");

				// Yeids a DocResult object
				$result = $collection
				->find('job like :job and age > :age')
				->bind(['job' => 'Butler', 'age' => 16])
				->sort('age desc')
				->execute();

				var_dump($result->fetchOne());
				$session->close();
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