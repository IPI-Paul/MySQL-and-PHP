<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-32</title>
		<?php
			include '../IPI/settings.php';
			include IPI.'IPI Functions.php';

			ob_start();

			$link = mysqli_connect($host, $usr, $pwd, $db);

			if (!$link){
				printf("Can't connect to localhost. Error: %s\n".BR, mysqli_connect_error());
				exit();
			}

			/* turn autocommit on */
			mysqli_autocommit($link, true);

			if ($result = mysqli_query($link, "select @@autocommit")){
				$row = mysqli_fetch_row($result);
				printf("Autocommit is %s\n".BR, $row[0]);
				mysqli_free_result($result);
			}

			/* close connection */
			mysqli_close($link);

			// $dTbl = ;
			$dStr = ob_get_clean();
		?>
	</head>
	<body>
		<p>
		<h1>mysqli::autocommit example</h1>
		<h2>Procedural style</h2>
		<hr />
		<div name="retStr"></div>
		<table name="retRes" width="100%"></table>
		<br />
		<?php 
			nodeToDiv('p', $dStr);
			// retTbl($dTbl);

			include $tmpl.'get date.php'; 
		?>
		</p>
	</body>
</html>