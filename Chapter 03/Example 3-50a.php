<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-50</title>
	</head>
	<body>
		<p>
		<h1>$mysqli->protocol_version example</h1>
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

		$link = mysqli_connect($host, $usr, $pwd);

		/* check connection */
		if (mysqli_connect_errno()){
			pfConnP();
		}
		/* print protocol version */
		printf("Protocol version: %d\n", mysqli_get_proto_info($link));

		/* close connection */
		mysqli_close($link);

		// $dTbl = ;
		$dStr = ob_get_clean();
		nodeToDiv('p', $dStr);
		// retTbl($dTbl);
	?>
</html>