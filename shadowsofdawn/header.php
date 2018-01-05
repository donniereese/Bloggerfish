<?php include("config.php"); session_start(); ?>
<?php
if (!session_is_registered("user") || !session_is_registered("pass")) {
	$view = "session_expired";
	include("index.php");
	exit;
}
$stat = mysql_fetch_array(mysql_query("select * from players where user='$_SESSION[user]' and pass='$_SESSION[pass]'"));
if (empty ($stat[id])) {
	$view = "session_expired";
	include("index.php");
	exit;
}

if ($stat[ban] == "Yes") {
	$view = "This account has been banned.  Please contact the Head GM.<br><br><b>Reason: </b><br>$stat[ban_reason]<br><br>";
	include("index.php");
	exit;
}

$ctime = time();
mysql_query("update players set lpv=$ctime where id=$stat[id]");
$ip = "$HTTP_SERVER_VARS[REMOTE_ADDR]";
mysql_query("update players set ip='$ip' where id=$stat[id]");
mysql_query("update players set page='$title' where id=$stat[id]");

mysql_query("update players set x='$mapx' where id=$stat[id]");
mysql_query("update players set x='$mapy' where id=$stat[id]");
?>

<head>
<title>Shadows of Dawn _(beta)</title>
<!--<link rel=stylesheet href=style.css> -->

<SCRIPT LANGUAGE="JavaScript">
<!-- Idea by:  Nic Wolfe (Nic@TimelapseProductions.com) -->
<!-- Web URL:  http://fineline.xs.mw -->

<!-- This script and many more are available free online at -->
<!-- The JavaScript Source!! http://javascript.internet.com -->

<!-- Begin
function popUp(URL) {
day = new Date();
id = day.getTime();
eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=800,height=400,left = 112,top = 134');");
}
// End -->
</script>


<STYLE>
<!--

* {
	font-family: verdana;
	font-size: 10px;
}

body {
	color: #ffffff;
	margin-left: 4px;
	margin-right: 4px;
	margin-top: 0px;
	margin-bottom: 4px;
	}

a {
text-decoration: none;
text-transform: none;
color: #D6E4A5;
}
a:hover {
text-decoration: none;
text-transform: none;
color: #CAF142;
}
ul {
	margin-left: 0px;
	}
li {
	font-size: 12px;
	margin-left: 0;
	list-style: none;
	padding-left: 14px;
	background: url(images/bullet.jpg) no-repeat 0 50%;
	margin-left: 0px;
	}
#content {
	padding-left: 8px;
	padding-right: 8px;
	padding-top: 4px;
	padding-bottom: 4px;
	}

#map_sys {
	align: center;
	}

#map {
	border: 1px solid #747474;
	}

#map td {
	border: 1px solid #747474;
	}

#menu {
	padding-top: 4px;
	padding-bottom: 4px;
	margin-left: 4px;
	padding-right: 0px;
	}
#menu_item {
	font-size: 12px;
	text-decoration: none;
	color: #94BF00;
	padding-left: 16px;
	background: url(images/bullet.jpg) no-repeat 0 50%;
	}
#menu_item:hover {
	font-size: 12px;
	text-decoration: none;
	color: #C6FF00;
	padding-left: 16px;
	background: url(images/bullet.jpg) no-repeat 0 50%;
	}

#sitemap {
	font-size: ;
	}

#sitemap li {
	list-style: none;
	padding-left: 14px;
	background: url(images/bullet.jpg) no-repeat 0 50%;
	}

#sitemap li ul {
	font-size: %;
	}

#sitemap li ul li ul li {
	padding-left: 14px;
	background: url(images/bullet.jpg) no-repeat 0 50%;
	}
-->
</STYLE>


</head>


<BODY BGCOLOR="#202020">
<table cellpadding="0" cellspacing="0" border="0" style="align:center">
	<tr>
		<td colspan="3"><IMG SRC="images/void_02.jpg" WIDTH=792 HEIGHT=132 ALT=""></td>
	</tr>
	<tr>
		<td colspan="3"><IMG SRC="images/spacer.gif" WIDTH=792 HEIGHT=4 ALT=""></td>
	</tr>	
	<tr>
		<td width="20px"><IMG SRC="images/void_05.jpg" WIDTH="20px" HEIGHT="132"></td>
		<td id="menu" width="768px" height="132" background="images/void_06.jpg" valign="top">
<?php
print "<table border=0 cellpadding=0 cellspacing=0 width=100%><tr>";
print "<td colspan=3 align=center>";

print "<b>$stat[user]</b> ($stat[id]) <> ";
print "<b>Level:</b> $stat[level] ";
$expn = (($stat[level] * 50) + ($stat[level] * 15));
$pct = (($stat[exp]/$expn) * 100);
$pct = round($pct,"0");
print "<b>Exp:</b> $stat[exp]/$expn ($pct%) ";
print "<b>Health:</b> $stat[hp]/$stat[max_hp] ";
print "<b>Energy:</b> $stat[energy]/$stat[max_energy]";

