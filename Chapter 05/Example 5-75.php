<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 5-75</title>
	</head>
	<body>
		<p>
		<h1>mysql_xdevapi\DatabaseObject::getSession example</h1>
		<h2></h2>
		<hr />
		<div name="retStr">
			<?php 
				include '../IPI/settings.php';
				include IPI.'IPI Functions.php';
				echo "<pre>";

				$session1 = mysql_xdevapi\getSession("mysqlx://$usr:$pwd@$host?ssl-mode=disabled");
				$schema = $session1->getSchema("addressbook");
				$dbObj = $schema->getCollection("people");

				$session = $dbObj->getSession();

				print_r($session);
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