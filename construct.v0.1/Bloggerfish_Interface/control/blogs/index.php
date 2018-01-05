<?php include("../../header.php"); ?>

<!-- Local Styles -->
<link rel="stylesheet" href="style.css" />

<div style="position:relative; height:40px; width:400px; text-align:center; display:none;">
	<div style="background:url(http://www.bloggerfish.com/images/menubar.leftcap.png); width:16px; height:40px; float:left;"></div>

	<div style="position:absolute; left:16px; top:0px; width:368px; height:12px; background:url(http://www.bloggerfish.com/images/menubar.toptile.png);"></div>
	<div style="position:absolute; left:16px; bottom:0px; width:368px; height:12px; background:url(http://www.bloggerfish.com/images/menubar.bottomtile.png);"></div>

	<div class="mini_toolbar_center" style="background:url(http://www.bloggerfish.com/images/menubar.innertile.png); width:368px; height:16px; margin:0 auto; padding:0px; position:absolute; left:16px; top:12px; color:#333333;">
		<a href="?create=newbl" style="color:#fefefc;">Create a Blog</a>
	</div>
	<div style="background:url(http://www.bloggerfish.com/images/menubar.rightcap.png); width:16px; height:40px; float:right;"></div>
	
</div>

<?php
if((!$_GET[create] || empty($_GET[create])) && (!$_GET[edit] || empty($_GET[edit]))) {
	print <<<MAIN
<h2>Blogs:</h2>
<blockqoute>
Welcome to your blog tool!  A more appropriate message should appear here later, but this will work for now.  If you need any 
help, you should create a guided tool to work with on a first use or when needed, or maybe a help file.
</blockqoute>

<h3>Your Blogs</h3>
<ul>
MAIN;
	$sql = mysql_query("SELECT * FROM `blogs` WHERE `owner`='$stat[id]'");
	while($yourbloglist = mysql_fetch_array($sql)) {
	        print "<li>" . "<a href=\"" . "?edit=$yourbloglist[id]" . $yourbloglist[title] . "</a>" . "</li>";
	}    
	print "</ul>";

}
?>

<script type="text/javascript">
function console(addto) {
	consoleid = xGetElementById("console-text");
	if(addto == "") {
		addto = "Running empty console function...";
	}
	if(consoleid.innerHTML == "") {
		consoleid.innerHTML = consoleid.innerHTML + "<div>" + addto + "</div>\n";
	} else {
		consoleid.innerHTML = consoleid.innerHTML + "<div>" + addto + "</div>\n";
	}
}
</script>

<script type="text/javascript">

function checkKey(e) {
	var key=e.keyCode || e.which;
	if (key==13){
		nextform('forward');
	}
	if (key==9){
	   nextform('forward');
	}
}

function FadeTo(id,starto,endo,speed) {
	if(chngopid = xGetElementById(id)) {
		if(!changopid.style.opacity) {
			changeopid.style.opacity = 100;
		}
		if(!changopid.style.opacity) {
			changeopid.style.opacity = 100;
		}
		if(!changopid.style.opacity) {
			changeopid.style.opacity = 100;
		}
		for (var x = 1; x <= 10; x++){
			
		}
	}
}

function displaybox(id,control) {
	thisbox = xGetElementById(id);
	thischeckbox = xGetElementById(control);
	if(thischeckbox.checked == true) {
		thisbox.style.display = "block";
	} else {
		thisbox.style.display = "none";
	}
}

function comparetxt(id1,id2,warningbx) {
	
	warningsh = xGetElementById(warningbx);
	compare1 = xGetElementById(id1);
	compare2 = xGetElementById(id2);
	
	if(compare2.value != compare1.value) {
		warningsh.style.display = "block";
	} else {
		warningsh.style.display = "none";
	}
}

