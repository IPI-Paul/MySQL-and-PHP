<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-55</title>
	</head>
	<body>
		<p>
		<h1>mysqli::kill example</h1>
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

		$link = mysqli_connect($host, $usr, $pwd, $db);

		/* check connection */
		if (mysqli_connect_errno()){
			pfConnP();
		}

		/* detrmine our thread id */
		$thread_id = mysqli_thread_id($link);

		/* Kill connection */
		mysqli_kill($link, $thread_id);

		/* This should produce an error */
		if (!mysqli_query($link, "create table myCity like City")){
			printf("Error: %s\n", mysqli_error($link));
			// exit;
		}

		/* close connection */
		mysqli_close($link);

		// $dTbl = ;
		$dStr = ob_get_clean();
		nodeToDiv('p', $dStr);
		// retTbl($dTbl);
	?>
</html>