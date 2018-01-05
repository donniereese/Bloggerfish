<?php session_start(); ?>
<?php

include("config.php.inc");

$server_config = mysql_fetch_array(mysql_query("select * from server_config where id='1'"));

$status = "";
if (!session_is_registered("user") || !session_is_registered("pass")) {
    $status = "guest";
}
if ($status != "guest") {
    $stat = mysql_fetch_array(mysql_query("select * from members where user='$user' and pass='$pass'"));
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
$class = new admin();
$printlog = no;
$where = $HTTP_SERVER_VARS['REMOTE_ADDR'];
$what_action = $HTTP_SERVER_VARS['PHP_SELF'];
$log = $stat[user] . "[" . $stat[id] . "]" . "\n" . $where . "\n" . $what_action . "\n" . $timestamp;
$class->send_log($stat[user], $where, $log, $printlog);

?>

<html>
<head>
<?
if ($name = strstr ($HTTP_USER_AGENT, "MSIE")) {
	print "<link rel=\"stylesheet\" href=\"alt_style.css\">";
} else if ($name = strstr ($HTTP_USER_AGENT, "Netscape")) {
	print "<link rel=\"stylesheet\" href=\"style.css\">";
} else {
	print "<link rel=\"stylesheet\" href=\"style.css\">";
}
?>
	<Meta name="Author" content="Bloggerfish Team">
	<Meta name="Publisher" content="Nothing Lost Designs">
	<Meta name="Copyright" content="© Copyright 2004 - 2005, Nothing Lost Designs">
	<Meta name="Revisit-After" content="4 days">
	<Meta name="Keywords" content="free, blog, bloggerfish, online journal, journal, community, blogger, diary, diaries, online diary, web blog, web journal, web diary">
	<Meta name="Description" content="A free online community for people to share their thoughts and keep their own journal. The features are endless with bloggerfish.com .">
	<Meta name="Audience" content=" All">
	<Meta name="Robots" content="ALL">
<script type='text/javascript' src='scripts/gclock.js'></script>
<script type='text/javascript' src='scripts/x_core.js'></script>
<script type='text/javascript' src='scripts/x_event.js'></script>
<script type='text/javascript' src='scripts/x_drag.js'></script>
<script type='text/javascript' src='scripts/x_eyeOSwin.js'></script>

<STYLE>
<!--
body {
	overflow: hidden;
	}

#header {
	background: url(images/v3_01.png) right no-repeat;
	width:784px;
	margin: 0px;
	padding-right: 16px;
	padding-top: 18px;
	text-align: right;
	font-size: 10px;
	height:38px;
	}

input, textarea {
	border: 1px solid #ccccccs;
	background: #ffffff;
	font-size: 12px;
	}

a {
	color: #99CC33;
	}

#mainbutton {
	background:url(images/desktop/main.png);
	}

#mainbutton:hover {
	background:url(images/desktop/maindown.png);
}

	

/* Left Down Corner */
.binfesq {
	position:absolute;
	left: 0px;
	width:13px;
	height:21px;
	background: url(eyeOS/system/themes/NuoveXT/gfxwin/4.png);
	background-repeat: no-repeat; 
	background-position: center left;
}

/* Right Down Corner */
.binfdre {
	position:absolute;
	right: 1px;
	width:21px;
	height:21px;
	background: url(eyeOS/system/themes/NuoveXT/gfxwin/6.png);
	background-repeat: no-repeat; 
	background-position: center left;
}

/* Down Border */
.binfcen {
	position:absolute;
	bottom: 0px;
	right: 22px;
	left: 13px;
	height:21px;
	background: url(eyeOS/system/themes/NuoveXT/gfxwin/5.png);
	background-repeat: repeat-x; 
}

/* Right border */
.bdre {
	position:absolute;
	top: 21px;
	bottom: 21px;
	right: 0px;
	width:13px;
	background: url(eyeOS/system/themes/NuoveXT/gfxwin/10.png);
	background-repeat: repeat-y; 
	background-position: top right;	
}

/* Window content */
.txt {
	position: absolute;
	top: 21px;
	bottom: 21px;
	right: 10px;
	left: 0px;
	text-align: left;
	border-left: 1px solid #D3D2D2;
	background: url(eyeOS/system/themes/NuoveXT/gfxwin/9.png);
	background-repeat: repeat-x; 
	background-position: top center;
	z-index: 100;
	background-color: #FEFEFE;
}

