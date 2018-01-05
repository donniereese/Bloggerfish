<?php
require_once("squidly/squidly.php");
$squidly = new squidly();

$squidly->proccess_cookie();
if($squidly->cookie) {
	$squidly->proccess_session();
	// ...
	$squidly->update_cookie();
	
//	Class 	->output(method, message to display.);
//	$squidly->output(alert, "Hey, stop using my screen! :3");	
}

$squidly->parse_log("","<div style=\"background-color:#eee; border:1px solid #ffd; padding:2px; margin:2px;\">","</div>");
?>

This has changed...
<pre>
Are they logged in?
	fetch session
		if session exists, fetch cookie
			if cookie, continue
			else erase session and log them out.

If so, update their information, session, and cookie so they stay logged in.

fetch their personal settings to customize the page, theme, and everything else for their 
account.

(=)
If logged in to registered session:
	Show User Information Pane
Else:
	Show User Login Pane
(/=)
</pre>
