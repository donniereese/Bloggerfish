<?php $title = "Help"; include("header.php"); ?>

<?php 
if (!$help) {
	print "What would you like to get help on? I know it's not fully complete yet, but it's a start.<ul>
	<li><a href=help.php?help=overview>Overview</a>
	<li><a href=help.php?help=eventlog>Event Log</a>
	<li><a href=help.php?help=inventory>Inventory</a>
	<li><a href=help.php?help=indocron>Indocron</a>
	<li><a href=help.php?help=battle>Battle</a>
	<li><a href=help.php?help=money>Money</a>
	<li><a href=help.php?help=energy>Energy</a></ul>";
}

if ($help == overview) {
	print "Your overview is where you can get an overall status of your character and yourself. You can see your wins, losses, strength, agility, etc.  From here you can manage your AP.  These are gained through out the game and are like level up points to add on to your stats.  You gain 3 AP every time you level up.";
} elseif ($help == eventlog) {
	print "Your event log keeps track of all things that happen to you in the game, so you won't miss anything while you're away.";
} elseif ($help == inventory) {
	print "The inventory is where all of your weapons and armor are kept. You can sell them, or you can equip them.";
} elseif ($help == indocron) {
	print "Indocron is the city in ExoFusion. You can get to many places once you're there.";
} elseif ($help == battle) {
	print "Battling is the main point of the game. The more agility you have, the more times in a row you'll attack your opponent. The more strength you have, the more damage you do. Here is also where weapons and armor come into play. The stronger your weapon is (Denoted by the +), the more is added on to your strength. The more power in your armor (Again, denoted by a +) helps to dissipate the enemy's attack. Say an enemy has 13 strength, but you have a +10 armor. You will only receive 3 damage. The first one to run out of HP loses, and the other gains EXP and credits from the battle. If the EXP total goes up, so does the level of the winner.";
} elseif ($help == money) {
	print "Money comes in two forms, Platinum and Credits. Credits are the main currency, and are used more widely in the game. Platinum, however, is much rarer and can only be found in one place in the game. Not much is known about the uses of platinum, but it is rumored that it will be known soon...";
} elseif ($help == energy) {
	print "Energy is the deciding factor in what you can do in a day. Once it reaches zero, you have to wait until reset to get it restored. Reset normally comes around 12AM EST, maybe sooner or later, its not a definite thing, but there is one at least every 12-24 hours, so check back often.";
}

if ($help) {
   print "<br><br>(<a href=help.php>Back</a>)";
}

include("footer.php");
?>