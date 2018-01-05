<html>
<head>
<title>Shadows of Dawn _(beta)</title>
<link rel=stylesheet href=style.css>
</head>
<body>


<div>
<div><img src="images/void_02.jpg"></div>

<?php
if ($view == "session_expired") {
	print "You were logged out of your account because you have been inactive.  Please log in again.";
}
?>

<form method=post action=login.php?view=login>
<table>
<tr><td>User:</td><td><input type=text name=user></td></tr>
<tr><td>Pass:</td><td><input type=password name=pass></td></tr>
<tr><td colspan=2 align=center><input type=submit value=Login></td></tr>
</form>
</table>

<?php include("foot.php"); ?>