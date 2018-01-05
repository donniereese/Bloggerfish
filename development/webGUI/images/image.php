<?php
/*
function rgb2hex($rgb){
   return sprintf("%06X", $rgb);
}
//$hex = rgb2hex(65280); // 00FF00
*/
header("Content-type: image/jpeg");
$image = imagecreate ($w, $h);
$imagebg1 = imagecreatefromjpeg ('input2.jpg');
$imagebg2 = imagecreatefromjpeg ('input1.jpg');

$background_color = imagecolorallocate($image, 34, 34, 51);

imagecopy ($image, $imagebg1, 0, 0, 0, 00, 14, 14);

if ($w >= 28) {
	$bg2w = ($w - 14);
	$bg2h = ($h - 14);
	imagecopy ($image, $imagebg2, $bg2w, $bg2h, 0, 0, 14, 14);
}

imagejpeg($image);
imagedestroy($image);  

?>