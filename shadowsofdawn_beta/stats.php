<?php $title = "Stats"; include("header.php"); ?>

Welcome to your stats. You can view your personal information here.<br><br>

<table width=100%>
<tr><td width=50% valign=top>
	<center><b><u>Game Stats</b></u></center><br>

	<?php
	print "<b>AP:</b> $stat[ap] (<a href=ap.php>use</a>)<br>";
	print "<b>Agility:</b> $stat[agility]<br>";
	print "<b>Strength:</b> $stat[strength]<br><br>";

	$rt = ($stat[wins] + $stat[losses]);
	print "<b>Record:</b> $stat[wins]/$stat[losses]/$rt<br>";
	print "<b>Last Killed:</b> $stat[lastkilled]<br>";
	print "<b>Last Killed By:</b> $stat[lastkilledby]";
	?>

</td><td width=50% valign=top>
	<center><b><u>Information</b></u></center><br>

	<?php
	print "<b>Rank:</b> $stat[rank]<br>";
	print "<b>Age:</b> $stat[age]<br>";
	print "<b>Logins:</b> $stat[logins]<br>";
	print "<b>IP:</b> $stat[ip]<br>";
	print "<b>Email:</b> $stat[email]<br>";
	$tribe = mysql_fetch_array(mysql_query("select * from tribes where id=$stat[tribe]"));
	if ($tribe) {
		print "<b>Tribe:</b> <a href=tribes.php?view=my>$tribe[name]</a><br>";
	} else {
		print "<b>Tribe:</b> None<br>";
	}
	?>

</td></tr>
</table>
<?php include("footer.php"); ?>