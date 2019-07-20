<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 5-114</title>
	</head>
	<body>
		<p>
		<h1>mysql_xdevapi\Session::createSchema exampe</h1>
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

				$uri = "mysqlx://$usr:$pwd@$host?ssl-mode=disabled";
				$sess = mysql_xdevapi\getSession($uri);

				try {
					if ($schema = $sess->createSchema('fruit')) {
						echo "Info: I created a schema named 'fruit'\n";
					}
				} catch (Exception $e) {
					echo $e->getMessage();
				}

				$sess->close();
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