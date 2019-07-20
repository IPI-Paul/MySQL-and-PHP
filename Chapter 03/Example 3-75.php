<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-75</title>
	</head>
	<body>
		<p>
		<h1>mysqli_stmt_bind_param example</h1>
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
			if (!$link) {
				pfConnP();
			}

			$stmt = mysqli_prepare($link, "insert into CountryLanguage values (?, ?, ?, ?)");
			mysqli_stmt_bind_param($stmt, 'sssd', $code, $language, $official, $percent);

			$code = 'DEU';
			$language = 'Bavarian';
			$official = "F";
			$percent = 11.2;

			/* execute prepared statement */
			mysqli_stmt_execute($stmt);

			printf("%d Row inserted.\n".BR, mysqli_stmt_affected_rows($stmt));

			/* close statement and connection */
			mysqli_stmt_close($stmt);

			/* Clean up table CountryLanguage */
			mysqli_query($link, "delete from CountryLanguage where Language = 'Bavarian'");
			printf("%d Row deleted.\n".BR, mysqli_affected_rows($link));

			/* close connection */
			mysqli_close($link);

			// $dTbl = ;
			$dStr = ob_get_clean();
			nodeToDiv('p', $dStr);
			// retTbl($dTbl);
		?>
</html>