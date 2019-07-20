<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 5-98</title>
	</head>
	<body>
		<p>
		<h1>mysql_xdevapi\RowResult::getWarningsCount example</h1>
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

				$session->sql("drop database if exists foo")->execute();
				$session->sql("create database foo")->execute();
				$session->sql("create table foo.test_table(x int)")->execute();

				$schema = $session->getSchema("foo");
				$table = $schema->getTable("test_table");

				$table
				->insert(['x'])
				->values([1])
				->values([2])
				->execute();

				$res = $table
				->select(
					['x/0 as bad_x']
				)
				->execute();

				echo $res->getWarningsCount();

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