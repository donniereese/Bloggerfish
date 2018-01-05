<?php include("config.php"); ?>
<html>
<head>

<link rel="stylesheet" type="text/css" href="style.css">

<title>darkblog</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>
<div id="main"> 
  <div id="topmenu"><a href="index.php">Home</a><a href="#">Archive</a><a href="about.php">About 
    Me</a><a href="links.php">Links</a></div>
  <div id="postlayer"> 
    <?php
?>
    &deg;Dieing <b>1</b> day at a time...&deg;<br><br><br>
	<div style="text-align:center; margin:0px;">
	<div style=" width:160px; height:160px; border:1px solid #666666;">For...<br><font style="font-size:80px; color:lime; font-weight:normal;">&sect;</font></div>
	</div>
	<br>
    <?php
print "<br><br>";
?>
  </div>
  <div id="stats"> 
    <?php
$fetch = mysql_query("select * from stats where id='1'");
$stats = mysql_fetch_array($fetch);
print "Name: <font id=\"qa\">$stats[firstname] **********</font><br>";
print "Birthdate: <font id=\"qa\">$stats[birthdate]</font><br>";
print "Current Mood: <font id=\"qa\">$stats[mood]</font><br>";
print "Currently Listening: <font id=\"qa\">$stats[music]</font><br>";
include ("subscribe_box.php");
?>
  </div>
</div>

</body>
</html>