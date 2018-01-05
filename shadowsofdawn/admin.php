<?php $title = "Admin Panel"; include("header.php"); ?>

<?php
if ($stat[rank] != Admin) {
	print "You're not an admin.";
	include("footer.php");
	exit;
}
?>

Welcome to the admin panel. What will you do?
<ul>
	<li><A href=addupdate.php>Add Update</a>
	<li><a href=admin.php?view=del>Delete Member</a>
	<li><a href=admin.php?view=ban>Ban Member</a>
	<li><a href=admin.php?view=add>Add Staff</a>
<?php
	if ($stat[id]=1) {
print "<li><a href=admin.php?view=addspecial>Add Special Staff</a>";
	}
?>
	<li><a href=admin.php?view=tags>Give Tags</a>
	<li><a href=admin.php?view=clearf>Clear Forum</a>
	<li><a href=admin.php?view=clearc>Clear Chat</a>
<?php
	$wadmin = mysql_fetch_array(mysql_query("select * from authent where code='wa1'"));
if ($wadmin[assign] == $stat[id] || $stat[id] == 1) {
    print "<li><a href=admin.php?view=weapon>Weapons Administration</a>";
}
?>
</ul>

<?php
// Delete Character
if ($view == del) {
	print "<form method=post action=admin.php?view=del&step=del>Delete ID <input type=text name=did>. <input type=submit value=Delete></form>";
	if ($step == del) {
		if ($did != 1) {
			mysql_query("delete from players where id=$did");
			print "You deleted ID $did.";
		} else {
			print "No deleting the owner.";
		}
	}
}

// Ban Character
if ($view == ban) {
	print "<form method=post action=admin.php?view=ban&step=ban>";
	print "<b>Ban ID: </b><br>";
	print "<input type=text name=\"bid\"> <input type=submit value=Ban></form>";
	if ($step == ban) {
		if ($bid != 1) {
			mysql_query("update players set ban='Yes' where id=$bid");
			print "You Banned ID $bid.";
		} else {
			print "No banning the owner.";
		}
	}
}

if ($view == add) {
	print "<form method=post action=admin.php?view=add&step=add>Add ID <input type=text name=aid> as an <select name=rank><option value=Member>member</option><option 	value=Admin>admin</option></select>. <input type=submit value=Add></form>";
	if ($step == add) {
		if ($aid != 1) {
			mysql_query("update players set rank='$rank' where id=$aid");
			print "You added ID $aid as a $rank.";
		}
	}
}

if ($view == "addspecial" && $stat[id]=1) {

    print "<b>Free Work Slots</b>";
	print "<table>";
	print "<tr><td width=100><b>ID #</td><td width=100><b>Name</td><td width=100><b>Description</td></tr>";
	$list = mysql_query("select * from authent where assign=0 order by id desc");
	while ($free = mysql_fetch_array($list)) {
		print "<tr><td bgcolor=#444444>$free[id]</td><td bgcolor=#222222>$free[name]</td><td bgcolor=#444444>$free[descript]</td></tr>";
	}
	print "</table>";
	print "<br><b>Assigned Work Slots</b>";
	print "<table>";
	print "<tr><td width=100><b>ID #</td><td width=100><b>Name</td><td width=100><b>Description</td></tr>";
	$list = mysql_query("select * from authent c order by id desc");
	while ($filled = mysql_fetch_array($list)) {
		print "<tr><td bgcolor=#444444>$filled[id]</td><td bgcolor=#222222>$filled[name]</td><td bgcolor=#444444>$filled[descript]</td></tr>";
	}
	print "</table>";

	print "<form method=post action=admin.php?view=addspecial&step=add>";
	print "Assign Job ID# <input type=text name=jid> for ";
	print "player ID <input type=text name=aid>.";
	print "<input type=submit value=Add></form>";

	if ($step == add) {
		if ($aid != 1) {
			mysql_query("update authent set assign='$aid' where id=$jid");
			print "You added ID $aid to job ID# $jid.";
		}
	}
}

if ($view == clearf) {
	mysql_query("delete from topics");
	mysql_query("delete from replies");
	print "You cleared the forums.";
}

if ($view == clearc) {
	mysql_query("delete from chat");
	print "You cleared the chat.";
}

if ($view == tags) {
	print "<form method=post action=admin.php?view=tags&step=tag>";
	print "Make ID <input type=text name=tag_id size=5> have the <input type=text size=20 name=tag> tag. <input type=submit value=Tag>";
	print "</form>";
	if ($step == tag) {
		mysql_query("update players set tag='$tag' where id=$tag_id");
		print "You gave ID <b>$tag_id</b> the <b>$tag</b> tag.";
	}
}

