<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 5-26</title>
	</head>
	<body>
		<p>
		<h1>mysql_xdevapi\CollectionAdd::__construct example</h1>
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

		// Add two documents
		$collection->add(
			'{
				"name"	: "Fred",
				"age"	: 21,
				"job"	: "Construction"
			}'
		)->execute();

		$collection->add(
			'{
				"name"	: "Wilma",
				"age"	: 23,
				"job"	: "Teacher"
			}'
		)->execute();

		// Add two documents using a single JSON object
		$result = $collection->add(
			'{
				"name"	: "Bernie",
				"jobs"	: [
					{
						"title"	: "Cat Herder",
						"salary": 42000
					},
					{
						"title"	: "Father",
						"salary": 0
					}
				],
				"hobbies": [
					"Sports",
					"Making cupcakes"
				]
			}',
			'{
				"name"	: "Jane",
				"jobs"	: [
					{
						"title"	: "Scientister",
						"salary": 18000
					},
					{
						"title"	: "Mother",
						"salary": 0
					}
				],
				"hobbies": [
					"Walking",
					"Making pies"
				]
			}'
		)->execute();

		// Fetch a list of generated ID's from the last add()
		$ids = $result->getGeneratedIds();
		print_r($ids);

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