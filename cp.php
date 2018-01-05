<?php //include ("header.php"); 
?>
<pre>
<?php
error_reporting(E_ALL);
?>
<script type="text/javascript">
function open_pref(blog_id, sub_id) {
	orig_height = document.getElementById(blog_id).style.height;
	document.getElementById(sub_id).style.visibility = "visible";
	document.getElementById(blog_id).style.height= "300px";
	document.getElementById(sub_id).style.height = "100%";
}
function close_pref(blog_id, sub_id) { 
	document.getElementById(blog_id).style.height = orig_height;
	document.getElementById(sub_id).style.visibility = "hidden";
	document.getElementById(sub_id).style.height = "0px";
}
</script>

<?php

//include ("functions.php");
?>

<link rel="stylesheet" href="controlpanel.css">

<div id="box3">
<div style="background-color: #222233; padding:8px;">
<a id="menu_button" href="cp.php">Controls Home</a> 
<a id="menu_button" href="#">Your Blogs</a> 
<?php if ($stat[status] == "admin") { print "<a id=\"menu_button\" href=\"cp.php?view=files\">Your Files</a> "; } ?>
<a id="menu_button" href="#">Your PM's</a> 
<a id="menu_button" href="profile.php?view=edit">Your Profile</a>
</div>
</div>

<?php
//
//class functions {
//	function log($friendstat, $subject, $message) {
//		$datetime = time();
//		mysql_query("insert into alerts (owner, subject, message, timestamp, priority) values('$friendstat[id]','$subject','$message','$datetime','3')") or die("<br><br>Could not send the alert: " . mysql_error() . "<br><br>");
//	}
//}
//
//class cp_functions {
//	
//	function update_blog_config($title, $description, $css, $dir_show, $personal_hide, $blogid) {
//		mysql_query("update blogs set title='$title' where id='$blogid'") or die("Could not update title: " . mysql_error());
//		mysql_query("update blogs set description='$description' where id='$blogid'") or die("Could not update description: " . mysql_error());
//		mysql_query("update blogs set css='$css' where id='$blogid'") or die("Could not update css: " . mysql_error());
//		if ($dir_show == "yes") {
//			$show_in_dir = "no";
//		} else {
//			$show_in_dir = "yes";
//		}
//		mysql_query("update blogs set show_directory='$show_in_dir' where id='$blogid'") or die("Could not update privacy settings: " . mysql_error());
//		
//		if ($personal_hide == "yes") {
//			$hide_personal_blog = "yes";
//		} else {
//			$hide_personal_blog = "no";
//		}
//		mysql_query("update blogs set hide_blog_all='$hide_personal_blog' where id='$blogid'") or die("Could not update privacy settings: " . mysql_error());
//		
//		
//		print "<div>Blog Configuration Updated...</div>";
//	}
//	
//	function show_friendlist() {
//		$stat = mysql_fetch_array(mysql_query("select * from members where user='$_SESSION[user]'"));
//		$friends = explode('|', $stat[friends]);
//		$count = count($friends);
//		$count--;
//		$x = 0;
//		while ($x <= $count) {
//			print "<div style=\"border-bottom:1px solid #333369; padding:1px;\" onmouseover=\"this.style.background='#333344'\" onmouseout=\"this.style.background='#222233'\"><a style=\"text-decoration:none;\" href=\"http://www.bloggerfish.com/users/$friends[$x]\">$friends[$x]</a></div>";
//			$x++;
//		}
//	}
//	
//	function add_friend($addname) {
//		$exist = mysql_num_rows(mysql_query("select * from members where user='$addname'"));
//		if ($exist != 1) {
//			print "<b>User does not exist.</b><br>";
//		} else {
//			$stat = mysql_fetch_array(mysql_query("select * from members where user='$_SESSION[user]'"));
//			$friends = explode('|', $stat[friends]);
//			if (in_array($addname, $friends)) {
//				print "<b>" . $addname . " is already on your list.</b><br>";
//			} else {
//				if (empty($stat[friends])) {
//					$stat[friends] = $stat[friends] . "$addname";
//				} else {
//					$stat[friends] = $stat[friends] . "|$addname";
//				}
//				
//				$friendstat = mysql_fetch_array(mysql_query("select * from members where user='$addname'"));
//				$subject = "";
//				$message = "<a href=\"http://www.bloggerfish.com/users/$stat[user]\">$stat[user]</a> has added you to their friend\'s list.";
//								
//				$datetime = time();
//				
//				mysql_query("update members set friends='$stat[friends]' where id='$stat[id]'");
//				mysql_query("insert into alerts (owner, subject, message, timestamp, priority) values('$friendstat[id]','$subject','$message','$datetime','3')") or die("<br><br>Could not send the alert: " . mysql_error() . "<br><br>");
//		
//			}
//		}
//	}
//}


