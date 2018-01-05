<?php $title = "Account Options"; include("header.php"); ?>

Welcome to your account options. Please choose an option.
<ul>
<li><a href=account.php?view=name>Change Name</a>
<li><a href=account.php?view=pass>Change Password</a>
<li><a href=account.php?view=profile>Edit Profile</a>
<li>Edit Contact Information
</ul>

<?php
if ($view == name) {
	print "<form method=post action=account.php?view=name&step=name>";
	print "Change my name to <input type=text name=name>, please. <input type=submit value=Change>";
	print "</form>";
	if ($step == name) {
		if (empty ($name)) { 
			print "Can't do that."; 
			include("footer.php"); 
			exit; 
		}
		$name = strip_tags($name);
		$numn = mysql_num_rows(mysql_query("select * from players where user='$name'"));
		if ($numn > 0) {
			print "That username is taken.";
			include("footer.php");
			exit;
		} else {
			mysql_query("update players set user='$name' where id=$stat[id]");
			print "You changed your name to <b>$name</b>.";
		}
	}
}

if ($view == pass) {
    print "Warning: After changing your password, you must close your browser and re-login to the rpg for your password change to take affect.<br><br>";
	print "<form method=post action=account.php?view=pass&step=changepass>";
	print "Change my password to <input type=text name=name>, please. <input type=submit value=Change>";
	print "</form>";
	if ($step == changepass) {
		if (empty ($name)) { 
			print "Can't do that."; 
			include("footer.php"); 
			exit; 
		}
		$name = strip_tags($name);
			mysql_query("update players set pass='$name' where id=$stat[id]");
			print "You changed your password to <b>$name</b>.";
	}
}

if ($view == profile) {
    $current = mysql_fetch_array(mysql_query("select * from players where id='$stat[id]'"));
	print "<form method=post action=account.php?view=profile&step=change>";
	$this = $current[profile];
	print "<b>Profile:</b><br><textarea name=profile cols=60 rows=10>$this</textarea><br><input type=submit value=Change>";
	print "</form>";
	if ($step == change) {
			mysql_query("update players set profile='$profile' where id=$stat[id]");
			print "Your profile has been changed.";
	}
}

?>
<?php include("footer.php"); ?>