<?php session_start(); ?>
<?php
//Includes
include("config.php.inc");
include("includes/file.php");
include("func.php");

//Basic Functions
if ($action == "kill_session") {
	unset($_SESSION["user"]); 
	unset($_SESSION["pass"]); 
	session_destroy(); 
}

//Parse Server Configuration
$server_config = mysql_fetch_array(mysql_query("select * from configuration where id='1'"));

//Check for a registered User Session
if (!session_is_registered("user") || !session_is_registered("pass")) {
    $status = "guest";
} else {
	$status = "";
}

//If Registered Session:
if ($status != "guest") {
    $stat = mysql_fetch_array(mysql_query("select * from members where user='$_SESSION[user]' and pass='$_SESSION[pass]'"));
    if (empty ($stat[id])) {
		print "$_session[user]";
	    $status = "guest";
    }
    $ctime = time();
    mysql_query("update memebers set lpv=$ctime where id=$stat[id]");
    $ip = $HTTP_SERVER_VARS[REMOTE_ADDR];
    mysql_query("update memebers set ip='$ip' where id=$stat[id]");
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?
if ($browserid = strstr ($HTTP_USER_AGENT, "MSIE")) {
	print "<link rel=\"stylesheet\" href=\"alt_style.css\" />";
	$browserid = "ie";
} else if ($browserid = strstr ($HTTP_USER_AGENT, "Netscape")) {
	print "<link rel=\"stylesheet\" href=\"style.css\" />";
	$browserid = "ns";
} else if ($browserid = strstr ($HTTP_USER_AGENT, "Mozilla")) {
	print "<link rel=\"stylesheet\" href=\"style.css\" />";
	$browserid = "ff";
} else {
	print "<link rel=\"stylesheet\" href=\"style.css\" />";
	$browserid = "na";
}
?>
	<meta name="author" content="Bloggerfish Team" />
	<meta name="publisher" content="Nothing Lost Designs" />
	<meta name="copyright" content="© Copyright 2004 - 2005, Nothing Lost Designs" />
	<meta name="revisit-after" content="2 days" />
	<meta name="keywords" content="free, blog, bloggerfish, online journal, journal, community, blogger, diary, diaries, online diary, web blog, web journal, web diary" />
	<meta name="description" content="A free online community for people to share their thoughts and keep their own journal. The features are endless with bloggerfish.com ." />
	<meta name="audience" content=" All" />
	<meta name="robots" content="ALL" />

<script type='text/javascript' src='scripts/x_core.js'></script>
<script type='text/javascript' src='scripts/x_event.js'></script>
<script type='text/javascript' src='scripts/x_drag.js'></script>
<script type='text/javascript' src='scripts/x_eyeOSwin.js'></script>

<title>Bloggerfish</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
</head>
<body>
<div style="position:relative; background-color:#374149; height:24px; width:100%;">
	<div style="position:absolute;background:url(images/grad24px.png); width:100%; height:100%; opacity:.50; filter:alpha(opacity=50); -moz-opacity:.5;"></div>
	<div style="position:absolute; right:0px; top:0px; height:24px; width:100px; background-color:#b9d300;">
		<div style="position:absolute;background-image:url(images/grad24px.png); width:100%; height:100%; opacity:.40; filter:alpha(opacity=40); -moz-opacity:.4;"></div>
	</div>
</div>
<div id="dock">
	<ul id="dockobjects">
		<li class="dockobject" id="dockobj-write" onmouseover="slide('dockobj-write-icon','up',20);">
			<div class="do-icon" id="dockobj-write-icon"></div>
			<div class="do-title">Writer</div>
		</li>
        <script type="text/javascript">ico("dockobj-write");</script>
		<script type="text/javascript">
			function getpos() {
				win = "dockobj-write";
				getleft = xLeft(win);
				gettop = xTop(win);
				alert ("Left: " + getleft + "\n\n Top: " + gettop);
			}
		</script>
		<li class="dockobject" id="dockobj-mail">
			<div class="do-icon" id="dockobj-mail-icon"></div>
			<div class="do-title">Inbox</div>
		</li>
		<li class="dockobject">
			<div class="do-icon"></div>
			<div class="do-title">...</div>
		</li>
		<li class="dockobject" id="dockobj-info" onclick="getpos()">
			<div class="do-icon" id="dockobj-info-icon"></div>
			<div class="do-title">Info</div>
		</li>
	</ul>
</div>

<br />

<div id="main">
	<div id="header">
		<a id="menu_button" href="index.php">Home</a> 
		<a id="menu_button" href="view.php">Blogs</a> 
		<a id="menu_button" href="profile.php">Members</a> 
		<a id="menu_button" href="about.php">About</a>
		<a id="menu_button" href="about.php?view=faq">FaQ</a>
		<a id="menu_button" href="contact.php">Contact</a>
		<a id="menu_button" href="index.php?action=kill_session">Logout</a>
		<?php
		if ($stat[status] == "admin") {
			print "<a id=\"admin_button\" href=\"admin.php\">Administration</a>";
		}
		?>
	</div>
	<div id="menu">
	<div>
<script type="text/javascript"><!--
google_ad_client = "pub-1725369640819618";
google_ad_width = 468;
google_ad_height = 60;
google_ad_format = "468x60_as";
google_ad_type = "text_image";
google_ad_channel ="";
google_color_border = "191933";
google_color_bg = "333366";
google_color_link = "99CC33";
google_color_url = "FFCC00";
google_color_text = "FFFFFF";
//--></script>
<script type="text/javascript"
  src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
	</div>
	</div>
	<div id="box1">
		<div id="box2">
			<div id="box3">
				<div id="content">
<?php

if ($server_config[maint_down] == '1') {
	print "The server is temporarily down for maintenance for a few minutes. Please check back shortly...";
	include ("footer.php");
	exit;
}

if ($browserid == "ff") {
	print "<div id=\"tab\">";
		print "<div style=\"position:absolute; left:8px; top:8px; right:192px;\">";
			print "You are using a Mozilla-compatible browser and now will have access to new and advanced features and UI for BloggerFish.";
		print "</div>";
		
		if ($status == "guest") {
			print "<div style=\"position:absolute; right:6px; bottom:30px; padding-right:64px; text-align:right; border:0px solid #ffffff;\">";
				print "<form method='post' action='login.php'>";
					print "<b>User: </b> <input type=\"input\" name=\"user\" style=\"color:#526c1f; font-weight:bold; font-size:10px; padding:4px; width:100px; height:12px; background: url(images/logintxtbx_adv.png); border:none;\"><br><br>";
					print "<b>Password: </b> <input type=\"password\" name=\"pass\" style=\"color:#526c1f; font-weight:bold; font-size:10px; padding:4px; width:100px; height:12px; background: url(images/logintxtbx_adv.png); border:none;\"><br>";
					print "<div style=\"position: absolute; right:0px; top:0px;\"><input type=\"submit\" name=\"login\" value=\"\" style=\"background:url(images/key.png); width:64px; height:64px; border:none;\" /></div>";
				print "</form>";
			print "</div>";
		} else {
			print "<div style=\"position:absolute; right:6px; bottom:30px; text-align:right; border:0px solid #ffffff;\">";
				print "<div style=\"font-size:1.4em; padding-bottom:4px;\"><i>Welcome</i>, <b>$stat[user]</b>.</div>";
				print "<div><a>Control Panel</a> - <a>Sign Out</a></div>";
			print "</div>";
		}
	print "</div>";
}
?>