<?php

$typo = 'adghk,./;';
//$text = array();

if (isset($_POST['typo'])) {
	switch ( $_POST['typo'] ) {
		case 'left' :
			$typo = 'asdf';
			break;
		case 'leftex' :
			$typo = 'asdfg';
			break;
		case 'right' :
			$typo = 'jkl;';
			break;
		case 'rightex' :
			$typo = 'hjkl;';
			break;
		case 'both' :
			$typo = 'asdfghjkl;';
			break;
	}
}

$typo .= ' ';

$signs = 120;

if ( isset($_POST['signs']) && is_numeric($_POST['signs']) ) {
	$signs = $_POST['signs'] < 200 ? $_POST['signs'] : 200;
}

$l = strlen( $typo ) - 1;

for ($i = 0; $i < $signs; $i++) {
	$int = rand(0, $l);
	
	echo '<span>' . $typo[$int] . '</span>';
	
	//$text[$i] = $typo[$int];
}

//foreach ($text as $letter) {
//	echo '<span>' . $letter . '</span>';
//}
