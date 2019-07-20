<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 5-08</title>
	</head>
	<body>
		<p>
		<h1>mysql_xdevapi\RowResult::getWarnings example</h1>
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

		$session = mysql_xdevapi\getSession("mysqlx://$usr:$pwd@$host?ssl-mode=disabled");

		$session->sql("drop database if exists foo")->execute();
		$session->sql("create database foo")->execute();
		$session->sql("create table foo.test_table(x int)")->execute();

		$schema = $session->getSchema("foo");
		$table = $schema->getTable("test_table");

		$table->insert(['x'])->values([1])->values([2])->execute();
		
		$res = $table->select(['x/0 as bad_x'])->execute();
		$warnings = $res->getWarnings();

		print_r($warnings);
		
		// nodeToDiv('pre', $dStr); causes memory leak with mysql_xdevapi
		$str = str_replace("\n", '\n', str_replace("\r\n", '\r\n', str_replace("'", "\'", ob_get_clean())));
		$nStr = "<script>" . NL;
		$nStr .= "var node = document.createElement('pre');";
		$nStr .= "node.innerHTML='";
		$nStr .= $str;
		$nStr .= "'";
		if (strpos($str, 'id=\"') > 0){
			$nStr .= ".replace('id=\"', 'id=\"n'+document.getElementsByName('retStr')[0].childNodes.length)";
		}
		$nStr .= "; " . NL;
		$nStr .= "document.getElementsByName('retStr')[0].appendChild(node); " . NL;
		$nStr .= "</script>" . NL;
		echo  $nStr;
	?>
</html>