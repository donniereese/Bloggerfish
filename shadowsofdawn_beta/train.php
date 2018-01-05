<?php $title = "Training"; include("header.php"); ?>

<?php
if ($code == 'letmeinyoufuckingbitch' && $pass == 'youheardmeyoufuckingtrainer') {
print "Welcome to the facility. Here, you can train your strength and agility, ";
print "for a .125 increase, for every .2 energy that you use training.";

print "<form method=post action=train.php?code=letmeinyoufuckingbitch&pass=youheardmeyoufuckingtrainer&action=train>";
print "I will train my ";
print "<select name=train>";
print "<option value=strength>strength</option>";
print "<option value=agility>agility</option>";
print "</select> ";
print "<input type=text size=3 value=0 name=rep> times. ";
print "<input type=submit value=Train>";
print "</form>";


if ($action == train) {
	$repeat = ($rep * .2);
	$gain = ($rep * .125);
	if ($repeat > $stat[energy] || $rep <= 0) {
		print "You don't have enough enrergy.";
		include("footer.php");
		exit;
	}
	mysql_query("update players set energy=energy-$repeat where id=$stat[id]");
	mysql_query("update players set $train=$train+$gain where id=$stat[id]");
	print "You trained! Gained <b>$gain $train</b>.";
}
}
?>

<?php include("footer.php"); ?>