<?php
//Variables
$site[homedir] = "/home/.moselle/ororon/bloggerfish.com/";
$site[curdir] = "tower/";
?>
<?php include("../header.php"); ?>
<?php
// Page-Specific Includes
include("../includes/db.php");

if ( ($stat[status] == "member") || $stat[status] != "admin" || !$stat[status]) {
	print "<div class=\"generic_message\">";
	print "<p>Do not pass go. Do not collect $200.</p>";
	print "<p>This is a restricted section. You must be signed on to an account with correct permissions to view this page.</p>";
	print "</div>";
	include("footer.php");
	exit;
}
?>
<div style="margin-bottom:8px;">
	<ul>
		<li style="list-style:none; padding-left:18px; height:16px; background:url(../images/desktop/dock/mechpencil16.png) no-repeat;"><a href="admin.php?view=post">Post</a></li>
		<li style="list-style:none; padding-left:18px; height:16px; background:url(../images/desktop/dock/docktile16.png) no-repeat;"><a href="admin.php?view=member_management">Member Management</a></li>
		<li style="list-style:none; padding-left:18px; height:16px; background:url(../images/desktop/dock/docktile16.png) no-repeat;"><a href="admin.php?view=update_user_files">Base Files</a></li>
		<li style="list-style:none; padding-left:18px; height:16px; background:url(../images/desktop/dock/docktile16.png) no-repeat;"><a href="admin.php?view=dbapp">Database Management</a></li>
		<li style="list-style:none; padding-left:18px; height:16px; background:url(../images/desktop/dock/docktile16.png) no-repeat;"><a href="admin.php?view=createlst">Create Editable List</a></li>
		<li style="list-style:none; padding-left:18px; height:16px; background:url(../images/desktop/dock/docktile16.png) no-repeat;"><a href="admin.php?view=fmngr">File Manager</a></li>
	</ul>
</div>

<?php
//View == News
if ($view == "news") {
	if ($action == add) {
		if (empty ($_POST[addtitle]) || empty ($_POST[addupdate])) {
			print "<b>Please fill out all fields.</b><br>";
			$error = "yes";
		} else {
			$addupdate = nl2br($addupdate);
			$date = date("m/d/y", time());
			$time = date("h:i a", time());
			mysql_query("insert into news (starter, subject, content, date, time) values('$stat[user]','$addtitle','$addupdate','$date','$time')") or die("Could not add updates.");
			print "<b>Update added.</b><br>";
		}
	}
	print "<table>";
	print "<form method=post action=\"admin.php?view=post&action=add\">";
	print "<tr><td><b>Title: </b></td><td><input type=text name=\"addtitle\" style=\"width:620px;\ value=\"";
	if ($error == "yes") {
		print $_POST[addtitle];
	}
	print "\"></td></tr>";
	print "<br><tr><td valign=top><b>Update: </b></td><td><textarea name=\"addupdate\" rows=16 style=\"width:620px;\">";
	if ($error == "yes") {
		print $_POST[addupdate];
	}
	print "</textarea></td></tr>".
	"<tr><td colspan=2 align=center><input type=submit value=\"Add Update\"></td></tr>".
	"</form>".
	"</table>";
}

//View == Post
if ($view == "post") {
	if ($action == add) {
		if (empty ($_POST[addtitle]) || empty ($_POST[addupdate])) {
			print "<b>Please fill out all fields.</b><br>";
			$error = "yes";
		} else {
			$addupdate = nl2br($addupdate);
			$date = date("m/d/y", time());
			$time = date("h:i a", time());
			mysql_query("insert into news (starter, subject, content, date, time) values('$stat[user]','$addtitle','$addupdate','$date','$time')") or die("Could not add updates.");
			print "<b>Update added.</b><br>";
		}
	}

	print "<table>";
	print "<form method=post action=\"admin.php?view=post&action=add\">";
	print "<tr><td><b>Title: </b></td><td><input type=text name=\"addtitle\" style=\"width:620px;\ value=\"";
	if ($error == "yes") {
		print $_POST[addtitle];
	}
	print "\"></td></tr>";
	print "<br><tr><td valign=top><b>Update: </b></td><td><textarea name=\"addupdate\" rows=16 style=\"width:620px;\">";
	if ($error == "yes") {
		print $_POST[addupdate];
	}
	print "</textarea></td></tr>".
	"<tr><td colspan=2 align=center><input type=submit value=\"Add Update\"></td></tr>".
	"</form>".
	"</table>";
}

