<?php $title = "Mining Field"; include("header.php"); ?>

<?php
if ($stat[mines] <= 0) {
	print "You don't have any mines! Would you like to purchase a mining pass? It's only 25 platinum. It also includes a free mine site.";
	print "<ul>";
	print "<li><a href=mines.php?answer=yes>Sure</a>.";
	print "<li><a href=city.php?answer=no>No</a>.";
	print "</ul>";
	if ($answer == yes) {
		if ($stat[platinum] < 25) { print "You do not have enough platinum."; include("footer.php"); exit; }
		else { print "You got a mine! Click <a href=mines.php>here</a>."; mysql_query("update players set platinum=platinum-25 where id=$stat[id]"); mysql_query("update players set mines=mines+1 where id=$stat[id]"); }
	}
	include("footer.php");
	exit;
}

if (!$view) {
	print "Welcome to your mine site.";
	print "<ul>";
	print "<li><a href=mines.php?view=stats>Statistics</a>";
	print "<li><a href=mines.php?view=shop>Shop</a>";
	print "<li><a href=mines.php?view=market>Market</a>";
	print "<li><a href=mines.php?view=mine>Mine</a>";
	print "</ul>";
}

if ($view == stats) {
	print "Here is information about your current mine site.";
	print "<ul>";
	print "<li>Mines: $stat[mines]";
	print "<li>Ops Left: $stat[ops]";
	print "<li>Alethite: $stat[alethite]";
	print "<li>Burelia: $stat[burelia]";
	print "</ul>";
}

if ($view == shop) {
	print "Welcome to the mine shop. You can buy more mines for your mine site. What would you like?";
	$minen = ($stat[mines] * 1000);
	print "<ul>";
	print "<li><a href=mines.php?view=shop&buy=mine>1 Mine</a> ($minen credits)";
	print "<li><a href=mines.php>Nothing</a>";
	print "</ul>";
	if ($buy == mine) {
		if ($stat[credits] >= $minen) {
			print "You got another mine for your mine site. (<a href=mines.php?view=shop>Refresh</a>)";
			mysql_query("update players set mines=mines+1 where id=$stat[id]");
			mysql_query("update players set credits=credits-$minen where id=$stat[id]");
		} else {
			print "You can't afford that!";
		}
	}
}

if ($view == market) {
	if (!$step) {
		print "You are able to sell your minerals that you obtain from mining here.";
		print "<form method=post action=mines.php?view=market&step=sell>";
		print "<table>";
		print "<tr><td>Sell <input type=text name=alethite size=5 value=$stat[alethite]> alethite for 5 credits each.</td></tr>";
		print "<tr><td>Sell <input type=text name=burelia size=5 value=$stat[burelia]> burelia for 2 credits each.</td></tr>";
		print "<tr><td align=center><input type=submit value=Sell></td></tr>";
		print "</form></table>";
	} 
	if ($step == sell) {
		if ($alethite > $stat[alethite] || $burelia > $stat[burelia] || $alethite < 0 || $burelia < 0) {
			print "No point in selling that.";
		} else {
			$again = ($alethite * 5);
			$bgain = ($burelia * 2);
			$tgain = ($again + $bgain);
			mysql_query("update players set alethite=alethite-$alethite where id=$stat[id]");
			mysql_query("update players set burelia=burelia-$burelia where id=$stat[id]");
			mysql_query("update players set credits=credits+$tgain where id=$stat[id]");
			print "You sold <b>$alethite alethite</b> for <b>$again</b> credits.<br>";
			print "You sold <b>$burelia burelia</b> for <b>$bgain</b> credits.<br>";
			print "Overall,  you netted <b>$tgain</b> credits.";
		}
	}
}

if ($view == mine) {
	print "You gather your equipment, and get ready to mine...<br>";
	if ($stat[ops] < 1) {
		print "You don't have any operations left!";
	} else {
		$again = ($stat[mines] * rand(0,3));
		$bgain = ($stat[mines] * rand(0,5));	
		mysql_query("update players set ops=ops-1 where id=$stat[id]");
		mysql_query("update players set alethite=alethite+$again where id=$stat[id]");
		mysql_query("update players set burelia=burelia+$bgain where id=$stat[id]");
		print "You gained <b>$again alethite</b> and <b>$bgain burelia</b>. Would you like to <a href=mines.php?view=mine>mine again</a>?";
	}
}
if ($view) {
	print "<br><br>... <a href=mines.php>mine site</a>.";
}
?>

<?php include("footer.php"); ?>
