<?php include ("header.php"); ?>

<?php
if ($view == 'list' || !$view) {

$all = mysql_query("select * from works");
while ($list = mysql_fetch_array($all)) {
   if (empty ($list)) {
      print "<table align='center' valing='middle'><tr><td><center><h4>there are no artists listed yet!</h4></center></td></tr></table>";
   } else {
   ?>
<table border="0" cellpadding="2" cellspacing="8">
    <tr>
	    <td width="180px" height="320px" background="images/image_back.jpg" valign="middle" align="center"><?php print "<img width='270px' height='330px' src='images/works/$list[preview_image]'>"; ?></td>
		<td valign="top">
			<table border="0" width="460px" cellspacing="4" bgcolor="#191D26" style="border:1px solid #101724;">
			    <tr>
				    <td style="background:#323B4C;">
			        <b style="font-size:12px; color:#570000;">Title: </b><?php print "$list[title]"; ?>
			        </td>
			    </tr>
			    <tr>
			    	<td style="background:#3C475B;">
			        <b style="font-size:12px; color:#570000;">Artist: </b><?php print "$list[artist]"; ?>
			        </td>
			    </tr>
			    <tr>
				    <td style="background:#323B4C;">
			        <b style="font-size:12px; color:#570000;">Price: </b><?php print "$list[price]"; ?>
			        </td>
			    </tr>
			    <tr>
				    <td style="background:#3C475B">
			        <b style="font-size:12px; color:#570000;">Project: </b><?php print "$list[project]"; ?>
			        </td>
			    </tr>
			</table>
			<br>
			
			<table border="0" width="460px" height="100px" cellspacing="4" bgcolor="#191D26" style="border:1px solid #101724;">
			    <tr>
				    <td style="background:#323B4C;" valign="top"><b style="font-size:12px; color:#570000;">Short Description: </b> <br><?php print "$list[small_info]"; ?></td>
			    </tr>
		    </table>
			
			<br>
			<table border="0" width="460px" height="130px" cellspacing="4" bgcolor="#191D26" style="border:1px solid #101724;">
			    <tr>
				    <td style="background:#323B4C;" valign="top"><b style="font-size:12px; color:#570000;">
			        <iframe src="news.php?view=personal_works&artist=<?php print"$artist[nickname]"; ?>" name="personal_works" width="100%" height="100%" frameborder="0" marginwidth="0" marginheight="0" scrolling="auto"></iframe>
			        </td>
			    </tr>
		    </table>
			
		</td>
	</tr>
</table>
   <?php
   }
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
				    <td style="background:#323B4C;" valign="top"><b style="font-size:12px; color:#570000;">
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