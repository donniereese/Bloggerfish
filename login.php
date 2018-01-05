<?php include('header.php'); ?>


<?php
if ($_POST['view'] == 'logout') {
	session_destroy(); 
	print "You have now been logged out.";
	exit;
}

include ("config.php.inc");

if (!$_POST['user'] || !$_POST['pass']) {
    ?>
    <p>Please fill out all fields.</p>
	<table align='center' style='border:2px solid #444444;'>
	<tr>
	<td>
	<form method=post action=login.php>
        <table>
            <tr><td>User:</td><td><input type=text name=user></td></tr>
            <tr><td>Pass:</td><td><input type=password name=pass></td></tr>
            <tr><td colspan=2 align=center>
                <input class="button" type=submit value=Login>
                <a class="button" href="signup.php">Sign Up</a>
                </td></tr>
        </table>
	</form>
	<?php
	exit;
}

$user = $_post['user'];
$pass = $_post['pass'];

$logres = mysql_num_rows(mysql_query("select * from members where user='$_POST[user]' and pass='$_POST[pass]'"));

if ($logres <= 0) {
	print "Login failed. If you have not already, please signup. Otherwise, check your spelling and login again.";
	exit;
} else {
	$_SESSION['user'] = $_POST['user'];
	$_SESSION['pass'] = $_POST['pass'];
	
	?>
	<meta http-equiv='refresh' content='5;url=index.php'>
	
	<div style=\"background: #000000; text-align: center; margin: 0 auto; width: 100%; height: 100%;\">";
        <div style=\"border: 8px solid #ffffff; color: #ffffff; background: #000000; width: 400px; position: relative; top: 200px;\">";
            Welcome back, <?php echo $user; ?>! You are now logged in.<br><br>
            <center>
                If your browser does not automatically redirect you to the main community site, then please click 
                <a href=index.php>here</a> to continue.
            </center>
        </div>
	</div>
    <?php
}

?>

<?php include('footer.php'); ?>