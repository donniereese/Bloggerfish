<?php 
    $to = "dredge16shs@yahoo.com"; 
    $from = "dredge16shs@yahoo.com"; 
    $subject = "This is a test email"; 
    $message = "Dear John,\n\nThis is a fake email, I hope you enjoy it.\n\nFrom Jane."; 

    $headers  = "From: $from\r\n"; 

    $success = mail($to, $subject, $message, $headers); 
    if ($success) 
        echo "The email to $to from $from was successfully sent"; 
    else 
        echo "An error occurred when sending the email to $to from $from"; 
?> 
