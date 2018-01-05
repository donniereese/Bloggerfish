<?php
function open($fname) {
	$homedir = "/home/.moselle/ororon/bloggerfish.com/";
	$fileloc = $homedir.$fname;
	$fp = @fopen($fileloc, "r");
	$filecontents = file_get_contents($fileloc);
	$filecontents = htmlspecialchars($filecontents);
	fclose($fp);
	
	return $filecontents;
}

function save($fname) {
	$loadcontent = "index.php";
	if($save_file) {
		$savecontent = stripslashes($savecontent);
		$fp = @fopen($loadcontent, "w");
		if ($fp) {
			fwrite($fp, $savecontent);
			fclose($fp);
		}
	}
	$fp = @fopen($loadcontent, "r");
	$loadcontent = fread($fp, filesize($loadcontent));
	$loadcontent = htmlspecialchars($loadcontent);
	fclose($fp);
}
?>