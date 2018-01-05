<?php
$version = '0.2';

/*	simple unix timestamp converter tool

	there's nothing to this, it's all built in to php, I just had need
	of a tool to do it easily, worth the three minutes it took to
	knock this together...
	
	then I noticed it was at the top of google, so I spruced it up a bit
	and added reverse functions; I spotted a few search engine queriers
	were actually looking for the other-way-around convertion. 
	
	so here it is!
	
	I switched to GET variables, also, which has many advantages here.
	
	note: you can convert both ways at once
	
	;o)
	(or
	
	© corz.org		*/

echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
			"http://www.w3.org/TR/html4/loose.dtd">
<html><head><meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>unix timestamp converter (convertor)</title>
<meta name="description" content="simple gui for some php date & time functions">
<meta name="author" content="corz.org">
<meta name="keywords" content="unix timestamp,timestamp converter,timestamp convertor,unix,time, stamp,free,system,php source,corz.org,convertr,conveerter,convoovivavoomivivifibbbyvumvum"><link href="/serv/tools/distromachine/stuff/cdm.css" rel="stylesheet" type="text/css"></head>
<body leftmargin=0 rightmargin=0 topmargin=0 bottommargin=0 marginwidth=0 marginheight=0 bgcolor="#ffffff"><style type="text/css"><!--
a.toplink { font-size: 10pt; position: absolute; top: 44px; right: 9px; }
//--></style>';

@include($_SERVER['DOCUMENT_ROOT'].'/inc/osxheader.php');

echo '
<form action="',$_SERVER['PHP_SELF'],'" method="get">
<table align="center" border=0 cellspacing=0 cellpadding=10 width="90%">
	<tr>';
	
echo '
	<tr>
		<td colspan=3><h1>unix timestamp converter tool</h1>
				<code>current unix timestamp: ';
echo strtotime("now");
echo '
		</code><br><br></td>
	</tr>
	<tr>';


if((isset($_GET['timestamp'])) and ($_GET['timestamp'] != '')) {
	$unix_timestamp = $_GET['timestamp'];
	$nice_time = date('d F Y h:i:s A', $unix_timestamp);

echo '
		<td width="50%"><small><code>converted  &nbsp;"',$unix_timestamp,'" &nbsp;to.. <br>'
		,$nice_time,'</code></small><br>
		</td>';
} else { 
	echo '
		<td width="50%"></td>';
}

echo '
		<td></td>';

if((isset($_GET['realtime'])) and ($_GET['realtime'])) {
	$user_time = $_GET['realtime'];
	$unix_stamp = strtotime($user_time);
	
echo '
		<td width="50%"><small><code>converted  &nbsp;"',$user_time,'" &nbsp;to..<br>'
		,$unix_stamp,'</code></small><br>
		</td>';
			
} else { 
	echo '
		<td width="50%"></td>';
}

echo '
	</tr>
	<tr>
		<td width="50%" valign="top">
		<table align="center" border=0 cellspacing=0 cellpadding=0 width="100%">';
echo '
			<tr>
				<td><h4>convert a unix timestamp to a "real" date and time..</h4>
				<br>
				</td>
			</tr>';


	
echo '
			<tr>
				<td>input a valid unix timestamp, past or future, and get back
				a readable date and time..<br>
				<br>
				</td>
			</tr>';


echo '
			<tr>
				<td>
				<b>unix timestamp</b>:
				<input type="text" name="timestamp" length="30" maxlength="30">
				</td>
			</tr>
			<tr>
				<td align="center"><br><br>
				<input type="submit" value="get real!">
				</td>
			</tr>
			<tr><td width="3%" height=50></td></tr>
			</tr>
				<td width="3%" height=100></td>
			</tr>
		</table>
		</td>
		
		<td width=33></td>';
	
// the right hand side. "real" time to unix timestamp..

echo '

		<td width="50%" valign="top">
		<table align="center" border=0 cellspacing=0 cellpadding=0 width="100%">';
echo '
			<tr>
				<td><h4>convert a "real" date or time to a unix timestamp..</h4>
				<br>
				</td>
			</tr>';
echo '
			<tr>
				<td>
				possible input formats include: "now", "03 November 2001",
				"+1 day", "+1 week", "+1 week 2 days 4 hours 2 seconds", "+1 month",
				"next Friday", "last Tuesday", etc. try it and see what happens!<br>
				<br>
				</td>
			</tr>';
echo '
			<tr>
				<td>
				<b>real time or date</b>:
				<input type="text" name="realtime" length="30" maxlength="99">
				</td>
			</tr>
			<tr>
				<td align="center"><br><br>
				<input type="submit" value="make a timestamp!">
				</td>
			</tr>';
echo'
		</table>
		</td>
	</tr>
</table>
</form>';
echo '
<a href="http://corz.org/engine?download=menu&section=corz%20function%20library" class="toplink" target="_blank" title="(opens in a new window - apple/shift-click for a new tab instead)">get the source for this tool</a>';
@include($_SERVER['DOCUMENT_ROOT'].'/inc/footer.php');
echo '
</body></html>';
?>
