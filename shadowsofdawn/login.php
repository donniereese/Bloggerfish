<?php include("head.php"); ?>

<?php

include("config.php");

if ($_GET['view'] == 'login') {
	print "Found view...";
	if (!$_GET['user'] || !$_GET['pass']) {
		print "Please fill out all fields.";
		include("foot.php");
		exit;
	}
	$logres = mysql_num_rows(mysql_query("select * from players where user='$user' and pass='$pass'"));
	
	if ($logres <= 0) {
		print "Login failed. If you have not already, please signup. Otherwise, check your spelling and login again.";
		include("foot.php");
		exit;
	} else {
    	$stat = mysql_fetch_array(mysql_query("select * from players where user='$user' and pass='$pass'"));
  		if ($stat[activ] != 1) {
			print "Your account has not yet been registered.  Please use the activation link sent to your e-mail to activate your account.";
		} else {
			session_register("user");
			session_register("pass");
			print "Welcome back. Please click <a href=updates.php>here</a> to continue..";
		}
	}
}

if ($view == 'logout') {
	session_destroy(); 
	print "You have now been logged out.";
	include("foot.php");
	exit;
} 

?>

<?php include("foot.php"); ?>