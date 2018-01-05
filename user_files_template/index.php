<?php
include ("../../config.php.inc");
include ("config.php");
include ("../../functions.php");

if ($view == "main" || !$view) {
	include ("../../user_header.php");
	if (!$user_id) {
		print "You did not select a user.";
	} else {
		$userstats = mysql_fetch_array(mysql_query("select * from members where id='$user_id'"));
		if (empty($userstats)) {
			print "That user does not exist in the BloggerFish database.";
		} else {
		?>

<table style="width:734px;">
	<tr>
		<td colspan=2>
			<font  style="font-size:32px; color:#668899; font-weight:bold;"><?php print "$userstats[user]"; ?></font>
			<br />
		</td>
	</tr>
	<tr>
		<td style="border:0px solid #ffffff; padding: 0px; vertical-align: top;">
			<table style="border:4px solid #668899; background-color: #222244; margin-bottom:4px; width:374px;">
				<tr>
					<td><b>Gender: </b></td>
					<td><?php print "$userstats[sex]"; ?><br></td>
				</tr>
				<tr>
					<td><b>Email: </b></td>
					<td><?php print "$userstats[email]"; ?></td>
				</tr>
				<tr>
					<td colspan=2><br><br></td>
				</tr>
				<tr><td><b>AIM: </b></td><td><?php print "$userstats[aim]"; ?><br></td></tr>
				<tr><td><b>MSN: </b></td><td><?php print "$userstats[msn]"; ?><br></td></tr>
				<tr><td><b>Yahoo: </b></td><td><?php print "$userstats[yahoo]"; ?><br></td></tr>
			</table>
			<div style="border:4px solid #668899; background-color: #252533; margin:0px; margin-bottom:4px;vertical-align: top; width:366px;">
				<font size='4'><b>About Me:</b></font><br>
				<?php print "$userstats[bio]"; ?>
			</div>
		</td>
		<td style="border:0px solid #ffffff; vertical-align: top;">
			<div style="border:4px solid #668899; background-color: #252533; margin-bottom:4px; width: 346px; vertical-align: top;">
			<font style="font-size:14px; font-weight:bold;">Blogs:</font><br />
			<?php
			print "<table style=\"width:100%;\">";
			$count = mysql_query("select * from blogs where owner='$user_id' order by id desc");
			while ($blogcount = mysql_fetch_array($count)) {
				if (empty ($blogcount)) {
					print "<tr><td><center><h4>This owner has not created a blog yet.</h4></center></td></tr>";
				} else {
					$postcount = mysql_num_rows(mysql_query("select * from posts where blog='$blogcount[id]'"));
					print "<tr><td width='90%' style='border-left:4px solid #eeeeee;'> <b> ";
					print "<a href=\"index.php?view=blog&blog=$blogcount[id]\">$blogcount[title]</a></b></td>";
					print "<td width='10%' style=\"text-align:right;\">";
					print "<b>$postcount</b>";
					print "</td></tr>";
				}
			}
			print "</table>";
			?>
			</div>
			<div style="border:4px solid #668899; background-color: #252533; margin-bottom:4px; width: 346px; vertical-align: top;">
				<font style="font-size:14px; font-weight:bold;">Comments:</font><br /><br />
					Comments have been deactivated for the time being.<br />
				<br />
				<form method="post" action="index.php?action=add_friend&member_name=<?php print "$userstats[user]"; ?>">
					<input name="member_name" type="input" value="" style="width:90%;"><br />
					<textarea name="message" style="width:90%; height:120px;"></textarea><br />
					<input type="submit" value="Send">
				</form>
			</div>
		</td>
	</tr>
</table>

<?php
		}
	}	
	include ("../../user_footer.php");
}

