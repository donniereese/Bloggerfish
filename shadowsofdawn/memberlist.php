<?php $title = "Members"; include("header.php"); ?>

<?php
	print "<table>";
	print "<tr><td width=50><b><u>ID</td><td width=100><b><u>Name</td><td width=100><b><u>Rank</td><td width=50><b><u>Level</td></tr>";
	$msel = mysql_query("select * from players order by id asc");
	while ($mem = mysql_fetch_array($msel)) {
		print "<tr><td>$mem[id]</td><td><A href=view.php?view=$mem[id]>$mem[user]</a><td>$mem[rank]</td></td><td>$mem[level]</td></tr>";
	}
	print "</table>";

include("footer.php");
?>