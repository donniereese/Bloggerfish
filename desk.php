<?php session_start(); ?>
<?php

include("config.php.inc");
include("window.php");

$server_config = mysql_fetch_array(mysql_query("select * from server_config where id='1'"));

$status = "";
if (!session_is_registered("user") || !session_is_registered("pass")) {
    $status = "guest";
}
if ($status != "guest") {
    $stat = mysql_fetch_array(mysql_query("select * from members where user='$user' and pass='$pass'"));
    if (empty ($stat[id])) {
		print "$_session[user]";
	    $status = "guest";
    }
}
if ($status != "guest") {
    $ctime = time();
    mysql_query("update memebers set lpv=$ctime where id=$stat[id]");
    $ip = $HTTP_SERVER_VARS[REMOTE_ADDR];
    mysql_query("update memebers set ip='$ip' where id=$stat[id]");
}

include ("func.php");
$class = new admin();
$printlog = no;
$where = $HTTP_SERVER_VARS['REMOTE_ADDR'];
$what_action = $HTTP_SERVER_VARS['PHP_SELF'];
$log = $stat[user] . "[" . $stat[id] . "]" . "\n" . $where . "\n" . $what_action . "\n" . $timestamp;
//$class->send_log($stat[user], $where, $log, $printlog);

?>

<html>
<head>
    <link rel="stylesheet" href="style.css">
	<Meta name="Author" content="Bloggerfish Team">
	<Meta name="Publisher" content="Nothing Lost Designs">
	<Meta name="Copyright" content="� Copyright 2004 - 2005, Nothing Lost Designs">
	<Meta name="Revisit-After" content="4 days">
	<Meta name="Keywords" content="free, blog, bloggerfish, online journal, journal, community, blogger, diary, diaries, online diary, web blog, web journal, web diary">
	<Meta name="Description" content="A free online community for people to share their thoughts and keep their own journal. The features are endless with bloggerfish.com .">
	<Meta name="Audience" content=" All">
	<Meta name="Robots" content="ALL">
<script type='text/javascript' src='scripts/gclock.js'></script>
<script type='text/javascript' src='scripts/x_core.js'></script>
<script type='text/javascript' src='scripts/x_event.js'></script>
<script type='text/javascript' src='scripts/x_drag.js'></script>
<script type='text/javascript' src='scripts/x_eyeOSwin.js'></script>


<script language="javascript">

    function createRequestObject() { 

       var req; 
    
       if(window.XMLHttpRequest){ 
          // Firefox, Safari, Opera... 
          req = new XMLHttpRequest(); 
       } else if(window.ActiveXObject) { 
          // Internet Explorer 5+ 
          req = new ActiveXObject("Microsoft.XMLHTTP"); 
       } else { 
          // There is an error creating the object, 
          // just as an old browser is being used. 
          alert('Problem creating the XMLHttpRequest object'); 
       } 
    
       return req; 
    
    } 
    
    // Make the XMLHttpRequest object 
    var http = createRequestObject(); 
    
    function sendRequest(q) { 
    
       // Open PHP script for requests 
       http.open('get', 'fetch.php?q='+q); 
       http.onreadystatechange = handleResponse; 
       http.send(null); 
    
    } 
    
	function handleResponse() { 
    	if(http.readyState == 4 && http.status == 200){ 
          // Text returned FROM the PHP script 
          var response = http.responseText; 
    
          if(response) { 
             // UPDATE ajaxTest content
			 if(response == "")
			 	document.getElementById("test").style.height = "0px";
			else 
             document.getElementById("test").innerHTML = response; 
          } 
    
       } 
    
    } 

</script>

<STYLE>
<!--
body {
	overflow: hidden;
	}

#header {
	background: url(images/v3_01.png) right no-repeat;
	width:784px;
	margin: 0px;
	padding-right: 16px;
	padding-top: 18px;
	text-align: right;
	font-size: 10px;
	height:38px;
	}

input, textarea {
	border: 1px solid #436680;
	background: #57596F;
	font-size: 12px;
	color: #111122;
	}

a {
	color: #99CC33;
	}

#mainbutton {
	background:url(images/desktop/main.png);
	}

#mainbutton:hover {
	background:url(images/desktop/maindown.png);
}

	

/* Left Down Corner */
.binfesq {
	position:absolute;
	left: 0px;
	width:13px;
	height:21px;
	background: url(eyeOS/system/themes/NuoveXT/gfxwin/4.png);
	background-repeat: no-repeat; 
	background-position: center left;
}

/* Right Down Corner */
.binfdre {
	position:absolute;
	right: 1px;
	width:21px;
	height:21px;
	background: url(eyeOS/system/themes/NuoveXT/gfxwin/6.png);
	background-repeat: no-repeat; 
	background-position: center left;
}

