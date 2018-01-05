<?php $title = "Equipment"; include("header.php"); ?>

<u>Equipped Items</u>:<br>

<?php
$wep = mysql_fetch_array(mysql_query("select * from equipment where owner=$stat[id] and type='W' and status='E'"));
if (!empty ($wep[id])) {
	print "Weapon: $wep[name] (+$wep[power])<br>";
} else {
	print "Weapon: None<br>";
}
$arm = mysql_fetch_array(mysql_query("select * from equipment where owner=$stat[id] and type='A' and status='E'"));
if (!empty ($arm[id])) {
   print "Armor: $arm[name] (+$arm[power])<br>";
} else {
	print "Armor: None<br>";
}
$arm = mysql_fetch_array(mysql_query("select * from equipment where owner=$stat[id] and type='S' and status='E'"));
if (!empty ($arm[id])) {
   print "Shield: $arm[name] (+$arm[power])<br>";
} else {
	print "Shield: None<br>";
}
?>

<br><u>Unequipped Weapons</u>:<br>
<?php
$wsel = mysql_query("select * from equipment where owner=$stat[id] and type='W' and status='U'");
while ($wep = mysql_fetch_array($wsel)) {
	print "$wep[name] (+$wep[power]) [ <a href=equip.php?equip=$wep[id]>equip</a> | <A href=equip.php?sell=$wep[id]>sell</a> for $wep[cost] cash ]<br>";
}
?>

<br><u>Unequipped Armor</u>:<br>
<?php
$asel = mysql_query("select * from equipment where owner=$stat[id] and type='A' and status='U'");
while ($arm = mysql_fetch_array($asel)) {
	print "$arm[name] (+$arm[power]) [ <a href=equip.php?equip=$arm[id]>equip</a> | <A href=equip.php?sell=$arm[id]>sell</a> for $arm[cost] credits ]<br>";
}
$ssel = mysql_query("select * from equipment where owner=$stat[id] and type='S' and status='U'");
while ($shield = mysql_fetch_array($ssel)) {
	print "$shield[name] (+$shield[power]) [ <a href=equip.php?equip=$shield[id]>equip</a> | <A href=equip.php?sell=$shield[id]>sell</a> for $shield[cost] credits ]<br>";
}

?>

<?php
if ($equip) {
	$equip = mysql_fetch_array(mysql_query("select * from equipment where id=$equip"));
	if (empty ($equip[id])) {
		print "No such item.";
		include("footer2.php");
		exit;
	}
	if ($stat[id] != $equip[owner]) {
		print "You don't own that item.";
		include("footer2.php");
		exit;
	}
	mysql_query("update equipment set status='U' where type='$equip[type]' and owner=$stat[id]");
	mysql_query("update equipment set status='E' where id=$equip[id] and owner=$stat[id]");
	print "You equipped the $equip[name]. (<a href=equip.php>refresh</a>)";
}
if ($sell) {
	$sell = mysql_fetch_array(mysql_query("select * from equipment where id=$sell"));
	if (empty ($sell[id])) {
		print "No such item.";
		include("footer2.php");
		exit;
	}
	if ($stat[id] != $sell[owner]) {
		print "You don't own that item.";
		include("footer2.php");
		exit;
	}
	mysql_query("update players set cash=cash+$sell[cost] where id=$stat[id]");
	mysql_query("delete from equipment where id=$sell[id]");
	print "You sold your $sell[name] for $sell[cost] cash. (<A href=equip.php>refresh</a>)";
}
?>
<?php
include("footer.php");
?>