// Member Management
if ($view == "member_management") {
	print "<blockquote><a href=\"admin.php?view=member_management&sub=add_member\">Add Member</a> | <a href=\"admin.php?view=member_management&sub=email_members\">Add Member</a></blockquote>";
	if ($sub == "main" || !$sub) {
	}
	if ($sub == "add_member") {
		print "<table>";
		print "<form name=\"add_member\" method=\"post\" action=\"admin.php?view=member_management&action=add_member\">";
		print "<tr>";
		print "<td>User Name: </td>";
		print "<td><input name=\"user\" type=\"input\"></td>";
		print "</tr>";
		print "<tr>";
		print "<td>Password: </td>";
		print "<td><input name=\"pass\" type=\"input\"></td>";
		print "</tr>";
		print "<tr>";
		print "<td>Email: </td>";
		print "<td><input name=\"email\" type=\"input\"></td>";
		print "</tr>";
		print "<tr>";
		print "<td>First Name: </td>";
		print "<td><input name=\"firstname\" type=\"input\"></td>";
		print "</tr>";
		print "<tr>";
		print "<td>Last Name: </td>";
		print "<td><input name=\"lastname\" type=\"input\"></td>";
		print "</tr>";
		print "<tr>";
		print "<td>Age: </td>";
		print "<td><input name=\"age\" type=\"input\"></td>";
		print "</tr>";
		print "<tr>";
		print "<td>Gender: </td>";
		print "<td><input name=\"sex\" type=\"input\"><br></td>";
		print "</tr>";
		print "<tr>";
		print "<td colspan=2><input type=\"submit\" value=\"Submit\"></td>";
		print "</form>";
		print "</table>";
	}
	
	if ($sub == "edit_member") {
		if (empty($editid)) {
			print "Please select a user to edit and try again.<br>";
		} else {
			if ($action == "edit") {
				$currentuserinfo = mysql_fetch_array(mysql_query("select * from memebers where id='$_POST[id]'"));
				if (($currentuserinfo != $_POST[user]) && !empty($_POST[user])) {
					rename("users/$currentuserinfo[user]", "users/$_POST[user]") or die("Could not change directory name.<br>");
				}
				mysql_query("update members set user='$_POST[user]' where id='$_POST[id]'");
				mysql_query("update members set pass='$_POST[pass]' where id='$_POST[id]'");
				mysql_query("update members set firstname='$_POST[firstname]' where id='$_POST[id]'");
				mysql_query("update members set lastname='$_POST[lastname]' where id='$_POST[id]'");
				mysql_query("update members set aim='$_POST[aim]' where id='$_POST[id]'");
				mysql_query("update members set msn='$_POST[msn]' where id='$_POST[id]'");
				mysql_query("update members set yahoo='$_POST[yahoo]' where id='$_POST[id]'");
				mysql_query("update members set age='$_POST[age]' where id='$_POST[id]'");
				mysql_query("update members set sex='$_POST[sex]' where id='$_POST[id]'");
				$bio = nl2br($bio);
				mysql_query("update members set bio='$_POST[bio]' where id='$_POST[id]'");
				mysql_query("update members set status='$_POST[status]' where id='$_POST[id]'");
				mysql_query("update members set sections='$_POST[sections]' where id='$_POST[id]'");
				mysql_query("update members set sections_list='$_POST[sections_list]' where id='$_POST[id]'");
				mysql_query("update members set sections_names='$_POST[sections_names]' where id='$_POST[id]'");
			}
			
			$getuser = mysql_fetch_array(mysql_query("select * from members where id='$editid'"));
			print "<form name=\"edit_user\" method=\"post\" action=\"admin.php?view=member_management&sub=edit_memeber&action=edit\">";
			print "<input name=\"id\" type=\"hidden\" value=\"$getuser[id]\">";
			print "<input name=\"user\" type=\"input\" value=\"" . $getuser[user] . "\"><br>";
			print "<input name=\"pass\" type=\"input\" value=\"" . $getuser[pass] . "\"><br>";
			print "<input name=\"email\" type=\"input\" value=\"" . $getuser[email] . "\"><br>";
			print "<input name=\"firstname\" type=\"input\" value=\"" . $getuser[firstname] . "\"><br>";
			print "<input name=\"lastname\" type=\"input\" value=\"" . $getuser[lastname] . "\"><br>";
			print "<input name=\"aim\" type=\"input\" value=\"" . $getuser[aim] . "\"><br>";
			print "<input name=\"msn\" type=\"input\" value=\"" . $getuser[msn] . "\"><br>";
			print "<input name=\"yahoo\" type=\"input\" value=\"" . $getuser[yahoo] . "\"><br>";
			print "<input name=\"age\" type=\"input\" value=\"" . $getuser[age] . "\"><br>";
			print "<input name=\"sex\" type=\"input\" value=\"" . $getuser[sex] . "\"><br>";
			print "<textarea name=\"bio\" cols=40 rows=5>" . $getuser[bio] . "</textarea><br>";
			print "<input name=\"status\" type=\"input\" value=\"" . $getuser[status] . "\"><br>";
			print "<input name=\"sections\" type=\"input\" value=\"" . $getuser[sections] . "\"><br>";
			print "<input name=\"sections_list\" type=\"input\" value=\"" . $getuser[sections_list] . "\"><br>";
			print "<input name=\"sections_names\" type=\"input\" value=\"" . $getuser[sections_names] . "\"><br>";
			print "<input type=\"submit\" value=\"Edit\"><br>";
			print "</form>";
		}
	}
	
	if ($sub == "email_members") {
		if ($email) {
			$list = mysql_query("select * from members where activity != 'suspended'");
			while($sendto = mysql_fetch_array($list)) {
				$to = $sendto[email]; 
				$from = "staff@bloggerfish.com";
				$subject = $_POST[subject]; 
				$message = $_POST[body];
				$headers  = "From: $from\r\n"; 
				$success = mail($to, $subject, $message, $headers);
				if ($success) {
					print "The email to $to from $from was successfully sent<br>"; 
				} else {
					print "An error occurred when sending the email to $to from $from<br>";
				}
			}
		} else {
			print "<form method=\"post\" action=\"admin.php?view=member_management&sub=email_members&email=yes\">";
			print "<input name=\"subject\" type=\"input\" style=\"width: 600px;\"><br>";
			print "<textarea name=\"body\" style=\"width: 600px; height: 400px;\"></textarea><br>";
			print "<input type=\"submit\" value=\"Email User(s)\">";
			print "</form>";
		}
	}
	
	if ($action == "add_member") {
		if (!$_POST[user] || !$_POST[pass] || !$_POST[email] || !$_POST[firstname] || !$_POST[lastname] || !$_POST[age] || !$_POST[sex]) {
			print "You must fill out all fields.";
		} else {
			$dupe1 = mysql_num_rows(mysql_query("select * from members where user='$_POST[user]'"));
			if ($dupe1 > 0) {
				print "Someone already has that username.";
			} else {
				$dupe2 = mysql_num_rows(mysql_query("select * from memebers where email='$_POST[email]'"));
				if ($dupe2 > 0) {
					print "There is already a user with this email address.";
				} else {
					mysql_query("insert into memebers (user, email, pass, firstname, lastname, age, sex) values('$_POST[user]','$_POST[email]','$_POST[pass]','$_POST[firstname]','$_POST[lastname]','$_POST[age]','$_POST[sex]')") or die("Could not register member.<br>" . mysql_error());
					print "Member updated...";
				}
			}
		}
	}
	
	print "<div style=\"border:1px solid #99999B; padding:2px; width:700px;\">";
	
	$color1 = "#333366";
	$color2 = "#3D657A";
	$row_count = 0;
	
	
	$sql = mysql_query("SELECT * FROM members order by id asc");
	print "<table style=\"background-color: #191933; width: 600px;\">";
	print "<tr>";
	print "<td style=\"margin:2px;\"></td>";
	print "<td style=\"margin:2px;\"></td>";
	print "<td style=\"margin:2px;\"></td>";
	print "<td style=\"margin:2px;\">A</td>";
	print "</tr>";
	while ($user_list = mysql_fetch_array($sql)) {
		
		$color = ($row_count % 2) ? $color1 : $color2;
		
		print "<tr>";
		print "<td style=\"background-color: $color; margin:2px;\">";
		print "$user_list[id]";
		print "</td>";
		print "<td style=\"background-color: $color; margin:2px;\">";
		print "<a href=\"admin.php?view=member_management&sub=edit_member&editid=$user_list[id]\">$user_list[user]</a>";
		print "</td>";
		print "</td>";
		print "<td style=\"background-color: $color; margin:2px;\">";
		print "$user_list[activity]";
		print "</td>";
		print "</td>";
		print "<td style=\"background-color: $color; margin:2px;\">";
		print "<input type=\"checkbox\">";
		print "<input type=\"checkbox\">";
		print "<input type=\"checkbox\">";
		print "<input type=\"checkbox\">";
		print "<input type=\"checkbox\">";
		print "</td>";
		print "</tr>";
		
		$row_count++;
	}
	print "</table>";
	print "</div>";
}

