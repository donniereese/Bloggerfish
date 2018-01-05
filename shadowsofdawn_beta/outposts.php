<?php $title = "Outposts"; include("header.php"); ?>
<?php
 $out = mysql_fetch_array(mysql_query("select * from outposts where owner=$stat[id]"));
if (empty ($out[id])) {
	print "You don't have access to the Outpost minigame! For a mere 50000 credits, you'll be able to play this wonderful game. So, what's it gonna be?<br><br>";
	print "\"<a href=outposts.php?action=buy>Yes</a>.\"<br>";
	print "\"<a href=city.php>No</a>.\"<br>";
	if ($action == buy) {
		$out = mysql_fetch_array(mysql_query("select * from outposts where owner=$stat[id]"));
		if ($out[id]) {
			print "You already have an Outpost! Click <a href=outposts.php>here</a> to go back.";
			include("footer.php");
			exit;
		} else {
			if ($stat[credits] < 50000) {
				print "You don't have enough credits to play Outpost.";
				include("footer.php");
				exit;
			} else {
				mysql_query("update players set credits=credits-50000 where id=$stat[id]");
				mysql_query("insert into outposts (owner) values($stat[id])");
				print "You can now play Outpost! Click <a href=outposts.php>here</a> to go back.";
			}
		}
	}
}
print "<table width=\"100%\" border=\"0\">";
print "<tr>";
print "<td><b>Population: </b>$out[population]</td>";
print "<td><b>Homes: </b>$out[homes]</td>";
print "<td><b>Recruits: </b>$out[troops]<td>";
print "<td><b>Spys: </b>$out[spys]<td>";
print "<td><b>Gold: </b>$out[tokens]</td>";
print "</tr>";
print "</table>";


