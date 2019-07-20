<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 5-52</title>
	</head>
	<body>
		<p>
		<h1>mysql_xdevapi\Collection::remove example</h1>
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

		$session->sql("drop database if exists addressbook")->execute();
		$session->sql("create database addressbook")->execute();

		$schema = $session->getSchema("addressbook");
		$collection = $schema->createCollection("people");

		$res = $collection->add(
			'{
				"name"	: "Alfred",
				"age"	: 18,
				"job"	: "Butler"
			}'
		)->execute();
		$collection->add(
			'{
				"name"	: "Bob",
				"age"	: 19,
				"job"	: "Painter"
			}'
		)->execute();

		// Remove all painters
		$collection
		->remove("job in ('Painter')")
		->execute();

		// Remove the oldest butler
		$collection
		->remove("job in ('Butler')")
		->sort('age desc')
		->limit(1)
		->execute();

		// Remove record with lowest age
		$collection
		->remove('true')
		->sort('age desc')
		->limit(1)
		->execute();

		$res = $collection->find()->execute();
		print_r($res->fetchAll());

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