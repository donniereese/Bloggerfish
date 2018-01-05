<?php $title = "View"; include("header.php"); ?>

<?php
if ($edit == icon) {
mysql_query("update players set icon='$icon' where id=$stat[id]");
print "update complete.";
}

$view = mysql_fetch_array(mysql_query("select * from players where id=$view"));
if (empty ($view[id])) {
	print "No such player.";
	include("footer.php");
	exit;
}
print "<table width=100% border=0 cellpadding=0 cellspacing=0><tr>";
print "<td bgcolor=#333333 width=100 style='border-bottom:1px #ffffff solid; border-right:1px #ffffff solid'><img width=100 height=100 src=$view[icon]></td>";
print "<td bgcolor=#333333 style='border-bottom:1px #ffffff solid'>";
print "<b><center><font style='font-size:12pt; style:bold; color:#ff0000;'>$view[user]</font></b><br>Member</center>";
print "</td></tr></table>";
print "<center><b><u>$view[user]</b></u> ($view[id])</center><br>";

print "<table><tr><td width=40% valign=top>";

print "Rank: $view[rank]<br>";
print "Last Seen: $view[page]<br>";
print "Age: $view[age]<br><br>";
print "Level: $view[level]<br>";
if ($view[hp] > 0) {
	print "Status: Alive<br>";
} else {
	print "Status: <b>Dead</b><br>";
}
$tribe = mysql_fetch_array(mysql_query("select * from tribes where id=$view[tribe]"));
if ($tribe) {
	print "Tribe: <a href=tribes.php?view=view&id=$view[tribe]>$tribe[name]</a><br>";
} else {
	print "Tribe: None<br>";
}
print "Max HP: $view[max_hp]<br><br>";
print "Record: $view[wins]/$view[losses]<br>";
print "Last Killed: $view[lastkilled]<br>";
print "Last Killed By: $view[lastkilledby]<br><br>";
print "Options: <a href=battle.php?battle=$view[id]>Attack</a>";

print "</td><td width=50% height=90% valign=top>";
print "<b>Profile:</b><br>";
print "<table width=100% height=100% bgcolor=#1E3641><tr><td valign=top>$view[profile]</td></tr></table>";
print "</td><td width=10%><br></td></tr>";
print "<tr><td colspan=3><br></td></tr></table>";

?>

<?php include("footer.php"); ?>