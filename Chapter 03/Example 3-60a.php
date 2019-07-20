<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-60</title>
	</head>
	<body>
		<p>
		<h1>mysqli::query example</h1>
		<h2>Procedurl style</h2>
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

		/* Create table doesn't return a resultset */
		if (mysqli_query($link, "create temporary table myCity like City") == true){
			printf("Table myCity successfully created.\n".BR);
		}

		/* Select queries return a resultset */
		if ($result = mysqli_query($link, "select Name from City limit 10")){
			printf("Select returned  %d rows.\n".BR, mysqli_num_rows($result));

			/* free result set */
			mysqli_free_result($result);
		}

		/* If we have to retrieve large amount of data we use MYSQLI_USE_RESULT */
		if ($result = mysqli_query($link, "select * from City", MYSQLI_USE_RESULT)){
			
			/* Note, that we can't execute any functions which interact with the server until the set was closed.
			All calls will return an 'out of sync' error */
			if(!mysqli_query($link, "set @a:='this will not work'")){
				printf("Error: %s\n".BR, mysqli_error($link));
			}
			mysqli_free_result($result);
		}

		mysqli_close($link);

		// $dTbl = ;
		$dStr = ob_get_clean();
		nodeToDiv('p', $dStr);
		// retTbl($dTbl);
	?>
</html>