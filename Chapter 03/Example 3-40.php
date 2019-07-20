<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-40</title>
	</head>
	<body>
		<p>
		<h1>Generating a Trace File</h1>
		<h2></h2>
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

		/* Create a trace file in '/tmp/client.trace' on the local (client) machine: */
			
		$trace = '/tmp/client.trace';
		if (!mysqli_debug("d:t:o, $trace")){
			echo "Failed to generate  trace file!".NL;
		} else {
			echo "Trace file generated successfully at $trace".NL;
		}

		$dStr = ob_get_clean();
		nodeToDiv('p', $dStr);
		// retTbl($dTbl);
	?>
</html>