<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 5-32</title>
	</head>
	<body>
		<p>
		<h1>mysql_xdevapi\CollectionFind::groupBy example</h1>
		<h2></h2>
		<hr />
		<div name="retStr">Deprecated function since MySQL 8.0.16</div>
		<table name="retRes" width="100%"></table>
		<br />
		</p>
	</body>
	<?php 
		include '../IPI/settings.php';
		include IPI.'IPI Functions.php';
		include $tmpl.'get date.php'; 

		ob_start();

		// Assuming $coll is a valid Collection object

		// Extract all the documents from the Collection and group the results by the 'name' field

		$session = mysql_xdevapi\getSession("mysqlx://$usr:$pwd@$host?ssl-mode=disabled");
		$schema = $session->getSchema("addressbook");
		$coll = $schema->getCollection("people");

		$res = $coll
		->find()
		->groupBy('name')
		->execute();

		var_dump($res->fecthAll());

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