/* Down Border */
.binfcen {
	position:absolute;
	bottom: 0px;
	right: 22px;
	left: 13px;
	height:21px;
	background: url(eyeOS/system/themes/NuoveXT/gfxwin/5.png);
	background-repeat: repeat-x; 
}

/* Right border */
.bdre {
	position:absolute;
	top: 21px;
	bottom: 21px;
	right: 0px;
	width:13px;
	background: url(eyeOS/system/themes/NuoveXT/gfxwin/10.png);
	background-repeat: repeat-y; 
	background-position: top right;	
}

/* Window content */
.txt {
	position: absolute;
	top: 21px;
	bottom: 21px;
	right: 10px;
	left: 0px;
	text-align: left;
	border-left: 1px solid #D3D2D2;
	background: url(eyeOS/system/themes/NuoveXT/gfxwin/9.png);
	background-repeat: repeat-x; 
	background-position: top center;
	z-index: 100;
	background-color: #FEFEFE;
}

.interior {
	position:absolute;
	overflow: auto;
	top: 2px;
	right: 5px;
	left: 8px;
	bottom: 8px;
}

/* Window Foot */
.peu {
	position:absolute;
	bottom: 0px;
	width:100%;
	height:21px;
	text-align: left;
	cursor: move;
}
/* Other items in windows */
/* Maximize button */
.boto {
	position:absolute;
	right: 26px;
	top: 3px;
	width:13px;
	height:13px;
	z-index: 150;
}

/* Resize image */
.botobaix {
	position:absolute;
	right: -13px;
	top: -1px;
	width:13px;
	height:13px;
	z-index: 150;
	cursor: se-resize;
	background: url(eyeOS/system/themes/NuoveXT/gfxwin/resize.png);
	}

.filename2 {
	background:url(images/desktop/ico.file.png);
	position:absolute;
	top:0px;
	left:72px;
	width:64px;
	height:64px;
	}

-->
</STYLE>


<title>Bloggerfish</title>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
</head>
<body style="background: url(images/v3_05.jpg);">

<?php

if ($status == "guest") {
	print "<div style=\"-moz-opacity:.50; background-color:#333344; color:#99cc33; font-family:verdana; font-size:12px; position:absolute; left:16px; right:16px; top:16px; bottom:16px;\">";
		print "<div style=\"position:absolute; right:8px; top 8px; bottom:8px; border:0px solid #ffffff; text-align:right;\">";
			print "<b>User:</b> <input style=\"color:#526c1f; font-weight:bold; font-size:10px; padding:4px; width:108px; height:20px; background: url(images/logintxtbx_adv.png); border:none;\"><br><br>";
			print "<b>Pass:</b> <input style=\"color:#526c1f; font-weight:bold; font-size:10px; padding:4px; width:108px; height:20px; background: url(images/logintxtbx_adv.png); border:none;\">";
		print "</div>";
	print "</div>";
	exit;
}

$window = new window();
$window->create("Text App", "movelayer", "400", "300", "100", "200", "resize", "text.php");

?>

<!--<div id="movelayer" class="window" style="width:600px; height:200px; overflow:hidden; position:absolute; top:250px; left:160px; z-index: 100;">
	<div style="position:absolute; left:0px; top:0px; height:24px; width:8px;"><img src="images/desktop/topleft.png"></div>
	<div style="position:absolute; right:0px; top:0px; height:24px; width:8px;"><img src="images/desktop/topright.png"></div>
	<div style="position:absolute; left:8px; right:8px; top:0px; height:24px; background: url(images/desktop/toptile.png);"></div>
	<div id="movelayerDBar" class="window.bar" style="position:relative;cursor:move; margin:0px; padding:0px; color:#EEEEEE;height: 24px; text-align: left;">
		<div style="position:absolute; left:8px; right:8px; top:2px; bottom:6px; font-size:14px; font-weight:bold; color:#a8c3d8; border:0px solid #ffffff;">Window</div>
	</div>
	
	<div style="position:absolute; top:24px; left:0px; width:8px; bottom:16px; background:url(images/desktop/leftborder.png);"></div>
	
	<div style="position:absolute; top:24px; left:8px; right:8px; bottom:16px; background-color:#47495f; text-align:left; color:#eeeeff;">Text!</div>
	
	<div style="position:absolute; top:24px; right:0px; width:8px; bottom:16px; background:url(images/desktop/rightborder.png);"></div>
	
	<div style="position:absolute; left:0px; bottom:0px; height:16px; width:8px;"><img src="images/desktop/bottomleft.png"></div>
	<div style="position:absolute; right:0px; bottom:0px; height:16px; width:8px;"><img src="images/desktop/bottomright.png"></div>
	<div style="position:absolute; left:8px; right:8px; bottom:0px; height:16px; background: url(images/desktop/bottomtile.png);"></div>
	
	<div id="movelayerDDow" style="height:16px; position:absolute; right:0px; left:0px; bottom:0px; cursor:move;"></div>
	<div id="movelayerRBtn" style="height:8px; width:8px; position:absolute; right:0px; bottom:0px; background:url(images/desktop/resize.png); cursor:se-resize;"></div>
