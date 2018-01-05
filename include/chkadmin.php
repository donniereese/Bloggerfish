<?php
//Simple admin check... for now.
if(($stat[status] == "member") || $stat[status] !="admin" || !$stat[status]) {
	print "<div class=\"generic_message\">";
	print "<p>Do not pass go. Do not collect $200.</p>";
	print "<p>This is a restricted section. You must be signed on to an account with correct permissions to view this page.</p>";
	print "</div>";
	include("footer.php");
	exit;
}
?>
