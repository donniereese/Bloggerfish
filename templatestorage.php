<?php session_start(); ?>
<?php
include("config.php.inc");
$status = "";
if (!session_is_registered("user") || !session_is_registered("pass")) {
    $status = "guest";
}
If ($status != "guest") {
    $stat = mysql_fetch_array(mysql_query("select * from members where user='$user' and pass='$pass'"));
    if (empty ($stat[id])) {
		print "$_session[user]";
	    $status = "guest";
    }
}
If ($status != "guest") {
    $ctime = time();
    mysql_query("update memebers set lpv=$ctime where id=$stat[id]");
    $ip = "$HTTP_SERVER_VARS[REMOTE_ADDR]";
    mysql_query("update memebers set ip='$ip' where id=$stat[id]");
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>

<Meta name="Author" content="Donnie Reese">
<Meta name="Publisher" content="Nothing Lost Designs">
<Meta name="Copyright" content="© Copyright 2004 - 2005, Nothing Lost Designs">
<Meta name="Revisit-After" content="4 days">
<Meta name="Keywords" content="free, blog, bloggerfish, online journal, journal, community, blogger, diary, diaries, online diary, web blog, web journal, web diary">
<Meta name="Description" content="A free online community for people to share their thoughts and keep their own journal. The features are endless with bloggerfish.com .">
<Meta name="Audience" content=" All">
<Meta name="Robots" content="ALL">


<link rel="stylesheet" type="text/css" href="style.css">

<title>BloggerFish</title>
</head>
<body bgcolor="#ffffff" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" style="background-image: url(images/backing.jpg); background-position: center top; background-repeat: repeat-x;">

<table border="0" width="100%" cellpadding="0" cellspacing="0" style="position:absolute; right:0px; top:0px;">
	<tr>
		<td align="left" valign="top"><img src="images/header.jpg" width=448 height=144 alt=""></td>
		<td align="right" valign="top"><img src="images/fishylogo.jpg" width=224 height=304 alt=""></td>
	</tr>
</table>


<table width="100%" border="0" cellpadding="0" cellspacing="0" style="position:absolute; right:0px; top:144px;">
	<tr>
		<td rowspan="2" valign="top">
		
		<?php
		If ($status != "guest") {
    	   $stat = mysql_fetch_array(mysql_query("select * from members where user='$user' and pass='$pass'"));
    	   if (empty ($stat[id])) {
	       	  print "Invalid login.";
	    	  exit;
    	   }
		   print "<table width='100%' height='40px' cellpadding='0' cellspacing='0'><tr><td width=''>";
		   print "<b>Signed in as:</b><i> $stat[firstname] $stat[lastname]</i>";
		   print "</td><td width='200px' align='right'>";
		   print "{<a href='cp.php'>Control Panel</a> | ";
		   print "<a href='logout.php'>Log Out</a>}";
		   print "</td></tr></table>";
		} else {
		print "<font size=2>";
		print "<form method='post' action='login.php'>";
		print "<b>User: </b><input name='user' type='text' size='20'>   ";
		print "<b>Password: </b><input name='pass' type='password' size='20'>  ";
		print "<input type='submit' value='Sign In'>";
		print "</form>";
		print "</font>";
		}
		?>

		
		</td>
		
		<td height="154px" width="216px"><br><td>
	</tr>
	<tr>
		<td align="right">
			
			<table width="208px" background="images/menu1back.jpg" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td background="images/menu1header.jpg" valign="bottom" width=208 height=32 style="padding-top:8px; padding-left:14px; padding-right:14px;"><font face="verdana" size="4px"><b>Menu:</b></font></td>
				</tr>
				<tr>
					<td><img src="images/menu1devider.jpg" width=208 height=8 alt=""></td>
				</tr>
				<tr>
					<td style="padding-left:14px; padding-right:14px;">
						<a class="menu" href="index.php">Home</a><br>
						<a class="menu" href="view.php">Blog Listings</a><br>
						<a class="menu" href="profile.php">Member Listings</a><br>
						<a class="menu" href="about.php?view=about">About</a><br>
						<a class="menu" href="about.php?view=FAQ">FAQ's</a><br>
						<a class="menu" href="contact.php">Contact</a><br>
						<br>
					</td>
				</tr>
				<tr>
					<td><img src="images/menu1devider.jpg" width=208 height=8 alt=""></td>
				</tr>
				<tr>
					<td style="padding-left:14px; padding-right:14px;">
						<br>
					</td>
				<tr>
					<td><img src="images/menu1bottom.jpg" width=208 height=24 alt=""></td>
				</tr>
			</table>

			<table width="208px" background="images/menu1back.jpg" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td background="images/menu1header.jpg" valign="bottom" width=208 height=32 style="padding-top:8px; padding-left:14px; padding-right:14px;"><font face="verdana" size="4px"><b>Random User:</b></font></td>
				</tr>
				<tr>
					<td><img src="images/menu1devider.jpg" width=208 height=8 alt=""></td>
				</tr>
				<tr>
					<td style="padding-left:14px; padding-right:14px;">
					
						<?php
						$all = mysql_num_rows(mysql_query("select * from members"));
						$randnum = rand(0, $all);
						$randnum = round($randnum);
						
						if ($randnum == '0') {
						   $randnum = 1;
						}
						
						$randuser = mysql_fetch_array(mysql_query("select * from members where id='$randnum'"));
						
						print "<b><a href='profile.php?view=profile&userid=$randuser[id]'>$randuser[user]</a></b><br><br>";
						
						if (!$randuser[bio]) {
						   print "<i>This user has not edited their bio yet.  Either this user does not know of this feature of does not wish to update it at this time.</i>";
						} else {
						print "<i>&quot; $randuser[bio] &quot;</i>";
						}
						?>
						
					</td>
				</tr>
				<tr>
					<td><img src="images/menu1bottom.jpg" width=208 height=24 alt=""></td>
				</tr>
			</table>

			<table width="208px" background="images/menu1back.jpg" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td background="images/menu1header.jpg" valign="bottom" width=208 height=32 style="padding-top:8px; padding-left:14px; padding-right:14px;"><font face="verdana" size="4px"><b>Random Blog:</b></font></td>
				</tr>
				<tr>
					<td><img src="images/menu1devider.jpg" width=208 height=8 alt=""></td>
				</tr>
				<tr>
					<td style="padding-left:14px; padding-right:14px;">
						
						<?php
						$all = mysql_num_rows(mysql_query("select * from blogs"));
						$randnum = rand(0, $all);
						$randnum = round($randnum);
						
						if ($randnum == '0') {
						   $randnum = 1;
						}
						
						$randblog = mysql_fetch_array(mysql_query("select * from blogs where id='$randnum'"));
						
						while (empty($randblog)) {
						   
						   $randnum = rand(0, $all);
						   $randnum = round($randnum);
   
						   if ($randnum == '0') {
						      $randnum = 1;
						   }
						   
						   $randblog = mysql_fetch_array(mysql_query("select * from blogs where id='$randnum'"));
						}
						
						print "<font size='3'><b><a href='view.php?view=blog&blog=$randblog[id]'>$randblog[title]</a></font></b><br><br>";
						print "<b>Description:</b><br>";
						print "<i>&quot; $randblog[description] &quot;</i>";
						
						?>

					</td>
				</tr>
				<tr>
					<td><img src="images/menu1bottom.jpg" width=208 height=24 alt=""></td>
				</tr>
			</table>

			<table width="208px" background="images/menu1back.jpg" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td background="images/menu1header.jpg" valign="bottom" width=208 height=32 style="padding-top:8px; padding-left:14px; padding-right:14px;"><font face="verdana" size="4px"><b>Web Stats:</b></font></td>
				</tr>
				<tr>
					<td><img src="images/menu1devider.jpg" width=208 height=8 alt=""></td>
				</tr>
				<tr>
					<td style="padding-left:14px; padding-right:14px;">
						
						<?php
						$allusers = mysql_num_rows(mysql_query("select * from members"));
						$allblogs = mysql_num_rows(mysql_query("select * from blogs"));
						
						print "<b>$allusers Total Users</b><br>";
						print "<b>$allblogs Total Blogs</b><br>";
						?>
						
					</td>
				</tr>
				<tr>
					<td><img src="images/menu1bottom.jpg" width=208 height=24 alt=""></td>
				</tr>
			</table>

</td>
</tr>
</table>

		</td>
	</tr>
</table>


</body>
</html>