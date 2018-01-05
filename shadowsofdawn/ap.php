<?php $title = "Distribute AP"; include("header.php"); ?>

<?php
if (!$statp) {
	print "Here, you can use AP to increase your stats. Just click to add. You have <b>$stat[ap]</b> AP left.<br><br>

	- <a href=ap.php?statp=max_hp>+5 Max HP</a><br>
	- <a href=ap.php?statp=max_energy>+1 Max Energy</a><br>
	- <a href=ap.php?statp=strength>+1 Strength</a><br>
	- <a href=ap.php?statp=agility>+1 Agility</a><br><br>";
} else {
	if ($stat[ap] <= 0) {
		print "You don't have any AP.";
		include("footer.php");
		exit;
	}
	if ($statp == max_hp) {
		$gain = 5;
	} else {
		$gain = 1;
	}
	mysql_query("update players set $statp=$statp+$gain where id=$stat[id]");
	mysql_query("update players set ap=ap-1 where id=$stat[id]");
	print "You gained <b>$gain $statp</b>. Click <a href=ap.php>here</a> to distribute more AP.";
}
?>

<?php include("footer.php"); ?>