<?php
include("config.php");

print "<html>";
print "<head>";
print "<link rel=\"stylesheet\" type=\"text/css\" href=\"style.css\">";
print "<title>Control Panel</title>";
print "</head>";
print "<body>";

print "<div id=\"adminmenu\">";
print "<a href=\"admin.php\">Main</a> | ";
print "<a href=\"admin.php?view=editor\">New Post</a> | ";
print "<a href=\"#\">Profile</a> | ";
print "<a href=\"index.php\">Return to Blog</a>";
print "</div>";

//variables
$cur_stats = mysql_fetch_array(mysql_query("select * from stats where id='1'"));
$action = "";


print "<div id=\"sidebar\" style=\"position:absolute; left:8px; top:36px; bottom:8px; width:184px;\">";

print "<div style=\"text-align: center; margin:4px; border:1px solid #555555; background: #000000;\">";

print "<div style=\"text-align: center; margin:4px; border:1px solid #555555; background: #222222;\">";
print "<form name=\"update_quickstats\" action=\"admin.php?view=quickstatchange\" method=\"post\">";
print "Mood: <input name=\"mood\" type=\"input\"><br>";
print "Song: <input name=\"song\" type=\"input\" ><br>";
print "<input type=\"submit\" value=\"Change\">";
print "</form>";
print "</div>";

print "<form name=\"update_stats\" action=\"admin.php?view=statchange\" method=\"post\">";
print "First Name: <input name=\"firstname\" type=\"input\"><br>";
print "Last Name: <input name=\"lastname\" type=\"input\" ><br>";
print "Birth Date: <input name=\"birthdate\" type=\"input\"><br>";
print "";
print "";
print "</form>";
print "</div>";

print "</div>";


if ($view == "main" || !$view) {
	print "<div id=\"content\" style=\"position: absolute; left:200px; top:36px; right:8px; bottom:8px;\">";
	print "<dif style=\"border-bottom:1px solid #BF001A; width:400px; font-weight:bold;\">Settings:</div>";
	
	print "</div>";
}



if ($view == 'quickstatchange') {
	if (!empty($_POST[mood])) {
	mysql_query("update stats set mood='$_POST[mood]' where id='1'");
	}
	if (!empty($_POST[song])) {
	mysql_query("update stats set music='$_POST[song]' where id='1'");
	}
}


if ($view == 'post') {
$datetime = time();
$title = nl2br($_POST[title]);
$body = nl2br($_POST[body]);

print "Preview:<br>------------------------------------<br>";
print "<div style=\"font-size:12px; font-weight:normal; width:600px;\">";
print $title . "<br>";
print "-----------------<br>";
print $body . "<br>";
print "-----------------<br>";
print $datetime . "<br>";
print "</div>";
print "------------------------------------<br>";

mysql_query("insert into posts (title, body, datetime) values('$title','$body','$datetime')") or die("Could not add updates.");
	if (!empty($_POST[mood])) {
		mysql_query("update stats set mood='$_POST[mood]' where id='1'");
	}
	if (!empty($_POST[song])) {
		mysql_query("update stats set music='$_POST[song]' where id='1'");
	}
print "Update added.";

$action = "mailupdates";
include ("subscribe.php");

}

print "<div id=\"content\" style=\"position: absolute; left:200px; top:36px; right:8px; bottom:8px;\">";

if ($_GET[view] == "editor") {
	if(empty($_POST[editpostid]) OR !$_POST[editpostid]) {
		print" <form name=\"newpost\" id=\"newpost\" action=\"admin.php?view=post\" method=\"post\">
			<table>
				<tr>
					<td id=\"title\" colspan=\"2\">
						<input name=\"title\" type=\"input\" value=\"\">
					</td>
				</tr>
				<tr>
					<td id=\"body\" colspan=\"2\">
						<textarea name=\"body\"></textarea>
					</td>
				</tr>
				<tr>
					<td id=\"mood\">
						Mood: <input name=\"mood\" type=\"input\" value=\"$cur_stats[mood]\">
					</td>
					<td id=\"newpostsubmit\" rowspan=\"2\">
						<input name=\"submit\" type=\"submit\" value=\"submit\">
					</td>
				</tr>
				<tr>
					<td id=\"song\">
						Song: <input name=\"song\" type=\"input\" value=\"$cur_stats[music]\">
					</td>
				</tr>
			</table>
		</form>
		<br>";
	} else {
		print "Edit Post code here";
	}
} else {
}

print "</div>";

print "</body>";
print "</html>";

?>