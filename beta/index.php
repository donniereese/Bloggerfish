<?php
include ("header.php");
/*
print "<table id=\"top_bar\" style=\"position:relative; top:-10px; left:-12px;\">";
print "<tr>";
print "<td id=\"news_list\">";
$list = mysql_query("select * from news order by id desc LIMIT 4");
while($newslist = mysql_fetch_array($list)) {
	print "<a id=\"news_list_item\" href=\"#\">$newslist[subject]</a>";
}
print "</td><td>";
if ($status != "guest") {
	$stat = mysql_fetch_array(mysql_query("select * from members where user='$user' and pass='$pass'"));
	if (empty ($stat[id])) {
		print "Invalid login.";
		exit;
	}
	print "<div id=\"user_bar\" style=\"padding-top:1px;\">";
	print "<b>Signed in as:</b><i> $stat[firstname] $stat[lastname]</i>";
	print "";
	print "{<a href='cp.php'>Control Panel</a> | ";
	print "<a href='logout.php'>Log Out</a>}";
	print "</div>";
} else {
	print "<div id=\"user_bar\" style=\"padding-top: 1px;\">";
	print "<form method='post' action='login.php'>";
	print "<table><tr>";
	print "<td><b>User: </b></td><td><input name='user' type='text' size='20'></td></tr>";
	print "<tr><td><b>Password: </b></td><td><input name='pass' type='password' size='20'></td></tr>";
	print "<tr><td colspan=2><input type='submit' value='Sign In'><td></tr>";
	print "</table>";
	print "</form>";
	print "</div>";
}
print "</td>";
print "</tr>";
print "</table>";

?>
	<div id="news_strip" style="width: 400px;">
		<?php include ("news.php"); ?>
	</div>
	<div id="sidebox">
		<div id="randomuserbox">
			<?php
			$all = mysql_num_rows(mysql_query("select * from members where activity!='suspended'"));
			$randnum = rand(0, $all);
			$randnum = round($randnum);
			
			if ($randnum == '0') {
				$randnum = 1;
			}
			$randuser = mysql_fetch_array(mysql_query("select * from members where id='$randnum' AND activity!='suspended'"));
			print "<b><a href='profile.php?view=profile&userid=$randuser[id]'>$randuser[user]</a></b><br><br>";
			if (!$randuser[bio]) {
				print "<i>This user has not edited their bio yet.  Either this user does not know of this feature of does not wish to update it at this time.</i>";
			} else {
				print "<i>&quot; $randuser[bio] &quot;</i>";
			}
			?>
		</div>
		<div  id="randomblogbox">
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
		</div>
		<div id="statbox">
			<?php
			$allusers = mysql_num_rows(mysql_query("select * from members where activity!='suspended'"));
			$allblogs = mysql_num_rows(mysql_query("select * from blogs"));
			print "<b>$allusers Total Users</b><br>";
			print "<b>$allblogs Total Blogs</b><br>";
			?>
		</div>
	</div>
<?php
*/
?>

		<div id="content">
			<div id="content-main">
				<h1 class="header">Updates</h1>
				<div class="entry">
					<h2><a href="" title="">Entry Name</a></h2>
					<h3 class="date">Month dd, yyyy</h3>
					<p>
					Fusce sed purus. Morbi turpis velit, facilisis sit amet, viverra in, imperdiet interdum, ipsum. 
					Nunc tempus molestie pede. Integer egestas. Donec molestie enim in nisl. Fusce sapien elit, 
					eleifend consequat, tincidunt id, pretium sit amet, pede. Aenean sodales. Nunc fermentum ornare 
					nunc. In tincidunt lobortis felis. Maecenas eleifend dui id nisl.
					</p>
					<p>
					Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. 
					Quisque et lacus. Curabitur non augue eget nunc dapibus nonummy. Pellentesque tortor nisl, pulvinar 
					ac, bibendum nec, ornare ac, risus. Aliquam erat volutpat. Praesent felis sem, mattis ac, pulvinar 
					id, ornare sed, sapien. Praesent sed erat fermentum purus mollis varius. Sed a nunc in ante pharetra 
					bibendum. Aenean nec mauris ac lectus consequat vehicula. Nullam commodo, urna ac nonummy mattis, 
					erat sem tincidunt erat, quis egestas sem sapien non ligula. Nulla eget odio. Duis ullamcorper leo 
					quis elit. Maecenas sed elit. Integer velit. Maecenas ac arcu. Maecenas pulvinar. Vestibulum fermentum 
					dolor id felis.
					</p>
					<p class="posted"><a href="" class="plink">Permanent Link</a> <a href="http://www.simplebits.com/notebook/2006/07/24/webvisions.html#comments" class="clink">5 Comments</a></p>
				</div>
				<div class="entry">
					<h2><a href="" title="">Entry Name</a></h2>
					<h3 class="date">Month dd, yyyy</h3>
					<p>
					Proin sed ligula. In condimentum semper mauris. Ut lacinia nulla tincidunt tortor. Fusce in lectus in 
					nisi fringilla tincidunt. Pellentesque turpis tortor, sodales non, aliquam in, volutpat sed, odio. 
					Phasellus vestibulum magna et dolor. Vestibulum sem diam, feugiat vel, adipiscing nec, posuere id, est. 
					Sed vulputate, enim ac ultricies feugiat, ipsum diam adipiscing augue, eget mattis sem purus in leo. In 
					in tellus. Donec elementum. Suspendisse potenti. Aenean est tellus, pellentesque at, aliquet eget, 
					sagittis ac, mi. Etiam eros. Cras velit. Donec sodales sollicitudin felis. Nam auctor sem a nibh.
					</p>
					<p>
					Proin sed ligula. In condimentum semper mauris. Ut lacinia nulla tincidunt tortor. Fusce in lectus in 
					nisi fringilla tincidunt. Pellentesque turpis tortor, sodales non, aliquam in, volutpat sed, odio. 
					Phasellus vestibulum magna et dolor. Vestibulum sem diam, feugiat vel, adipiscing nec, posuere id, est. 
					Sed vulputate, enim ac ultricies feugiat, ipsum diam adipiscing augue, eget mattis sem purus in leo. In 
					in tellus. Donec elementum. Suspendisse potenti. Aenean est tellus, pellentesque at, aliquet eget, 
					sagittis ac, mi. Etiam eros. Cras velit. Donec sodales sollicitudin felis. Nam auctor sem a nibh.
					</p>
				</div>
			</div>
		</div>
		<div id="column">
			<h2 class="column-header">Rated Reads</h2>
			<div id="column-main">
				<ul class="rate-read-list">
					<li class="rate-read"></li>
					<li class="rate-read"></li>
					<li class="rate-read"></li>
					<li class="rate-read"></li>
					<li class="rate-read"></li>
				</ul>
			</div>
		</div>

<?php
include ("footer.php");
?>