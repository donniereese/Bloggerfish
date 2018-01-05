<?php include("config.php"); session_start(); ?>
<?php
if (!session_is_registered("user") || !session_is_registered("pass")) {
	$senddata = "session_expired";
	exit;
} else {
	
	$stat = mysql_fetch_array(mysql_query("select * from players where user='$_SESSION[user]' and pass='$_SESSION[pass]'"));
	if (empty ($stat[id])) {
		$senddata = "session_expired";
		exit;
	} else {
		if ($stat[ban] == "Yes") {
			$senddata = "account_banned";
			exit;
		}
	}
}

$ctime = time();
mysql_query("update players set lpv=$ctime where id=$stat[id]");
$ip = "$HTTP_SERVER_VARS[REMOTE_ADDR]";
mysql_query("update players set ip='$ip' where id=$stat[id]");
//mysql_query("update players set page='$title' where id=$stat[id]");

//mysql_query("update players set x='$mapx' where id=$stat[id]");
//mysql_query("update players set x='$mapy' where id=$stat[id]");

$senddata = "&user=" . $stat[user] . "&pass=" . $stat[pass];

print $senddata;

print "&loading=NO";
?>