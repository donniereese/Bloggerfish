<?php $title = "The Core"; include("header.php"); ?>

<?php
if ($stat[corepass] != Y) {
	print "Welcome to the Core. The Core is an area in which Cores, a native animal to Indocron, are kept. ";
	print "They used to populate the entire planet, but overhunting and poaching have caused them to be ";
	print "placed in the protection of Indocron's Core. If you buy a Core Liscence, you will be able to ";
	print "capture and train Cores of your own.";
	if ($stat[credits] <= 500) {
		print "<br>It costs 500 credits to get a liscence - 500 credits that you don't have. Please come back ";
		print "when you have that amount.";
	} else {	
		print "<br>You have 500 credits - why not get a liscence? This will open up new areas of the game for you, as well.";
		print "<ul>";
		print "<li><a href=core.php?answer=yes>Sure, I'll take it.</a></li>";
		print "<li><a href=core.php?answer=no>Nah...</a></li>";
		print "</ul>";
		if ($answer == yes) {
			if ($stat[credits] < 500) {
				print "You don't have enough credits. Scram.";
			} else {
				mysql_query("update players set credits=credits-500 where id=$stat[id]");
				mysql_query("update players set corepass='Y' where id=$stat[id]");
				print "Great - you now have the Core pass. Please click <a href=core.php>here</a> to continue.";
			}
		} 
	}
	include("footer.php");
	exit;
}

if (empty ($view)) {
	print "Welcome to the Core! I see you have your liscense... well, enjoy yourself.
	<ul>
	<li><a href=core.php?view=mycores>My Cores</a> 
	<li><a href=core.php?view=arena>Core Arena</a>
	<li><a href=core.php?view=train>Core Training Facility</a>
	<li><a href=core.php?view=market>Core Market</a>
	<li><a href=core.php?view=explore>Explore</a>
	<li><a href=core.php?view=library>Core Library</a>
	<li><a href=core.php?view=breeding>Core Breeding Center</a> (uc)<br><br>
	<li><a href=core.php?view=help>Core Guide</a>
	</ul>";
}

if ($view == mycores) {
	if (!$id) {
		print "Here is a list of all of the current cores you have found.";
		print "<ul>";
		$csel = mysql_query("select * from core where owner=$stat[id]");
		while ($core = mysql_fetch_array($csel)) {
			if ($core[active] == T) {
				print "<li><a href=core.php?view=mycores&id=$core[id]>$core[name] Core</a> (Active)";
			} else {
				print "<li><a href=core.php?view=mycores&id=$core[id]>$core[name] Core</a>";
			}
		}
		print "</ul>";
	} else {
		$coreinfo = mysql_fetch_array(mysql_query("select * from core where id=$id"));
		if (empty ($coreinfo[id])) {
			print "No such core.";
		} else {
			if ($coreinfo[owner] != $stat[id]) {
				print "That's not your core!";
			} else {
				print "<center><br><table class=td width=300 cellpadding=0 cellspacing=0>";
				print "<tr><td align=center bgcolor=#222222 style=\"border-bottom: solid black 1px;\" colspan=2><b>View Core</b></td></tr>";
				print "<tr><td width=150 valign=top>+ <b>Basic Information</b>";
					print "<ul>";
					print "<li>ID: $coreinfo[id]";
					print "<li>Name: $coreinfo[name]";
					print "<li>Type: $coreinfo[type]";
					print "</ul>";
				print "</td><td width=150 valign=top style=\"border-left: solid black 1px\">";
					print "+ <b>Physical Information</b>";
					print "<ul>";
					print "<li>Status: $coreinfo[status]";
					print "<li>Power: $coreinfo[power]";
					print "<li>Defense: $coreinfo[defense]";
					print "</ul>";
				print "</td></tr>";
				print "<tr><td colspan=2 align=center style=\"border-top: solid black 1px;\" bgcolor=#222222>Options: (<a href=core.php?view=library&id=$coreinfo[ref_id]>Look Up</a>) (<a href=core.php?view=mycores&activate=$coreinfo[id]>Activate</a>) (<a href=core.php?view=mycores&release=$coreinfo[id]>Release</a>)</td></tr>";
				print "</table></center>";
			}
		}
	}
	if ($activate) {
		$active = mysql_fetch_array(mysql_query("select * from core where id=$activate"));
		if ($active[owner] != $stat[id]) {
			print "You don't own that core.";
		} else {
			mysql_query("update core set active='N' where owner=$stat[id]");
			mysql_query("update core set active='T' where id=$activate");
			print "You activated your <b>$active[name] Core</b> (<a href=core.php?view=mycores>refresh</a>).";
		}
	}
	if ($release) {
		$rel = mysql_fetch_array(mysql_query("select * from core where id=$release"));
		if ($rel[owner] != $stat[id]) {
			print "You don't own that core.";
		} else {
			mysql_query("delete from core where id=$rel[id]");
			print "You released your <b>$rel[name] Core</b> (<a href=core.php?view=mycores>refresh</a>).";
		}
	}
}

