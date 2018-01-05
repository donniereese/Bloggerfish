<?php
include ("header.php");

print "
<div id=\"control_menu\" style=\"border:1px solid #4F5F78; padding:2px; margin:2px;\">
<a href=\"control.php?view=add_project\">Add Project</a><br>
</div>
"; 

$sql = mysql_query("select * from projects order by 'name'");

while ($projectlist = mysql_fetch_array($sql)) {
print <<<menu
<div id="control_menu">
<b style="color:#430000; font-size:16px;">$projectlist[name]</b><br>
 - <a href="control.php?view=add_item&pid=$projectlist[id]">add item</a><br>
 - <a href="control.php?view=add_task&pid=$projectlist[id]">Add Task</a><br>
 - <a href=""></a><br>
edit profile<br>
<br>
</div>
menu;
}
/***************************************\\
//  Add Project Code                    \\
//                                      \\
//***************************************/
if ($view == "add_project") {
//	$isproject = mysql_num_rows(mysql_query("select * from projects where id='$projectid'"));
//	if ($isproject >= 1) {	
	if ($action == "add") {
		$timestamp = time();
		mysql_query("insert into projects (name, description, type, timestamp_started) values('$_POST[name]','$_POST[description]','$_POST[type]','$timestamp')") or die("could not add the project to the database...<br><br>");
		print "Project added...<br><br>";
	}
	
	print "<form name=\"add_project\" method=\"post\" action=\"control.php?view=add_project&action=add\">";
	print "<input name=\"name\" type=\"input\" value=\"$_POST[name]\" style=\"width:400px;\"><br>";
	print "<textarea name=\"description\" style=\"width:400px; height:160px;\">$_POST[description]</textarea><br>";
	print "<select name=\"type\" style=\"width:400px;\">";
	print "<option value=\"website\">Website</option>";
	print "<option value=\"flash\">Flash</option>";
	print "<option value=\"image\">Image(s)</option>";
	print "<option value=\"text\">Text</option>";
	print "</select><br>";
//	print "<input name=\"comments\" type=\"checkbox\" value=\"allow\" checked> Allow Comments<br>";
	print "<input type=\"submit\" value=\" Add Project \">";
	print "</form>";
}

if ($view == "add_item") {
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

if ($view == "add_task") {
	if (!empty($projectid)) {
		$isproject = mysql_num_rows(mysql_query("select * from projects where id='$projectid'"));
		if ($isproject >= 1) {
			if ($action == "add") {
				if (!empty($_POST[title])) {
					if (!empty($_POST[description])) {
						if (!empty($_POST[per_complete])) {
							$timestamp = time();
							$level = "normal";
							if ($_POST[comments] != "allow") {
								$_POST[comments] = "disallow";
							}
							mysql_query("insert into tasks (title, description, project, percent_complete, status, level, timestamp_added, comments) values('$_POST[title]','$_POST[description]','$projectid','$_POST[per_complete]','$_POST[status]','$level','$timestamp','$_POST[comments]')") or die("could not add task to the database...<br><br>");
							print "Task added...<br><br>";
						} else {
							print "You did not fill in the percentage. please do so and try again.<br><br>";
						}
					} else {
						print "You did not fill in the description. please do so and try again.<br><br>";
					}
				} else {
					print "You did not fill in the title. please do so and try again.<br><br>";
				}
			}
			
			print "<form name=\"add_project\" method=\"post\" action=\"control.php?view=add_task&action=add&projectid=$projectid\">";
			print "<input name=\"title\" type=\"input\" value=\"$_POST[title]\" style=\"width:400px;\"><br>";
			print "<textarea name=\"description\" style=\"width:400px; height:160px;\">$_POST[description]</textarea><br>";
			print "<input name=\"per_complete\" type=\"input\" value=\"0\"><br>";
			print "<select name=\"status\" style=\"width:400px;\">";
			print "<option value=\"active\">Active</option>";
			print "<option value=\"disabled\">Disabled</option>";
			print "</select><br>";
			print "<input name=\"comments\" type=\"checkbox\" value=\"allow\" checked> Allow Comments<br>";
			print "<input type=\"submit\" value=\" Add \">";
			print "</form>";
		} else {
			print "That project does not exist.<br><br>";
		}
	} else {
		print "You did not choose a project to view tasks for.<br><br>";
	}
}

include ("footer.php");
?>