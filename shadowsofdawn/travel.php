<?php $title="Map"; include("header.php"); ?>
<?php
$map_config = mysql_fetch_array(mysql_query("select * from map_config where id='1'"));

if ($move == 'up' && $movey > '1') {
mysql_query("update players set y='$movey' where id=$stat[id]");

} elseif ($move == 'down' && $movey < ($map_config[max_y])) {
mysql_query("update players set y='$movey' where id=$stat[id]");

} elseif ($move == 'left' && $movey > '1') {
mysql_query("update players set x='$movey' where id=$stat[id]");

} elseif ($move == 'right' && $movey < ($map_config[max_x])) {
mysql_query("update players set x='$movey' where id=$stat[id]");

}

$stat = mysql_fetch_array(mysql_query("select * from players where email='$email' and pass='$pass'"));

print "<b>$stat[map]</b> | ";
print "<b>($stat[x] , $stat[y])</b>";


$s1 = mysql_fetch_array (mysql_query("select * from $stat[map] where x=($stat[x] - 1) and y=($stat[y] - 1)"));
$s2 = mysql_fetch_array (mysql_query("select * from $stat[map] where x=$stat[x] and y=($stat[y] - 1)"));
$s3 = mysql_fetch_array (mysql_query("select * from $stat[map] where x=($stat[x] + 1) and y=($stat[y] - 1)"));
$s4 = mysql_fetch_array (mysql_query("select * from $stat[map] where x=($stat[x] - 1) and y=($stat[y])"));
$s5 = mysql_fetch_array (mysql_query("select * from $stat[map] where x=$stat[x] and y=$stat[y]"));
$s6 = mysql_fetch_array (mysql_query("select * from $stat[map] where x=($stat[x] + 1) and y=($stat[y])"));
$s7 = mysql_fetch_array (mysql_query("select * from $stat[map] where x=($stat[x] - 1) and y=($stat[y] + 1)"));
$s8 = mysql_fetch_array (mysql_query("select * from $stat[map] where x=$stat[x] and y=($stat[y] + 1)"));
$s9 = mysql_fetch_array (mysql_query("select * from $stat[map] where x=($stat[x] + 1) and y=($stat[y] + 1)"));

?>

<table align="center" border="0" width="600" height="500" cellpadding="0" cellspacing="0">
<tr>
       <td></td>
       <td height="50" align="center">
	   <img src="images/map/doubleup.gif" width="48" height="28" alt="" border="0"><br>
<?php
$up = ($stat[y] - 1);
print "<a href=travel.php?move=up&movey=$up><img src='images/map/up.gif' width='48' height='20' alt='up' border='0'></a></td>";
?>
       <td></td>
</tr>
<tr>
       <td align="right">
	   <img src="images/map/doubleleft.gif" width="28" height="48" alt="" border="0">
<?php
$left = ($stat[x] - 1);
print "<a href=travel.php?move=left&movey=$left><img src='images/map/left.gif' width='20' height='48' alt='left' border='0'></a>";
?>
	   </td>
       <td width="450" valign="middle" align="center">
	   
<table border="1" cellspacing="0" cellpadding="0" width="450" height="450">

<tr>
<?php
print "<td align='center' valign='middle' background='$s1[background]'>($s1[x] , $s1[y])<br>$s1[content]</td>";
print "<td align='center' valign='middle' background='$s2[background]'>($s2[x] , $s2[y])<br>$s2[content]</td>";
print "<td align='center' valign='middle' background='$s3[background]'>($s3[x] , $s3[y])<br>$s3[content]</td>";
print "</tr>";
print "<tr>";
print "<td align='center' valign='middle' background='$s4[background]'>($s4[x] , $s4[y])<br>$s4[content]</td>";
print "<td align='center' valign='middle' background='$s5[background]'>($s5[x] , $s5[y])<br>$s5[content]</td>";
print "<td align='center' valign='middle' background='$s6[background]'>($s6[x] , $s6[y])<br>$s6[content]</td>";
print "</tr>";
print "<tr>";
print "<td align='center' valign='middle' background='$s7[background]'>($s7[x] , $s7[y])<br>$s7[content]</td>";
print "<td align='center' valign='middle' background='$s8[background]'>($s8[x] , $s8[y])<br>$s8[content]</td>";
print "<td align='center' valign='middle' background='$s9[background]'>($s9[x] , $s9[y])<br>$s9[content]</td>";
?>
</tr>
</table>

	   
	   </td>
       <td>
<?php
$right = ($stat[x] + 1);
print "<a href=travel.php?move=right&movey=$right><img src='images/map/right.gif' width='20' height='48' alt='right' border='0'></a>";
?>
	   <img src="images/map/doubleright.gif" width="28" height="48" alt="" border="0">
	   </td>
</tr>
<tr>
       <td></td>
       <td height="50" align="center">
<?php
$down = ($stat[y] + 1);
print "<a href=travel.php?move=down&movey=$down><img src='images/map/down.gif' width='48' height='20' alt='down' border='0'></a>";
?>
  	   <br>
	   <img src="images/map/doubledown.gif" width="48" height="28" alt="" border="0">
	   </td>
       <td></td>
</tr>
</table>

<?php include("footer.php"); ?>