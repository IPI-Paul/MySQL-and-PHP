<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 5-17</title>
	</head>
	<body>
		<p>
		<h1>mysql_xdevapi\Collection::find example</h1>
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

		$collection->add(
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
				"job"	: "Swimmer"
			}'
		)->execute();
		$collection->add(
			'{
				"name"	: "Fred",
				"age"	: 20,
				"job"	: "Construction"
			}'
		)->execute();
		$collection->add(
			'{
				"name"	: "Wilma",
				"age"	: 21,
				"job"	: "Teacher"
			}'
		)->execute();
		$collection->add(
			'{
				"name"	: "Suki",
				"age"	: 22,
				"job"	: "Teacher"
			}'
		)->execute();

		$find = $collection->find('job like :job and age > :age');
		$result = $find
		->bind(['job' => 'Teacher', 'age' => 20])
		->sort('age desc')
		->limit(2)
		->execute();

		print_r($result->fetchAll());

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