<?php include("config.php"); ?>
<html>
<head>

<link rel="stylesheet" type="text/css" href="style.css">

<title>darkblog</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>
<div id="main"> 
  <div id="topmenu"><a href="index.php">Home</a><a href="#">Archive</a><a href="about.php">About 
    Me</a><a href="links.php">Links</a></div>
  <div id="postlayer"> 
    <?php
if ($view == 'showcomments') {
	if (!empty($postid)) {
		$postparent = mysql_fetch_array(mysql_query("select * from posts where id='$postid'"));
		print "<div id=\"postheader\">$postparent[title]</div>";
		print "<div id=\"postbody\">$postparent[body]</div>";
		$postparent[datetime] = date('d F Y  - h:i:s A', $postparent[datetime]);
		print "<div id=\"postheader\" style=\"border-bottom: 1px solid #8a1f2c; font-size: 12px; text-align: right;\">$postparent[datetime]</div><br>";
		print "<br>Comments:<br><br>";
		$list = mysql_query("select * from comments where parent='$postid' order by id desc");
		while($comment = mysql_fetch_array($list)) {
			print "<div id=\"postheader\">$comment[title]</div>";
			print "<div> :$comment[name]</div>";
			print "<div id=\"postbody\">$comment[body]</div>";
			$comment[datetime] = date('d F Y  - h:i:s A', $comment[datetime]);
			print "<div id=\"postheader\" style=\"border-bottom: 1px solid #8a1f2c; font-size: 12px; text-align: right;\">$comment[datetime]</div><br>";
		}
	} else {
		print "<div id=\"system_messege\">You did not choose a post to view comments from.</div>";
	}
}

if ($view == 'comment') {
	
	$sql = mysql_query("select * from blacklist where ip='$HTTP_SERVER_VARS[REMOTE_ADDR]'");
	$blacklistcheck = mysql_num_rows($sql);
	
	if ($blacklistcheck >= 1) {
		print "You have been banned from posting for now.<br><br>";
	} else {
	
		if (!empty($postid)) {
			if ($action == 'add') {
				$datetime = time();
				$title = $_POST[title];
				$body = nl2br($_POST[body]);
				$name = $_POST[name];
				$email = $_POST[email];
				$ip = $HTTP_SERVER_VARS[REMOTE_ADDR];
				
				if (!empty($title)) {
					if (!empty($body)) {
						if (!empty($email)) {
							mysql_query("insert into comments (parent, title, body, name, email, ip, datetime) values('$postid','$title','$body','$name','$email','$ip','$datetime')") or die("Could not post your comment.");
							print "comment added.<br>";
						}
					}
				} else {
					print "Could not add your comment because one or more of the fields was left blank.<br>";
				}
			}
			
			print "<form name=\"commentform\" action=\"index.php?view=comment&action=add&postid=$postid\" method=\"post\">";
			print "<table style=\"border:0px solid #ffffff; width:460px;\">";
			print "<tr>";
			print "<td><b>Name: </b></td>";
			print "<td><input name=\"name\" type=\"input\" value=\"$_POST[title]\" style=\"width:380px;\"></td>";
			print "</tr><tr>";
			print "<td><b>Email: </b></td>";
			print "<td><input name=\"email\" type=\"input\" value=\"$_POST[email]\" style=\"width:380px;\"></td>";
			print "</tr><tr>";
			print "<td><b>Title: </b></td>";
			print "<td><input name=\"title\" type=\"input\" value=\"$_POST[title]\" style=\"width:380px;\"></td>";
			print "</tr><tr>";
			print "<td colspan=2><textarea name=\"body\" style=\"width:444px; height:200px;\">$_POST[body]</textarea></td>";
			print "</tr><tr>";
			print "<td colspan=2><input name=\"submit\" type=\"Submit\" value=\"Comment\"></td>";
			print "</tr>";
			print "</table>";
			print "</form>";
		} else {
			print "<div id=\"system_messege\">You did not choose a post to comment on.</div>";	
		}
	}
}

if ($view == 'main' || !$view) {
	$list = mysql_query("select * from posts order by id desc");
	while($post = mysql_fetch_array($list)) {
		print "<div id=\"postheader\">$post[title]</div>";
		print "<div id=\"postbody\">$post[body]</div>";
		$post[datetime] = date('d F Y  - h:i:s A', $post[datetime]);
		$commentnum = mysql_num_rows(mysql_query("select * from comments where parent='$post[id]'"));
		print "<div id=\"postheader\" style=\"border-bottom: 1px solid #8a1f2c; font-size: 12px; text-align: right;\"><a href=\"index.php?view=comment&postid=$post[id]\">Comment</a> - <a href=\"index.php?view=showcomments&postid=$post[id]\">Show Comments($commentnum)</a> - $post[datetime]</div><br>";
	}
}

?>
    Current date is: 
    <?php
$timestamp = time();
$nice_time = date('d F Y h:i:s A', $timestamp);
print $nice_time;
?>
    <br>
    <br>
    <br>
  </div>
  <div id="stats"> 
    <?php
$fetch = mysql_query("select * from stats where id='1'");
$stats = mysql_fetch_array($fetch);
print "Name: <font id=\"qa\">$stats[firstname] **********</font><br>";
print "Birthdate: <font id=\"qa\">$stats[birthdate]</font><br>";
print "Current Mood: <font id=\"qa\">$stats[mood]</font><br>";
print "Currently Listening: <font id=\"qa\">$stats[music]</font><br>";

include ("calender.php");

include ("subscribe_box.php");
?>
  </div>
</div>

</body>
</html>