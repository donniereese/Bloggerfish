<?php include("head.php"); ?>

<?php
if (!$confirm) {
	print "There was a problem transmitting the data.  Please check the link and try it again or copy it to your browser.";
	include("foot.php");
	exit;
}
$logres = mysql_num_rows(mysql_query("select * from players where id=$confirm"));
if ($logres <= 0) {
	print "There seems to be a problem.  Either your username is not registered or there was another error.  Please go back and check your registration link again.";
	include("foot.php");
	exit;
} else {
	mysql_query("update players set activ=1 where id=$confirm");
	print "Thank you for confirming your e-mail address.  You may now go back to the main page and log in.  <a href=index.php>Main Page</a>";
}
?>

<?php include("foot.php"); ?>