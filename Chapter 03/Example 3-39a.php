<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-39</title>
	</head>
	<body>
		<p>
		<h1>mysqli::__construct example</h1>
		<h2>Object oriented style when extending mysqli class</h2>
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

		class foo_mysqli extends mysqli {
			public function __construct($host, $user, $pass, $db) {
				parent::__construct($host, $user, $pass, $db);

				if (mysqli_connect_errno()){
					die(nodeToDiv('p', dConnP()));
				}
			}
		}

		ob_start();

		$ndb = new foo_mysqli($host, $usr, $pwd, $db);

		echo 'Success... MYSQL host info: ' . $ndb->host_info . NL;

		$ndb->close();

		nodeToDiv('p', ob_get_clean());
	?>
</html>