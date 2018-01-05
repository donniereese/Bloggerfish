<?php
// Initiate the Control Class which holds most basic user interface controls
class controls {
	//Fetch the formated friends list.
	function show_friendlist() {
		$stat = mysql_fetch_array(mysql_query("select * from members where user='$_SESSION[user]'"));
		$friends = explode('|', $stat[friends]);
		$count = count($friends);
		$count--;
		$x = 0;
		while ($x <= $count) {
			print "<div style=\"border-bottom:1px solid #333369; padding:1px;\"><a style=\"text-decoration:none;\" href=\"http://www.bloggerfish.com/users/$friends[$x]\">$friends[$x]</a></div>";
			$x++;
		}
	}
	
	//Add a friend to the friends list.
	function add_friend($addname) {
		$exist = mysql_num_rows(mysql_query("select * from members where user='$addname'"));
		if ($exist != 1) {
			print "<b>User does not exist.</b><br>";
		} else {
			$stat = mysql_fetch_array(mysql_query("select * from members where user='$_SESSION[user]'"));
			$friends = explode('|', $stat[friends]);
			if (in_array($addname, $friends)) {
				print "<b>" . $addname . " is already on your list.</b><br>";
			} else {
				if (empty($stat[friends])) {
					$stat[friends] = $stat[friends] . "$addname";
				} else {
					$stat[friends] = $stat[friends] . "|$addname";
				}
				mysql_query("update members set friends='$stat[friends]' where id='$stat[id]'");
			}
		}
	}
	
	function parse_post($text) {
	
	$text = nl2br($text);
	$text = str_replace(":)","<img src=\"../../images/smilies/icon_smile.gif\">",$text);
	$text = str_replace(":D","<img src=\"../../images/smilies/icon_biggrin.gif\">",$text);
	$text = str_replace(":*(","<img src=\"../../images/smilies/icon_cry.gif\">",$text);
	$text = str_replace("->","<img src=\"../../images/smilies/icon_arrow.gif\">",$text);
	$text = str_replace(":(","<img src=\"../../images/smilies/icon_sad.gif\">",$text);
	$text = str_replace(":?","<img src=\"../../images/smilies/icon_confused.gif\">",$text);
	$text = str_replace("x(","<img src=\"../../images/smilies/icon_mad.gif\">",$text);
	$text = str_replace("!:)","<img src=\"../../images/smilies/icon_idea.gif\">",$text);
	$text = str_replace(":#)","<img src=\"../../images/smilies/icon_redface.gif\">",$text);
	$text = str_replace("8)","<img src=\"../../images/smilies/icon_rolleyes.gif\">",$text);
	$text = str_replace(";)","<img src=\"../../images/smilies/icon_wink.gif\">",$text);
	$text = str_replace(":o","<img src=\"../../images/smilies/icon_surprised.gif\">",$text);
	$text = str_replace(":p","<img src=\"../../images/smilies/icon_razz.gif\">",$text);
	$text = str_replace("[b]","<b>",$text);
	$text = str_replace("[u]","<u>",$text);
	$text = str_replace("[i]","<i>",$text);
	$text = str_replace("[s]","<s>",$text);
	$text = str_replace("[url='","<a href='",$text);
	$text = str_replace("']","'>",$text);
	$text = str_replace("[/url]","</a>",$text);
	$text = str_replace("[/b]","</b>",$text);
	$text = str_replace("[/u]","</u>",$text);
	$text = str_replace("[/i]","</i>",$text);
	$text = str_replace("[/s]","</s>",$text);
	
	return $text;
	}
	
	function print_standardstyle() {
	
	print <<<standardstyle
	
body {
	background: #222233;
	color: #4499cc;
	font-size: 12px;
	font-family: Verdana;
	font-weight: normal;
	margin: 0px;
	}

#content {
	width: 100%;
	height: 100%;
	}

#content #header {
	border-bottom: 1px dashed #4499cc;
	border-right: 1px dashed #4499cc;
	background-color: #111122;
	width: 800px;
	height: 100px;
	}

#content #divider {

}

#content #main {
	border-right: 1px dashed #4499cc;
	width:560px;
	height:100%;
	}

#content #main #topmenu {
	border-bottom: 1px solid #4499cc;
	border-right: 1px solid #4499cc;
	background-color: #000000;
	width: 464px;
	padding-bottom:4px;
	text-align: center;
	}

#content #main #topmenu a {
	color: #81A6B2;
	font-family: verdana;
	font-size: 16px;
	font-weight: bold;
	text-decoration: none;
	padding-left: 8px;
	padding-right: 8px;
	}

#content #main #topmenu a:hover {
	color: #146782;
	font-family: verdana;
	font-size: 16px;
	font-weight: bold;
	text-decoration: none;
	padding-left: 8px;
	padding-right: 8px;
	}

#content #main #post {
	font-size: 12px;
	padding:8px;
	padding-left:22px;
	}

#content #main #post #post_header {
	font-size: 20px;
	font-weight: bold;
	color: #8DB1C7;
	margin-left:-16px;
	}

#content #main #post #post_footer {
	border-bottom: 1px solid #146782;
	font-size: 14px;
	font-weight: bold;
	color: #8DB1C7;
	text-align: right;
	margin-left:-16px;
	margin-bottom: 4px;
	}

#content #main #comment {
	font-size: 12px;
	margin-left: 32px;
	}

#content #main #comment #comment_header {
	font-size: 14px;
	font-weight: bold;
	color: #146782;
	}

#content #main #comment #comment_footer {
	font-size: 14px;
	font-weight: bold;
	color: #146782;
	}

#content #sidebar {
	border: 0px solid #000000;
	position: absolute;
	top: 100px;
	left: 561px;
	width:240px;
	height:100%;
	padding: 4px;
	}

#content #bottommenu {
	border-bottom: 1px solid #888888;
	border-right: 1px solid #888888;
	background-color: #eeeeee;
	width: 464px;
	top: 0px;
	margin-bottom:4px;
	position: relative;
	text-align: center;
	}

#content #bottommenu a {
	color: #81A6B2;
	font-family: verdana;
	font-size: 16px;
	text-decoration: none;
	padding-left: 8px;
	padding-right: 8px;
	}

#content #bottommenu a:hover {
	color: #146782;
	font-family: verdana;
	font-size: 16px;
	text-decoration: none;
	padding-left: 8px;
	padding-right: 8px;
	}

input {
	border: 1px solid #cccccc;
	background: #E3ECEF;
	color: #333333;
	}

textarea {
	border: 1px solid #cccccc;
	background: #E3ECEF;
	color: #333333;
	}
	
standardstyle;
	
	return $text;
	}
}

?>