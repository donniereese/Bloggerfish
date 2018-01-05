<?php error_reporting(E_ALL); ?>
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
if (!$_SESSION['user'] || !$_SESSION['pass']) {
    $status = "guest";
} else {
	$status = "";
}

//If Registered Session:
if ($status != "guest") {
    $stat = mysql_fetch_array(mysql_query("select * from members where user='$_SESSION[user]' and pass='$_SESSION[pass]'"));
    echo "<pre class='button'>"; print_r($stat); echo "</pre>";
    if (empty ($stat[id])) {
	   $status = "guest";
    }
    $ctime = time();
    $ip = $HTTP_SERVER_VARS[REMOTE_ADDR];
    
    mysql_query("update memebers set lpv=$ctime where id=$stat[id]");
    
    mysql_query("update memebers set ip='$ip' where id=$stat[id]");
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link rel="stylesheet" href="style.css">
    
	<meta name="author" content="Bloggerfish Team" />
	<meta name="publisher" content="Nothing Lost Designs" />
	<meta name="copyright" content="� Copyright 2004 - 2007, Nothing Lost Designs" />
	<meta name="revisit-after" content="2 days" />
	<meta name="keywords" content="free, blog, bloggerfish, online journal, journal, community, blogger, diary, diaries, online diary, web blog, web journal, web diary" />
	<meta name="description" content="A free online community for people to share their thoughts and keep their own journal. The features are endless with bloggerfish.com ." />
	<meta name="audience" content=" All" />
	<meta name="robots" content="ALL" />

<script type='text/javascript' src='scripts/x_core.js'></script>
<script type='text/javascript' src='scripts/x_event.js'></script>
<script type='text/javascript' src='scripts/x_drag.js'></script>
<script type='text/javascript' src='scripts/x_eyeOSwin.js'></script>
<script type='text/javascript'>

function liveText(e) {
	var code;
	var line;
	if (!e) var e = window.event;
	if (e.keyCode) code = e.keyCode;
	else if (e.which) code = e.which;
	var character = String.fromCharCode(code);
	if(!line) var line = character;
	else line = line+character;
	contentid = xGetElementById("content");
	contentid.innerHTML = line;
}

function checkKey(e) {
	var key=e.keyCode || e.which;
	contentid = xGetElementById("content");
	contentid.innerHTML = key;
}
</script>

<title>Bloggerfish</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
</head>
<!--<body onkeypress="liveText(event);">-->
<body>
<!--
<div style="position:relative; height:14px; padding:8px 8px 8px 0; margin:0 auto; text-align:right; border:1px solid #ffffff; display:none;">
	<div style="position: absolute; margin:0 auto; width:50px; height:14px; color:#fff; cursor:pointer;">
        <div style="position:absolute; left:0px; top:0px; width:5px; height:14px; background:url(http://localhost/bloggerfish/images/mini_button-left.png);"></div>
		<div style="position:absolute; left:5px; top:0px; width:40px; height:12px; background-color:#6289AF; font-size:12px; text-align:center; padding:0 0 2px 0;">Help</div>
		<div style="position:absolute; right:0px; top:0px; width:5px; height:14px; background:url(images/mini_button-right.png);"></div>
	</div>
</div>
-->
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
			print "<a id=\"admin_button\" href=\"http://www.bloggerfish.com/tower\">Administration</a>";
		}
		?>
	</div>
	<div id="menu">
		<div style="display:none;">
		</div>
	</div>
	<div id="displayframe">
		<div id="backing">
			<div id="workspace">
				<div id="content">
<?php

if ($server_config[maint_down] == '1') {
	print "The server is temporarily down for maintenance for a few minutes. Please check back shortly...";
	include ("footer.php");
	exit;
}


print "<div id=\tab\" style=\"float:top; position:relative; display:none;\">";
if ($status == "guest") {
    print "<div style=\"position:absolute; right:6px; bottom:30px; padding-right:64px; text-align:right; border:0px solid #ffffff;\">";
        print "<form method='post' action='login.php'>";
            print "<b>User: </b> <input type=\"input\" name=\"user\" style=\"color:#526c1f; font-weight:bold; font-size:10px; padding:4px; width:100px; height:12px; background: url(images/logintxtbx_adv.png); border:none;\"><br><br>";
            print "<b>Password: </b> <input type=\"password\" name=\"pass\" style=\"color:#526c1f; font-weight:bold; font-size:10px; padding:4px; width:100px; height:12px; background: url(images/logintxtbx_adv.png); border:none;\"><br>";
            print "<div style=\"position: absolute; right:0px; top:0px;\"><input type=\"submit\" name=\"login\" value=\"\" style=\"background:url(images/key.png); width:64px; height:64px; border:none;\" /></div>";

        print "</form>";
    print "</div>";
} elseif ($status == "admin") {
    print "<div style=\"position:absolute; right:6px; bottom:30px; text-align:right; border:0px solid #ffffff;\">";
        print "<div style=\"font-size:1.4em; padding-bottom:4px;\"><i>Welcome</i>, <b>$stat[user]</b>.</div>";
        print "<div><a>Control Panel</a> - <a>Sign Out</a></div>";
    print "</div>";
}
print "</div>";
?>

<div style="background-color:#E7E3E7; border-bottom:2px solid #111; color:#101410; height:20px; margin: 0 0 4px 0; padding:2px;">
<?php if($status == "guest") { ?>
    <form method="post" action="login.php">
        <b>User: </b> <input type="input" name="user" style="color:#526c1f; font-weight:bold; font-size:10px; padding:4px; width:100px; height:12px; background: url(images/logintxtbx_adv.png); border:none;">
        <b>Password: </b> <input type="password" name="pass" style="color:#526c1f; font-weight:bold; font-size:10px; padding:4px; width:100px; height:12px; background: url(images/logintxtbx_adv.png); border:none;">
        <input type="submit" name="login" value="" style="background:url(images/icon_sets/silky/control_play_blue.png); width:16px; height:16px; border:none;" />
    </form>
    
<?php } else { ?>
    <div style="font-size:1.4em; padding-bottom:4px;">
        <i>Hello</i>, <b><?php echo $stat[user]; ?></b>
        <span>
            <a href="#">Control Panel</a>
            <a href="#">Sign Out</a>
        </span>
    </div>

<?php } ?>
</div>