// User Files
if ($view == "update_user_files") {
	if ($action == "update_all") {


///////////////////////////////////////////////////////////////////////////////////////
// - -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- - //
//                                       Test                                        //
// - -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- - //                                                                                   //
///////////////////////////////////////////////////////////////////////////////////////

// loc1 is the path on the computer to the base directory that may be moved
		define('loc1', '/home/bloggie/public_html/', true);
		
// copy a directory and all subdirectories and files (recursive)
// void dircpy( str 'source directory', str 'destination directory' [, bool 'overwrite existing files'] )
		function dircpy($source, $dest, $overwrite = false) {
			if($handle = opendir(loc1 . $source)) {        // if the folder exploration is sucsessful, continue
				while(false !== ($file = readdir($handle))) { // as long as storing the next file to $file is successful, continue
					if($file != '.' && $file != '..') {
						$path = $source . '/' . $file;
						if(is_file(loc1 . $path)) {
							if(!is_file(loc1 . $dest . '/' . $file) || $overwrite)
								if(!@copy(loc1 . $path, loc1 . $dest . '/' . $file)){
									print "  File ('.$path.') could not be copied, likely a permissions problem.\n";
								} else {
									print "  File ('.$path.') copied.\n";
								}
						} elseif(is_dir(loc1 . $path)) {
							if(!is_dir(loc1 . $dest . '/' . $file))
								mkdir(loc1 . $dest . '/' . $file); // make subdirectory before subdirectory is copied
								print "  Directory ('.$path.') copied.\n";
								dircpy($path, $dest . '/' . $file, $overwrite); //recurse!
						}
					}
				}
				closedir($handle);
			}
		} // end of dircpy(
		
		
//		dircpy($source, $dest, $overwrite = false)
//		dircpy('source directory', 'destination directory', 'overwrite existing files')

		print "<textarea style=\"font-size: 10px; width:736px; height: 200px;\">";		
		
		$users_temp_path = "user_files_template";
		$users_path = "users/";
		
		$dir_handle = @opendir($users_path) or die("Unable to open $users_path");
		while ($file = readdir($dir_handle)) {
			if($file!="." && $file!="..") {
				print "$file\n";
				dircpy($users_temp_path, $users_path . $file . "/", 'true');
				//print " :> " . $filec . " > " . $newfile . "\n";
			}
		}
		
		// Old Version... hopefully
		/*
		$path = "/home/bloggie/public_html/users/";
		$dir_handle = @opendir($path) or die("Unable to open $path");
		while ($file = readdir($dir_handle)) {
			if($file!="." && $file!="..") {
				$file;
				print "$file\n";
				$pathu = "/home/bloggie/public_html/user_files_template/";
				$dir_handleu = @opendir($pathu) or die("Unable to open $pathu");
				while ($fileu = readdir($dir_handleu)) {
					if($fileu!="." && $fileu!="..") {
						$filec = "user_files_template/" . $fileu;
						if(is_dir($filec)) {
							mkdir($path.$file.$fileu, 755);
						} else {
							$newfile = "users/" . $file . "/" . $fileu;
						print " :> " . $filec . " > " . $newfile . "\n";
						if (!copy($filec, $newfile)) {
							echo "failed to copy $filec...\n";
						}
					}
				}
			}
		}
		*/
		
		
		print "</textarea><br><br>";
	}
	print "<div style=\"border:1px solid #99999B; width:400px;\">";
	$path = "/home/bloggie/public_html/user_files_template/";
	$dir_handle = @opendir($path) or die("Unable to open $path");
	print "<div style=\"background-color: #31333D; padding:2px;\">";
	echo "<b>Directory Listing of:</b> <i>$path</i>";
	while ($file = readdir($dir_handle)) {
		if($file!="." && $file!="..") {
			echo "<div style=\"border: 1px solid #414452; background-color: #0F1016; margin:2px;\"><a href='$file'>$file</a></div>";
		}
	}
	closedir($dir_handle);
	print "</div>";
		
	print "<div style=\"background-color: #31333D; padding:2px; margin-top:4px;\">";
	print "<div style=\"border: 1px solid #414452; background-color: #0F1016; padding:8px; margin:2px; height:13px;\">";
	print "<a id=\"menu_button\" href=\"admin.php?view=update_user_files&action=update_all\">Update All</a>";
	print "</div>";
	print "</div>";
	print "</div>";
}

