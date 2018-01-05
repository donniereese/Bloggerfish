<?php
include("config.php");

if ($view == 'subscribe') {
	mysql_query("insert into subscription (email) values('$_POST[emailaddy]')") or die("Could not add your email. Please try again later.");
	print "Your email has been added. Thankyou :)";
}

if ($view == 'unsubscribe') {
	mysql_query("update subscription set sendto='N' where email='$_POST[removemail]'") or die("Could not remove your email. Please try again later.");
	print "You're email has been removed from the update system.";
}

if ($action == 'mailupdates') {
	$list = mysql_query("select * from subscription");
	while($sub = mysql_fetch_array($list)) {
		$to = $sub[email]; 
		$from = "bloodywristsanddeadeyes@bloggerfish.com"; 
		$subject = "Bloody Wrists and Dead Eyes Blog Update"; 
		$message = "<b>Bloody Wrists and Dead Eyes</b> blog has been updated.\n The latest is <i>$newpost</i>.\r\n<a href=\"http://www.bloggerfish.com/lostandbloody\">Click Here</a> to view it."; 

		$headers  = "From: $from\r\n"; 

		$success = mail($to, $subject, $message, $headers);
		if ($success) {
			print "The email to $to from $from was successfully sent"; 
		} else {
			print "An error occurred when sending the email to $to from $from";
		}
	}
}

?>