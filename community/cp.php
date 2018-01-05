<?php include ("header.php"); ?>

<table>
<?php
$blogcount = mysql_fetch_array(mysql_query("select * from blogs where owner='$stat[id] order by id desc"));
print "<tr><td><b>$blogcount[title]</b></td>";
print "<td><a href='cp.php?view=postnew&blogname=$blogcount[title]'>POST</a></td></tr>";
?>
<tr>
<td valign="top">
<a href=cp.php?view=postnew>Add Update</a>
<a href=cp.php?view=add>Add Staff</a>
</td>
</tr>
</table>
<?php
if ($view == postnew) {
	print "<form method=post action=cp.php?view=postnew&step=add>";
	print "<input name='blogname' type='hidden' value=$blogname>
	print "<b>Title:</b><input type=text name=title><br>";
	print "<textarea name='content' rows=30 cols=80></textarea><br>";
	print "<input type=submit value=Post></form>";
	if ($step == add) {
	    
		if ((empty ($title) || (empty ($content) || (empty ($blogname)) {
	    print "Something was not filled out.";
	    } else {
		mysql_query("insert into posts (blog, title, post) values('$blogname','$title','$content')") or die("Could not add post for some reason.");
		}
	}
}


<?php include ("footer.php"); ?>