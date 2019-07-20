<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 5-112</title>
	</head>
	<body>
		<p>
		<h1>mysql_xdevapi\Session::commit example</h1>
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
				$schema->createCollection("friends");

				$collection = $session
				->getSchema("addressbook")
				->getCollection("friends");

				$session->startTransaction();

				$collection->add(
					'{
						"John": 42,
						"Sam": 33
					}'
				)->execute();
				$savepoint = $session->setSavepoint();

				$session->commit();
				var_dump($savepoint);

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