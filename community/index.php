<?php include("header.php"); include("config.php"); ?>

<div id="main">
	<div id="header">header</div>
	<div id="content">
		<?php
//	if ($stat[rank] == Admin) {
//		print "<form method=post action=forums.php?action=delete>";
//		print "Delete Post number <input type=text name=num> <input type=submit value=Delete>."; 
//		print "</form>";
//	}
	$flist = mysql_query("select * from forum order by id asc");
	while ($forumlist = mysql_fetch_array($flist)) {
		print "<b id=\"mainpage_forumlist_topicheader\">$forumlist[title]<br>";
		
		$tsel = mysql_query("select * from topics where parent='$forumlist[id]' order by id asc");
		print "<table id=\"mainpage_forumlist\"><tr>";
		print "<td></td><td><b><u>#</u></b></td>";
		print "<td width=140><u><b>Topic</b></td>";
		print "<td width=100><u><b>Starter</b></td>";
		print "<td width=30><b><u>Replies</b></td>";
		print "</tr>";
		while ($topic = mysql_fetch_array($tsel)) {
			$replies = mysql_num_rows(mysql_query("select * from replies where topic_id=$topic[id]"));
			print "<tr>";
			print "<td></td><td>$topic[id]</td>";
			print "<td><a href=forums.php?topic=$topic[id]>$topic[topic]</a></td>";
			print "<td>$topic[starter]</td>";
			print "<td>$replies</td></tr>";
		}
		print "</table>";
	}
	
//	print "<br><br>";
//	print "</center><form method=post action=forums.php?action=addtopic>";
//	print "Add Topic:<br><input type=text name=title2 value=Title>";
//	print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
//	print "<select name=\"forum\">";
//	$flist = mysql_query("select * from forum order by id asc");
//	while ($forumlist = mysql_fetch_array($flist)) {
//		print "<option value=\"$forumlist[id]\">$forumlist[title]";
//	}
//	print "</select>";
//	print "<br><textarea name=body cols=80 rows=14>Body</textarea><br><input type=submit value=\"Add Topic\"></form>";
		?>
	</div>
</div>

<?php include("footer.php"); ?>