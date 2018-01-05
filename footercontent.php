<?php
	if ($stat[status] == "admins") {
		
		$loadcontent = open("index.php");
		
		print <<<FOOTER
		<div id="content" style="background: url(images/large_ad.jpg); background-position: 0px -170px; height:100%; padding:0px; margin:0px;">
			<div class="toolbar" style="background-color:#eee; color:#6f6f6f;">
				[<a href="">Save</a>] 
				[<a href="">Save As</a>] 
				[<a href="">Archive and Save Version</a>] 
				[<a href="">Revert to:</a>]
			</div> 
			<textarea id="adminpageeditor" style="width:100%; height:360px; color:#000; background-color:#fff;">$loadcontent</textarea>
		</div>
FOOTER;
	} else {
		print <<<FOOTER
		<div id="content" style="background: url(images/large_ad.jpg); background-position: 0px -170px; height:100%;">
			<div style="color: #ffffff; font-size:36px; font-weight:bold; padding-left:12px; margin-top:40px;">
				BloggerFish Loves You...
			</div>
		</div>
FOOTER;
	}
?>