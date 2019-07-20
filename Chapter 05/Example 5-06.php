<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 5-06</title>
	</head>
	<body>
		<p>
		<h1>URI examples</h1>
		<h2></h2>
		<hr />
		<div name="retStr"></div>
		<table name="retRes" width="100%"></table>
		<br />
		</p>
	</body>
	<?php 
		include '../IPI/settings.php';
		include IPI.'IPI Functions.php';
		include $tmpl.'get date.php'; 

		ob_start();
		$txt = "
		mysqlx://foobar
		mysqlx://root@localhost?socket=%2Ftmp%2Fmysqld.sock%2F
		mysqlx://foo:bar@localhost:33060
		mysqlx://foo:bar@localhost:33160?ssl-mode=disabled
		mysqlx://foo:bar@localhost:33260?ssl-mode=required
		mysqlx://foo:bar@localhost:33360?ssl-mode=required&auth=mysql41
		mysqlx://foo:bar@(/path/to/socket)
		mysqlx://foo:bar@(/path/to/socket)?auth=sha256_mem
		mysqlx://foo:bar@[licalhost:33060, 127.0.0.1:33061]
		mysqlx://foobar?ssl-ca=(/path/to/ca.pem)&ssl-crl=(/path/to/crl.pem)
		mysqlx://foo:bar@[localhost:33060, 127.0.0.1:33061]?ssl-mode=disabled
		mysqlx://foo:bar@localhost:33160/?connect-timeout=0
		mysqlx://foo:bar@localhost:33160/?connect-timeout=10
		";
		echo $txt;
		// $dTbl = ;
		$dStr = ob_get_clean();
		nodeToDiv('pre', $dStr);
		// retTbl($dTbl);
	?>
</html>