					<!--<div id="livetext" style="display:none; position:absolute; left:0px; top:0px; width:100%; height:100%; background-color:#eeeeee; font-size:24px;">asdf</div>-->

				</div>
			</div>
		</div>
	</div>
	<!--<div id="box1">
		<div id="box2">
			<div id="box3" class="bottompane">
				<?php include("footercontent.php"); ?>
			</div>
		</div>
	</div>-->
	<div style="display: none;background: url(images/png1test.png) no-repeat; width:600px; height:80px; position:absolute; top:200px; left:60px; z-index: 99;">
	</div>
	<div style="text-align:right; margin-right:8px; margin-top:8px; margin-bottom:8px;">
		<a href="http://www.spreadfirefox.com/?q=affiliates&amp;id=0&amp;t=218"><img border="0" alt="Firefox 2" title="Firefox 2" src="http://sfx-images.mozilla.org/affiliates/Buttons/firefox2/ff2o80x15.gif"/></a>
	</div>
	
	<div id="aux-win" style=" display: none; max-width:800px; min-width:400px; width:50%; height:50%; position: absolute; top:25%; left:25%; background-color:#836363;"></div>
</div>

	<?php
	if($stat[status] == "admin") {
		print <<<CONSOLE
		<div id="app_console" style="pposition:absolute; right:0px; bottom:0px; widht:360px; height:200px; background: #fff;">
			<div id="app_console_head" style="position:relative;">
				<div id="app_console_title"></div>
				<div id="app_console_grips">
					<a href="#">+</a>
				</div>
			</div>
			<div id="app_console_content"></div>
		</div>
CONSOLE;
	}
	?>

</body>
</html>
