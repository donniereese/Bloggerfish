<?php
error_reporting('0');
ini_set('display_errors', '0');

if(!isset($_REQUEST['date'])){
	$date = mktime(0,0,0,date('m'), date('d'), date('Y')); 
} else {
	$date = $_REQUEST['date'];
}
$day = date('d', $date);
$month = date('m', $date);
$year = date('Y', $date);

$month_start = mktime(0,0,0,$month, 1, $year);
$month_name = date('M', $month_start);
$month_start_day = date('D', $month_start);

if($month == 1){
	$num_days_last = cal_days_in_month(0, 12, ($year -1));
} else {
	$num_days_last = cal_days_in_month(0, ($month -1), $year);
}

$num_days_current = cal_days_in_month(0, $month, $year);

for($i = 1; $i <= $num_days_current; $i++){
	$num_days_array[] = $i;
}

for($i = 1; $i <= $num_days_last; $i++){
    $num_days_last_array[] = $i;
}

if($offset > 0){
	$offset_correction = array_slice($num_days_last_array, -$offset, $offset);
	$new_count = array_merge($offset_correction, $num_days_array);
	$offset_count = count($offset_correction);
} else {
	$new_count = $num_days_array;
}

$current_num = count($new_count);

if($current_num > 35){
	$num_weeks = 6;
	$outset = (42 - $current_num);
} elseif($current_num < 35){
	$num_weeks = 5;
	$outset = (35 - $current_num);
}
if($current_num == 35){
	$num_weeks = 5;
	$outset = 0;
}

for($i = 1; $i <= $outset; $i++){
	$new_count[] = $i;
}

$weeks = array_chunk($new_count, 7);

$previous_link = "<a href=\"".$_SERVER['PHP_SELF']."?date=";
if($month == 1){
	$previous_link .= mktime(0,0,0,12,$day,($year -1));
} else {
	$previous_link .= mktime(0,0,0,($month -1),$day,$year);
}
$previous_link .= "\"><< Prev</a>";

$next_link = "<a href=\"".$_SERVER['PHP_SELF']."?date=";
if($month == 12){
	$next_link .= mktime(0,0,0,1,$day,($year + 1));
} else {
	$next_link .= mktime(0,0,0,($month +1),$day,$year);
}
$next_link .= "\">Next >></a>";

//
if(empty($offset)){
     echo "Omg empty string.";
  }else{
     echo "Omg the string isnt empty!";
  }
print "offset: " . empty($offset) . "<br>";
print "offset_correction: " . empty($offset_correction) . "<br>";
print "offset_count: " . empty($offset_count) . "<br>";
//
echo "<table id=\"calender\" cellpadding=\"2\" cellspacing=\"0\" class=\"calendar\">\n".
	"<tr>\n".
	"<td colspan=\"7\">".
	"<table id=\"calenderheader\" align=\"center\">".
	"<tr>".
	"<td colspan=\"2\" width=\"75\" align=\"left\">$previous_link</td>\n".
	"<td colspan=\"3\" width=\"150\" align=\"center\">$month_name $year</td>\n".
	"<td colspan=\"2\" width=\"75\" align=\"right\">$next_link</td>\n".
	"</tr>\n".
	"</table>\n".
	"</td>\n".
	"<tr>\n".
	"<td>S</td><td>M</td><td>T</td><td>W</td><td>T</td><td>F</td><td>S</td>\n".
	"</tr>\n";

$i = 0;
foreach($weeks AS $week){
	echo "<tr>\n";
	foreach($week as $d){
		if($i < $offset_count){
			$day_link = "<a href=\"".$_SERVER['PHP_SELF']."?date=".mktime(0,0,0,$month -1,$d,$year)."\">$d</a>";
			echo "<td class=\"nonmonthdays\">$day_link</td>\n";
		}
		if(($i >= $offset_count) && ($i < ($num_weeks * 7) - $outset)){
			if($date == mktime(0,0,0,$month,$d,$year)){
				echo "<td class=\"today\">$d</td>\n";
			} else {
				echo "<td class=\"days\"><a href=\"".$_SERVER['PHP_SELF']."?date=".mktime(0,0,0,$month,$d,$year)."\">$d</a></td>\n";
			}
		} elseif($i >= ($num_weeks * 7) - $outset) {
			$day_link = "<a href=\"".$_SERVER['PHP_SELF']."?date=".mktime(0,0,0,$month +1,$d,$year)."\">$d</a>";
			echo "<td class=\"nonmonthdays\">$day_link</td>\n";
		}
		$i++;
	}
	echo "</tr>\n";
}
echo '<tr><td colspan="7" class="days"> </td></tr>';
echo '</table>';
?>