<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 5-74</title>
	</head>
	<body>
		<p>
		<h1>myysql_xdevapi\DatabaseObject::getName example</h1>
		<h2></h2>
		<hr />
		<div name="retStr">
			<?php 
				include '../IPI/settings.php';
				include IPI.'IPI Functions.php';
				echo "<pre>";

				$session = mysql_xdevapi\getSession("mysqlx://$usr:$pwd@$host?ssl-mode=disabled");
				$schema = $session->getSchema("addressbook");
				$dbObj = $schema->getTable("tbl_people");

				$dbObjName = $dbObj->getName();

				print_r($dbObjName);
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