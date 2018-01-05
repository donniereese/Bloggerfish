<?php $title = "Landfill"; include("header.php"); ?>

<?php
if (!$action) {
	$gain = ($stat[level] * 25);
	print "Want to earn some credits? Alright. For each bag of trash you can chuck in the landfill, I'll give you <b>$gain</b> credits.<br><br>[<A href=landfill.php?action=work>OK</a>.]";
} else {
	if ($stat[energy] < 1) {
		print "You don't have enough energy to work.";
		include("footer.php");
		exit;
	}
	if ($stat[work] > $stat[worklimit]) {
		print "You have reached your work limit for today.  Please come back tommorow.";
		include("footer.php");
		exit;
	}
		$gain = ($stat[level] * 25);
		mysql_query("update players set energy=energy-1 where id=$stat[id]");
		mysql_query("update players set credits=credits+$gain where id=$stat[id]");
		mysql_query("update players set work=work+1 where id=$stat[id]");
		print "You worked, using <b>1</b> energy, and gained <b>$gain</b> credits.";
		print "<br>[<a href=landfill.php?action=work>Work Again</a>]";
}

include("footer.php");
?>