// Main Control Panel View: The frontpage that all Control Panel's have.  All tools utilized through this
if ($view == main || !$view) {
?>	
<br>
<div style="margin:0px auto; padding:1px; text-align: left;">
<div style="background-color:#ffffff; border:4px solid #664466; text-align:left; padding:4px; margin:0px auto; width:400px;">
<b style="color:#000000;"> Your Page: </b>
<?php print "<a href=\"users/$stat[user]\">http://www.bloggerfish.com/users/$stat[user]</a>"; ?>
</div>
</div>
<br>
<table id="main_table">
	<tr>
		<td id="bloglist_td">
			<div id="box3">
			<div id="blog_window">
				<table id="blog_listing_columns" cellspacing="0">
					<tr>
						<td colspan="3"><font style="font-size:18px; font-weight:bold;">Your Blogs:</font></td>
					</tr>
				</table>
<?php	
	$count = mysql_query("select * from blogs where owner='$stat[id]' order by id desc");
	while ($blogcount = mysql_fetch_array($count)) {
		if (empty ($blogcount)) {
			print "<div><center><h4>You haven't created a blog yet!</h4><a href='cp.php?view=blognew'>Click Here to create one.</a></center></div>";
		} else {
			$postcount = mysql_num_rows(mysql_query("select * from posts where blog='$blogcount[id]'"));
			
			print "<div id=\"listing\">";
			print "<div id=\"blog_tab\" onmouseover=\"this.id='blog_tab_hover'\" onmouseout=\"this.id='blog_tab'\">";
//			print "<font style=\"font-size:14px; font-weight:bold;\">$blogcount[title]</font>";
			print "<a href=\"cp.php?submenu=yes&blogid=$blogcount[id]\" style=\"color: #ffffff; text-decoration: none; font-size:14px; font-weight:bold;\">$blogcount[title]</a>";
			print "</div>";
//			print "<div style=\"padding-left:16px;\">";
//			print "<a href='cp.php?view=postnew&blogid=$blogcount[id]'>New Post</a> | ";
//			print " <a target='_blank' href='users/$stat[user]/index.php?view=blog&blog=$blogcount[id]'>View</a> | ";
//			print " <a href='cp.php?view=delblog&blogid=$blogcount[id]'>Delete</a> | ";
//			print " <a href='cp.php?submenu=yes&blogid=$blogcount[id]'>Preferences</a>";
//			print " <a href='cp.php?view=blogedit&blogid=$blogcount[id]'>Preferences</a>";
//			print " <a href=\"#\" onclick=\"open_pref('$blogcount[id]','sub$blogcount[id]')\">Preferences</a>";
//			print "<b>$postcount</b>";
//			print "</div>";
			print "</div>";
			if ($submenu != "yes") {
				
			} elseif ($submenu == "yes") {
				if ($blogcount[id] != $blogid) {
					
				} else {
										
					if ($sub == "view") {
						
					} else {
						print "<div id=\"small_bar\" onmouseover=\"this.id='small_bar_hover'\" onmouseout=\"this.id='small_bar'\">";
						print " <a target='_blank' href='users/$stat[user]/index.php?view=blog&blog=$blogcount[id]' style=\"color:#9FA8BD; text-decoration: none;\">View</a>";
						print "</div>";
					}
					
					if ($sub == "new_post") {
						if ($step == add) {
							if ((empty ($title)) || (empty ($content)) || (empty ($blogid))) {
								print "<div style=\"border:2px solid #451211; background-color: #591E3B; color: #ffffff; font-weight: bold; margin: 32px; padding: 4px;\">";
								print "<font style=\"color: #ff0000; font-size: 34px; font-weight: bold; font-family: Georgia, Times, Times New Roman, sans-serif; text-align:center; vertical-align: middle;\">! </font>";
								print "Something was not filled out.</div>";
							} else {
								
								$c = explode(" ",$content);
								$content = strip_tags($content);
								$datetime = time();
								mysql_query("insert into posts (blog, owner, title, timestamp, post) values('$blogid', '$stat[id]', '$title','$datetime','$content')") or die("Could not add your entry.<br><br>" . mysql_error());
								mysql_query("update members set points=points+1 where id='$stat[id]'") or die("We are sorry, but we could not update your points. Please try again.<br>");
								print "Entry Added Successfully.<br>";
								print "<meta http-equiv='refresh' content='2;url=cp.php'>";
							}
						}
						
						
						print "<script src='editor.js'></script>";
						print "<form name='editform' method=post action=cp.php?submenu=yes&blogid=$blogid&sub=new_post&step=add>";
						print "<table width=''>";
						print "<tr><td valign='top' align='right'><b>Title:</b></td>";
						print "<input name='blogid' type='hidden' value='$blogid'>";
						print "<td><input type='text' name='title' maxlength='80' value=\"" . $_POST[title] . "\" style=\"width:426px;\"></td></tr>";
						print "<tr><td valign='top' align='right'><b>Options:</b></td>";
						print "<td>";
						print "<div style=\"background-color:#92A6B7; padding:2px; width:422px;\">";
						print "<input type=\"button\" value=\"bold\" name=\"bold\" onclick=\"javascript:tag('b', '[b]', 'bold*', '[/b]', 'bold', 'bold');\">";
						print "<input type=\"button\" value=\"italic\" name=\"italic\" onclick=\"javascript:tag('i', '[i]', 'italic*', '[/i]', 'italic', 'italic');\">";
						print "<input type=\"button\" value=\"underline\" name=\"underline\" onclick=\"javascript:tag('u', '[u]', 'underline*', '[/u]', 'underline', 'underline');\">";
						print "<input type=\"button\" value=\"strike\" name=\"strike\" onclick=\"javascript:tag('s', '[s]', 'strike*', '[/s]', 'strike', 'strike');\">"; 
						print "<br>";
						
						print "<img src=\"images/smilies/icon_smile.gif\" alt=\":)\" onclick=\"javascript:smile(':)');\">";
						print "<img src=\"images/smilies/icon_biggrin.gif\" alt=\":D\" onclick=\"javascript:smile(':D');\">";
						print "<img src=\"images/smilies/icon_cry.gif\" alt=\":*(\" onclick=\"javascript:smile(':*(');\">";
						print "<img src=\"images/smilies/icon_arrow.gif\" alt=\"->\" onclick=\"javascript:smile('->');\">";
						print "<img src=\"images/smilies/icon_sad.gif\" alt=\":(\" onclick=\"javascript:smile(':(');\">";
						print "<img src=\"images/smilies/icon_confused.gif\" alt=\":?\" onclick=\"javascript:smile(':?');\">";
						print "<img src=\"images/smilies/icon_mad.gif\" alt=\"x(\" onclick=\"javascript:smile('x(');\">";
						print "<img src=\"images/smilies/icon_idea.gif\" alt=\"!:)\" onclick=\"javascript:smile('!:)');\">";
						print "<img src=\"images/smilies/icon_redface.gif\" alt=\":#)\" onclick=\"javascript:smile(':#)');\">";
						print "<img src=\"images/smilies/icon_rolleyes.gif\" alt=\"8)\" onclick=\"javascript:smile('8)');\">";
						print "<img src=\"images/smilies/icon_wink.gif\" alt=\";)\" onclick=\"javascript:smile(';)');\">";
						print "<img src=\"images/smilies/icon_surprised.gif\" alt=\":o\" onclick=\"javascript:smile(':o');\">";
						print "<img src=\"images/smilies/icon_razz.gif\" alt=\":p\" onclick=\"javascript:smile(':p');\">";
						print "<b>(Click a smily to insert it.)</b>";
						print "</div></td></tr>";
						print "<tr><td valign='top' align='right'><b>Post:</b></td>";
						
						print "<td><textarea name='content' style=\"width:426px; height:260px;\" onKeyPress=\"javascript:txtcount('content');\">" . $_POST[content] . "</textarea></td></tr>";
						
						print "<tr><td><input type=submit value='Post'></td><td align='right'><input type='text' name='counter' value='0' size='4' style='background: #EDECE8; border:#EDECE8 solid 0px;'></tr>";
						print "</table>";
						print "</form>";
						
					} else {
						print "<div id=\"small_bar\" onmouseover=\"this.id='small_bar_hover'\" onmouseout=\"this.id='small_bar'\">";
						print "<a href='cp.php?submenu=yes&blogid=$blogcount[id]&sub=new_post' style=\"color:#9FA8BD; text-decoration: none;\">New Post</a>";
						print "</div>";
					}
					
					if ($sub == "delete_blog") {
						
					} else {
						print "<div id=\"small_bar\" onmouseover=\"this.id='small_bar_hover'\" onmouseout=\"this.id='small_bar'\">";
						print " <a href='cp.php?view=delblog&blogid=$blogcount[id]' style=\"color:#9FA8BD; text-decoration: none;\">Delete</a>";
						print "</div>";
					}
					
					if ($sub == "template_picker") {
						
					} else {
						print "<div id=\"small_bar\" onmouseover=\"this.id='small_bar_hover'\" onmouseout=\"this.id='small_bar'\">";
						print "<a href='cp.php?view=templatepick&blogid=$blogid' style=\"color:#9FA8BD; text-decoration: none;\">Choose A Template</a>";
						print "</div>";
					}
					
					if ($sub == "edit_posts") {
						print "<div id=\"small_bar\" onmouseover=\"this.id='small_bar_hover'\" onmouseout=\"this.id='small_bar'\">";
						print "<b>Edit Posts</b>";
						print "</div>";
						
						print "<div id=\"sub_container\">";
						
						print "<form name=\"post_select\" method=\"post\" action=\"cp.php?submenu=yes&blogid=$blogcount[id]&sub=edit_posts&getpost=yes\">";
						print "<select name=\"post_dropdown\" style=\"width: 400px; margin-top:4px;\">";
						print "<option value=\"none_selected\"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Select a Topic</option>";
						
						$getlist = mysql_query("select * from posts where blog='$blogcount[id]'");
						while ($list = mysql_fetch_array($getlist)) {
							print "<option value=\"$list[id]\">$list[title]</option>";
						}
						print "</select>";
						print "<input type=\"submit\" value=\"Choose\">";
						print "</form>";
						
						if ($getpost == "yes") {
							if ($action == "edit") {
								if ($_POST['preview']) {
									$_POST[content] = nl2br($_POST[content]);
									print "<div style=\"border: 1px solid #4a4a67; margin-top:30px; padding-top:0px;\">";
									print "<div style=\"margin-top: -30px;\"><h3>Preview:</h3></div>";
									print "<h2>$_POST[title]</h2>";
									print "$_POST[content]";
									print "";
									print "</div>";
									print "<br>";
								} elseif ($_POST['edit']) {
									
									$c = explode(" ",$_POST[content]);
									$_POST[content] = strip_tags($_POST[content]);
									$datetime = time();
									mysql_query("update posts set title='$_POST[title]' where id='$_POST[postid]'") or die("Could not edit post's title:<br>" . mysql_error());
									mysql_query("update posts set timestamp_edit='$datetime' where id='$_POST[postid]'") or die("Could not edit post's timestamp-edit:<br>" . mysql_error());
									mysql_query("update posts set post='$_POST[content]' where id='$_POST[postid]'") or die("Could not edit post's post:<br>" . mysql_error());
									
									print "<div><h2>Your Post was Edited successfuly...</h2></div>";
								}
							}
							if (!empty($_POST[post_dropdown])) {
								$postid = $_POST[post_dropdown];
							}
							$postinfo = mysql_fetch_array(mysql_query("select * from posts where id='$postid'"));
							
							print "<form name=\"edit_post\" method=\"post\" action=\"cp.php?submenu=yes&blogid=$blogid&sub=edit_posts&getpost=yes&action=edit\">";
							print "<input name=\"postid\" type=\"hidden\" value=\"$postinfo[id]\">";
							print "<input name=\"title\" type=\"input\" value=\"$postinfo[title]\" style=\"width:468px;\">";
							print "<textarea name=\"content\" style=\"width:468px; height:200px;\">$postinfo[post]</textarea>";
							print "<br />";
							print "<div>";
							if ($postinfo[private] == "no") {
								$private_check = "";
							} else {
								$private_check = "checked";
							}
							print "<input name=\"privatecheck\" type=\"checkbox\" value=\"yes\" " . $private_check . " />Make this post private<br />";
							if ($private_check != "checked") {
								$friendvdisabled = "disabled";
								$friendsvchecked = "";
							} else {
								$friendvdisabled = "";
								$friendsvchecked = "checked";
							}
							print "<input name=\"friendsvcheck\" type=\"checkbox\" value=\"yes\" " . $friendsvchecked . $friendvdisabled . " />Only people on your friend's list can view this post<br />";
							
							print "</div>";
							print "<br />";
							print "<input type=\"submit\" name=\"edit\" value=\"Submit\"> ";
							print " <input type=\"submit\" name=\"preview\" value=\"Preview\">";
							print "</form>";
						}
						
						print "</div>";
						
					} else {
						print "<div id=\"small_bar\" onmouseover=\"this.id='small_bar_hover'\" onmouseout=\"this.id='small_bar'\">";
						print "<a href='cp.php?submenu=yes&blogid=$blogcount[id]&sub=edit_posts' style=\"color:#9FA8BD; text-decoration: none;\">Edit Posts</a>";
						print "</div>";
					}
					
					if ($sub == "blog_options") {
						
						if ($action == "edit_config") {
							$class = new cp_functions();
							echo $class->update_blog_config($_POST[title], $_POST[description], $_POST[css], $_POST[dir_hide], $_POST[personal_hide], $_POST[blogid]);
							print "$_POST[private_blog]";
						}
						
						$bloginfo = mysql_fetch_array(mysql_query("select * from blogs where id='$blogcount[id]'"));
						print "<div id=\"$blogcount[id]\" style=\"border:0px solid #333369; padding-left:16px;\">";
						
						print "<div style=\"background: url(images/small_menu_bar_short.jpg) no-repeat; background-position: right; height:20px; vertical-align:middle; text-align: left; padding-left: 8px; padding-top: 2px;\">";
						print "<b>Blog Configuration</b>";
						print "</div>";
						
						print "<div style=\"padding-left:4px;\">";
						
//						print "<form name='editor' method='post' action='cp.php?view=blogedit&action=edit'>";
						print "<form name='editor' method='post' action='cp.php?submenu=yes&blogid=$blogcount[id]&sub=blog_options&action=edit_config'>";
						print "<input name='blogid' type='hidden' value='$blogcount[id]'>";
						print "<b>Title:</b><br>";
						print "<input name=\"title\" type=\"input\" value=\"" . $bloginfo[title] . "\" style=\"width:474px;\"><br>";
						print "<b>Description:</b><br>";
						print "<textarea name=\"description\" style=\"width:474px; height:160px;\">" . $bloginfo[description] . "</textarea><br>";
//						print "<b>Page Setup:</b><br>";
//						print "<textarea name='page_template' rows='16' cols='70'>$bloginfo[page_template]</textarea><br>";
//						print "<b>Post Setup:</b><br>";
//						print "<textarea name='post_template' rows='16' cols='70'>$bloginfo[post_template]</textarea><br>";
//						print "<b>About Setup:</b><br>";
//						print "<textarea name='about_template' rows='16' cols='70'>$bloginfo[about_template]</textarea><br>";
						print "<br>";
						print "<div>";
						if ($bloginfo[show_directory] == "yes") {
							$dir_hide_check = "";
						} else {
							$dir_hide_check = "checked";
						}
						print "<input name=\"dir_hide\" type=\"checkbox\" value=\"yes\" " . $dir_hide_check . " /> Do not show this blog in the directory<br>";
						
						if ($bloginfo[hide_blog_all] == "no" || $bloginfo[hide_blog_all] == "") {
							$personal_hidden_check = "";
						} else {
							$personal_hidden_check = "checked";
						}
						print "<input name=\"personal_hide\" type=\"checkbox\" value=\"yes\" " . $personal_hidden_check . " /> Hide from everyone but me<br>";
						print "</div>";
						print "<br><br>";
						print "";
						$sections = mysql_fetch_array(mysql_query("select * from members where id='$stat[id]'"));
						$current_section_name = explode('|', $sections[sections_names]);
						$current_section_list = explode('|', $sections[sections_list]);
						$list_count = count($current_section_list);
						$list_count--;
						$x = 0;
						while ($x <= $list_count) {
							print "<a href=\"#\">$current_section_list[$x]</a><br>";
							$x++;
						}
						print "<br><br>";
						print "<b>Style:</b><br>";
						print "<textarea name=\"css\" style=\"width:474px; height:160px;\">" . $bloginfo[css] . "</textarea><br>";
						print "<input type='submit' value='Update Your Blog Settings'>";
						print "</form>";
						print "</div>";
						
						print "</div>";
					} else {
						print "<div id=\"small_bar\" onmouseover=\"this.id='small_bar_hover'\" onmouseout=\"this.id='small_bar'\">";
						print "<a href='cp.php?submenu=yes&blogid=$blogcount[id]&sub=blog_options' style=\"color:#9FA8BD; text-decoration: none;\">Blog Configuration</a>";
						print "</div>";
					}
					print "<div id=\"small_bar\" onmouseover=\"this.id='small_bar_hover'\" onmouseout=\"this.id='small_bar'\">";
					print "<a href=\"cp.php\" style=\"color:#9FA8BD; text-decoration: none;\">Close</a>";
					print "</div>";
				}
			}
//			print "<div style=\"border-bottom: 1px solid #333369;\"></div>";
			if (empty ($blogcount[page_template]) || empty ($blogcount[post_template]) || empty ($blogcount[about_template])) {
				print "<div style=\"\"><font color='red'><b>Error: </b> You have not edited your template correctly. Please go back and do so, or members may not be able to read your blog correctly.</font></div>";
			}
		}
	}
?>
			<br>
			<a id="menu_button" href='cp.php?view=blognew'>New Blog</a>
			<br>
		</div>
	</div>

		<div id="box3">
			<div id="blog_window">
				<table id="blog_listing_columns" cellspacing="0">
					<tr>
						<td colspan="3"><font style="font-size:18px; font-weight:bold;">Your Alerts:</font></td>
					</tr>
				</table>
				<?php
				$getlist = mysql_query("select * from alerts where owner='$stat[id]'");
				while ($alert = mysql_fetch_array($getlist)) {
					print "<div>$alert[message]</div>";
				}
				?>
			</div>
		</div>
		
		
		</td>
		<td id="side_td">
			<div id="box3" style="margin-bottom:4px;">
			<div id="friends_list_window">
			<font style="font-size:18px; font-weight:bold;">Your Friends:</font>
			<div>
				<?php
				if ($action == 'add_friend') {
					$class = new cp_functions();
					echo $class->add_friend($_POST[member_name]);
				}
				$class = new cp_functions();
				echo $class->show_friendlist();
				?>
			</div>
			<br>
			<div style="text-align:center;">
			<form method="post" action="cp.php?action=add_friend&member_name=<?php print "$userstats[user]"; ?>">
				<input id="input_bg" name="member_name" type="input" value="<?php print "$userstats[user]"; ?>"> 
				<input id="menu_button" type="submit" value="Add Friend">
			</form>
			</div>
			</div>
			</div>
			
			
			<div id="box3" style="height:auto; margin-bottom:4px;">
			<div id="groups_list_window" style="background-color: #222233; padding:8px; height:auto; text-align: left; vertical-align:top;">
			<font style="font-size:18px; font-weight:bold;">Your Groups:</font>
			<div>
				Coming Soon...
			</div>
			</div>
			</div>
		</td>
	</tr>
</table>
<?php
}

