<?php include("config.php"); session_start(); ?>
<?php
if (!session_is_registered("user") || !session_is_registered("pass")) {
	print "Sesion has expired.";
	exit;
}
$stat = mysql_fetch_array(mysql_query("select * from players where user='$user' and pass='$pass'"));
if (empty ($stat[id])) {
	print "Invalid login.";
	exit;
}
$ctime = time();
mysql_query("update players set lpv=$ctime where id=$stat[id]");
$ip = "$HTTP_SERVER_VARS[REMOTE_ADDR]";
mysql_query("update players set ip='$ip' where id=$stat[id]");
mysql_query("update players set page='$title' where id=$stat[id]");
?>

<head>
<title>Shadows of Dawn _(beta)</title>
<link rel=stylesheet href=style.css>
</head>


<body leftmargin=0 rightmargin=0 topmargin=0 onload="window.status='Shadows of Dawn'">

<table align="center" width="796" border="0" cellpadding="0" cellspacing="0">
<tr>
<td colspan="2"><img src="images/header.jpg" width="796" height="116" alt="Shadows Of Dawn Header"></td>
</tr><tr>
<td align="center" valign="top">

<table width="136" cellpadding="0" cellspacing="0">
<tr>
<td colspan="3"><img src="images/menu_top.jpg" width="136" height="20"></td>
</tr><tr>
<td background="images/border_left.jpg" width="12" valign="top">
<img src="images/menu_top_left.jpg" width="12" height="40" border="0"><br>
</td>
<td width="112" bgcolor="#2E3B48" style="background-image: url(images/menu_background.jpg); background-position: center top; background-repeat: no-repeat;">
<b>Statistics:</b><br>
<?php
print "<center><b><u>$stat[user]</b></u> ($stat[id])</center><br>";
print "<b>Level:</b> $stat[level]<br>";
$expn = (($stat[level] * 50) + ($stat[level] * 15));
$pct = (($stat[exp]/$expn) * 100);
$pct = round($pct,"0");
print "<b>Exp:</b> $stat[exp]/$expn ($pct%)<br>";
print "<b>Health:</b> $stat[hp]/$stat[max_hp]<br>";
print "<b>Energy:</b> $stat[energy]/$stat[max_energy]<br><br>";
print "<b>Credits:</b> $stat[credits]<br>";
print "<b>Bank:</b> $stat[bank]<br>";
print "<b>Platinum:</b> $stat[platinum]<br>";
if ($stat[mines] > 0) {
	print "<b>Burelia:</b> $stat[burelia]<br>";
	print "<b>Alethite:</b> $stat[alethite]<br>";
}
?>
<br>
<b>Navigation</b><br>
- <a href=stats.php>Overview</a><br>
- <a href=updates.php>Updates</a><br>
- <a href=equip.php>Equipment</a><br>
<?php
$numlog = mysql_num_rows(mysql_query("select * from log where unread='F' and owner=$stat[id]"));
print "- <a href=log.php>Log</a> [$numlog]<br><br>";
?>
- <a href=city.php>Indocron</a><br>
- <a href=battle.php>Battle Arena</a><br>
<?php
$healneed = ($stat[max_hp] - $stat[hp]);
print "- <a href=hospital.php>Hospital</a> [$healneed cr]<br>";
?>
<?php
if ($stat[tribe]) {
	print "- <a href=tribes.php?view=my>My Tribe</a><br>";
}
$newmail = mysql_num_rows(mysql_query("select * from mail where owner=$stat[id] and new='NEW'"));
print "- <a href=mail.php>Mail</a> [$newmail]<br>";
?>
- <a href=bank.php>The Bank</a><br><br>
- <a href=forums.php?view=topics>Forums</a><br>
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
print "- <a href=chat.php>Chat</a> [$numoc]<br><br>";
?>
- <a href=account.php>Account Options</a><br>
- <a href=index.php>Log Out</a><br>
- <a href=help.php>Help</a><br>
<?php
if ($stat[rank] == Admin) {
	print "<br>- <a href=admin.php>Admin</a>";
}
?>

<b>Game Stats:</b><br>
<?php
$nump = @mysql_num_rows(mysql_query("select * from players"));
$numw = @mysql_num_rows(mysql_query("select * from equipment where type='W'"));
$numa = @mysql_num_rows(mysql_query("select * from equipment where type='A'"));
print "<b>$nump</b> total players.<br>";
print "<b>$numo</b> players online.<br>";
print "<b>$numw</b> weapons.<br>";
print "<b>$numa</b> armor.<br>";
?>
<br>


<b>Players Online:</b><br>
<iframe src="users_online.php" name="users_online" width="100%" height="200px" align="center" frameborder="0" marginwidth="0" marginheight="0" scrolling="YES"></iframe>
<br>

<b>Vote and Help</b><br>


</td>
<td background="images/border_right.jpg" width="12" valign="top">
<img src="images/content_top_right.jpg" width="12" height="40" alt="" border="0"><br>
</td>
</tr><tr>
<td colspan="3"><img src="images/menu_bottom.jpg" width="136" height="20" alt=""></td>
</table>


</td><td align="center" valign="top">


<table width="656" cellpadding="0" cellspacing="0">
<tr>
<td colspan="3"><img src="images/content_top.jpg" width=656 height=20 alt=""></td>
</tr><tr>
<td background="images/border_left.jpg" width="12" valign="top">
<img src="images/content_top_left.jpg" width="12" height="40" border="0"><br>
</td>
<td width="632" bgcolor="#2E3B48" style="background-image: url(images/content_background.jpg); background-position: center top; background-repeat: no-repeat;">

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
?>
<?php print "<b>$title</b><br><br>"; ?>






</td>
<td background="images/border_right.jpg" width="12" valign="top">
<img src="images/menu_top_right.jpg" width="12" height=20 alt=""><br>
</td>
</tr><tr>
<td colspan=3><img src="images/content_bottom.jpg" width=656 height=20 alt=""></td>
</table>

</td>
</tr><tr>
<td colspan="2" align="center" valign="top">
<a href=mailto:darkabyssdesigns@hotmail.com>Contact</a> | <a href=rules.php>Rules, Guidelines, and Policies</a>
</td>
</tr><tr>
<td colspan="2" align="center" valign="top">

<table cellpadding="0" cellspacing="0">
<tr>
<td colspan=3><img src="images/chat_top.jpg" width=792 height=20 alt=""></td>
</tr><tr>
<td background="images/border_left.jpg" width="12" valign="top">
<img src="images/chat_top_left.jpg" width=12 height=48 alt="">
</td>
<td width="768" height="300" bgcolor="#2E3B48" style="background-image: url(images/chat_background.jpg); background-position: center top; background-repeat: no-repeat;">

<?php print "<iframe src=chatmsgs.php?userid=$stat[id] name=iframe id=iframe frameborder=0 width=100% height=100% style='filter: alpha(opacity=40);'></iframe>"; ?>

</td>
<td background="images/border_right.jpg" width="12" valign="top">
<img src="images/chat_top_right.jpg" width=12 height=48 alt="">
</td>
</tr><tr>
<td colspan=3><img src="images/chat_divider.jpg" width=792 height=24 alt=""></td>
</tr><tr>

<td background="images/border_left.jpg" width="12" valign="top"></td>
<td width="768" bgcolor="#2E3B48">
<?php include ("bottom_chat.php"); ?>
</td>
<td background="images/border_right.jpg" width="12" valign="top"></td>
</tr><tr>
<td colspan=3><img src="images/chat_bottom.jpg" width=792 height=20 alt=""></td>
</tr>
</table>

</td>
</tr>
</table>






</body>
</html>