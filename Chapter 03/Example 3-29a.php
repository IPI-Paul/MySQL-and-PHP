<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-29 Alternatives</title>
		<script>
			function popDiv(inners) {document.getElementsByName("retStr")[0].innerHTML = inners;}
			function popTbl(inners) {document.getElementsByName("retRes")[0].innerHTML = inners;}
		</script>
		<?php
			include '../IPI/settings.php';
			include IPI.'IPI Functions.php';

			function func(){
				$mysqli = ConnDb();

				$stmt = $mysqli->prepare("select 1 as _one, 'Hello' as _two from dual");
				$stmt->execute();
				$res = $stmt->result_metadata();
				ob_start();
				var_dump($res->fetch_fields());
				$myDiv =  str_replace('"', '&quot;', str_replace("\n", '\n', ob_get_clean()));
				$myTbl = str_replace('"', '&quot;', str_replace("\n", '\n', retTbls($stmt->result_metadata())));
				echo "alert('".$myDiv."'); popDiv('<pre>".$myDiv."</pre>'); popTbl('".$myTbl."');";
			}
		?>
	</head>
	<body>
		<p>
		<h1>Prepared statements metadata</h1>
		<hr />
		<div name="retStr"></div>
		<table name="retRes" width="100%"></table>
		<br />
		<input type="button" onclick="<?php func(); ?>" value="View Meta Data" />
		</p>
		<?php include $tmpl.'get date.php'; ?>
	</body>
</html>