if ($view == library) {
	if (!$id) {
		$numys = mysql_num_rows(mysql_query("select * from core where owner=$stat[id] and type='Secret'"));
		$numyh = mysql_num_rows(mysql_query("select * from core where owner=$stat[id] and type='Hybrid'"));
		$numcores = mysql_num_rows(mysql_query("select * from cores where type!='Secret' and type!='Hybrid'"));
		$tnumc = ($numcores + $numys + $numyh);
		$yourc = mysql_num_rows(mysql_query("select * from core where owner=$stat[id]"));
		print "Welcome to the Core library, $stat[user]. You have found <b>$yourc</b> cores out of a total of <b>$tnumc</b> cores acknowledged to exist.";
		print "<br><br>You can use our facilities, however, you are only permitted to view information on cores that you have seen.";
		print "<br><br>+ <b>Basic Cores</b><br>";
		print "<ul>";
		$csel = mysql_query("select * from cores");
		while ($cr = mysql_fetch_array($csel)) {
			$yh = mysql_num_rows(mysql_query("select * from core where owner=$stat[id] and name='$cr[name]'"));
			if ($yh > 0) {
				print "<li><a href=core.php?view=library&id=$cr[id]>$cr[name]</a> ($cr[type])";
			} else {
				print "<li>? (?)";
			}
		}
		print "</ul>";
		$yhc = mysql_num_rows(mysql_query("select * from core where owner=$stat[id] and type='Hybrid'"));
		if ($yhc > 0) {
			print "+ <b>Hybrid Cores</b>";
			print "<ul>";
			$csel = mysql_query("select * from core where type='Hybrid'");
			while ($cr = mysql_fetch_array($csel)) {
				$yh = mysql_num_rows(mysql_query("select * from core where owner=$stat[id] and name='$cr[name]'"));
				if ($yh > 0) {
					print "<li><a href=core.php?view=library&id=$cr[id]>$cr[name]</a> ($cr[type])";
				} else {
					print "<li>? (?)";
				}
			}
			print "</ul>";
		}
		$yhc = mysql_num_rows(mysql_query("select * from core where owner=$stat[id] and type='Secret'"));
		if ($yhc > 0) {
			print "+ <b>Secret Cores</b>";
			print "<ul>";
			$csel = mysql_query("select * from cores where type='Secret'");
			while ($cr = mysql_fetch_array($csel)) {
				$yh = mysql_num_rows(mysql_query("select * from core where owner=$stat[id] and name='$cr[name]'"));
				if ($yh > 0) {
					print "<li><a href=core.php?view=library&id=$cr[id]>$cr[name]</a> ($cr[type])";
				} else {
					print "<li>? (?)";
				}
			}
		}
	} else {
		$coreinfo = mysql_fetch_array(mysql_query("select * from cores where id=$id"));
		$ycore = mysql_num_rows(mysql_query("select * from core where name='$coreinfo[name]' and owner=$stat[id]"));
		if ($ycore > 0) {
			print "<br><center>";
			print "<table cellpadding=0 cellspacing=0 class=td align=center width=300>";
			print "<tr><td colspan=2 align=center bgcolor=eeeeee style=\"border-bottom: solid black 1px;\"><b>Look Up Core</td></tr>";
			print "<tr><td valign=top width=150>";
				print "+ <b>Basic Information</b>";
				print "<ul>";
				print "<li>Reference ID: $coreinfo[id]";
				print "<li>Name: $coreinfo[name]";
				$caught = mysql_num_rows(mysql_query("select * from core where name='$coreinfo[name]'"));
				print "<li>Type: $coreinfo[type]";
				print "<li>Rarity: $coreinfo[rarity]";
				print "<li>Captivated: $caught";
				print "</ul>";
			print "</td><td width=150 valign=top style=\"border-left: solid black 1px;\">";
				print "+ <b>Description</b><br><br>";
				print "<ul><li>$coreinfo[desc]</ul>";
			print "</td></tr>";
			print "</table></center>";
		} else {
			print "You have not obtained that core.";
		}
	}	
}	

