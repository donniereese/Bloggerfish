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
  <div id="postheader" style="border-bottom: 1px solid #9f1f2f;">SI - Related:</div>
	<a href="http://www.self-injury.net" targe="_blank">SelfInjury: A Struggle</a><br>
	<a href="http://gabrielle.self-injury.net/" targe="_blank">Safe Haven</a><br>
	<a href="http://s.webring.com/hub?page=1&ring=bus&list" targe="_blank">Bodies Under Siege (excelent webring)</a><br>
	<a href="http://www.angelfire.com/az3/lost/index.html" targe="_blank">The abyss that is me...</a><br>
	<a href="http://www.recoveryourlife.com/" targe="_blank">Recover Your Life</a><br>
	<a href="http://p210.ezboard.com/bswcforum" targe="_blank">Our Bodies, Our Canvas</a><br>
	<a href="" targe="_blank"></a><br>
	<a href="" targe="_blank"></a><br>
	<a href="" targe="_blank"></a><br>
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