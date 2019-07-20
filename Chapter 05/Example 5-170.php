<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 5-170</title>
	</head>
	<body>
		<p>
		<h1>mysql_xdevapi\TableDelete::orderBy example</h1>
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

				$row = $table->delete()
				->where("age = :age")
				->bind(['age' => 42])
				->orderby("name desc")
				->limit(1)
				->execute();

				print_r($row->getAffectedItemsCount() . " row deleted!" . NL);
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