var formdisplayitem = 1;
function nextform(direction) {
	console("Running nextform function:");
	if(thisitem = eval(xGetElementById("blogformitem" + formdisplayitem))) {
		console('xGetId ran successfully...');
		if(thisitem.style.display == "block") {
			console("Checked 'thisitem' for block status successfully...");
			if(direction == "forward") {
				formdisplayitemnext = formdisplayitem + 1;
				console("Next formdisplayitem incrementation is " + formdisplayitemnext);
				if(nextitem = eval(xGetElementById("blogformitem" + formdisplayitemnext))) {
					console("xGetId ran successfully for 'nextitem'...");
					if(nextitem.style.display == "none") {
						console("Checking 'nextitem' block status...");
						thisitem.style.display = "none";
						nextitem.style.display = "block";
						formdisplayitem = formdisplayitem + 1;
					} else {
						console("Was not able to check 'nextitem' block status...");
					}
				} else {
					console("xGetId did not run successfully for 'nextitem'...");
				}
			} else if(direction == "back") {
				formdisplayitemlast = formdisplayitem - 1;
				if(formdisplayitemlast >= 1) {
					console("Previous formdisplayitem incrementation is " + formdisplayitemlast);
					if(previousitem = eval(xGetElementById("blogformitem" + formdisplayitemlast))) {
						console("xGetId ran successfully for 'previousitem'...");
						if(previousitem.style.display == "none") {
							console("Checking 'previousitem' block status...");
							thisitem.style.display = "none";
							previousitem.style.display = "block";
							formdisplayitem = formdisplayitem - 1;
						} else {
							console("Was not able to check 'previousitem' block status...");
						}
					} else {
						console("xGetId did not run successfully for 'previousitem'...");
					}
				}
			}
		} else {
			console("Checked 'thisitem' for block status did not work...");
		}
	} else {
		console('xGetId did not work...');
	}
}
</script>

