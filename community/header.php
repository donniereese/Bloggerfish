<?php session_start(); ?>
<?php
include("config.php");
if (!session_is_registered("user") || !session_is_registered("pass")) {
    $status = "guest";
}
If ($status != "guest") {
    $stat = mysql_fetch_array(mysql_query("select * from memebers where user='$user' and pass='$pass'"));
    if (empty ($stat[id])) {
	    print "Invalid login.";
	    exit;
    }
}
If ($status != "guest") {
    $ctime = time();
    mysql_query("update memebers set lpv=$ctime where id=$stat[id]");
    $ip = "$HTTP_SERVER_VARS[REMOTE_ADDR]";
    mysql_query("update memebers set ip='$ip' where id=$stat[id]");
}
?>

<html>
<head>

<link rel="stylesheet" type="text/css" href="style.css">

<title>Community</title>
</head>
<body>
