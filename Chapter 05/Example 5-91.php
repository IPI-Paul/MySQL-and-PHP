<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 5-91</title>
	</head>
	<body>
		<p>
		<h1>mysql_xdevapi\RowResult::__construct example</h1>
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

				$err = null;
				try {
					$row = $table
					->select('name', 'age')
					->where('age > 18')
					->execute()
					->fetchAll();
					print_r($row);				
				} catch(Exception $e) {
					echo $e->getMessage().BR;
					$err = $e;
				}
				if ($err) {
					runScript("Example 5-86.php");
					echo "Running Example 5-86.php to create addressbook first\n";
					echo "Restart PHP Server if necessary and re-run this script once done!";				
				}

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