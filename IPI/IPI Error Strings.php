<?php 
	function dConnO($mysqli){
		return 'Failed to connect MySQL: (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error . NL;
	}
	function dConnP(){
		return 'Failed to connect MySQL: (' . mysqli_connect_errno() . ') ' . mysqli_connect_error() . NL;
	}
	function eQuery($mysqli){
		echo 'Error executing query: (' . $mysqli->errno . ') ' . $mysqli->error . BR;
	}
	function fBind($stmt){
		echo "Binding parameters failed: (" . $stmt->errno . ")" > $stmt->error . BR;
	}
	function fBindOut($stmt){
		echo "Binding Output parameters failed: (" . $stmt->errno . ")" > $stmt->error . BR;
	}
	function fCall($mysqli){
		echo 'Call failed: (' . $mysqli->errno . ') ' . $mysqli->error . BR;
	}
	function fConn($mysqli) {
		echo 'Failed to connect MySQL: (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error . BR;
	}
	function fExec($stmt){
		echo "Execute failed: (" . $stmt->errno .")" . $stmt->error . BR;
	}
	function fFetch($mysqli){
		echo 'Fetched failed: (' . $mysqli->errno . ') ' . $mysqli->error . BR;
	}
	function fGetRs($stmt){
		echo "Getting result set failed: (" . $stmt->errno .")" . $stmt->error . BR;
	}
	function fMulti($stmt){
		echo "Multi query failed: (" . $stmt->errno .")" . $stmt->error . BR;
	}
	function fMultIns($stmt){
		echo "Multi-INSERT failed: (" . $stmt->errno .")" . $stmt->error . BR;
	}
	function fPrep($mysqli) {
		echo 'Prepare failed: (' . $mysqli->errno . ') ' . $mysqli->error . BR;
	}
	function fQuery($mysqli){
		echo 'Query failed: (' . $mysqli->errno . ') ' . $mysqli->error . BR;
	}
	function fSProc($mysqli){
		echo 'Stored procedure creation failed: (' . $mysqli->errno . ') ' . $mysqli->error . BR;
	}
	function fStor($mysqli){
		echo 'Store failed: (' . $mysqli->errno . ') ' . $mysqli->error . BR;
	}
	function fSel($mysqli){
		echo 'Select failed: (' . $mysqli->errno . ') ' . $mysqli->error . BR;
	}
	function fTbl($mysqli) {
		echo 'Table creation failed: (' . $mysqli->errno . ') ' . $mysqli->error . BR;
	}
	function pfConnO($mysqli){
		printf("Connect failed: %s\n".BR, $mysqli->connect_error);
		nodeToDiv('p', ob_get_clean());
		exit();
	}
	function pfConnP(){
		printf("Connect failed: %s\n".BR, mysqli_connect_error());
		nodeToDiv('p', ob_get_clean());
		exit();
	}
?>