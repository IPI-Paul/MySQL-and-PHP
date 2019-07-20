<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 5-85</title>
	</head>
	<body>
		<p>
		<h1>mysql_xdevapi\RowResult::getColumns example</h1>
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

				$session->sql("drop database if exists foo")->execute();
				$session->sql("create database foo")->execute();
				$session->sql("create table foo.names(name nvarchar(50), x int)")->execute();

				$session->sql("insert into foo.names values ('John', 42), ('Sam', 33)")->execute();
				echo "Now Run Example <a href='Example 5-85a.php'>5-85a</a>. \n\nTrying to run both scripts in the same process crashes the PHP Web server!";
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