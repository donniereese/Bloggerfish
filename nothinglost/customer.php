<?php session_start(); ?>
<?php

if ($action == "kill_session") {
	unset($_SESSION["user"]); 
	unset($_SESSION["pass"]); 
	session_destroy(); 
}
include("config.php");

$status = "";
if (!session_is_registered("user") || !session_is_registered("pass")) {
    $status = "guest";
}
if ($status != "guest") {
    $stat = mysql_fetch_array(mysql_query("select * from customer where user='$_SESSION[user]' and pass='$_SESSION[pass]'"));
    if (empty ($stat[id])) {
	    $status = "guest";
    }
}

if ($status != "guest") {
    $ctime = time();
    mysql_query("update memebers set lpv=$ctime where id=$stat[id]");
    $ip = $HTTP_SERVER_VARS[REMOTE_ADDR];
    mysql_query("update memebers set ip='$ip' where id=$stat[id]");
}

if (empty($print_friendly) || !$print_friendly) {
	include ("header.php");
}

if ($status == "guest") {
	include("customerlogin.php");
} else {
	print "<a href=\"customer.php?view=statement\">View Your Last Statement</a> | ";
	print "<a href=\"customer.php?action=kill_session\">Log Out</a>";
	print "<br><br>";
	
	if ($view == "main" || !empty($view)) {
	
	}
	
	if ($view == "statement") {
		if ($print_friendly == "yes") {
			print "<div style=\"position:absolute; top:0px; left:0px; width:100%; height:100%; background-color:#ffffff; color:#000000; font-size:12px;\"><pre>$stat[statement]</pre></div>";
		} else {
			print "<pre>$stat[statement]</pre><br>";
			print "<a href=\"customer.php?view=statement&print_friendly=yes\">Print Friendly</a><br><br>";
		}
	}
}

if (empty($print_friendly) || !$print_friendly) {
	include("footer.php");
}
?>

</body>
</html>