if ($view == arena) {
	if (!$step && !$attack) {
		print "Welcome to the Core Arena. Battling here has different rules than on the surface of Indocron - each Core gets one shot at the other. The Core that does the most absolute damage will be declared the victor.";
		print "<ul>";
		print "<li><a href=core.php?view=arena&step=battles>Show battle-ready Cores</a>.";
		print "<li><a href=core.php?view=arena&step=heal>Heal my Cores</a>.";
		print "</ul>";
	}
	if ($step == battles) {
		print "<table>";
		print "<tr><td width=100><b><u>Core</td><td width=100><b><u>Owner</td><td width=100><b><u>Options</td></tr>";
		$csel = mysql_query("select * from core where status='Alive' and active='T' and owner!=$stat[id]");
		while ($clist = mysql_fetch_array($csel)) {
			print "<tr><td><a href=core.php?view=library&id=$clist[ref_id]>$clist[name]</a> Core</td><td><a href=view.php?view=$clist[owner]>$clist[owner]</a></td><td><a href=core.php?view=arena&attack=$clist[id]>Attack</a></td></tr>";
		}
		print "</table>";
	}
	if ($attack) {
		if ($stat[energy] < 0) {
			print "You don't have enough energy!";
		} else {
			$mycore = mysql_fetch_array(mysql_query("select * from core where active='T' and owner=$stat[id]"));
			if (empty ($mycore[id])) {
				print "You have no active core!";
			} else {
				if ($mycore[status] == Dead) {
					print "Your active Core is dead!";
				} else {
					print "+ <b>Core Battle</b><br>";
					$enemy = mysql_fetch_array(mysql_query("select * from core where id=$attack"));
					$numy = mysql_num_rows(mysql_query("select * from core where owner=$stat[id] and id=$enemy[id]"));
					if ($numy > 0) {
						print "You cannot fight your own Cores!";
					} else {
						if ($enemy[status] == Dead) {
							print "That core is dead.";
						} else {
							print "Your $mycore[name] Core vs. ID $enemy[owner]'s $enemy[name] Core.<br><br>";
							$yattack = ($mycore[power] - $enemy[defense]);
							if ($yattack <= 0) {
								$yattack = 0;
							}
							$eattack = ($enemy[power] - $mycore[defense]);
							if ($eattack <= 0) {
								$eattack = 0;
							}
							print "The enemy <b>$enemy[name] Core</b> attacks for $eattack!<br>";
							print "Your <b>$mycore[name] Core</b> retaliates for $yattack!<br><br>";
							if ($eattack == $yattack) {
								print "The battle has been a <b>stalemate</b>.";
							} else {
								if ($eattack > $yattack) {
									$victor = mysql_fetch_array(mysql_query("select * from players where id=$enemy[owner]"));
									$loser = mysql_fetch_array(mysql_query("select * from players where id=$stat[id]"));
								} else {
									$victor = mysql_fetch_array(mysql_query("select * from players where id=$stat[id]"));
									$loser = mysql_fetch_array(mysql_query("select * from players where id=$enemy[owner]"));
								}
								print "$victor[user]'s Core has defeated $loser[user]'s Core.<br>";
								if ($victor[user] == $stat[user]) {
									print "Your <b>$mycore[name] Core</b> has defeated $loser[user]'s <b>$enemy[name] Core</b>!<br><br>";
									mysql_query("update core set status='Dead' where id=$enemy[id]");
								} else {
									print "Your <b>$mycore[name] Core</b> was defeated by $victor[user]'s <b>$enemy[name] Core</b>!<br><br>";
									mysql_query("update core set status='Dead' where id=$stat[id]");
								}
								$crgain = rand(0,100);
								$plgain = rand(0,3);
								print "$victor[user] has gained <b>$crgain</b> credits from the battle, as well as <b>$plgain</b> platinum!";
								mysql_query("update players set platinum=platinum+$plgain where id=$victor[id]");
								mysql_query("update players set credits=credits+$crgain where id=$victor[id]");
							}
						}
					}
				}
			}
		}
	}
	if ($step == heal) {
		$numdead = mysql_num_rows(mysql_query("select * from core where owner=$stat[id] and status='Dead'"));
		$cost = ($numdead * 10);
		print "It will cost <b>$cost</b> credits to heal all of your <b>$numdead</b> dead Core's statuses back to Alive.";
		print "<ul>";
		print "<li><a href=core.php?view=arena&step=heal&answer=yes>Heal em, doc</a>.";
		print "<li><a href=core.php>No healing for now, thanks anyway</a>.";
		print "</ul>";
		if ($answer == yes) {
			if ($stat[credits] < $cost) {
				print "You don't have enough credits.";
			} else {
				mysql_query("update core set status='Alive' where owner=$stat[id] and status='Dead'");
				mysql_query("update players set credits=credits-$cost where id=$stat[id]");
				print "All of your Cores are ready to fight again.";
			}
		}
	}
}

