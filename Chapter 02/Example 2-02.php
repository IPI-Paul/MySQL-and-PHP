<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 2-2</title>
	</head>
	<body>
		<p>
		<h1>Configure commands for using mysqlnd or libmysqlclient</h1>
		<hr />
		<br />
		<?php
			include '../IPI/settings.php';
			include IPI.'IPI Functions.php';
			
			// Recommended, compiles with mysqlnd
			h2('mysqli');
			$ ./configure --with-mysqli=mysqlnd;

			h2('PDO');
			$ ./configure --with-pdo-mysql=mysqlnd;

			/*
			deprecated in PHP7
			$ ./configure --with-mysql=mysqlnd
			*/

			// Alternatively recommended, compiles with mysqlnd as of PHP 5.4
			h2('mysqli');
			$ ./configure --with-mysqli;

			h2('PDO');
			$ ./configure --with-pdo-mysql;

			/*
			deprecated in PHP7
			$ ./configure --with-mysql
			*/

			// Not recommended, compiles with libmysqlclient
			h2('mysqli');
			$ ./configure --with-mysqli=path/to/mysql_config;

			h2('PDO');
			$ ./configure --with-pdo-mysql=path/to/mysql_config;

			/*
			deprecated in PHP7
			$ ./configure --with-mysql=path/to/mysql_config
			*/
		?>
		<br />
		</p>
		<?php include $tmpl.'get date.php'; ?>
	</body>
</html>