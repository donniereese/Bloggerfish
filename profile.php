<?php
include ("header.php");

if ($view == 'list' || !$view) {	
	if(!isset($_GET['page'])) {
		$page = 1;
	} else {
		$page = $_GET['page'];
	}
	$max_results = 20;
	
// Figure out the limit for the query based on the current page number.
	$from = (($page * $max_results) - $max_results);
// Perform MySQL query on only the current page number's results
	$userlist = mysql_query("SELECT * FROM members where activity!='suspended' order by user asc LIMIT $from, $max_results");	

	print "<br>";
	while ($users = mysql_fetch_array($userlist)) {
		if (empty ($users)) {
			print "There are no users yet...  This is very sad. :(  Or hopefully it is just an error.  Yes, let us hope that!<br>";
		} else {
			print "<a href='users/$users[user]/index.php'>$users[user]</a> - ";
			$blogcount = mysql_num_rows(mysql_query("select * from blogs where owner='$users[id]'"));
			print "<b>$blogcount Blogs - </b>";
			$postcount = mysql_num_rows(mysql_query("select * from posts where owner='$users[id]'"));
			print "<b>$postcount Posts</b>";
			print "<br><br>";
		}
	}
	print "</table>";

	// Figure out the total number of results in DB:
	$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM members where activity!='suspended'"),0);
	
	// Figure out the total number of pages. Always round up using ceil()
	$total_pages = ceil($total_results / $max_results);
	
	// Build Page Number Hyperlinks
	print "Select a Page<br>";
	
	// Build Previous Link
	if($page > 1){
		$prev = ($page - 1);
		print "<a href=".$_SERVER['PHP_SELF']."?view=list&page=$prev\">&lt;&lt;Previous</a>&nbsp;";
	}
	
	for($i = 1; $i <= $total_pages; $i++){
		if(($page) == $i){
			print "<b>[$i&nbsp;]</b>";
		} else {
			print "<a href=".$_SERVER['PHP_SELF']."?view=list&page=$i\">$i</a>&nbsp;";
		}
	}
	
   // Build Next Link
	if($page < $total_pages){
		$next = ($page + 1);
		print "<a href=".$_SERVER['PHP_SELF']."?view=list&page=$next\">Next>></a>";
	}
	include ("footer.php");
}

if ($view == 'profile') {
	if (!$userid) {
		print "You did not select a user.";
	} else {
		$userstats = mysql_fetch_array(mysql_query("select * from members where id='$userid'"));
		if (empty($userstats)) {
			print "That user does not exist in the BloggerFish database.";
		} else {
			print "<table border='0'><tr>";
			print "<td colspan=2><font  size='6' color='#333366'><b>$userstats[user]</b></font><br><br></td></tr>";
			print "<tr><td width='100px'><b>Gender: </b></td><td>$userstats[sex]<br></td></tr>";
			print "<tr><td width='100px'><b>Email: </b></td><td>$userstats[email]</td></tr>";
			print "<tr><td colspan=2><br><br></td></tr>";
			print "<tr><td width='100px'><b>AIM: </b></td><td>$userstats[aim]<br></td></tr>";
			print "<tr><td width='100px'><b>MSN: </b></td><td>$userstats[msn]<br></td></tr>";
			print "<tr><td width='100px'><b>Yahoo: </b></td><td>$userstats[yahoo]<br></td></tr>";
			print "<tr><td colspan=2><br><br></td></tr>";
			print "<tr><td colspan=2><font size='4'><b>About Me:</b></font><br>";
			print "$userstats[bio]</td></tr>";
			print "</table>";
		}
	}	
	include ("footer.php");
}

