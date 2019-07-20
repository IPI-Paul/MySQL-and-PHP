<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 5-115</title>
	</head>
	<body>
		<p>
		<h1>mysql_xdevapi\Session::dropSchema example</h1>
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
				if (!$session->dropSchema("addressbook")) {
					runScript("Example 5-86.php");
					echo "Running Example 5-86.php to create addressbook first\n";
					echo "Restart PHP Server if necessary and re-run this script once done!";
				} else {
					echo "addressbook dropped!";			
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