<?php

$typo = 'adghk,./;';

$conf = array(
	'home' => array(
		'left' => 'asdf',
		'leftex' => 'asdfg',
		'right' => 'jkl;',
		'rightex' => 'hjkl;',
		'both' => 'asdfghjkl;'
	),
	'bottom' => array(
		'left' => 'zxcv',
		'leftex' => 'zxcvb',
		'right' => 'm,./',
		'rightex' => 'nm,./',
		'both' => 'zxcvbnm,./'
	),
	'top' => array(
		'left' => 'qwer',
		'leftex' => 'qwert',
		'right' => 'uiop',
		'rightex' => 'yuiop',
		'both' => 'qwertyuiop'
	)
);

$row = $conf['home'];

if (isset($_POST['row'])) {
	switch ( $_POST['row'] ) {
		case 'home' :
			$row = $conf['home'];
			break;
		case 'top' :
			$row = $conf['top'];
			break;
		case 'bottom' :
			$row = $conf['bottom'];
			break;
	}	
}

if (isset($_POST['typo'])) {
	switch ( $_POST['typo'] ) {
		case 'left' :
			$typo = $row['left'];
			break;
		case 'leftex' :
			$typo = $row['leftex'];
			break;
		case 'right' :
			$typo = $row['right'];
			break;
		case 'rightex' :
			$typo = $row['rightex'];
			break;
		case 'both' :
			$typo = $row['both'];
			break;
	}
}

$typo .= ' ';

$signs = 120;

if ( isset($_POST['signs']) && is_numeric($_POST['signs']) ) 
	$signs = ( $_POST['signs'] > 9 && $_POST['signs'] < 201 ) ? $_POST['signs'] : 100;

$l = strlen( $typo ) - 1;

for ($i = 0; $i < $signs; $i++) {
	echo '<span>' . $typo[ rand( 0, $l ) ] . '</span>';
}

