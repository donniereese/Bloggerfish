<?php include ("config.php"); ?><html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">

<style> 
<!-- 
BODY{
scrollbar-face-color:#29313f; 
scrollbar-arrow-color:#FFFFFF; 
scrollbar-track-color:#29313f; 
scrollbar-shadow-color:#111111; 
scrollbar-highlight-color:#234333; 
scrollbar-3dlight-color:#29313f; 
scrollbar-darkshadow-Color:#29313f; 
} 

--> 
</style>

</head>
<body bgcolor="#29313f">
<?php

if (!$view || $view == 'news') {
	print "<br>";
	print "<table width='100%' border='0' cellpadding='4' cellspacing='0'>";
	print "<tr><td style='border-top:1px solid #394352; border-bottom:1px solid #394352; background: #2E3847'>";
	print "This is some news.";
	print "</td></tr>";
	print "</table>";
} elseif ($view == 'latest_works' && !$artist) {
	print "<table align='center' width='376px' border='0' cellspacing='2' cellpadding='0'>";
	print "<tr><td width='100%' height='100%' valign='top'><center><br>";
	print "<a name='preview_link' href='' target='_parent'><img name='preview' src='images/samples/sample_back.jpg' width='350' height='80' alt='' border='0'></a><br><br>";
	?>
	<script src='main.js'></script>
	<A href="javascript:preview('preview','images/samples/pop_bop.jpg','index.php')">Sample 1</A> | <A href="javascript:preview('preview','images/samples/2pain.jpg','index.php')">Sample 2</A>
	<?php
	print "</center></td></tr></table>";
	
} elseif ($view == 'personal_works') {
	print "<table height='100%'><tr>";
	$all = mysql_query("select * from works where artist='$artist'");
	while ($list = mysql_fetch_array($all)) {
    	if (empty ($list)) {
			print "<td>nothing yet</td>";
        } else {
            print "<td><table style=\"background:#323B4C; border:1px solid #767F8F;\" onmouseover=\"this.style.border='#75B9F6 1px solid'; this.style.background='#384C72'\" onmouseout=\"this.style.border='1px solid #767F8F'; this.style.background='#323B4C'\" height='100%'>";
			print "<tr>";
			print "<td><b style='font-size:12px; color:#570000;'>$list[title]</b></td>";
			print "</tr>";
            print "<tr>";
	        print "<td valign='top' width='200px'>$list[small_info]</td>";
	        print "</tr></table></td>";
        }
    }
	print "</tr></table>";
}
?>
</body>
</html>