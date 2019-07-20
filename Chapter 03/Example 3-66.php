<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-66</title>
	</head>
	<body>
		<p>
		<h1>mysqli::set_local_infile_handler example</h1>
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

		$db = mysqli_init();
		$db->real_connect($host, $usr, $pwd, DB[2]);

		function callme($stream, &$buffer, $buflen, &$errmsg) {
			$buffer = fgets($stream);

			echo $buffer;

			// convert to upper case and replace "," delimiter with [TAB]
			$buffer = strtoupper(str_replace(",", "\t", $buffer));

			return strlen($buffer);
		}
			
		echo "Input:\n".BR;

		$db->set_local_infile_handler("callme");
		$db->query("load data local infile '../Source Files/txt/ch03ex3-66_input.txt' into table t1");
		$db->set_local_infile_default();

		$res = $db->query("select * from t1");

		echo BR."\nResult:\n".BR;
		while ($row = $res->fetch_assoc()){
			echo join(",", $row)."\n".BR;
		}

		// $dTbl = ;
		$dStr = ob_get_clean();
		nodeToDiv('p', $dStr);
		// retTbl($dTbl);

	?>
</html>