<?php 
//Connecting to the database 
$host = "localhost";
$username = "bloggie"; 
$password = "mightydonniebuddha"; 
$dbh=mysql_connect ($host, $username, $password) or die ('I cannot connect to the database because: ' . mysql_error()); 
mysql_select_db ("bloggie_bloggerfish"); 

$sql = "SELECT * from members"; 
$result = mysql_query($sql); 
echo("&new="); //Say you want the data to be called new in swishmax when loaded 
while ($row2 = mysql_fetch_array($result, MYSQL_ASSOC)) { 
echo($row2['user']."\n"); 
} 
?>