if ($view == train) {
	print "Welcome to the training facility. You get 15 core trains per reset. Each rain gets a core .125 in specified stat. ";
	print "Right now, you have <b>$stat[trains]</b> available trains.";
	print "<form method=post action=core.php?view=train&step=train>";
	print "Train my <select name=train_core>";
	$csel = mysql_query("select * from core where owner=$stat[id]");
	while ($myc = mysql_fetch_array($csel)) {
		print "<option value=$myc[id]>$myc[name]</option>";
	}
	print "</select> Core <input type=text size=5 name=reps> times with the <select name=technique><option value=power>power</option><option value=defense>defense</option></select> technique. <input type=submit value=Train>";
	print "</form>";
	if ($step == train) {
		if ($reps <= 0) {
			print "No point in training like that.";
		} else {
			if ($reps > $stat[trains]) {
				print "You don't have enough energy to train like that.";
			} else {
				$gain = ($reps * .125);
				mysql_query("update core set $technique=$technique+$gain where id=$train_core");
				mysql_query("update players set trains=trains-$reps where id=$stat[id]");
				print "You trained your Core <b>$reps</b> times, using <b>$trains</b> energy. It gained <b>$gain $technique</b>.";
			}
		}
	}
}

if ($view == market) {
	if (empty ($step)) {
		print "Welcome to the Core market. Here, you can buy cores that people are selling. What will you do?";
		print "<ul>";
		print "<li><A href=core.php?view=market&step=market>View Listings</a>";
		print "<li><A href=core.php?view=market&step=add>Add Listing</a>";
		print "</ul>";
	}
	if ($step == market) {
		print "Here are the Cores that the players are selling.<br><br>";
		print "<table>";
		print "<tr><td width=100><b><u>Core For Sale</td><td width=100><b><u>ID Selling</td><td width=100><b><u>Cost</td><td width=100><b><u>Options</td></tr>";
		$msel = mysql_query("select * from core_market order by id desc");
		while ($market = mysql_fetch_array($msel)) {
			if ($market[seller] == $stat[id]) {
				print "<tr><td>$market[name]</td><td>Me</td><td>$market[cost] cr</td><td><a href=core.php?view=market&step=market&remove=$market[id]>Remove</a></td></tr>";
			} else {
				print "<tr><td>$market[name]</td><td><a href=view.php?view=$market[seller]>$market[seller]</a></td><td>$market[cost] cr</td><td><a href=core.php?view=market&step=market&buy=$market[id]>Buy</a></td></tr>";
			}
		}
		print "</table>";
		if ($remove) {
			$rem = mysql_fetch_array(mysql_query("select * from core_market where id=$remove"));
			if ($rem[seller] != $stat[id]) {
				print "That's not yours to remove.";
			} else {
				mysql_query("insert into core (owner,name,type,power,defense) values($stat[id],'$rem[name]','$rem[type]',$rem[power],$rem[defense])") or die("Could not get back.");
				mysql_query("delete from core_market where id=$rem[id]");
				print "You removed the listing. Got back your <b>$rem[name] Core</b>.";
			}
		}
		if ($buy) {
			$buy = mysql_fetch_array(mysql_query("select * from core_market where id=$buy"));
			if ($buy[seller] == $stat[id]) {
				print "Don't buyyour own stuff..";
			} else {
				if ($stat[credits] < $buy[cost]) {
					print "You can't afford it.";
				} else {
					mysql_query("insert into core (owner,name,type,power,defense) values($stat[id],'$buy[name]','$buy[type]',$buy[power],$buy[defense])") or die("Could not get back.");
					mysql_query("update players set credits=credits-$buy[cost] where id=$stat[id]");
					mysql_query("update players set credits=credits+$buy[cost] where id=$buy[seller]");
					mysql_query("delete from core_market where id=$buy[id]");
					mysql_query("insert into log (owner,log) values($buy[seller],'$stat[user] bought your $buy[name] Core for $buy[cost] credits.')");
					print "You bought a <b>$buy[name] Core</b> for <b>$buy[cost]</b> credits.";
				}
			}
		}
		
	}
	if ($step == add) {
		print "Here, add your Core to the market listings.";
		print "<form method=post action=core.php?view=market&step=add&action=add>";
		print "Add my <select name=add_core>";
		$csel = mysql_query("select * from core where owner=$stat[id]");
		while ($mc = mysql_fetch_array($csel)) {
			print "<option value=$mc[id]>$mc[name]</option>";
		}
		print "</select> Core for <input type=text size=7 name=cost> credits. <input type=submit value=Sell>";
		print "</form>";
		if ($action == add) {
			if ($cost <= 0) {
				print "No point in that price.";
			} else {
				$numon = mysql_num_rows(mysql_query("select * from core_market where seller=$stat[id]"));
				if ($numon >= 5) {
					print "You can only have a maximum of 5 listings at a time!";
				} else {
					$sc = mysql_fetch_array(mysql_query("select * from core where id=$add_core"));
					mysql_query("insert into core_market (seller, cost, name, type, power, defense) values($stat[id],$cost,'$sc[name]','$sc[type]',$sc[power],$sc[defense])");
					mysql_query("delete from core where id=$add_core");
					print "You added your <b>$sc[name]Core</b> to the market for <b>$cost</b> credits.";
				}
			}
		}
	}
}
	