.interior {
	position:absolute;
	overflow: auto;
	top: 2px;
	right: 5px;
	left: 8px;
	bottom: 8px;
}

/* Window Foot */
.peu {
	position:absolute;
	bottom: 0px;
	width:100%;
	height:21px;
	text-align: left;
	cursor: move;
}
/* Other items in windows */
/* Maximize button */
.boto {
	position:absolute;
	right: 26px;
	top: 3px;
	width:13px;
	height:13px;
	z-index: 150;
}

/* Resize image */
.botobaix {
	position:absolute;
	right: -13px;
	top: -1px;
	width:13px;
	height:13px;
	z-index: 150;
	cursor: se-resize;
	background: url(eyeOS/system/themes/NuoveXT/gfxwin/resize.png);

-->
</STYLE>


<title>Bloggerfish</title>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
</head>
<body style="background: url(images/v3_05.jpg);">

<div style=" visibility:collapse;">
	<script type="text/javascript">
	<!--
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
	//-->
	</script>
	<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
</div>

<div id="movelayer" class="window" style="width:600px; height:200px; overflow:hidden; position:absolute; top:250px; left:160px; z-index: 10000;">
	<div style="position:absolute; left:0px; top:0px; height:24px; width:8px;"><img src="images/desktop/topleft.png"></div>
	<div style="position:absolute; right:0px; top:0px; height:24px; width:8px;"><img src="images/desktop/topright.png"></div>
	<div style="position:absolute; left:8px; right:8px; top:0px; height:24px; background: url(images/desktop/toptile.png);"></div>
	<div id="movelayerDBar" class="window.bar" style="position:relative;cursor:move; margin:0px;padding:0px; color:#EEEEEE;height: 24px; text-align: left;"></div>
	
	<div style="position:absolute; top:24px; left:0px; width:8px; bottom:16px; background:url(images/desktop/leftborder.png);"></div>
	
	<div style="position:absolute; top:24px; left:8px; right:8px; bottom:16px; background-color:#47495f; text-align:left; color:#eeeeff;">Text!</div>
	
	<div style="position:absolute; top:24px; right:0px; width:8px; bottom:16px; background:url(images/desktop/rightborder.png);"></div>
	
	<div style="position:absolute; left:0px; bottom:0px; height:16px; width:8px;"><img src="images/desktop/bottomleft.png"></div>
	<div style="position:absolute; right:0px; bottom:0px; height:16px; width:8px;"><img src="images/desktop/bottomright.png"></div>
	<div style="position:absolute; left:8px; right:8px; bottom:0px; height:16px; background: url(images/desktop/bottomtile.png);"></div>
	
	<div id="movelayerDDow" style="height:16px; position:absolute; right:0px; left:0px; bottom:0px; cursor:move;"></div>
	<div id="movelayerRBtn" style="height:8px; width:8px; position:absolute; right:0px; bottom:0px; background:url(images/desktop/resize.png); cursor:se-resize;"></div>
</div>
<script type="text/javascript">
win = "movelayer";
Setup (win);
</script>

<div id="barmenu" style="background: url(images/desktop/desktop_03.png); position:absolute; right:8px; bottom:8px; width:784px; height:24px; text-align:right;">
	<div id="mainbutton" style="position:absolute; width:120px; height:16px; top:4px; left:4px;">
	</div>
	<div style="text-align:left; padding-left:128px;">
		<a onclick="idshow='header';xShow(idshow);">here</a>
	</div>
	<div class="Gclock" GcFormat='%g~%j %a' style="position:absolute; right:4px; top:4px; color:#a6ba92; font-weight: bold; font-size:12px; text-align: center; width:64px; font-family: Verdana, Arial;"></div>
</div>

<div id="main">
	<div id="header" style="position:absolute; top:0px; left:0px; visibility:hidden;">
		<a id="menu_button" href="index.php">Home</a> 
		<a id="menu_button" href="view.php">Blogs</a> 
		<a id="menu_button" href="profile.php">Members</a> 
		<a id="menu_button" href="about.php">About</a>
		<a id="menu_button" href="about.php?view=faq">FaQ</a>
		<a id="menu_button" href="contact.php">Contact</a>
		<?php
		if ($stat[status] == "admin") {
			print "<a id=\"admin_button\" href=\"admin.php\">Administration</a>";
		}
		?>
	</div>

</div>
</body>
</html>