if ($view == 'blog') {
	if (!$blog) {
		include ("../../user_header.php");
		print "<center><b>You did not choose a blog.<br>Go <a href='../../view.php'>BACK</a> and choose one.</b></center>";
		include ("../../user_footer.php");
		exit;
	}
	$bloginfo = mysql_fetch_array(mysql_query("select * from blogs where id='$blog'"));
	$userinfo = mysql_fetch_array(mysql_query("select * from members where id='$bloginfo[owner]'"));
	
	if ($bloginfo[password]) {
	}
	
	print <<<pagetop
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<STYLE>
<!--
pagetop;

	if (!empty($bloginfo[css])) {
		print $bloginfo[css];
	} else {
		$class = new controls();
		$standardstyle = $class->print_standardstyle();
		print $standardstyle;
	}
	
	print <<<pagetop
-->
</STYLE>

<title>Untitled Document</title>
</head>

<body>

<div id="content">
	<div id="header">
		
	</div>
	<div id="main">
		<div id="topmenu"><a href="index.php">Home</a><a href="#">Archive</a><a href="about.php">About Me</a><a href="links.php">Links</a></div>

pagetop;
	
	
	if(!isset($_GET['page'])) {
		$page = 1;
	} else {
		$page = $_GET['page'];
	}
	
	$max_results = $bloginfo[postperpage];
	
	// Figure out the limit for the query based on the current page number.
	$from = (($page * $max_results) - $max_results);
	
	// Perform MySQL query on only the current page number's results
	$blogposts = mysql_query("SELECT * FROM posts where blog='$blog' order by id desc LIMIT $from, $max_results");
	
	while ($posts = mysql_fetch_array($blogposts)) {
		$bloginfo = mysql_fetch_array(mysql_query("select * from blogs where id='$blog'"));
		$commentnum = mysql_num_rows(mysql_query("select * from comments where post='$posts[id]'"));
		if (empty ($commentnum)) {
			$commentnum = "0";
		}
		
		$class = new controls();
		$posts[post] = $class->parse_post($posts[post]);
		
		$datetime = date("h:ia m/d/y",$posts[timestamp]);
		
		print <<<post
		<div id="post">
			<div id="post_header">$posts[title]</div>
			$posts[post]
			<div id="post_footer">
			
			<a href="index.php?view=showcomments&postid=$posts[id]&blogid=$blog" alt="View Comments">$commentnum Comments</a>
			<a href="index.php?view=showcomments&action=comment&postid=$posts[id]&blogid=$blog" alt="View Comments">Comment</a>
			-
			$datetime
			
			</div>
		</div>
post;
	}
	
	// Figure out the total number of results in DB:
	$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM posts where blog='$blog'"),0);
	
	// Figure out the total number of pages. Always round up using ceil()
	$total_pages = ceil($total_results / $max_results);
	
	// Build Page Number Hyperlinks
	print "<center>Select a Page<br>";
	
	// Build Previous Link
	if($page > 1){
		$prev = ($page - 1);
		print "<a href=".$_SERVER['PHP_SELF']."?view=blog&blog=$blog&page=$prev\"><<Previous</a>&nbsp;";
	}
	
	for($i = 1; $i <= $total_pages; $i++){
		if(($page) == $i){
			print "$i&nbsp;";
		} else {
			print "<a href=".$_SERVER['PHP_SELF']."?view=blog&blog=$blog&page=$i\">$i</a>&nbsp;";
		}
	}
	
	// Build Next Link
	if($page < $total_pages){
		$next = ($page + 1);
		print "<a href=\"".$_SERVER['PHP_SELF']."?view=blog&blog=$blog&page=$next\">Next>></a>";
	} 
	print "</center>";
	
	print <<<belowpost
	
	</div>
	<div id="bottommenu">...</div> 
	<div id="sidebar">
		<div id="stats"> 
	
belowpost;
	
	print "<b>User: </b>" . $userinfo[user] . "<br>";
	print "<b>Age: </b>" . $userinfo[age] . "<br>";
	print "<b>Email: </b>" . $userinfo[email] . "<br>";
	print "<b>Bio: <br>" . $userinfo[bio];
	
	print "		</div>";
	print "	</div>";
	print "</div>";
}


