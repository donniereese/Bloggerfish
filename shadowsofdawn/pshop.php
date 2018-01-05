<?php $title = "Platinum Shop"; include("header.php"); ?>

<?php
if ($action != buy) {
	print "Platinum isn't always a stable-priced commodity... right now its 135 credits a bar. How much you want?";
	print "<form method=post action=pshop.php?action=buy>";
	print "I want <input type=text name=plat> platinum. <input type=submit value=Buy>";
	print "</form>";
	print "Trade 200 platinum for 1 AP.  Click <a href=pshop.php?action=ap>here</a>.";
} else {
    if ($action = buy) {
	$cost = ($plat * 135);
	if ($cost > $stat[credits] || $plat <= 0) {
		print "You cant afford that! (<a href=pshop.php>back</a>)";
	} else {
		mysql_query("update players set credits=credits-$cost where id=$stat[id]");
		mysql_query("update players set platinum=platinum+$plat where id=$stat[id]");
		print "You got <b>$plat</b> platinum for <b>$cost</b> credits.";
	}
  }
  if ($action = ap) {
	if (200 > $stat[ap] || $plat < 0) {
		print "You cant afford that! (<a href=pshop.php>back</a>)";
	} else {
		mysql_query("update players set ap=ap+1 where id=$stat[id]");
		mysql_query("update players set platinum=platinum-100 where id=$stat[id]");
		print "You got <b>$plat</b> platinum for <b>$cost</b> credits.";
	}
  }
}
?>

<?php include("footer.php"); ?>

