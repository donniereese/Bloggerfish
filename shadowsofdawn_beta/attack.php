<?php $title = "Battle Arena"; include("header.php"); ?>
<?php
if (!$action && !$battle) {
	print "Welcome to the battle arena.<br><br>
	- <a href=attack.php?action=levellist>List by level</a>.<br>
	- <a href=attack.php?action=showalive>Show alive players</a>.<br>";
}

if ($action == showalive) {
	print "Showing all alive at level $stat[level]...<br><br>";
	print "<table><tr><td width=30><b><u>ID</td><td width=100><b><u>Name</td><td width=100><b><u>Rank</td><td width=70><b><u>Options</td></tr>";
	$esel = mysql_query("select * from players where level=$stat[level] and hp>0 limit 50");
	while ($elist = mysql_fetch_array($esel)) {
		print "<tr><td>$elist[id]</td><td><a href=view.php?view=$elist[id]>$elist[user]</a><td>$elist[rank]</td></td><td>- <A href=attack.php?battle=$elist[id]>Attack</a></td></tr>";
	}
	print "</table><br>";
	print "Or you can always... <a href=attack.php>go back</a>.";
}

if ($action == levellist) {
	print "<form method=post action=attack.php?action=levellist&step=go>";
	print "Show me all alive at... <select name=slevel>";
	for ($i = 1; $i < 100; ++$i) {
		print "<option value=$i>Level $i</option>";
	}
	print "</select> <input type=submit value=Go></form>";
	
	if ($step == go) {
		print "<table><tr><td width=30><b><u>ID</td><td width=100><b><u>Name</td><td width=100><b><u>Rank</td><td width=70><b><u>Options</td></tr>";
		$esel = mysql_query("select * from players where level=$slevel and hp>0 limit 50");
		while ($elist = mysql_fetch_array($esel)) {
			print "<tr><td>$elist[id]</td><td><a href=view.php?view=$elist[id]>$elist[user]</a></td><td>$elist[rank]</td><td>- <A href=attack.php?battle=$elist[id]>Attack</a></td></tr>";
		}
		print "</table><br>";
		print "Or you can always... <a href=battle.php>go back</a>.";
	}
}

if ($battle) {

	$enemy = mysql_fetch_array(mysql_query("select * from players where id=$battle"));
	$mywep = mysql_fetch_array(mysql_query("select * from equipment where owner=$stat[id] and type='W' and status='E'"));
	$myarm = mysql_fetch_array(mysql_query("select * from equipment where owner=$stat[id] and type='A' and status='E'"));
	$myshld = mysql_fetch_array(mysql_query("select * from equipment where owner=$stat[id] and type='S' and status='E'"));
	
	$ewep = mysql_fetch_array(mysql_query("select * from equipment where owner=$enemy[id] and type='W' and status='E'"));
	$earm = mysql_fetch_array(mysql_query("select * from equipment where owner=$enemy[id] and type='A' and status='E'"));
	$eshld = mysql_fetch_array(mysql_query("select * from equipment where owner=$enemy[id] and type='S' and status='E'"));

	if (!$enemy[id]) {
		print "No such player.";
		include("footer.php");
		exit;
	}
	if ($enemy[id] == $stat[id]) {
		print "You cannot attack yourself.";
		include("footer.php");	
		exit;
	}
	if ($enemy[hp] <= 0) {
		print "$enemy[user] is already dead.";
		include("footer.php");
		exit;
	}
	if ($stat[energy] < 1) {
		print "You do not have enough energy.";
		include("footer.php");
		exit;
	}
	if ($stat[hp] <= 0) {
		print "You're dead.";
		include("footer.php");
		exit;
	}

	print "<b><u>$stat[user] vs. $enemy[user]</b></u><br>";
	mysql_query("update players set energy=energy-1 where id=$stat[id]");
	
	
	$repeat = ($stat[agility] / $enemy[agility]);
	$attackstr = ceil($repeat);
	if ($attackstr <= 0) {
		$attackstr = 1;
	}
	$mypower = ($mywep[power] + $stat[strength]);
	$epower = ($enemy[strength] + $earm[power] + $eshld[power]);

	$attackdmg = ($mypower - $epower);
	if ($attackdmg <= 0) {
		$attackdmg = 1;
	}
	
	$round = 1;
	while ($round <= $attackstr && $enemy[hp] >= 0) {
		$enemy[hp] = ($enemy[hp] - $attackdmg);
		print "<b>$stat[user]</b> attacks <b>$enemy[user]</b> for <b>$attackdmg</b> damage! ($enemy[hp] left)<br>";
		$round = ($round + 1);
	}

	if ($enemy[hp] <= 0) {
		$enemy[hp] = 0;
		print "<br><b>$stat[user]</b> is the winner!<br>";
		$expgain = (rand(5,10) * $enemy[level]);
		$creditgain = ($enemy[credits] / 10);
		print "<b>$stat[user]</b> have gained <b>$expgain</b> EXP and <b>$creditgain</b> cash.<br>";
		mysql_query("update players set hp=$stat[hp] where id=$stat[id]");
		mysql_query("update players set hp=0 where id=$enemy[id]");
		mysql_query("update players set exp=exp+$expgain where id=$stat[id]");
		mysql_query("update players set credits=credits+$creditgain where id=$stat[id]");
		mysql_query("update players set wins=wins+1 where id=$stat[id]");
		mysql_query("update players set losses=losses+1 where id=$enemy[id]");
		mysql_query("update players set lastkilled='$enemy[user]' where id=$stat[id]");
		mysql_query("update players set lastkilledby='$stat[user]' where id=$enemy[id]");
		$texp = ($stat[exp] + $expgain);
		$expn = (($stat[level] * 50) + ($stat[level] * 15));
		if ($texp >= $expn) {
			print "<b>$stat[user]</b> gained a level! +3 AP and +1 Level.";
			include ("level.php");
			mysql_query("insert into log (owner, log) values($stat[id],'During a fight with <b>$enemy[user]</b>, you gained a level.')");
		}
		mysql_query("insert into log (owner, log) values($stat[id],'You have defeated <b>$enemy[user]</b>. Gained <b>$expgain</b> EXP and <b>$creditgain</b> credits.')");
		mysql_query("insert into log (owner, log) values($enemy[id],'You were defeated by <b>$stat[user]</b>.')");			

		include("footer.php");
		exit;
	}
}

	
?>
<?php include("footer.php"); ?>
