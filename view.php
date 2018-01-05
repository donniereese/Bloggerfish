<?php
include ("config.php.inc");

if ($view == 'list' || !$view) {

	include ("header.php");
	if(!isset($_GET['page'])) {
		$page = 1;
	} else {
		$page = $_GET['page'];
	}
	
	$max_results = 5;
// Figure out the limit for the query based on the current page number.
	$from = (($page * $max_results) - $max_results);
// Perform MySQL query on only the current page number's results
	$bloglist = mysql_query("SELECT * FROM blogs order by id desc LIMIT $from, $max_results");	
	print "<br>";
	
	$test = mysql_fetch_array($bloglist);
	
	//print "<pre>";
	//print_r($test);
	//print "</pre>";
	
	while ($list = mysql_fetch_array($bloglist)) {
		
		if (empty ($bloglist)) {
			print "There are no blogs.  This is very sad. :(";
		} else {
			$owner = mysql_fetch_array(mysql_query("select * from members where id='$list[owner]'"));
			print "<b><a href='users/$owner[user]/index.php?view=blog&blog=$list[id]'>$list[title]</a></b> - $owner[user]<br>";
			print "<i>";
			$descrip = $list[description];
			$length = 100;
			if(strlen($descrip) > $length) {
				preg_match("/[a-zA-Z0-9 \'\.?\>\<\/\n]{0,".$length."}/", $descrip, $M);
				$descrip = $M[0] . '...';
			}
			print "$descrip</i><br>";
			$postcount = mysql_num_rows(mysql_query("select * from posts where blog='$list[id]'"));
			print "<b>$postcount</b>";
			print "<br><br>";
		}
	}
	
	// Figure out the total number of results in DB:
	$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM blogs"),0);
	
	// Figure out the total number of pages. Always round up using ceil()
	$total_pages = ceil($total_results / $max_results);
	
	// Build Page Number Hyperlinks
	print "Select a Page<br>";
	
	// Build Previous Link
	if($page > 1){
		$prev = ($page - 1);
		print "<a href=".$_SERVER['PHP_SELF']."?view=list&page=$prev\">&lt;&lt;Previous</a>&nbsp;";
	}
	
	for($i = 1; $i <= $total_pages; $i++){
		if(($page) == $i){
			print "$i&nbsp;";
		} else {
			print "<a href=".$_SERVER['PHP_SELF']."?view=list&page=$i\">$i</a>&nbsp;";
		}
	}
	
   // Build Next Link
	if($page < $total_pages){
		$next = ($page + 1);
		print "<a href=".$_SERVER['PHP_SELF']."?view=list&page=$next\">Next>></a>";
	} 
	include ("footer.php");
}



