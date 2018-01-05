<?php

//include("extras/roundphp/rounded.php");
require_once('member.php');
require_once('database.php');
require_once('config.php.inc');


class squidly {
//I.	Structure Notes  =============================================================
//------------------------------------------------------------------------------------
//	Squidly
//		+squidly()  -Initialization function
//			+
//			+
//		+
//		+
//
//
//
//II.	Master Configuration  ========================================================
//------------------------------------------------------------------------------------
//	The Master configuration, do not alter unless needed or if not installed 
//	before now.
//------------------------------------------------------------------------------------
//	Root Directory for website
	var $SITEHOME	= "/home/.moselle/ororon/bloggerfish.com/development/webGUI/";
	
//	Directory for Squidly
	var $SQDLYHOME 	= "/home/.moselle/ororon/bloggerfish.com/development/webGUI/squidly/";
	
//	Theme Home Directory
	var $THEMEHOME 	= "/home/.moselle/ororon/bloggerfish.com/development/webGUI/themes/";
	
//	Directory for SESSION storage
	var $SESSTORE	= "/home/.moselle/ororon/.STORE/";
	  
//	Standard theme, if none specified
	var $STDTHEME	= "bloggerfish";
//====================================================================================

	//Squidly User Information Configuration
	var $cookie = NULL,
		$member = array(),
		$member_ip = NULL,
		$cookie_chk = NULL,
		$session = NULL,
		$session_raw = array(),
		$rawlog = array(),
		$config = array();

//	Configuration and startup script for the Squidly Library.	
	function squidly($uconf = NULL) {
		//Starting instance of squidly
		$this->addlog("Squidly Initating...");
		
		if((is_string($uconf) && !empty($uconf)) || empty($uconf)) {
			if($uconf == "default" || empty($uconf)) {
				$this->config = array(
								'use_cookie'			=> False,
								'cookie_expire'			=> time()+60*60*60*24*14, //Two Weeks
								'cookie_name'			=> "weblog.com.bloggerfish", //unique name
								'session_expire'		=> 0,
								'session_use_path'		=> False,
								'session_save_path'		=> "/home/.moselle/ororon/storehouse/",
								'temp_path'				=> "/home/.moselle/ororon/storehouse/");
			}
		} elseif(is_array($uconf) && !empty($uconf)) {
			$this->config = array(
							'use_cookie'			=> !isset($uconfig['use_cookie']) ? strval($uconfig['use_cookie']) : False,
							'cookie_expire'			=> !isset($uconfig['cookie_expire']) ? strval($uconfig['cookie_expire']) : time()+60*60*60*24*14,
							'cookie_name'			=> !isset($uconfig['cookie_name']) ? strval($uconfig['cookie_name']) : "weblog.com.bloggerfish",
							'session_expire'		=> !isset($uconfig['session_expire']) ? strval($uconfig['session_expire']) : 0,
							'session_use_path'		=> !isset($uconfig['session_use_path']) ? strval($uconfig['session_use_path']) : False,
							'session_save_path'		=> !isset($uconfig['session_save_path']) ? strval($uconfig['session_save_path']) : "/home/.moselle/ororon/storehouse/",
							'temp_path'				=> !isset($uconfig['temp_path']) ? strval($uconfig['temp_path']) : "/home/.moselle/ororon/storehouse/");
		}
		
		//Configure Session Path
		if($this->config['session_use_path'] == True) {
			$this->addlog("Configuring the Session Path.");
			session_save_path($this->config['session_save_path']);
		} else {
			$this->addlog("Using the Default Session Path.");
		}
		session_start();
		
		//Configure Cookie Use
		if($this->config['use_cookie'] == True) {
			$this->process_cookie();
		}
		$this->process_session();
	}
	
//	Fetch and Process the Cookie Information	
	function process_cookie() {
		$this->addlog("Checking for Cookie with: " . __FUNCTION__ . "()");
		
		//Is there a cookie?
		if($_COOKIE) {
			//Report
			$this->cookie_chk = "True";
			$this->addlog("Cookie variable present... Checking for consistency:");
			
			if($_COOKIE['user_name'] && $_COOKIE['user_name'] != "") {
				if(member::exist($_COOKIE['user_name'])) {
					$this->addlog("Found user...");
				}
			} else {
				$this->cookie_chk = "False";
				$this->addlog("Cookie failed consistency check...");
			}
		} else {
			//Report
			$this->cookie_chk = "False";
			$this->addlog("Cookie variable wasn't present.");
		}
	}
	
//	Fetch and Proccess the Session Information	
	function process_session() {
		//Proccess the session variables
		$this->addlog("Checking for Session with: " . __FUNCTION__ . "()");
		if($_SESSION['auth'] == True && is_array($_SESSION['user']) {
			$this->addlog("Session variable present.");
			
			$this->member_update();
			
			
			if($_SESSION['pass'] != "" && $_SESSION['pass'] != "_none") {
				$this->addlog("session's pass variable isn't empty and doesn't show empty key.");
				$this->addlog("session:user = " . $_SESSION['user'] . " and session:pass = " . $_SESSION['pass']);
				
				if(member::exist($_SESSION['user']) && member::validate($_SESSION['user'], $_SESSION['pass'])) {
					$this->session = True;
					$this->member = member::member_array($_SESSION['user'], $_SESSION['pass']);
					$this->addlog("Authenticated user...");
				} else {
					$this->session = False;
					$this->addlog("User not authenticated...");
				}
			}
		} elseif($_SESSION['auth'] == False || !){
			$this->addlog("Session wasn't authenticated.");
			$this->session = "False";
		}
	}
	
	function update_cookie($value) {
		$expire = time()+60*60*24*14; //Two Weeks...
		//Set Cookie
		if(setcookie("cookie.com.bloggerfish", $value, $expire, "", ".bloggerfish.com", "", "True")) {
			$this->addlog("Updated cookie with " . __FUNCTION__ . " successfully.");
		} else {
			$this->addlog(__FUNCTION__ . " failed to update cookie.");
		}
	}
	
	function signed_in() {
		if(($this->session != NULL) && ($this->session == True)) {
			if(is_array($this->member) && (!empty($this->member['user']) && !empty($this->member['user'])) ) {
				return True;
			} else {
				return False;
			}
		} else {
			return False;
		}
	}
	
	function cmdln($str_class, $str_func) {
		
	}
	
	function output($type, $message) {
		if($type == "alert") {
			$this->addlog("\$this." . __FUNCTION__ . "sent \"" . $message . "\" to the screen using \"" . $type . "\" type.");
			print "<script type='text/javascript'>";
			print "alert(\"" . $message . "\");";
			print "</script>";
		} elseif($type == "inline") {
			
		}
	}
	
	function addlog($line) {
		$this->rawlog[] = $line;
	}
	
	function parse_log($sep, $before="", $after="") {
		foreach($this->rawlog as $entry) {
			//$this->output("alert","Entry Log");
			print $before . $entry . $after . $sep . "\n";
		}
		//print "<pre>";
		//print_r($this->rawlog);
		//print "</pre>";
	}
}
?>
