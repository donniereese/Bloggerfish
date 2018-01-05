		</td>
		<td bgcolor="#EDECE8" width=160 height=460 valign="top" align="right" style="padding-left: 4px; padding-right: 4px;">
		<a class="menu" href="index.php">Home</a><br>
		<a class="menu" href="view.php">Blog Listings</a><br>
		<a class="menu" href="profile.php">Member Listings</a><br>
		<a class="menu" href="about.php">About</a><br>
		<a class="menu" href="fq.php">F&amp;Q</a><br>
		<a class="menu" href="contact.php">Contact</a><br>

		<img src="images/menu_div.jpg" width="144" height="8" alt="" border="0">
		<?php
		If ($status != "guest") {
    	   $stat = mysql_fetch_array(mysql_query("select * from members where user='$user' and pass='$pass'"));
    	   if (empty ($stat[id])) {
	       	  print "Invalid login.";
	    	  exit;
    	   }
		   
		   print "<center><a href='cp.php'><img src='images/control-panel.jpg' width='134' height='30' alt='control panel' border='0'></a><br>";
		   print "<img src='images/log-out.jpg' width='134' height='30' alt='log out' border='0'></center>";
		}
		?>
		<br>
		<table width="100%" align="center" border="0" cellpadding="2" cellspacing="0">
		<tr><td bgcolor="#E4E4E3" align="left" valign="top" style="border: 1px solid #c4c4c3">
		
		<?php
		If ($status != "guest") {
    	   $stat = mysql_fetch_array(mysql_query("select * from members where user='$user' and pass='$pass'"));
    	   if (empty ($stat[id])) {
	       	  print "Invalid login.";
	    	  exit;
    	   }
		   print "<b>User:</b> $stat[user]";
		} else {
		
		print "<font size=2>";
		print "<form method='post' action='login.php'>";
		print "<b>User: </b><br><input name='user' type='text' size='20'><br>";
		print "<b>Password: </b><input name='pass' type='password' size='20'><br>";
		print "<input type='submit' value='Sign In'>";
		print "</form>";
		print "</font>";
		
		}
		?>
		
		</td></tr>
		</table>
		
		</td>
		<td>
			<img src="images/index_19.jpg" width=8 height=460 alt=""></td>
	</tr>
	<tr>
		<td colspan=6><img src="images/index_20.jpg" width=800 height=6 alt=""></td>
	</tr>
	<tr>
		<td colspan=6 background="images/index_20.jpg" width=800 height=140 valign="top" style="padding-left: 40px; padding-right: 40px; padding-bottom: 4px;">
		   <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
		      <tr>
			     <td bgcolor="#EDECE8"></td>
			  </tr>
		   </table>
		</td>
	</tr>
</table>
</body>
</html>