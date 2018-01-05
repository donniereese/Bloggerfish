<?php include("head.php"); ?>

Register to get your Shadows of Dawn account now, and begin the game. No confirmation code required.
<?php
$nump = mysql_num_rows(mysql_query("select * from players"));
print " <b>$nump</b> people already have.";
?>

<form method="post" action="register.php?action=register">
<table>
	<tr>
		<td>Username:</td>
		<td><input type="text" name="user" style="width:180px"></td>
	</tr>
	<tr>
		<td>Email:</td>
		<td><input type="text" name="email" style="width:180px"></td>
	</tr>
	<tr>
		<td>Pass:</td>
		<td><input type="password" name="pass" style="width:180px"></td>
	</tr>
	<tr>
		<td>Verify Pass:</td>
		<td><input type="password" name="vpass" style="width:180px"></td>
	</tr>
	<tr><td></td><td></td></tr>
	<tr>
		<td>Gender:</td>
		<td>
		<select name="gender" style="width:180px">
			<option value="male">Male</option>
			<option value="female">Female</option>
		</select>
		</td>
	</tr>
	<tr>
		<td>Class:</td>
		<td>
		<select name="class" style="width:180px">
			<option value="human">Human</option>
			<option value="angel">Angel</option>
			<option value="demon">Demon</option>
		</select>
		</td>
	</tr>
<?php
print "<tr><td>Referral ID:</td><td><input type=text name=ref readonly value=$reff> <i>If you don't know what this is, leave it blank.</i></td></tr>";
?>
	<tr>
		<td colspan=2 align=center><input type="submit" value="Register"></td>
	</tr>
</table>
</form>

<?php
if ($action == register) {
	if (!$user || !$pass || !$email || !$vpass || !$gender || !$class) {
		print "You must fill out all fields.";
		include("foot.php");
		exit;
	}
	$dupe1 = mysql_num_rows(mysql_query("select * from players where user='$user'"));
	if ($dupe1 > 0) {
		print "Someone already has that username.";
		include("foot.php");
		exit;
	}
	$dupe2 = mysql_num_rows(mysql_query("select * from players where email='$email'"));
	if ($dupe1 > 0) {
		print "Someone already has that email.";
		include("foot.php");
		exit;
	}
	if ($pass != $vpass) {
		print "The passwords do not match.";
		include("foot.php");
		exit;
	}
	$ref = strip_tags($ref);
	$user = strip_tags($user);
	$pass = strip_tags($pass);
	if ($ref) {
		mysql_query("update players set refs=refs+1 where id=$ref");
	}
	mysql_query("insert into players (user, email, pass, gender, class_type) values('$user','$email','$pass','$gender','$class')") or die("Could not register.");

	$theid = mysql_fetch_array(mysql_query("select * from players where user='$user' and pass='$pass'"));
	
    $to = $email; 
    $from = "Shadows of Dawn Registration"; 
    $subject = "Your Shadows of Dawn Registration and Conformation"; 
    $message = "User Name: $user\r\n Password: $pass\r\n Registered Email: $email\r\n Please click the link below or copy it in to your browser to confirm your account.\r\n http://darkabyss.elixant.com/shadowsofdawn/confirm.php?confirm=$theid[id]\r\n \r\n You can not user your account until you activate your account.";

    $headers  = "From: $from\r\n"; 

    $success = mail($to, $subject, $message, $headers); 
    if ($success) {
        echo "The email confirmation was successfully sent to $to.  If you do not receive an e-mail, please contact dredge16shs@yahoo.com and describe what has happened."; 
    } else {
        echo "An error occurred when sending the email to the e-mail, $to"; 
		
	print "You are now registered to play, but you have to activate your account using the e-mail that was just sent to you.";
	}
}
?>

<?php include("foot.php"); ?>