</div>
<script type="text/javascript">
win = "movelayer";
Setup (win);
maxZ = 100;
</script>-->


<div id="textedit" class="window" style="width:600px; height:200px; overflow:hidden; position:absolute; top:250px; left:160px; z-index: 10000;">
	<div style="position:absolute; left:0px; top:0px; height:24px; width:8px;"><img src="images/desktop/topleft.png"></div>
	<div style="position:absolute; right:0px; top:0px; height:24px; width:8px;"><img src="images/desktop/topright.png"></div>
	<div style="position:absolute; left:8px; right:8px; top:0px; height:24px; background: url(images/desktop/toptile.png);"></div>
	<div id="texteditDBar" class="window.bar" style="position:relative;cursor:move; margin:0px;padding:0px; color:#EEEEEE;height: 24px; text-align: left;"></div>
	
	<div style="position:absolute; top:24px; left:0px; width:8px; bottom:16px; background:url(images/desktop/leftborder.png);"></div>
	
	<div style="position:absolute; top:24px; left:8px; right:8px; bottom:16px; background-color:#47495f; text-align:left; color:#eeeeff;">
	<textarea style="width:100%; height:100%;">hello</textarea>
	</div>
	
	<div style="position:absolute; top:24px; right:0px; width:8px; bottom:16px; background:url(images/desktop/rightborder.png);"></div>
	
	<div style="position:absolute; left:0px; bottom:0px; height:16px; width:8px;"><img src="images/desktop/bottomleft.png"></div>
	<div style="position:absolute; right:0px; bottom:0px; height:16px; width:8px;"><img src="images/desktop/bottomright.png"></div>
	<div style="position:absolute; left:8px; right:8px; bottom:0px; height:16px; background: url(images/desktop/bottomtile.png);"></div>
	
	<div id="texteditDDow" style="height:16px; position:absolute; right:0px; left:0px; bottom:0px; cursor:move;"></div>
	<div id="texteditRBtn" style="height:8px; width:8px; position:absolute; right:0px; bottom:0px; background:url(images/desktop/resize.png); cursor:se-resize;"></div>
</div>
<script type="text/javascript">
win = "textedit";
Setup (win);
</script>


<div id="barmenu" style="background: url(images/desktop/desktop_03.png); position:absolute; right:8px; bottom:8px; width:784px; height:24px; text-align:right; z-index:1000000;">
	<div id="mainbutton" style="position:absolute; width:120px; height:16px; top:4px; left:4px;">
	</div>
	<div style="text-align:left; padding-left:128px;">
		<a onClick="idshow='header';xShow(idshow);">here</a>
	</div>
	<div class="Gclock" GcFormat='%g~%j %a' style="position:absolute; right:4px; top:4px; color:#a6ba92; font-weight: bold; font-size:12px; text-align: center; width:64px; font-family: Verdana, Arial;"></div>
</div>


<div id="desktop_area" style="position:absolute; left:16px; right:16px; top:16px; bottom:16px;">
	<a href="index.php">
	<div id="world.ico" style="background:url(images/desktop/ico.world.png); position:absolute; top:0px; width:64px; height:64px;">
		<div style="position:absolute; bottom:0px; left:0px; right:0px; text-align:center; color:#9999aa; font-size:10px;">
			Your World
		</div>
	</div>
	<script type="text/javascript">win = "world";ico (win);</script>
	</a>
	
	<div id="mail.ico" style="background:url(images/desktop/ico.mail.png); position:absolute; top:72px; width:64px; height:64px;">
		<div style="position:absolute; bottom:0px; left:0px; right:0px; text-align:center; color:#9999aa; font-size:10px;">
			Messages
		</div>
	</div>
	<script type="text/javascript">win = "mail";ico (win);</script>
	
	<div id="filename1.ico" style="background:url(images/desktop/ico.file.png); position:absolute; top:144px; width:64px; height:64px;">
		<div style="position:absolute; bottom:0px; left:0px; right:0px; text-align:center; color:#9999aa; font-size:10px;">
			New File
		</div>
	</div>
	<script type="text/javascript">win = "filename1";ico (win);</script>
	
	<div id="filename2" class="filename2">
		<div style="position:absolute; bottom:0px; left:0px; right:0px; text-align:center; color:#9999aa; font-size:10px;">
			New File 2
		</div>
	</div>
	<script type="text/javascript">win = "filename2";ico (win);</script>
</div>

</body>
</html>