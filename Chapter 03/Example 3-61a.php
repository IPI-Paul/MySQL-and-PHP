<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-61</title>
	</head>
	<body>
		<p>
		<h1>mysqli::real_connect example</h1>
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

		ob_start();

		class foo_mysqli extends mysqli {
			public function __construct($host, $usr, $pwd, $db){
				parent::init();

				if (!parent::options(MYSQLI_INIT_COMMAND, 'set autocommit = 0')){
					die('Setting MYSQLI_INIT_COMMAND failed'.BR);
				}

				if (!parent::options(MYSQLI_OPT_CONNECT_TIMEOUT, 5)){
					die('Setting MYSQLI_OPT_CONNECT_TIMEOUT failed'.BR);
				}

				if (!parent::real_connect($host, $usr, $pwd, $db)){
					die('Connect Error (' . mysqli_connect_errno() . ')' . mysqli_connect_error());
				}
			}
		}

		$db = new foo_mysqli($host, $usr, $pwd, $db);

		echo 'Success... ' . $db->host_info . "\n".BR;

		$db->close();

		// $dTbl = ;
		$dStr = ob_get_clean();
		nodeToDiv('p', $dStr);
		// retTbl($dTbl);
	?>
</html>