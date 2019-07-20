<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-61</title>
	</head>
	<body>
		<p>
		<h1>mysqli::real_connect example</h1>
		<h2>Procedural style</h2>
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

		$link = mysqli_init();
		if (!$link){
			die('mysqli_init failed');
		}

		if (!mysqli_options($link, MYSQLI_INIT_COMMAND, 'set autocommit = 0')){
			die('Setting MYSQLI_INIT_COMMAND failed');
		}

		if (!mysqli_options($link, MYSQLI_OPT_CONNECT_TIMEOUT, 5)){
			die('Setting MYSQLI_OPT_CONNECT_TIMEOUT failed');
		}

		if (!mysqli_real_connect($link, $host, $usr, $pwd, $db)){
			die('Connect Error (' . mysqli_connect_errno() . ')' . mysqli_connect_error());
		}

		echo 'Success... ' . mysqli_get_host_info($link) . "\n";

		mysqli_close($link);

		// $dTbl = ;
		$dStr = ob_get_clean();
		nodeToDiv('p', $dStr);
		// retTbl($dTbl);
	?>
</html>