<?php
mysql_query("update players set ap=ap+3 where id=$stat[id]");
mysql_query("update players set level=level+1 where id=$stat[id]");
mysql_query("update players set exp=0 where id=$stat[id]");
?>