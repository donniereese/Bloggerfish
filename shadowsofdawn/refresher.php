<?php
include("config.php");
mysql_query("update players set hp=max_hp");
mysql_query("update players set age=age+1");

$msel = mysql_query("select * from players order by id asc");
while ($fetchenergy = mysql_fetch_array($msel)) {
	if ($fetchenergy[energy] < $fetchenergy[max_energy]) {
		mysql_query("update players set energy=max_energy");
	}
}
mysql_query("update players set work=0");
mysql_query("update players set ops=ops+3");
mysql_query("update outposts set turns=turns+5");
mysql_query("update outposts set tokens=tokens+100");

mysql_query("update players set trains=trains+15");

print "Refreshed";

?>