if ($view == 'edit') {
	if (!$step) {
		$stat[bio] = str_replace("<br />","",$stat[bio]);
		
		print "<table border='0'>";
		print "<form method='post' action='profile.php?view=edit&step=edit'>";
		print "<tr>";
		print "<td colspan='2'><h3>$stat[user]</h3></td>";
		print "</tr><tr>";
		print "<td><b>First Name: </b> </td><td><input type='text' name='firstname' value='$stat[firstname]'></td>";
		print "</tr><tr>";
		print "<td><b>Last Name: </b> </td><td><input type='text' name='lastname' value='$stat[lastname]'></td>";
		print "</tr><tr>";
		print "<td><b>Current Email: </b> </td><td><i>$stat[email]</i></td>";
		print "</tr><tr>";
		print "<td colspan='2'><br></td>";
		print "</tr><tr>";
		print "<td><b>Current Password: </b> </td><td><i>$stat[pass]</i></td>";
		print "</tr><tr>";
		print "<td><b>New Password: </b> </td><td><input type='text' name='newpass'></td>";
		print "</tr><tr>";
		print "<td><b>Verify: </b> </td><td><input type='text' name='passverify'></td>";
		print "</tr><tr>";
		print "<td colspan='2'><br></td>";
		print "</tr><tr>";
		print "<td><b>AIM: </b> </td><td><input type='text' name='aim' value='$stat[aim]'></td>";
		print "</tr><tr>";
		print "<td><b>MSN: </b> </td><td><input type='text' name='msn' value='$stat[msn]'></td>";
		print "</tr><tr>";
		print "<td><b>Yahoo: </b> </td><td><input type='text' name='yahoo' value='$stat[yahoo]'></td>";
		print "</tr><tr>";
		print "<td colspan='2'><br></td>";
		print "</tr><tr>";
		print "<td valign='top'><b>Bio:</b></td><td><textarea name='content' cols='60' rows='10'>$stat[bio]</textarea></td>";
		print "</tr><tr>";
		print "<td colspan='2' align='center'><input type='submit' value='Update Profile'></td>";
		print "</form>";
		print "</table>";
	} elseif ($step == 'edit') {
			  
		$c = explode(" ",$content);
		$content = strip_tags($content ,"<embed>,<img>,<b>,<i>,<u>,<center>");
		$content = nl2br($content);
		$content = str_replace(":)","<img src=images/smilies/icon_smile.gif>",$content);
		$content = str_replace(":D","<img src=images/smilies/icon_biggrin.gif>",$content);
		$content = str_replace(":*(","<img src=images/smilies/icon_cry.gif>",$content);
		$content = str_replace("->","<img src=images/smilies/icon_arrow.gif>",$content);
		$content = str_replace(":(","<img src=images/smilies/icon_sad.gif>",$content);
		$content = str_replace(":?","<img src=images/smilies/icon_confused.gif>",$content);
		$content = str_replace("x(","<img src=images/smilies/icon_mad.gif>",$content);
		$content = str_replace("!:)","<img src=images/smilies/icon_idea.gif>",$content);
		$content = str_replace(":#)","<img src=images/smilies/icon_redface.gif>",$content);
		$content = str_replace("8)","<img src=images/smilies/icon_rolleyes.gif>",$content);
		$content = str_replace(";)","<img src=images/smilies/icon_wink.gif>",$content);
		$content = str_replace(":o","<img src=images/smilies/icon_surprised.gif>",$content);
		$content = str_replace(":p","<img src=images/smilies/icon_razz.gif>",$content);
		$content = str_replace("[b]","<b>",$content);
		$content = str_replace("[u]","<u>",$content);
		$content = str_replace("[i]","<i>",$content);
		$content = str_replace("[s]","<s>",$content);
		$content = str_replace("[url='","<a href='",$content);
		$content = str_replace("']","'>",$content);
		$content = str_replace("[/url]","</a>",$content);
		$content = str_replace("[/b]","</b>",$content);
		$content = str_replace("[/u]","</u>",$content);
		$content = str_replace("[/i]","</i>",$content);
		$content = str_replace("[/s]","</s>",$content);
		
		$bio = $content;
		
		$date = time("m/d/y", time());
		$time = time("h:i a", time());
		
		mysql_query("update members set firstname='$firstname' where id='$stat[id]'") or die("Could not update your profile for some reason.");
		mysql_query("update members set lastname='$lastname' where id='$stat[id]'") or die("Could not update your profile for some reason.");
		
		mysql_query("update members set aim='$aim' where id='$stat[id]'") or die("Could not update your profile for some reason.");
		mysql_query("update members set msn='$msn' where id='$stat[id]'") or die("Could not update your profile for some reason.");
		mysql_query("update members set yahoo='$yahoo' where id='$stat[id]'") or die("Could not update your profile for some reason.");
		if ($newpass) {
			if ($newpass == $passverify) {
				mysql_query("update members set pass='$newpass' where id='$stat[id]'") or die("Could not update your profile for some reason.");
				$_SESSION["pass"] = $newpass;
			} else {
				print "Could not edit your Password.  Your new email did not match the verification.  Please go back and make sure that they match.";
			}
		}
		mysql_query("update members set bio='$bio' where id='$stat[id]'") or die("Could not update your profile for some reason.");
		
		print "<meta http-equiv='refresh' content='1;url=cp.php'>";
	}
	include ("footer.php");
}
?>
