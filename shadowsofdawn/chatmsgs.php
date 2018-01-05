<?php print "<META HTTP-EQUIV=Refresh CONTENT=\"5;url=chatmsgs.php?userid=$userid\">"; ?>
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
print "<body>";
include("config.php");
if ($view == chat || !$view) {
	$csel = mysql_query("select * from chat order by id desc limit 15");
	while ($chat = mysql_fetch_array($csel)) {
		print "<b>$chat[user]</b>: $chat[chat]<br>";
	}
}
if ($view == whispers) {
	$csel = mysql_query("select * from chat where target=$stat[id] order by id desc");
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
