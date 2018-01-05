<?php $title = "Rankings"; include("header.php"); ?>

<b><u>Highest Level</b></u><br>
<?php
$tsel = mysql_query("select * from players order by level desc limit 5");
while ($top = mysql_fetch_array($tsel)) {
	print "<b>$top[user]</b> is at level <b>$top[level]</b>.<br>";
}
print "<br>";
?>

<b><u>Most Credits</b></u><br>
<?php
$tsel = mysql_query("select * from players order by credits desc limit 5");
while ($top = mysql_fetch_array($tsel)) {
	print "<b>$top[user]</b> has <b>$top[credits]</b> cash.<br>";
}
print "<br>";
?>

<b><u>Most Wins</b></u><br>
<?php
$tsel = mysql_query("select * from players order by wins desc limit 5");
while ($top = mysql_fetch_array($tsel)) {
	print "<b>$top[user]</b> has <b>$top[wins]</b> wins.<br>";
}
print "<br>";
?>

<b><u>Most Losses</b></u><br>
<?php
$tsel = mysql_query("select * from players order by losses desc limit 5");
while ($top = mysql_fetch_array($tsel)) {
	print "<b>$top[user]</b> has <b>$top[losses]</b> losses.<br>";
}
print "<br>";
?>

<b><u>Most Strength</b></u><br>
<?php
$tsel = mysql_query("select * from players order by strength desc limit 5");
while ($top = mysql_fetch_array($tsel)) {
	print "<b>$top[user]</b> has <b>$top[strength]</b> strength.<br>";
}
print "<br>";
?>

<b><u>Most Agility</b></u><br>
<?php
$tsel = mysql_query("select * from players order by agility desc limit 5");
while ($top = mysql_fetch_array($tsel)) {
	print "<b>$top[user]</b> has <b>$top[agility]</b> agility.<br>";
}
print "<br>";
?>

<?php include("footer.php"); ?>