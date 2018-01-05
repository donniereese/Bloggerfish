<?php
function phpSafe($strText) {
 //removes backslash created by php from the string
    $tmpString = $strText;
    $tmpString = str_replace(chr(92), "", $tmpString); 
    return $tmpString;
}

// from the form we are getting the hidden field value and sending it to the phpSafe function
$hiddencontent = phpSafe($hiddencontent);

echo $hiddencontent;
?>