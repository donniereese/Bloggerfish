<?php
$path = $HTTP_SERVER_VARS[DOCUMENT_ROOT];
$dir_handle = @opendir($path) or die("Unable to open $path");
print "<div style=\"padding:2px;\">";
echo "<b>Directory Listing of:</b> <i>$path</i>";
while ($file = readdir($dir_handle)) {
	if($file!="." && $file!="..") {
		echo "<div style=\"border: 1px solid #cccccc; background-color: #eeeeee; margin:2px;\"><a href='$file'>$file</a></div>";
	}
}
closedir($dir_handle);
?>