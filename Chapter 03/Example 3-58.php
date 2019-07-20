<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-58</title>
	</head>
	<body>
		<p>
		<h1>mysqli_poll example</h1>
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

		$link1 = mysqli_connect($host, $usr, $pwd);
		$link1->query("select 'test'", MYSQLI_ASYNC);
		$all_links = array($link1);
		$processed = 0;
		do {
			$links = $errors = $reject = array();
			foreach ($all_links as $link){
				$links[] = $errors[] = $reject[] = $link;
			}
			if (!mysqli_poll($links, $errors, $reject, 1)){
				continue;
			}
			foreach ($links as $link){
				if ($result = $link->reap_async_query()){
					print_r($result->fetch_row());
					if (is_object($result))
						mysqli_free_result($result);
				} else {
					die(sprintf("MySQLi Error: %s", mysqli_error($link)));
				}
				$processed++;
			} 
		} while ($processed < count($all_links));

		// $dTbl = ;
		$dStr = ob_get_clean();
		nodeToDiv('pre', $dStr);
		// retTbl($dTbl);
	?>
</html>