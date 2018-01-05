<?php

header("Content-type: image/png");
$im = @imagecreate($width, $height) or die("Cannot Initialize new GD image stream");
$text = "dynamic signature version .1";
$background_color = imagecolorallocate($im, 0, 0, 0);
$text_color = imagecolorallocate($im, 233, 14, 91);
imagestring($im, 2, 5, 5,  $text, $text_color);
imagepng($im);
imagedestroy($im);  

?>