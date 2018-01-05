<?php include ("header.php"); ?>

<?php
if ($view == 'list' || !$view) {

$all = mysql_query("select * from artists");
while ($list = mysql_fetch_array($all)) {

   print "<table>";
      print "<tr><td><b style='font-size:12px; color:#570000;'>Name:</b></td><td><b style='font-size:12px; color:#570000;'>Skills:</b></td></tr>";
   if (empty ($list)) {
      print "<tr><td><center><h4>there are no artists listed yet!</h4></center></td></tr>";
   } else {
      print "<tr>";
	  print "<td valign='top' width='200px'><a href='designers.php?view=profile&nick=$list[nickname]'><b style='font-size:18px;weight:bolder;'>$list[firstname] $list[lastname]</b></a></td>";
	  print "<td valign='top' width='200px'>$list[skills]</td>";
	  print "</tr>";
   }
   print "</table>";
}

} elseif ($view =='profile') {
   $artist = mysql_fetch_array(mysql_query("select * from artists where nickname='$nick'"));
?>
<table border="0" cellpadding="2" cellspacing="8">
    <tr>
	    <td width="272px" height="320px" background="images/image_back.jpg" valign="middle" align="center">image</td>
		<td valign="top">
			<table border="0" width="460px" cellspacing="4" bgcolor="#191D26" style="border:1px solid #101724;">
			    <tr>
				    <td style="background:#323B4C;">
			        <b style="font-size:12px; color:#570000;">Name: </b><?php print "$artist[firstname] $artist[lastname]"; ?>
			        </td>
			    </tr>
			    <tr>
			    	<td style="background:#3C475B;">
			        <b style="font-size:12px; color:#570000;">Age: </b><?php print "$artist[age]"; ?>
			        </td>
			    </tr>
			    <tr>
				    <td style="background:#323B4C;">
			        <b style="font-size:12px; color:#570000;">Location: </b><?php print "$artist[location]"; ?>
			        </td>
			    </tr>
			    <tr>
				    <td style="background:#3C475B">
			        <b style="font-size:12px; color:#570000;">Email: </b><?php print "<a href='mailto:$artist[email]'>$artist[email]</a>"; ?>
			        </td>
			    </tr>
			    <tr>
				    <td style="background:#323B4C;">
			        <b style="font-size:12px; color:#570000;">Schooling: </b><?php print "$artist[schooling]"; ?>
					<br><br><br><br>
			        </td>
			    </tr>
		    </table>
			<br>
			<table border="0" width="460px" height="166px" cellspacing="4" bgcolor="#191D26" style="border:1px solid #101724;">
			    <tr>
				    <td style="background:#323B4C;" valign="top"><b style="font-size:12px; color:#570000;">Short Bio: </b><br>
			        <?php print "$artist[bio]"; ?>
			        </td>
			    </tr>
		    </table>
			
		</td>
	</tr>
	<tr>
	    <td colspan="2">
			<table border="0" width="744px" height="200px" cellspacing="4" bgcolor="#191D26" style="border:1px solid #101724;">
			    <tr>
				    <td style="background:#323B4C;" valign="top">
			        <iframe src="news.php?view=personal_works&artist=<?php print"$artist[nickname]"; ?>" name="personal_works" width="100%" height="100%" frameborder="0" marginwidth="0" marginheight="0" scrolling="auto"></iframe>
			        </td>
			    </tr>
		    </table>
		</td>
    </tr>
</table>
<?php
}
?>

<?php include ("footer.php"); ?>
