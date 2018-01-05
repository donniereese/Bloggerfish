<?php
require_once('config.php.inc');

class member extends squidly {
	$uid = NULL;
	$name = NULL;
	$status = NULL;
	$email = NULL;
	
	function exist($u) {
		$ucnt = mysql_num_rows(mysql_query("SELECT * FROM `members` WHERE `user`='$u'"));
		if($ucnt >= 1) {
			$this->addlog(__CLASS__ . "->" . __FUNCTION__ . " reports user \"$u\" was found...");
			return True;
		} else {
			return False;
		}
	}
	
	function validate($u, $p) {
		$ucnt = mysql_num_rows(mysql_query("SELECT * FROM `members` WHERE `user`='$u' AND `pass`='$p'"));
		if($ucnt >= 1) {
			$this->addlog(__CLASS__ . "->" . __FUNCTION__ . " reports user \"$u\" was validated...");
			return True;
		} else {
			$this->addlog(__CLASS__ . "->" . __FUNCTION__ . " reports user \"$u\" was not validated...");
			return False;	
		}
	}
	
	function member_array($u, $p) {
		if($u_array = mysql_fetch_array(mysql_query("SELECT * FROM `members` WHERE `user`='$u' AND `pass`='$p'"))) {
			return $u_array;
		} else {
			return False;
		}
	}
	
	function message_count() {
		$count = mysql_num_rows(mysql_query("SELECT * FROM `comments` WHERE `owner_id`='$parent->user[id]' AND `status`='new'"));
		print $count . "Messages";
	}
	
	function comment_count() {
		$count = mysql_num_rows(mysql_query("SELECT * FROM `comments` WHERE `owner_id`='$squidly->user[id]' AND `status`='new'"));
		print $count . "Messages";
	}
	
	function event_count() {
		return 26;
	}
}

?>