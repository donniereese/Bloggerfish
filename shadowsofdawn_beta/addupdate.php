<?php $title = "Add Update"; include("header.php"); 



if ($stat[rank] == Member) {
	print "You are not authorized to be here.";
	include("footer.php");
	exit;
}
?>

<table border=0 cellpadding="2" cellspacing="4">
<form method=post action=addupdate.php?action=add>
	<tr>
		<td bgcolor="#333333">Title:</td>
		<td><input type=text name=addtitle style="width:400px"></td>
		<td align="right"><input type=submit value="Add Update"></td>
	</tr>
	<tr>
		<td bgcolor="#333333" valign=top>Update:</td>
		<td colspan="2"><textarea name=addupdate rows=20 cols=100></textarea></td>
	</tr>
	<tr>
		<td colspan=2 align=center></td>
		</tr>
</form>
</table>

<?php
if ($action == add) {
	if (empty ($addtitle) || empty ($addupdate)) {
		print "Duh... fill out all fields.";
		include("footer.php");
		exit;
	}
	mysql_query("insert into updates (starter, title, updates) values('$stat[user] ($stat[id])','$addtitle','$addupdate')") or die("Could not add updates.");
	print "Update added.";
}

include("footer.php");
?>