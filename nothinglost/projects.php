<?php include ("header.php"); ?>

<?php
print "<div style=\"padding:4px;\">";

if ($view == "project") {
	if (!empty($projectid)) {
		$sql = mysql_query("select * from projects where id='$projectid'");
		$project = mysql_fetch_array($sql);
		
		print "<font style=\"font-size: 26px; color:#430102;\">$project[name]</font><br>";
		print "<br>";
				
		print "<div>";
		print "<font style=\"font-size: 14px; font-weight:bold;\">Images:</font><br>";
		$getimages = mysql_query("select * from works where project='$projectid'");
		while ($image = mysql_fetch_array($getimages)) {
			print "<img src=\"$image[image]\">";
		}
		print "</div>";
		
		print "<br>";
		
		print "<div>";
		print "<font style=\"font-size: 14px; font-weight:bold;\">Tasks:</font>";
		
		$getlist = mysql_query("select * from tasks where project='$projectid'");
		while ($list = mysql_fetch_array($getlist)) {
			print "<div style=\"display:block; margin-left:26px; width:320px; border-bottom: 1px dashed #7185A0;\">";
			print "<div style=\"margin-left:-18px\"><b style=\"font-size:12px\">$list[id].</b> $list[title]</div>";
			
			print "<div style=\"padding-right:10px; padding-left:10px; margin-bottom:4px; margin-top:4px;\">$list[description]</div>";
			
			print "<div style=\"background-color: #30232D; border:2px solid #191D26; width:100px; height:14px; margin-top:2px;\">";
			print "<div style=\"background-color:#430102; width:$list[percent_complete]px; height:14px;\">";
			print "</div>";
			print "</div>";
			print "$list[percent_complete]% / 100%";
			print "</div>";
		}
		print "</div>";
		
	} else {
		print "Please choose a project to view...<br><br>";
	}
}


if ($view == "main" || empty($view)) {
	
	$getlist = mysql_query("select * from projects");
	while ($list = mysql_fetch_array($getlist)) {
		print "<div style=\"background: #394352; padding: 2px;\">";
		print "<a href=\"projects.php?view=project&projectid=$list[id]\">$list[name]</a><br>";
		print "</div>";
	}
	
}


print "</div>";
?>

<?php include ("footer.php"); ?>