print "</td></tr><tr><td width=100px valign=top>";

print "<b>Credits:</b> $stat[credits]<br>";
print "<b>Bank:</b> $stat[bank]<br>";
print "<b>Platinum:</b> $stat[platinum]<br>";
if ($stat[mines] > 0) {
	print "<b>Burelia:</b> $stat[burelia]<br>";
	print "<b>Alethite:</b> $stat[alethite]<br>";
}
?>
</td><td align="center" valign=middle>
<b>Navigation</b>

<table border=0 width=90% style="align:center;">
<tr>
<td>
<a id="menu_item" href=stats.php>Overview</a><br>
<a id="menu_item" href=updates.php>Updates</a><br>
<a id="menu_item" href=equip.php>Equipment</a><br>
<?php
$numlog = mysql_num_rows(mysql_query("select * from log where unread='F' and owner=$stat[id]"));
print "<a id=\"menu_item\" href=log.php>Log</a> [$numlog]<br>";
?>
<a id="menu_item" href=map.php>Map</a><br>
</td>
<td valign=top>
<a id="menu_item" href=city.php>Indocron</a><br>
<a id="menu_item" href=battle.php>Battle Arena</a><br>
<?php
$healneed = (($stat[max_hp] - $stat[hp]) * 10);
print "<a id=\"menu_item\" href=hospital.php>Hospital</a> [$healneed cr]<br>";
?>
<?php
if ($stat[tribe]) {
	print "<a id=\"menu_item\" href=tribes.php?view=my>My Tribe</a><br>";
}
$newmail = mysql_num_rows(mysql_query("select * from mail where owner=$stat[id] and new='NEW'"));
print "<a id=\"menu_item\" href=mail.php>Mail</a> [$newmail]<br>";
?>
</td>
<td valign=top>
<a id="menu_item" href=bank.php>The Bank</a><br>
<a id="menu_item" href=forums.php?view=topics>Forums</a><br>
<?php
$psel = mysql_query("select * from players where page='Chat'");
$ctime = time();
while ($pl = mysql_fetch_array($psel)) {
	$span = ($ctime - $pl[lpv]);
	if ($span <= 180) {
		$numoc = ($numoc + 1);
	}
}
$numoc = ($numoc + 0);
print "<a id=\"menu_item\" href=chat.php>Chat</a> -  [$numoc]<br>";
?>
<a id="menu_item" href=account.php>Account Options</a><br>
<a id="menu_item" href=login.php?view=logout>Log Out</a><br>
</td>
<td valign=top>
<a id="menu_item" href=help.php>Help</a><br>
<?php
if ($stat[rank] == Admin) {
	print "<a id=\"menu_item\" href=admin.php>Admin</a>";
}
?>
</td>
</tr>
</table>

</td><td width="200px">
<iframe src="users_online.php" name="users_online" width="100%" height="112px" align="center" frameborder="0" marginwidth="0" marginheight="0" scrolling="YES"></iframe>
</td>
</tr></table>

		</td>
		<td width="4px"><IMG SRC="images/void_08.jpg" WIDTH=4 HEIGHT=132 ALT=""></td>
	</tr>
	<tr>
		<td colspan="3"><IMG SRC="images/spacer.gif" WIDTH=792 HEIGHT=4 ALT=""></td>
	</tr>
	<tr>
		<td colspan="3"><IMG SRC="images/void_11.jpg" WIDTH=792 HEIGHT=20></td>
	</tr>
	<tr>
		<td id="content" colspan="3" height="288" width="768px" valign="top" background="images/void_12.jpg">
<?php
$jchance = rand(1,100000);
$jchance2 = rand(1,100000);
if ($jchance == $jchance2 || $code == gimmejug) {
	print "<table cellpadding=0 cellspacing=0 class=td width=100%>";
	print "<tr><td style=\"border-bottom: solid black 1px;\" align=center bgcolor=eeeeee><b>Juggernaut Core</b></td></tr>";
	print "<tr><td>";
	$numj = mysql_num_rows(mysql_query("select * from core where name='Juggernaut' and owner=$stat[id]"));
	if ($numj <= 0) {
		print "You found the <b>Juggernaut Core</b>! The most powerful deafult Core in the game.<br>";
		mysql_query("insert into core (owner,name,type,ref_id,power,defense) values($stat[id],'Juggernaut','Secret',101,10,10)");
	} else {
		print "You found the <b>Juggernaut Core</b>! It's jealousy of your other Juggernaut makes it leave in a huff.";
	}
	print "</td></tr></table><br>";
}

if ($stat[hp] <= "0") {
	$title = "Limbo";
	print "<b>$title</b><br><br>";
	$self = $_SERVER['PHP_SELF'];
	$dir = $_SERVER['DOCUMENT_ROOT'];
	$self = str_replace("/shadowsofdawn/", "", $self);
	
//	print "Dir: $dir<br>";
//	print "File Name: $self<br>";
	
	if ($self == "limbo.php") {
	} else {
		include("limbo.php");
	}
}
?>

