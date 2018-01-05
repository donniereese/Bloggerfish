<?php
class admin {
	function send_log($member_name, $remote_ip, $log, $printlog) {
		include ("config.php.inc");
		$ip = $HTTP_SERVER_VARS['REMOTE_ADDR'];
		$timestamp = time();
		mysql_query("insert into log (timestamp, member_name, ip, log) values('$timestamp','$member_name','$remote_ip','$log')") or die("log did not accept input.<br>".mysql_error());
	}
}
class tools {
	function rowcolor($i) {
		$bgcolor1 = "";
		$bgcolor2 = "";
		
		if ( ($i % 2) == 0) {
			
		} else {
			
		}
	}
}
?>
