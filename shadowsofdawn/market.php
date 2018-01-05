<?php $title = "Platinum Market"; include("header.php");?>

<?php
if (!$view) {
    print "<table border=0><tr><td align=top width=250><img src=plat.gif align=top></td>";
	print "<td align=top>Here is the platinum market. You have many options.<br>";
	print "<ul>";	print "<li><a href=market.php?view=market>Market</a>";
	print "<li><a href=market.php?view=add>Add Listing</a>";
	print "<li><a href=market.php?view=del>Remove Listings</a>";
	print "</ul></td></tr></table>";
}
if ($view == market) {
	print "View the platinum for sale. Or <a href=market.php>go back</a>.<br><br>";
	print "<table>";
	print "<tr><td width=100><b><u>Platinum</td><td width=100><b><u>Cost</td><td width=100><b><u>User Selling</td><td width=100><b><u>Buy?</td></tr></tr>";
	$psel = mysql_query("select * from pmarket order by id desc");
	while ($pm = mysql_fetch_array($psel)) {
		print "<tr><td>$pm[platinum]</td><td>$pm[cost]</td><td><a href=view.php?view=$pm[seller]>$pm[seller]</a></td><td>- <a href=market.php?buy=$pm[id]>Buy</a></td></tr>";
	}
	print "</table>";
}
if ($view == add) {
	print "Add a listing to the market. Or <a href=market.php>go back</a>.<br><br>";
	print "<table><form method=post action=market.php?view=add&step=add>";
	print "<tr><td>Platinum:</td><td><input type=text name=platinum></td></tr>";
	print "<tr><td>Cost Per Platinum:</td><td><input type=text name=cost></td></tr>";
	print "<tr><td colspan=2 align=center><input type=submit value=Add></td></tr>";
	print "</form></table>";
	if ($step == add) {
		if (empty ($platinum) || empty ($cost)) {
			print "You must fill out all fields.";
			include("footer.php");
			exit;
		}
		$platinum = strip_tags($platinum);
		$cost = strip_tags($cost);
		if ($platinum > $stat[platinum] || $platinum <= 0) {
			print "You don't have enough platinum.";
			include("footer.php");
			exit;
		}
		if ($cost <= 0) {
			print "Hehe... no free platinum.";
			include("footer.php");
			exit;
		}
		$tcost = ($cost * $platinum);
		mysql_query("update players set platinum=platinum-$platinum where id=$stat[id]");
		mysql_query("insert into pmarket (seller, platinum, cost) values($stat[id],$platinum,$tcost)") or die("Could not add listing.");
		print "You added <b>$platinum</b> platinum to the market, at <b>$cost</b> credits each. That also turns out to be <b>$tcost</b> net cost.";
	}
}
if ($view == del) {
	$dsel = mysql_query("select * from pmarket where seller=$stat[id]");
	while ($del = mysql_fetch_array($dsel)) {
		mysql_query("update players set platinum=platinum+$del[platinum] where id=$stat[id]");
		mysql_query("delete from pmarket where id=$del[id]");
	}
	print "You removed all of your listings, and your platinum was returned. (<A href=market.php>back</a>)";
}
if ($buy) {
	$buy = mysql_fetch_array(mysql_query("select * from pmarket where id=$buy[id]"));
	if (empty ($buy[id])) {
		print "No such listing. (<a href=market.php?view=market>back</a>)";
		include("footer.php");
		exit;
	}
	if ($buy[cost] > $stat[credits]) {
		print "You can't afford that. (<a href=market.php?view=market>back</a>)";
		include("footer.php");
		exit;
	}
	mysql_query("update players set bank=bank+$buy[cost] where id=$buy[seller]");
	mysql_query("update players set credits=credits-$buy[cost] where id=$stat[id]");
	mysql_query("update players set platinum=platinum+$buy[platinum] where id=$stat[id]");
	mysql_query("delete from pmarket where id=$buy[id]");
	mysql_query("insert into log (owner, log) values($buy[seller],'<b>$stat[user]</b> has bought your platinum listing. <b>$buy[cost]</b> in the bank.')") or die("Could not add log.");
	print "You got <b>$buy[platinum]</b> platinum for <b>$buy[cost]</b> credits.";
}
?>
<?php include("footer.php"); ?>