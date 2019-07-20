<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-66</title>
	</head>
	<body>
		<p>
		<h1>mysqli::set_local_infile_handler example</h1>
		<h2>Prcedural Style</h2>
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

		$db = mysqli_init();
		mysqli_real_connect($db, $host, $usr, $pwd, DB[2]);

		function callme($stream, & $buffer, $buflen, & $errmsg){
			$buffer = fgets($stream);

			echo $buffer;

			// convert to upper case and replace "," delimiter with [TAB]
			$buffer = strtoupper(str_replace(",", "\t", $buffer));

			return strlen($buffer);
		}

		echo "Input:\n";

		mysqli_set_local_infile_handler($db, "callme");
		mysqli_query($db, "load data local infile '../Source Files/txt/ch03ex3-66_input.txt' into table t1");
		mysqli_set_local_infile_default($db);

		$res = mysqli_query($db, "select * from t1");

		echo "\nResult:\n";
		while ($row = mysqli_fetch_assoc($res)){
			echo join(", ", $row)."\n";
		}

		// $dTbl = ;
		$dStr = ob_get_clean();
		nodeToDiv('p', $dStr);
		// retTbl($dTbl);
	?>
</html>