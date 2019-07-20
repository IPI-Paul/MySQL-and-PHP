<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-5</title>
	</head>
	<body>
		<p>
		<h1>Setting defaults></h1>
		<hr />
		<br />
		mysqli.default_host=192.168.2.27 <br />
		mysqli.default_user=root <br />
		mysqli.default_pw="" <br />
		mysqli.default_port=3306 <br />
		mysqli.default_socket=/tmp/mysql.sock <br />
		<br />
		</p>
		<?php 
			include '../IPI/settings.php';
			include $tmpl.'get date.php'; 
		?>
	</body>
</html>