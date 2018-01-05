<?php
mysql_connect("localhost","bloggie","greatbigfish");
mysql_select_db("bloggerfish");

DEFINE(STANDARDDB, mysql_connect("localhost","bloggie","greatbigfish"));
?>