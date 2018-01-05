<?php $title = "Tribes"; include("header.php"); ?>

<?php
if (!$view) {
	print "Welcome to the Tribe Center. Here you can view, join, or even create a new tribe.";
	print "<ul>";
	if ($stat[tribe]) {
		$mytribe = mysql_fetch_array(mysql_query("select * from tribes where id=$stat[tribe]"));
		print "<li><a href=tribes.php?view=my>My Tribe</a> ($mytribe[name])";
	} else {
		print "<li>My Tribe";
	}
	if (!$stat[tribe] && $stat[credits] >= 250000) {
		print "<li><a href=tribes.php?view=make>Make a New Tribe</a> (250,000 credits)";
	} else {
		print "<li>Make a New Tribe (250,000 credits)";
	}
	print "<li><a href=tribes.php?view=all>View Tribe List</a>";
	print "</ul>";
}

if ($view == all) {
	print "Here is a list of all tribes.";
	$numt = mysql_num_rows(mysql_query("select * from tribes"));
	if ($numt <= 0) {
		print "<br>It seems that there are no tribes yet created.";
	} else {
		print "<ul>";
		$tsel = mysql_query("select * from tribes");
		while ($tribe = mysql_fetch_array($tsel)) {
			print "<li><a href=tribes.php?view=view&id=$tribe[id]>$tribe[name]</a>, owned by ID <a href=view.php?view=$tribe[owner]>$tribe[owner]</a>.";
		}
	}
}

if ($view == view) {
	$tribe = mysql_fetch_array(mysql_query("select * from tribes where id=$id"));
	if (!$tribe[id]) {
		print "No such tribe.";
	} else {
		print "<ul>";
		print "<li>Viewing: $tribe[name]<br><br>";
		print "Owner: ID <a href=view.php?view=$tribe[owner]>$tribe[owner]</a><br><br>";
		print "$tribe[public_msg]<br><br>";
		print "<center>(<a href=tribes.php?view=join&tribe=$tribe[id]>Join</a>)";
	}
}

if ($view == join) {
	if ($stat[tribe]) {
		print "You're in a tribe!";
	} else {
		print "Which tribe would you like to join?";
		print "<form method=post action=tribes.php?view=join&step=join>";
		print "Join with password <input type=text size=10 name=jpass> for <select name=jtribe>";
		$tsel = mysql_query("select * from tribes");
		while ($ts = mysql_fetch_array($tsel)) {
			if ($ts[id] == $tribe) {
				print "<option sel value=$ts[id]>$ts[name]</option>";
			} else {
				print "<option value=$ts[id]>$ts[name]</option>";
			}
		}
		print "</select>. <input type=submit value=Join>";
		print "</form>";
	}
	if ($step == join) {
		$tribe = mysql_fetch_array(mysql_query("select * from tribes where id=$jtribe"));
		if (empty ($tribe[id])) {
			print "No such tribe.";
		} else {
			if ($jpass == $tribe[pass]) {
				print "You joined $tribe[name].";
				mysql_query("update players set tribe=$tribe[id] where id=$stat[id]");
				mysql_query("insert into log (owner,log) values($stat[id],'You joined the tribe $tribe[name].')");
			} else {
				print "Wrong password.";
			}
		}
	}
}

