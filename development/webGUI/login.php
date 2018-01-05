<?php
include ("squidly/config.php.inc");

session_start();

if (!$_POST[user] || !$_POST[pass]) {

	print "<html>";
	print "<head>";
	print "<link rel=\"stylesheet\" type=\"text/css\" href=\"style.css\">";
	print "</head>";
	print "<body>";

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
	
	print "</body>";
	print "</html>";
	
	exit;
}
$user = $_POST['user'];
$pass = $_POST['pass'];

$logres = mysql_num_rows(mysql_query("select * from members where user='$_POST[user]' and pass='$_POST[pass]'"));

if ($logres <= 0) {
	print "Login failed. If you have not already, please signup. Otherwise, check your spelling and login again.";
	exit;
} else {
	$_SESSION['user'] = $_POST['user'];
	$_SESSION['pass'] = $_POST['pass'];
	
	print "<html>";
	print "<head>";
	print "<link rel=\"stylesheet\" type=\"text/css\" href=\"style.css\">";
	print "</head>";
	print "<body>";
	
	print "<meta http-equiv='refresh' content='5;url=index.php'>";
	print "";
	print "<div style=\"background: #000000; text-align: center; margin: 0 auto; width: 100%; height: 100%;\">";
	print "<div style=\"border: 8px solid #ffffff; color: #ffffff; background: #000000; width: 400px; position: relative; top: 200px;\">";
	print "Welcome to Blogger Fish!! You are now logged in.<br><br><center>If your browser does not automatically redirect you to the main community site, then please click <a href=index.php>here</a> to continue..</center>";
	print "</div>";
	print "</div>";
	
	print "</body>";
	print "</html>";
}
?>