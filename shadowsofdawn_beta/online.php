<?php $title = "Online Users"; include("header.php"); ?>

<?php
$ctime = time();
$osel = mysql_query("select * from players");
while ($online = mysql_fetch_array($osel)) {
	$span = ($ctime - $online[lpv]);
	if ($span <= 180) {
		print "<a href=view.php?view=$online[id]>$online[user]</a> ($online[id])<br>";
	}
}
?>

<?php include("footer.php"); ?>