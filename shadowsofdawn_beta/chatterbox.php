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
<html>
<head>
<title>Shadows of Dawn Chat</title>
<link rel=stylesheet href=style.css>
</head>
<body>
<table border="0" align="center" valign="top" cellpadding="0" cellspacing="0">
<tr>
<td colspan=3><img src="images/chat_top.jpg" width=792 height=20 alt=""></td>
</tr><tr>
<td background="images/border_left.jpg" width="12" valign="top">
<img src="images/chat_top_left.jpg" width=12 height=48 alt="">
</td>
<td width="768" height="300" bgcolor="#2E3B48" style="background-image: url(images/chat_background.jpg); background-position: center top; background-repeat: no-repeat;">

<?php print "<iframe src=chatmsgs.php?userid=$stat[id] name=iframe id=iframe frameborder=0 width=100% height=100% style='filter: alpha(opacity=40)'></iframe>"; ?>

</td>
<td background="images/border_right.jpg" width="12" valign="top">
<img src="images/chat_top_right.jpg" width=12 height=48 alt="">
</td>
</tr><tr>
<td colspan=3><img src="images/chat_divider.jpg" width=792 height=24 alt=""></td>
</tr><tr>

<td background="images/border_left.jpg" width="12" valign="top"></td>
<td width="768" bgcolor="#2E3B48">

<form method=post action=chatterbox.php?action=chat>
[<a href=chatterbox.php>refresh</a>] <input type=text size=55 name=msg> <input type=submit value=Chat>

<?php
if ($action == chat) {
	if ($msg) {
		$c = explode(" ",$msg);
		$msg = strip_tags($msg);
		$msg = str_replace("[back]","<img src=back.gif>",$msg);
		$msg = str_replace("[bigsmile]","<img src=bigsmile.gif>",$msg);
		$msg = str_replace("[cry]","<img src=cry.gif>",$msg);
		$msg = str_replace("[forward]","<img src=forward.gif>",$msg);
		$msg = str_replace("[frown]","<img src=frown.gif>",$msg);
		$msg = str_replace("[frustrated]","<img src=frustrated.gif>",$msg);
		$msg = str_replace("[mad]","<img src=mad.gif>",$msg);
		$msg = str_replace("[pause]","<img src=pause.gif>",$msg);
		$msg = str_replace("[play]","<img src=play.gif>",$msg);
		$msg = str_replace("[smile]","<img src=smile.gif>",$msg);
		$msg = str_replace("[stop]","<img src=stop.gif>",$msg);
		$msg = str_replace("[suprised]","<img src=suprised.gif>",$msg);
		$msg = str_replace("[tongue]","<img src=tongue.gif>",$msg);
		$msg = str_replace("[b]","<b>",$msg);
		$msg = str_replace("[u]","<u>",$msg);
		$msg = str_replace("[i]","<i>",$msg);
		$msg = str_replace("[s]","<s>",$msg);
		$msg = str_replace("[/b]","</b>",$msg);
		$msg = str_replace("[/u]","</u>",$msg);
		$msg = str_replace("[/i]","</i>",$msg);
		$msg = str_replace("[/s]","</s>",$msg);
		$msg = str_replace("[code]","<font face=\"courier new\" class=normal>",$msg);
		$msg = str_replace("[/code]","</font>",$msg);
		$config = mysql_fetch_array(mysql_query("select * from chat_config where id=1"));
		
		if ($config[silence] == N || $stat[rank] == Admin) {
			if (($c[0] == "/whisper") && ($c[1]) && ($c[2])) {
				$whisper = str_replace("$c[0]","",$msg);
				$whisper = str_replace("$c[1]","",$whisper);
				mysql_query("insert into chat (target,user,chat) values($stat[id],'<font class=whisper>WHISPER TO ID $c[1]</font>','$whisper')");
				mysql_query("insert into chat (target,user,chat) values($c[1],'<font class=whisper>WHISPER FROM ID $stat[id]</font>','$whisper')");
			} elseif ($c[0] == "/silence" && $stat[rank] == Admin) {
				mysql_query("update chat_config set silence='Y' where id=1");
				mysql_query("insert into chat (user,chat) values('<font class=event>SILENCE</font>','ID $stat[id] has turned silence mode on.')");
			} elseif ($c[0] == "/unsilence" && $stat[rank] == Admin) {
				mysql_query("update chat_config set silence='N' where id=1");
				mysql_query("insert into chat (user,chat) values('<font class=event>UN-SILENCE</font>','ID $stat[id] has turned silence mode off.')");
			} elseif ($c[0] == "/adminsay" && $c[1] && $stat[rank] == Admin) {
				$adminsay = str_replace("$c[0]","",$msg);
				mysql_query("insert into chat (user,chat) values ('<font class=admin>$stat[user]</font>','<font class=admin>$adminsay</font>')");
			} elseif ($c[0] == "/addadmin" && $c[1] && $stat[id] == 1) {
				mysql_query("insert into chat (user,chat) values('<font class=event>ADMIN ADDED</font>','ID $c[1] is now an admin.')");
				mysql_query("update players set rank='Admin' where id=$c[1]");
			} elseif ($c[0] == "/deladmin" && $c[1] && $stat[id] == 1) {
				mysql_query("insert into chat (user,chat) values('<font class=event>ADMIN REMOVED</font>','ID $c[1] is no longer an admin.')");
				mysql_query("update players set rank='Member' where id=$c[1]");
			} elseif ($c[0] == "/me" && $c[1]) {
				$action = str_replace("$c[0]","",$msg);
				mysql_query("insert into chat (user,chat) values('<font class=me>ACTION</font>','<font class=me><i>$stat[user] $action</i></font>')");
			} else {
				if ($stat[rank] == Admin) {
					$user = "!$stat[tag]<font class=admin>$stat[user]</font>";
				} else {
					$user = "<font class=normal>$stat[tag]$stat[user]</font>";
				}
				mysql_query("insert into chat (user,chat) values('$user','<font class=normal>$msg</b></u></s></i></font></font>')");
			}
		}
		
		if (($c[0] == "/attack") && ($c[1]) && ($c[2])) {
		    $action = str_replace("$c[0]","",$msg);
		    mysql_query("insert into chat (user,chat) values('<font class=me>ACTION</font>','<font class=me><i>$stat[user] attacks $c[1] for $c[2] damage in a fake battle!</i></font>')");
		}
	}
}
?>

</form>
</td>
<td background="images/border_right.jpg" width="12" valign="top"></td>
</tr><tr>
<td colspan=3><img src="images/chat_bottom.jpg" width=792 height=20 alt=""></td>
</tr>
</table>
</body>
</html>