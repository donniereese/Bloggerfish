<?php include ("header.php"); ?>
<div></div>

<div align="justify">
	<h1>What is with the big boxes everywhere?</h1>
	<p>
	The "big boxes" are called a contained workspace, one of the ideas that I wished to impliment, in some form, 
	in to a project of mine.  The way the thick borders are capsulating the bulk of the web page, and the obvious 
	change in background allows one to realize how that is a workspace.  Later on, this can play a role in how the 
	webpage is displayed versus the tools that a user might be using at that time.
	</p>
    <h2>What is going on here?</h2>
	<p>The most simplistic way to explain this is that, for now, BloggerFish has become my playground.  I have 
    so many ideas and no place to test them.</p>
	<h3>What is going on here?</h3>
	<p>The most simplistic way to explain this is that, for now, BloggerFish has become my playground.  I have 
    so many ideas and no place to test them.</p>
</div>

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
<div style="font-size:3em; font-weight:bolder; color:#77869F; display:none;">Dashboard</div>
<?php include ("footer.php"); ?>