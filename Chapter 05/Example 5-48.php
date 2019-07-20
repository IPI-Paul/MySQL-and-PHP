<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 5-48</title>
	</head>
	<body>
		<p>
		<h1>mysql_xdevapi\CollectionModify::skip example</h1>
		<h2></h2>
		<hr />
		<div name="retStr">->skip(1)  [HY000] Invalid parameter: offset value is not allowed for this operation<br /></div>
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
		$coll = $schema->createCollection("people");

		$result = $coll->add(
			'{
				"name"	: "Fred",
				"age"	: 21,
				"job"	: "Construction"
			}',
			'{
				"name"	: "Wilma",
				"age"	: 23,
				"job"	: "Teacher"
			}',
			'{
				"name"	: "Betty",
				"age"	: 24,
				"job"	: "Teacher"
			}',
			'{
				"name"	: "Alfred",
				"age"	: 18,
				"job"	: "Butler"
			}',
			'{
				"name"	: "Reginald",
				"age"	: 42,
				"job"	: "Butler"
			}'
		)->execute();
		
		$coll
		->modify('age > :age')
		->sort('age desc')
		->unset(['age'])
		->bind(['age' => 20])
		->limit(4)
//		->skip(1)  [HY000] Invalid parameter: offset value is not allowed for this operation
		->execute();
		
		$result = $coll->find()->execute();
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