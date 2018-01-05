<?php session_start(); ?>
<?php
include("../../config.php.inc");
$status = "";
if (!session_is_registered("user") || !session_is_registered("pass")) {
    $status = "guest";
}
If ($status != "guest") {
    $stat = mysql_fetch_array(mysql_query("select * from members where user='$user' and pass='$pass'"));
    if (empty ($stat[id])) {
		print "$_session[user]";
	    $status = "guest";
    }
}
If ($status != "guest") {
    $ctime = time();
    mysql_query("update memebers set lpv=$ctime where id=$stat[id]");
    $ip = "$HTTP_SERVER_VARS[REMOTE_ADDR]";
    mysql_query("update memebers set ip='$ip' where id=$stat[id]");
}
?>
<html>
<head>
<?
if ($name = strstr ($HTTP_USER_AGENT, "MSIE")) {
	print "<link rel=\"stylesheet\" href=\"../../alt_style.css\">";
} else if ($name = strstr ($HTTP_USER_AGENT, "Netscape")) {
	print "<link rel=\"stylesheet\" href=\"../../style.css\">";
} else {
	print "<link rel=\"stylesheet\" href=\"../../style.css\">";
}
?>
	<Meta name="Author" content="Bloggerfish Team">
	<Meta name="Publisher" content="Nothing Lost Designs">
	<Meta name="Copyright" content="© Copyright 2004 - 2005, Nothing Lost Designs">
	<Meta name="Revisit-After" content="4 days">
	<Meta name="Keywords" content="free, blog, bloggerfish, online journal, journal, community, blogger, diary, diaries, online diary, web blog, web journal, web diary">
	<Meta name="Description" content="A free online community for people to share their thoughts and keep their own journal. The features are endless with bloggerfish.com .">
	<Meta name="Audience" content=" All">
	<Meta name="Robots" content="ALL">

<title>Bloggerfish</title>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
</head>
<body>
<div id="main">
	<div id="header">
		<a id="menu_button" href="../../index.php">Home</a> 
		<a id="menu_button" href="../../view.php">Blogs</a> 
		<a id="menu_button" href="../../profile.php">Members</a> 
		<a id="menu_button" href="../../about.php">About</a>
		<a id="menu_button" href="../../about.php?view=faq">FaQ</a>
		<a id="menu_button" href="../../contact.php">Contact</a>
		<?php
		if ($stat[status] == "admin") {
			print "<a id=\"admin_button\" href=\"admin.php\">Administration</a>";
		}
		?>
	</div>
	<div id="menu">
	<div>
		<script type="text/javascript"><!--
		google_ad_client = "pub-1725369640819618";
		google_ad_width = 468;
		google_ad_height = 15;
		google_ad_format = "468x15_0ads_al";
		google_ad_channel ="";
		google_color_border = "191933";
		google_color_bg = "333366";
		google_color_link = "99CC33";
		google_color_url = "FFCC00";
		google_color_text = "FFFFFF";
		//--></script>
		<script type="text/javascript"
		  src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
		</script>
	</div>
	</div>
	<div id="box1">
		<div id="box2">
			<div id="box3">
				<div id="content">