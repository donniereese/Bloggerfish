<?php $title = "Clock Tower"; include("header.php"); ?>

<?php
$date = date("h:m:s T");
print "The current time is $date. Here is the current reset schedule...<br>";
print "Energy resets are every hour on the hour.<br>";
print "Revives follow at the same time.";
?>

<?php include("footer.php"); ?>