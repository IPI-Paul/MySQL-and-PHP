<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 5-86</title>
	</head>
	<body>
		<p>
		<h1>mysql_xdevapi\Result::__construct example</h1>
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
				$session->sql(
					"
					create table addressbook.names
					 (id int not null auto_increment, name varchar(30), age int, primary key (id))
					"
				)->execute();

				$schema = $session->getSchema("addressbook");
				$table = $schema->getTable("names");

				$result = $table
				->insert("name", "age")
				->values(["Suzanne", 31], ["Julie", 43])
				->execute();
				$result = $table
				->insert("name", "age")
				->values(["Suki", 34])
				->execute();

				$ai = $result->getAutoIncrementValue();
				var_dump($ai);

				echo "\n";
				print_r($session->sql("select * from addressbook.names")->execute()->fetchAll());
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