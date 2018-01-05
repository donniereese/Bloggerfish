<?php

if ($action == "kill_session") {
	unset($_SESSION["user"]); 
	unset($_SESSION["pass"]); 
	session_destroy(); 
}

include("../config.php.inc");
include("../window.php");

//$server_config = mysql_fetch_array(mysql_query("select * from server_config where id='1'"));

$status = "";
if (!session_is_registered("user") || !session_is_registered("pass")) {
    $status = "guest";
}
if ($status != "guest") {
    $stat = mysql_fetch_array(mysql_query("select * from members where user='$_SESSION[user]' and pass='$_SESSION[pass]'"));
    if (empty ($stat[id])) {
		print "$_session[user]";
	    $status = "guest";
    }
}
if ($status != "guest") {
    $ctime = time();
    mysql_query("update memebers set lpv=$ctime where id=$stat[id]");
    $ip = $HTTP_SERVER_VARS[REMOTE_ADDR];
    mysql_query("update memebers set ip='$ip' where id=$stat[id]");
}

include ("func.php");
//$class = new admin();
//$printlog = no;
//$where = $HTTP_SERVER_VARS['REMOTE_ADDR'];
//$what_action = $HTTP_SERVER_VARS['PHP_SELF'];
//$log = $stat[user] . "[" . $stat[id] . "]" . "\n" . $where . "\n" . $what_action . "\n" . $timestamp;
//$class->send_log($stat[user], $where, $log, $printlog);

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<?
if ($browserid = strstr ($HTTP_USER_AGENT, "MSIE")) {
	print "<link rel=\"stylesheet\" href=\"css/style.css\">";
	$browserid = "ie";
} else if ($browserid = strstr ($HTTP_USER_AGENT, "Netscape")) {
	print "<link rel=\"stylesheet\" href=\"css/style.css\">";
	$browserid = "ns";
} else if ($browserid = strstr ($HTTP_USER_AGENT, "Mozilla")) {
	print "<link rel=\"stylesheet\" href=\"css/style.css\">";
	$browserid = "ff";
} else {
	print "<link rel=\"stylesheet\" href=\"css/style.css\">";
	$browserid = "na";
}
?>
	<meta name="author" content="Bloggerfish Team" />
	<meta name="publisher" content="Nothing Lost Designs" />
	<meta name="copyright" content="&copy; Copyright 2004 - 2005, Nothing Lost Designs" />
	<meta name="revisit-after" content="2 days" />
	<meta name="Keywords" content="free, blog, bloggerfish, online journal, journal, community, blogger, diary, diaries, online diary, web blog, web journal, web diary" />
	<meta name="Description" content="A free online community for people to share their thoughts and keep their own journal. The features are endless with bloggerfish.com ." />
	<meta name="audience" content=" All" />
	<meta name="robots" content="ALL" />

<script type='text/javascript' src='../scripts/x_core.js'></script>
<script type='text/javascript' src='../scripts/x_event.js'></script>
<script type='text/javascript' src='../scripts/x_drag.js'></script>
<script type='text/javascript' src='../scripts/x_eyeOSwin.js'></script>

<title>Bloggerfish</title>
</head>
<body>
<div id="wrap">
	<div id="header">
		<div id="title"></div>
		<div id="cloud"></div>
		<div id="qmenu">
			<div id="background"></div>
			<div id="text">
				<a href="index.php">Home</a> 
				<a href="view.php">Blogs</a> 
				<a href="profile.php">Members</a> 
				<a href="about.php">About</a>
				<a href="about.php?view=faq">FaQ</a>
				<a href="contact.php">Contact</a>
				<a href="index.php?action=kill_session">Logout</a>
				<?php
				if ($stat[status] == "admin") {
					print "<a id=\"admin_button\" href=\"admin.php\">Administration</a>";
				}
				?>
			</div>
		</div>
	</div>
	<div id="main-body">

<!--
<?php
if ($server_config[maint_down] == '1') {
	print "The server is temporarily down for maintenance for a few minutes. Please check back shortly...";
	include ("footer.php");
	exit;
}

if ($browserid == "ff") {
	print "<div style=\"position:relative; top:-8px; left:-8px; width:752px; height:92px; overflow:hidden; background:url(images/usertab.png) bottom; color: #526581;\">";
		print "<div style=\"position:absolute; left:8px; top:8px; right:36px;\">";
			print "You are using a Mozilla-compatible browser and now will have access to new and advanced features and UI for BloggerFish.";
		print "</div>";
		
		print "<div style=\"position:absolute; left:724px; right:8px; top 8px; bottom:8px; border:1px solid #ffffff;\">";
			print "<input style=\"color:#526c1f; font-weight:bold; font-size:10px; padding:4px; width:108px; height:20px; background: url(images/logintxtbx_adv.png); border:none;\"><br><br>";
			print "<input style=\"color:#526c1f; font-weight:bold; font-size:10px; padding:4px; width:108px; height:20px; background: url(images/logintxtbx_adv.png); border:none;\">";
		print "</div>";
		
	print "</div>";
}
?>
-->