// Creates a New Blog
if ($view == blognew) {
	print "<form method=post action=cp.php?view=blognew&step=add>";
    print "<table width='100%'>";
	print "<tr><td valign='top' align='right' style=\"color: #ffffff; background-color: #222233\"><b>Title:</b></td>";
	print "<td><input type=text name=\"name\" maxlength='50' style=\"width:600px;\"></td></tr>";
	print "<tr><td valign='top' align='right' style=\"color: #ffffff; background-color: #222233\"><b>Description:</b></td>";
	print "<td><textarea name=\"description\" rows=10 cols=60 maxlength='250' style=\"width:600px;\"></textarea></td></tr>";
	print "<tr><td colspan='2'><input type=submit value='Create Blog'></form></td></tr>";
	print "</table>";
	if ($step == add) {
	    if (empty($_POST[name]) || empty($_POST[description])) {
	    print "Something was not filled out.";
	    } else {
		
		$datetime = time();
		
		mysql_query("insert into blogs (owner, title, description, startdate, starttime) values('$stat[id]','$_POST[name]','$_POST[description]','$datetime','$datetime')") or die("Could not add post for some reason.");
		print "<meta http-equiv='refresh' content='1;url=cp.php'>";
		}
	}
}

// Deletes a Blog and all of it's associated posts and comments to those posts
if ($view == delblog) {
	print "<table valign='middle' align='center' bgcolor='#F4F4F1' style='border:1px solid #ffffff;'><tr><td valign='middle' align='center'>";
	if (empty ($blogid)) {
		print "You did not choose a blog to delete.  Please go back and choose one.";
	} else {
		if (!$step2) {
			print "<b>Are you sure that you want to delete your blog?</b><br><br>";
			print "<a href='cp.php?view=delblog&step2=yes&blogid=$blogid'>Yes, I am sure.</a><br><br>";
			print "<a href='cp.php'>No, do not delete.</a>";
		} elseif ($step2 == 'yes') {
			$find = mysql_query("select * from posts where blog='$blogid'");
			while ($delposts = mysql_fetch_array($find)) {
				$find = mysql_query("select * from comments where post='$blogid'");
				mysql_query("delete from posts WHERE id='$delposts[id]' AND blog='$blogid'");
				mysql_query("delete from comments WHERE post='$delposts[id]'");
			}
			mysql_query("delete from blogs WHERE id=$blogid");
			print "Your blog was deleted successfully.";
			print "<meta http-equiv='refresh' content='3;url=cp.php'>";
		}
	}
	print "</td></tr></table>";
}

