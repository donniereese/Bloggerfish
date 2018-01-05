<?php $title = "Indocron City"; include("header.php"); ?>

<?php

if ($mapx = 1 && $mapy = 1) {
	print "<div style=\"width:620px; height:140px; background:#1D1D1D; align:center\"><img src=\"images/map/map1_1.jpg\"></div>";
	print "Dark Black Corner Market?<br>";
	print "<div style=\"width:100px; height:140px; background:#1D1D1D; position:absolute; padding:0; left:200px\"></div>";
	print "<div style=\"width:100px; height:140px; background:#1D1D1D; padding:0; margin-left: 100px;\"></div>";

}

if (empty($mapx) && empty($mapy)) {
	if ($stat[class_type] == "Human") {
		print "\"Welcome, frail one, to the city of eternal darkness, the city of ________________.  It's many layers of ";
		print "life are penatrable by few, and you have the gift, I can see it in your eyes that you are different, you ";
		print "can not hide it from me!\"";
		print "<br><br>";
		print "<a href=\"_map?mapx=1&mapy=1\">Click Here to Coninue to the City</a>";
	}
	if ($stat[class_type] == "Demon") {
		print "Hehe, a young demon to send to a slaughter house is it?";
		print "<br><br>";
		print "<a href=\"_map?mapx=1&mapy=1\">Click Here to Coninue to the City</a>";
	}
	if ($stat[class_type] == "Angel") {
		print "Hehe, a young angel to send to a slaughter house is it?";
		print "<br><br>";
		print "<a href=\"_map?mapx=1&mapy=1\">Click Here to Coninue to the City</a>";
	}

}

?>

<?php include("footer.php"); ?>
