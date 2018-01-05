<html>
<head>
   <title>Shadows of Dawn Map Filler</title>
</head>

<body bgcolor="#4444a4" text="#a3a6f5">

<?php ini_set("max_execution_time", "120"); ?>
<?php include ("config.php"); ?>

<?php
print "<table bgcolor='#222222' align='center' width='80%' height='100px'>";
print "<tr><td align='center' valign='middle'>";

if ($map_sec) {

$in_name="none";
$in_background="images/map/grass1.jpg";
$in_content="none";
$count=0;
$in_x=1;
$in_y=1;
while ($count < 40000) {
   mysql_query("insert into $map_sec (x, y, name, background, content) values('$in_x','$in_y','$in_name','$in_background','$in_content')") or die("Could not add to the map");
   $count = ($count+1);
   if ($in_x == 200) {
      $in_x=0;
      $in_y = ($in_y+1);
   }
   $in_x = ($in_x+1);
}
print "Map $map_sec was successfully filled";
}
print "<br></td></tr></table>";


print "<br><br><table bgcolor='#222222' align='center' width='80%' height='100px'>";
print "<tr><td align='center' valign='middle'>";

print "<form action='creat_map_1mil.php'>";
print "Map:<input type='text' name='map_sec'><br>";
print "<input type='submit' value='Submit'><br><br>";          
print "</form>";

print "</td></tr></table>";
?>

</body>
</html>