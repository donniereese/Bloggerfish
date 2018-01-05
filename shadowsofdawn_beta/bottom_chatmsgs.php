<?php print "<META HTTP-EQUIV=Refresh CONTENT=\"15;url=bottom_chatmsgs.php?userid=$userid\">"; ?>
<?php include ("config.php"); ?>
<style type=text/css>
a {
text-decoration: none;
text-transform: none;
color: black;
}
a:hover {
text-decoration: none;
text-transform: none;
color: 0066cc;
}
body, iframe, select, textarea {
scrollbar-face-color: white;
scrollbar-highlight-color: black; 
scrollbar-shadow-color: black; 
scrollbar-3dlight-color: white; 
scrollbar-arrow-color: black;
scrollbar-track-color: white; 
scrollbar-darkshadow-color: white; 
scrollbar-base-color: white;
}
* { font-family: verdana; font-size: 10px; }
.normal { color: gray; }
.admin { color: #0066cc; }
.event { color: red; }
.me { color: green; }
.whisper { color: tan; }
</style>


<?php
if ($action == chat)  {
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


<?php
print "<body background=mbg.gif>";
include("config.php");
if ($view == chat || !$view) {
	$csel = mysql_query("select * from chat order by id desc limit 15");
	while ($chat = mysql_fetch_array($csel)) {
		print "<b>$chat[user]</b>: $chat[chat]<br>";
	}
}
if ($view == whispers) {
	$csel = mysql_query("select * from chat where target=$userid order by id desc limit 20");
	while ($chat = mysql_fetch_array($csel)) {
		print "<b>$chat[user]</b>: $chat[chat]<br>";
	}
}
if ($view == reference) {
	print "<b><u>Emoticons</b></u><br>";
	print "<table>";
	print "<tr><td><img src=back.gif></td><td>-</td><td> [back]</td></tr>";
	print "<tr><td><img src=bigsmile.gif></td><td>-</td><td> [bigsmile]</td></tr>";
	print "<tr><td><img src=cry.gif></td><td>-</td><td> [cry]</td></tr>";
	print "<tr><td><img src=forward.gif></td><td>-</td><td> [forward]</td></tr>";
	print "<tr><td><img src=frown.gif></td><td>-</td><td> [frown]</td></tr>";
	print "<tr><td><img src=frustrated.gif></td><td>-</td><td> [frustrated]</td></tr>";
	print "<tr><td><img src=mad.gif></td><td>-</td><td> [mad]</td></tr>";
	print "<tr><td><img src=pause.gif></td><td>-</td><td> [pause]</td></tr>";
	print "<tr><td><img src=play.gif></td><td>-</td><td> [play]</td></tr>";
	print "<tr><td><img src=smile.gif></td><td>-</td><td> [smile]</td></tr>";
	print "<tr><td><img src=stop.gif></td><td>-</td><td> [stop]</td></tr>";
	print "<tr><td><img src=suprised.gif></td><td>-</td><td> [suprised]</td></tr>";
	print "<tr><td><img src=tongue.gif></td><td>-</td><td> [tongue]</td></tr>";
	print "</td></tr></table><br>";
	print "<b><u>Commands</b></u><br>";
	print "<table>";
	print "<tr><td>/addadmin [id]</td><td>-</td><td>Adds an admin.</td></tr>";
	print "<tr><td>/deladmin [id]</td><td>-</td><td>Deletes an admin.</td></tr>";
	print "<tr><td>/silence</td><td>-</td><td>Only administrators can speak.</td></tr>";
	print "<tr><td>/unsilence</td><td>-</td><td>Removes silence status.</td></tr>";
	print "<tr><td>/me [action]</td><td>-</td><td>Makes green italic text.</td></tr>";
	print "<tr><td>/whisper [id] [msg]</td><td>-</td><td>Adds a whisper to the ID's whisper window.</td></tr>";
	print "</td></tr></table><br>";
	print "<b><u>Formatting</b></u><br>";
	print "<table>";
	print "<tr><td>[b]text[/b]</td><td>-</td><td>Makes <b>bold</b> text.</td></tr>";
	print "<tr><td>[u]text[/u]</td><td>-</td><td>Makes <u>underline</u> text.</td></tr>";
	print "<tr><td>[i]text[/i]</td><td>-</td><td>Makes <i>italic</i> text.</td></tr>";
	print "<tr><td>[s]text[/s]</td><td>-</td><td>Makes <s>strikeout</s> text.</td></tr>";
	print "</table>";
}
$psel = mysql_query("select * from players where page='Chat'");
$ctime = time();
while ($pl = mysql_fetch_array($psel)) {
	$span = ($ctime - $pl[lpv]);
	if ($span <= 180) {
		if ($pl[rank] == Admin) {
			$on = "$on [!$pl[tag]<A href=view.php?view=$pl[id]>$pl[user]</a> ($pl[id])] ";
		} else {
			$on = "$on [$pl[tag]<A href=view.php?view=$pl[id]>$pl[user]</a> ($pl[id])] ";	
		}	
		$numon = ($numon + 1);
	}
}
print "<font class=normal><center><br><br><br>$on<br>";
$numchat = mysql_num_rows(mysql_query("select * from chat"));
print "There are <b>$numchat</b> chat lines. | <b>$numon</b> players in chat.<br>";
print "[<a href=chatmsgs.php?view=chat&userid=$userid>Chat</a>][<a href=chatmsgs.php?view=whispers&userid=$userid>Whispers</a>][<A href=chatmsgs.php?view=reference&userid=$userid>cML</a>]</font>";
?>