<?php
if($_GET[create] && $_GET[create] == "newbl") {
	
	if($_POST[submitact] == "Create") {
		print "<div>Create</div>";
		
	} elseif($_POST[submitact] == "Save Draft") {
		print "<div>Save Draft</div>";
	} elseif($_POST[submitact] == "Cancel") {
		print "<div>Cancel</div>";
	}

//START OF THE FORM
print <<<FORM
<div style="margin:12px 0 4px 0;">
	<!-- Curiouso -->
	<div style="position:relative; width:600px; height:22px; margin:0 auto; margin-bottom:4px; text-align:right;">
	<img src="http://www.bloggerfish.com/images/icon_sets/tango/help-browser22.png" alt="Curioso Help Icon" />
	</div>
	
	<form method="post" action="?create=newbl">
		<!-- Blog Form 1 -->
		<div id="blogformitem1" class="blogformitem" style="display:block;">
			<div style="width:600px; color:#67A3CF; font-size:16px; text-align:left; margin:0 auto; padding-bottom:8px; display:block;">What would you like the title of your blog to be?</div>
			<input type="text" style="width:600px; font-size:18px; border-width:4px;" onkeypress="checkKey(event);" />
		</div>
		
		<!-- Blog Form 2 -->
		<div id="blogformitem2" class="blogformitem" style="display:none;">
			<div style="width:600px; color:#67A3CF; font-size:16px; text-align:left; margin:0 auto; padding-bottom:8px;">How would you describe your blog?</div>
			<textarea name="blogdescription" style="width:600px; height:200px; font-size:18px; border-width:4px;">$_POST[blogdescription]</textarea>
		</div>
		
		<!-- Blog Form 3 -->
		<div id="blogformitem3" style="width:600px; text-align:left; margin:0 auto; display:none;">
			<div style="width:600px; color:#67A3CF; font-size:16px; text-align:left; margin:0 auto; padding-bottom:8px;">Your Preferences:</div>
			
FORM;
			if($_POST[private] == "makeprivate") {
				print "<input type=\"checkbox\" name=\"private\" id=\"private\" value=\"makeprivate\" onclick=\"displaybox('passwordbox','private');\" checked />\n";
				print "<label for=\"private\" onclick=\"displaybox('passwordbox','private');\">Password this Blog</label>\n";
			} else {
				print "<input type=\"checkbox\" name=\"private\" id=\"private\" value=\"makeprivate\" onclick=\"displaybox('passwordbox','private');\" />\n";
				print "<label for=\"private\" onclick=\"displaybox('passwordbox','private');\">Password this Blog</label>\n";
			}
			print "<br />\n";
			
			if($_POST[comments] == "allowcomments") {
				print "<input type=\"checkbox\" name=\"comments\" id=\"comments\" value=\"allowcomments\" checked />\n";
				print "<label for=\"comments\">Allow Comments</label>\n";
			} else {
				print "<input type=\"checkbox\" name=\"comments\" id=\"comments\" value=\"allowcomments\" checked />\n";
				print "<label for=\"comments\">Allow Comments</label>\n";
			}
		print <<<FORM
			<div id="passwordbox" style="display:none; text-align:left;">
				<br />
				<b>Password:</b><br />
				<input type="password" id="password" name="password" value="$_POST[password]" style="width:200px;" /><br />
				<b>Password </b>(<em>Again</em>)<br />
				<input type="password" id="repassword" name="repassword" value="$_POST[repassword]" style="width:200px;" onkeyup="comparetxt('repassword','password','passwarning');" />
				<div id="passwarning" style="background-color:#fcfcfe; color:red; font-weight:bold; font-size:14px; display:none;">Both passwords must match.</div>
			</div>
		</div>
		<br />
		
		<!-- Blog Form 4 -->
		<div id="blogformitem4" style="width:600px; text-align:left; margin:0 auto; display:none;">
			<div style="width:600px; color:#67A3CF; font-size:16px; text-align:left; margin:0 auto; padding-bottom:8px;">Start tagging your blog.</div>
			<input type="text" name="blogtags" style="width:600px;" />
			<br />
			<em>(Tags should be separated by spaces, not commas.)</em>
			<br>
		</div>
		
		<!-- Blog Form 5 -->
		<div id="blogformitem5" style="width:600px; text-align:left; margin:0 auto; display:none;">
			<div style="width:600px; color:#67A3CF; font-size:16px; text-align:left; margin:0 auto; padding-bottom:8px; display:block;">You've finished! Now, what would you like to do, next?</div>
			<input type="submit" name="submitact" value="Create My Blog" />
			<input type="submit" name="submitact" value="Save and Edit Later" />
			<img src="" style="width:4px; height:2px; border:1px solid #ffffff;" />
			<input type="submit" name="submitact" value="Disregard Everything" />
		</div>
		<br>
	</form>
	
	<!-- Menu Arrows -->
	<div style="width:600px; height:32px; color:#67A3CF; margin:0 auto;">
		<div style="width:300px; text-align:left; text-size:14px; float:left; color:#fff;">
			<img src="../../images/desktop/dock/arrow-left32.png" alt="Previous Arrow" onclick="nextform('back');" />
			Previous
		</div>
		<div style="width:300px; text-align:right; text-size:14px; float:right; color:#fff;">
			Next
			<img src="../../images/desktop/dock/arrow-right32.png" alt="Next Arrow" onclick="nextform('forward');" />
		</div>
	</div>
	
	<!-- Console -->
	<div id="console" style="position:relative; width:400px; height:200px; display:block;">
		<div style="position:absolute; left:0px; top:0px; width:100%; height:100%; background-color:#000; filter:alpha(opacity=50); opacity:.50;"></div>
		<div style="position:absolute; left:0px; top:0px; width:200px; height:16px; font-size:14px; font-weight:bold; color:#5fa221;">Console:</div>
		<div id="toolbox" style="position:absolute; right:0px; top:0px; width:200px; height:16px; text-align:right;"><img src="http://www.bloggerfish.com/images/icon_sets/tango/list-remove16.png" /></div>
		<div id="console-text" style="position:absolute; left:0px; top:16px; width:100%; height:184px; overflow:auto;"></div>
	</div>
</div>
FORM;

}

if($_GET[edit] && $_GET[edit] >= 0 && $_GET[edit] <= 99999999999) {
	print "It worked.  You are in.";
}
?>

<?php include("../../footer.php"); ?>
