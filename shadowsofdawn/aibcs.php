<?php $title = "A.I. Battle Simulator"; include("header.php"); ?>

<?php
if ($action != strike) {
	print "A computers voice booms throughout the empty room: <br>Welcome to the Indocron AI Battle Simulation Chamber.  Your simulation has been created.  Attack and your discretion.<br><br>";
	print "Explore the Grid? <a href=aibcs.php?action=strike>Attack</a>.";
} else {
	if ($action = strike){
	if ($stat[energy] <= .5) {
		print "You are endager of dieing.  Simulation terminated.  Please return with more energy";
	} else {
		
		$chance = rand(1,8);
		mysql_query("update players set energy=energy-.5 where id=$stat[id]");
		
		if ($chance == 1) {
			print "You attack the simulation, but missed.";
		}
		
		if ($chance == 2) {
			print "The simulation attacks you, but you dodged.";
			mysql_query("update players set exp=exp+10 where id=$stat[id]");
			$texp = ($stat[exp] + $expgain);
			$expn = (($stat[level] * 50) + ($stat[level] * 15));
			if ($texp >= $expn) {
			   print "<b>$stat[user]</b> gained a level! +1 AP and +1 Level.";
			   mysql_query("update players set ap=ap+1 where id=$stat[id]");
			   mysql_query("update players set level=level+1 where id=$stat[id]");
			   mysql_query("update players set exp=0 where id=$stat[id]");
			   mysql_query("insert into log (owner, log) values($stat[id],'During a fight with the simulation, you gained a level.')");
		}
		}
		
		if ($chance == 3) {
			$crgain = rand(1,300);
			print "You struck the simulation and it droped a bag! <b>$crgain</b> credits were inside.";
			mysql_query("update players set credits=credits+$crgain where id=$stat[id]");
			mysql_query("update players set exp=exp+10 where id=$stat[id]");
			$texp = ($stat[exp] + $expgain);
			$expn = (($stat[level] * 50) + ($stat[level] * 15));
			if ($texp >= $expn) {
			   print "<b>$stat[user]</b> gained a level! +1 AP and +1 Level.";
			   mysql_query("update players set ap=ap+1 where id=$stat[id]");
			   mysql_query("update players set level=level+1 where id=$stat[id]");
			   mysql_query("update players set exp=0 where id=$stat[id]");
			   mysql_query("insert into log (owner, log) values($stat[id],'During a fight with the simulation, you gained a level.')");
		}
		}
		
		if ($chance == 4) {
			print "You struck the simulation, but it blocked.";
			mysql_query("update players set exp=exp+7 where id=$stat[id]");
			$texp = ($stat[exp] + $expgain);
			$expn = (($stat[level] * 50) + ($stat[level] * 15));
			if ($texp >= $expn) {
			   print "<b>$stat[user]</b> gained a level! +1 AP and +1 Level.";
			   mysql_query("update players set ap=ap+1 where id=$stat[id]");
			   mysql_query("update players set level=level+1 where id=$stat[id]");
			   mysql_query("update players set exp=0 where id=$stat[id]");
			   mysql_query("insert into log (owner, log) values($stat[id],'During a fight with the simulation, you gained a level.')");
		}
		}
		
		if ($chance == 5) {
			print "The simulation strikes you with a direct blow!";
			mysql_query("update players set hp=hp-5 where id=$stat[id]");
		}
		
		if ($chance == 6) {
			$plgain = rand(1,3);
			print "You dodged the simulation's blow and stumbled into platinum ore! Found <b>$plgain</b> platinum.";
			mysql_query("update players set platinum=platinum+$plgain where id=$stat[id]");
		}
		
		if ($chance == 7) {
			$roll = rand(1,20);
			if ($roll == 15) {
				print "You backed up against a spring... and drink the water. Gained <b>.3</b> MAX energy!";
				mysql_query("update players set max_hp=(max_hp+.3) where id=$stat[id]");
				mysql_query("update players set exp=exp+10 where id=$stat[id]");
			$texp = ($stat[exp] + $expgain);
			$expn = (($stat[level] * 50) + ($stat[level] * 15));
			if ($texp >= $expn) {
			   print "<b>$stat[user]</b> gained a level! +1 AP and +1 Level.";
			   mysql_query("update players set ap=ap+1 where id=$stat[id]");
			   mysql_query("update players set level=level+1 where id=$stat[id]");
			   mysql_query("update players set exp=0 where id=$stat[id]");
			   mysql_query("insert into log (owner, log) values($stat[id],'During a fight with the simulation, you gained a level.')");
		}
		
			} else {
				print "You found a spring. <b>1</b> energy restored!";
				mysql_query("update players set energy=energy+1 where id=$stat[id]");
		
			}
		
		}
		
		if ($chance == 8) {
			print "You get get hit but it did not faze you.";
		
		}
		$energyleft = ($stat[energy] - .5);
		print "<br><br>... <a href=aibcs.php?action=strike>Attack</a> the simulation again. ($energyleft energy left.)";
	}
	}
}

include("footer.php");?>