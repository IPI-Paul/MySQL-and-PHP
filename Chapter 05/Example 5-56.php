<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 5-56</title>
	</head>
	<body>
		<p>
		<h1>mysql_xdevapi\ColumnResult::__construct example</h1>
		<h2></h2>
		<hr />
		<div name="retStr">
			Doesn't return Metadata and crashes PHP Server on completion <br />
			<?php 
				include '../IPI/settings.php';
				include IPI.'IPI Functions.php';


				$session = mysql_xdevapi\getSession("mysqlx://$usr:$pwd@$host?ssl-mode=disabled");

				$session->sql("drop database if exists nonsense")->execute();
				$session->sql("create database nonsense")->execute();
				$session->sql("create table nonsense.numbers (hello int, world float unsigned)")->execute();
				$session->sql("insert into nonsense.numbers values (42, 42)")->execute();

				$schema = $session->getSchema("nonsense");
				$table = $schema->getTable("numbers");

				$result1 = $table->select('hello', 'world')->execute();

				// Returns an array of ColumnResult objects
				$columns = $result1->getColumns();

				echo "<pre>";
				foreach ($columns as $column) {
					echo "\nColumn label ", $column->getColumnLabel();
					echo " is type ", $column->getType();
					echo " and is ", ($column->isNumberSigned() === 0) ? "Unsigned." : "Signed.";
				}
				echo NL.BR;

				// Alternatively
				$result2 = $session->sql("select * from nonsense.numbers")->execute();

				// Returns an array of FieldMetadata objects
				print_r($result2->getColumns());
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