if ($view == explore) {
		if (!$explore) {
		print "Welcome to the exploration center of the Core. Please choose a region in which to look for cores. There are many regions, but you must achieve certain amounts of platinum and statistics to gain entrance. Cores  seem to be attracted to platinum for some reason...";
		print "<ul>";
		print "<li><a href=core.php?view=explore&explore=Forest>The Forest</a> (0 pl)";
		print "<li><a href=core.php?view=explore&explore=Ocean>The Ocean</a> (50 pl)";
		print "<li><a href=core.php?view=explore&explore=Mountains>The Mountains</a> (100 pl)";
		print "<li><a href=core.php?view=explore&explore=Nature>Nature</a> (150 pl)";
		print "<li><a href=core.php?view=explore&explore=Space>Space</a> (200 pl)";
		print "<li><a href=core.php?view=explore&explore=Time>Time Itself</a> (250 pl)";
		print "</ul>";
	} else {
		if ($explore) {
			if ($stat[energy] < 0) {
				print "You don't have enough energy to explore.";
				include("footer.php"); 
				exit;
			}

			if ($explore == Forest) { $req = 0; }
			elseif ($explore == Ocean) { $req = 50; }
			elseif ($explore == Mountains) { $req = 100; }
			elseif ($explore == Nature) { $req = 150; }
			elseif ($explore == Space) { $req = 200; }
			elseif ($explore == Time) { $req = 250; }
			else { print "That region does not exist!"; include("footer.php"); exit; }
			if ($stat[platinum] < $req) {
				print "You don't have the required amount of platinum.";
				include("footer.php");
				exit;
			}

			if ($explore == Forest) { $type = 'Plant'; $common[1] = 1; $common[2] = 2; $common[3] = 3; $uncommon = 4; $rare = 5; }
			if ($explore == Ocean) { $type = 'Aqua'; $common[1] = 6; $common[2] = 7; $common[3] = 8; $uncommon = 9; $rare = 10; }
			if ($explore ==Mountains) { $type = 'Material'; $common[1] = 11; $common[2] = 12; $common[3] = 13; $uncommon = 14; $rare = 15; }
			if ($explore == Nature) { $type = 'Element'; $common[1] = 16; $common[2] =17; $common[3] = 18; $uncommon =19; $rare = 20; }
			if ($explore == Space) { $type = 'Alien'; $common[1] = 21; $common[2] = 22; $common[3] = 23; $uncommon = 24; $rare = 25; }
			if ($explore == Time) { $type = 'Ancient'; $common[1] = 26; $common[2] = 27; $common[3] = 28; $uncommon = 29; $rare =30; }
	
			print "You went looking for a Core in the <b>$explore</b> region of The Core...<br>";
			
			$roll = 1;
			$roll2 = 1;
			if ($roll != $roll2) {
				print "However, the search was unsuccessful.";
			} else {
				$rare = rand(1,1);
				if ($rare == 1) {
					$odds = rand(1,100);
					$chance = rand(1,100);
					if ($chance == $odds) {
						$core = rand(1,3);
						$core = $common[$core];
						$coreinfo = mysql_fetch_array(mysql_query("select * from cores where id=$core"));
						print "You found a <b>$coreinfo[name] Core</b>! It is of the <b>$coreinfo[type]</b> type.";
						if ($coreinfo[rarity] == 1) { print "<br>This core is classified as <b>common</b>."; }
						if ($coreinfo[rarity] == 2) { print "<br>This core is classified as <b>uncommon</b>."; }
						if ($coreinfo[rarity] == 3) { print "<br>This core is classified as <b>rare</b>."; }
						$corenum = mysql_num_rows(mysql_query("select * from core where owner=$stat[id] and name='$coreinfo[name]'"));
						if ($corenum <= 0) { print "<br>This is your first of this Core specie!"; } else { print "<br>You already have this Core."; }
						mysql_query("insert into core (owner,name,type,ref_id,power,defense) values($stat[id],'$coreinfo[name]','$coreinfo[type]',$core,$coreinfo[power],$coreinfo[defense])") or die("Could not add Core.");
					} else {
						print "You see a Core! However, it flees before you can catch it.";
					}
				}
				if ($rare == 2) {
					$odds = rand(1,500);
					$chance = rand(1,500);
					if ($chance == $odds) {
						$core = $uncommon;
						$coreinfo = mysql_fetch_array(mysql_query("select * from cores where id=$core"));
						print "You found a <b>$coreinfo[name] Core</b>! It is of the <b>$coreinfo[type]</b> type.";
						if ($coreinfo[rarity] == 1) { print "<br>This core is classified as <b>common</b>."; }
						if ($coreinfo[rarity] == 2) { print "<br>This core is classified as <b>uncommon</b>."; }
						if ($coreinfo[rarity] == 3) { print "<br>This core is classified as <b>rare</b>."; }
						$corenum = mysql_num_rows(mysql_query("select * from core where owner=$stat[id] and name='$coreinfo[name]'"));
						if ($corenum <= 0) { print "<br>This is your first of this Core specie!"; } else { print "<br>You already have this Core."; }
						mysql_query("insert into core (owner,name,type,ref_id,power,defense) values($stat[id],'$coreinfo[name]','$coreinfo[type]',$core,$coreinfo[power],$coreinfo[defense])") or die("Could not add Core.");
					} else {
						print "You see a Core! However, you are unable to capture it.";
					}
				}
				if ($rare == 3) {
					$odds = rand(1,1000);
					$chance = rand(1,1000);
					if ($chance == $odds) {
						$core = $rare;
						$coreinfo = mysql_fetch_array(mysql_query("select * from cores where id=$core"));
						print "You found a <b>$coreinfo[name] Core</b>! It is of the <b>$coreinfo[type]</b> type.";
						if ($coreinfo[rarity] == 1) { print "<br>This core is classified as <b>common</b>."; }
						if ($coreinfo[rarity] == 2) { print "<br>This core is classified as <b>uncommon</b>."; }
						if ($coreinfo[rarity] == 3) { print "<br>This core is classified as <b>rare</b>."; }
						$corenum = mysql_num_rows(mysql_query("select * from core where owner=$stat[id] and name='$coreinfo[name]'"));
						if ($corenum <= 0) { print "<br>This is your first of this Core specie!"; } else { print "<br>You already have this Core."; }
						mysql_query("insert into core (owner,name,type,ref_id,power,defense) values($stat[id],'$coreinfo[name]','$coreinfo[type]',$core,$coreinfo[power],$coreinfo[defense])") or die("Could not add Core.");
					} else {
						print "You see a Core! You look in awe as it escapes.";
					}
				}
			}
		}
		print "<br><br>... <a href=core.php?view=explore&explore=$explore>explore again</a>.";
	}
}

