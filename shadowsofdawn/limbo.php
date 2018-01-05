<?php
include("config.php");

$self = $_SERVER['PHP_SELF'];
$self = str_replace("/shadowsofdawn/", "", $self);

print $self;
if ($self == "limbo.php") {
	include ("header.php");
}

$vilecost = 1250;
$crneed = (($stat[max_hp] - $stat[hp]) * 10);
$crneeded = ($stat[credits]);
if ($crneed > $stat[credits]) {
	print "You cannot afford to be healed. You need <b>$crneed</b> credits.";
}

if (!$action) {
	print "<ul>";
	print "<li><a href=limbo.php?action=heal>Heal</a> - <b>$crneed</b> credits";
//	print "<li><a href=hospital.php?action=energy>1 Vile of Energy</a> - <b>1250</b> - credits";
//	print "<li><a href=hospital.php?action=massenergy>Buy Multiple Viles of Energy</a>";
	print "</ul>";
}

if ($action == heal) {
	$crneed = (($stat[max_hp] - $stat[hp]) * 10);
	if ($crneed > $stat[credits]) {
		print "You cannot afford to be healed.";
		include("footer.php");
		exit;
	}
	mysql_query("update players set hp=max_hp where id=$stat[id]");
	mysql_query("update players set credits=credits-$crneed where id=$stat[id]");
	print "<br>You are now fully healed.";
}

if ($action == energy) {

	if ($vilecost < $energy) {
		print "You cannot afford this. you need $vilecost";
		include("footer.php");
		exit;
	}
		mysql_query("update players set energy=energy + 1 where id=$stat[id]");
		mysql_query("update players set credits=credits-$vilecost where id=$stat[id]");
		print "<br>You have received 1 vile of energy.";
		print "<br>Go back to the hospital? <a href=hospital.php>OK</a>.";
		print "<br>Buy another vile? <a href=hospital.php?action=energy>OK</a>.";
	}

if ($action == massenergy) {
	print "<br><form action=hospital.php?action=massenergy&step=get>";
	print "I want <input type=text name=need> viles of energy. ";
	print "<input type=submit value=Buy></form>";
	print"<br>Go back to the hospital? <a href=hospital.php>OK</a>.";
	
}
if ($need) {
	$greed=($need*$vilecost);
	if ($crneeded < $greed) {
		print "You cannot afford $need viles.";
		include("footer.php");
		exit;
	} else {
	print "<br><br><blockquote>";
	mysql_query("update players set energy=energy + $need where id=$stat[id]");
	mysql_query("update players set credits=credits- $greed where id=$stat[id]");
	print "<br>You have received $need vile of energy.";
	print "<br>Go back to the hospital? <a href=hospital.php>OK</a>.";
	print "<br>Buy one more vile? <a href=hospital.php?action=energy>OK</a>.";
	print "<br>Go back and buy more viles?<a href=hospital.php?action=massenergy>OK</a>.</blockquote>";
	}
}

if ($stat[hp] > 0) {
	print "<br><br>";
	print "It seems that you have redeemed yourself.  You can now travel back to the eartly plane.<br>";
	print "<br><a href=\"overview.php\">Travel there</a>";
} elseif ($stat[hp] <= 0) {
	print "<br><br>It looks as though you have died. Welcome to Limbo. You have been saved from passing on. ";
	print "You can not leave this place until you have proved yourself or have been granted passage ";
	print "back in to the earthly plane.<br>";
}

include ("footer.php");
?>