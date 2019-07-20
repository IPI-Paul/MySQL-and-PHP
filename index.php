<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>IPI Paul - Learning MySQL and PHP examples</title>
	</head>
	<body>
		<p>
		<h1>Learning MySQL and PHP</h1>
		<h2>Publication: apis-php-en.pdf</h2>
		<h4>Generated on: 2019-04-19 (revision:61764)</h4>
		<hr />
		<div name="retStr"></div>
		<table name="retRes" width="100%"></table>
		<br />
		</p>
	</body>
	<?php 
		include 'IPI/settings.php';
		include 'IPI/IPI Functions.php';
		include '_Templates/get date.php'; 

		ob_start();

		$dir = (isset($_GET['dir']) ? $_GET['dir'] : ".");

		if (is_dir($dir)){
			echo "<h2>Index of $dir:</h2>\n";
			$files = array_diff(scandir($dir), array('..', '.'));
			usort($files, function($a, $b){
				if (is_dir($a) == is_dir($b))
					return strnatcasecmp($a, $b);
				else
					return is_dir($a) ? -1 : 1;
			});
			echo "<table>";
			echo "<tr><td width='250'><a href='?dir=" . urlencode(dirname($dir)) . "'>..</a></td><td></td><td></td></tr>\n";
			foreach ($files as $file){
				if (is_dir($file)){
					echo "<tr><td><a href='?dir=" . urlencode("{$dir}/{$file}") . "'>{$file}</a></td><td></td><td></td></tr>\n";
				} else {
					echo "<tr><td><a href='" . str_replace("'", "&apos;", str_replace('./', '', "{$dir}")."/{$file}") . "' target='_blank'>{$file}</a></td>\n";
					$handle = fopen(str_replace("'", "&apos;", str_replace('./', '', "{$dir}")."/{$file}"), 'rb');
					$bdy = fread($handle, 4096);
					$hdr1 = "<td>";
					$hdr2 = "<td>";
					if (strpos($bdy, "<h1>")) {
						$hdr1 .= sprintf(explode("</h1>", explode("<h1>", str_replace("\\","\\\\", $bdy))[1])[0]);
					}
					if (strpos($bdy, "<h2>")) {
						$hdr2 .= sprintf(explode("</h2>", explode("<h2>", str_replace("\\","\\\\", $bdy))[1])[0]);
					}
					$hdr1 .= "</td>\n";
					$hdr2 .= "</td>\n";
					echo $hdr1 . $hdr2;
					fclose($handle);
				}
			}
			echo "</table>";
		} else if (is_file($dir)){
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename="' .basename($dir) . '"');
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize($dir));
			readfile($dir);
		}

		$dStr = ob_get_clean();
		nodeToDiv('p', $dStr);
		// retTbl($dTbl);
		exit;
	?>
</html>