<?php $title = "Referral Center";  include("header.php"); ?>
<?php
print "Welcome to the referral center. Every time someone signs up using ";
print "this link (<i>http://darkabyss.elixant.com/exofusion/register.php?ref=$stat[id]</i>), ";
print "you get one referral point. After a while, those points add up, and you can buy a ";
print "special store which will soon open. Also, you already have <b>$stat[refs]</b> referral points.";

?>
<?php include("footer.php"); ?>