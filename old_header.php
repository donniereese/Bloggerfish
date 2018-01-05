<?php session_start(); ?>
<?php
include("config.php");
if (!session_is_registered("user") || !session_is_registered("pass")) {
    $status = "guest";
}
If ($status != "guest") {
    $stat = mysql_fetch_array(mysql_query("select * from members where user='$user' and pass='$pass'"));
    if (empty ($stat[id])) {
	    print "Invalid login.";
	    exit;
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

<link rel="stylesheet" type="text/css" href="style.css">

<title>Blogger Fish</title>
</head>
<body bgcolor="#DBD9D1" leftmargin="0" rightmargin="0" bottommargin="0" topmargin="0" marginwidth="0" marginheight="0" style="background-image: url(images/background.jpg); background-position: center top; background-repeat: repeat-x;">
<table width="800" border="0" align="center" cellpadding=0 cellspacing=0>
	<tr>
		<td colspan=6>
			<img src="images/header.jpg" width=800 height=136 alt=""></td>
	</tr>
	<tr>
		<td height="24">
			<img src="images/index_02.jpg" width=40 height=24 alt=""></td>
		<td background="images/index_03.jpg" width=728 height=24 valign="bottom" colspan=4>&nbsp;</td>
		<td height="24">
	<img src="images/index_04.jpg" width=32 height=24 alt=""></td>
	</tr>
	<tr>
		<td colspan=6>
			<img src="images/index_05.jpg" width=800 height=8 alt=""></td>
	</tr>
	<tr>
		<td>
			<img src="images/index_06.jpg" width=40 height=168 alt=""></td>
		<td background="images/about.jpg" align="center" valign="middle" width=552 height=168>
		<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
  		codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,42,0"
  		id="add" width="536" height="120">
  		<param name="movie" value="flash/add1.swf">
  		<param name="quality" value="high">
  		<param name="bgcolor" value="#140B2F">
    	<embed name="flashcode" src="flash/add1.swf"
     	quality="high" bgcolor="#140B2F" swLiveConnect="true"
     	width="536" height="120"
     	type="application/x-shockwave-flash"
     	pluginspage="http://www.macromedia.com/go/getflashplayer"></embed>
		</object>
		
		</td>
		<td>
			<img src="images/index_08.jpg" width=8 height=168 alt=""></td>
		<td>
			<img src="images/index_09.jpg" width=160 height=168 alt=""></td>
		<td colspan=2>
			<img src="images/index_10.jpg" width=40 height=168 alt=""></td>
	</tr>
	<tr>
		<td colspan=6>
			<img src="images/index_11.jpg" width=800 height=8 alt=""></td>
	</tr>
	<tr>
		<td rowspan=2>
			<img src="images/index_12.jpg" width=40 height=488 alt=""></td>
		<td>
			<img src="images/index_13.jpg" width=552 height=28 alt=""></td>
		<td rowspan=2>
			<img src="images/index_14.jpg" width=8 height=488 alt=""></td>
		<td colspan=2>
			<img src="images/index_15.jpg" width=168 height=28 alt=""></td>
		<td rowspan=2>
			<img src="images/index_16.jpg" width=32 height=488 alt=""></td>
	</tr>
	<tr>
		<td bgcolor="#EDECE8" width=552 height=460 valign="top" style="padding-left: 4px; padding-right: 4px;">
		   <!--<table width="80%" align="center" border="0"><tr><td bgcolor="#E4E4E3" style="border-left: 4px solid #0C2765">		
		      Welcome to <b>Blogger Fish</b>, A free, website blogger community designed with the user in mind. 
		      Our community is always growing and you could always join today.
		   </td></tr></table> -->
		   <br>