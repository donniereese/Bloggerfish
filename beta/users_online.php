<html>
<head>
<link rel=stylesheet href=style.css>
</head>
<body>
<?php include ("config.php.inc"); ?>
<?php
$psel = mysql_query("select * from players");
$ctime = time();
while ($pl = mysql_fetch_array($psel)) {
	$span = ($ctime - $pl[lpv]);
	if ($span <= 180) {
		if ($pl[rank] == Admin) {
			print "<img src=admin.gif>$pl[tag]<A href=view.php?view=$pl[id] target='_parent'>$pl[user]</a> ($pl[id])<br>";
		} else {
		  	print "$pl[tag]<A href=view.php?view=$pl[id] target='_parent'>$pl[user]</a> ($pl[id])<br>";
	    }
		$numo = ($numo + 1);
   }
}
?>

</body>
</html>