if (empty ($view) && $out[id]) {
	print "Welcome to Outpost. If this is your first time playing the game, you should read the guide.";
	print "<ul>";
	print "<li><a href=outposts.php?view=myoutpost>My Outpost</a>";
	print "<li><a href=outposts.php?view=mines>The Mines</a>";
	print "<li><a href=outposts.php?view=shop>Outpost Shop</a>";
	print "<li><a href=outposts.php?view=battle>Attack Outpost</a>";
	print "<li><a href=outposts.php?view=spy>Spy's Den</a>";
	print "<li><a href=outposts.php?view=listing>List Outposts</a>";
	print "<li><a href=outposts.php?view=guide>Outpost Guide</a>";
	print "</ul>";
	print "<br><br>";
}
if ($view == guide) {
	print "<u><b>Basics</b></u><br>";
	print "The basic point of the game is to have the biggest outpost and to have the most tokens (Tokens are the game's currency.) Every reset, you get 5 turns. You can do whatever you need to do with those 5 turns.";
	print "<br><br><u><b>Minings</b></u><br>";
	print "Mining is a very good way to get money. Mining takes one turn. Every time you mine, you'll get tokens. The more mines you have, the more you'll gain. You can only have one mine per size of your outpost.";
	print "<br><br><u><b>Outpost Shop</b></u><br>";
	print "The base shop lets you buy more troops and barricades. The more troops you have, the more offense power your base has. The more barricades you have, the more defense power your base has.";
	print "<br><br><b><u>Attacking Outposts</b></u><br>";
	print "Attacking is the most important way to gain tokens. If you have more troops and defenses than the enemy you attack, you will win. Otherwise, you will lose. You can only have 10 troops and 10 barricades per outpost size, so you won't be any type of ubernewb.";
}
if ($view == myoutpost) {
	print "Welcome to your outpost, $stat[user].<br><br>";
	print "<br><br><b><u>Outpost Information</b></u><br>";
	print "<table>";
	print "<tr><td><b>Size</b>:</td><td>$out[size]</td></tr>";
	print "<tr><td><b>Turns</b>:</td><td>$out[turns]</td></tr>";
	print "<tr><td><b>Gold</b>:</td><td>$out[tokens]</td></tr>";
	print "<tr><td><b>Troops</b>:</td><td>$out[troops]</td></tr>";
	print "<tr><td><b>Spys</b>:</td><td>$out[spys]</td></tr>";
	print "<tr><td><b>Barricades</b>:</td><td>$out[barricades]</td></tr>";
	print "</table>";
}
if ($view == mines) {
	if ($out[mines] <= 0) {
		print "You don't have any mines! Would you like to buy one? Only 500 tokens.<br>";
		print "\"<a href=outposts.php?view=mines&step=yes>Yes</a>.\"<br>";
		print "\"<a href=outposts.php?view=myoutpost>No</a>.\"";
		if ($step == yes) {
			if ($out[tokens] < 500) {
				print "You don't have enough totkens.";
				include("footer.php");
				exit;
			}
			mysql_query("update outposts set tokens=tokens-500 where id=$out[id]");
			mysql_query("update outposts set mines=mines+1 where id=$out[id]");
			print "<br>There! You now have a mine. (<a href=outposts.php?view=mines>refresh</a>)";
			include("footer.php");
			exit;
		}
	} else {
		print "Welcome to the mines. What are going to do? You have <b>$out[mines]</b> mines to work with.";
		$needed = ($out[size] * 500);
		print "<ul>";
		print "<li><a href=outposts.php?view=mines&step=buy>Buy a Mine</a> ($needed tokens)";
		print "<li><a href=outposts.php?view=mines&step=mine>Go Mining</a>";
		print "</ul>";
				if ($step == mine) {
			if ($out[turns] <= 0) {

				print "You don't have enough turns.";
			} else {
				mysql_query("update outposts set turns=turns-1 where id=$out[id]");
				$gain = ($out[mines] * rand(10,50));
				mysql_query("update outposts set tokens=tokens+$gain where id=$out[id]");
				print "You mined for some precious gems. You netted <b>$gain</b> tokens.";
			}
		}
		if ($step == buy) {
			if ($out[size] == $out[mines]) {
				print "You've reached the maximum amount of mines that you can have. Come back when your outpost is bigger.";
			} else {
				$needed = ($out[size] * 500);
				if ($out[tokens] < $needed) {
					print "You cannot afford another mine.";
				} else {
					mysql_query("update outposts set tokens=tokens-$needed where id=$out[id]");
					mysql_query("update outposts set mines=mines+1 where id=$out[id]");
					print "You got <b>1</b> mine for <b>$needed</b> tokens.";
				}
			}
		}
	}
}
if ($view == shop) {
	print "Welcome to the Outpost Shop! Buy troops and barricades here, or even increase your outpost's size.";
	print "<ul>";
	$needed = ($out[size] * 750);
	print "<li><a href=outposts.php?view=shop&buy=s>Increase Outpost Size</a> ($needed tokens)";
	print "<li><a href=outposts.php?view=shop&buy=t>Buy A Troop</a> (100 tokens)";
	print "<li><a href=outposts.php?view=shop&buy=p>Buy A Spy</a> (500 tokens)";
	print "<li><a href=outposts.php?view=shop&buy=b>But A Barricade</a> (100 tokens)";
	print "</ul>";
	if ($buy == s) {
		$needed = ($out[size] * 750);
		if ($needed > $out[tokens]) {
			print "You don't have enough tokens.";
		} else {
			mysql_query("update outposts set tokens=tokens-$needed where id=$out[id]");
			mysql_query("update outposts set size=size+1 where id=$out[id]");
			print "You increased your outpost size by <b>1</b> for <b>$needed</b> tokens.";
		}
	}
	if ($buy == t) {
		if (100 > $out[tokens]) {
			print "You don't have enough tokens.";
		} else {
			$max = ($out[size] * 10);
			if ($out[troops] >= $max) {
				print "You have already reached your max troop count. Increase your outpost size.";
			} else {
				mysql_query("update outposts set tokens=tokens-100 where id=$out[id]");
				mysql_query("update outposts set troops=troops+1 where id=$out[id]");
				print "You added one more troop to your outpost for <b>100</b> tokens.";
			}
		}
	}
	if ($buy == p) {
		if (500 > $out[tokens]) {
			print "You don't have enough tokens.";
		} else {
			$max = ($out[size] * 10);
			if ($out[spys] >= $max) {
				print "You have already reached your max troop count. Increase your outpost size.";
			} else {
				mysql_query("update outposts set tokens=tokens-500 where id=$out[id]");
				mysql_query("update outposts set spys=spys+1 where id=$out[id]");
				print "You added one more spy to your outpost for <b>500</b> tokens.";
			}
		}
	}
	
	if ($buy == b) {
		if (100 > $out[tokens]) {
			print "You don't have enough tokens.";
		} else {
			$max = ($out[size] * 10);
			if ($out[barricades] >= $max) {
				print "You have already reached your max barricade count. Increase your outpost size.";
			} else {
				mysql_query("update outposts set tokens=tokens-100 where id=$out[id]");
				mysql_query("update outposts set barricades=barricades+1 where id=$out[id]");
				print "You added one more barricade to your outpost for <b>100</b> tokens.";
			}
		}
	}
}
if ($view == battle) {
	print "Welcome to the war room. Just enter the Outpost ID and we'll be set.";
	print "<table><form method=post action=outposts.php?view=battle&action=battle>";
	print "<tr><td>Outpost ID:</td><td><input type=text name=oid></td></tr>";
	print "<tr><td colspan=2 align=center><input type=submit value=Attack></td></tr>";
	print "</form></table>";
	if ($action == battle) {
		if ($out[turns] <= 0) {
			print "You do not have enough turns.";
		} else {
			$enemy = mysql_fetch_array(mysql_query("select * from outposts where id=$oid"));
			if (empty ($enemy[id])) {
				print "No such outpost.<br><br>";
			} else {
				if ($oid == $out[id]) {
					print "You cant attack your own outpost.<br><br>";
				} else {
					mysql_query("update outposts set turns=turns-1 where owner=$stat[id]");
 $ypower = (($out[troops] - $enemy[barricades]) + rand(1,$out[size]));
					if ($ypower <= 0) {
						$ypower = 1;
					}
					if ($epower <= 0) {
						$epower = 1;
					}
					$epower = (($enemy[troops] - $out[barricades]) + rand(1,$enemy[size]));
					if ($ypower == $epower) {
						print "You attack ID <b>$enemy[id]</b> for <b>$ypower</b> force. However, the enemy retaliates with the same amount of damage.";
					}
					if ($ypower > $epower) {
						print "You attack enemy ID $enemy[id] for <b>$ypower</b> force. Enemy ID only attacks back for <b>$epower</b> force.";
						$gain = ($enemy[size] * rand(100,200));
						print "<br>You win! Gained <b>$gain</b> tokens.";
						mysql_query("update outposts set tokens=tokens+$gain where id=$out[id]");
					}
					if ($ypower < $epower) {
						print "You attack enemy ID $enemy[id] for <b>$ypower</b> force. However, Enemy ID attacks back for <b>$epower</b> force!";
						$gain = ($out[size] * rand(100,200));
						print "<br>You lose. Enemy ID $enemy[id] gained <b>$gain</b> tokens.";
						mysql_query("update outposts set tokens=tokens+$gain where id=$enemy[id]");
					}
				}
			}
		}
	}
}

