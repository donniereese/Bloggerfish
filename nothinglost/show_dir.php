<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>

<?

$dir_array = array();

//define the path as relative
$path = "images";

//using the opendir function
$dir_handle = @opendir($path) or die("Unable to open $path");

echo "Directory Listing of $path<br/>";

//running the while loop
while ($file = readdir($dir_handle)) {
	$dir_array[] = $file;
	if($file!="." && $file!="..") {
		echo "<a href='$file'>$file</a><br/>";
	}
}

//closing the directory
closedir($dir_handle);

//counting the array elements
$num_array = count($dir_array);

//random number through array
$rand_num = rand(0,$num_array);

print "$dir_array[$rand_num]";

//
print "<img src=\"" . $path . "/" . $dir_array[$rand_num] . "\">";



?>



</body>
</html>