if ($view == 'blog') {
   if (!$blog) {
      print "<center><b>You did not choose a blog.<br>Go <a href='view.php'>BACK</a> and choose one.</b></center>";
	  include ("footer.php");
	  exit;
   }
   $ispass = mysql_fetch_array(mysql_query("select * from blogs where id='$blog'"));
   if ($ispass[password]) {
   }
   $bloginfo = mysql_fetch_array(mysql_query("select * from blogs where id='$blog'"));
   $userinfo = mysql_fetch_array(mysql_query("select * from members where id='$bloginfo[owner]'"));
   $bloginfo[page_template] = str_replace("{title}",$bloginfo[title],$bloginfo[page_template]);
   
   print "$bloginfo[page_template]";
   
   
   if(!isset($_GET['page'])) {
      $page = 1;
   } else {
      $page = $_GET['page'];
   }
   
   $max_results = $bloginfo[postperpage];
   
   // Figure out the limit for the query based on the current page number.
   $from = (($page * $max_results) - $max_results);
   
   // Perform MySQL query on only the current page number's results
   $blogposts = mysql_query("SELECT * FROM posts where blog='$blog' order by id desc LIMIT $from, $max_results");
   
   // print "$_SERVER[PHP_SELF]";
   while ($posts = mysql_fetch_array($blogposts)) {
      
      $bloginfo = mysql_fetch_array(mysql_query("select * from blogs where id='$blog'"));
      
	  $commentnum = mysql_num_rows(mysql_query("select * from comments where post='$posts[id]'"));
	  if (empty ($commentnum)) {
	     $commentnum = "0";
	  }
      
	  
      $bloginfo[post_template] = str_replace("{posttitle}",$posts[title],$bloginfo[post_template]);
      $bloginfo[post_template] = str_replace("{post}",$posts[post],$bloginfo[post_template]);
      $bloginfo[post_template] = str_replace("{postdate}",$posts[date],$bloginfo[post_template]);
      $bloginfo[post_template] = str_replace("{posttime}",$posts[time],$bloginfo[post_template]);
      $bloginfo[post_template] = str_replace("{commentnum}","<a href='view.php?view=comment&postid=$posts[id]&blogid=$blog' alt='View Comments'>" . $commentnum . " Comments " . "</a>",$bloginfo[post_template]);
      $bloginfo[post_template] = str_replace("{comment}","<a href='view.php?view=comment&action=comment&postid=$posts[id]&blogid=$blog' alt='View Comments'>Comment</a>",$bloginfo[post_template]);
      
	  print "$bloginfo[post_template]";
   }
   
   
   
   
   // Figure out the total number of results in DB:
   $total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM posts where blog='$blog'"),0);
   
   // Figure out the total number of pages. Always round up using ceil()
   $total_pages = ceil($total_results / $max_results);
   
   // Build Page Number Hyperlinks
   print "<center>Select a Page<br>";
   
   // Build Previous Link
   if($page > 1){
      $prev = ($page - 1);
      print "<a href=".$_SERVER['PHP_SELF']."?view=blog&blog=$blog&page=$prev\"><<Previous</a>&nbsp;";
   }

   for($i = 1; $i <= $total_pages; $i++){
      if(($page) == $i){
         print "$i&nbsp;";
      } else {
         print "<a href=".$_SERVER['PHP_SELF']."?view=blog&blog=$blog&page=$i\">$i</a>&nbsp;";
      }
   }

   // Build Next Link
   if($page < $total_pages){
      $next = ($page + 1);
      print "<a href=".$_SERVER['PHP_SELF']."?view=blog&blog=$blog&page=$next\">Next>></a>";
   } 
   print "</center>";
   
   
   
   
   $bloginfo[about_template] = str_replace("{user}",$userinfo[user],$bloginfo[about_template]);
   $bloginfo[about_template] = str_replace("{bio}",$userinfo[bio],$bloginfo[about_template]);
   $bloginfo[about_template] = str_replace("{age}",$userinfo[age],$bloginfo[about_template]);
   $bloginfo[about_template] = str_replace("{email}",$userinfo[email],$bloginfo[about_template]);
   $bloginfo[about_template] = str_replace("{firstname}",$userinfo[firstname],$bloginfo[about_template]);
   $bloginfo[about_template] = str_replace("{lastname}",$userinfo[lastname],$bloginfo[about_template]);
   $bloginfo[about_template] = str_replace("{gender}",$userinfo[sex],$bloginfo[about_template]);
   
   print "$bloginfo[about_template]";
}

