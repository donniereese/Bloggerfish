<?php
$lib = array(
		'Test 2' => array(
			"Yarrow"					=> "Achillea hybrids", 
			"Japanese Anemone"			=> "Anemone japonica",
			"Goat's Beard"				=> "Aruncus dioicus",
			"Butterfly Weed"			=> "Asclepias tuberosa",
			"False Spirea"				=> "Astilbe x arendsii",
			"New England Aster"			=> "Aster novae-angliae",
			"False Indigo"				=> "Baptisia australis",
			"Snowbank, False Aster"		=> "Boltonia asteroides",
			"Peach-leaved Bellflower"	=> "Campanula persicifolia",
			"Cupid's Dart"				=> "Catananche caerulea");

function library() {
	$groups = array_keys($lib);
}

function whatsit() {
	//Get File Contents of current.txt
	$cfile = file("current.txt");
	//Print Contents
	if($cfile[2]) {
		return $cfile[2];
	}
}

function random($group) {
	
}
?>