if ($view == breeding) {
	print "The Core Breeder is apparently still constructing his ranch. Please stop by later.";
}

if ($view == help) {
	if (!$step) {
		print "Welcome to the comprehensive guide to Cores. Everything you will need to know is here.";
		print "<ul>";
		print "<li><a href=core.php?view=help&step=getting>Obtaining Cores</a>";
		print "<li><a href=core.php?view=help&step=info>Core Information</a>";
		print "<li><a href=core.php?view=help&step=library>Core Library</a>";
		print "<li><a href=core.php?view=help&step=training>Core Training</a>";
		print "<li><a href=core.php?view=help&step=battling>Core Battling</a>";
		print "<li><a href=core.php?view=help&step=breeding>Core Breeding</a>";
		print "<li><a href=core.php?view=help&step=advpass>Advanced Core Pass</a>";
		print "</ul>";
	}
	if ($step == getting) {
		print "+ <b>Obtaining Cores</b><br><br>";
		print "The basic of Cores - catching them! To catch are Core is simple. All you need to do is go to the Explore option. Then, you will be presented with a number of options. There are many regions to choose, but each is marked by a (# pl). You must have an amount of platinum greater or equal to the #.<br><br>Cores are organized by rarity. Common cores are about a 1/300 chance of finding one. Uncommon cores about 1/1500, rare cores about 1/3000.";
	}
	if ($step == info) {
		print "+ <b>Core Information</b><br><br>";
		print "To view core information, what you must do is go to the My Cores option. Then, just click on a core name. You will have the option to look it up, activate it, or release it.";
	}
	if ($step == library) {
		print "+ <b>Core Library</b><br><br>";
		print "The Core library shows you information on all of the cores you've collected. However, you can only view the ones you own.";
	}
	if ($step == training) {
		print "+ <b>Core Training</b><br><br>";
		print "This is rather self-explanitory. For every .2 energy used training your core (1 rep) it gains .1 in the specified skill.";
	}
	if ($step == battling) {
		print "+ <b>Core Battling</b><br><br>";
		print "Core battling is a very easy way to get Platinum. The higher your Core's power and defense are, the better a shot you have at winning. To be able to battle, though, one of your cores must be in the Active state.";
	}
	if ($step == breeding) {
		print "+ <b>Core Breeding</b><br><br>";
		print "While not yet finished, Core breeding is the only way to get the Hybrid Cores. Hybrid Cores have larger stats than most cores, but are harder to obtain. All 5 Hybrid Cores are classified as rare.";
	}
	if ($step == advpass) {
		print "+ <b>Core Advance Pass</b><br><br>";
		print "The Core Advance Pass is coming later. With a price tag of 5,000 credits, it's going to be hard to reach. However, it will include new ways to look for cores, and an inventory system. Bait, revives, potions, crystals, fishing, rock climbing, cave exploring, trading... all coming soon.";
	}
	if ($step) {
		print "<br><br>... <a href=core.php?view=help>back</a>.";
	} 
}

if ($view) {
	print "<br><br>... <a href=core.php>Core Main</a>.";
}
?>

<?php include("footer.php"); ?>
