<?php
/**
 * Rounded PHP, Rounded corners made easy.
 *
 * rounded.php
 *
 * PHP version 5, GD version 2
 *
 * Copyright (C) 2008 Tree Fort LLC
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
 * 
 * @category	Rounded PHP
 * @package		<none>
 * @author		Nevada Kent <dev@kingthief.com>
 * @version		1.1
 * @link		http://dev.kingthief.com
 * @link		http://dev.kingthief.com/demos/roundedphp
 * @link		http://www.sourceforge.net/projects/roundedphp
 */

# Required classes
require_once 'classes/Rounded/RGB.php';
require_once 'classes/Rounded/Corner.php';
require_once 'classes/Rounded/Rectangle.php';
require_once 'classes/Rounded/Side.php';

extract($_GET);

# Options =
#  - Shape: 'c' (or 'corner'), 'r' (or 'rectangle'), 's' (or 'side')
#  - Radius: (integer >= 0)
#  - Width: (integer >= 2)
#  - Height: (integer >= 2)
#  - Foreground Color: (hex code - 3 or 6 char)
#  - Background Color: (hex code - 3 or 6 char)
#  - Border Color: (hex code - 3 or 6 char)
#  - Border Width: (integer >= 0)
#  - Orientation: 'tl' (or 'lt'), 'tr' (or 'rt'), 'bl' (or 'lb'), 'br' (or 'rb')
#  - Side: 't', 'top', 'l', 'left', 'b', 'bottom', 'r', 'right'
#  - Antialias: 1, 0
#  - Format: 'png', 'gif', 'jpg' (or 'jpeg')
#  - Background Transparent: 1, 0
#  - Border Transparent: 1, 0
#  - Foreground Transparent: 1, 0
#  - Transparent Color: (hex code - 3 or 6 char)

$shape = isset($shape) ? strval($shape) : (isset($sh) ? strval($sh) : 'c');
$radius = isset($radius) ? intval($radius) : (isset($r) ? intval($r) : 10);
$width = isset($width) ? intval($width) : (isset($w) ? intval($w) : 100);
$height = isset($height) ? intval($height) : (isset($h) ? intval($h) : 100);
$foreground = isset($foreground) ? strval($foreground) : (isset($fg) ? strval($fg) : 'CCC');
$background = isset($background) ? strval($background) : (isset($bg) ? strval($bg) : 'FFF');
$bordercolor = isset($bordercolor) ? strval($bordercolor) : (isset($bc) ? strval($bc) : '000');
$borderwidth = isset($borderwidth) ? intval($borderwidth) : (isset($bw) ? intval($bw) : 0);
$orientation = isset($orientation) ? strval($orientation) : (isset($o) ? strval($o) : 'tl');
$side = isset($side) ? strval($side) : (isset($si) ? strval($si) : 'top');
$antialias = isset($antialias) ? (bool) intval($antialias) : (isset($aa) ? (bool) intval($aa) : true);
$format = isset($format) ? strval($format) : (isset($f) ? strval($f) : 'png');
$bgtransparent = isset($bgtransparent) ? (bool) intval($bgtransparent) : (isset($bgt) ? (bool) intval($bgt) : false);
$btransparent = isset($btransparent) ? (bool) intval($btransparent) : (isset($bt) ? (bool) intval($bt) : false);
$fgtransparent = isset($fgtransparent) ? (bool) intval($fgtransparent) : (isset($fgt) ? (bool) intval($fgt) : false);
$transparentcolor = isset($transparentcolor) ? strval($transparentcolor) : (isset($tc) ? strval($tc) : NULL);
// User Added
$tprncylvl = isset($tprncylvl) ? strval(transparencylvl) : (isset($trl) ? strval($trl) : 127);

switch (strtolower($format)) {
	case 'jpg' :
	case 'jpeg' :
		$transparentcolor = NULL;
	case 'gif' :
		$bgtransparent = false;
		$btransparent = false;
		$fgtransparent = false;
		break;
	case 'png' :
		$transparentcolor = NULL;
		break;
}

$params = array('radius'		=> $radius,
				'width'			=> $width,
				'height'		=> $height,
				'foreground'	=> $foreground,
				'background'	=> $background,
				'borderwidth'	=> $borderwidth,
				'bordercolor'	=> $bordercolor,
				'orientation'	=> $orientation,
				'side'			=> $side,
				'antialias'		=> $antialias,
				'bgtransparent'	=> $bgtransparent,
				'btransparent'	=> $btransparent,
				'fgtransparent'	=> $fgtransparent,
/*usr added*/	'tprncylvl'		=> $tprncylvl);

switch (strtolower($shape)) {
	case 'r' :
	case 'rect' :
	case 'rectangle' :
		$img = Rounded_Rectangle::create($params);
		break;
	case 's' :
	case 'side' :
		$img = Rounded_Side::create($params);
		break;
	case 'c' :
	case 'corner' :
	default :
		$img = Rounded_Corner::create($params);
		break;
}

header('Cache-Control: max-age=3600, must-revalidate');
header('Pragma: cache');

imagesavealpha($img, $fgtransparent || $bgtransparent || ($btransparent && $borderwidth > 0));

if (!is_null($transparentcolor) && $transparentcolor) {
	$rgb = new Rounded_RGB($transparentcolor);
	$color = imagecolorallocate($img, $rgb->red, $rgb->green, $rgb->blue);
	imagecolortransparent($img, $color);
}

switch (strtolower($format)) {
	case 'jpg' :
	case 'jpeg' :
		header('Content-Type: image/jpeg');
		imagejpeg($img, '', 100);
		break;
	case 'gif' :
		header('Content-Type: image/gif');
		imagegif($img);
		break;
	case 'png' :
	default :
		header('Content-Type: image/png');
		imagepng($img);
		break;
}
?>