if ($view == "files") {
//	$isproject = mysql_num_rows(mysql_query("select * from projects where id='$pid'"));
//	if ($isproject >= 1) {	
	
	if ($action == "add") {
		$timestamp = time();
		print "<b>Title: </b> $_POST[title]<br>";
		print "<b>Description: </b><br>$_POST[description]<br><br>";
		print "<b>Project: </b> $_POST[project]<br>";
		print "<b>Type: </b> $_POST[type]<br>";
		print "<br>";
		print "<b><u>File Information:</u></b><br>";
		print "$thefile_name<br>";
		$thefile_size = ($thefile_size / 1024);
		print round($thefile_size, 1) . " Kb <br>";
		print "$thefile_type<br>";
		print "<br>";
		print "$thefile<br>";
		print "<br>";
		
		$fileurl = "images/works/$thefile_name";
		
		if ($_POST[do_not_upload] == "no") {
			
		} else {
			if (is_uploaded_file($thefile)) {
				$pathu = "/home/bloggie/public_html/nothinglost/images/works/";
				$dir_handleu = @opendir($pathu) or die("Unable to open $pathu");
				copy($thefile, $thefile_name);
				print "File Uploaded...<br>";
				closedir($dir_handleu);
			}
		}
		mysql_query("insert into works (title, full_info, type, artist, timestamp_added, image, project) values('$_POST[title]','$_POST[description]','$_POST[type]','1','$timestamp','$fileurl','$_POST[project]')") or die("could not add the file to the database...<br><br>" . mysql_error() . "<br><br>");
		print "Database entry added...<br><br>";
	}
	print "<form name=\"add_item\" method=\"post\" enctype=\"multipart/form-data\" action=\"control.php?view=add_item&action=add&pid=$_GET[pid]\">";
	print "<input name=\"title\" type=\"input\" value=\"$_POST[title]\" style=\"width:400px;\"><br>";
	print "<textarea name=\"description\" style=\"width:400px; height:160px;\">$_POST[description]</textarea><br>";
	print "<select name=\"project\" style=\"width:400px;\">";
	if (!$_GET[pid] || empty($pid)) {
		$getprojects = mysql_query("select * from projects");
		while ($list = mysql_fetch_array($getprojects)) {
			print "<option value=\"$list[id]\">$list[name]</option>";
		}
		print "</select><br>";
		print "<br>";
		print "<select name=\"type\" style=\"width:400px;\">";
		print "<option value=\"webpage\">Webpage</option>";
		print "<option value=\"flash\">Flash</option>";
		print "<option value=\"image\">Image</option>";
		print "<option value=\"text\">Text</option>";
		print "</select><br>";
		
		print "<input name=\"do_not_upload\" type=\"checkbox\" value=\"no\"> Do not upload<br>";
		
		print "<input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"4194304\">";
		print "<input type=\"file\" name=\"thefile\"> (<i>Max File Size: 4 MB</i>)";
		
		print "<input type=\"submit\" value=\" Upload \">";
		print "</form>";
	}
}

