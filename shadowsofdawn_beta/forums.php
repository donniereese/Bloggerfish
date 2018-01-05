<?php $title = "Forums"; include("header.php"); ?>
<table width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td width="100%" bgcolor="#0B0C09">
<img src=forums.jpg>
</td></tr></table>
<?php

// The Topic List
if ($view == topics) {
	if ($stat[rank] == Admin) {
		print "<form method=post action=forums.php?action=delete>";
		print "Delete Post number <input type=text name=num> <input type=submit value=Delete>."; 
		print "</form>";
	}
	$flist = mysql_query("select * from forum order by id asc");
	while ($forumlist = mysql_fetch_array($flist)) {
		print "<b style=\"font-size:20px;\">$forumlist[title]</b><br>";
		
		$tsel = mysql_query("select * from topics where parent='$forumlist[id]' order by id asc");
		print "<table><tr><td>     </td><td><b><u>#</u></b></td><td width=150><u><b>Topic</td><td width=100><u><b>Starter</td><td width=50><b><u>Replies</td></tr>";
		while ($topic = mysql_fetch_array($tsel)) {
			$replies = mysql_num_rows(mysql_query("select * from replies where topic_id=$topic[id]"));
			print "<tr><td>     </td><td>$topic[id]</td><td><a href=forums.php?topic=$topic[id]>$topic[topic]</a></td><td>$topic[starter]</td><td>$replies</td></tr>";
		}
		print "</table>";
	}
	
	print "<br><br>";
	print "</center><form method=post action=forums.php?action=addtopic>";
	print "Add Topic:<br><input type=text name=title2 value=Title>";
	print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	print "<select name=\"forum\">";
	$flist = mysql_query("select * from forum order by id asc");
	while ($forumlist = mysql_fetch_array($flist)) {
		print "<option value=\"$forumlist[id]\">$forumlist[title]";
	}
	print "</select>";
	print "<br><textarea name=body cols=80 rows=14>Body</textarea><br><input type=submit value=\"Add Topic\"></form>";
}

// View Topic
if ($topic) {
	$topicinfo = mysql_fetch_array(mysql_query("select * from topics where id=$topic"));
	if (empty ($topicinfo[id])) {
		print "No such topic.";
		include("footer2.php");
		exit;
	}
	print "<center><br><table class=td width=98% cellpadding=0 cellspacing=0><tr><td style=\"border-bottom: solid black 1px;\" bgcolor=#111111><b>$topicinfo[topic]</b> by $topicinfo[starter] (<a href=forums.php?view=topics>back</a>)</td></tr>";
	print "<tr><td>$topicinfo[body]</td></tr></table><br>";
	
	$rsel = mysql_query("select * from replies where topic_id=$topicinfo[id] order by id asc");
	while ($reply = mysql_fetch_array($rsel)) {
		print "<center><table class=td width=98% cellpadding=0 cellspacing=0><tr><td bgcolor=#111111 style=\"border-bottom: solid black 1px;\"><b>$reply[starter]</b> says... (<a href=forums.php?view=topics>back</a>)</td></tr>";
		print "<tr><td>$reply[body]</td></tr></table><br>";
	}

	print "</center><form method=post action=forums.php?reply=$topicinfo[id]>";
	print "Add Reply:<br><textarea name=rep cols=110 rows=14>Body</textarea><br><input type=submit value=\"Add Reply\"></form>";
}

// Add Topic
if ($action == addtopic) {
	if (empty ($title2) || empty ($body) || empty($forum)) {
		print "You must fill all fields.";
		include("footer2.php");
		exit;
	}
	$body = strip_tags($body);
	$body = nl2br($body);
	mysql_query("insert into topics (topic, body, starter, parent) values('$title2', '$body', '$stat[user]', '$forum')") or die("Could not add topic.");
	print "Added topic. Click <a href=forums.php?view=topics>here</a> to go back to the topic list.";
}

// Add Reply
if ($reply) {
$exists = mysql_num_rows(mysql_query("select * from topics where id=$reply"));
	if ($exists <= 0) {
		print "No such topic.";
		include("footer2.php");
		exit;
	}
	if (empty ($rep)) {
		print "You must fill out all fields.";
		include("footer2.php");
		exit;
	}
	$rep = strip_tags($rep);
	$rep = nl2br($rep);
mysql_query("insert into replies (starter, topic_id, body) values('$stat[user]', $reply, '$rep')") or die("Could not add reply.");
print "Reply added. Click <a href=forums.php?topic=$reply>here</a>.";
}

// Delete Topic
if ($action == delete) {
mysql_query("delete from topics where id=$num");
print "<a href=forums.php?view=topics>Refresh</a>";
}


?>

<?php
include("footer.php");
?>
