<?php $title = "Indocron Casino"; include("header.php"); ?>

<?php
if ($action != cherinco) {
	print "<blockquote>Ahh... Welcome to the Indocron Casino, one of the friendliest places in the city.  You will find that we are very fair here, and you should enjoy yourself greatly.  Come back if you need anything.</blockquote><br>";
	print "<br><b>For a limited time, you will be able to use the Casino without any limitations.  This will only last for about 5 days.  After that, you will not be able to use it unless you meet certain requirements.<br>";
	print "Would you like to place a bet on a Cherinco? <a href=casino.php?action=cherinco>Bet 100 Creds</a>.";
} else {
	if ($action = cherinco){
	if ($stat[credits] < 100) {
		print "You do not seem to have enough credits to place a bet.  Please return with enough credits to play.  It only costs 100 credits, after all.";
	} else {
		$chance = rand(1,10);
		mysql_query("update players set credits=credits-100 where id=$stat[id]");
		
		if ($chance == 1) {
			print "You watch as the Cherinco that you chose comes in last.  You lost your 100 credits.";
			print "<br><a href=casino.php>Back</a> to the casino.";
		}
		
		if ($chance == 2) {
			print "You watch the Cherinco that you choose runs around the track and places 1st! You won.  Your odds are being counted up.";
			mysql_query("update players set credits=credits+400 where id=$stat[id]");
			print "<br><a href=casino.php>Back</a> to the casino.";
		}
		
		if ($chance == 3) {
		   print "Your Cherinco placed 3rd in the race.  You receive your 100 creds back.";
		   mysql_query("update players set credits=credits+100 where id=$stat[id]");
		   print "<br><a href=casino.php>Back</a> to the casino.";
		}
		
		if ($chance == 4) {
			print "Your Cherinco lost badly.  It did not even finish the race.  Pick a different one next time.";
			print "<br><a href=casino.php>Back</a> to the casino.";
		}
		
		if ($chance == 5) {
			print "You lost the race, but won anyways!  You found a bag of credits on the ground. :)";
			$random = rand(1,400);
			mysql_query("update players set credits=credits+$random where id=$stat[id]");
			print "You open the bag and find $random credits in it.";
			print "<br><a href=casino.php>Back</a> to the casino.";
		}
		
		if ($chance == 6) {
			print "You watch as the Cherinco that you chose comes in last.  You lost your 100 credits.";
			print "<br><a href=casino.php>Back</a> to the casino.";
		}
		
		if ($chance == 7) {
		   print "You watch as the Cherinco that you chose comes in last.  You lost your 100 credits.";
		   print "<br><a href=casino.php>Back</a> to the casino.";
		}
		
		if ($chance == 8) {
			print "Your Cherinco came in 3rd again.  You still get your 100 creds back.";
			mysql_query("update players set credits=credits+100 where id=$stat[id]");
			print "<br><a href=casino.php>Back</a> to the casino.";
		}
		if ($chance == 9) {
		   print "You watch as the Cherinco that you chose comes in last.  You lost your 100 credits.";
		   print "<br><a href=casino.php>Back</a> to the casino.";
		}
		if ($chance == 10) {
		   print "You watch as the Cherinco that you chose comes in last.  You lost your 100 credits.";
		   print "<br><a href=casino.php>Back</a> to the casino.";
		}
	 }
   }
}

include("footer.php");?>