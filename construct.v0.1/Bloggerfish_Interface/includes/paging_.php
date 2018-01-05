<?php

// Includes and Included Functions
include ("includes/pager.php");

// get the pager input values 
$page = $_GET['page'];  
$limit = 20;  
$result = mysql_query("select count(*) from myTable");  
$total = mysql_result($result, 0, 0);  

// work out the pager values 
$pager  = Pager::getPagerData($total, $limit, $page);  
$offset = $pager->offset;  
$limit  = $pager->limit;  
$page   = $pager->page;  

// use pager values to fetch data 
$query = "select * from myTable order by someField limit $offset, $limit";  
$result = mysql_query($query);  

// use $result here to output page content 

// output paging system (could also do it before we output the page content) 
if ($page == 1) {    // this is the first page - there is no previous page 
   echo "Previous";  
} else {             // not the first page, link to the previous page 
   echo "<a href=\"thepage.php?page=" . ($page - 1) . "\">Previous</a>";  

   for ($i = 1; $i <= $pager->numPages; $i++) {  
      echo " | ";  
      if ($i == $pager->page) {
         echo "Page $i";  
      } else {
         echo "<a href=\"thepage.php?page=$i\">Page $i</a>";  
      }  

      if ($page == $pager->numPages) { // this is the last page - there is no next page 
         echo "Next";  
      } else {            // not the last page, link to the next page 
        echo "<a href=\"thepage.php?page=" . ($page + 1) . "\">Next</a>";
      }
   }
}
?> 