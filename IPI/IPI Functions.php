<?php 
	/*
	The Default MYSQLI_OPT_CONNECT_TIMEOUT is 0
	Default Autocommit = 1
	Default $driver = new mysqli_driver(); $driver->report_mode = 0 or MYSQLI_REPORT_OFF
	*/
	if (is_dir('../IPI/')){
		include '../IPI/IPI Error Strings.php';
	} else{
		include 'IPI/IPI Error Strings.php';
	}
	const BR = '<br />';			
	const NL = "\n";
	const NB = NL.BR;

	function chkAutoCommit($mysqli){
		if ($result = $mysqli->query("select @@autocommit")){
			$row = $result->fetch_row();
			printf("Autocommit is %s\n".BR, $row[0]);
			$result->free();
		}	
	}
	function connDb(){
		$mysqli = new mysqli(lgn[0], lgn[1], lgn[2], lgn[3]);
		if ($mysqli->connect_errno){
			fConn($mysqli);
		}
		return $mysqli;
	}
	function h1($txt){
		echo "<h1>$txt</h1>";
	}
	function h2($txt){
		echo "<h2>$txt</h2>";
	}
	function h3($txt){
		echo "<h3>$txt</h3>";
	}
	function h4($txt){
		echo "<h4>$txt</h4>";
	}
	function pre($txt){
		echo "<pre>";
		print_r($txt); 
		echo "</pre>".BR;
	}
	function retRows($mysqli){
		$fld = $mysqli->fetch_field();
		echo '<table id="tbl_' . $fld->table . '" name="retRes">' . NL;
		echo '<th id="th_' . $fld->name . '">' . $fld->name . '</th>' . NL;
		while ($col = $mysqli->fetch_field()){
			echo '<th id="th_' . $col->name . '">' . $col->name . '</th>' . NL;
		}
		while ($row = $mysqli->fetch_assoc()){
			echo '<tr><td>'. implode("</td><td>", str_replace("'", "&apos;", $row)) . '</td></tr>' . NL;
		}
		echo '</table>' . NL . BR;
	}
	function retTbl($mysqli){
		$fld = $mysqli->fetch_field();
		$rows = '<table id="tbl_' . $fld->table . '" name="retRes">';
		$rows .= '<th id="th_' . $fld->name . '">' . $fld->name . '</th>';
		while ($col = $mysqli->fetch_field()){
			$rows .= '<th id="th_' . str_replace("'", "&apos;", $col->name) . '">' . $col->name . '</th>';
		}
		while ($row = $mysqli->fetch_assoc()){
			$rows .= '<tr><td>'. implode("</td><td>", str_replace("'", "&apos;", $row)) . '</td></tr>';
		}
		$rows .= '</table>';
		echo "<script>document.getElementsByName('retRes')[0].outerHTML='". $rows ."';</script>" . NL .BR;
	}
	function retTbls($mysqli){
		$fld = $mysqli->fetch_field();
		$rows = '<table id="tbl_' . $fld->table . '" name="retRes">';
		$rows .= '<th id="th_' . $fld->name . '">' . $fld->name . '</th>';
		while ($col = $mysqli->fetch_field()){
			$rows .= '<th id="th_' . str_replace("'", "&apos;", $col->name) . '">' . $col->name . '</th>';
		}
		while ($row = $mysqli->fetch_assoc()){
			$rows .= '<tr><td>'. implode("</td><td>", str_replace("'", "&apos;", $row)) . '</td></tr>';
		}
		$rows .= '</table>';
		return $rows;
	}
	function nodeToDiv($node, $str){
		$str = str_replace("\n", '\n', str_replace("\r\n", '\r\n', str_replace("'", "\'", $str)));
		$nStr = "<script>" . NL;
		print memory_get_usage(true);
		$nStr .= "var node = document.createElement('".$node."');";
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
	function runScript($name) {
		echo "<script> var wn = window.open('$name', '','target=_blank'); wn.close();</script>";
	}
	function sendToDiv($node, $str){
		$str = str_replace("\n", '\n', str_replace("\r\n", '\r\n', str_replace("'", "\'", $str)));
		$nStr = "<script>" . NL;
		$nStr .= "var node = document.createElement('".$node."');" . NL;
		$nStr .= "var textnode = document.createTextNode('";
		$nStr .= $str;
		$nStr .= "'); " . NL;
		$nStr .= "node.appendChild(textnode);" . NL;
		$nStr .= "document.getElementsByName('retStr')[0].appendChild(node); " . NL;
		$nStr .= "</script>" . NL;
		echo  $nStr;
	}
	function tblCreate($mysqli, $tbl, $cols){
		if (!$mysqli->query('drop table if exists '.$tbl) || 
			!$mysqli->query('create table `'.$tbl.'`('.$cols.')')
			){
				fTbl($mysqli);
		}
	}
?>