<?php
class map {

	function read_sysconfig() {
		$inf = CWD."/system/config.php";
		if (file_exists($inf)) {
			$file = file_get_contents($inf);
			$data = $file;
			
			$parser = xml_parser_create();
			xml_parser_set_option($parser,XML_OPTION_SKIP_WHITE,1);
			xml_parser_set_option($parser,XML_OPTION_CASE_FOLDING,0);
			
			//$i_ar - pointers to the locations of appropriate values in
			//$d_ar - data value array
			
			xml_parse_into_struct($parser,$data,&$d_ar,&$i_ar) or $this->print_error();
			
			//view content of $d_ar and $i_ar
			//echo '<pre>';
			//print_r($d_ar);
			//print_r($i_ar);
			//echo '</pre>';
			
			return $d_ar;
			
			xml_parser_free($parser);
			
			//$link = "<a href=\"".SYSMOD.$d_ar[2][value]."/mod.php\">".$d_ar[1][value]."</a>";
			//return $link;
		} else {
			return "Error in $inf";
		}
	}


	function show_map() {
		Header("Content-type: image/png");
		include ("config.php");

		$diagramWidth = 384;
		$diagramHeight = 384;
		$tilew = 32;
		$tileh = 32;
		
		
		$chipset = imageCreateFromPNG ('http://www.bloggerfish.com/shadowsofdawn/images/map/chipset1.png');
		
		$image = imageCreateTrueColor ($diagramWidth, $diagramHeight);
		$grass = imageCreateTrueColor ($tilew, $tileh);
		
		//imagealphablending ($item, Yes);
		
		//$trans = imageColorAllocateAlpha ($image, 255, 103, 139, 255);
		
		imagecopy ($grass, $chipset, 0, 0, 0, 256, 32, 32);
		
//imagecopy ($item, $chipset, 0, 0, 608, 256, 32, 32);
		
//imagefill ($item, 0, 0, $trans);
//imagefill ($item, 31, 0, $trans);
		
		
//$transparent = imageColorAllocate ($image, 255, 103, 139);
//imagecolortransparent ($item, $transparent);
		
		
		imageSetTile ($image, $grass);
		imageFilledRectangle ($image, 0, 0, $diagramWidth, $diagramHeight, IMG_COLOR_TILED);
		
//imagecopy ($image, $item, 0, 0, 0, 0, 32, 32);
		
		$image = $this->tile(20, 9, 50, 20, $image, $chipset);
		$image = $this->tile(20, 9, 46, 40, $image, $chipset);
		$image = $this->tile(20, 9, 68, 47, $image, $chipset);
		
		$image = $this->tile(7, 2, 100, 0, $image, $chipset);
		$image = $this->tile(9, 2, 132, 0, $image, $chipset);

		imagePNG ($image);
		
//imagedestroy ($item);
		imagedestroy ($grass);
		imagedestroy ($image);
		
	}
	
	function tile($col, $row, $x, $y, $image, $chipset) {
		
		$tilew = 32;
		$tileh = 32;
		
		$pixcol = ((32 * $col) - 32);
		$pixrow = ((32 * $row) - 32);

		$tile = imagecreatetruecolor($tilew, $tileh);		
		imagealphablending ($tile, Yes);
		
		imagecopy ($tile, $chipset, 0, 0, $pixcol, $pixrow, 32, 32);
		imagetruecolortopalette($tile, false, 256);
		
		$trans = imagecolorallocate($tile, 255, 103, 139);
		
		imagecolortransparent($tile, $trans);
		
		imagecopy ($image, $tile, $x, $y, 0, 0, 32, 32);
		return $image;
		imagedestroy($tile);
		imagedestroy($chipset);
		
		
		
//		if ($col == 20 && $row == 9) {
//			$tilew = 32;
//			$tileh = 32;
//			$trans = imageColorAllocateAlpha ($image, 255, 103, 139, 255);
//			$tile = imageCreateTrueColor ($tilew, $tileh);
//			imagealphablending ($tile, Yes);
//			imagecopy ($tile, $chipset, 0, 0, 608, 256, 32, 32);
//			imagefill ($tile, 0, 0, $trans);
//			imagefill ($tile, 31, 0, $trans);
//			imagecopy ($image, $tile, $x, $y, 0, 0, 32, 32);
//			return $image;
//			imagedestroy($tile);
//			imagedestroy($chipset);
//		}
	}
}

if ($image == "map") {
	$map = new map();
	echo $map->show_map();
}

?>