<?php
require_once("squidly/squidly.php");
$squidly = new squidly();

//print "<div style=\"width:800px; height:500px; padding:4px; background:url(squidly/extras/roundedphp/rounded.php?w=808&h=508&bgt=1&fg=333) no-repeat;\">";
//print "<div style=\"height:24px; background:url(squidly/extras/roundedphp/rounded.php?w=800&h=60&bgt=1&fg=555&r=4) no-repeat;\">";
//print "</div>";
//print "<img src=\"squidly/extras/roundedphp/rounded.php?w=800&h=24&bgt=1&fg=5194bc&r=4\">";

//$squidly->parse_log("","<div style=\"background-color:#333; color:#eee; border:1px solid #ffd; padding:2px; margin:2px;\">","</div>");

//
//print "</div>";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	
	<title>Bloggerfish</title>
	
	<!-- Meta Data -->
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<meta name="author" content="Bloggerfish Team" />
	<meta name="publisher" content="Nothing Lost Designs" />
	<meta name="copyright" content="© Copyright 2004 - 2008, Nothing Lost Designs" />
	<meta name="revisit-after" content="2 days" />
	<meta name="keywords" content="free, blog, bloggerfish, online journal, journal, community, blogger, diary, diaries, online diary, web blog, web journal, web diary" />
	<meta name="description" content="A free online community for people to share their thoughts and keep their own journal. The features are endless with bloggerfish.com ." />
	<meta name="audience" content=" All" />
	<meta name="robots" content="ALL" />
	
	<!-- JavaScript Includes -->
	<script type='text/javascript' src='scripts/x_core.js'></script>
	<script type='text/javascript' src='scripts/x_event.js'></script>
	<script type='text/javascript' src='scripts/x_drag.js'></script>
	<script type='text/javascript' src='scripts/x_eyeOSwin.js'></script>
	<script type='text/javascript' src='scripts/blive.js'></script>
	<!-- StyleSheet Includes -->
	<link rel="stylesheet" href="style.css" />
	
</head>
<body class="standard" onkeypress="liveText(event);">
	<h1>BloggerFish</h1>
	<p>Lurv-fish to the rescue again!</p>
	
	<div id="branding">
	</div>
	
	<div id="menu_block">
		<h2>Menu</h2>
		<ul class="menu_horiz" id="nav_top">
			<li><a href="index.html" alt="Go to the Home Page">Home</a></li>
			<li><a href="#" alt="Create Something to Share with Others">Make</a></li>
			<li>Share</li>
			<li>Community</li>
			<li><a href="contact.php" alt="Contact BloggerFish">Contact</a></li>
			<li><a href="about.php" alt="About The Fish!">About</a></li>
		</ul>
		
		<ul class="menu_vert" id="nav_usr">
			<li><?php if($squidly->signed_in() == True) { print"Welcome back, " . $squidly->member['user'] . "!"; } else { print"Please sign in."; } ?></li>
			<?php if($squidly->signed_in() == True) {?>
			<li><a href="http://panel.bloggerfish.com/<?php echo $squidly->user['name']; ?>/">Your Account</a></li>
			<li><a href="http://www.bloggerfish.com/help/">Help!</a></li>
			<li><a href="http://www.bloggerfish.com?action=out">Sign Out</a></li>
			<?php } else {
				
			}
			?>
		</ul>
		<div id="dynamic_menu">
			Added Bar
		</div>
</div>
	
	<div id="bloggerfish_search">
		<h3>Search BloggerFish</h3>
		<form>
			<input type="text" name="search_query" />
			<input type="submit" value="Search" />
		</form>
	</div>
	
	<div id="session_options">
		<?php if(!$squidly->signed_in()) {?>
		<h3>Login / Sign Up Form</h3>
		<form method='post' action='login.php'>
			Username:<input name="user" type="text" value="" />
			Password:<input name="pass" type="password" value="" />
			<input type="submit" value="Sign In" />
		</form>
		<?php } ?>
	</div>
	
	<div id="account_tools">
		<h3>Tools</h3>
		<ul>
			<li><?php member::message_count(); ?> Messages</li>
			<li><?php member::comment_count(); ?> Comment</li>
			<li><?php member::event_count(); ?> New Event(s) in Your Area.</li>
		</ul>
	</div>
	
	<p>Welcome to BloggerFish.com! Sorry about the mess, we are still in <em>beta</em> at the 
	moment. What is BloggerFish, you ask? BloggerFish is <em>MORE</em> than your average social 
	network or online community. BloggerFish is one of the only that <em>YOU</em> help to build! 
	Create a page, share photos or videos of yourself or something you did today, or talk about 
	the latest events in your area. We can even help you share this information with everyone 
	else in the area.  If you are feeling really handy, then go ahead and help build one of the 
	<em>user tools</em> that we offer!</p>

<div style="display:none;">	
	<h2>Updates & Hijinx</h2>
	<div>
		<h3>Welcome Back, I Hope.</h3>
		<p>Well, here is the skinny guys and gals!  I have got the webhosting back up and 
		running, and am underway in getting all of the database and systems moving and 
		grooving to the proper tune again, but I am still lacking a computer of substantial 
		power.  This means that a nice, pretty, new GUI is a little farther away, since I can 
		not run a decent graphics utility on this POS.  I am going to attempt to piece something 
		nice together from all of the old parts I have left over, but there are no promises.</p>
		<div>
			<a href="">Buddha</a> @ 12:48 PM on Apr 2, 2008
		</div>
	</div>
	<h2>Next Update</h2>
	<p>For right now, the "Next Update" section is somewhat useless, seeing as everything 
	is being rebuilt from the ground up!  When a majority of the features have been rebuilt, 
	the "Next Update" portion of the page will hold all information on what is expected from 
	the next update, and an option portion of written-in requests that possibly will be examined 
	for feasibility. Thankyou for your patients.</p>
</div>
	
	<h3>Your Friends</h3>
	<ul>
		<li><a href="">Admin</a></li>
		<li><a href="">Buddy_boy12</a></li>
	</ul>
	
	<div id="informational_footer">
		<h2>Information</h2>
		
		<h3>Resources</h3>
		<ul>
			<li><a href="#">Resources Home</a></li>
			<li><a href="#">Terms of Service</a></li>
			<li><a href="#">FaQ</a></li>
			<li><a href="#">Help!</a></li>
		</ul>
	<div>
</body>
</html>

