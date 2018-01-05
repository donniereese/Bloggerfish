<?php
include("config.php");

mysql_query("update players set age=age+1");
mysql_query("update players set energy=max_energy");
mysql_query("update players set hp=max_hp");
mysql_query("update outposts set turns=5");
mysql_query("update outposts set tokens=tokens+100");
?>