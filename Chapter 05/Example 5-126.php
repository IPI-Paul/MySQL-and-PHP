<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 5-126</title>
	</head>
	<body>
		<p>
		<h1>mysql_xdevapi\Session::rollback example</h1>
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
				$collection = $session->getSchema("addressbook")->getCollection("friends");

				$start = $session->startTransaction();
				$coll = $collection->add(
					'{
						"test1"	: 1,
						"test2": 2
					}'
				)->execute();

				$savepoint = $session->setSavepoint();

				$coll = $collection->add(
					'{
						"test3"	: 3,
						"test4"	: 4
					}'
				)->execute();

				print_r($collection->find()->execute()->fetchAll());

				$session->releaseSavepoint($savepoint);
				$session->rollback();

				print_r($collection->find()->execute()->fetchAll());

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