if ($view == 'comment') {
   if (!$postid) {
      include ("header.php");
      print "<center><b>You did not choose a member's post.<br>Go <input type='button' value='Back' onclick='history.back(-1)'> and choose one.</b></center>";
	  include ("footer.php");
	  exit;
   }
   $bloginfo = mysql_fetch_array(mysql_query("select * from blogs where id='$blogid'"));
   $blogposts = mysql_query("select * from posts where blog='$blogid' order by id desc");
   $commentposts = mysql_query("select * from comments where post='$postid' order by id desc");
   $userinfo = mysql_fetch_array(mysql_query("select * from members where id='$bloginfo[owner]'"));
   
   $bloginfo[page_template] = str_replace("{title}",$bloginfo[title],$bloginfo[page_template]);
   
   print "$bloginfo[page_template]";
   
   if ($action == 'comment') {
      print "<form name='editform' method='post' action='view.php?view=comment&action=comment&step=postcomment&postid=$postid&blogid=$blogid'>";
	  if ($status == 'guest') {
	     print "<input name='user' type='hidden' value='$status'>";
	  } else {
	     print "<input name='user' type='hidden' value='$stat[user]'>";
	  }
	  print "<input name='postid' type='hidden' value='$postid'>";
	  print "<input name='blogid' type='hidden' value='$blogid'>";
	  
	  print "<script src='editor.js'></script>"; 
      print "<table width=''>";
      print "<tr><td valign='top' align='right'><b>Options:</b></td>";
	  print "<td bgcolor='#92A6B7'>";
	  ?>
	  <input type='button' value='bold' name='bold' onclick="javascript:tag('b', '[b]', 'bold*', '[/b]', 'bold', 'bold');">
	  <input type='button' value='italic' name='italic' onclick="javascript:tag('i', '[i]', 'italic*', '[/i]', 'italic', 'italic');">
	  <input type='button' value='underline' name='underline' onclick="javascript:tag('u', '[u]', 'underline*', '[/u]', 'underline', 'underline');">
	  <input type='button' value='strike' name='strike' onclick="javascript:tag('s', '[s]', 'strike*', '[/s]', 'strike', 'strike');">
	  <br>
      <img src="images/smilies/icon_smile.gif" alt=":)" onclick="javascript:smile(':)');">
      <img src="images/smilies/icon_biggrin.gif" alt=":D" onclick="javascript:smile(':D');">
      <img src="images/smilies/icon_cry.gif" alt=":*(" onclick="javascript:smile(':*(');">
      <img src="images/smilies/icon_arrow.gif" alt="->" onclick="javascript:smile('->');">
      <img src="images/smilies/icon_sad.gif" alt=":(" onclick="javascript:smile(':(');">
      <img src="images/smilies/icon_confused.gif" alt=":?" onclick="javascript:smile(':?');">
      <img src="images/smilies/icon_mad.gif" alt="x(" onclick="javascript:smile('x(');">
      <img src="images/smilies/icon_idea.gif" alt="!:)" onclick="javascript:smile('!:)');">
      <img src="images/smilies/icon_redface.gif" alt=":#)" onclick="javascript:smile(':#)');">
      <img src="images/smilies/icon_rolleyes.gif" alt="8)" onclick="javascript:smile('8)');">
      <img src="images/smilies/icon_wink.gif" alt=";)" onclick="javascript:smile(';)');">
      <img src="images/smilies/icon_surprised.gif" alt=":o" onclick="javascript:smile(':o');">
      <img src="images/smilies/icon_razz.gif" alt=":p" onclick="javascript:smile(':p');">
      <b>(Click a smily to insert it.)</b>
      </td></tr>
      <tr><td valign='top' align='right'><b>Post:</b></td>
      <td><textarea name='content' rows='10' cols='60' onKeyPress="javascript:txtcount('content');"></textarea></td></tr>
      <?php
      print "<tr><td><input type=submit value='Post'></td><td align='right'><input type='text' name='counter' value='0' size='4' style='background: #EDECE8; border:#EDECE8 solid 0px;'></tr>";
      print "</table>";

	  print "</form>";
      if ($step == 'postcomment') {
      
	     if (empty ($content)) {
	        print "Something was not filled out.";
	     } else {
		    
			$c = explode(" ",$content);
	        $content = strip_tags($content);
	        $content = nl2br($content);
	        $content = str_replace(":)","<img src=images/smilies/icon_smile.gif>",$content);
		    $content = str_replace(":D","<img src=images/smilies/icon_biggrin.gif>",$content);
		    $content = str_replace(":*(","<img src=images/smilies/icon_cry.gif>",$content);
		    $content = str_replace("->","<img src=images/smilies/icon_arrow.gif>",$content);
		    $content = str_replace(":(","<img src=images/smilies/icon_sad.gif>",$content);
		    $content = str_replace(":?","<img src=images/smilies/icon_confused.gif>",$content);
		    $content = str_replace("x(","<img src=images/smilies/icon_mad.gif>",$content);
		    $content = str_replace("!:)","<img src=images/smilies/icon_idea.gif>",$content);
		    $content = str_replace(":#)","<img src=images/smilies/icon_redface.gif>",$content);
		    $content = str_replace("8)","<img src=images/smilies/icon_rolleyes.gif>",$content);
		    $content = str_replace(";)","<img src=images/smilies/icon_wink.gif>",$content);
		    $content = str_replace(":o","<img src=images/smilies/icon_surprised.gif>",$content);
		    $content = str_replace(":p","<img src=images/smilies/icon_razz.gif>",$content);
		    $content = str_replace("[b]","<b>",$content);
		    $content = str_replace("[u]","<u>",$content);
		    $content = str_replace("[i]","<i>",$content);
		    $content = str_replace("[s]","<s>",$content);
		    $content = str_replace("[url='","<a href='",$content);
		    $content = str_replace("']","'>",$content);
		    $content = str_replace("[/url]","</a>",$content);
		    $content = str_replace("[/b]","</b>",$content);
		    $content = str_replace("[/u]","</u>",$content);
		    $content = str_replace("[/i]","</i>",$content);
		    $content = str_replace("[/s]","</s>",$content);
		    
		    $date = date("m/d/y", time());
		    $time = date("h:i a", time());
		    
			if ($status == 'guest') {
			   $username = 'guest';			
			} else {
			   $username = $stat[user];
			}
			
			mysql_query("insert into comments (post, user, comment, time, date) values('$postid', '$username','$content','$time','$date')") or die("Could not add post for some reason.");
		    print "Comment was successfully posted";
			print "<meta http-equiv='refresh' content='2;url=view.php?view=blog&blog=$blogid'>";  
         }
      }
   }
   
   while ($posts = mysql_fetch_array($commentposts)) {
      
	  $bloginfo = mysql_fetch_array(mysql_query("select * from blogs where id='$blogid'"));
      
      $bloginfo[post_template] = str_replace("{posttitle}","<b>Posted By: " . $posts[user],$bloginfo[post_template]);
      $bloginfo[post_template] = str_replace("{post}",$posts[comment],$bloginfo[post_template]);
      $bloginfo[post_template] = str_replace("{postdate}",$posts[date],$bloginfo[post_template]);
      $bloginfo[post_template] = str_replace("{posttime}",$posts[time],$bloginfo[post_template]);
	  $bloginfo[post_template] = str_replace("{commentnum}","&nbsp;",$bloginfo[post_template]);
	  $bloginfo[post_template] = str_replace("{comment} -","&nbsp;&nbsp;",$bloginfo[post_template]);
      
      print "$bloginfo[post_template]";
   }
   
   $bloginfo[about_template] = str_replace("{user}",$userinfo[user],$bloginfo[about_template]);
   $bloginfo[about_template] = str_replace("{bio}",$userinfo[bio],$bloginfo[about_template]);
   $bloginfo[about_template] = str_replace("{age}",$userinfo[age],$bloginfo[about_template]);
   $bloginfo[about_template] = str_replace("{email}",$userinfo[email],$bloginfo[about_template]);
   $bloginfo[about_template] = str_replace("{firstname}",$userinfo[firstname],$bloginfo[about_template]);
   $bloginfo[about_template] = str_replace("{lastname}",$userinfo[lastname],$bloginfo[about_template]);
   $bloginfo[about_template] = str_replace("{gender}",$userinfo[sex],$bloginfo[about_template]);
   
   print "$bloginfo[about_template]";
}

?>