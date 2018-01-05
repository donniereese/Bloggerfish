<?php
	$apiVer 		= "0.0.1";
	$apiNewVer 		= "0.0.1";
    if($_GET['v'] >= $apiVer && $_GET['v'] <= $apiNewVer) {
    	if($_GET['i'] == "v") {
    		print $apiNewVer;
    	}
    } else {
    	print "err||Error: Either the version was not passed, or the version you have is outdated.  Please update your App.";
    }
?>
