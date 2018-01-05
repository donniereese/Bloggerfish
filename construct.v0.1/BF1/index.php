<?php include ("header.php"); ?>
<div style="font-size:3em; font-weight:bolder; color:#77869F;">Dockbar</div>
<div id="dock">
	<ul id="dockobjects">
		<li class="dockobject" id="dockobj-write" onmouseover="slide('dockobj-write-icon','up',20);">
			<div class="do-icon" id="dockobj-write-icon"></div>
			<div class="do-title">Writer</div>
		</li>
        <script type="text/javascript">win = "dockobj-write";ico (win);</script>
		<script type="text/javascript">
			function getpos() {
				win = "dockobj-write";
				getleft = xLeft(win);
				gettop = xTop(win);
				alert ("Left: " + getleft + "\n\n Top: " + gettop);
			}
		</script>
		<li class="dockobject" id="dockobj-mail">
			<div class="do-icon" id="dockobj-mail-icon"></div>
			<div class="do-title">Inbox</div>
		</li>
		<li class="dockobject">
			<div class="do-icon"></div>
			<div class="do-title">...</div>
		</li>
		<li class="dockobject" id="dockobj-info" onclick="getpos()">
			<div class="do-icon" id="dockobj-info-icon"></div>
			<div class="do-title">Info</div>
		</li>
	</ul>
</div>
<div style="font-size:3em; font-weight:bolder; color:#77869F;">Dashboard</div>

<div id="innote" class="innote" style="position:absolute; border:1px solid #333333; background-color:#ffffff; width:180px; height:140px; padding:1px;">
	<div class="innote-head" style="background-color:#99CC00; color:#333333; font-weight:bold; size:16px; padding:2px;">Title</div>
	<div class="innote-text" style="background-color:#F5F3F1; color:#444444; height:118px; padding:2px; margin:1px 0px 0px 0px;">text</div>
</div>
<script type="text/javascript">ico("innote");</script>

<?php include ("footer.php"); ?>