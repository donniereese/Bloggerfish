<?php $title = "Bank"; include("header.php"); ?>
Welcome to the bank, sir. You can deposit your extra credits in here, to avoid having them stolen by attackers.<br><br>
Your interest is 5% at this moment.  This varies from week to week.

<form method=post action=bank.php?action=withdraw>
<?php
print "I will <input type=submit value=withdraw> <input type=text value=$stat[bank] name=with> credits.";
?>
</form>

<form method=post action=bank.php?action=deposit>
<?php
print "I will <input type=submit value=deposit> <input type=text value=$stat[credits] name=dep> credits.";
?>
</form>

<?php
if ($action == withdraw) {
	if ($with > $stat[bank] || $with <= 0) {
		print "You cannot withdraw that amount.";
		include("footer.php");
		exit;
	}

	mysql_query("update players set credits=credits+$with where id=$stat[id]");
	mysql_query("update players set bank=bank-$with where id=$stat[id]");
	print "You withdrew $with credits.";
}

if ($action == deposit) {
	if ($dep > $stat[credits] || $dep <= 0) {
		print "You cannot deposit that amount.";
		include("footer.php");
		exit;
	}

	mysql_query("update players set credits=credits-$dep where id=$stat[id]");
	mysql_query("update players set bank=bank+$dep where id=$stat[id]");
	print "You deposited $dep credits.";
}
?>

<?php include("footer.php"); ?>