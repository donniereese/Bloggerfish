<?php $title = "Event Log"; include("header.php"); ?>

This is your event log.<br><br>

<?php
mysql_query("update log set unread='T' where unread='F' and owner=$stat[id]");
$lsel = mysql_query("select * from log where owner=$stat[id] order by id desc limit 25");
while ($log = mysql_fetch_array($lsel)) {
	print "$log[log]<br>";
}
?>

<?php include("footer.php"); ?>