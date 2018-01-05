<?php
	include("library.php");
	
	if($_GET['type'] == "get") {
		
	}
	
	if($_GET['type'] == "verify") {
		if(whatsit() == $_GET['guess']) {
			print "res:True:";
		} else {
			print "res:False";
		}
	}
	
	if($_GET['type'] == "post") {
		
	}
?>