if ($view == spy) {
	print "Ah... why hello there.  Welcome to your den.  This is where your spys that you have hired reside.  What would you like to do?";
	print "<br>";
	print "<ul>";
	print "<li><a href=\"outposts.php?view=spy&action=spy\">Spy</a>";
	print "<li><a href=\"outposts.php?view=spy&action=sabotage_barricades\">Sabatoge Baricades</a>";
	print "</ul>";
	print "<br><br>";
	print "<b>Number of Spys: </b>";
	print $out[spys];
	print "<br><br>";
		
	if ($action == spy) {
		if ($out[turns] <= 0) {
			print "You do not have enough turns.";
		} else {
			
			if ($oid) {
				$enemy = mysql_fetch_array(mysql_query("select * from outposts where id=$oid"));
				if (empty ($enemy[id])) {
					print "There is no such outpost.<br><br>";
				} else {
					if ($oid == $out[id]) {
						print "It is not necessary to spy on yourself.<br><br>";
					} else {
						mysql_query("update outposts set turns=turns-1 where owner=$stat[id]");
						$ypower = (($yspys - $enemy[spys]) + rand(1,$out[size]));
						$epower = (($enemy[spys] - $yspys) + rand(1,$enemy[size]));
						if ($ypower <= 0) {
							$ypower = 1;
						}
						if ($epower <= 0) {
							$epower = 1;
						}
						if ($ypower == $epower) {
							print "You attempted to spy on enemy ID <b>$enemy[id]</b>, however the enemy spys retaliate greatly.  Your spys gained nothing.";
						}
						if ($ypower > $epower) {
							print "You attempted to spy on enemy ID $enemy[id] with $yspys. Your spy succeeded.";
							$a = ($yspys - $enemy[spys]);
							$b = ($enemy[spys] - $yspys);
							$spyloss = ($yspys - rand(0,$a));
							$espyloss = (($enemy[spys] - $yspys) + rand(0,$b));
							mysql_query("update outposts set spys=spys-$spyloss where id=$out[id]");
							mysql_query("update outposts set spys=$espyloss where id=$enemy[id]");
							
							print "<br><b>Intel on Outpost ID $enemy[id]</b>";
							print "<br><b>Barricades: </b> $enemy[barricades]";
							print "<br><b>Troops: </b> $enemy[troops]";
							print "<br><b>Spys: </b> $enemy[spys]";
							print "<br><b>Tokens: </b> $enemy[tokens]";
							print "<br><br>";
						}
						if ($ypower < $epower) {
							print "You attempted to spy on enemy ID, but the enemy's spys repelled your attempts.";
							$a = ($yspys - $enemy[spys]);
							$b = ($enemy[spys] - $yspys);
							$espyloss = ($yspys - rand(0,$a));
							$spyloss = (($enemy[spys] - $yspys) + rand(0,$b));
							mysql_query("update outposts set spys=spys-$spyloss where id=$out[id]");
							mysql_query("update outposts set spys=$espyloss where id=$enemy[id]");					
						}
					}
				}
			}
			
			print "What is the ID of the outpost you wish to spy on?";
			print "<table><form method=post action=outposts.php?view=spy&action=spy>";
			print "<tr><td>Outpost ID:</td><td><input type=text name=oid></td></tr>";
			print "<tr><td>Spys to use:</td><td><input type=text name=yspys></td></tr>";
			print "<tr><td colspan=2 align=center><input type=submit value=Spy></td></tr>";
			print "</form></table>";
			
		}
	}
// Spy tactic, destroying barricades.  LOTS of work to be done here! !!!!	
	if ($action == sabotage_barricades) {
		if ($out[turns] <= 0) {
			print "You do not have enough turns.";
		} else {
			
			if ($oid) {
				$enemy = mysql_fetch_array(mysql_query("select * from outposts where id=$oid"));
				if (empty ($enemy[id])) {
					print "There is no such outpost.<br><br>";
				} else {
					if ($oid == $out[id]) {
						print "You should not sabotage yourself.<br><br>";
					} else {
						mysql_query("update outposts set turns=turns-1 where owner=$stat[id]");
						
						if ($enemy[spys] <= 0) {
							$enemy[spys] = 0;
						}
						
						$ypower = (($yspys - $enemy[spys]) + rand(1,$out[size]));
						$epower = (($enemy[spys] - $yspys) + rand(1,$enemy[size]));
						if ($ypower <= 0) {
							$ypower = 1;
						}
						if ($epower <= 0) {
							$epower = 1;
						}
						if ($ypower == $epower) {
							print "You attempted to sabatoge <b>$enemy[name]'s<b>($enemy[id]) baricades, however the enemy retaliated greatly.  Your spys failed.<br><br>";
						}
						if ($ypower > $epower) {
							print "You attempted to sabatoge <b>$enemy[name]'s<b>($enemy[id]) baricades with $yspys. Your spy succeeded.<br><br>";
							$a = ($yspys - $enemy[spys]);
							$b = ($enemy[spys] - $yspys);
							$rand_c = rand(5,10);
							$c - ($a / $rand_c);
							
							if ($a <= 0) {
								$a = 0;
							}
							if ($b <= 0) {
								$b = 0;
							}
							
							$spyloss = ($yspys - rand(0,$a));
							$espyloss = (($enemy[spys] - $yspys) + rand(0,$b));
							$baricade_loss =(rand($c,$a));
							
							if ($spyloss <= 0) {
								$spyloss = 0;
							}
							if ($espyloss <= 0) {
								$espyloss = 0;
							}
							if ($baricade_loss <= 0) {
								$baricade_loss = 0;
							}
							
							mysql_query("update outposts set spys=spys-$spyloss where id=$out[id]");
							mysql_query("update outposts set spys=$espyloss where id=$enemy[id]");
							mysql_query("update outposts set barricades=$baricade_loss where id=$enemy[id]");
							
						}
						if ($ypower < $epower) {
							print "You attempted to spy on enemy ID, but the enemy's spys repelled your attempts.<br><br>";
							$a = ($yspys - $enemy[spys]);
							$b = ($enemy[spys] - $yspys);
							$espyloss = ($yspys - rand(0,$a));
							$spyloss = (($enemy[spys] - $yspys) + rand(0,$b));
							mysql_query("update outposts set spys=spys-$spyloss where id=$out[id]");
							mysql_query("update outposts set spys=$espyloss where id=$enemy[id]");					
						}
					}
				}
			}
			
			print "What is the ID of the outpost you wish to sabotage their barricades?";
			print "<table><form method=post action=\"outposts.php?view=spy&action=sabotage_barricades\">";
			print "<tr><td>Outpost ID:</td><td><input type=text name=oid></td></tr>";
			print "<tr><td>Spys to use:</td><td><input type=text name=yspys></td></tr>";
			print "<tr><td colspan=2 align=center><input type=submit value=Sabotage></td></tr>";
			print "</form></table>";
			
		}
	}
	
}

if ($view == listing) {
	print "<table>";
	print "<tr><td width=100><b><u>Outpost ID</td><td width=100><b><u>Base Size</td><td width=100><b><u>Owner</td><td width=100><b><u>Attack?</td></tr>";
	$osel = mysql_query("select * from outposts order by size desc");
	while ($op = mysql_fetch_array($osel)) {
		print "<tr><td>$op[id]</td><td>$op[size]</td><td><a href=view.php?view=$op[owner]>$op[owner]</a></td><td>- <a href=outposts.php?view=battle&action=battle&oid=$op[id]>Attack</a></td></tr>";
	}
	print "</table>";
}
if ($view) {
	print "<br><br>[<a href=outposts.php>Menu</a>]";
}?>
<?php include("footer.php"); ?>