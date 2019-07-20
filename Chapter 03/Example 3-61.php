<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-61</title>
	</head>
	<body>
		<p>
		<h1>mysqli::real_connect example</h1>
		<h2>Object oriented style</h2>
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
			
		$mysqli = mysqli_init();
		if (!$mysqli){
			die('mysqli_init failed');
		}
			
		if (!$mysqli->options(MYSQLI_INIT_COMMAND, 'set autocommit = 0')){
			die('Setting MYSQLI_INIT_COMMAND failed'.BR);
		}

		print("The Default MYSQLI_OPT_CONNECT_TIMEOUT is 0\n".BR);

		if (!$mysqli->options(MYSQLI_OPT_CONNECT_TIMEOUT, 5)){
			die('Setting MYSQLI_OPT_CONNECT_TIMEOUT failed'.BR);
		}

		if(!$mysqli->real_connect($host, $usr, $pwd, $db)){
			die('Connect Error (' . mysqli_connect_errno() .')' . mysqli_connect_error());
		}

		echo 'Success... ' . $mysqli->host_info . "\n".BR;

		$mysqli->close();

		// $dTbl = ;
		$dStr = ob_get_clean();
		nodeToDiv('p', $dStr);
		// retTbl($dTbl);
	?>
</html>