$wadmin = mysql_fetch_array(mysql_query("select * from authent where code='wa1'"));
if ($view == 'weapon') {

if (!empty($byowner) || $byowner=='0') {
		
		$list = mysql_query("select * from equipment where owner='$byowner' order by id asc");
		print "By Owner<br>";
	} else {
		$list = mysql_query("select * from equipment order by id asc");
	}
	
	print "<a href=\"admin.php?view=weapon&byowner=\">Show All</a><br>";
	
    print "<b>Current Weapons:</b>";
	print "<table width=100%>";
	print "<tr><td><b>ID #</td><td><b>Name</td><td><b>Power</td><td>Status</td><td>Type</td><td>Cost</td><td>Edit</td><td>Owner</td></tr>";
	
	while ($weap = mysql_fetch_array($list)) {
		if ($weap[owner] == "0") {
			$weap[owner] = "Store";
		}
		print "<tr>";
		print "<td bgcolor=#444444>$weap[id]</td>";
		print "<td bgcolor=#222222>$weap[name]</td>";
		print "<td bgcolor=#444444>$weap[power]</td>";
		print "<td bgcolor=#222222>$weap[status]</td>";
		print "<td bgcolor=#444444>$weap[type]</td>";
		print "<td bgcolor=#222222>$weap[cost]</td>";
		print "<td bgcolor=#444444><a href=admin.php?view=weapon&step=edit&free=$weap[id]>Edit</a></td>";
		
		if ($weap[owner] == "Store") {
			$owner = 0;
		} else {
			$owner = $weap[owner];
		}
		
		print "<td bgcolor=#222222><a href=\"admin.php?view=weapon&byowner=$owner\">$weap[owner]</a></td></tr>";
	}
	print "</table>";

	if (!$step) {
	print "<br><b>Add Weapon:<b>";
	print "<form method=post action=admin.php?view=weapon&step=add>";
	print "<table>";
	print "<tr><td><b>Name: </td><td><input type=text name=wname></td></tr>";
	print "<tr><td><b>Power: </td><td><input type=text name=wpower></td></tr>";
	print "<tr><td><b>Status: </td><td><input type=text name=wstatus></td></tr>";
	print "<tr><td><b>Type: </td><td><input type=text name=wtype></td></tr>";
	print "<tr><td><b>Cost: </td><td><input type=text name=wcost></td></tr>";
	print "<tr><td colspan=2><input type=submit value=Add></td></tr>";
	print "</table>";
	print "</form>";
	print "<table bgcolor=#444444 align=center width=85%>";
	print "<tr><td valign=top>";
	print "<b>TYPE:</b><br>";
	print "<b>W</b> - Weapon<br>";
	print "<b>A</b> - Armor<br>";
	print "<b>S</b> - Shield<br>";
	print "</td><td valign=top>";
	print "<b>Status:</b><br>";
	print "<b>U</b> - unequiped<br>";
	print "<b>E</b> - equiped<br>";
	print "</td></tr>";
	print "</table><br>";
	}

	   if ($step == 'add') {
	   	  $isit = mysql_num_rows(mysql_query("select * from equipment where name='$wname'"));
	   	  		if ($isit > 0) {
		  		   print "That weapon name is already taken.";
		  		   include("foot.php");
		  		   exit;
				}
		 	mysql_query("insert into equipment (id, name, power, status, type, cost) values('0','$wname','$wpower','$wstatus','$wtype','$wcost')") or die("Could not add that weapon.");
			print "You added $wname to the equipment.";
		}
	if ($step == 'edit') {
	   print "$free";
	   $w = mysql_fetch_array(mysql_query("select * from equipment where id='$free'"));
	   	print "<table>";
		print "<tr><td colspan=2><br><b>Edit Weapon:<b></td><td><b>Original:</b></td></tr>";
	   	print "<form method=post action=admin.php?view=weapon&step=edit&option=edit>";
		print "<input type=hidden name='weapid' value=$w[id]>";
		print "<tr><td><b>Name: </td><td><input type=text name=wname value=$w[name]></td><td>$w[name]</td></tr>";
		print "<tr><td><b>Power: </td><td><input type=text name=wpower value=$w[power]></td><td>$w[power]</td></tr>";
		print "<tr><td><b>Status: </td><td><input type=text name=wstatus value=$w[status]></td><td>$w[status]</td></tr>";
		print "<tr><td><b>Type: </td><td><input type=text name=wtype value=$w[type]></td><td>$w[type]</td></tr>";
		print "<tr><td><b>Cost: </td><td><input type=text name=wcost value=$w[cost]></td><td>$w[cost]</td></tr>";
		print "<tr><td colspan=2><input type=submit value=Edit></td></tr>";
		print "</table>";
		print "</form>";
		print "<table bgcolor=#444444 align=center width=85%>";
		print "<tr><td valign=top>";
		print "<b>TYPE:</b><br>";
		print "<b>W</b> - Weapon<br>";
		print "<b>A</b> - Armor<br>";
		print "<b>S</b> - Shield<br>";
		print "</td><td valign=top>";
		print "<b>Status:</b><br>";
		print "<b>U</b> - unequiped<br>";
		print "<b>E</b> - equiped<br>";
		print "<b>S</b> - Store<br>";
		print "</td></tr>";
		print "</table><br>";

	   if ($option == 'edit') {
	   	  mysql_query("update equipment set name='$wname' where id='$weapid'") or die("Could not edit that weapon. (name)");
	 	  mysql_query("update equipment set power=$wpower where id='$weapid'") or die("Could not edit that weapon. (power)");
	   	  mysql_query("update equipment set status='$wstatus' where id='$weapid'") or die("Could not edit that weapon. (status)");
	   	  mysql_query("update equipment set type='$wtype' where id='$weapid'") or die("Could not edit that weapon. (type)");
	   	  mysql_query("update equipment set cost='$wcost' where id='$weapid'") or die("Could not edit that weapon. (cost)");
	   }
	}
}

?>

<?php include("footer.php"); ?>
