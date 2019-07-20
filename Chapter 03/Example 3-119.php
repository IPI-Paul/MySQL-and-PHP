<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-119</title>
	</head>
	<body>
		<p>
		<h1>mysqli_fetch_fields example</h1>
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

		$link = mysqli_connect($host, $usr, $pwd, DB[1]);

		/* check connection */
		if (mysqli_connect_errno()) {
			pfConnP();
		}

		foreach (array('latin1', 'utf8') as $charset) {
		
			//Set character set, to show its impact on some values (e.g., length in bytes)
			mysqli_set_charset($link, $charset);

			$query = "select actor_id, last_name from actor order by actor_id";

			echo "===========================\n";
			echo "Character Set: $charset\n";
			echo "===========================\n";

			if ($result = mysqli_query($link, $query)) {
			
				/* Get field information for all columns */
				$finfo = mysqli_fetch_fields($result);

				foreach ($finfo as $val) {
					printf("Name\t\t: %s\n", $val->name);
					printf("Table\t\t: %s\n", $val->table);
					printf("Max. Len\t: %d\n", $val->max_length);
					printf("Length\t\t: %d\n", $val->length);
					printf("charsetnr\t: %d\n", $val->charsetnr);
					printf("Flags\t\t: %d\n", $val->flags);
					printf("Type\t\t: %d\n\n", $val->type);
				}
				mysqli_free_result($result);
			}
		}

		mysqli_close($link);

		// $dTbl = ;
		$dStr = ob_get_clean();
		nodeToDiv('pre', $dStr);
		// retTbl($dTbl);
	?>
</html>