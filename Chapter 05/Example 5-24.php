<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 5-24</title>
	</head>
	<body>
		<p>
		<h1>mysql_xdevapi\Collection::removeOne example</h1>
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

		$result = $collection->add(
			'{
				"name"	: "Alfred",
				"age"	: 18,
				"job"	: "Butler"
			}'
		)->execute();

		/* 
		Normally the _id is known by other means, but for this example let's fetch the generated id and use it
		*/
		$ids = $result->getGeneratedIds();
		$alfred_id = $ids[0];

		$result = $collection->removeOne($alfred_id);
		if (!$result->getAffectedItemsCount()) {
			echo 'Alfred with id ' . $alfred_id . ' was not removed.';
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
		} else {
			printf('Goodbye, Alfred, you can take _id %s with you.', $alfred_id);
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
		}

		// nodeToDiv('pre', $dStr); causes memory leak with mysql_xdevapi
	?>
</html>