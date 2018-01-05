<?php 

// config------------------------------------- 
include ("config.php");

$filename = "pager.php"; // name of this file 
$option = array (10, 20, 30, 40, 50); 
$default = 20; // default number of records per page 
$action = $_SERVER['PHP_SELF']; // if this doesn't work, enter the filename 
$query = "SELECT * FROM members"; // database query. Enter your query here 
// end config--------------------------------- 

$opt_cnt = count ($option); 

$go = $_GET['go']; 
// paranoid 
if ($go == "") { 
   $go = $default; 
} 
elseif (!in_array ($go, $option)) { 
   $go = $default; 
} 
elseif (!is_numeric ($go)) { 
   $go = $default; 
} 
$nol = $go; 
$limit = "0, $nol"; 
$count = 1; 

print "<form name='form1' id='form1' method='get' action='$action'>"; 
print "<select name='go' id='go'>"; 

for ($i = 0; $i <= $opt_cnt; $i ++) { 
   if ($option[$i] == $go) { 
      print "<option value='".$option[$i]."' selected='selected'>".$option[$i]."</option>"; 
   } else { 
      print "<option value='".$option[$i]."'>".$option[$i]."</option>"; 
   } 
} 

print "</select>"; 
print "<input type='submit' name='Submit' id='Submit' value='Go'>"; 
print "</form>"; 


// control query------------------------------ 
/* this query checks how many records you have in your table. 
I created this query so we could be able to check if user is 
trying to append number larger than the number of records 
to the query string.*/ 
$off_sql = mysql_query ("$query") or die ("Error in query: $off_sql".mysql_error()); 
$off_pag = ceil (mysql_num_rows($off_sql) / $nol); 
//-------------------------------------------- 

$off = $_GET['offset']; 
//paranoid 
if (get_magic_quotes_gpc() == 0) { 
   $off = addslashes ($off); 
} 
if (!is_numeric ($off)) { 
   $off = 1; 
} 
// this checks if user is trying to put something stupid in query string 
if ($off > $off_pag) { 
   $off = 1; 
} 

if ($off == "1") { 
   $limit = "0, $nol"; 
} 
elseif ($off <> "") { 
   for ($i = 0; $i <= ($off - 1) * $nol; $i ++) { 
      $limit = "$i, $nol"; 
      $count = $i + 1; 
   } 
} 

// Query to extract records from database. 
$sql = mysql_query ("$query LIMIT $limit") or die ("Error in query: $sql".mysql_error()); 

while ($row = mysql_fetch_array($sql)) {


print "$count. <a href='view.php'>$row-[title]</a><br>"; // this is example, you may enter here anything you like 

$count += 1; 
} 
print "<br><br>"; 
if ($off <> 1) { 
   $prev = $off - 1; 
   print "<a href='$filename?offset=$prev&amp;go=$go'>prev</a> "; 
} 
for ($i = 1; $i <= $off_pag; $i ++) { 
   if ($i == $off) { 
      print "<b> $i </b> "; 
   } else { 
      print " <a href='$filename?offset=$i&amp;go=$go'>$i</a> "; 
   } 
} 
if ($off < $off_pag) { 
   $next = $off + 1; 
   print " <a href='$filename?offset=$next&amp;go=$go'>next</a>"; 
} 

print "<br><br>"; 
print "Page $off of $off_pag<br>"; 
?> 