<?php include("header.php");

if ($view == "submit") {
	$redlight_name = 0;
	$redlight_email = 0;
	$redlight_text = 0;
	
	if (empty($_POST[name])) {
	}
	if (empty($_POST[email])) {
		$redlight_email = 1;
	}
	if (empty($_POST[text])) {
		$redlight_text = 1;
	}
	print "<br>";
	if ($redlight_name == 1) {
	}
	if ($redlight_email == 1) {
		print "<div>You did not give an email. Please do so and submit again.</div>";
	}
	if ($redlight_text == 1) {
		print "<div>You did not descrive your comment. Please do so and submit again.</div>";
	}
	
	if (!empty($redlight_email) || !empty($redlight_text)) {
		
	} elseif (empty($redlight_email) && empty($redlight_text)) {
		$timestamp = time();
		mysql_query("insert into contact (name, email, text, timestamp, view) values('$_POST[name]','$_POST[email]','$_POST[text]','$timestamp','no')") or die("Could not send your comment. Please try again.<br>");
		print "<div>Your comment was sent. Thankyou.</div>";
	}
}

?>
<form method="post" action="contact.php?view=submit">
<b>Name:</b><br>
<input name="name" type="text" value=""><br><br>
<b>Email:</b><br>
<input name="email" type="text" value=""><br><br>
<b>Message:</b><br>
<textarea name="text" rows="16" cols="80" ><?php print"$_POST[text]"; ?></textarea><br><br>
<input type="submit" value="Send">
</form>
<br>

<?php include("footer.php"); ?>