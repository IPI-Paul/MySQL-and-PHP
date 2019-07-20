<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 5-31</title>
	</head>
	<body>
		<p>
		<h1>mysql_xdevapi\CollectionFind::fields example</h1>
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
		$create = $schema->createCollection("people");

		// php server crashes if $why ommitted
		$why = $create
		->add(
			'{
				"name"	: "Alfred",
				"age"	: 18,
				"job"	: "Butler"
			}'
		)->execute();

		// ...

		$collection = $schema->getCollection("people");

		$result = $collection
		->find('job like :job and age > :age')
		->bind(['job' => 'Butler', 'age' => 16])
		->fields('name')
		->execute();

		var_dump($result->fetchAll());

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