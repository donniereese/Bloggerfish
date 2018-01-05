<?php
class admin {
	function send_log($member_name, $remote_ip, $log, $printlog) {
		include ("config.php.inc");
		$ip = $HTTP_SERVER_VARS['REMOTE_ADDR'];
		$timestamp = time();
		mysql_query("insert into log (timestamp, member_name, ip, log) values('$timestamp','$member_name','$remote_ip','$log')") or die("log did not accept input.<br>".mysql_error());
	}
	function clone() {
		echo $this->dummy8($this->text);
	}
}
?>
