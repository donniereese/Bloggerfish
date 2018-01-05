<?php
// YYYYMMDDHHMMSS

$mysql_timestamp = getdate();

print_r ($mysql_timestamp);

//this should be in one line, i think...
if (ereg("^([0-9]{4})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})",$mysql_timestamp,$res)) {

  $year=$res[1];
  $month=$res[2];
  $day=$res[3];
  $hour=$res[4];
  $min=$res[5];
  $sec=$res[6];

print "year, $month, $day, $hour, $min, $sec";
} else {
     print"false";
}
?>