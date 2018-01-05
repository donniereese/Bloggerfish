<?php
include ("config.php");
if (!$user || !$pass) {
	print "Please fill out all fields.";
	print "<table align='center' style='border:2px solid #444444;'>";
	print "<tr>";
	print "<td>";
	print "<form method=post action=login.php>";
	print "<table>";
	print "<tr><td>User:</td><td><input type=text name=user></td></tr>";
	print "<tr><td>Pass:</td><td><input type=password name=pass></td></tr>";
	print "<tr><td colspan=2 align=center><input type=submit value=Login></td></tr>";
	print "</form>";
	print "</table>";

	exit;
}
$logres = mysql_num_rows(mysql_query("select * from members where user='$user' and pass='$pass'"));

if ($logres <= 0) {
	print "Login failed. If you have not already, please signup. Otherwise, check your spelling and login again.";
	exit;
} else {
	session_register("user");
	session_register("pass");
	print "<meta http-equiv='Refresh' content='1'; url=index.php'>"; 
	print "Welcome to Blogger Fish!! You are now logged in. If your browser does not automatically redirect you to the main community site, then please click <a href=index.php>here</a> to continue..";
}
?>

