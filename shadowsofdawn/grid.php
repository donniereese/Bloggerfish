<?php $title = "The Grid"; include("header.php"); ?>

<?php
if ($action != explore) {
	print "You walk into a large silver-plated room. Suddenly, a large thud like a giant switch was being thrown booms in your ears. Welcome to the Grid.<br>";
	print "Explore the Grid? <a href=grid.php?action=explore>Yup</a>.";
} else {
	if ($stat[energy] <= .3) {
		print "You don't have enough energy to keep exploring the Grid.";
	} else {
		$chance = rand(1,8);
		mysql_query("update players set energy=energy-.3 where id=$stat[id]");
		if ($chance == 1) {
			print "You take a few steps, and whirl around, but nothing is behind you...";
		}
		if ($chance == 2) {
			print "Nothing here.";
		}
		if ($chance == 3) {
			$crgain = rand(1,100);
			print "A bag of credits! <b>$crgain</b> credits were inside.";
			mysql_query("update players set credits=credits+$crgain where id=$stat[id]");
		}
		if ($chance == 4) {
			print "Nothin' interesting can be seen.";
		}
		if ($chance == 5) {
			print "What was that?";
		}
		if ($chance == 6) {
			$plgain = rand(1,3);
			print "You stumbled into platinum ore! Found <b>$plgain</b> platinum.";
			mysql_query("update players set platinum=platinum+$plgain where id=$stat[id]");
		}
		if ($chance == 7) {
			$roll = rand(1,20);
			if ($roll == 15) {
				print "You reached a spring... and drink the water. Gained <b>.3</b> MAX energy!";
				mysql_query("update players set max_energy=max_energy+.3 where id=$stat[id]");
			} else {
				print "You found a spring. <b>1</b> energy restored!";
				mysql_query("update players set energy=energy+1 where id=$stat[id]");
			}
		}
		if ($chance == 8) {
			print "Nothing worthwhile here.";
		}
		$energyleft = ($stat[energy] - .3);
		print "<br><br>... <a href=grid.php?action=explore>explore</a> again. ($energyleft energy left.)";
	}
}

include("footer.php");
?>