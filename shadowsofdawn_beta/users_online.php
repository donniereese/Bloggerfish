<html>
<head>
<link rel=stylesheet href=style.css>
</head>
<body>
<?php include ("config.php"); ?>
<?php
$psel = mysql_query("select * from players");
$ctime = time();
while ($pl = mysql_fetch_array($psel)) {
	$span = ($ctime - $pl[lpv]);
	if ($span <= 1440) {
		if ($pl[rank] == Admin) {
			print "<img src=admin.gif>$pl[tag] <A href=view.php?view=$pl[id] target='_parent'>$pl[user]</a>($pl[id])<br>";
		} else {
		  	print "$pl[tag]<A href=view.php?view=$pl[id] target='_parent'>$pl[user]</a> ($pl[id])<br>";
	    }
		$numo = ($numo + 1);
   }
}

$nump = @mysql_num_rows(mysql_query("select * from players"));

$numw = @mysql_num_rows(mysql_query("select * from equipment where type='W' and owner='Store'"));
$numa = @mysql_num_rows(mysql_query("select * from equipment where type='A' and owner='Store'"));
print "<b>$nump</b> total players.<br>";
print "<b>$numo</b> players online.<br>";
print "<b>$numw</b> weapons.<br>";
print "<b>$numa</b> armor.<br>";

?>

</body>
</html>