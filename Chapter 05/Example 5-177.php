<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 5-177</title>
	</head>
	<body>
		<p>
		<h1>mysql_xdevapi\TableSelect::execute example</h1>
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

				$result = $table
				->select('name', 'age')
				->where('name like :name and age >= :age')
				->bind(
					[
						'name'	=> 'John',
						'age'	=> 42
					]
				)
				->orderby('age desc')
				->execute();

				$row = $result->fetchAll();

				print_r($row);

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