<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 5-187</title>
	</head>
	<body>
		<p>
		<h1>mysql_xdevapi\TableUpdate::__construct example</h1>
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

				$schema = $session->getSchema("addressbook");
				$table = $schema->getTable("names");

				$res = $table
				->update()
				->set(
					'age', 42
				)
				->where('age > 15 and age < 42')
				->limit(4)
				->orderby([
					'age asc',
					'name desc'
				])
				->execute();

				print_r($table->select("*")->execute()->fetchAll());

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