if ($view == 'showcomments') {
	if (!empty($postid)) {
		$postparent = mysql_fetch_array(mysql_query("select * from posts where id='$postid'"));
		$bloginfo = mysql_fetch_array(mysql_query("select * from blogs where id='$postparent[blog]'"));
		$userinfo = mysql_fetch_array(mysql_query("select * from members where id='$bloginfo[owner]'"));
		$datetime = date('d F Y  - h:i:s A', $postparent[timestamp]);
	
	if ($bloginfo[password]) {
	}

		
		print <<<pagetop
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<STYLE>
<!--
pagetop;

	if (!empty($bloginfo[css])) {
		print $bloginfo[css];
	} else {
		$class = new controls();
		$standardstyle = $class->print_standardstyle();
		print $standardstyle;
	}
	
	print <<<pagetop
-->
</STYLE>

<title>Untitled Document</title>
</head>

<body>

<div id="content">
	<div id="header">
		
	</div>
	<div id="main">
		<div id="topmenu"><a href="index.php">Home</a><a href="#">Archive</a><a href="about.php">About Me</a><a href="links.php">Links</a></div>

pagetop;
		
		print <<<post
		<div id="post">
			<div id="post_header">$postparent[title]</div>
			$postparent[post]
			<div id="post_footer">
				$datetime			
			</div>
		</div>
post;

		print "<br>";
		print "<div style=\"font-weight:bold; font-size: 16px;\">Comments:</div><br>";
		$list = mysql_query("select * from comments where post='$postid' order by id desc");
		while($comment = mysql_fetch_array($list)) {
			print "<div id=\"postheader\">$comment[title]</div>";
			print "<div> :$comment[user]</div>";
			print "<div id=\"postbody\">$comment[comment]</div>";
			$comment[timestamp] = date('d F Y  - h:i:s A', $comment[timestamp]);
			print "<div id=\"postheader\" style=\"border-bottom: 1px solid #8a1f2c; font-size: 12px; text-align: right;\">$comment[datetime]</div><br>";
		}
		
		print "</div>";
		print "<div id=\"bottommenu\">...</div>"; 
		print "<div id=\"sidebar\">";
		print "<div id=\"stats\">"; 
		
		print "<b>User: </b>" . $userinfo[user] . "<br>";
		print "<b>Age: </b>" . $userinfo[age] . "<br>";
		print "<b>Email: </b>" . $userinfo[email] . "<br>";
		print "<b>Bio: <br>" . $userinfo[bio];
		
		print "</div>";
		print "</div>";
		print "</div>";
		
		
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



/*
if ($view == "comment") {
	if (!empty($postid)) {
		
		if ($action == 'comment') {
			print "<form name='editform' method='post' action='index.php?view=comment&action=comment&step=postcomment&postid=$postid&blogid=$blogid'>";
			if ($status == 'guest') {
				print "<input name='user' type='hidden' value='$status'>";
			} else {
				print "<input name='user' type='hidden' value='$stat[user]'>";
			}
			print "<input name='postid' type='hidden' value='$postid'>";
			print "<input name='blogid' type='hidden' value='$blogid'>";
			print "<script src='editor.js'></script>"; 
			print "<table width=''>";
			print "<tr><td valign='top' align='right'><b>Options:</b></td>";
			print "<td bgcolor='#92A6B7'>";
			print <<<editormenu
			<input type='button' value='bold' name='bold' onclick="javascript:tag('b', '[b]', 'bold*', '[/b]', 'bold', 'bold');">
			<input type='button' value='italic' name='italic' onclick="javascript:tag('i', '[i]', 'italic*', '[/i]', 'italic', 'italic');">
			<input type='button' value='underline' name='underline' onclick="javascript:tag('u', '[u]', 'underline*', '[/u]', 'underline', 'underline');">
			<input type='button' value='strike' name='strike' onclick="javascript:tag('s', '[s]', 'strike*', '[/s]', 'strike', 'strike');">
			<br>
			<img src="images/smilies/icon_smile.gif" alt=":)" onclick="javascript:smile(':)');">
			<img src="images/smilies/icon_biggrin.gif" alt=":D" onclick="javascript:smile(':D');">
			<img src="images/smilies/icon_cry.gif" alt=":*(" onclick="javascript:smile(':*(');">
			<img src="images/smilies/icon_arrow.gif" alt="->" onclick="javascript:smile('->');">
			<img src="images/smilies/icon_sad.gif" alt=":(" onclick="javascript:smile(':(');">
			<img src="images/smilies/icon_confused.gif" alt=":?" onclick="javascript:smile(':?');">
			<img src="images/smilies/icon_mad.gif" alt="x(" onclick="javascript:smile('x(');">
			<img src="images/smilies/icon_idea.gif" alt="!:)" onclick="javascript:smile('!:)');">
			<img src="images/smilies/icon_redface.gif" alt=":#)" onclick="javascript:smile(':#)');">
			<img src="images/smilies/icon_rolleyes.gif" alt="8)" onclick="javascript:smile('8)');">
			<img src="images/smilies/icon_wink.gif" alt=";)" onclick="javascript:smile(';)');">
			<img src="images/smilies/icon_surprised.gif" alt=":o" onclick="javascript:smile(':o');">
			<img src="images/smilies/icon_razz.gif" alt=":p" onclick="javascript:smile(':p');">
			<b>(Click a smily to insert it.)</b>
			</td></tr>
			<tr><td valign='top' align='right'><b>Post:</b></td>
			<td><textarea name='content' rows='10' cols='60' onKeyPress="javascript:txtcount('content');"></textarea></td></tr>
editormenu;
			print "<tr><td><input type=submit value='Post'></td><td align='right'><input type='text' name='counter' value='0' size='4' style='background: #EDECE8; border:#EDECE8 solid 0px;'></tr>";
			print "</table>";
			print "</form>";
			
			if ($step == 'postcomment') {
				if (empty ($content)) {
					print "Something was not filled out.";
				} else {
				
					$class = new controls();
					$posts[post] = $class->parse_post($posts[post]);
					
//					$date = date("m/d/y", time());
//					$time = date("h:i a", time());
					
					$datetime = time();
					
					if ($status == 'guest') {
						$username = 'guest';			
					} else {
						$username = $stat[user];
					}
				
					mysql_query("insert into comments (post, user, comment, timestamp) values('$postid', '$username','$content','$datetime')") or die("Could not add post for some reason.");
					print "Comment was successfully posted";
					print "<meta http-equiv='refresh' content='2;url=view.php?view=blog&blog=$blogid'>";  
				}
			}
		}
	
	} else {
		include ("header.php");
		print "<center><b>You did not choose a member's post.<br>Go <input type='button' value='Back' onclick='history.back(-1)'> and choose one.</b></center>";
		include ("footer.php");
	}
	
	$bloginfo = mysql_fetch_array(mysql_query("select * from blogs where id='$blogid'"));
	$blogposts = mysql_query("select * from posts where blog='$blogid' order by id desc");
	$commentposts = mysql_query("select * from comments where post='$postid' order by id desc");
	$userinfo = mysql_fetch_array(mysql_query("select * from members where id='$bloginfo[owner]'"));
	
	$bloginfo[page_template] = str_replace("{title}",$bloginfo[title],$bloginfo[page_template]);
	
	print "$bloginfo[page_template]";
	
	while ($posts = mysql_fetch_array($commentposts)) {
		$bloginfo = mysql_fetch_array(mysql_query("select * from blogs where id='$blogid'"));
		$bloginfo[post_template] = str_replace("{posttitle}","<b>Posted By: " . $posts[user],$bloginfo[post_template]);
		$bloginfo[post_template] = str_replace("{post}",$posts[comment],$bloginfo[post_template]);
		$bloginfo[post_template] = str_replace("{postdate}",$posts[timestamp],$bloginfo[post_template]);
		$bloginfo[post_template] = str_replace("{posttime}",$posts[timestamp],$bloginfo[post_template]);
		$bloginfo[post_template] = str_replace("{commentnum}","&nbsp;",$bloginfo[post_template]);
		$bloginfo[post_template] = str_replace("{comment} -","&nbsp;&nbsp;",$bloginfo[post_template]);
		
		print "$bloginfo[post_template]";
	}
	
	$bloginfo[about_template] = str_replace("{user}",$userinfo[user],$bloginfo[about_template]);
	$bloginfo[about_template] = str_replace("{bio}",$userinfo[bio],$bloginfo[about_template]);
	$bloginfo[about_template] = str_replace("{age}",$userinfo[age],$bloginfo[about_template]);
	$bloginfo[about_template] = str_replace("{email}",$userinfo[email],$bloginfo[about_template]);
	$bloginfo[about_template] = str_replace("{firstname}",$userinfo[firstname],$bloginfo[about_template]);
	$bloginfo[about_template] = str_replace("{lastname}",$userinfo[lastname],$bloginfo[about_template]);
	$bloginfo[about_template] = str_replace("{gender}",$userinfo[sex],$bloginfo[about_template]);
	print "$bloginfo[about_template]";
}
*/
?>