// Messages
if ($view == "messages") {
	$getlist = mysql_query("select * from contact");
	while ($list = mysql_fetch_array($getlist)) {
		print <<<listshow
		<div style="padding-bottom:8px; border:1px solid #cccccc;">
			<div><b>Name: </b><font style="text-decoration:underline;">$list[name]</font></div>
			<div><b>Email: </b><font style="text-decoration:underline;">$list[email]</font></div>
			<div><b>Message: </b><br>$list[text]<br></div>
			<div><b>Date: </b><font style="text-decoration:underline;">$list[timestamp]</font></div>
		</div>
listshow;
	}
}

// Database Management
if ($view == "dbapp") {
	print "<div style=\"height:200px;\">";
		print "<h2>Database: Bloggerfish</h2>";
		getdbs(",", "nosession", "", "", "");
		print "</div>";
		print "<div style=\"float:right;\"></div>";
	print "</div>";
}

// Page Editor
if($_GET[view] == "page.ed") {
	print <<<ED

<div id="editorbox" style="width:100%; height:372px;">
<div style="background:url(images/editortop.png); width:100%; height:72px;"></div>
<div style="float:left; width:506px; height:292px; padding-top:7px;"><textarea style="width:100%; height:100%; background-color:#fff; color:#333; border:0px;"></textarea></div>
<div style="float:right; width:220px; height:299px; background-color:#efefe3; color:#333; padding:1px;">asdf</div>
</div>

ED;
}

