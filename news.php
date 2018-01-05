<?php
include ("config.php.inc");

if(!isset($_GET['page'])) {
    $page = 1;
} else {
    $page = $_GET['page'];
}

$max_results = 1;

// Figure out the limit for the query based on the current page number.
$from = (($page * $max_results) - $max_results);

// Perform MySQL query on only the current page number's results
$sql = mysql_query("SELECT * FROM news order by id desc LIMIT $from, $max_results");

while($row = mysql_fetch_array($sql)) {
    print "<div id=\"news_cell\">";
	print "<div id=\"news_header\">$row[subject]</div>";
	print "<i>$row[starter]</i><br>";
	print "$row[content]";
	print "</div>";
}

// Figure out the total number of results in DB:
$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM news"),0);

// Figure out the total number of pages. Always round up using ceil()
$total_pages = ceil($total_results / $max_results);

// Build Page Number Hyperlinks
echo "<center>Select a Page<br />";

// Build Previous Link
if($page > 1){
    $prev = ($page - 1);
    echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$prev\"><<Previous</a>&nbsp;";
}

for($i = 1; $i <= $total_pages; $i++){
    if(($page) == $i){
        echo "$i&nbsp;";
        } else {
            echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$i\">$i</a>&nbsp;";
    }
}

// Build Next Link
if($page < $total_pages){
    $next = ($page + 1);
    echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$next\">Next>></a>";
} 
echo "</center>";
?>