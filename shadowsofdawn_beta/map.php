<?php $title="Map"; include("header.php"); ?>
<?php
$map_config = mysql_fetch_array(mysql_query("select * from map_config where id='1'"));

if ($move == 'up') {
	$movey = ($stat[coordy] - 1);
	if ($movey >= '1') {
		mysql_query("update players set coordy='$movey' where id=$stat[id]");
	}

} elseif ($move == 'down') {
	$movey = ($stat[coordy] + 1);
	if ($movey <= '5') {
		mysql_query("update players set coordy='$movey' where id=$stat[id]");
	}

} elseif ($move == 'left') {
	$movey = ($stat[coordx] - 1);
	if ($movey >= '1') {
		mysql_query("update players set coordx='$movey' where id=$stat[id]");
	}

} elseif ($move == 'right') {
	$movey = ($stat[coordx] + 1);
	if ($movey <= '5') {
		mysql_query("update players set coordx='$movey' where id=$stat[id]");
	}

}

$pos = mysql_fetch_array(mysql_query("select * from players where user='$user' and pass='$pass'"));
?>
<table id="map_sys" border="0" bgcolor="#626D3D" cellpadding="2" cellspacing="8" style="border: 1px solid #838F58; align: center;">
    <tr>
	    <td width="320px" height="320px" bgcolor="#262626" background="images/image_back.jpg" valign="middle" align="center">
			<table id="map" width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td width="20%" height="20%" valign="top">
					1,1<br>
					<?php
					if ($pos[coordx] == 1 && $pos[coordy] == 1) {
					print "(YOU)<br><img src=\"$stat[icon]\" width=\"20px\" height=\"20px\">";
					}
					
					$psel = mysql_query("select * from players where map='$stat[map]' and coordx='1' and coordy='1'");
					while ($pl = mysql_fetch_array($psel)) {
						print "<br><img src=\"$pl[icon]\" width=\"20px\" height=\"20px\">";
					}
					
					?>
					</td>
					<td width="20%" height="20%" valign="top">
					2,1<br>
					<?php
					if ($pos[coordx] == 2 && $pos[coordy] == 1) {
					print "(YOU)<br><img src=\"$stat[icon]\" width=\"20px\" height=\"20px\">";
					}
					
					$psel = mysql_query("select * from players where (map='$stat[map]' and coordx='2' and coordy='1')");
					while ($pl = mysql_fetch_array($psel)) {
						print "<br><img src=\"$pl[icon]\" width=\"20px\" height=\"20px\">";
					}
					?>
					</td>
					<td width="20%" height="20%" valign="top">
					3,1<br>
					<?php
					if ($pos[coordx] == 3 && $pos[coordy] == 1) {
					print "(YOU)<br><img src=\"$stat[icon]\" width=\"20px\" height=\"20px\">";
					}
					
					$psel = mysql_query("select * from players where (map='$stat[map]' and coordx='3' and coordy='1')");
					while ($pl = mysql_fetch_array($psel)) {
						print "<br><img src=\"$pl[icon]\" width=\"20px\" height=\"20px\">";
					}
					?>
					</td>
					<td width="20%" height="20%" valign="top">
					4,1<br>
					<?php
					if ($pos[coordx] == 4 && $pos[coordy] == 1) {
					print "(YOU)<br><img src=\"$stat[icon]\" width=\"20px\" height=\"20px\">";
					}
					
					$psel = mysql_query("select * from players where (map='$stat[map]' and coordx='4' and coordy='1')");
					while ($pl = mysql_fetch_array($psel)) {
						print "<br><img src=\"$pl[icon]\" width=\"20px\" height=\"20px\">";
					}
					?>
					</td>
					<td width="20%" height="20%" valign="top">
					5,1<br>
					<?php
					if ($pos[coordx] == 5 && $pos[coordy] == 1) {
					print "(YOU)<br><img src=\"$stat[icon]\" width=\"20px\" height=\"20px\">";
					}
					
					$psel = mysql_query("select * from players where (map='$stat[map]' and coordx='5' and coordy='1')");
					while ($pl = mysql_fetch_array($psel)) {
						print "<br><img src=\"$pl[icon]\" width=\"20px\" height=\"20px\">";
					}
					?>
					</td>
				</tr>
				<tr>
					<td width="20%" height="20%" valign="top">
					1,2<br>
					<?php
					if ($pos[coordx] == 1 && $pos[coordy] == 2) {
					print "(YOU)<br><img src=\"$stat[icon]\" width=\"20px\" height=\"20px\">";
					}
					
					$psel = mysql_query("select * from players where (map='$stat[map]' and coordx='1' and coordy='2')");
					while ($pl = mysql_fetch_array($psel)) {
						print "<br><img src=\"$pl[icon]\" width=\"20px\" height=\"20px\">";
					}
					?>
					</td>
					<td width="20%" height="20%" valign="top">
					2,2<br>
					<?php
					if ($pos[coordx] == 2 && $pos[coordy] == 2) {
					print "(YOU)<br><img src=\"$stat[icon]\" width=\"20px\" height=\"20px\">";
					}
					
					$psel = mysql_query("select * from players where (map='$stat[map]' and coordx='2' and coordy='2')");
					while ($pl = mysql_fetch_array($psel)) {
						print "<br><img src=\"$pl[icon]\" width=\"20px\" height=\"20px\">";
					}
					?>
					</td>
					<td width="20%" height="20%" valign="top">
					3,2<br>
					<?php
					if ($pos[coordx] == 3 && $pos[coordy] == 2) {
					print "(YOU)<br><img src=\"$stat[icon]\" width=\"20px\" height=\"20px\">";
					}
					
					$psel = mysql_query("select * from players where (map='$stat[map]' and coordx='3' and coordy='2')");
					while ($pl = mysql_fetch_array($psel)) {
						print "<br><img src=\"$pl[icon]\" width=\"20px\" height=\"20px\">";
					}
					?>
					</td>
					<td width="20%" height="20%" valign="top">
					4,2<br>
					<?php
					if ($pos[coordx] == 4 && $pos[coordy] == 2) {
					print "(YOU)<br><img src=\"$stat[icon]\" width=\"20px\" height=\"20px\">";
					}
					
					$psel = mysql_query("select * from players where (map='$stat[map]' and coordx='4' and coordy='2')");
					while ($pl = mysql_fetch_array($psel)) {
						print "<br><img src=\"$pl[icon]\" width=\"20px\" height=\"20px\">";
					}
					?>
					</td>
					<td width="20%" height="20%" valign="top">
					5,2<br>
					<?php
					if ($pos[coordx] == 5 && $pos[coordy] == 2) {
					print "(YOU)<br><img src=\"$stat[icon]\" width=\"20px\" height=\"20px\">";
					}
					
					$psel = mysql_query("select * from players where (map='$stat[map]' and coordx='5' and coordy='2')");
					while ($pl = mysql_fetch_array($psel)) {
						print "<br><img src=\"$pl[icon]\" width=\"20px\" height=\"20px\">";
					}
					?>
					</td>
				</tr>
				<tr>
					<td width="20%" height="20%" valign="top">
					1,3<br>
					<?php
					if ($pos[coordx] == 1 && $pos[coordy] == 3) {
					print "(YOU)<br><img src=\"$stat[icon]\" width=\"20px\" height=\"20px\">";
					}
					
					$psel = mysql_query("select * from players where (map='$stat[map]' and coordx='1' and coordy='3')");
					while ($pl = mysql_fetch_array($psel)) {
						print "<br><img src=\"$pl[icon]\" width=\"20px\" height=\"20px\">";
					}
					?>
					</td>
					<td width="20%" height="20%" valign="top">
					2,3<br>
					<?php
					if ($pos[coordx] == 2 && $pos[coordy] == 3) {
					print "(YOU)<br><img src=\"$stat[icon]\" width=\"20px\" height=\"20px\">";
					}
					
					$psel = mysql_query("select * from players where (map='$stat[map]' and coordx='2' and coordy='3')");
					while ($pl = mysql_fetch_array($psel)) {
						print "<br><img src=\"$pl[icon]\" width=\"20px\" height=\"20px\">";
					}
					?>
					</td>
					<td width="20%" height="20%" valign="top">
					3,3<br>
					<?php
					if ($pos[coordx] == 3 && $pos[coordy] == 3) {
					print "(YOU)<br><img src=\"$stat[icon]\" width=\"20px\" height=\"20px\">";
					}
					
					$psel = mysql_query("select * from players where (map='$stat[map]' and coordx='3' and coordy='3')");
					while ($pl = mysql_fetch_array($psel)) {
						print "<br><img src=\"$pl[icon]\" width=\"20px\" height=\"20px\">";
					}
					?>
					</td>
					<td width="20%" height="20%" valign="top">
					4,3<br>
					<?php
					if ($pos[coordx] == 4 && $pos[coordy] == 3) {
					print "(YOU)<br><img src=\"$stat[icon]\" width=\"20px\" height=\"20px\">";
					}
					
					$psel = mysql_query("select * from players where (map='$stat[map]' and coordx='4' and coordy='3')");
					while ($pl = mysql_fetch_array($psel)) {
						print "<br><img src=\"$pl[icon]\" width=\"20px\" height=\"20px\">";
					}
					?>
					</td>
					<td width="20%" height="20%" valign="top">
					5,3<br>
					<?php
					if ($pos[coordx] == 5 && $pos[coordy] == 3) {
					print "(YOU)<br><img src=\"$stat[icon]\" width=\"20px\" height=\"20px\">";
					}
					
					$psel = mysql_query("select * from players where (map='$stat[map]' and coordx='5' and coordy='3')");
					while ($pl = mysql_fetch_array($psel)) {
						print "<br><img src=\"$pl[icon]\" width=\"20px\" height=\"20px\">";
					}
					?>
					</td>
				</tr>
				<tr>
					<td width="20%" height="20%" valign="top">
					1,4<br>
					<?php
					if ($pos[coordx] == 1 && $pos[coordy] == 4) {
					print "(YOU)<br><img src=\"$stat[icon]\" width=\"20px\" height=\"20px\">";
					}
					
					$psel = mysql_query("select * from players where (map='$stat[map]' and coordx='1' and coordy='4')");
					while ($pl = mysql_fetch_array($psel)) {
						print "<br><img src=\"$pl[icon]\" width=\"20px\" height=\"20px\">";
					}
					?>
					</td>
					<td width="20%" height="20%" valign="top">
					2,4<br>
					<?php
					if ($pos[coordx] == 2 && $pos[coordy] == 4) {
					print "(YOU)<br><img src=\"$stat[icon]\" width=\"20px\" height=\"20px\">";
					}
					
					$psel = mysql_query("select * from players where (map='$stat[map]' and coordx='2' and coordy='4')");
					while ($pl = mysql_fetch_array($psel)) {
						print "<br><img src=\"$pl[icon]\" width=\"20px\" height=\"20px\">";
					}
					?>
					</td>
					<td width="20%" height="20%" valign="top">
					3,4<br>
					<?php
					if ($pos[coordx] == 3 && $pos[coordy] == 4) {
					print "(YOU)<br><img src=\"$stat[icon]\" width=\"20px\" height=\"20px\">";
					}
					
					$psel = mysql_query("select * from players where (map='$stat[map]' and coordx='3' and coordy='4')");
					while ($pl = mysql_fetch_array($psel)) {
						print "<br><img src=\"$pl[icon]\" width=\"20px\" height=\"20px\">";
					}
					?>
					</td>
					<td width="20%" height="20%" valign="top">
					4,4<br>
					<?php
					if ($pos[coordx] == 4 && $pos[coordy] == 4) {
					print "(YOU)<br><img src=\"$stat[icon]\" width=\"20px\" height=\"20px\">";
					}
					
					$psel = mysql_query("select * from players where (map='$stat[map]' and coordx='4' and coordy='4')");
					while ($pl = mysql_fetch_array($psel)) {
						print "<br><img src=\"$pl[icon]\" width=\"20px\" height=\"20px\">";
					}
					?>
					</td>
					<td width="20%" height="20%" valign="top">
					5,4<br>
					<?php
					if ($pos[coordx] == 5 && $pos[coordy] == 4) {
					print "(YOU)<br><img src=\"$stat[icon]\" width=\"20px\" height=\"20px\">";
					}
					
					$psel = mysql_query("select * from players where (map='$stat[map]' and coordx='5' and coordy='4')");
					while ($pl = mysql_fetch_array($psel)) {
						print "<br><img src=\"$pl[icon]\" width=\"20px\" height=\"20px\">";
					}
					?>
					</td>
				</tr>
				<tr>
					<td width="20%" height="20%" valign="top">
					1,5<br>
					<?php
					if ($pos[coordx] == 1 && $pos[coordy] == 5) {
					print "(YOU)<br><img src=\"$stat[icon]\" width=\"20px\" height=\"20px\">";
					}
					
					$psel = mysql_query("select * from players where (map='$stat[map]' and coordx='1' and coordy='5')");
					while ($pl = mysql_fetch_array($psel)) {
						print "<br><img src=\"$pl[icon]\" width=\"20px\" height=\"20px\">";
					}
					?>
					</td>
					<td width="20%" height="20%" valign="top">
					2,5<br>
					<?php
					if ($pos[coordx] == 2 && $pos[coordy] == 5) {
					print "(YOU)<br><img src=\"$stat[icon]\" width=\"20px\" height=\"20px\">";
					}
					
					$psel = mysql_query("select * from players where (map='$stat[map]' and coordx='2' and coordy='5')");
					while ($pl = mysql_fetch_array($psel)) {
						print "<br><img src=\"$pl[icon]\" width=\"20px\" height=\"20px\">";
					}
					?>
					</td>
					<td width="20%" height="20%" valign="top">
					3,5<br>
					<?php
					if ($pos[coordx] == 3 && $pos[coordy] == 5) {
					print "(YOU)<br><img src=\"$stat[icon]\" width=\"20px\" height=\"20px\">";
					}
					
					$psel = mysql_query("select * from players where (map='$stat[map]' and coordx='3' and coordy='5')");
					while ($pl = mysql_fetch_array($psel)) {
						print "<br><img src=\"$pl[icon]\" width=\"20px\" height=\"20px\">";
					}
					?>
					</td>
					<td width="20%" height="20%" valign="top">
					4,5<br>
					<?php
					if ($pos[coordx] == 4 && $pos[coordy] == 5) {
					print "(YOU)<br><img src=\"$stat[icon]\" width=\"20px\" height=\"20px\">";
					}
					
					$psel = mysql_query("select * from players where (map='$stat[map]' and coordx='4' and coordy='5')");
					while ($pl = mysql_fetch_array($psel)) {
						print "<br><img src=\"$pl[icon]\" width=\"20px\" height=\"20px\">";
					}
					?>
					</td>
					<td width="20%" height="20%" valign="top">
					5,5<br>
					<?php
					if ($pos[coordx] == 5 && $pos[coordy] == 5) {
					print "(YOU)<br><img src=\"$stat[icon]\" width=\"20px\" height=\"20px\">";
					}
					
					$psel = mysql_query("select * from players where (map='$stat[map]' and coordx='5' and coordy='5')");
					while ($pl = mysql_fetch_array($psel)) {
						print "<br><img src=\"$pl[icon]\" width=\"20px\" height=\"20px\">";
					}
					?>
					</td>
				</tr>
			</table>
		</td>
		<td bgcolor="#262626" valign="top">
			<table border="0" width="412px" cellspacing="4" bgcolor="#454545" style="border:1px solid #747474;">
			    <tr>
				    <td style="background:#30322A;">
			        <b style="font-size:12px; color:#94BF00;">Map Name: </b><?php print "$pos[map]"; ?>
			        </td>
			    </tr>
			    <tr>
			    	<td style="background:#494C41;">
			        <b style="font-size:12px; color:#94BF00;">Coords: </b><?php print "($pos[coordx] , $pos[coordy])"; ?>
			        </td>
			    </tr>
			    <tr>
				    <td style="background:#30322A;">
			        <b style="font-size:12px; color:#94BF00;">Location: </b><?php print "$artist[location]"; ?>
			        </td>
			    </tr>
			    <tr>
				    <td style="background:#494C41">
			        <b style="font-size:12px; color:#94BF00;">Time: </b><?php print "<a href='mailto:$artist[email]'>$artist[email]</a>"; ?>
			        </td>
			    </tr>
			    <tr>
				    <td valign="top" style="background:#30322A; height: 48px;">
			        <b style="font-size:12px; color:#94BF00;">Options: </b><?php print "$artist[schooling]"; ?>
					<br>
					[<a href="map.php?move=left">Left</a>] [<a href="map.php?move=up">Up</a>] [<a href="map.php?move=down">Down</a>] [<a href="map.php?move=right">Right</a>]
			        </td>
			    </tr>
		    </table>
			<br>
			<table border="0" width="412px" height="166px" cellspacing="4" bgcolor="#454545" style="border:1px solid #747474;">
			    <tr>
				    <td style="background:#30322A;" valign="top"><b style="font-size:12px; color:#94BF00;">Players: </b><br>
			        <?php
					
					$psel = mysql_query("select * from players where map='$stat[map]'");
					$ctime = time();
					while ($pl = mysql_fetch_array($psel)) {
						$span = ($ctime - $pl[lpv]);
						//if ($span <= 1440) {
							if ($pl[rank] == Admin) {
								print "[<img src=admin.gif>$pl[tag] <A href=view.php?view=$pl[id] target='_parent'>$pl[user]</a>($pl[id])] - ";
							} else {
							  	print "[$pl[tag]<A href=view.php?view=$pl[id]>$pl[user]</a> ($pl[id])] - ";
						//    }
							$numo = ($numo + 1);
						}
					}
					
					?>
			        </td>
			    </tr>
		    </table>
			
		</td>
	</tr>
	<tr>
	    <td  bgcolor="#262626" colspan="2">
			<table border="0" width="744px" height="200px" cellspacing="4" bgcolor="#191D26" style="border:1px solid #101724;">
			    <tr>
				    <td style="background:#323B4C;" valign="top" style="height">
			        <iframe src="disabled.php" name="personal_works" width="100%" height="148px" frameborder="0" marginwidth="0" marginheight="0" scrolling="auto"></iframe>
			        </td>
				</tr>
				<tr></tr>
					<td style="background:#323B4C; width: 100%; height:40px;" valign="top">
			        asdf
			        </td>
			    </tr>
		    </table>
		</td>
    </tr>
</table>

<?php include("footer.php"); ?>