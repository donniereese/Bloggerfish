<?
include ("config.php.inc");

//
if ($view == "create_member_dir") {
	$user_name = "blackbird";
	$user_id = 17;
	
	mkdir("users/$user_name/", 0777);
	$filec = "user_files_template/index.php";
	$newfile = "users/" . $user_name . "/index.php";
	if (!copy($filec, $newfile)) {
		echo "failed to copy $filec...\n";
	}
	$data = "<?php \$user_id=" . $user_id . " ?>";  
	$file = "users/" . $user_name . "/config.php";   
	if (!$file_handle = fopen($file,"a")) {
		echo "Cannot open file";
	}  
	if (!fwrite($file_handle, $data)) {
		echo "Cannot write to file";
	}  
	fclose($file_handle);
	print "$user_name's directory account has been created...";
}

//
if ($view == "switch_post_replacement") {

$sql = mysql_query("select * from posts");
while ($postinfo = mysql_fetch_array($sql)) {
	$postinfo[post] = str_replace("<br>","",$postinfo[post]);
	$postinfo[post] = str_replace("<BR>","",$postinfo[post]);
	$postinfo[post] = str_replace("<Br>","",$postinfo[post]);
	$postinfo[post] = str_replace("<bR>","",$postinfo[post]);
	$postinfo[post] = str_replace("'","\'",$postinfo[post]);
	
	$post = $postinfo[post];
	
	//Update the reversed post
	mysql_query("update posts set post='$post' where id='$postinfo[id]'") or die("Could not update post id:<b>$postinfo[id]</b><br><br>" . mysql_error());
}

}

//
if ($view == "change_all_active") {
	mysql_query("update members set activity='active'") or die ("Could not set status to active.<br>");
	print "Active setting completed<br>";
}

//
if ($view == "change_news_time_format") {
	
	$sql = mysql_query("select * from posts");
	
	while ($orig = mysql_fetch_array($sql)) {
		
		if (empty($orig[timestamp])) {
			$date = explode("/", $orig[date]);
			
			$orig[time] = str_replace(" am","",$orig[time]);
			$orig[time] = str_replace(" pm","",$orig[time]);
			
			$time = explode(":", $orig[time]);
			
			$datetime = $time[0] . "," . $time[1] . "," . "00" . "," . $date[0] . "," . $date[1] . "," . $date[2];
			
			$datetime = mktime($time[0],$time[1],00,$date[0],$date[1],$date[2]);
			
			mysql_query("update posts set timestamp='$datetime' where id='$orig[id]'") or die(mysql_error());
			
			print "successful!";
		}
	}
}

//
if ($view == "reset_points") {
	if ($member_id) {
		if ($member_id == "all") {
			mysql_query("update members set points='0'") or die("Could not reset all member points.<br>");
			print "All member points have been reset to 0";
		}
	}
}

if ($view == "mailtest") {
	$dir = "../mail/";
	
	// Open a known directory, and proceed to read its contents
	if (is_dir($dir)) {
		if ($dh = opendir($dir)) {
			while (($file = readdir($dh)) !== false) {
				echo "filename: $file : filetype: " . filetype($dir . $file) . "<br>";
			}
			closedir($dh);
		}
	}
}

//
//$filename = $_POST["filename"];
//$theText = $_POST["theText"];
//
//$theText = stripslashes($theText);
//$data = fopen($filename, "a");
//fwrite($data,$theText);
//fclose($data);
//echo "File created or updated";
//

?>