//Create Editable list:
//  Experimental database manager
if ($_GET[view] == "createlst") {
	print "<div style=\"width:100%; border:1px solid #cccccc;\">";
	print "<h1>Define a List</h1>";
	print "<select name=\"dblistbox\" style=\"width:400px; height:30px; font-size:20px; font-weight:bold;\">";
	print "<option>Pick Your List</option>";
	$dbtlist = dblarray();
	foreach($dbtlist as $item) {
		print "<option>" . $item . "</option>";
	}
	print "</select>";
	print "</div>";
}

//File Manager:
//  Experimental file manager
if ($_GET[view] == "fmngr") {
	print <<<FILEW
	<div style="width:100%; border:1px solid #cccccc;">
	<div>
FILEW;
		
		function read_dir_list($root, $path) {
			if($dir_handle = opendir($root.$path)) {
				while ($file = readdir($dir_handle)) {
					if($file!="." && $file!="..") {
						if(is_dir($root.$path.$file)) {
							$bullet = file_type('silky','dir');
							print "<li style=\"list-style:none; margin-bottom:4px; padding-left:18px; height:12px;\">";
							print "<img src=\"" . $bullet . "\" style=\"border:none;\" />";
							print "<a href=\"" . $file . "\"> " . $file . "</a>";
							print "</li>\n";
						} else {
							
						}
					}
				}
			} else {
				print "Path Invalid: [$root.$path]";
			}
		}
		
		function read_file_list($root, $path) {
			if($dir_handle = opendir($root.$path)) {
				while ($file = readdir($dir_handle)) {
					if($file!="." && $file!="..") {
						if(is_dir($root.$path.$file)) {
							
						} else {
							$ext = read_file_ext($file);
							$bullet = file_type('silky',$ext);
							
							print "<li style=\"list-style:none; margin-bottom:4px; padding-left:18px; height:12px;\">";
							print "<img src=\"" . $bullet . "\" style=\"border:none;\" />";
							print "<a href=\"" . $file . "\"> " . $file . "</a>";
							print "</li>\n";
						}
					}
				}
			} else {
				print "Path Invalid: [$root.$path]";
			}
		}
		
		function read_file_ext($file) {
			$extary = explode(".", $file);
			return $extary[1];
		}
		
		function file_type($icoset, $ftype) {
			$file_type = array(
			"dir" => "folder.png",
			"php" => "page_white_php.png",
			"html" => "page_white_code.png",
			"css" => "css.png",
			"js" => "script_code_red.png",
			"swf" => "page_white_flash.png",
			"fla" => "page_white_flash.png",
			"txt" => "page_white_text.png",
			"jpg" => "image.png",
			"png" => "image.png",
			"gif" => "image.png",
			"bmp" => "image.png",
			"psd" => "image.png",
			"htaccess" => "cog.png"
			);
			$imgurl = "http://www.bloggerfish.com/images/icon_sets/" . $icoset . "/" . $file_type[$ftype];
			return $imgurl;
		}
		
		$root = "/home/.moselle/ororon/bloggerfish.com";
		print "<ul style=\"margin:0px; padding-left:0px;\">";
		read_dir_list($root,'/');
		read_file_list($root,'/');
		print "</ul>";
		
		/*
		$dir_handle = @opendir($path) or die("Unable to open $path");
		while ($file = readdir($dir_handle)) {
			if($file!="." && $file!="..") {
				$file;
				if(is_dir($path.$file)) {
					$bullet = "http://www.bloggerfish.com/images/icon_sets/silky/bullet_toggle_plus.png";
				} else {
					$bullet = "http://www.bloggerfish.com/images/icon_sets/silky/page_white_code.png";
				}
				print "<li style=\"list-style:none; margin-bottom:4px; padding-left:18px; height:12px;\">" . 
				"<img src=\"" . $bullet . "\" style=\"border:none;\" />" . 
				"<a href=\"" . $file . "\"> " . $file . "</a>" . 
				"</li>\n";
			}
		}
		*/
		/*	<li style="list-style:none; padding-left:18px; height:16px;">
				<a href="#"> <img src="http://www.bloggerfish.com/images/icon_sets/silky/bullet_toggle_plus.png" alt="+"  style="border:none;" /> </a>
				:ROOT:
			</li>
		*/

	print <<<FILEW
	
	</div>
	</div>
FILEW;
}
?>
<?php include("../footer.php"); ?>