<?php $title = "Monuments"; include("header.php"); ?>

<center>
<table>
<tr><td width=200>
	<table class=td width=100% cellpadding=0 cellspacing=0>
	<tr><td bgcolor=#444444 style="border-bottom: solid gray 1px;" align=center colspan=2><b><u>Highest Level</b></u></td></tr>
	<tr><td width=100 align=center><b><u>Name (ID)</td><td width=100 align=center><b><u>Level</td></tr>
	<?php
	$tsel = mysql_query("select * from players order by level desc limit 5");
	while ($top = mysql_fetch_array($tsel)) {
		print "<tr><td>$top[user] ($top[id])</td><td>$top[level]</td></tr>";
	}
	?>
	</table>
</td><td width=200>
	<table class=td width=100% cellpadding=0 cellspacing=0>
	<tr><td bgcolor=#444444 style="border-bottom: solid gray 1px;" align=center colspan=2><b><u>Highest Smithing</b></u></td></tr>
	<tr><td width=100 align=center><b><u>Name (ID)</td><td width=100 align=center><b><u>Smithing</td></tr>
	<?php
	$tsel = mysql_query("select * from players order by ability desc limit 5");
	while ($top = mysql_fetch_array($tsel)) {
		print "<tr><td>$top[user] ($top[id])</td><td>$top[ability]</td></tr>";
	}
	?>
	</table>
</td></tr>
<tr><td width=200>
	<table class=td width=100% cellpadding=0 cellspacing=0>
	<tr><td bgcolor=#444444 style="border-bottom: solid gray 1px;" align=center colspan=2><b><u>Most Credits</b></u> (Hand)</td></tr>
	<tr><td width=100 align=center><b><u>Name (ID)</td><td width=100 align=center><b><u>Credits</td></tr>
	<?php
	$tsel = mysql_query("select * from players order by credits desc limit 5");
	while ($top = mysql_fetch_array($tsel)) {
		print "<tr><td>$top[user] ($top[id])</td><td>$top[credits]</td></tr>";
	}
	?>
	</table>
</td><td width=200>
	<table class=td width=100% cellpadding=0 cellspacing=0>
	<tr><td bgcolor=#444444 style="border-bottom: solid gray 1px;" align=center colspan=2><b><u>Most Credits</b></u> (Bank)</td></tr>
	<tr><td width=100 align=center><b><u>Name (ID)</td><td width=100 align=center><b><u>Bank</td></tr>
	<?php
	$tsel = mysql_query("select * from players order by bank desc limit 5");
	while ($top = mysql_fetch_array($tsel)) {
		print "<tr><td>$top[user] ($top[id])</td><td>$top[bank]</td></tr>";
	}
	?>
	</table>
</td></tr>
<tr><td width=200>
	<table class=td width=100% cellpadding=0 cellspacing=0>
	<tr><td bgcolor=#444444 style="border-bottom: solid gray 1px;" align=center colspan=2><b><u>Most Platinum</b></u></td></tr>
	<tr><td width=100 align=center><b><u>Name (ID)</td><td width=100 align=center><b><u>Platinum</td></tr>
	<?php
	$tsel = mysql_query("select * from players order by platinum desc limit 5");
	while ($top = mysql_fetch_array($tsel)) {
		print "<tr><td>$top[user] ($top[id])</td><td>$top[platinum]</td></tr>";
	}
	?>
	</table>
</td><td width=200>
	<table class=td width=100% cellpadding=0 cellspacing=0>
	<tr><td bgcolor=#444444 style="border-bottom: solid gray 1px;" align=center colspan=2><b><u>Most Max Energy</b></u></td></tr>
	<tr><td width=100 align=center><b><u>Name (ID)</td><td width=100 align=center><b><u>Energy</td></tr>
	<?php
	$tsel = mysql_query("select * from players order by max_energy desc limit 5");
	while ($top = mysql_fetch_array($tsel)) {
		print "<tr><td>$top[user] ($top[id])</td><td>$top[max_energy]</td></tr>";
	}
	?>
	</table>
</td></tr>
<tr><td width=200>
	<table class=td width=100% cellpadding=0 cellspacing=0>
	<tr><td bgcolor=#444444 style="border-bottom: solid gray 1px;" align=center colspan=2><b><u>Most Wins</b></u></td></tr>
	<tr><td width=100 align=center><b><u>Name (ID)</td><td width=100 align=center><b><u>Wins</td></tr>
	<?php
	$tsel = mysql_query("select * from players order by wins desc limit 5");
	while ($top = mysql_fetch_array($tsel)) {
		print "<tr><td>$top[user] ($top[id])</td><td>$top[wins]</td></tr>";
	}
	?>
	</table>
</td><td width=200>
	<table class=td width=100% cellpadding=0 cellspacing=0>
	<tr><td bgcolor=#444444 style="border-bottom: solid gray 1px;" align=center colspan=2><b><u>Most Losses</b></u></td></tr>
	<tr><td width=100 align=center><b><u>Name (ID)</td><td width=100 align=center><b><u>Losses</td></tr>
	<?php
	$tsel = mysql_query("select * from players order by losses desc limit 5");
	while ($top = mysql_fetch_array($tsel)) {
		print "<tr><td>$top[user] ($top[id])</td><td>$top[losses]</td></tr>";
	}
	?>
	</table>
</td></tr>
<tr><td width=200>
	<table class=td width=100% cellpadding=0 cellspacing=0>
	<tr><td bgcolor=#444444 style="border-bottom: solid gray 1px;" align=center colspan=2><b><u>Most Strength</b></u></td></tr>
	<tr><td width=100 align=center><b><u>Name (ID)</td><td width=100 align=center><b><u>Strength</td></tr>
	<?php
	$tsel = mysql_query("select * from players order by strength desc limit 5");
	while ($top = mysql_fetch_array($tsel)) {
		print "<tr><td>$top[user] ($top[id])</td><td>$top[strength]</td></tr>";
	}
	?>
	</table>
</td><td width=200>
	<table class=td width=100% cellpadding=0 cellspacing=0>
	<tr><td bgcolor=#444444 style="border-bottom: solid gray 1px;" align=center colspan=2><b><u>Most Agility</b></u></td></tr>
	<tr><td width=100 align=center><b><u>Name (ID)</td><td width=100 align=center><b><u>Agility</td></tr>
	<?php
	$tsel = mysql_query("select * from players order by agility desc limit 5");
	while ($top = mysql_fetch_array($tsel)) {
		print "<tr><td>$top[user] ($top[id])</td><td>$top[agility]</td></tr>";
	}
	?>
	</table>
</td></tr>
</table>

<?php include("footer.php"); ?>