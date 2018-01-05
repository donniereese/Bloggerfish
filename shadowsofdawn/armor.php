<?php $title = "Armor Shop"; include("header.php"); ?>
<?php
if (!$buy) {
	print "Welcome to the armor shop. I hope that you find whatever you may be looking for.<br><br>
	<table>
	<tr><td width=100><b><u>Name</td><td width=100><b><u>Effect</td><td width=75><b><u>Cost</td><td><b><u>Options</td></tr>";
	$asel = mysql_query("select * from equipment where type='A' and status='S' and owner=0 order by cost asc");
	while ($arm = mysql_fetch_array($asel)) {
		print "<tr><td>$arm[name]</td><td>+$arm[power] Defense</td><td>$arm[cost]</td><td>- <A href=armor.php?buy=$arm[id]>Buy</a></td></tr>";
	}
	$asel = mysql_query("select * from equipment where type='S' and status='S' and owner=0 order by cost asc");
	while ($arm = mysql_fetch_array($asel)) {
		print "<tr><td>$arm[name]</td><td>+$arm[power] Defense</td><td>$arm[cost]</td><td>- <A href=armor.php?buy=$arm[id]>Buy</a></td></tr>";
	}
	print "</table>";
}
if ($buy) {
	$arm = mysql_fetch_array(mysql_query("select * from equipment where id=$buy"));
	if (empty ($arm[id])) {
		print "No such armor. Go back to the <a href=armor.php>shop</a>.";
		include("footer.php");
		exit;
	}
	if ($arm[status] != S) {
		print "That's not a shop item. Go back to the <a href=armor.php>shop</a>.";
		include("footer.php");
		exit;
	}
	if ($arm[cost] > $stat[credits]) {
		print "You can't afford that! Go back to the <a href=armor.php>shop</a>.";
		include("footer.php");
		exit;
	}
	$newcost = ceil($arm[cost] * .75);
	mysql_query("insert into equipment (owner, name, power, type, cost) values($stat[id],'$arm[name]',$arm[power],'A',$newcost)") or die("Could not add weapon.");
	print "You paid <b>$arm[cost]</b> credits, but you now have a new <b>$arm[name] +$arm[power]</b> armor.";
	mysql_query("update players set credits=credits-$arm[cost] where id=$stat[id]");
}
?>
<?php include("footer.php"); ?>