if ($view == make) {
	if ($stat[credits] < 25000) {
		print "You don't have enough credits.";
		include("footer.php");
		exit;
	}
	if ($stat[tribe]) {
		print "You are already in a tribe.";
		include("footer.php");
		exit;
	}
	print "<table><form method=post action=tribes.php?view=make&step=make>";
	print "<tr><td>Tribe Name:</td><td><input type=text name=name></td></tr>";
	print "<tr><td>Tribe Pass:</td><td><input type=text name=tpass></td></tr>";
	print "<tr><td colspan=2 align=center><input type=submit value=Make></td></tr>";
	print "</form></table>";
	if ($step == make) {
		if (!$name || !$tpass) {
			print "Please fill out both fields.";
		} else {
			print "You just created a new tribe, <i>$name</i>.<br>";
			print "For people to join the tribe, the password <i>$pass</i> must be specified in order to join the clan.";
			mysql_query("insert into tribes (name,owner,pass) values('$name',$stat[id],'$tpass')");
			mysql_query("update players set credits=credits-25000 where id=$stat[id]");
			$newt = mysql_fetch_array(mysql_query("select * from tribes where owner=$stat[id]"));
			mysql_query("update players set tribe=$newt[id] where id=$stat[id]");
		}
	}
}
if ($view == my) {
	if (!$stat[tribe]) {
		print "You're not in a tribe!";
	} else {
		$mytribe = mysql_fetch_array(mysql_query("select * from tribes where id=$stat[tribe]"));
		print "<br><center><table width=98% class=td cellpadding=0 cellspacing=0>";
		print "<tr><td align=center style=\"border-bottom: solid black 1px;\" bgcolor=111111><b>My Tribe: $mytribe[name]</td></tr>";
		print "</td><td width=100% valign=top>";
		if (!$step) {
			print "Welcome to your tribe.";
			print "<ul>";
			print "<li>Tribe Name: $mytribe[name]";
			$memnum = mysql_num_rows(mysql_query("select * from players where tribe=$mytribe[id]"));
			print "<li>Members: $memnum";
			$owner = mysql_fetch_array(mysql_query("select * from players where id=$mytribe[owner]"));
			print "<li>Owner: <a href=view.php?view=$owner[id]>$owner[user]</a>";
			$coowner = mysql_fetch_array(mysql_query("select * from players where id=$mytribe[coowner]"));
			if (!$coowner[user]) {
				print "<li>Co-Owner: None";
			} else {
				print "<li>Co-Owner: <a href=view.php?view=$coowner[id]>$coowner[user]</a>";
			}
			print "<li>Credits: $mytribe[credits]";
			print "<li>Platinum: $mytribe[platinum]";
			print "</ul>";
			print "$mytribe[private_msg]";
		}
		if ($step == donate) {
			print "Please donate to your tribe, and help it out financially.";
			print "<form method=post action=tribes.php?view=my&step=donate&step2=donate>";
			print "Donate <input type=text size=5 name=amount value=0> <select name=type><option value=credits>Credits</option><option value=platinum>Platinum</option></select> to my tribe. <input type=submit value=Donate>";
			print "</form>";
			if ($step2 == donate) { 
				if ($amount > $stat[$type]) {
					print "You don't have enough $type.";
				} else {
					mysql_query("update players set $type=$type-$amount where id=$stat[id]");
					mysql_query("update tribes set $type=$type+$amount where id=$mytribe[id]");
					print "You donated <b>$amount $type</b> to your tribe.";
				}
			}
		}
		if ($step == members) {
			$msel = mysql_query("select * from players where tribe=$mytribe[id]");
			while ($mem = mysql_fetch_array($msel)) {
				if ($mem[id] == $mytribe[owner]) {
					print "- <a href=view.php?view=$mem[id]>$mem[user]</a> ($mem[id]) (Owner)<br>";
				} elseif ($mem[id] == $mytribe[coowner]) {
					print "- <a href=view.php?view=$mem[id]>$mem[user]</a> ($mem[id]) (Co-Owner)<br>";
				} else {
					print "- <a href=view.php?view=$mem[id]>$mem[user]</a> ($mem[id])<br>";
				}
			}
		}
		if ($step == quit) {
			if ($mytribe[owner] == $stat[id]) {
				mysql_query("update players set tribe=0 where tribe=$mytribe[id]");
				mysql_query("delete from tribes where id=$mytribe[id]");
				print "You left your tribe. Since you were the owner, the tribe was deleted.";
			} elseif ($mytribe[coowner] == $stat[id]) {
				mysql_query("update tribes set coowner=0 where id=$mytribe[id]");
				mysql_query("update players set tribe=0 where id=$stat[id]");
				print "You left your tribe. Since you were the co-owner, yiou emptied the position.";
			} else {
				mysql_query("update players set tribe=0 where id=$stat[id]");
				print "You left your tribe.";
			}
		}
		if ($step == owner) {
			if ($stat[id] == $mytribe[owner] || $stat[id] == $mytribe[coowner]) {
				print "Welcome to the tribe owner panel. What would you like to do?";
				print "<ul>";
				print "<li><a href=tribes.php?view=my&step=owner&step2=messages>Edit Messages</a>";
				print "<li><a href=tribes.php?view=my&step=owner&step2=kick>Kick Members</a>";
				print "<li><a href=tribes.php?view=my&step=owner&step2=pass>Change Tribe Pass</a>";
				print "<li><a href=tribes.php?view=my&step=owner&step2=loan>Loan Money</a>";
				if ($stat[id] == $mytribe[owner]) {
					print"<li><a href=tribes.php?view=my&step=owner&step2=coowner>Add Co Owner</a>";
				}
				print "</ul>";
				if ($step2 == messages) {
					
					$mytribe[private_msg] = str_replace("<br />","",$mytribe[private_msg]);
					$mytribe[public_msg] = str_replace("<br />","",$mytribe[public_msg]);
					
					print "<table><form method=post action=tribes.php?view=my&step=owner&step2=messages&action=edit>";
					print "<tr><td valign=top>Public Message:</td><td><textarea name=public_msg cols=80 rows=10>$mytribe[public_msg]</textarea></td></tr>";
					print "<tr><td valign=top>Private Message:</td><td><textarea name=private_msg cols=80 rows=10>$mytribe[private_msg]</textarea></td></tr>";
					print "<tr><td colspan=2 align=center><input type=submit value=Change></td></tr>";
					print "</form></table>";
					if ($action == edit) {
						$private_msg = strip_tags($private_msg,"<hr><br><b><u><s><i>");
						$public_msg = strip_tags($public_msg,"<hr><br><b><u><s><i>");
						$private_msg = nl2br($private_msg);
						$public_msg = nl2br($public_msg);
						mysql_query("update tribes set private_msg='$private_msg' where id=$mytribe[id]");
						mysql_query("update tribes set public_msg='$public_msg' where id=$mytribe[id]");
						print "Messages edited.";
					}
				}
				if ($step2 == kick) {
					print "<form method=post action=tribes.php?view=my&step=owner&step2=kick&action=kick>";
					print "Kick ID <input type=text size=5 name=id> from the tribe. <input type=submit value=Kick>";
					print "</form>";
					if ($action == kick) {
						if ($id != $mytribe[owner]) {
							mysql_query("update players set tribe=0 where id=$id and tribe=$mytribe[id]");
							mysql_query("insert into log (owner,log) values($id,'You were kicked out of $mytribe[name].')");
							print "ID $id is now no longer in the tribe.";
						} else {
							print "You can't kick the owner.";
						}
					}
				}
				if ($step2 == pass) {
					if ($stat[id] != $mytribe[owner]) {
						print "Only the owner can change the pass.";
					} else {
						print "<form method=post action=tribes.php?view=my&step=owner&step2=pass&action=change>";
						print "<table>";
						print "<tr><td>Old Pass:</td><td><input type=text name=oldpass></td></tr>";
						print "<tr><td>New Pass:</td><td><input type=text name=newpass></td></tr>";
						print "<tr><td colspan=2 align=center><input type=submit value=Change></td></tr>";
						print "</form></table>";
						if ($action == change) {
							if (!$oldpass || !$newpass) {
								print "Please fill out all fields.";
							} else {
								if ($oldpass != $mytribe[pass]) {
									 print "Wrong password.";
								} else {
									mysql_query("update tribes set pass='$newpass' where id=$mytribe[id]");
									print "You changed the password from <i>$mytribe[pass]</i> to <i>$newpass</i>.";
								}
							}
						}
					}
				}
				if ($step2 == loan) {
					if ($stat[id] != $mytribe[owner]) {
						print "You are not the tribe owner.";
					} else {
						print "<form method=post action=tribes.php?view=my&step=owner&step2=loan&action=loan>";
						print "Loan <input type=text size=5 name=amount> <select name=currency><option value=credits>credits</option><option value=platinum>platinum</option></select> to ID <input type=text size=5 name=id>. <input type=submit value=Loan>";
						print "</form>";
						if ($action == loan) {
							$rec = mysql_fetch_array(mysql_query("select * from players where id=$id"));
							if ($rec[tribe] != $mytribe[id]) {
								print "That person is not in the clan.";
							} else {
								if (!$amount || !$id) {
									print "Please fill out all fields.";
								} else {
									if ($amount > $mytribe[$currency]) {
										print "The tribe doesn't have enough $currency.";
									} else {
										mysql_query("update players set $currency=$currency+$amount where id=$id");
										mysql_query("update tribes set $currency=$currency-$amount where id=$mytribe[id]");
										mysql_query("insert into log (owner,log) values($id,'Your clan loaned you $amount $currency.')");
										print "You loaned ID $id $amount $currency.";
									}
								}
							}
						}
					}
				}
				
				if ($step2 == coowner) {
					print "<form method=post action=tribes.php?view=my&step=owner&step2=coowner&action=add>";
					print "Add Player ID as Co Owner<br><input type=text size=5 name=id> for the tribe. <input type=submit value=Add>";
					print "</form>";
					if ($action == add) {
						if ($id != $mytribe[owner]) {
							mysql_query("update players set tribe=$mytribe[id] where id=$id");
							mysql_query("update tribes set coowner=$id where id=$mytribe[id]");
							mysql_query("insert into log (owner,log) values($id,'You were added as Co Owner of $mytribe[name].')");
							print "ID $id is now Co Owner the tribe.";
						} else {
							print "You can't kick the owner.";
						}
					}
				}
				
			} else {
				print "You're not authorized to be here.";
			}
		}
		print "</td></tr>";
		print "<tr><td style=\"border-top: solid black 1px;\" bgcolor=111111 align=center>";
			print "(<a href=tribes.php?view=my>Main</a>) (<a href=tribes.php?view=my&step=donate>Donate</a>) (<a href=tribes.php?view=my&step=members>Members</a>) (<a href=tribes.php?view=my&step=quit>Quit</a>) (<a href=tribes.php?view=my&step=owner>Owner Options</a>)";
		print "</td></tr>";
		print "</table></center><br>";
	}
}
?>

<?php include("footer.php"); ?>