if ($view == 'templatepick') {
	$list = mysql_query("select * from templates");
	while ($listall = mysql_fetch_array($list)) {
		print "<table border='0'><tr><td colspan='2'><b>$listall[title]:  </b></td></tr>";
		print "<tr><td><img src='templates/$listall[thumb]' width='200px' height='200'></td>";
		print "<form method='post' action='cp.php?view=blogedit&action=edit'>";
		print "<input name='blogid' type='hidden' value='$blogid'>";
		print "<td valign='top'>$listall[comment]</td></tr>";
		print "<input name='page_template' type='hidden' value=\"$listall[page_template]\">";
		print "<input name='post_template' type='hidden' value=\"$listall[post_template]\">";
		print "<input name='about_template' type='hidden' value=\"$listall[about_template]\">";
		print "<tr><td colspan='2' align='right'><input type='submit' Value='Pick This Template'></td></tr></table>";
		print "</form>";
		print "<br>";
	}
}

if ($view == "section_management") {
	$sections = mysql_fetch_array(mysql_query("select * from members where id='$stat[id]'"));
	$current_section_name = explode('|', $sections[sections_names]);
	$current_section_list = explode('|', $sections[sections_list]);
	$list_count = count($current_section_list);
	$list_count--;
		$x = 0;
	while ($x <= $list_count) {
		print "<a href=\"#\">$current_section_list[$x]</a><br>";
		$x++;
	}
}

include ("footer.php");
?>