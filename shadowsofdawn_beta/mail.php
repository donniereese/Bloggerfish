<?php $title = "Mail"; include("header.php"); ?>

<?php
if (!$view && !$read) {
	print "What are you going to do?<br><br>
	- <a href=mail.php?view=inbox>Inbox</a><br>
	- <a href=mail.php?view=write>Compose</a>";
}

if ($view == inbox) {
	print "<table>";
	print "<tr><td width=75><b><u>From</td><td width=100><b><u>Subject</td><td align=left width=100><b><u>Checked?</td><td width=50><b><u>Options</td></tr>";
	$msel = mysql_query("select * from mail where owner=$stat[id] order by id desc");
	while ($mail = mysql_fetch_array($msel)) {
		print "<tr><td>$mail[sender]</td><td>$mail[subject]</td><td>";
		print "$mail[new]";
		print "</td><td>- <a href=mail.php?read=$mail[id]>Read</a> - <a href=mail.php?delete=$mail[id]>Delete</a>";
	}
	print "</table>";
	print "<br>[<a href=mail.php?view=inbox&step=clear>Clear Inbox</a>][<a href=mail.php?view=write>Compose</a>]";

	if ($step == clear) {
		print "<br>Mail cleared. (<a href=mail.php?view=inbox>refresh</a>)";
		mysql_query("delete from mail where owner=$stat[id]");
	}
}

if ($view == write) {
	print "[<a href=mail.php?view=inbox>Inbox</a>]<br><br>";
	print "<table>";
	print "<form method=post action=mail.php?view=write&step=send>";
	print "<tr><td>To (ID Number):</td><td><input type=text name=to></td></tr>";
	print "<tr><td>Subject:</td><td><input type=text name=subject></td></tr>";
	print "<tr><td valign=top>Body:</td><td><textarea name=body rows=15 cols=60></textarea></td></tr>";
	print "<tr><td colspan=2 align=center><input type=submit value=Send></td></tr>";
	print "</form></table>";

	if ($step == send) {
		if (empty ($to) || empty ($body)) {
			print "Please fill out all fields.";
			include("footer.php");
			exit;
		}
		if (empty ($subject)) {
			$subject = "None";
		}
		$rec = mysql_fetch_array(mysql_query("select * from players where id=$to"));
		if (empty ($rec[id])) {
			print "No such player.";
			include("footer.php");
			exit;
		}
		mysql_query("insert into mail (sender,owner,subject,body) values('$stat[user]',$to,'$subject','$body')") or die("Could not send mail.");
		mysql_query("insert into log (owner, log) values($to, '<b>$stat[user]</b> has sent you a message.')") or die("Could not add to log.");
		print "You sent mail to $rec[user].";
	}
}

if ($read) {
	$mail = mysql_fetch_array(mysql_query("select * from mail where id=$read"));
	if (empty ($mail[id])) {
		print "No such mail.";
		include("footer.php");
		exit;
	}
	if ($mail[owner] != $stat[id]) {
		print "That's not your mail.";
		include("footer.php");
		exit;
	}
	mysql_query("update mail set new='OLD' where id=$mail[id]");
	print "<b>$mail[sender]</b> says... \"$mail[body]\".<br><br>[<a href=mail.php?view=inbox>Inbox</a>][<a href=mail.php?view=write>Compose</a>]";
}

if ($delete) {
$deletemail = mysql_fetch_array(mysql_query("select * from mail where id=$delete"));
	if (empty ($deletemail)) {
		print "No such mail.";
		include("footer.php");
		exit;
	}
	if ($deletemail[owner] != $stat[id]) {
		print "That's not your mail.";
		include("footer.php");
		exit;
	}
	mysql_query("delete from mail where id=$deletemail[id]");
	print "<br><b>Deleted...<br><br>[<a href=mail.php?view=inbox>Inbox</a>][<a href=mail.php?view=write>Compose</a>]";
}
?>

<?php include("footer.php"); ?>