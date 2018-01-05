<?php
Header("Content-type: image/png");

   $diagramWidth = 400;
   $diagramHeight = 124;

$image = imageCreateTrueColor ($diagramWidth, $diagramHeight);
$imagebg = imageCreateFromJPEG ('storm_interpretation_high.jpg'); // transparent PNG
$imageavi = imageCreateFromPNG ('http://avatar.gaiaonline.com/gaia/members/ava/30/2e/a21911c32e30_flip.png?t=1131270575_3.00_00');
$imagesheenaavi = imageCreateFromPNG ('http://avatar.gaiaonline.com/gaia/members/ava/ca/94/56ad4d342494ca.png?t=1131328708_3.00_00');

imagecopy ($image, $imagebg, 0, 0, 275, 147, 400, 130);


$aviwidth = imagesx($imageavi);
$aviheight = imagesy($imageavi);

$saviwidth = imagesx($imagesheenaavi);
$saviheight = imagesy($imagesheenaavi);

imagecopy ($image, $imageavi, 0, 0,  0, 26, $aviwidth, $aviheight);
imagecopy ($image, $imagesheenaavi, 160, 0,  0, 26, $saviwidth, $saviheight);

//	imageSetTile ($image, $imagebg);
//	imageFilledRectangle ($image, 0, 0, $diagramWidth, $diagramHeight, IMG_COLOR_TILED);

   $textcolor1 = imageColorAllocate ($image, 200, 80, 80);
   $textcolor2 = imageColorAllocate ($image, 255, 255, 255);

imageString ($image, 4, 100, 20, 'dredge_freak', $textcolor1);
imageString ($image, 4,  98, 18, 'dredge_freak', $textcolor2);

imageString ($image, 4, 136, 34, 'and', $textcolor1);
imageString ($image, 4, 134, 32, 'and', $textcolor2);

imageString ($image, 4, 103, 48, 'ToxicKisses', $textcolor1);
imageString ($image, 4, 101, 46, 'ToxicKisses', $textcolor2);

   imagePNG ($image);

   imagedestroy ($image);
   imagedestroy ($imagebg);

//header("Content-type: image/png");
//$width = 200;
//$height = 18;
//$im = @imagecreate($width, $height) or die("Cannot Initialize new GD image stream");
//$text = "dynamic signature version 1";
//$background_color = imagecolorallocate($im, 0, 0, 0);
//$text_color = imagecolorallocate($im, 233, 14, 91);
//imagestring($im, 2, 5, 5,  $text, $text_color);
//imagepng($im);
//imagedestroy($im); 
?>
