<?php $title = "Updates"; include("header.php"); ?>
<br>
<table align="center" width=450 valign=top class=td cellpadding=0 cellspacing=0>
<tr><td align=left bgcolor=333333 style="border: solid black 1px; border-bottom: solid black 2px;">
	<b>Message From:</b> The Admin
</td>
</tr>
<tr>
<td align=left valign=top bgcolor=#111111 style="border: solid black 1px; border-bottom: solid black 2px;">
Remember everyone, always check the Last ten updates often.  I could have posted 
several updates at once and you don't know it.  Also, check the Updates section 
of the forums.  I will try to keep them posted there too.  USE THE FORUMS!  We have 
a lack of participation on user part.<br><br>
</td>
</tr>
</table>
<br><br>
<?php
print "$date<br><br>";
if ($view != all) {
	$upd = mysql_fetch_array(mysql_query("select * from updates order by id desc limit 3"));
	print "<b>$upd[title]</b> by <b>$upd[starter]</b>...<br><br>\"$upd[updates]\".";
	print "<br><br>(<a href=updates.php?view=all>last 10 updates</a>)";
} else {
	$usel = mysql_query("select * from updates order by id desc limit 10");
	while ($upd = mysql_fetch_array($usel)) {
		print "<b>$upd[title]</b> by <b>$upd[starter]</b>... \"$upd[updates]\"<br><br>";
	}
}
include("footer.php");
?>

